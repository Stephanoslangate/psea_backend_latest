<?php

namespace App\Controllers;

use App\Models\SourceModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class Source extends BaseController
{
    /**
     * Get all Source
     * @return Response
     */
    public function index()
    {
        $model = new SourceModel();
        return $this->getResponse(
            [
                'message' => 'Sources retrieved',
                'Sources' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Source
     */
    public function store()
    {
        $rules = [
            'nomSource' => 'required',
            'idFinancement' => 'required',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }
       // $input['created_at'] = date('Y-m-d H:i:s');
        $nomSource = $input['nomSource'];
        $model = new SourceModel();
        $model->save($input);
        $source = $model->where('nomSource', $nomSource)->first();

        return $this->getResponse(
            [
                'message' => 'Source added successfully',
                'source' => $source
            ]
        );
    }
    /**
     * Get a single Source by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new SourceModel();
            $source = $model->findSourceById($id);

            return $this->getResponse(
                [
                    'message' => 'Source retrieved successfully',
                    'source' => $source
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Source for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing Source
     */
    public function update($id)
    {
        try {
            $model = new SourceModel();
            $source->findSourceById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $source = $model->findSourceById($id);

            return $this->getResponse(
                [
                    'message' => 'Source updated successfully',
                    'source' => $source
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
     * Delete an existing Source
     */
    public function destroy($id)
    {
        try {
            $model = new SourceModel();
            $source = $model->findSourceById($id);
            $model->delete($source);

            return $this->getResponse(
                [
                    'message' => 'Source deleted successfully',
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
