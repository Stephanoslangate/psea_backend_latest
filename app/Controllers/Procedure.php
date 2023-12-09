<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Procedure extends BaseController
{
    /**
     * Get all Procedure
     * @return Response
     */
    public function index()
    {
        $model = new ProcedureModel();
        return $this->getResponse(
            [
                'message' => 'Procedures retrieved',
                'Procedures' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Procedure
     */
    public function store()
    {

        $rules = [
            'reference' => 'required|min_length[2]',
            'libelle' => 'required',
            'datemiseajour'  => 'trim|required|valid_date',
            'idProcessus' => 'required',             
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $reference = $input['reference'];
        $input['etat'] = 0;
        $model = new ProcedureModel();
        $model->save($input);
        $procedure = $model->where('reference', $reference)->first();

        return $this->getResponse(
            [
                'message' => 'Procedure added successfully',
                'procedure' => $procedure
            ]
        );
    }
    /**
     * Get a single Procedure by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ProcedureModel();
            $procedure = $model->findProcedureById($id);

            return $this->getResponse(
                [
                    'message' => 'Procedure retrieved successfully',
                    'procedure' => $procedure
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Procedure for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Procedure
     */
    public function update($id)
    {
        try {
            $model = new ProcedureModel();
            $model->findProcedureById($id);

            $input = $this->getRequestInput($this->request);
           // $input['reference'];
            $model->update($id, $input);
            $procedure = $model->findProcedureById($id);

            return $this->getResponse(
                [
                    'message' => 'Procedure updated successfully',
                    'procedure' => $procedure
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
     * Update an existing Procedure
     */
    public function etat($id)
    {
        try {
            $model = new ProcedureModel();
            $proce = $model->findProcedureById($id);
            $input = $this->getRequestInput($this->request);
            $idv = intval($input['etat']); 
            $proce['etat']=$idv;
            $model->update($id, $proce);
            $procedure = $model->findProcedureById($id);

            return $this->getResponse(
                [
                    'message' => 'Procedure updated successfully',
                    'procedure' => $procedure
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
     * Delete an existing Procedure
     */
    public function destroy($id)
    {
        try {
            $model = new ProcedureModel();
            $procedure = $model->findProcedureById($id);
            $model->delete($procedure);

            return $this->getResponse(
                [
                    'message' => 'Procedure deleted successfully',
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
    public function proceduresProc($id = null)
    {
        $model = new ProcedureModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findProcessusProcedureById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Procedures retrieved',
                    'Procedures' => $data
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
