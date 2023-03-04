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
$routes->setDefaultController('Home');
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

//site
$routes->get('/estatuto','Site::estatuto');
$routes->get('/contato','Site::contato');
$routes->post('/contato','Site::contatoPost');
//sistema
$routes->get('/', 'Home::index');
$routes->get('/associe-se','Associese::index');
$routes->post('/associe-se','Associese::associarPost');
$routes->get('/entrar','Entrar::index');
$routes->post('/entrar','Entrar::entrarPost');
$routes->get('/sair','Entrar::sair');
$routes->get('/atualizar-dados','AtualizarDados::index',['filter' => 'authGuard']);
$routes->post('/atualizar-dados/dadosBasicos','AtualizarDados::atualizarDadosBasicos',['filter' => 'authGuard']);
$routes->post('/atualizar-dados/incluirEstacao','AtualizarDados::incluirEstacao',['filter' => 'authGuard']);
$routes->post('/atualizar-dados/excluirEstacao','AtualizarDados::excluirEstacao',['filter' => 'authGuard']);
$routes->get('/alterar-senha','AtualizarDados::alterarSenha',['filter' => 'authGuard']);
$routes->post('/alterar-senha','AtualizarDados::alterarSenhaPost',['filter' => 'authGuard']);
$routes->get('/recuperar-senha','RecuperarSenha::index');
$routes->post('/recuperar-senha','RecuperarSenha::indexPost');
$routes->get('/recuperar-senha/hash/(:alphanum)','RecuperarSenha::novaSenha/$1');
$routes->post('/recuperar-senha/hash/(:alphanum)','RecuperarSenha::novaSenhaPost/$1');
$routes->get('/socios','SociosCrud::index',['filter' => 'adminGuard']);
$routes->get('/socios/jsonGrid','SociosCrud::jsonGrid',['filter' => 'adminGuard']);
$routes->get('/socios/insert','SociosCrud::insert',['filter' => 'adminGuard']);
$routes->post('/socios/insert','SociosCrud::insertPost',['filter' => 'adminGuard']);
$routes->get('/socios/update/(:num)','SociosCrud::update/$1',['filter' => 'adminGuard']);
$routes->post('/socios/update/(:num)','SociosCrud::updatePost/$1',['filter' => 'adminGuard']);
$routes->get('/socios/delete/(:num)','SociosCrud::delete/$1',['filter' => 'adminGuard']);
$routes->post('/socios/delete/(:num)','SociosCrud::deletePost/$1',['filter' => 'adminGuard']);

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
