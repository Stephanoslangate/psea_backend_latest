<?php

namespace App\Models;

use CodeIgniter\Model;

class FinancementModel extends Model
{
    protected $table            = 'financement';
    protected $primaryKey       = 'idFinancement';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nature','date_debut','date_fin','idDepense'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findFinancementById($id)
    {
        $financement = $this
            ->asArray()
            ->where(['idFinancement' => $id])
            ->first();

        if (!$financement) throw new Exception('Could not find Financement for specified ID');

        return $financement;
    }

}
