<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeProgrammeModel extends Model
{
    protected $table            = 'typeprogramme';
    protected $primaryKey       = 'idType';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomTypeProg'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findTypeProgrammeById($id)
    {
        $typeProgramme = $this
            ->asArray()
            ->where(['idType' => $id])
            ->first();

        if (!$typeProgramme) throw new Exception('Could not find TypeProgramme for specified ID');

        return $typeProgramme;
    }

    public function findTypeProgrammeByNomType($nomtype)
    {
        $typeProgramme = $this
            ->asArray()
            ->where(['nomTypeProg' => $nomtype])
            ->first();

        if (!$typeProgramme) throw new Exception('Could not find TypeProgramme for specified ID');

        return $typeProgramme;
    }

}
