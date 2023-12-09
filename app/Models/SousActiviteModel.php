<?php

namespace App\Models;

use CodeIgniter\Model;

class SousActiviteModel extends Model
{
    protected $table            = 'sousactivite';
    protected $primaryKey       = 'idSousActiv';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle','chronogramme','etatbudget','bailleur','idActivite','etat','idService','idIndictateur'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findSousActiviteById($id)
    {
        $sousActivite = $this
            ->asArray()
            ->where(['idSousActiv' => $id])
            ->first();

        if (!$sousActivite) throw new Exception('Could not find SousActivite for specified ID');

        return $sousActivite;
    }
    public function findSousActiviteServiceById($id)
    {
        $sousActivite = $this
            ->asArray()
            ->where(['idService' => $id])
            ->get();
        if (!$sousActivite) throw new Exception('Could not find SousActivite for specified ID');

        return $sousActivite;
    }

    public function findSousActivitiesActiviteById($id)
    {
        $sousActivites = $this
            ->asArray()
            ->where(['idActivite' => $id])
            ->get();

        if (!$sousActivites) throw new Exception('Could not find SousActivites for specified ID');

        return $sousActivites;
    }
}
