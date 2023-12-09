<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultatModel extends Model
{
    protected $table            = 'resultat';
    protected $primaryKey       = 'idResultat';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idObjectifStra','idObjectifSpe','idAction','nomResultat','typeResultat','dateResultat'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function findResultatById($id)
    {
        $resultat = $this
            ->asArray()
            ->where(['idResultat' => $id])
            ->first();

        if (!$resultat) throw new Exception('Could not find Resultat for specified ID');

        return $resultat;
    }

    public function findResultatsActionById($id)
    {
        $resultat = $this
            ->asArray()
            ->where(['idAction' => $id])
            ->get();

        if (!$resultat) throw new Exception('Could not find Resultat for specified ID');

        return $resultat;
    }

}
