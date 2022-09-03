<?php

$router->group([
    'prefix' => 'api'
], function () use ($router) {
    // Authentication 
    $router->group([
        'prefix' => 'auth'
    ], function ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('refresh', 'AuthController@refresh');
        $router->post('logout', 'AuthController@logout');
    });

    // Profile 
    $router->group([
        'middleware' => 'api',
        'prefix' => 'profile'
    ], function ($router) {
        $router->get('me', [
            'as' => 'profile', 'uses' => "AuthController@me"
        ]);
    });

    // Users 
    $router->group([
        'middleware' => 'api',
        'prefix' => 'users'
    ], function ($router) {
        $router->get('', 'UserController@all');
        $router->post('', 'UserController@store');
        $router->put('{id}', 'UserController@update');
        $router->get('{id}', 'UserController@get_by_id');
        $router->delete('{id}', 'UserController@delete');
        $router->get('{id}/posts', 'UserController@posts');
        $router->get('{id}/todos', 'UserController@todos');
    });

    // Posts
    $router->group([
        'prefix' => 'posts'
    ], function ($router) {
        $router->get('', 'PostController@all');
        $router->post('', 'PostController@store');
        $router->put('{id}', 'PostController@update');
        $router->get('{id}', 'PostController@get_by_id');
        $router->delete('{id}', 'PostController@delete');
        $router->get('{id}/comments', 'PostController@comments');
    });

    // Todos 
    $router->group([
        'prefix' => 'todos'
    ], function ($router) {
        $router->get('', 'TodoController@all');
        $router->post('', 'TodoController@store');
        $router->put('{id}', 'TodoController@update');
        $router->get('{id}', 'TodoController@get_by_id');
        $router->delete('{id}', 'TodoController@delete');
    });

    // Comments
    $router->group([
        'prefix' => 'comments'
    ], function ($router) {
        $router->get('', 'CommentController@all');
        $router->post('', 'CommentController@store');
        $router->put('{id}', 'CommentController@update');
        $router->get('{id}', 'CommentController@get_by_id');
        $router->delete('{id}', 'CommentController@delete');
    });
});
