<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteActeurModel extends Model
{
    protected $table            = 'activiteacteur';
    protected $primaryKey       = 'idActiviteAct';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['dateeffective','commentaire','idActeur','idActivite'];


    protected $createdField  = 'created_at';
    public function findActiviteActeurById($id)
    {
        $activiteActeur = $this
            ->asArray()
            ->where(['idActiviteAct' => $id])
            ->first();

        if (!$activiteActeur) throw new Exception('Could not find ActiviteActeur for specified ID');

        return $activiteActeur;
    }

}
