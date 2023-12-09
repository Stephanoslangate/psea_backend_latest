<?php

namespace App\Models;

use CodeIgniter\Model;

class ActionModel extends Model
{
    protected $table            = 'action';
    protected $primaryKey       = 'idAction';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['libelle','delais','date','version','idEmploye','idProg','idIndictateur','created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findActionById($id)
    {
        $action = $this
            ->asArray()
            ->where(['idAction' => $id])
            ->first();

        if (!$action) throw new Exception('Could not find Action for specified ID');

        return $action;
    }

    public function findActionsProgrammeById($id)
    {
        $actions = $this
            ->asArray()
            ->where(['idProg' => $id])
            ->get();

        if (!$actions) throw new Exception('Could not find Action for specified ID');

        return $actions;
    }
    public function deleteAction($idAction){
        $this->where('idAction', $idAction)->delete();
    }
}
