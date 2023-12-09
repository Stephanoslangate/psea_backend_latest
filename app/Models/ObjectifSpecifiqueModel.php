<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifSpecifiqueModel extends Model
{
    protected $table            = 'objectifspecifique';
    protected $primaryKey       = 'idObjectifSpe';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idObj','idObjectifStra','missionObjectifSpe'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findObjectifSpecifiqueById($id)
    {
        $objectifSpecifique = $this
            ->asArray()
            ->where(['idObjectifSpe' => $id])
            ->first();

        if (!$objectifSpecifique) throw new Exception('Could not find ObjectifSpecifique for specified ID');

        return $objectifSpecifique;
    }
}
