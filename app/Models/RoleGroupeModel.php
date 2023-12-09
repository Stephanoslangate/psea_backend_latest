<?php

namespace App\Models;
use CodeIgniter\Model;
use Exception;

class RoleGroupeModel extends Model
{
    protected $table            = 'role_groupe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idGroupe','idRole'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

   
    public function findRolesByIdGroupe($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idGroupe' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserRole for specified ID');

        return $userRole;
    }
    public function findGroupesByIdRole($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idRole' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserRole for specified ID');

        return $userRole;
    }
    public function addRoleGroupe($data){
        $role = $this->insert($data);
        if (!$role) throw new Exception('Could not save role_groupe');

        return $role;
    }
    public function deleteRolesOfGroup($idGroupe){
        $this->where('idGroupe', $idGroupe)->delete();
    }
}