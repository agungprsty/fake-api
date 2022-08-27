<?php

$router->group([
    'prefix' => 'api'
], function () use ($router) {
    // Profile 
    $router->group([
        'prefix' => 'users'
    ], function ($router) {
        $router->get('', 'UserController@all');
        $router->post('', 'UserController@store');
        $router->put('{id}', 'UserController@update');
        $router->get('{id}', 'UserController@get_by_id');
        $router->delete('{id}', 'PostController@delete');
    });

    // Post 
    $router->group([
        'prefix' => 'posts'
    ], function ($router) {
        $router->get('', 'PostController@all');
        $router->post('', 'PostController@store');
        $router->put('{id}', 'PostController@update');
        $router->get('{id}', 'PostController@get_by_id');
        $router->delete('{id}', 'PostController@delete');
    });

    // todos 
    $router->group([
        'prefix' => 'todos'
    ], function ($router) {
        $router->get('', 'TodoController@all');
        $router->post('', 'TodoController@store');
        $router->put('{id}', 'TodoController@update');
        $router->get('{id}', 'TodoController@get_by_id');
        $router->delete('{id}', 'TodoController@delete');
    });

    // comment 
    $router->group([
        'prefix' => 'comments'
    ], function ($router) {
        $router->get('', 'CommentController@all');
        $router->post('', 'CommentController@store');
        $router->put('{id}', 'CommentController@update');
        $router->get('{id}', 'CommentController@get_by_id');
        $router->delete('{id}', 'TodoController@delete');
    });
});
