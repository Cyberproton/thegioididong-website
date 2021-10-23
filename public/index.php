<?php

use controller\About;
use controller\Auth;
use controller\Home;
use controller\User;
use core\App;
use middleware\RequireLoginMiddleware;

require_once __DIR__ . '/../util/autoload.php';

$app = new App();

$app->router->get('/', [ Home::class, 'index' ]);

$app->router->get('/home', function ($req, $res) {
    $res->redirect('/');
});

$app->router->get('/login', [ Auth::class, 'get_login' ]);

$app->router->post('/login', [ Auth::class, 'post_login' ]);

$app->router->post('/logout', [ Auth::class, 'post_logout' ]);

$app->router->get('/register', [ Auth::class, 'get_register' ]);

$app->router->post('/register', [ Auth::class, 'post_register' ]);

$app->router->get('/about', function() { echo 'You are visiting about'; }, [ About::class, 'index' ], function() { echo 'End about'; });

$app->router->use(new RequireLoginMiddleware());

$app->router->get('/user', [ User::class, 'index' ]);

$app->router->use(function($req, $res) {
    $res->view('404');
});

$app->run();