<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Objectif extends BaseController
{
    /**
     * Get all Objectif
     * @return Response
     */
    public function index()
    {
        $model = new ObjectifModel();
        return $this->getResponse(
            [
                'message' => 'Objectifs retrieved',
                'Objectifs' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Objectif
     */
    public function store()
    {
        $rules = [
            'nomObjectif' => 'required|is_unique[objectif.nomObjectif]',
            'type' => 'required',
            'idProg' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $nomObjectif = $input['nomObjectif'];
        $model = new ObjectifModel();
        $model->save($input);
        $objectif = $model->where('nomObjectif', $nomObjectif)->first();

        return $this->getResponse(
            [
                'message' => 'Objectif added successfully',
                'objectif' => $objectif
            ]
        );
    }
    /**
     * Get a single Objectif by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ObjectifModel();
            $objectif = $model->findObjectifById($id);

            return $this->getResponse(
                [
                    'message' => 'Objectif retrieved successfully',
                    'objectif' => $objectif
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Objectif for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Objectif
     */
    public function update($id)
    {
        try {
            $model = new ObjectifModel();
            $model->findObjectifById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $objectif = $model->findObjectifById($id);

            return $this->getResponse(
                [
                    'message' => 'Objectif updated successfully',
                    'objectif' => $objectif
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
        $id = intval($input['idObj']);
        try {
            $model = new ObjectifModel();
            $model->findObjectifById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $objectif = $model->findObjectifById($id);

            return $this->getResponse(
                [
                    'message' => 'Objectif updated successfully',
                    'Objectif' => $objectif
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
     * Delete an existing Objectif
     */
    public function destroy($id)
    {
        try {
            $model = new ObjectifModel();
            $objectif = $model->findObjectifById($id);
            $idA = intval($id);
            if($objectif){
                $model->deleteObjectif($idA);
            }else{
                return $this->failNotFound('Sorry! no Objectif found');
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

     /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function objectifForProg($id = null)
    {
        $model = new ObjectifModel();
        $data = $model->findObjectifsProgById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Objectifs retrieved',
                    'Objectifs' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Activites for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
