<?php

namespace App\Controllers\API;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\PermissionGroupeModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use ReflectionException;

class User extends BaseController
{
    // use ResponseTrait;
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
        $rules = [
            'name' => 'required',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[user.username]',
            'password' => 'required|min_length[6]|max_length[255]',
            'type' => 'required'

        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $userModel = new UserModel();
        $userModel->save($input);
        $userCreated = $userModel->where('username', $input['username'])->first();
            return $this->getJWTForUser(
            $input['username'],
            ResponseInterface::HTTP_CREATED
        );
    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[6]|max_length[255]|validateUser[username, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);


        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        return $this->getJWTForUser($input['username']);
    }

    private function getJWTForUser(string $username, int $responseCode = ResponseInterface::HTTP_OK)
    {
        try {
            $model = new UserModel();
            $user = $model->findUserByUsername($username);
            unset($user['password']);

            helper('jwt');

            $idRole = $user['idRole'];

            $id = intval($idRole);
            $model2 = new RoleModel();
            $role = $model2->findRoleById($id);
            $model3 = new PermissionGroupeModel();
            $result = $model3->findPermissionsByIdRole($role['idRole']);
            $permissions = [];
            foreach ($result as $p) {
                if (!in_array($p['permission'], $permissions)) {
                    $permissions[] = $p['permission'];
                }
            }
            return $this->getResponse(
                [
                    'message' => 'User authenticated successfully',
                    'user' => $user,
                    'role' => $role,
                    'access_token' => getSignedJWTForUser($username),
                    'permissions' => $permissions,
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => $ex->getMessage(),
                ],
                $responseCode
            );
        }
    }

    public function getUsers()
    {
        $model = new UserModel();
        return $this->getResponse(
            [
                'message' => 'Users retrieved',
                'Users' => $model->findAll()
            ]
        );
    }

    /**
     * Update service an existing User
     */
    public function update()
    {
        try {
            $input = $this->getRequestInput($this->request);
            $id = intval($input['id']); 
            $idService = intval($input['idService']); 

            $model = new UserModel();
            $data = [
                "idService" => $idService
            ];
            $model->update($id, $data);
            $users = $model->find($id);

            return $this->getResponse(
                [
                    'message' => 'User updated successfully',
                    'User' => $users
                ]
            );
        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function usersService($id = null)
    {
        $model = new UserModel();
        $data = $model->findUsersService($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Users retrieved',
                    'Users' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Programme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
