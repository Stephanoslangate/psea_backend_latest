<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSousActiviteModel extends Model
{
    protected $table            = 'user_sousactivites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['idUser', 'idSousActiv'];

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


    public function findUserSousActiviteById($id)
    {
        $Tache = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$Tache) throw new Exception('Could not find UserSousActivite for specified ID');

        return $Tache;
    }
    public function findUserSousActiviteByIdUser($id)
    {
        $userSousActivite = $this
            ->asArray()
            ->where(['idUser' => $id])
            ->first();

        if (!$userSousActivite) throw new Exception('Could not find UserSousActivite for specified ID');

        return $userSousActivite;
    }
    public function findUserSousActiviteByIdSousActivite($id)
    {
        $userSousActivite = $this
            ->asArray()
            ->where(['idSousActiv' => $id])
            ->first();

        if (!$userSousActivite) throw new Exception('Could not find UserSousActivite for specified ID');

        return $userSousActivite;
    }
    public function findUserSousActByIdSousActiviteAndIdUser($idUser,$idSousActivite ){
        $userSousActivite = $this
        ->asArray()
        ->where(['idUser' => $idUser,'idSousActiv' => $idSousActivite])
        ->first();

    if (!$userSousActivite) throw new Exception('Could not find UserSousActivite for specified IDs');

    return $userSousActivite;
    }

}
