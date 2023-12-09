<?php

namespace App\Controllers;

use App\Models\PermissionGroupeModel;
use App\Models\PermissionModel;
use App\Models\RoleModel;
use App\Models\GroupeModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Groupe extends BaseController
{
    /**
     * Get all GroupeModel
     * @return Response
     */
    public function index()
    {
        $model = new GroupeModel();
        return $this->getResponse(
            [
                'message' => 'Groupes retrieved',
                'Groupes' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new GroupeModel
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
        $model = new GroupeModel();
        $model->save($input);
        $groupe = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Groupe added successfully',
                'groupe' => $groupe
            ]
        );
    }
    /**
     * Get a single GroupeModel by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new GroupeModel();
            $groupe = $model->findGroupeById($id);

            return $this->getResponse(
                [
                    'message' => 'Groupe retrieved successfully',
                    'groupe' => $groupe
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Groupe for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Groupe
     */
    public function update($id)
    {
        try {
            $model = new GroupeModel();
            $model->findGroupeById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $groupe = $model->findGroupeById($id);

            return $this->getResponse(
                [
                    'message' => 'Groupe updated successfully',
                    'groupe' => $groupe
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
     * Delete an existing Groupe
     */
    public function destroy($id)
    {
        try {
            $model = new GroupeModel();
            $groupe = $model->findGroupeById($id);
            $model->delete($groupe);

            return $this->getResponse(
                [
                    'message' => 'Groupe deleted successfully',
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

    public function getPermissions($idGroupe)
    {
        $model = new GroupeModel();
        $model2 = new PermissionModel();
        $permissions = $model->findPermissionsByGroupeId($idGroupe);
        $permission_list = [];

        foreach ($permissions as $permission) {
            $permission_list[] = $permission['permission'];
        }
        $freePermissions = $model2->findFreePermissions($permission_list);
        // var_dump($freePermissions);
        return $this->getResponse(
            [
                'message' => 'Permissions retrieved',
                'permissions' => $permissions,
                'freePermissions' => $freePermissions
            ]
        );
    }


    /**
     * Get a single Role by ID
     */
    public function SavePermissions($idGroupe)
    {
        try {

           // $input = $this->getRequestInput($this->request);

            $selectedP = '';
            // $model = new DepenseModel();
            // $model->save($input);
            // $depense = $model->where('natureDepense', $natureDepense)->first();

            return $this->getResponse(
                [
                    'message' => 'Depense added successfully',
                    'depense' => $selectedP
                ]
            );
            //code...
        } catch (\Throwable $th) {
            print_r($th);
            
        }
    }
}
