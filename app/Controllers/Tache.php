<?php

namespace App\Controllers;

use App\Models\TacheModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Tache extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function all()
    {
        $model = new TacheModel();
        return $this->getResponse(
            [
                'message' => 'Taches retrieved',
                'Taches' => $model->findAll()
            ]
        );
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new TacheModel();
        $data = $model->getWhere(['idTache' => $id])->getResult();
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
            $model = new TacheModel();
            $data = [
                'libelle' => $this->request->getVar('libelle'),
                'description' => $this->request->getVar('description'),
                'pourcentage' => $this->request->getVar('pourcentage'),
                'validee' => $this->request->getVar('validee'),
                'idSousActivite' => $this->request->getVar('idSousActivite'),
                'trimestre' => $this->request->getVar('trimestre')
            ];
            $model->insert($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Tache enregistrée avec succés'
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
    public function update($id = null)
    {
        try {
            $model = new TacheModel();
            $input = $this->getRequestInput($this->request);

            $data = [
                'libelle' => $input['libelle'],
                'description' => $input['description'],
                'pourcentage' => $input['pourcentage'],
                'validee' => $input['validee']
            ];
            $model->update($id, $data);
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
    public function delete($id = null)
    {
        $model = new TacheModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Tache supprimée avec succés'
                ]
            ];
            return $this->getResponse($response);
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Programme for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function etat($id)
    {
        try {
            $model = new TacheModel();
            $proce = $model->find($id);
            $input = $this->getRequestInput($this->request);
            $proce['validee']=$input['validee'];
            $proce['updated_at'] = date('Y-m-d H:i:s');
            $model->update($id, $proce);
            $tache = $model->find($id);

            return $this->getResponse(
                [
                    'message' => 'Tache updated successfully',
                    'Tache' => $tache
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
    public function tachesSousAct($id = null)
    {
        $model = new TacheModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findTachesSousActivite($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Taches retrieved',
                    'Taches' => $data
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
}
