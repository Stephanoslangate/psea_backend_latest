<?php

namespace App\Models;

use CodeIgniter\Model;

class VersionModel extends Model
{
    protected $table            = 'version';
    protected $primaryKey       = 'idVers';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idActivite','nomVers'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findVersionById($id)
    {
        $version = $this
            ->asArray()
            ->where(['idVers' => $id])
            ->first();

        if (!$version) throw new Exception('Could not find Version for specified ID');

        return $version;
    }
}
