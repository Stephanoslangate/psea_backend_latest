<?php

namespace App\Models;

use CodeIgniter\Model;

class MaillonppbseModel extends Model
{
    protected $table            = 'maillonppbse';
    protected $primaryKey       = 'idMaillon';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['code','nom'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findMaillonppbseById($id)
    {
        $maillonppbse = $this
            ->asArray()
            ->where(['idMaillon' => $id])
            ->first();

        if (!$maillonppbse) throw new Exception('Could not find Maillonppbse for specified ID');

        return $maillonppbse;
    }

    public function deleteMaillon($idMaillon){
        $this->where('idMaillon', $idMaillon)->delete();
    }
}
