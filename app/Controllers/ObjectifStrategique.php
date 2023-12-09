<?php

namespace App\Controllers;


use App\Models\ObjectifStrategiqueModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class ObjectifStrategique extends BaseController
{
    /**
     * Get all ObjectifStrategique
     * @return Response
     */
    public function index()
    {
        $model = new ObjectifStrategiqueModel();
        return $this->getResponse(
            [
                'message' => 'ObjectifStrategiques retrieved',
                'ObjectifStrategiques' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new ObjectifStrategique
     */
    public function store()
    {
        $rules = [
            'anneecible'  => 'trim|required|valid_date',
            'idObj' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $input['created_at'] = date('Y-m-d H:i:s');
        $anneecible = $input['anneecible'];
        $model = new ObjectifStrategiqueModel();
        $model->save($input);
        $objectifStrategique = $model->where('anneecible', $anneecible)->first();

        return $this->getResponse(
            [
                'message' => 'ObjectifStrategique added successfully',
                'objectifStrategique' => $objectifStrategique
            ]
        );
    }
    /**
     * Get a single ObjectifStrategique by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ObjectifStrategiqueModel();
            $objectifStrategique = $model->findObjectifStrategiqueById($id);

            return $this->getResponse(
                [
                    'message' => 'ObjectifStrategique retrieved successfully',
                    'objectifStrategique' => $objectifStrategique
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find ObjectifStrategique for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing ObjectifStrategique
     */
    public function update($id)
    {
        try {
            $model = new ObjectifStrategiqueModel();
            $model->findObjectifStrategiqueById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $objectifStrategique = $model->findObjectifStrategiqueById($id);

            return $this->getResponse(
                [
                    'message' => 'ObjectifStrategique updated successfully',
                    'objectifStrategique' => $objectifStrategique
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
     * Delete an existing ObjectifStrategique
     */
    public function destroy($id)
    {
        try {
            $model = new ObjectifStrategiqueModel();
            $objectifStrategique = $model->findObjectifStrategiqueById($id);
            $model->delete($objectifStrategique);

            return $this->getResponse(
                [
                    'message' => 'ObjectifStrategique deleted successfully',
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
