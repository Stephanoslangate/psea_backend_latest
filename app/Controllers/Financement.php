<?php

namespace App\Controllers;


use App\Models\FinancementModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Financement extends BaseController
{
    /**
     * Get all Financement
     * @return Response
     */
    public function index()
    {
        $model = new FinancementModel();
        return $this->getResponse(
            [
                'message' => 'Financements retrieved',
                'Financements' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Financement
     */
    public function store()
    {
        $rules = [
            'nature' => 'required|min_length[4]',
            'date_debut'  => 'trim|required|valid_date',
            'date_fin'  => 'trim|required|valid_date',
            'idDepense' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $nature = $input['nature'];
        $model = new FinancementModel();
        $model->save($input);
        $financement = $model->where('nature', $nature)->first();

        return $this->getResponse(
            [
                'message' => 'Financement added successfully',
                'financement' => $financement
            ]
        );
    }
    /**
     * Get a single Financement by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new FinancementModel();
            $financement = $model->findFinancementById($id);

            return $this->getResponse(
                [
                    'message' => 'Financement retrieved successfully',
                    'financement' => $financement
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Financement for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Financement
     */
    public function update($id)
    {
        try {
            $model = new FinancementModel();
            $model->findFinancementById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $financement = $model->findFinancementById($id);

            return $this->getResponse(
                [
                    'message' => 'Financement updated successfully',
                    'financement' => $financement
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
     * Delete an existing Financement
     */
    public function destroy($id)
    {
        try {
            $model = new FinancementModel();
            $financement = $model->findFinancementById($id);
            $model->delete($financement);

            return $this->getResponse(
                [
                    'message' => 'Financement deleted successfully',
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
