<?php

namespace App\Controllers;

use App\Models\VersionModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Version extends BaseController
{
    /**
     * Get all Version
     * @return Response
     */
    public function index()
    {
        $model = new VersionModel();
        return $this->getResponse(
            [
                'message' => 'Versions retrieved',
                'Versions' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Version
     */
    public function store()
    {
        $rules = [
            'nomVers' => 'required|min_length[2]',
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
        $nomVers = $input['nomVers'];
        $model = new VersionModel();
        $model->save($input);
        $version = $model->where('nomVers', $nomVers)->first();

        return $this->getResponse(
            [
                'message' => 'Version added successfully',
                'version' => $version
            ]
        );
    }
    /**
     * Get a single Version by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new VersionModel();
            $version = $model->findVersionById($id);

            return $this->getResponse(
                [
                    'message' => 'Version retrieved successfully',
                    'version' => $version
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Version for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Version
     */
    public function update($id)
    {
        try {
            $model = new VersionModel();
            $model->findVersionById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $version = $model->findVersionById($id);

            return $this->getResponse(
                [
                    'message' => 'Version updated successfully',
                    'version' => $version
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
     * Delete an existing Version
     */
    public function destroy($id)
    {
        try {
            $model = new VersionModel();
            $version = $model->findVersionById($id);
            $model->delete($version);

            return $this->getResponse(
                [
                    'message' => 'Version deleted successfully',
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
