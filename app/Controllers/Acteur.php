<?php

namespace App\Controllers;

use App\Models\ActeurModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Acteur extends BaseController
{
    /**
     * Get all Acteur
     * @return Response
     */
    public function index()
    {
        $model = new ActeurModel();
        return $this->getResponse(
            [
                'message' => 'Acteurs retrieved',
                'Acteurs' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Acteur
     */
    public function store()
    {
    
        $rules = [
            'typeActeur' => 'required',
            'idEmploye' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $typeActeur = $input['typeActeur'];
        $model = new ActeurModel();
        $model->save($input);
        $acteur = $model->where('typeActeur', $typeActeur)->first();

        return $this->getResponse(
            [
                'message' => 'Acteur added successfully',
                'acteur' => $acteur
            ]
        );
    }
    /**
     * Get a single Acteur by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ActeurModel();
            $acteur = $model->findActeurById($id);

            return $this->getResponse(
                [
                    'message' => 'Acteur retrieved successfully',
                    'acteur' => $acteur
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Acteur for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Acteur
     */
    public function update($id)
    {
        try {
            $model = new ActeurModel();
            $model->findActeurById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $acteur = $model->findActeurById($id);

            return $this->getResponse(
                [
                    'message' => 'Acteur updated successfully',
                    'acteur' => $acteur
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
     * Delete an existing Acteur
     */
    public function destroy($id)
    {
        try {
            $model = new ActeurModel();
            $acteur = $model->findActeurById($id);
            $model->delete($acteur);

            return $this->getResponse(
                [
                    'message' => 'Acteur deleted successfully',
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
