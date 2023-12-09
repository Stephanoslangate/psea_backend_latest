<?php

namespace App\Controllers;

use App\Models\IndicateurActiviteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class IndicateurActivite extends BaseController
{
   /**
     * Get all IndicateurPerformanceAction
     * @return Response
     */
    public function index()
    {
        $model = new IndicateurActiviteModel();
        return $this->getResponse(
            [
                'message' => 'IndicateurActivites retrieved',
                'IndicateurActivites' => $model->findAll()
            ]
        );
    }
    /**
     * Create a new IndicateurActiviteModel
     */
    public function store()
    {
        $rules = [
            'libelle' => 'required',
            'valeur_de_ref' => 'required',
            'idActivite' => 'required',
            'type_valeur' => 'required', 
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
        $model = new IndicateurActiviteModel();
        $model->save($input);
        $indicateurPerformance = $model->where('libelle', $libelle)->first();

        return $this->getResponse(
            [
                'message' => 'IndicateurPerformance added successfully',
                'indicateurPerformance' => $indicateurPerformance
            ]
        );
    }
    public function edit()
    {
        $input = $this->getRequestInput($this->request);
        $id = intval($input['idIndictateur']);
        try {
            $model = new IndicateurActiviteModel();
            $model->findIndicateurById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $indicateur = $model->findIndicateurById($id);

            return $this->getResponse(
                [
                    'message' => 'indicateur updated successfully',
                    'indicateur' => $indicateur
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
     * Delete an existing IndicateurPerformance
     */
    public function destroy($id)
    {
        try {
            $model = new IndicateurActiviteModel();
            $indicateurPerformance = $model->findIndicateurById($id);
            $idA = intval($id);
            if ($indicateurPerformance) {
                $model->deleteIndicateur($idA);
            } else {
                return $this->failNotFound('Sorry! no Indicateur found');
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
    public function activiteIndicateurs($id = null)
    {
        $model = new IndicateurActiviteModel();
        $data = $model->findActivitesActeursById($id)->getResult();
        
        if ($data) {
            return $this->getResponse(
                [
                    'message' => 'Indicateur retrieved',
                    'Indicateurs' => $data
                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Could not find Indicateurs for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
