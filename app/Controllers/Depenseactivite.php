<?php

namespace App\Controllers;

use App\Models\DepenseActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Depenseactivite extends BaseController
{
    /**
     * Get all DepenseActiviteModel
     * @return Response
     */
    public function index()
    {
        $model = new DepenseActiviteModel();
        return $this->getResponse(
            [
                'message' => 'DepenseActivites retrieved',
                'DepenseActivites' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Depense
     */
    public function store()
    {
        $rules = [
            'nature' => 'required',
            'ae_ouvert' => 'required',
            'ae_execute' => 'required',  
            'cp_ouvert' => 'required',
            'cp_execute' => 'required',
            'justification' => 'required',
            'idActivite' => 'required',  
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $natureDepense = $input['nature'];
        $model = new DepenseActiviteModel();
        $model->save($input);
        $depense = $model->where('nature', $natureDepense)->first();

        return $this->getResponse(
            [
                'message' => 'DepenseActivite added successfully',
                'DepenseActivite' => $depense
            ]
        );
    }
    /**
     * Get a single Depense by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new DepenseActiviteModel();
            $depense = $model->findDepenseActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'DepenseActivite retrieved successfully',
                    'DepenseActivite' => $depense
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Depense for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Depense
     */
    public function update($id)
    {
        try {
            $model = new DepenseActiviteModel();
            $model->findDepenseActiviteById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $depense = $model->findDepenseActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'DepenseActivite updated successfully',
                    'DepenseActivite' => $depense
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
            $model = new DepenseActiviteModel();
            $depense = $model->findDepenseActiviteById($id);
            $model->delete($depense);

            return $this->getResponse(
                [
                    'message' => 'DepenseActivite deleted successfully',
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
