<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentReferenceModel extends Model
{
    protected $table            = 'documentreference';
    protected $primaryKey       = 'idDocument';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomDocument','sourceDocument','idActivite'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findDocumentReferenceById($id)
    {
        $documentReference = $this
            ->asArray()
            ->where(['idDocument' => $id])
            ->first();

        if (!$documentReference) throw new Exception('Could not find DocumentReference for specified ID');

        return $documentReference;
    }
}
