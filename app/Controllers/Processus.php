<?php

namespace App\Controllers;

use App\Models\ProcessusModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Processus extends BaseController
{
    /**
     * Get all Processus
     * @return Response
     */
    public function index()
    {
        $model = new ProcessusModel();
        return $this->getResponse(
            [
                'message' => 'Processus retrieved',
                'Processus' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Processus
     */
    public function store()
    {

        $rules = [
            'libelle' => 'required|min_length[6]',
            'version' => 'required',
            'idProg' => 'required',             
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $libelle = $input['libelle'];
        $input['etat'] = 0;
        $model = new ProcessusModel();
        $model->save($input);
        $processus = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Processus added successfully',
                'processus' => $processus
            ]
        );
    }
    /**
     * Get a single Processus by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ProcessusModel();
            $processus = $model->findProcessusById($id);

            return $this->getResponse(
                [
                    'message' => 'Processus retrieved successfully',
                    'processus' => $processus
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Processus for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Processus
     */
    public function update($id)
    {
        try {
            $model = new ProcessusModel();
            $model->findProcessusById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $processus = $model->findProcessusById($id);

            return $this->getResponse(
                [
                    'message' => 'Processus updated successfully',
                    'processus' => $processus
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

    public function etat($id)
    {
        try {
            $model = new ProcessusModel();
            $proce = $model->findProcessusById($id);
            $input = $this->getRequestInput($this->request);
            $idv = intval($input['etat']); 
            $proce['etat']=$idv;
            $model->update($id, $proce);
            $processus = $model->findProcessusById($id);

            return $this->getResponse(
                [
                    'message' => 'Processus updated successfully',
                    'processus' => $processus
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
     * Delete an existing Processus
     */
    public function destroy($id)
    {
        try {
            $model = new ProcessusModel();
            $processus = $model->findProcessusById($id);
            $model->delete($processus);

            return $this->getResponse(
                [
                    'message' => 'Processus deleted successfully',
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
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function processusProg($id = null)
    {
        $model = new ProcessusModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findProcessusProgrammeById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Processus retrieved',
                    'Processus' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Processus for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
