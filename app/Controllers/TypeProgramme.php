<?php

namespace App\Controllers;

use App\Models\TypeProgrammeModel;
// use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class TypeProgramme extends BaseController
{
    /**
     * Get all TypeProgramme
     * @return Response
     */
    public function index()
    {
        $model = new TypeProgrammeModel();
        return $this->getResponse(
            [
                'message' => 'TypeProgrammes retrieved',
                'typeProgrammes' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new TypeProgramme
     */
    public function store()
    {
        $rules = [
            'nomTypeProg' => 'required|min_length[6]|is_unique[typeprogramme.nomTypeProg]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $nomTypeProg = $input['nomTypeProg'];
        $model = new TypeProgrammeModel();
        $model->save($input);
        $typeProgramme = $model->where('nomTypeProg', $nomTypeProg)->first();

        return $this->getResponse(
            [
                'message' => 'TypeProgramme added successfully',
                'typeProgrammes' => $typeProgramme
            ]
        );
    }
    /**
     * Get a single TypeProgramme by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new TypeProgrammeModel();
            $typeProgramme = $model->findTypeProgrammeById($id);

            return $this->getResponse(
                [
                    'message' => 'TypeProgramme retrieved successfully',
                    'typeProgramme' => $typeProgramme
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find TypeProgramme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Get a single TypeProgramme by Type
     */
    public function findType()
    {
        try {
            $model = new TypeProgrammeModel();
            $rules = [
                'nomTypeProg' => 'required',
            ];
    
            $input = $this->getRequestInput($this->request);
    
            if (!$this->validateRequest($input, $rules)) {
                return $this->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
            }
    
            $nomTypeProg = $input['nomTypeProg'];
            $typeProgramme = $model->findTypeProgrammeByNomType($nomTypeProg);

            return $this->getResponse(
                [
                    'message' => 'TypeProgramme retrieved successfully',
                    'typeProgramme' => $typeProgramme
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find TypeProgramme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing TypeProgramme
     */
    public function update($id)
    {
        try {
            $model = new TypeProgrammeModel();
            $model->findTypeProgrammeById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $typeProgramme = $model->findTypeProgrammeById($id);

            return $this->getResponse(
                [
                    'message' => 'TypeProgramme updated successfully',
                    'typeProgramme' => $typeProgramme
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
     * Delete an existing TypeProgramme
     */
    public function destroy($id)
    {
        try {
            $model = new TypeProgrammeModel();
            $typeProgramme = $model->findTypeProgrammeById($id);
            $model->delete($typeProgramme);

            return $this->getResponse(
                [
                    'message' => 'TypeProgramme deleted successfully',
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
