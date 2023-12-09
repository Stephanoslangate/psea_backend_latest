<?php

namespace App\Controllers;

use App\Models\ActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Activite extends BaseController
{
    /**
     * Get all Activite
     * @return Response
     */
    public function index()
    {
        $model = new ActiviteModel();
        return $this->getResponse(
            [
                'message' => 'Activites retrieved',
                'Activites' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Activite
     */
    public function store()
    {//'',''
        $rules = [
            'libelle' => 'required',
            'date'  => 'trim|required|valid_date',
            'idAction' => 'required',
            'budgetEtat' => 'required',
            'budgetPtf' => 'required',
           // 'idFaitGen' => 'required',
           // 'idMod' => 'required',
           // 'idMaillon' => 'required',
           //'delais' => 'required',
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
        $model = new ActiviteModel();
        $model->save($input);
        $activite = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'Activite added successfully',
                'activite' => $activite
            ]
        );
    }
    /**
     * Get a single Activite by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new ActiviteModel();
            $activite = $model->findActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'Activite retrieved successfully',
                    'activite' => $activite
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Activite for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Activite
     */
    public function update($id)
    {
        try {
            $model = new ActiviteModel();
            $model->findActiviteById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $activite = $model->findActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'Activite updated successfully',
                    'activite' => $activite
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
        $id = intval($input['idActivite']);
        try {
            $model = new ActiviteModel();
            $model->findActiviteById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $activite = $model->findActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'activite updated successfully',
                    'activite' => $activite
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

    public function etat($id)
    {
        try {
            $model = new ActiviteModel();
            $proce = $model->findActiviteById($id);
            $input = $this->getRequestInput($this->request);
            $idv = intval($input['etat']); 
            $proce['etat']=$idv;
            $model->update($id, $proce);
            $activite = $model->findActiviteById($id);

            return $this->getResponse(
                [
                    'message' => 'Activite updated successfully',
                    'activite' => $activite
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
     * Delete an existing Activite
     */
    public function destroy($id)
    {
        try {
            $model = new ActiviteModel();
            $activite = $model->findActiviteById($id);
            $idA = intval($id);
            if($activite){
                $model->deleteActivite($idA);
            }else{
                return $this->failNotFound('Sorry! no Activite found');
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
    public function activitesProcedure($id = null)
    {
        $model = new ActiviteModel();
       // $data = $model->getWhere(['idTache' => $id])->getResult();
        $data = $model->findActivitesProcedureById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Activites retrieved',
                    'Activites' => $data
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
