<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessusModel extends Model
{
    protected $table            = 'processus';
    protected $primaryKey       = 'idProcessus';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['version','libelle','idProg','etat'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findProcessusById($id)
    {
        $processus = $this
            ->asArray()
            ->where(['idProcessus' => $id])
            ->first();

        if (!$processus) throw new Exception('Could not find Processus for specified ID');

        return $processus;
    }
    public function findProcessusProgrammeById($id)
    {
        $processus = $this
            ->asArray()
            ->where(['idProg' => $id])
            ->get();

        if (!$processus) throw new Exception('Could not find Processus for specified ID');

        return $processus;
    }
}
