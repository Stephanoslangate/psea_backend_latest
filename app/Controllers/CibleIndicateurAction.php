<?php

namespace App\Controllers;

use App\Models\CibleIndicateurActionModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class CibleIndicateurAction extends BaseController
{
       /**
     * Get all CibleIndicateurAction
     * @return Response
     */
    public function index()
    {
        $model = new CibleIndicateurActionModel();
        return $this->getResponse(
            [
                'message' => 'CibleIndicateurActions retrieved',
                'CibleIndicateurActions' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new CibleIndicateurAction
     */
    public function store()
    {
        $rules = [
            'annee' => 'required',
            'valeur' => 'required',
            'idIndicateurAction' => 'required',

        ];
        
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $annee = $input['annee'];
        $model = new CibleIndicateurActionModel();
        $model->save($input);
        $cible = $model->where('annee', $annee)->first();

        return $this->getResponse(
            [
                'message' => 'CibleIndicateurAction added successfully',
                'CibleIndicateurAction' => $cible
            ]
        );
    }
}
