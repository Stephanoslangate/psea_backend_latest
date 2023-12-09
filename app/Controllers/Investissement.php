<?php

namespace App\Controllers;

use App\Models\InvestissementModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Investissement extends BaseController
{
    /**
     * Get all Investissement
     * @return Response
     */
    public function index()
    {
        $model = new InvestissementModel();
        return $this->getResponse(
            [
                'message' => 'Investissements retrieved',
                'Investissements' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Investissement
     */
    public function store()
    {
        $rules = [
            'nomInvestissement' => 'required|min_length[3]',
            'montantInvestissement' => 'required',
            'cibleInvestissement' => 'required|min_length[3]',
            'origineInvestissement' => 'required|min_length[3]',
            'date_validation'  => 'trim|required|valid_date',
            'idProg' => 'required',  
            'idFinancement' => 'required',  
            'idProjet' => 'required',            
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $nomInvestissement = $input['nomInvestissement'];
        $model = new InvestissementModel();
        $model->save($input);
        $investissement = $model->where('nomInvestissement', $nomInvestissement)->first();

        return $this->getResponse(
            [
                'message' => 'Investissement added successfully',
                'investissement' => $investissement
            ]
        );
    }
    /**
     * Get a single Investissement by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new InvestissementModel();
            $investissement = $model->findInvestissementById($id);

            return $this->getResponse(
                [
                    'message' => 'Investissement retrieved successfully',
                    'investissement' => $investissement
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Investissement for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Investissement
     */
    public function update($id)
    {
        try {
            $model = new InvestissementModel();
            $model->findInvestissementById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $investissement = $model->findInvestissementById($id);

            return $this->getResponse(
                [
                    'message' => 'Investissement updated successfully',
                    'investissement' => $investissement
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
     * Delete an existing Investissement
     */
    public function destroy($id)
    {
        try {
            $model = new InvestissementModel();
            $investissement = $model->findInvestissementById($id);
            $model->delete($investissement);

            return $this->getResponse(
                [
                    'message' => 'Investissement deleted successfully',
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
}
