<?php

namespace App\Models;

use CodeIgniter\Model;

class DepenseActiviteModel extends Model
{
    protected $table            = 'depenseactivites';
    protected $primaryKey       = 'idDep';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nature','ae_ouvert','ae_execute','cp_ouvert','cp_execute','justification','idActivite'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findDepenseActiviteById($id)
    {
        $DepenseActivite = $this
            ->asArray()
            ->where(['idDep' => $id])
            ->first();
        if (!$DepenseActivite) throw new Exception('Could not find DepenseActivite for specified ID');

        return $DepenseActivite;
    }
}
