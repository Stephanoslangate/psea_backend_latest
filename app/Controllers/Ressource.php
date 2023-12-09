<?php

namespace App\Controllers;

use App\Models\RessourceModel;
// use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Ressource extends BaseController
{
    /**
     * Get all Ressource
     * @return Response
     */
    public function index()
    {
        $model = new RessourceModel();
        return $this->getResponse(
            [
                'message' => 'Ressources retrieved',
                'Ressources' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Ressource
     */
    public function store()
    {
        $rules = [
            'typeRessource' => 'required|min_length[6]',
            'zoneIntervention'  => 'required',
            'idFinancement' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $typeRessource = $input['typeRessource'];
        $model = new RessourceModel();
        $model->save($input);
        $ressource = $model->where('typeRessource', $typeRessource)->first();

        return $this->getResponse(
            [
                'message' => 'Ressource added successfully',
                'ressource' => $ressource
            ]
        );
    }
    /**
     * Get a single Ressource by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new RessourceModel();
            $ressource = $model->findRessourceById($id);

            return $this->getResponse(
                [
                    'message' => 'Ressource retrieved successfully',
                    'ressource' => $ressource
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Ressource for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Ressource
     */
    public function update($id)
    {
        try {
            $model = new RessourceModel();
            $model->findRessourceById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $ressource = $model->findRessourceById($id);

            return $this->getResponse(
                [
                    'message' => 'Ressource updated successfully',
                    'ressource' => $ressource
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
     * Delete an existing Ressource
     */
    public function destroy($id)
    {
        try {
            $model = new RessourceModel();
            $ressource = $model->findRessourceById($id);
            $model->delete($ressource);

            return $this->getResponse(
                [
                    'message' => 'Ressource deleted successfully',
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
