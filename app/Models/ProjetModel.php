<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjetModel extends Model
{
    protected $table            = 'projet';
    protected $primaryKey       = 'idProjet';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomProjet','budgetAlloue','date_debut','date_fin','created_at','idProg'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function findProjetById($id)
    {
        $projet = $this
            ->asArray()
            ->where(['idProjet' => $id])
            ->first();

        if (!$projet) throw new Exception('Could not find Projet for specified ID');

        return $projet;
    }


}
