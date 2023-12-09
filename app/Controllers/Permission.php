<?php

namespace App\Controllers;

use App\Models\PermissionModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Permission extends BaseController
{
    public function index()
    {
        //
    }
    /**
     * Create a new Role
     */
    public function store()
    {
        $rules = [
            'permission' => 'required|min_length[2]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $libelle = $input['permission'];
        $model = new PermissionModel();
        $model->save($input);
        $permission = $model->where('permission', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Permission added successfully',
                'Permission' => $permission
            ]
        );
    }
}
