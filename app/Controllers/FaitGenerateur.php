<?php

namespace App\Controllers;

use App\Models\FaitGenerateurModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class FaitGenerateur extends BaseController
{
    /**
     * Get all FaitGenerateur
     * @return Response
     */
    public function index()
    {
        $model = new FaitGenerateurModel();
        return $this->getResponse(
            [
                'message' => 'FaitGenerateurs retrieved',
                'FaitGenerateurs' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new FaitGenerateur
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required|is_unique[faitgenerateur.libelle]',
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
        $model = new FaitGenerateurModel();
        $model->save($input);
        $faitGenerateur = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'FaitGenerateur added successfully',
                'faitGenerateur' => $faitGenerateur
            ]
        );
    }
    /**
     * Get a single FaitGenerateur by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new FaitGenerateurModel();
            $faitGenerateur = $model->findFaitGenerateurById($id);

            return $this->getResponse(
                [
                    'message' => 'FaitGenerateur retrieved successfully',
                    'faitGenerateur' => $faitGenerateur
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find FaitGenerateur for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing FaitGenerateur
     */
    public function update($id)
    {
        try {
            $model = new FaitGenerateurModel();
            $model->findFaitGenerateurById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $faitGenerateur = $model->findFaitGenerateurById($id);

            return $this->getResponse(
                [
                    'message' => 'FaitGenerateur updated successfully',
                    'faitGenerateur' => $faitGenerateur
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
        $id = intval($input['idFaitGen']);
        try {
            $model = new FaitGenerateurModel();
            $model->findFaitGenerateurById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $fait = $model->findFaitGenerateurById($id);

            return $this->getResponse(
                [
                    'message' => 'Fait updated successfully',
                    'Fait' => $fait
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
     * Delete an existing FaitGenerateur
     */
    public function destroy($id)
    {
        try {
            $model = new FaitGenerateurModel();
            $faitGenerateur = $model->findFaitGenerateurById($id);
            $idA = intval($id);
            if($faitGenerateur){
                $model->deleteFait($idA);
            }else{
                return $this->failNotFound('Sorry! no Fait found');
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
