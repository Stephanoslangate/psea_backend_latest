<?php

namespace App\Models;

use CodeIgniter\Model;

class FaitGenerateurModel extends Model
{
    protected $table            = 'faitgenerateur';
    protected $primaryKey       = 'idFaitGen';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findFaitGenerateurById($id)
    {
        $faitGenerateur = $this
            ->asArray()
            ->where(['idFaitGen' => $id])
            ->first();

        if (!$faitGenerateur) throw new Exception('Could not find FaitGenerateur for specified ID');

        return $faitGenerateur;
    }
    public function deleteFait($idFaitGen){
        $this->where('idFaitGen', $idFaitGen)->delete();
    }
}
