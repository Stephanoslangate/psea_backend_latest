<?php

namespace App\Controllers;

use App\Models\ProgrammeModel;
// use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Programme extends BaseController
{
    /**
     * Get all Programme
     * @return Response
     */
    public function index()
    {
        $model = new ProgrammeModel();
        return $this->getResponse(
            [
                'message' => 'Programmes retrieved',
                'Programmes' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Programme
     */
    public function store()
    {

        $rules = [
            'nomProg' => 'required|min_length[6]',
            'idType' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $input['created_at'] = date('Y-m-d H:i:s');
        $nomProg = $input['nomProg'];
        $input['etat'] = 0;
        $model = new ProgrammeModel();
        $model->save($input);
        $programme = $model->where('nomProg', $nomProg)->first();

        return $this->getResponse(
            [
                'message' => 'Programme added successfully',
                'programmes' => $programme
            ]
        );
    }
    /**
     * Get a single Programme by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ProgrammeModel();
            $programme = $model->findProgrammeById($id);

            return $this->getResponse(
                [
                    'message' => 'Programme retrieved successfully',
                    'programme' => $programme
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Programme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Programme
     */
    public function update($id)
    {
        try {
            $model = new ProgrammeModel();
            $model->findProgrammeById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $programme = $model->findProgrammeById($id);

            return $this->getResponse(
                [
                    'message' => 'Programme updated successfully',
                    'programme' => $programme
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
            $model = new ProgrammeModel();
            $proce = $model->findProgrammeById($id);
            $input = $this->getRequestInput($this->request);
            $idv = intval($input['etat']); 
            $proce['etat']=$idv;
            $model->update($id, $proce);
            $programme = $model->findProgrammeById($id);

            return $this->getResponse(
                [
                    'message' => 'Programme updated successfully',
                    'programme' => $programme
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
     * Delete an existing Programme
     */
    public function destroy($id)
    {
        try {
            $model = new ProgrammeModel();
            $programme = $model->findProgrammeById($id);
            $model->delete($programme);

            return $this->getResponse(
                [
                    'message' => 'Programme deleted successfully',
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
