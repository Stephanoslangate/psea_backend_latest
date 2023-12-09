<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PermissionGroupeModel extends Model
{
    protected $table            = 'permission_groupe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idGroupe', 'idPermission'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

 
    public function findGroupesByIdPermission($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idPermission' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find groupe for specified ID');

        return $userRole;
    }
    public function findPermissionsByIdGroupe($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idGroupe' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find Permission for specified ID');

        return $userRole;
    }
    public function findPermissionsByIdRole($id)
    {
        $userRole = $this->select('permission')
            ->join('permission', 'permission.idPermission = permission_groupe.idPermission')
            ->join('groupe', 'groupe.idGroupe = permission_groupe.idGroupe')
            ->join('role_groupe', 'groupe.idGroupe = role_groupe.idGroupe')
            ->join('role', 'role_groupe.idRole = role.idRole')
            ->where(['role.idRole' => $id])->findAll();

        if (!$userRole) throw new Exception('Could not find UserRole for specified ID');

        return $userRole;
    }
    public function addPermission($data){
        $perm = $this->insert($data);
        if (!$perm) throw new Exception('Could not save permission_groupe');

        return $perm;
    }
    public function deletePermissionsOfGroup($idGroupe, $permissionList){
        $this->where('idGroupe', $idGroupe)->delete();
    }
}
