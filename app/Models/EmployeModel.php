<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeModel extends Model
{
    protected $table            = 'employe';
    protected $primaryKey       = 'idEmploye';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nom','prenom','fonction','contact','idService'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function findEmployeById($id)
    {
        $employe = $this
            ->asArray()
            ->where(['idEmploye' => $id])
            ->first();

        if (!$employe) throw new Exception('Could not find Employe for specified ID');

        return $employe;
    }

}
