<?php

namespace App\Models;

use CodeIgniter\Model;

class ActeurModel extends Model
{
    protected $table            = 'acteur';
    protected $primaryKey       = 'idActeur';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['typeActeur','idEmploye'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findActeurById($id)
    {
        $acteur = $this
            ->asArray()
            ->where(['idActeur' => $id])
            ->first();

        if (!$acteur) throw new Exception('Could not find Acteur for specified ID');

        return $acteur;
    }
    
}
