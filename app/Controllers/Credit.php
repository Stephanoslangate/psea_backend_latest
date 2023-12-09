<?php

namespace App\Controllers;

use App\Models\CreditModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Credit extends BaseController
{
    /**
     * Get all Credit
     * @return Response
     */
    public function index()
    {
        $model = new CreditModel();
        return $this->getResponse(
            [
                'message' => 'Credits retrieved',
                'Credits' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Credit
     */
    public function store()
    {

        $rules = [
            'nomCredit' => 'required|min_length[2]|is_unique[credit.nomCredit]',
            'idAction' => 'required',
            'idActivite' => 'required',
            'idProg' => 'required',             
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
        //$input['created_at'] = date('Y-m-d H:i:s');
        $nomCredit = $input['nomCredit'];
        $model = new CreditModel();
        $model->save($input);
        $credit = $model->where('nomCredit', $nomCredit)->first();

        return $this->getResponse(
            [
                'message' => 'Credit added successfully',
                'credit' => $credit
            ]
        );
    }
    /**
     * Get a single Credit by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new CreditModel();
            $credit = $model->findCreditById($id);

            return $this->getResponse(
                [
                    'message' => 'Credit retrieved successfully',
                    'credit' => $credit
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Credit not find Resultat for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Credit
     */
    public function update($id)
    {
        try {
            $model = new CreditModel();
            $model->findCreditById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $credit = $model->findCreditById($id);

            return $this->getResponse(
                [
                    'message' => 'Credit updated successfully',
                    'credit' => $credit
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
     * Delete an existing Credit
     */
    public function destroy($id)
    {
        try {
            $model = new CreditModel();
            $credit = $model->findCreditById($id);
            $model->delete($credit);

            return $this->getResponse(
                [
                    'message' => 'Credit deleted successfully',
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
