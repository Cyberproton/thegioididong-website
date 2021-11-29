<?php

use controller\Auth;
use controller\Cart;
use controller\Device;
use controller\Home;
use controller\News;
use controller\Order;
use controller\Rating;
use controller\User;
use core\App;
use core\Response;
use middleware\RequireAdminLoginJSONMiddleware;
use middleware\RequireAdminLoginMiddleware;
use middleware\RequireLoginJSONMiddleware;
use middleware\RequireLoginMiddleware;
use middleware\RequireValidAccount;
use middleware\RequireValidAccountJSON;
use middleware\RequireValidAdminAccount;
use middleware\RequireValidAdminAccountJSON;

require_once __DIR__ . '/../util/autoload.php';

$requireLogin = new RequireLoginMiddleware();
$requireLoginJSON = new RequireLoginJSONMiddleware();
$requireAdminLogin = new RequireAdminLoginMiddleware();
$requireAdminLoginJSON = new RequireAdminLoginJSONMiddleware();
$requireValidAccount = new RequireValidAccount();
$requireValidAdminAccount = new RequireValidAdminAccount();
$requireValidAccountJSON = new RequireValidAccountJSON();
$requireValidAdminAccountJSON = new RequireValidAdminAccountJSON();

try {
    $app = new App();

    $app->router->get("/", [Home::class, "get_home"]);

    $app->router->get('/home', function ($req, $res) {
        $res->redirect('/');
    });

    $app->router->get("/product", [Device::class, "get_devices"]);

    $app->router->get('/login', [Auth::class, 'get_login']);

    $app->router->post('/login', [Auth::class, 'post_login']);

    $app->router->post('/logout', [Auth::class, 'post_logout']);

    $app->router->get('/register', [Auth::class, 'get_register']);

    $app->router->post('/register', [Auth::class, 'post_register']);

    $app->router->get('/user', $requireLogin, $requireValidAccount, [User::class, 'get_user']);

    $app->router->post('/user', $requireLogin, $requireValidAccount, [User::class, 'post_user']);

    $app->router->get("/device", [Device::class, "get_device"]);

    $app->router->post("/rating/add", $requireLoginJSON, $requireValidAccountJSON, [Rating::class, "rate_device"]);

    $app->router->get("/cart", $requireLogin, [Cart::class, "get_cart"]);

    $app->router->post("/cart/add", $requireLoginJSON, $requireValidAccountJSON, [Cart::class, "add_to_cart"]);

    $app->router->post("/cart/remove", $requireLoginJSON, $requireValidAccountJSON, [Cart::class, "remove_cart"]);

    $app->router->get("/news", [News::class, "get_news"]);

    $app->router->get("/news/view", [News::class, "get_news_view"]);

    $app->router->get("/order", $requireLogin, $requireValidAccount, [Order::class, "get_orders"]);

    $app->router->post("/order/add", $requireLoginJSON, $requireValidAccountJSON, [Order::class, "add_orders"]);

    $app->router->post("/order/cancel", $requireLoginJSON, $requireValidAccountJSON, [Order::class, "cancel_order"]);

    $app->router->get("/admin", $requireAdminLogin, $requireValidAdminAccount, [Home::class, "admin_home"]);

    $app->router->get("/admin/order", $requireAdminLogin, $requireValidAdminAccount, [Order::class, "get_admin_orders"]);

    $app->router->post("/admin/order/cancel", $requireAdminLoginJSON, $requireValidAdminAccountJSON, [Order::class, "admin_cancel_order"]);

    $app->router->post("/admin/order/update-status", $requireAdminLoginJSON, $requireValidAdminAccountJSON, [Order::class, "admin_update_order_status"]);

    $app->router->get('/admin/devices', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "get_admin_devices"]);

    $app->router->get('/admin/device', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "get_admin_device"]);

    $app->router->get('/admin/device/add', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "get_admin_add_device"]);

    $app->router->post('/admin/device/add', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "post_admin_add_device"]);

    $app->router->get('/admin/device/edit/', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "get_admin_edit_device"]);

    $app->router->post('/admin/device/edit/', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "post_admin_update_device"]);

    $app->router->post('/admin/device/delete', $requireAdminLogin, $requireValidAdminAccount, [Device::class, "post_admin_delete_device"]);

    $app->router->get("/admin/login", [Auth::class, "admin_get_login"]);

    $app->router->post("/admin/login", [Auth::class, "admin_post_login"]);

    $app->router->post("/admin/logout", [Auth::class, "admin_post_logout"]);

    $app->router->get("/admin/users", $requireAdminLogin, $requireValidAdminAccount, [User::class, "get_admin_users"]);

    $app->router->get("/admin/user", $requireAdminLogin, $requireValidAdminAccount, [User::class, "get_admin_user"]);

    $app->router->post("/admin/user", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_post_user"]);

    $app->router->get("/admin/user/add", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_get_add_user"]);

    $app->router->post("/admin/user/add", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_post_add_user"]);

    $app->router->post("/admin/user/delete", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_delete_user"]);

    $app->router->post("/admin/user/change-password", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_update_password"]);

    $app->router->post("/admin/user/change-role", $requireAdminLogin, $requireValidAdminAccount, [User::class, "admin_update_role"]);

    $app->router->get("/admin/news", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_get_news"]);

    $app->router->get("/admin/news/edit", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_get_edit_news"]);

    $app->router->post("/admin/news/edit", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_post_edit_news"]);

    $app->router->get("/admin/news/add", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_get_add_news"]);

    $app->router->post("/admin/news/add", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_post_add_news"]);

    $app->router->post("/admin/news/delete", $requireAdminLogin, $requireValidAdminAccount, [News::class, "admin_post_delete_news"]);

    $app->router->get("/admin/account-not-exists", function ($req, $res) {
        $res->view("admin/account-not-exists", [], "admin");
    });

    $app->router->get("/account-not-exists", function ($req, $res) {
        $res->view("account-not-exists", []);
    });

    $app->router->use(function ($req, $res) {
        $res->code(404);
        $res->view('404');
    });

    $app->run();
} catch (Exception $ex) {
    $res = new Response();
    $res->code(500);
    $res->view("500");
    throw $ex;
}
