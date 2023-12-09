<?php

namespace App\Controllers;


use App\Models\DocumentReferenceModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
class DocumentReference extends BaseController
{
        /**
     * Get all DocumentReference
     * @return Response
     */
    public function index()
    {
        $model = new DocumentReferenceModel();
        return $this->getResponse(
            [
                'message' => 'DocumentReferences retrieved',
                'DocumentReferences' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new DocumentReference
     */
    public function store()
    {
        $rules = [
            'nomDocument' => 'required|min_length[2]',
            'sourceDocument'  => 'required',
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
        $nomDocument = $input['nomDocument'];
        $model = new DocumentReferenceModel();
        $model->save($input);
        $documentReference = $model->where('nomDocument', $nomDocument)->first();

        return $this->getResponse(
            [
                'message' => 'DocumentReference added successfully',
                'documentReference' => $documentReference
            ]
        );
    }
    /**
     * Get a single DocumentReference by ID
     */
    public function show($id)
    {
        $id = intval($id);

        try {
            $model = new DocumentReferenceModel();
            $documentReference = $model->findDocumentReferenceById($id);

            return $this->getResponse(
                [
                    'message' => 'DocumentReference retrieved successfully',
                    'documentReference' => $documentReference
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find DocumentReference for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update an existing DocumentReference
     */
    public function update($id)
    {
        try {
            $model = new DocumentReferenceModel();
            $model->findDocumentReferenceById($id);

            $input = $this->getRequestInput($this->request);

            $model->update($id, $input);
            $documentReference = $model->findDocumentReferenceById($id);

            return $this->getResponse(
                [
                    'message' => 'DocumentReference updated successfully',
                    'documentReference' => $documentReference
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
     * Delete an existing DocumentReference
     */
    public function destroy($id)
    {
        try {
            $model = new DocumentReferenceModel();
            $documentReference = $model->findDocumentReferenceById($id);
            $model->delete($documentReference);

            return $this->getResponse(
                [
                    'message' => 'DocumentReference deleted successfully',
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
