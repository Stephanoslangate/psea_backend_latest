<?php

namespace App\Models;

use CodeIgniter\Model;

class CibleIndicateurActionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cibleindicateuractions';
    protected $primaryKey       = 'idCibleIndicateurActions';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['annee','valeur','idIndicateurAction','justification','realisation'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}
