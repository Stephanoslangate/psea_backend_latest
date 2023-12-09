<?php

namespace App\Controllers;

use App\Models\UserProgrammeModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class UserProgramme extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function all()
    {
        $model = new UserProgrammeModel();
        $data = $model->findAll();
        return $this->getResponse($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($idUser = null, $idprog = null)
    {
        $model = new UserProgrammeModel();
        $data = $model->getWhere(['idUser' => $idUser, 'idProgramme' => $idprog])->getResult();
        if ($data) {
            return $this->getResponse($data);
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Programme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        try {
            $model = new UserProgrammeModel();
            $data = [
                'idUser' => $this->request->getVar('idUser'),
                'idProgramme' => $this->request->getVar('idProgramme'),
                'actif' => $this->request->getVar('actif')
            ];
            $model->insert($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Donnée enregistrée avec succés'
                ]
            ];
            return $this->getResponse($response);
        } catch (Exception $th) {
            return $this->getResponse(
                [
                    'message' => $th->getMessage()
                ],
                ResponseInterface::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($idUser = null, $idprog = null)
    {
        try {
            $model = new UserProgrammeModel();
            $newup = $model->findUserProgrammeByIdProgrammeAndIdUser($idUser, $idprog);
            $input = $this->getRequestInput($this->request);
            $data = [
                'actif' => $input['actif']
            ];
            $model->update($newup['id'], $data);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Tache modifiée avec succés'
                ]
            ];
            return $this->getResponse($response);
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
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($idUser = null, $idprog = null)
    {
        $model = new UserProgrammeModel();
        $data = $model->findUserProgrammeByIdProgrammeAndIdUser($idUser, $idprog);
        if ($data) {
            $model->delete($data['id']);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Supprimée avec succés'
                ]
            ];
            return $this->getResponse($response);
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find UserProgramme for specified IDs'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function GetUserProgrammes($idUser)
    {
        $model = new UserProgrammeModel();
        $data = $model->findUserProgrammeByIdUser($idUser)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'UserProgrammes retrieved',
                    'UserProgrammes' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Programme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function GetProgrammeUsers($idProgramme, $idUser)
    {
    }
}
