<?php

namespace App\Models;

use CodeIgniter\Model;

class LivrableModel extends Model
{
    protected $table            = 'livrable';
    protected $primaryKey       = 'idLivrable';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomLivrable','date_emission','idActivite'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findLivrableById($id)
    {
        $livrable = $this
            ->asArray()
            ->where(['idLivrable' => $id])
            ->first();

        if (!$livrable) throw new Exception('Could not find Livrable for specified ID');

        return $livrable;
    }
}
