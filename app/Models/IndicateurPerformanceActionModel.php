<?php

namespace App\Models;

use CodeIgniter\Model;

class IndicateurPerformanceActionModel extends Model
{
    protected $table            = 'indicateurperformanceactions';
    protected $primaryKey       = 'idIndicateurAction';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['libelle','valeur_de_ref','id_action','type_valeur','realisation','idActivite'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findIndicateurById($id)
    {
        $indicateur = $this
            ->asArray()
            ->where(['idIndicateurAction' => $id])
            ->first();
        if (!$indicateur) throw new Exception('Could not find IndicateurAction for specified ID');

        return $indicateur;
    }
    public function deleteIndicateur($idIndictateur){
        $this->where('idIndicateurAction', $idIndictateur)->delete();
    }
    
    public function createIndicateurPerformanceAction($data)
    {
        try {
            if (!$this->insert($data)) {
                throw new \RuntimeException('L\'insertion a échoué.');
            }
            return $this->getInsertID();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function getIndicateurPerformanceActionById($id)
    {
        try {
            $indicateurPerformanceAction = $this->find($id);
            if (!$indicateurPerformanceAction) {
                throw new \RuntimeException('Aucun indicateur de performance action trouvé avec cet ID.');
            }
            return $indicateurPerformanceAction;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }

    public function getAllIndicateurPerformanceActions()
    {
        try {
            return $this->findAll();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function updateIndicateurPerformanceAction($id, $data)
    {
        try {
            if (!$this->update($id, $data)) {
                throw new \RuntimeException('La mise à jour a échoué.');
            }
            return $this->affectedRows();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function deleteIndicateurPerformanceAction($id)
    {
        try {
            if (!$this->delete($id)) {
                throw new \RuntimeException('La suppression a échoué.');
            }
            return $this->affectedRows();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function getIndicateurPerformanceByIdActions($idAction)
    {

        $indicateurs = $this->select('idIndicateurAction,indicateurperformanceactions.libelle, valeur_de_ref, type_valeur, id_action, action.libelle as libaction ')
            ->asArray()
            ->join('action', 'action.idAction = indicateurperformanceactions.id_action')
            ->where(['id_action' => $idAction])
            ->findAll();
        return $indicateurs;
    }
}
