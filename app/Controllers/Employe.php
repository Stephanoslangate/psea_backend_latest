<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Employe extends BaseController
{
    /**
     * Get all Employe
     * @return Response
     */
    public function index()
    {
        $model = new EmployeModel();
        return $this->getResponse(
            [
                'message' => 'Employes retrieved',
                'Employes' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Employe
     */
    public function store()
    {
        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'fonction' => 'required',
            'contact' => 'required|min_length[9]',
            'idService' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $contact = $input['contact'];
        $model = new EmployeModel();
        $model->save($input);
        $employe = $model->where('contact', $contact)->first();

        return $this->getResponse(
            [
                'message' => 'Employe added successfully',
                'employe' => $employe
            ]
        );
    }
    /**
     * Get a single Employe by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new EmployeModel();
            $employe = $model->findEmployeById($id);

            return $this->getResponse(
                [
                    'message' => 'Employe retrieved successfully',
                    'employe' => $employe
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Employe for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Employe
     */
    public function update($id)
    {
        try {
            $model = new EmployeModel();
            $model->findEmployeById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $employe = $model->findEmployeById($id);

            return $this->getResponse(
                [
                    'message' => 'Employe updated successfully',
                    'employe' => $employe
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
     * Delete an existing Employe
     */
    public function destroy($id)
    {
        try {
            $model = new EmployeModel();
            $employe = $model->findEmployeById($id);
            $model->delete($employe);

            return $this->getResponse(
                [
                    'message' => 'Employe deleted successfully',
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
