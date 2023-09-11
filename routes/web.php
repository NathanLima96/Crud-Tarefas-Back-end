<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/tarefas/por-data/{date}', 'TarefaController@getByDate');


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    ['prefix' => 'tarefa'],
    function () use ($router) {
        $router->post('', 'TarefaController@create');
        $router->get('', 'TarefaController@getall');
        $router->get('{id}', 'TarefaController@getFromId');
        $router->put('{id}', 'TarefaController@update');
        $router->delete('{id}', 'TarefaController@delete');
    }
);
$router->group(
    ['prefix' => 'subtarefa'],
    function () use ($router) {
        $router->post('', 'SubTarefaController@create');
        $router->get('', 'SubTarefaController@getall');
        $router->get('{id}', 'SubTarefaController@get');
        $router->put('{id}', 'SubTarefaController@update');
        $router->delete('{id}', 'SubTarefaController@delete');
    }
);
