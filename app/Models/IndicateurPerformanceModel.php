<?php

namespace App\Models;

use CodeIgniter\Model;

class IndicateurPerformanceModel extends Model
{
    protected $table            = 'indicateurperformance';
    protected $primaryKey       = 'idIndictateur';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['date_debut','date_fin','indice','commentaire','etat','idProg','idActivite','idProjet','reference','realisationt4','realisationt3','realisationt2','realisationt1','prevut4','prevut3','prevut2','prevut1'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findIndicateurPerformanceById($id)
    {
        $indicateurPerformance = $this
            ->asArray()
            ->where(['idIndictateur' => $id])
            ->first();

        if (!$indicateurPerformance) throw new Exception('Could not find IndicateurPerformance for specified ID');

        return $indicateurPerformance;
    }

    public function deleteIndicateur($idIndictateur){
        $this->where('idIndictateur', $idIndictateur)->delete();
    }

}
