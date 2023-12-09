<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'service';
    protected $primaryKey       = 'idService';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomService','idStruct'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findServiceById($id)
    {
        $service = $this
            ->asArray()
            ->where(['idService' => $id])
            ->first();

        if (!$service) throw new Exception('Could not find Service for specified ID');

        return $service;
    }
    public function deleteService($idService){
        $this->where('idService', $idService)->delete();
    }
}
