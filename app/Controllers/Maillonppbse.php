<?php

namespace App\Controllers;


use App\Models\MaillonppbseModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Maillonppbse extends BaseController
{
    /**
     * Get all Maillonppbse
     * @return Response
     */
    public function index()
    {
        $model = new MaillonppbseModel();
        return $this->getResponse(
            [
                'message' => 'Maillonppbses retrieved',
                'Maillonppbses' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Maillonppbse
     */
    public function store()
    {
        $rules = [
            'nom' => 'required|is_unique[maillonppbse.nom]',
            'code' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $nom = $input['nom'];
        $model = new MaillonppbseModel();
        $model->save($input);
        $maillonppbse = $model->where('nom', $nom)->first();

        return $this->getResponse(
            [
                'message' => 'Maillonppbse added successfully',
                'maillonppbse' => $maillonppbse
            ]
        );
    }
    /**
     * Get a single Maillonppbse by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new MaillonppbseModel();
            $maillonppbse = $model->findMaillonppbseById($id);

            return $this->getResponse(
                [
                    'message' => 'Maillonppbse retrieved successfully',
                    'maillonppbse' => $maillonppbse
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Maillonppbse for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Maillonppbse
     */
    public function update($id)
    {
        try {
            $model = new MaillonppbseModel();
            $model->findMaillonppbseById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $maillonppbse = $model->findMaillonppbseById($id);

            return $this->getResponse(
                [
                    'message' => 'Maillonppbse updated successfully',
                    'maillonppbse' => $maillonppbse
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
        $id = intval($input['idMaillon']);
        try {
            $model = new MaillonppbseModel();
            $model->findMaillonppbseById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $maillon = $model->findMaillonppbseById($id);

            return $this->getResponse(
                [
                    'message' => 'maillon updated successfully',
                    'maillon' => $maillon
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
     * Delete an existing Maillonppbse
     */
    public function destroy($id)
    {
        try {
            $model = new MaillonppbseModel();
            $maillonppbse = $model->findMaillonppbseById($id);
            $idA = intval($id);
            if($maillonppbse){
                $model->deleteMaillon($idA);
            }else{
                return $this->failNotFound('Sorry! no Maillon found');
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
