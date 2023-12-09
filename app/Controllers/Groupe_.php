<?php

namespace App\Controllers;

use App\Models\GroupeModel;
use App\Models\PermissionGroupeModel;
use App\Models\PermissionModel;
use App\Models\RoleGroupeModel;
use App\Models\RoleModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Groupe_ extends BaseController
{
    /**
     * Get all Role
     * @return Response
     */
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
     * Save permissions
     */
    public function SavePermissions()
    {
        try {
            $model = new PermissionGroupeModel();
            $permissionModel = new PermissionModel();
            $input = $this->getRequestInput($this->request);

            $permissions = json_decode($input['permissions']);
            $idGroupe = $input['idGroupe'];
            //var_dump($permissions);
           $model->deletePermissionsOfGroup($idGroupe, $permissions);
            foreach ($permissions as $p) {
                $data = [
                    'idPermission' => $permissionModel->findPermissionByCodePermission($p)['idPermission'],
                    'idGroupe' => $idGroupe,
                ];
                $model->addPermission($data);
            }
            return $this->getResponse(
                [
                    'message' => 'permissions added successfully',
                    'permissions' => $permissions,
                    'idGroupe' => $idGroupe
                ]
            );
            //code...
        } catch (\Throwable $th) {
            return $this->getResponse(
                [
                    'message' => 'error',
                    'th' => $th->getMessage(),
                ]
            );
        }
    }
    public function get($id)
    {
        $model = new GroupeModel();
        return $this->getResponse(
            [
                'message' => 'Groupe retrieved',
                'groupe' => $model->findGroupeById($id)
            ]
        );
    }
    /**
     * Update an existing Role
     */

     public function getRoles($idGroupe)
    {
        $model = new GroupeModel();
        $model2 = new RoleModel();
        $roles = $model->findRolesByGroupeId($idGroupe);
        $roles_list = [];

        foreach ($roles as $r) {
            $roles_list[] = $r['code'];
        }
        $freeRoles = $model2->findFreeRoles($roles_list);
        return $this->getResponse(
            [
                'message' => 'Roles retrieved',
                'roles' => $roles,
                'freeRoles' => $freeRoles
            ]
        );
    }
    public function SaveRoles()
    {
        try {
            $model = new RoleGroupeModel(); //
            $input = $this->getRequestInput($this->request);

            $roles = json_decode($input['roles']);
            $idGroupe = $input['idGroupe'];
            $model->deleteRolesOfGroup($idGroupe);
            foreach ($roles as $p) {
                $data = [
                    'idRole' => $p,
                    'idGroupe' => $idGroupe,
                ];
                $model->addRoleGroupe($data);
            }
            return $this->getResponse(
                [
                    'message' => 'roles added successfully',
                    'roles' => $roles,
                    'idGroupe' => $idGroupe
                ]
            );
            //code...
        } catch (\Throwable $th) {
            return $this->getResponse(
                [
                    'message' => 'error',
                    'th' => $th->getMessage(),
                ]
            );
        }
    }
}
