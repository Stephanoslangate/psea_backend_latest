<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProgrammeModel extends Model
{
    protected $table            = 'user_programmes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['idUser', 'idProgramme'];

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

    public function findUserProgrammeById($id)
    {
        $Tache = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$Tache) throw new Exception('Could not find UserProgramme for specified ID');

        return $Tache;
    }
    public function findUserProgrammeByIdUser($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idUser' => $id])
            ->get();

        if (!$userRole) throw new Exception('Could not find UserProgramme for specified ID');

        return $userRole;
    }
    public function findUserProgrammeByIdProgramme($id)
    {
        $userRole = $this
            ->asArray()
            ->where(['idProgramme' => $id])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserProgramme for specified ID');

        return $userRole;
    }
    public function findUserProgrammeByIdProgrammeAndIdUser($idUser, $idProgramme)
    {
        $userRole = $this
            ->asArray()
            ->where(['idProgramme' => $idProgramme, 'idUser' => $idUser])
            ->first();

        if (!$userRole) throw new Exception('Could not find UserProgramme for specified ID');

        return $userRole;
    }
}
