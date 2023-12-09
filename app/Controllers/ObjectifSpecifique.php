<?php

namespace App\Controllers;

use App\Models\ObjectifSpecifiqueModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class ObjectifSpecifique extends BaseController
{
    /**
     * Get all ObjectifSpecifique
     * @return Response
     */
    public function index()
    {
        $model = new ObjectifSpecifiqueModel();
        return $this->getResponse(
            [
                'message' => 'ObjectifSpecifiques retrieved',
                'ObjectifSpecifiques' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new ObjectifSpecifique
     */
    public function store()
    {
        $rules = [
            'missionObjectifSpe'  => 'required',
            'idObj' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $missionObjectifSpe = $input['missionObjectifSpe'];
        $model = new ObjectifSpecifiqueModel();
        $model->save($input);
        $objectifSpecifique = $model->where('missionObjectifSpe', $missionObjectifSpe)->first();

        return $this->getResponse(
            [
                'message' => 'ObjectifSpecifique added successfully',
                'objectifSpecifique' => $objectifSpecifique
            ]
        );
    }
    /**
     * Get a single ObjectifSpecifique by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ObjectifSpecifiqueModel();
            $objectifSpecifique = $model->findObjectifSpecifiqueById($id);

            return $this->getResponse(
                [
                    'message' => 'ObjectifSpecifique retrieved successfully',
                    'objectifSpecifique' => $objectifSpecifique
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find ObjectifSpecifique for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing ObjectifSpecifique
     */
    public function update($id)
    {
        try {
            $model = new ObjectifSpecifiqueModel();
            $model->findObjectifSpecifiqueById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $objectifSpecifique = $model->findObjectifSpecifiqueById($id);

            return $this->getResponse(
                [
                    'message' => 'ObjectifSpecifique updated successfully',
                    'objectifSpecifique' => $objectifSpecifique
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
     * Delete an existing ObjectifSpecifique
     */
    public function destroy($id)
    {
        try {
            $model = new ObjectifSpecifiqueModel();
            $objectifSpecifique = $model->findObjectifSpecifiqueById($id);
            $model->delete($objectifSpecifique);

            return $this->getResponse(
                [
                    'message' => 'ObjectifSpecifique deleted successfully',
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
