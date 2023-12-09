<?php

namespace App\Models;

use CodeIgniter\Model;

class HierachieModel extends Model
{
    protected $table            = 'hierachies';
    protected $primaryKey       = 'idHi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['libelle','si_effectifpre','si_montantpre','si_effectin','si_montantn','ef_effectin','ef_montantn'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findHierachieById($id)
    {
        $Hierachie = $this
            ->asArray()
            ->where(['idHi' => $id])
            ->first();
        if (!$Hierachie) throw new Exception('Could not find Hierachie for specified ID');

        return $Hierachie;
    }
}
