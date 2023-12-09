<?php

namespace App\Controllers;

use App\Models\ResultatModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Resultat extends BaseController
{
    /**
     * Get all Resultat
     * @return Response
     */
    public function index()
    {
        $model = new ResultatModel();
        return $this->getResponse(
            [
                'message' => 'Resultats retrieved',
                'Resultats' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Resultat
     */
    public function store()
    {

        $rules = [
            'nomResultat' => 'required|min_length[2]|is_unique[resultat.nomResultat]',
            'typeResultat' => 'required',
            'dateResultat'  => 'trim|required|valid_date',
            'idObjectifStra' => 'required',
            'idObjectifSpe' => 'required',
            'idAction' => 'required',             
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $nomResultat = $input['nomResultat'];
        $model = new ResultatModel();
        $model->save($input);
        $resultat = $model->where('nomResultat', $nomResultat)->first();

        return $this->getResponse(
            [
                'message' => 'Resultat added successfully',
                'resultat' => $resultat
            ]
        );
    }
    /**
     * Get a single Resultat by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ResultatModel();
            $resultat = $model->findResultatById($id);

            return $this->getResponse(
                [
                    'message' => 'Resultat retrieved successfully',
                    'resultat' => $resultat
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Resultat for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Resultat
     */
    public function update($id)
    {
        try {
            $model = new ResultatModel();
            $model->findResultatById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $resultat = $model->findResultatById($id);

            return $this->getResponse(
                [
                    'message' => 'Resultat updated successfully',
                    'resultat' => $resultat
                ]
            );
        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Delete an existing Resultat
     */
    public function destroy($id)
    {
        try {
            $model = new ResultatModel();
            $resultat = $model->findResultatById($id);
            $model->delete($resultat);

            return $this->getResponse(
                [
                    'message' => 'Resultat deleted successfully',
                ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function resultsAction($id = null)
    {
        $model = new ResultatModel();
        $data = $model->findResultatsActionById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Resultats retrieved',
                    'Resultats' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Resultats for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function edit()
    {
        $input = $this->getRequestInput($this->request);
        $id = intval($input['idResultat']);
        try {
            $model = new ResultatModel();
            $model->findResultatById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $resultat = $model->findResultatById($id);

            return $this->getResponse(
                [
                    'message' => 'resultat updated successfully',
                    'resultat' => $resultat
                ]
            );
        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
