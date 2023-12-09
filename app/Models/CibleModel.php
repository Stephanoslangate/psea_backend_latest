<?php

namespace App\Models;

use CodeIgniter\Model;

class CibleModel extends Model
{
    protected $table            = 'cible';
    protected $primaryKey       = 'idCible';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomCible','idProg','idFinancement'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findCibleById($id)
    {
        $cible = $this
            ->asArray()
            ->where(['idCible' => $id])
            ->first();

        if (!$cible) throw new Exception('Could not find Cible for specified ID');

        return $cible;
    }

}
