<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class GroupeModel extends Model
{
    protected $table            = 'groupe';
    protected $primaryKey       = 'idGroupe';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle','code'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    
   
    public function findGroupeById($id)
    {
        $groupe = $this
            ->asArray()
            ->where(['idGroupe' => $id])
            ->first();
        if (!$groupe) throw new Exception('Could not find groupe for specified ID');

        return $groupe;
    }
    public function findPermissionsByGroupeId($id){
        $permissions = $this->select(' permission.idPermission,permission')
        ->join('permission_groupe', 'permission_groupe.idGroupe = groupe.idGroupe')
        ->join('permission', 'permission_groupe.idPermission = permission.idPermission')
        ->where(['groupe.idGroupe' => $id])->findAll();
        if (!$permissions) return [];

        return $permissions;
    }
    public function findRolesByGroupeId($id){
        $permissions = $this->select(' role.idRole,role.libelle,role.code')
        ->join('role_groupe', 'role_groupe.idGroupe = groupe.idGroupe')
        ->join('role', 'role_groupe.idRole = role.idRole')
        ->where(['groupe.idGroupe' => $id])->findAll();
        if (!$permissions) return [];

        return $permissions;
    }
    
}
