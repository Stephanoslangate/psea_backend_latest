<?php

namespace App\Controllers;

use App\Models\UserSousActiviteModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class UserSousActivite extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function all()
    {
        $model = new UserSousActiviteModel();
        $data = $model->findAll();
        return $this->getResponse($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($idUser = null,$idSousActivite = null)
    {
        $model = new UserSousActiviteModel();
        $data = $model->getWhere(['idUser' => $idUser, 'idProgramme' => $idSousActivite])->getResult();
        if($data){
            return $this->getResponse($data);
        }else{
            return $this->getResponse(
                [
                    'message' => 'No Data Found with id '.$idUser.'and'.$idSousActivite
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
            $model = new UserSousActiviteModel();
            $data = [
                'idUser' => $this->request->getVar('idUser'),
                'idSousActiv' => $this->request->getVar('idSousActivite'),
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
    public function update($idUser = null,$idSousActivite = null)
    {
        try {
            $model = new UserSousActiviteModel();
            $newup = $model->findUserSousActByIdSousActiviteAndIdUser($idUser,$idSousActivite);
            $input = $this->request->getRawInput();
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
        } catch (Exception $th) {
            return $this->getResponse(
                [
                    'message' => $th->getMessage()
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
    public function delete($idUser = null,$idSousActivite = null)
    {
        $model = new UserSousActiviteModel();
        $data = $model->findUserSousActByIdSousActiviteAndIdUser($idUser,$idSousActivite);
        if($data){
            $model->delete($data['id']);
            $response = [
                'status'   => 200,
                'error'    => null, 
                'messages' => [
                    'success' => 'Supprimée avec succés'
                ]
            ];
            return $this->getResponse($response);
        }else{
            return $this->getResponse(
                [
                    'message' => 'Could not find userSousActivité for specified IDs'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function GetUserSousActivites($idUser, $idSousActivite){

    }
    public function GetSousActiviteUsers($idSousActivite, $idUser){
        
    }
}
