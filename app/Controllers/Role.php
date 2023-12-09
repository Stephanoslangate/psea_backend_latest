<?php

namespace App\Controllers;

use App\Models\RoleModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Role extends BaseController
{
    /**
     * Get all Role
     * @return Response
     */
    public function index()
    {
        $model = new RoleModel();
        return $this->getResponse(
            [
                'message' => 'Roles retrieved',
                'Roles' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Role
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required|min_length[2]',
            'code' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $libelle = $input['libelle'];
        $model = new RoleModel();
        $model->save($input);
        $role = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Role added successfully',
                'role' => $role
            ]
        );
    }
    /**
     * Get a single Role by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new RoleModel();
            $role = $model->findRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'Role retrieved successfully',
                    'role' => $role
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Role for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Role
     */
    public function update($id)
    {
        try {
            $model = new RoleModel();
            $model->findRoleById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $role = $model->findRoleById($id);

            return $this->getResponse(
                [
                    'message' => 'Role updated successfully',
                    'role' => $role
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
     * Delete an existing Role
     */
    public function destroy($id)
    {
        try {
            $model = new RoleModel();
            $role = $model->findRoleById($id);
            $model->delete($role);

            return $this->getResponse(
                [
                    'message' => 'Role deleted successfully',
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
}
