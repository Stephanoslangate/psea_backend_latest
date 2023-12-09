<?php

namespace App\Models;

use CodeIgniter\Model;

class DepenseModel extends Model
{
    protected $table            = 'depense';
    protected $primaryKey       = 'idDepense';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['natureDepense','idProg','idCible','idCredit','idAction','lfi','actemodif','execution'];


    protected $createdField  = 'created_at';
    public function findDepenseById($id)
    {
        $depense = $this
            ->asArray()
            ->where(['idDepense' => $id])
            ->first();

        if (!$depense) throw new Exception('Could not find Depense for specified ID');

        return $depense;
    }
}
