<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcedureModel extends Model
{
    protected $table            = 'procedure';
    protected $primaryKey       = 'idProcedure';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['reference','libelle','datemiseajour','idProcessus','etat'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findProcedureById($id)
    {
        $procedure = $this
            ->asArray()
            ->where(['idProcedure' => $id])
            ->first();

        if (!$procedure) throw new Exception('Could not find Procedure for specified ID');

        return $procedure;
    }

    public function findProcessusProcedureById($id)
    {
        $procedures = $this
            ->asArray()
            ->where(['idProcessus' => $id])
            ->get();

        if (!$procedures) throw new Exception('Could not find Procedures for specified ID');

        return $procedures;
    }

}
