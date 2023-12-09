<?php

namespace App\Models;

use CodeIgniter\Model;

class ModaliteModel extends Model
{
    protected $table            = 'modalite';
    protected $primaryKey       = 'idMod';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findModaliteById($id)
    {
        $modalite = $this
            ->asArray()
            ->where(['idMod' => $id])
            ->first();

        if (!$modalite) throw new Exception('Could not find Modalite for specified ID');

        return $modalite;
    }
    public function deleteModalite($idMod){
        $this->where('idMod', $idMod)->delete();
    }
}
