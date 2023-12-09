<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestissementModel extends Model
{
    protected $table            = 'investissement';
    protected $primaryKey       = 'idInvesti';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomInvestissement','montantInvestissement','cibleInvestissement','origineInvestissement','date_validation','idProg','idFinancement','idProjet'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findInvestissementById($id)
    {
        $investissement = $this
            ->asArray()
            ->where(['idInvesti' => $id])
            ->first();

        if (!$investissement) throw new Exception('Could not find Investissement for specified ID');

        return $investissement;
    }

}
