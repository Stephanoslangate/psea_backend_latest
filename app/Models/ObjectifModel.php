<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
    protected $table            = 'objectif';
    protected $primaryKey       = 'idObj';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomObjectif','type','idProg'];


    protected $createdField  = 'created_at';

    public function findObjectifById($id)
    {
        $objectif = $this
            ->asArray()
            ->where(['idObj' => $id])
            ->first();

        if (!$objectif) throw new Exception('Could not find Objectif for specified ID');

        return $objectif;
    }//findObjectifsProgById
    public function findObjectifsProgById($id)
    {
        $objectif = $this
            ->asArray()
            ->where(['idProg' => $id])
            ->get();

        if (!$objectif) throw new Exception('Could not find Objectif for specified ID');

        return $objectif;
    }

    public function deleteObjectif($idObj){
        $this->where('idObj', $idObj)->delete();
    }
}
