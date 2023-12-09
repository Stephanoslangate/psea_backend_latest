<?php

namespace App\Models;

use CodeIgniter\Model;

class StructureModel extends Model
{
    protected $table            = 'structure';
    protected $primaryKey       = 'idStruct';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomStruct'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findStructureById($id)
    {
        $structure = $this
            ->asArray()
            ->where(['idStruct' => $id])
            ->first();

        if (!$structure) throw new Exception('Could not find Structure for specified ID');

        return $structure;
    }
    public function deleteStructure($idStruct){
        $this->where('idStruct', $idStruct)->delete();
    }

}
