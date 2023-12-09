<?php

namespace App\Models;

use CodeIgniter\Model;

class CreditModel extends Model
{
    protected $table            = 'credit';
    protected $primaryKey       = 'idCredit';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomCredit','idAction','idActivite','idProg'];


    protected $createdField  = 'created_at';
    public function findCreditById($id)
    {
        $credit = $this
            ->asArray()
            ->where(['idCredit' => $id])
            ->first();

        if (!$credit) throw new Exception('Could not find Credit for specified ID');

        return $credit;
    }
}
