<?php

namespace App\Models;

use CodeIgniter\Model;

class TacheModel extends Model
{
    protected $table            = 'tache';
    protected $primaryKey       = 'idTache';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['libelle', 'description', 'pourcentage', 'validee', 'idSousActivite','trimestre','updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function findTacheById($id)
    {
        $Tache = $this
            ->asArray()
            ->where(['idTache' => $id])
            ->first();

        if (!$Tache) throw new Exception('Could not find Tache for specified ID');

        return $Tache;
    }
    public function findTachesSousActivite($id)
    {
        $Taches = $this
            ->asArray()
            ->where(['idSousActivite' => $id])
            ->get();

        if (!$Taches) throw new Exception('Could not find Taches for specified ID Sous Activite');

        return $Taches;
    }
}
