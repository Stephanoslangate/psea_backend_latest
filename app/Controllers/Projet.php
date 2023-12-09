<?php

namespace App\Controllers;

use App\Models\ProjetModel;
// use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Projet extends BaseController
{

    /**
     * Get all Projet
     * @return Response
     */
    public function index()
    {
        $model = new ProjetModel();
        return $this->getResponse(
            [
                'message' => 'Projets retrieved',
                'Projets' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Projet
     */
    public function store()
    {
        $rules = [
            'nomProjet' => 'required|min_length[6]',
            'budgetAlloue'  => 'required',
            'date_debut'  => 'trim|required|valid_date',
            'date_fin'  => 'trim|required|valid_date',
            'idProg' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $input['created_at'] = date('Y-m-d H:i:s');
        $nomProjet = $input['nomProjet'];
        $model = new ProjetModel();
        $model->save($input);
        $projet = $model->where('nomProjet', $nomProjet)->first();

        return $this->getResponse(
            [
                'message' => 'Projet added successfully',
                'projet' => $projet
            ]
        );
    }
    /**
     * Get a single Projet by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ProjetModel();
            $projet = $model->findProjetById($id);

            return $this->getResponse(
                [
                    'message' => 'Projet retrieved successfully',
                    'projet' => $projet
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Projet for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Projet
     */
    public function update($id)
    {
        try {
            $model = new ProjetModel();
            $model->findProjetById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $projet = $model->findProjetById($id);

            return $this->getResponse(
                [
                    'message' => 'Projet updated successfully',
                    'projet' => $projet
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
     * Delete an existing Projet
     */
    public function destroy($id)
    {
        try {
            $model = new ProjetModel();
            $projet = $model->findProjetById($id);
            $model->delete($projet);

            return $this->getResponse(
                [
                    'message' => 'Projet deleted successfully',
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
