<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table            = 'activite';
    protected $primaryKey       = 'idActivite';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle','delais','date','idAction','idFaitGen','idMod','idMaillon','etat','budgetEtat','budgetPtf'];


    protected $createdField  = 'created_at';

    public function findActiviteById($id)
    {
        $activite = $this
            ->asArray()
            ->where(['idActivite' => $id])
            ->first();

        if (!$activite) throw new Exception('Could not find Activite for specified ID');

        return $activite;
    }
    public function findActivitesProcedureById($id)
    {
        $activites = $this
            ->asArray()
            ->where(['idProcedure' => $id])
            ->get();

        if (!$activites) throw new Exception('Could not find Activites for specified ID');

        return $activites;
    }
    public function deleteActivite($idActivite){
        $this->where('idActivite', $idActivite)->delete();
    }
}
