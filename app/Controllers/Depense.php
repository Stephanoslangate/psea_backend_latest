<?php

namespace App\Controllers;

use App\Models\DepenseModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Depense extends BaseController
{
    /**
     * Get all Depense
     * @return Response
     */
    public function index()
    {
        $model = new DepenseModel();
        return $this->getResponse(
            [
                'message' => 'Depenses retrieved',
                'Depenses' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Depense
     */
    public function store()
    {
        $rules = [
            'natureDepense' => 'required',
            'idProg' => 'required',
            'actemodif' => 'required',  
            'lfi' => 'required',  
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $natureDepense = $input['natureDepense'];
        $model = new DepenseModel();
        $model->save($input);
        $depense = $model->where('natureDepense', $natureDepense)->first();

        return $this->getResponse(
            [
                'message' => 'Depense added successfully',
                'depense' => $depense
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
            $model = new DepenseModel();
            $depense = $model->findDepenseById($id);

            return $this->getResponse(
                [
                    'message' => 'Depense retrieved successfully',
                    'depense' => $depense
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
            $model = new DepenseModel();
            $model->findDepenseById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $depense = $model->findDepenseById($id);

            return $this->getResponse(
                [
                    'message' => 'Depense updated successfully',
                    'depense' => $depense
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
            $model = new DepenseModel();
            $depense = $model->findDepenseById($id);
            $model->delete($depense);

            return $this->getResponse(
                [
                    'message' => 'Depense deleted successfully',
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
