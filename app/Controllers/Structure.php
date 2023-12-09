<?php

namespace App\Controllers;

use App\Models\StructureModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Structure extends BaseController
{
    /**
     * Get all Structure
     * @return Response
     */
    public function index()
    {
        $model = new StructureModel();
        return $this->getResponse(
            [
                'message' => 'Structures retrieved',
                'Structures' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Structure
     */
    public function store()
    {
        $rules = [
            'nomStruct' => 'required|min_length[3]|is_unique[structure.nomStruct]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $nomStruct = $input['nomStruct'];
        $model = new StructureModel();
        $model->save($input);
        $structure = $model->where('nomStruct', $nomStruct)->first();

        return $this->getResponse(
            [
                'message' => 'Structure added successfully',
                'structure' => $structure
            ]
        );
    }
    /**
     * Get a single Structure by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new StructureModel();
            $structure = $model->findStructureById($id);

            return $this->getResponse(
                [
                    'message' => 'Structure retrieved successfully',
                    'structure' => $structure
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Structure for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Structure
     */
    public function update($id)
    {
        try {
            $model = new StructureModel();
            $model->findStructureById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $structure = $model->findStructureById($id);

            return $this->getResponse(
                [
                    'message' => 'Structure updated successfully',
                    'structure' => $structure
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

    public function edit()
    {
        $input = $this->getRequestInput($this->request);
        $id = intval($input['idStruct']);
        try {

            $model = new StructureModel();
            $model->findStructureById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $structure = $model->findStructureById($id);

            return $this->getResponse(
                [
                    'message' => 'Structure updated successfully',
                    'Structure' => $structure
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
     * Delete an existing Structure
     */
    public function destroy($id)
    {
        try {
            $model = new StructureModel();
            $structure = $model->findStructureById($id);
            $idS = intval($id);
            if($structure){
                $model->deleteStructure($idS);
            }else{
                return $this->failNotFound('Sorry! no Structure found');
            }
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
