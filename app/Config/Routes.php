<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * API
 * --------------------------------------------------------------------
 */
// $routes->resource();
$routes->add('register', 'API\User::register');
$routes->add('login', 'API\User::login');
$routes->post('reGenToken', 'API\Token::reGenToken');
$routes->get('userprogrammes/(:num)', 'UserProgramme::GetUserProgrammes/$1');

// $routes->resource('API/Client'); // Equivalent to the following:
$routes->get('client', 'Client::index', ['filter' => 'auth']);
$routes->post('client', 'Client::store', ['filter' => 'auth']);
$routes->get('client/(:num)', 'Client::show/$1', ['filter' => 'auth']);
$routes->put('client/(:num)', 'Client::update/$1', ['filter' => 'auth']);
$routes->delete('client/(:num)', 'Client::destroy/$1', ['filter' => 'auth']);

$routes->group('api', ['filter' => 'auth'], static function ($routes) {

  $routes->get('user', 'API\User::getUsers');
  $routes->post('user/service', 'API\User::update');
  $routes->get('user/service/(:num)', 'API\User::usersService/$1');

  // $routes->resource('API/Permission'); // Equivalent to the following:
  $routes->get('permission', 'Permission::index');
  $routes->post('permission', 'Permission::store');

  // $routes->resource('API/Role'); // Equivalent to the following:
  $routes->get('role', 'Role::index');
  $routes->post('role', 'Role::store');
  $routes->get('role/(:num)', 'Role::show/$1');
  $routes->put('role/(:num)', 'Role::update/$1');
  $routes->delete('role/(:num)', 'Role::destroy/$1');

  // $routes->resource('API/UserRole'); // Equivalent to the following:
  $routes->get('userRole', 'UserRole::index');
  $routes->post('userRole', 'UserRole::store');
  $routes->get('userRole/(:num)', 'UserRole::show/$1');
  $routes->put('userRole/(:num)', 'UserRole::update/$1');
  $routes->delete('userRole/(:num)', 'UserRole::destroy/$1');

  // $routes->resource('API/TypeProgramme'); // Equivalent to the following:
  $routes->get('typeProgramme', 'TypeProgramme::index');
  $routes->post('typeProgramme', 'TypeProgramme::store');
  $routes->get('typeProgramme/(:num)', 'TypeProgramme::show/$1');
  $routes->put('typeProgramme/(:num)', 'TypeProgramme::update/$1');
  $routes->delete('typeProgramme/(:num)', 'TypeProgramme::destroy/$1');

  $routes->post('typeProgrammes', 'TypeProgramme::findType');

  // $routes->resource('API/Programme'); // Equivalent to the following:
  $routes->get('programme', 'Programme::index');
  $routes->post('programme', 'Programme::store');
  $routes->get('programme/(:num)', 'Programme::show/$1');
  $routes->put('programme/(:num)', 'Programme::update/$1');
  $routes->post('programme/etat/(:num)', 'Programme::etat/$1');
  $routes->delete('programme/(:num)', 'Programme::destroy/$1');
  // $routes->resource('API/Projet'); // Equivalent to the following:
  $routes->get('projet', 'Projet::index');
  $routes->post('projet', 'Projet::store');
  $routes->get('projet/(:num)', 'Projet::show/$1');
  $routes->put('projet/(:num)', 'Projet::update/$1');
  $routes->delete('projet/(:num)', 'Projet::destroy/$1');

  // $routes->resource('API/Ressource'); // Equivalent to the following:
  $routes->get('ressource', 'Ressource::index');
  $routes->post('ressource', 'Ressource::store');
  $routes->get('ressource/(:num)', 'Ressource::show/$1');
  $routes->put('ressource/(:num)', 'Ressource::update/$1');
  $routes->delete('ressource/(:num)', 'Ressource::destroy/$1');

  // $routes->resource('API/Structure'); // Equivalent to the following:
  $routes->get('structure', 'Structure::index');
  $routes->post('structure', 'Structure::store');
  $routes->get('structure/(:num)', 'Structure::show/$1');
  $routes->put('structure/(:num)', 'Structure::update/$1');
  $routes->delete('structure/(:num)', 'Structure::destroy/$1');
  $routes->post('structures', 'Structure::edit');

  // $routes->resource('API/Service'); // Equivalent to the following:
  $routes->get('service', 'Service::index');
  $routes->post('service', 'Service::store');
  $routes->get('service/(:num)', 'Service::show/$1');
  $routes->put('service/(:num)', 'Service::update/$1');
  $routes->delete('service/(:num)', 'Service::destroy/$1');
  $routes->post('services', 'Service::edit');

  // $routes->resource('API/ObjectifSpecifique'); // Equivalent to the following:
  $routes->get('objectifSpecifique', 'ObjectifSpecifique::index');
  $routes->post('objectifSpecifique', 'ObjectifSpecifique::store');
  $routes->get('objectifSpecifique/(:num)', 'ObjectifSpecifique::show/$1');
  $routes->put('objectifSpecifique/(:num)', 'ObjectifSpecifique::update/$1');
  $routes->delete('objectifSpecifique/(:num)', 'ObjectifSpecifique::destroy/$1');

  // $routes->resource('API/ObjectifStrategique'); // Equivalent to the following:
  $routes->get('objectifStrategique', 'ObjectifStrategique::index');
  $routes->post('objectifStrategique', 'ObjectifStrategique::store');
  $routes->get('objectifStrategique/(:num)', 'ObjectifStrategique::show/$1');
  $routes->put('objectifStrategique/(:num)', 'ObjectifStrategique::update/$1');
  $routes->delete('objectifStrategique/(:num)', 'ObjectifStrategique::destroy/$1');

  // $routes->resource('API/Objectif'); // Equivalent to the following:
  $routes->get('objectif', 'Objectif::index');
  $routes->post('objectif', 'Objectif::store');
  $routes->get('objectif/(:num)', 'Objectif::show/$1');
  $routes->put('objectif/(:num)', 'Objectif::update/$1');
  $routes->delete('objectif/(:num)', 'Objectif::destroy/$1');
  $routes->get('objectifPro/(:num)', 'Objectif::objectifForProg/$1');
  $routes->post('objectifs', 'Objectif::edit');

  // $routes->resource('API/Modalite'); // Equivalent to the following:
  $routes->get('modalite', 'Modalite::index');
  $routes->post('modalite', 'Modalite::store');
  $routes->get('modalite/(:num)', 'Modalite::show/$1');
  $routes->put('modalite/(:num)', 'Modalite::update/$1');
  $routes->delete('modalite/(:num)', 'Modalite::destroy/$1');
  $routes->post('modalites', 'Modalite::edit');

  // $routes->resource('API/Acteur'); // Equivalent to the following:
  $routes->get('acteur', 'Acteur::index');
  $routes->post('acteur', 'Acteur::store');
  $routes->get('acteur/(:num)', 'Acteur::show/$1');
  $routes->put('acteur/(:num)', 'Acteur::update/$1');
  $routes->delete('acteur/(:num)', 'Acteur::destroy/$1');

  // $routes->resource('API/Maillonppbse'); // Equivalent to the following:
  $routes->get('maillonppbse', 'Maillonppbse::index');
  $routes->post('maillonppbse', 'Maillonppbse::store');
  $routes->get('maillonppbse/(:num)', 'Maillonppbse::show/$1');
  $routes->put('maillonppbse/(:num)', 'Maillonppbse::update/$1');
  $routes->delete('maillonppbse/(:num)', 'Maillonppbse::destroy/$1');
  $routes->post('maillonppbses', 'Maillonppbse::edit');

  // $routes->resource('API/Employe'); // Equivalent to the following:
  $routes->get('employe', 'Employe::index');
  $routes->post('employe', 'Employe::store');
  $routes->get('employe/(:num)', 'Employe::show/$1');
  $routes->put('employe/(:num)', 'Employe::update/$1');
  $routes->delete('employe/(:num)', 'Employe::destroy/$1');

  // $routes->resource('API/FaitGenerateur'); // Equivalent to the following:
  $routes->get('faitGenerateur', 'FaitGenerateur::index');
  $routes->post('faitGenerateur', 'FaitGenerateur::store');
  $routes->get('faitGenerateur/(:num)', 'FaitGenerateur::show/$1');
  $routes->put('faitGenerateur/(:num)', 'FaitGenerateur::update/$1');
  $routes->delete('faitGenerateur/(:num)', 'FaitGenerateur::destroy/$1');
  $routes->post('faitGenerateurs', 'FaitGenerateur::edit');

  // $routes->resource('API/Source'); // Equivalent to the following:
  $routes->get('source', 'Source::index');
  $routes->post('source', 'Source::store');
  $routes->get('source/(:num)', 'Source::show/$1');
  $routes->put('source/(:num)', 'Source::update/$1');
  $routes->delete('source/(:num)', 'Source::destroy/$1');


  // $routes->resource('API/Financement'); // Equivalent to the following:
  $routes->get('financement', 'Financement::index');
  $routes->post('financement', 'Financement::store');
  $routes->get('financement/(:num)', 'Financement::show/$1');
  $routes->put('financement/(:num)', 'Financement::update/$1');
  $routes->delete('financement/(:num)', 'Financement::destroy/$1');

  // here $routes->resource('API/Action'); // Equivalent to the following:
  $routes->get('action', 'Action::index');
  $routes->post('action', 'Action::store');
  $routes->get('action/(:num)', 'Action::show/$1');
  $routes->put('action/(:num)', 'Action::update/$1');
  $routes->delete('action/(:num)', 'Action::destroy/$1');
  $routes->post('actions', 'Action::edit');

  // $routes->resource('API/Cible'); // Equivalent to the following:
  $routes->get('cible', 'Cible::index');
  $routes->post('cible', 'Cible::store');
  $routes->get('cible/(:num)', 'Cible::show/$1');
  $routes->put('cible/(:num)', 'Cible::update/$1');
  $routes->delete('cible/(:num)', 'Cible::destroy/$1');

  // $routes->resource('API/DocumentReference'); // Equivalent to the following:
  $routes->get('documentReference', 'DocumentReference::index');
  $routes->post('documentReference', 'DocumentReference::store');
  $routes->get('documentReference/(:num)', 'DocumentReference::show/$1');
  $routes->put('documentReference/(:num)', 'DocumentReference::update/$1');
  $routes->delete('documentReference/(:num)', 'DocumentReference::destroy/$1');

  // $routes->resource('API/IndicateurPerformance'); // Equivalent to the following:
  $routes->get('indicateurPerformance', 'IndicateurPerformance::index');
  $routes->post('indicateurPerformance', 'IndicateurPerformance::store');
  $routes->get('indicateurPerformance/(:num)', 'IndicateurPerformance::show/$1');
  $routes->put('indicateurPerformance/(:num)', 'IndicateurPerformance::update/$1');
  $routes->delete('indicateurPerformance/(:num)', 'IndicateurPerformance::destroy/$1');
  $routes->post('indicateurPerformances', 'IndicateurPerformance::edit');

  // $routes->resource('API/Investissement'); // Equivalent to the following:
  $routes->get('investissement', 'Investissement::index');
  $routes->post('investissement', 'Investissement::store');
  $routes->get('investissement/(:num)', 'Investissement::show/$1');
  $routes->put('investissement/(:num)', 'Investissement::update/$1');
  $routes->delete('investissement/(:num)', 'Investissement::destroy/$1');

  // $routes->resource('API/Livrable'); // Equivalent to the following:
  $routes->get('livrable', 'Livrable::index');
  $routes->post('livrable', 'Livrable::store');
  $routes->get('livrable/(:num)', 'Livrable::show/$1');
  $routes->put('livrable/(:num)', 'Livrable::update/$1');
  $routes->delete('livrable/(:num)', 'Livrable::destroy/$1');

  // $routes->resource('API/SousActivite'); // Equivalent to the following:
  $routes->get('sousActivite', 'SousActivite::index');
  $routes->post('sousActivite', 'SousActivite::store');
  $routes->get('sousActivite/(:num)', 'SousActivite::show/$1');
  $routes->put('sousActivite/(:num)', 'SousActivite::update/$1');
  $routes->delete('sousActivite/(:num)', 'SousActivite::destroy/$1');
  $routes->post('sousActivite/service', 'SousActivite::SAService');
  $routes->post('sousActivite/indicateur', 'SousActivite::SAIndicateur');
  $routes->get('sousActivites/(:num)', 'SousActivite::sousActiveService/$1');
  $routes->get('sousActiviteActivity/(:num)', 'SousActivite::sousActivity/$1');

  // $routes->resource('API/Version'); // Equivalent to the following:
  $routes->get('version', 'Version::index');
  $routes->post('version', 'Version::store');
  $routes->get('version/(:num)', 'Version::show/$1');
  $routes->put('version/(:num)', 'Version::update/$1');
  $routes->delete('version/(:num)', 'Version::destroy/$1');

  // $routes->resource('API/Activite'); // Equivalent to the following:
  $routes->get('activite', 'Activite::index');
  $routes->post('activite', 'Activite::store');
  $routes->get('activite/(:num)', 'Activite::show/$1');
  $routes->put('activite/(:num)', 'Activite::update/$1');
  $routes->post('activite/etat/(:num)', 'Activite::etat/$1');
  $routes->delete('activite/(:num)', 'Activite::destroy/$1');
  $routes->get('activites/(:num)', 'Activite::activitesProcedure/$1');
  $routes->post('activites', 'Activite::edit');

  // $routes->resource('API/ActiviteActeur'); // Equivalent to the following:
  $routes->get('activiteActeur', 'ActiviteActeur::index');
  $routes->post('activiteActeur', 'ActiviteActeur::store');
  $routes->get('activiteActeur/(:num)', 'ActiviteActeur::show/$1');
  $routes->put('activiteActeur/(:num)', 'ActiviteActeur::update/$1');
  $routes->delete('activiteActeur/(:num)', 'ActiviteActeur::destroy/$1');

  // $routes->resource('API/Credit'); // Equivalent to the following:
  $routes->get('credit', 'Credit::index');
  $routes->post('credit', 'Credit::store');
  $routes->get('credit/(:num)', 'Credit::show/$1');
  $routes->put('credit/(:num)', 'Credit::update/$1');
  $routes->delete('credit/(:num)', 'Credit::destroy/$1');

  // $routes->resource('API/Depense'); // Equivalent to the following:
  $routes->get('depense', 'Depense::index');
  $routes->post('depense', 'Depense::store');
  $routes->get('depense/(:num)', 'Depense::show/$1');
  $routes->put('depense/(:num)', 'Depense::update/$1');
  $routes->delete('depense/(:num)', 'Depense::destroy/$1');

  // $routes->resource('API/Procedure'); // Equivalent to the following:
  $routes->get('procedure', 'Procedure::index');
  $routes->post('procedure', 'Procedure::store');
  $routes->get('procedure/(:num)', 'Procedure::show/$1');
  $routes->put('procedure/(:num)', 'Procedure::update/$1');
  $routes->post('procedure/etat/(:num)', 'Procedure::etat/$1');
  $routes->delete('procedure/(:num)', 'Procedure::destroy/$1');
  $routes->get('procedures/(:num)', 'Procedure::proceduresProc/$1');

  // $routes->resource('API/Processus'); // Equivalent to the following:
  $routes->get('processus', 'Processus::index');
  $routes->post('processus', 'Processus::store');
  $routes->get('processus/(:num)', 'Processus::show/$1');
  $routes->put('processus/(:num)', 'Processus::update/$1');
  $routes->post('processus/etat/(:num)', 'Processus::etat/$1');
  $routes->delete('processus/(:num)', 'Processus::destroy/$1');
  $routes->get('processuss/(:num)', 'Processus::processusProg/$1');

  // $routes->resource('API/Resultat'); // Equivalent to the following:
  $routes->get('resultat', 'Resultat::index');
  $routes->post('resultat', 'Resultat::store');
  $routes->get('resultat/(:num)', 'Resultat::show/$1');
  $routes->put('resultat/(:num)', 'Resultat::update/$1');
  $routes->delete('resultat/(:num)', 'Resultat::destroy/$1');
  $routes->get('resultats/(:num)', 'Resultat::resultsAction/$1');
  $routes->post('resultats', 'Resultat::edit');


  // $routes->resource('API/Groupe'); // Equivalent to the following:
  $routes->get('groupe', 'Groupe::index');
  $routes->post('groupe', 'Groupe::store');
  $routes->get('groupe/(:num)', 'Groupe::show/$1');
  $routes->put('groupe/(:num)', 'Groupe::update/$1');
  $routes->delete('groupe/(:num)', 'Groupe::destroy/$1');

  $routes->get('groupe/permissions/(:num)', 'Groupe_::getPermissions/$1');
  $routes->post('groupe/permissions/save', 'Groupe_::SavePermissions');
  $routes->get('groupes/(:num)', 'Groupe_::get/$1');

  $routes->get('groupe/roles/(:num)', 'Groupe_::getRoles/$1');
  $routes->post('groupe/roles/save', 'Groupe_::SaveRoles');

  // $routes->get('users/(:num)/gallery/(:num)', 'Galleries::showUserGallery/$1/$2');

  $routes->get('tache', 'Tache::all');
  $routes->get('tache/(:num)', 'Tache::show/$1');
  $routes->put('tache/(:num)', 'Tache::update/$1');
  $routes->post('tache', 'Tache::create');
  $routes->delete('tache/(:num)', 'Tache::delete/$1');
  $routes->post('tache/etat/(:num)', 'Tache::etat/$1');
  $routes->get('taches/(:num)', 'Tache::tachesSousAct/$1');


  $routes->get('userprogramme', 'UserProgramme::all');
  $routes->get('userprogramme/(:num)/(:num)', 'UserProgramme::show/$1/$2');
  $routes->put('userprogramme/(:num)/(:num)', 'UserProgramme::update/$1/$2');
  $routes->post('userprogramme', 'UserProgramme::create');
  $routes->delete('userprogramme/(:num)/(:num)', 'UserProgramme::delete/$1/$2');

  $routes->get('user-sousactivite', 'UserSousActivite::all');
  $routes->get('user-sousactivite/(:num)/(:num)', 'UserSousActivite::show/$1/$2');
  $routes->put('user-sousactivite/(:num)/(:num)', 'UserSousActivite::update/$1/$2');
  $routes->post('user-sousactivite', 'UserSousActivite::create');
  $routes->delete('user-sousactivite/(:num)/(:num)', 'UserSousActivite::delete/$1/$2');



  //** AU besoin on utilise ces routes  */
  $routes->get('user/(:num)/programmes/(:num)', 'UserProgramme::GetUserProgrammes/$1/$2');
  $routes->post('user/(:num)/programmes', 'UserProgramme::SaveUserProgrammes/$1');

  $routes->get('programme/(:num)/users/(:num)', 'UserProgramme::GetProgrammeUsers/$1/$2');
  $routes->post('programme/(:num)/users', 'UserProgramme::SaveProgrammeUsers/$1');


  $routes->get('user/(:num)/sousactivites/(:num)', 'UserSousActivite::GetUserSousActivites/$1/$2');
  $routes->post('user/(:num)/sousactivites', 'UserSousActivite::SaveUserSousActivites/$1');

  $routes->get('sousactivite/(:num)/users/(:num)', 'UserSousActivite::GetSousActiviteUsers/$1/$2');
  $routes->post('sousactivite/(:num)/users', 'UserSousActivite::SaveSousActiviteUsers/$1');


  $routes->get('actions/(:num)', 'Action::actionProg/$1');


  // $routes->resource('API/Indicateurperformanceaction'); // Equivalent to the following:
  $routes->get('indicateurperformanceaction', 'Indicateurperformanceaction::index');
  $routes->post('indicateurperformanceactions', 'Indicateurperformanceaction::edit');
  $routes->delete('indicateurperformanceaction/(:num)', 'Indicateurperformanceaction::destroy/$1');

  // $routes->resource('API/IndicateurActivite'); // Equivalent to the following:
  $routes->get('indicateuractivite', 'IndicateurActivite::index');
  $routes->post('indicateuractivite', 'IndicateurActivite::store');
  $routes->post('indicateuractivites', 'IndicateurActivite::edit');
  $routes->delete('indicateuractivite/(:num)', 'IndicateurActivite::destroy/$1');
  $routes->get('indicateuractivite/(:num)', 'IndicateurActivite::activiteIndicateurs/$1');
  
  // $routes->resource('API/CibleIndicateurAction'); // Equivalent to the following:
  $routes->get('cibleIndicateurAction', 'CibleIndicateurAction::index');
  $routes->post('cibleIndicateurAction', 'CibleIndicateurAction::store');
  //  $routes->get('indicateurperformanceaction/(:num)', 'CibleIndicateurAction::show/$1');
  //  $routes->put('indicateurperformanceaction/(:num)', 'CibleIndicateurAction::update/$1');
  //  $routes->delete('indicateurperformanceaction/(:num)', 'CibleIndicateurAction::destroy/$1');
  //  $routes->post('indicateurperformanceaction', 'CibleIndicateurAction::edit');
    // $routes->resource('API/indicateurPerformanceAction'); // Equivalent to the following:
      $routes->get('indicateurPerformanceAction', 'IndicateurPerformanceActionController::liste');
      $routes->post('indicateurPerformanceAction', 'IndicateurPerformanceActionController::create');
      $routes->get('indicateurPerformanceAction/(:num)', 'IndicateurPerformanceActionController::show/$1');
      $routes->get('indicateurPerformance/action/(:num)', 'IndicateurPerformanceActionController::getByIdAction/$1');
      $routes->put('indicateurPerformanceAction/(:num)', 'IndicateurPerformanceActionController::update/$1');
      $routes->delete('indicateurPerformanceAction/(:num)', 'IndicateurPerformanceActionController::delete/$1');
      $routes->post('indicateurPerformanceActionss', 'Indicateurperformanceaction::edit');

// $routes->resource('API/depenseactivite'); // Equivalent to the following:
$routes->get('depenseactivite', 'Depenseactivite::index');
$routes->post('depenseactivite', 'Depenseactivite::store');
$routes->get('depenseactivite/(:num)', 'Depenseactivite::show/$1');
$routes->put('depenseactivite/(:num)', 'Depenseactivite::update/$1');
$routes->delete('depenseactivite/(:num)', 'Depenseactivite::destroy/$1');

// $routes->resource('API/hierachie'); // Equivalent to the following:
$routes->get('hierachie', 'Hierachie::index');
$routes->post('hierachie', 'Hierachie::store');
$routes->get('hierachie/(:num)', 'Hierachie::show/$1');
$routes->put('hierachie/(:num)', 'Hierachie::update/$1');
$routes->delete('hierachie/(:num)', 'Hierachie::destroy/$1');

});
// $routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
