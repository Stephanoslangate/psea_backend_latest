<?php

namespace App\Controllers;

use App\Models\CibleModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Cible extends BaseController
{
        /**
     * Get all Cible
     * @return Response
     */
    public function index()
    {
        $model = new CibleModel();
        return $this->getResponse(
            [
                'message' => 'Cibles retrieved',
                'Cibles' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Cible
     */
    public function store()
    {
        $rules = [
            'nomCible' => 'required|min_length[2]',
            'idProg' => 'required',
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
        $nomCible = $input['nomCible'];
        $model = new CibleModel();
        $model->save($input);
        $cible = $model->where('nomCible', $nomCible)->first();

        return $this->getResponse(
            [
                'message' => 'Cible added successfully',
                'cible' => $cible
            ]
        );
    }
    /**
     * Get a single Cible by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new CibleModel();
            $cible = $model->findCibleById($id);

            return $this->getResponse(
                [
                    'message' => 'Cible retrieved successfully',
                    'cible' => $cible
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Cible for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Cible
     */
    public function update($id)
    {
        try {
            $model = new CibleModel();
            $model->findCibleById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $cible = $model->findCibleById($id);

            return $this->getResponse(
                [
                    'message' => 'Cible updated successfully',
                    'cible' => $cible
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
     * Delete an existing Cible
     */
    public function destroy($id)
    {
        try {
            $model = new CibleModel();
            $cible = $model->findCibleById($id);
            $model->delete($cible);

            return $this->getResponse(
                [
                    'message' => 'Cible deleted successfully',
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
