<?php

namespace App\Controllers;


use App\Models\LivrableModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Livrable extends BaseController
{
    /**
     * Get all Livrable
     * @return Response
     */
    public function index()
    {
        $model = new LivrableModel();
        return $this->getResponse(
            [
                'message' => 'Livrables retrieved',
                'Livrables' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Livrable
     */
    public function store()
    {
        $rules = [
            'nomLivrable' => 'required|min_length[2]',
            'date_emission'  => 'trim|required|valid_date',
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
        $nomLivrable = $input['nomLivrable'];
        $model = new LivrableModel();
        $model->save($input);
        $livrable = $model->where('nomLivrable', $nomLivrable)->first();

        return $this->getResponse(
            [
                'message' => 'Livrable added successfully',
                'livrable' => $livrable
            ]
        );
    }
    /**
     * Get a single Livrable by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new LivrableModel();
            $livrable = $model->findLivrableById($id);

            return $this->getResponse(
                [
                    'message' => 'Livrable retrieved successfully',
                    'livrable' => $livrable
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Livrable for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Livrable
     */
    public function update($id)
    {
        try {
            $model = new LivrableModel();
            $model->findLivrableById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $livrable = $model->findLivrableById($id);

            return $this->getResponse(
                [
                    'message' => 'Livrable updated successfully',
                    'livrable' => $livrable
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
     * Delete an existing Livrable
     */
    public function destroy($id)
    {
        try {
            $model = new LivrableModel();
            $livrable = $model->findLivrableById($id);
            $model->delete($livrable);

            return $this->getResponse(
                [
                    'message' => 'Livrable deleted successfully',
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
