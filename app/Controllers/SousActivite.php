<?php

namespace App\Controllers;

use App\Models\SousActiviteModel;
use App\Models\UserSousActiviteModel;
use App\Models\UserModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class SousActivite extends BaseController
{

        /**
     * Get all SousActivite
     * @return Response
     */
    public function index()
    {
        $model = new SousActiviteModel();
        return $this->getResponse(
            [
                'message' => 'SousActivites retrieved',
                'SousActivites' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new SousActivite
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required|min_length[2]',
            'chronogramme' => 'required|min_length[2]',
            'etatbudget'  => 'required',
            'bailleur'  => 'required',
            'idActivite' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $libelle = $input['libelle'];
        $input['etat'] = 0;
        $model = new SousActiviteModel();
        $model->save($input);
        $sousActivite = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'SousActivite added successfully',
                'sousActivite' => $sousActivite
            ]
        );
    }
    /**
     * Get a single SousActivite by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new SousActiviteModel();
            $sousActivite = $model->findSousActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'SousActivite retrieved successfully',
                    'sousActivite' => $sousActivite
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find SousActivite for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    /**
     * Get a single SousActivite by ID
     */
    public function sousActiveService($id)
    {
        $id = intval($id);

        try {
            $model = new SousActiviteModel();
            $sousActivite = $model->findSousActiviteServiceById($id)->getResult();;

            return $this->getResponse(
                [
                    'message' => 'SousActivite retrieved successfully',
                    'sousActivite' => $sousActivite
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find SousActivite for specified IDService'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing SousActivite
     */
    public function update($id)
    {
        try {
            $model = new SousActiviteModel();
            $model->findSousActiviteById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $sousActivite = $model->findSousActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'SousActivite updated successfully',
                    'sousActivite' => $sousActivite
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
     * Delete an existing SousActivite
     */
    public function destroy($id)
    {
        try {
            $model = new SousActiviteModel();
            $sousActivite = $model->findSousActiviteById($id);
            $model->delete($sousActivite);

            return $this->getResponse(
                [
                    'message' => 'SousActivite deleted successfully',
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
     * Update service an existing User
     */
    public function SAService()
    {
        try {
            $input = $this->getRequestInput($this->request);
            $id = intval($input['idSousActiv']); 
            $idService = intval($input['idService']); 

            $model = new SousActiviteModel();
            $sousActivite = $model->findSousActiviteById($id);

            $sousActivite['idService']=$idService;
            $model->update($id, $sousActivite);
            $sousActivites = $model->findSousActiviteById($id);
            //////////
            $model1 = new UserModel();
            $users = $model1->findAll();
            $taille = count($users);
            for($i=0;$i<$taille;$i++) {
                if($users[$i]['idService']==$idService){
                    $model2 = new UserSousActiviteModel();
                    $data = [
                        'idUser' => $users[$i]['id'],
                        'idSousActiv' => $id,
                        'actif' => 0
                    ];
                    $model2->insert($data);
                }
            }
            ///////////
            return $this->getResponse(
                [
                    'message' => 'SousActivite updated successfully',
                    'SousActivite' => $sousActivites
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
    public function SAIndicateur()
    {
        try {
            $input = $this->getRequestInput($this->request);
            $id = intval($input['idSousActiv']); 
            $idIndictateur = intval($input['idIndictateur']); 

            $model = new SousActiviteModel();
            $sousActivite = $model->findSousActiviteById($id);

            $sousActivite['idIndictateur']=$idIndictateur;
            $model->update($id, $sousActivite);
            $sousActivites = $model->findSousActiviteById($id);
            /////////
            return $this->getResponse(
                [
                    'message' => 'SousActivite updated successfully',
                    'SousActivite' => $sousActivites
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
     * Sous activity for Activity id
     * @return mixed
     */
    public function sousActivity($id = null)
    {
        $model = new SousActiviteModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findSousActivitiesActiviteById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'SousActivites retrieved',
                    'SousActivites' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find SousActivites for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    
}
