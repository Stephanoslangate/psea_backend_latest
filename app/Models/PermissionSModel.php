<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PermissionModel extends Model
{
    protected $table            = 'permission';
    protected $primaryKey       = 'idPermission';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['permission'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function findPermissionById($id)
    {
        $permission = $this
            ->asArray()
            ->where(['idPermission' => $id])
            ->first();

        if (!$permission) throw new Exception('Could not find UserRole for specified ID');

        return $permission;
    }
    public function findFreePermissions($usedPermissions)
    {
        if (!empty($usedPermissions)) {
            $permissions = $this->select('idPermission,permission')
                ->whereNotIn('permission ', $usedPermissions)->findAll();

            if (!$permissions) return [];
        } else {
            $permissions = $this->select('idPermission,permission')
                ->findAll();
        }
        return $permissions;
    }
}
