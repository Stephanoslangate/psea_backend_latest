<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Service extends BaseController
{
    /**
     * Get all Service
     * @return Response
     */
    public function index()
    {
        $model = new ServiceModel();
        return $this->getResponse(
            [
                'message' => 'Services retrieved',
                'Services' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Service
     */
    public function store()
    {
        $rules = [
            'nomService' => 'required|min_length[2]|is_unique[service.nomService]',
            'idStruct' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $nomService = $input['nomService'];
        $model = new ServiceModel();
        $model->save($input);
        $service = $model->where('nomService', $nomService)->first();

        return $this->getResponse(
            [
                'message' => 'Service added successfully',
                'service' => $service
            ]
        );
    }
    /**
     * Get a single Service by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ServiceModel();
            $service = $model->findServiceById($id);

            return $this->getResponse(
                [
                    'message' => 'Service retrieved successfully',
                    'service' => $service
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Service for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Service
     */
    public function update($id)
    {
        try {
            $model = new ServiceModel();
            $model->findServiceById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $service = $model->findServiceById($id);

            return $this->getResponse(
                [
                    'message' => 'Service updated successfully',
                    'service' => $service
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

    public function edit()
    {
        $input = $this->getRequestInput($this->request);
        $id = intval($input['idService']);
        try {

            $model = new ServiceModel();
            $model->findServiceById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $service = $model->findServiceById($id);

            return $this->getResponse(
                [
                    'message' => 'Service updated successfully',
                    'service' => $service
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
     * Delete an existing Service
     */
    public function destroy($id)
    {
        try {
            $model = new ServiceModel();
            $service = $model->findServiceById($id);
            $idS = intval($id);
            if($service){
                $model->deleteService($idS);
            }else{
                return $this->failNotFound('Sorry! no Service found');
            }
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
