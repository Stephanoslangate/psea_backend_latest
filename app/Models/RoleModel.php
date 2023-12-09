<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class RoleModel extends Model
{
    protected $table            = 'role';
    protected $primaryKey       = 'idRole';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle', 'code'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findRoleById($id)
    {
        $role = $this
            ->asArray()
            ->where(['idRole' => $id])
            ->first();

        if (!$role) throw new Exception('Could not find Role for specified ID');

        return $role;
    }
    public function findFreeRoles($usedRoles)
    {
        if (!empty($usedRoles)) {
            $roles = $this->select('idRole,libelle,code')
                ->whereNotIn('code ', $usedRoles)->findAll();

            if (!$roles) return [];
        } else {
            $roles = $this->select('idRole,libelle,code')
                ->findAll();
        }
        return $roles;
    }
}
