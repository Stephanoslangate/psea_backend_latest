<?php

namespace App\Controllers;

use App\Models\IndicateurPerformanceModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class IndicateurPerformance extends BaseController
{
    /**
     * Get all IndicateurPerformance
     * @return Response
     */
    public function index()
    {
        $model = new IndicateurPerformanceModel();
        return $this->getResponse(
            [
                'message' => 'IndicateurPerformances retrieved',
                'IndicateurPerformances' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new IndicateurPerformance
     */
    public function store()
    {
        $rules = [
            'indice' => 'required',
            'commentaire' => 'required',
            'etat' => 'required',
            'date_debut'  => 'trim|required|valid_date',
            'idProg' => 'required', 
            'idProjet' => 'required',            
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
        $indice = $input['indice'];
        $model = new IndicateurPerformanceModel();
        $model->save($input);
        $indicateurPerformance = $model->where('indice', $indice)->first();

        return $this->getResponse(
            [
                'message' => 'IndicateurPerformance added successfully',
                'indicateurPerformance' => $indicateurPerformance
            ]
        );
    }
    /**
     * Get a single IndicateurPerformance by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new IndicateurPerformanceModel();
            $indicateurPerformance = $model->findIndicateurPerformanceById($id);

            return $this->getResponse(
                [
                    'message' => 'IndicateurPerformance retrieved successfully',
                    'indicateurPerformance' => $indicateurPerformance
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find IndicateurPerformance for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing IndicateurPerformance
     */
    public function update($id)
    {
        try {
            $model = new IndicateurPerformanceModel();
            $model->findIndicateurPerformanceById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $indicateurPerformance = $model->findIndicateurPerformanceById($id);

            return $this->getResponse(
                [
                    'message' => 'IndicateurPerformance updated successfully',
                    'indicateurPerformance' => $indicateurPerformance
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
        $id = intval($input['idIndictateur']);
        try {
            $model = new IndicateurPerformanceModel();
            $model->findIndicateurPerformanceById($id);
            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $indicateur = $model->findIndicateurPerformanceById($id);

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
            $model = new IndicateurPerformanceModel();
            $indicateurPerformance = $model->findIndicateurPerformanceById($id);
            $idA = intval($id);
            if($indicateurPerformance){
                $model->deleteIndicateur($idA);
            }else{
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
}
