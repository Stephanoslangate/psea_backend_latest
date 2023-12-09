<?php

namespace App\Models;
use CodeIgniter\Model;
use Exception;

class UserRoleModel extends Model
{
    protected $table            = 'userrole';
    protected $primaryKey       = 'idUserRole';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idUser','idRole'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
/* 
    public function findUserRoleById($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idUserRole' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserRole for specified ID');

        return $userRole;
    }
    public function findUserRoleByIdUser($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idUser' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserRole for specified ID');

        return $userRole['idRole'];
    } */
}