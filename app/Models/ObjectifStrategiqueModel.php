<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifStrategiqueModel extends Model
{
    protected $table            = 'objectifstrategique';
    protected $primaryKey       = 'idObjectifStra';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idObj','anneecible','created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findObjectifStrategiqueById($id)
    {
        $objectifStrategique = $this
            ->asArray()
            ->where(['idObjectifStra' => $id])
            ->first();

        if (!$objectifStrategique) throw new Exception('Could not find ObjectifStrategique for specified ID');

        return $objectifStrategique;
    }
}
