<?php

namespace App\Models;

use CodeIgniter\Model;

class SourceModel extends Model
{
    protected $table            = 'source';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomSource','idFinancement'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findSourceById($id)
    {
        $source = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$source) throw new Exception('Could not find Source for specified ID');

        return $source;
    }

}
