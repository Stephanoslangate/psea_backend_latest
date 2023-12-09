<?php

namespace App\Controllers;


use App\Models\UserRoleModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class UserRole extends BaseController
{
   /**
     * Get all UserRole
     * @return Response
     */
    public function index()
    {
        $model = new UserRoleModel();
        return $this->getResponse(
            [
                'message' => 'UserRoles retrieved',
                'UserRoles' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new UserRole
     */
    public function store()
    {//'idUser','idRole'
        $rules = [
            'idUser' => 'required',
            'idRole' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $idUser = $input['idUser'];
        $model = new UserRoleModel();
        $model->save($input);
        $userRole = $model->where('idUser', $idUser)->first();

        return $this->getResponse(
            [
                'message' => 'UserRole added successfully',
                'userRole' => $userRole
            ]
        );
    }
    /**
     * Get a single UserRole by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new UserRoleModel();
            $userRole = $model->findUserRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'UserRole retrieved successfully',
                    'userRole' => $userRole
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find UserRole for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing UserRole
     */
    public function update($id)
    {
        try {
            $model = new UserRoleModel();
            $model->findUserRoleById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $userRole = $model->findUserRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'UserRole updated successfully',
                    'userRole' => $userRole
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
     * Delete an existing UserRole
     */
    public function destroy($id)
    {
        try {
            $model = new UserRoleModel();
            $userRole = $model->findUserRoleById($id);
            $model->delete($userRole);

            return $this->getResponse(
                [
                    'message' => 'UserRole deleted successfully',
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
     * Get a single UserRole by ID
     */
    public function getTest($id)
    {
        $id = intval($id);

        try {
            $model = new UserRoleModel();
            $userRole = $model->findUserRoleByIdUser($id);

            return $this->getResponse(
                [
                    'message' => 'UserRole retrieved successfully',
                    'userRole' => $userRole
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find UserRole for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


}
