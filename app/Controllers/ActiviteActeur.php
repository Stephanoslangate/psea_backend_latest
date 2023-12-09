<?php

namespace App\Controllers;

use App\Models\ActiviteActeurModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class ActiviteActeur extends BaseController
{
    /**
     * Get all ActiviteActeur
     * @return Response
     */
    public function index()
    {
        $model = new ActiviteActeurModel();
        return $this->getResponse(
            [
                'message' => 'ActiviteActeurs retrieved',
                'ActiviteActeurs' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new ActiviteActeur
     */
    public function store()
    {
        $rules = [
            'commentaire' => 'required',
            'dateeffective'  => 'trim|required|valid_date',
            'idActeur' => 'required',
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
        $commentaire = $input['commentaire'];
        $model = new ActiviteActeurModel();
        $model->save($input);
        $activiteActeur = $model->where('commentaire', $commentaire)->first();

        return $this->getResponse(
            [
                'message' => 'ActiviteActeur added successfully',
                'activiteActeur' => $activiteActeur
            ]
        );
    }
    /**
     * Get a single ActiviteActeur by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ActiviteActeurModel();
            $activiteActeur = $model->findActiviteActeurById($id);

            return $this->getResponse(
                [
                    'message' => 'ActiviteActeur retrieved successfully',
                    'activiteActeur' => $activiteActeur
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find ActiviteActeur for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing ActiviteActeur
     */
    public function update($id)
    {
        try {
            $model = new ActiviteActeurModel();
            $model->findActiviteActeurById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $activiteActeur = $model->findActiviteActeurById($id);

            return $this->getResponse(
                [
                    'message' => 'ActiviteActeur updated successfully',
                    'activiteActeur' => $activiteActeur
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
     * Delete an existing ActiviteActeur
     */
    public function destroy($id)
    {
        try {
            $model = new ActiviteActeurModel();
            $activiteActeur = $model->findActiviteActeurById($id);
            $model->delete($activiteActeur);

            return $this->getResponse(
                [
                    'message' => 'ActiviteActeur deleted successfully',
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
