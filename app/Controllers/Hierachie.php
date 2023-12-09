<?php

namespace App\Controllers;

use App\Models\HierachieModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Hierachie extends BaseController
{
    /**
     * Get all HierachieModel
     * @return Response
     */
    public function index()
    {
        $model = new HierachieModel();
        return $this->getResponse(
            [
                'message' => 'Hierachies retrieved',
                'Hierachies' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new HierachieModel
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required',
            'si_effectifpre' => 'required',
            'si_montantpre' => 'required',  
            'si_effectin' => 'required',
            'si_montantn' => 'required',
            'si_montantpre' => 'required',
            'ef_effectin' => 'required', 
            'ef_montantn' => 'required',  
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $input['created_at'] = date('Y-m-d H:i:s');
        $natureDepense = $input['libelle'];
        $model = new HierachieModel();
        $model->save($input);
        $depense = $model->where('libelle', $natureDepense)->first();

        return $this->getResponse(
            [
                'message' => 'Hierachies added successfully',
                'Hierachies' => $depense
            ]
        );
    }
    /**
     * Get a single Hierachie by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new HierachieModel();
            $depense = $model->findHierachieById($id);

            return $this->getResponse(
                [
                    'message' => 'Hierachies retrieved successfully',
                    'Hierachies' => $depense
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Hierachie for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Hierachie
     */
    public function update($id)
    {
        try {
            $model = new HierachieModel();
            $model->findHierachieById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $depense = $model->findHierachieById($id);

            return $this->getResponse(
                [
                    'message' => 'Hierachies updated successfully',
                    'Hierachies' => $depense
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
     * Delete an existing Depense
     */
    public function destroy($id)
    {
        try {
            $model = new HierachieModel();
            $depense = $model->findHierachieById($id);
            $model->delete($depense);

            return $this->getResponse(
                [
                    'message' => 'Hierachie deleted successfully',
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
