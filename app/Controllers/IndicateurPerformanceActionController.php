<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IndicateurPerformanceActionModel;


class IndicateurPerformanceActionController extends BaseController
{
    public function liste()
    {
        try {
            $IndicateurPerformanceActionModel = new IndicateurPerformanceActionModel();
            $cibleIndicateurActions = $IndicateurPerformanceActionModel->getAllIndicateurPerformanceActions();
            return $this->getResponse(
                [
                    'status' => 200,
                    'data' => $cibleIndicateurActions
                ]
            );
        } catch (\Exception $e) {
            return $this->getResponse(
                [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Une erreur interne s\'est produite lors de la récupération des cibles indicateur actions.'

                ]
            );
        }
    }
    public function create()
    {
        $indicateurPerformanceActionModel = new IndicateurPerformanceActionModel();

        try {
            $data = $this->request->getPost();

            $id = $indicateurPerformanceActionModel->createIndicateurPerformanceAction($data);
            return $this->getResponse(['id' => $id, 'message' => 'Cible Indicateur Action créé avec succès.']);

        } catch (\Exception $e) {
            return $this->getResponse([
                'status' => 500,
                'error' => true,
                'messages' => 'Une erreur inattendue s\'est produite.'

            ]);
        }
    }
    public function update($id = null)
    {
        $indicateurPerformanceActionModel = new IndicateurPerformanceActionModel();

        try {
            if ($id === null) {
                return $this->getResponse([
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Pas d\'ID spécifié'

                ]);
            }

            $inputData = $this->request->getRawInput();
            $data = [
                'libelle' => $inputData['libelle'] ?? null,
                'valeur' => $inputData['valeur'] ?? null,
                'valeur_de_ref' => $inputData['valeur_de_ref'] ?? null,
                'id_action' => $inputData['id_action'] ?? null,
                'type_valeur' => $inputData['type_valeur'] ?? null,
            ];

            $indicateurPerformanceActionModel->updateIndicateurPerformanceAction($id, $data);

            $response = [
                'id' => $id,
                'message' => 'Cible Indicateur Action mise à jour avec succès.'
            ];
            return $this->getResponse($response);
        } catch (\Exception $e) {
            return $this->getResponse([
                'status' => 500,
                'error' => true,
                'messages' => 'Une erreur inattendue s\'est produite lors de la mise à jour.'

            ]);
        }
    }
    public function delete($id = null)
    {
        $indicateurPerformanceActionModel = new IndicateurPerformanceActionModel();

        try {
            if ($id === null) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Pas d\'ID spécifié'

                ];
                return $response;
            }
            if ($indicateurPerformanceActionModel->deleteIndicateurPerformanceAction($id)) {
                $response = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Cible Indicateur Action supprimée avec succès.'

                ];
            } else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'message' => 'Aucune cible indicateur action trouvée avec l\'ID ' . $id

                ];
            }
            return $this->getResponse($response);

        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => 'Une erreur inattendue s\'est produite lors de la suppression.'

            ];
            return $this->getResponse($response);
        }
    }
    public function show($id = null)
    {
        $indicateurPerformanceActionModel = new IndicateurPerformanceActionModel();

        try {
            // Vérifiez que l'ID est fourni.
            if ($id === null) {
                return $this->getResponse([
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Pas d\'ID spécifié'

                ]);
            }

            // Récupérer l'indicateur de performance à partir du modèle en utilisant l'ID.
            $indicateurPerformanceAction = $indicateurPerformanceActionModel->find($id);

            // Vérifiez si l'indicateur de performance existe.
            if (!$indicateurPerformanceAction) {
                return $this->getResponse([
                    'status' => 500,
                    'error' => true,
                    'message' => 'Indicateur de performance pour l\'action non trouvé avec l\'ID ' . $id

                ]);
            }

            // Renvoyez la réponse avec l'indicateur de performance.
            return $this->getResponse($indicateurPerformanceAction);
        } catch (\Exception $e) {
            // Log de l'erreur pour le débogage interne.
            log_message('error', 'Exception dans show: ' . $e->getMessage());
            // Renvoyez une erreur serveur interne.
            return $this->getResponse([
                'status' => 500,
                'error' => true,
                'message' => 'Exception dans show: ' . $e->getMessage()

            ]);
        }
    }
    public function getByIdAction($idAction)
    {


        try {
            $indicateurPerformanceActionModel = new IndicateurPerformanceActionModel();
            $liste_indic = $indicateurPerformanceActionModel->getIndicateurPerformanceByIdActions($idAction);
            return $this->getResponse(
                [
                    'status' => 200,
                    'data' => $liste_indic
                ]
            );
        } catch (\Exception $e) {
            return $this->getResponse(
                [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'Une erreur interne s\'est produite lors de la récupération des indicateur actions.'

                ]
            );
        }
    }
}
