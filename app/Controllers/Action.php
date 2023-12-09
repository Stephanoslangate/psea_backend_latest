<?php

namespace App\Controllers;

use App\Models\ActionModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Action extends BaseController
{
    
    /**
     * Get all Action
     * @return Response
     */
    public function index()
    {
        $model = new ActionModel();
        return $this->getResponse(
            [
                'message' => 'Actions retrieved',
                'Actions' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Action
     */
    public function store()
    {

        $rules = [
            'libelle' => 'required',
            /*   'delais' => 'required',
            'date'  => 'trim|required|valid_date', */
            'idProg' => 'required', 
            /*   'idIndictateur' => 'required',  */           
            'version' => 'required',            

        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        $input['date'] = date('Y-m-d H:i:s');
        $input['created_at'] = date('Y-m-d H:i:s');
        $libelle = $input['libelle'];
        $model = new ActionModel();
        $model->save($input);
        $action = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Action added successfully',
                'action' => $action
            ]
        );
    }
    /**
     * Get a single Action by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ActionModel();
            $action = $model->findActionById($id);

            return $this->getResponse(
                [
                    'message' => 'Action retrieved successfully',
                    'action' => $action
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Action for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Action
     */
    public function update($id)
    {
        try {
            $model = new ActionModel();
            $model->findActionById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $action = $model->findActionById($id);

            return $this->getResponse(
                [
                    'message' => 'Action updated successfully',
                    'action' => $action
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
        $id = intval($input['idAction']);
        try {
            $model = new ActionModel();
            $model->findActionById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $action = $model->findActionById($id);

            return $this->getResponse(
                [
                    'message' => 'Action updated successfully',
                    'action' => $action
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
     * Delete an existing Action
     */
    public function destroy($id)
    {
        try {
            $model = new ActionModel();
            $action = $model->findActionById($id);
            $idA = intval($id);
            if($action){
                $model->deleteAction($idA);
            }else{
                return $this->failNotFound('Sorry! no student found');
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
    public function actionProg($id = null)
    {
        $model = new ActionModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findActionsProgrammeById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Actions retrieved',
                    'Actions' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Processus for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
