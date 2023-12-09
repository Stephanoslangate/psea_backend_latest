<?php

namespace App\Models;

use CodeIgniter\Model;

class IndicateurActiviteModel extends Model
{
    protected $table            = 'indicateuractivites';
    protected $primaryKey       = 'idIndicateurActivite';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['libelle','valeur_de_ref','idActivite','type_valeur','realisation'];

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
            ->where(['idIndicateurActivite' => $id])
            ->first();
        if (!$indicateur) throw new Exception('Could not find IndicateurActivite for specified ID');

        return $indicateur;
    }
    public function deleteIndicateur($idIndictateur){
        $this->where('idIndicateurActivite', $idIndictateur)->delete();
    }
    public function findActivitesActeursById($id)
    {
        $indicateur = $this
            ->asArray()
            ->where(['idActivite' => $id])
            ->get();

        if (!$indicateur) throw new Exception('Could not find Indicateurs for specified ID');

        return $indicateur;
    }
    
    public function createIndicateurPerformanceActivite($data)
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
    public function getIndicateurPerformanceActiviteById($id)
    {
        try {
            $indicateurPerformanceActivite = $this->find($id);
            if (!$indicateurPerformanceActivite) {
                throw new \RuntimeException('Aucun indicateur de performance activité trouvé avec cet ID.');
            }
            return $indicateurPerformanceActivite;
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }

    public function getAllIndicateurPerformanceActivites()
    {
        try {
            return $this->findAll();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            throw $e;
        }
    }
    public function updateIndicateurPerformanceActivite($id, $data)
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
    public function deleteIndicateurPerformanceActivite($id)
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
    public function getIndicateurPerformanceByIdActivites($idAction)
    {

        $indicateurs = $this->select('idIndicateurActivite,indicateuractivites.libelle, valeur_de_ref, type_valeur, idActivite, activite.libelle as libaction ')
            ->asArray()
            ->join('activite', 'activite.idActivite = indicateuractivites.idActivite')
            ->where(['idActivite' => $idAction])
            ->findAll();
        return $indicateurs;
    }
}
