<?php

use controller\About;
use controller\Auth;
use controller\Cart;
use controller\Device;
use controller\Home;
use controller\User;
use core\App;
use middleware\RequireAdminLoginMiddleware;
use middleware\RequireLoginMiddleware;

require_once __DIR__ . '/../util/autoload.php';

$app = new App();

$app->router->get("/", [ Home::class, "get_home" ]);

$app->router->get('/home', function ($req, $res) {
    $res->redirect('/');
});

$app->router->get("/product", [ Device::class, "get_devices" ]);

$app->router->get('/login', [ Auth::class, 'get_login' ]);

$app->router->post('/login', [ Auth::class, 'post_login' ]);

$app->router->post('/logout', [ Auth::class, 'post_logout' ]);

$app->router->get('/register', [ Auth::class, 'get_register' ]);

$app->router->post('/register', [ Auth::class, 'post_register' ]);

$app->router->get('/about', function() { echo 'You are visiting about'; }, [ About::class, 'index' ], function() { echo 'End about'; });

$app->router->get('/user', new RequireLoginMiddleware(), [ User::class, 'index' ]);

$app->router->get("/device", [ Device::class, "get_device" ]);

$app->router->get("/cart", [ Cart::class, "get_cart" ]);

$app->router->get('/admin/devices', new RequireAdminLoginMiddleware(), [ Device::class, "get_admin_devices" ]);

$app->router->get('/admin/device', new RequireAdminLoginMiddleware(), [ Device::class, "get_admin_device" ]);

$app->router->get('/admin/device/add', new RequireAdminLoginMiddleware(), [ Device::class, "get_admin_add_device" ]);

$app->router->post('/admin/device/add', new RequireAdminLoginMiddleware(), [ Device::class, "post_admin_add_device" ]);

$app->router->get('/admin/device/edit/', new RequireAdminLoginMiddleware(), [ Device::class, "get_admin_edit_device" ]);

$app->router->post('/admin/device/edit/', new RequireAdminLoginMiddleware(), [ Device::class, "post_admin_update_device" ]);

$app->router->post('/admin/device/delete', new RequireAdminLoginMiddleware(), [ Device::class, "post_admin_delete_device" ]);

$app->router->get("/admin/users", new RequireAdminLoginMiddleware(), [ User::class, "get_admin_users" ]);

$app->router->get("/admin/user", new RequireAdminLoginMiddleware(), [ User::class, "get_admin_user" ]);

$app->router->get("/admin/user/add", new RequireAdminLoginMiddleware(), [ User::class, "admin_get_add_user" ]);

$app->router->post("/admin/user/add", new RequireAdminLoginMiddleware(), [ User::class, "admin_post_add_user" ]);

$app->router->post("/admin/user/delete", new RequireAdminLoginMiddleware(), [ User::class, "admin_delete_user" ]);

$app->router->post("/admin/user/change-password", new RequireAdminLoginMiddleware(), [ User::class, "admin_update_password" ]);

$app->router->post("/admin/user/change-role", new RequireAdminLoginMiddleware(), [ User::class, "admin_update_role" ]);

$app->router->use(function($req, $res) {
    $res->view('404');
});

$app->run();