<?php

namespace App\Models;

use CodeIgniter\Model;

class RessourceModel extends Model
{
    protected $table            = 'ressource';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['typeRessource','zoneIntervention','idFinancement'];

    
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findRessourceById($id)
    {
        $ressource = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$ressource) throw new Exception('Could not find Ressource for specified ID');

        return $ressource;
    }
}
