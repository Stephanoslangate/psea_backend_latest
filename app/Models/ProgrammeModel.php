<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeModel extends Model
{
    protected $table            = 'programme';
    protected $primaryKey       = 'idProg';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomProg','date_debut','date_fin','created_at','idType','etat'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findProgrammeById($id)
    {
        $programme = $this
            ->asArray()
            ->where(['idProg' => $id])
            ->first();

        if (!$programme) throw new Exception('Could not find Programme for specified ID');

        return $programme;
    }

}
