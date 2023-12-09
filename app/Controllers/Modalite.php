<?php

namespace App\Controllers;

use App\Models\ModaliteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Modalite extends BaseController
{
    /**
     * Get all Modalite
     * @return Response
     */
    public function index()
    {
        $model = new ModaliteModel();
        return $this->getResponse(
            [
                'message' => 'Modalites retrieved',
                'Modalites' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Modalite
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required|is_unique[modalite.libelle]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $libelle = $input['libelle'];
        $model = new ModaliteModel();
        $model->save($input);
        $modalite = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Modalite added successfully',
                'modalite' => $modalite
            ]
        );
    }
    /**
     * Get a single Modalite by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ModaliteModel();
            $modalite = $model->findModaliteById($id);

            return $this->getResponse(
                [
                    'message' => 'Modalite retrieved successfully',
                    'modalite' => $modalite
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Modalite for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Modalite
     */
    public function update($id)
    {
        try {
            $model = new ModaliteModel();
            $model->findModaliteById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $modalite = $model->findModaliteById($id);

            return $this->getResponse(
                [
                    'message' => 'Modalite updated successfully',
                    'modalite' => $modalite
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
        $id = intval($input['idMod']);
        try {
            $model = new ModaliteModel();
            $model->findModaliteById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $modalite = $model->findModaliteById($id);

            return $this->getResponse(
                [
                    'message' => 'modalite updated successfully',
                    'modalite' => $modalite
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
     * Delete an existing Modalite
     */
    public function destroy($id)
    {
        try {
            $model = new ModaliteModel();
            $modalite = $model->findModaliteById($id);
            $idA = intval($id);
            if($modalite){
                $model->deleteModalite($idA);
            }else{
                return $this->failNotFound('Sorry! no Modalite found');
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
