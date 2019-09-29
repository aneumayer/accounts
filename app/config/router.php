<?php

$router = $di->getRouter();

// Registration routes
$router->add(
    '/login',
    [
        "controller" => "registration",
        "action"     => "login",
    ]
)->setName("registration-login");
$router->add(
    '/signup',
    [
        "controller" => "registration",
        "action"     => "signup",
    ]
)->setName("registration-signup");
$router->add(
    '/logout',
    [
        "controller" => "registration",
        "action"     => "logout",
    ]
)->setName("registration-logout");

// Rename an existing folder
$router->add(
    '/folder/rename/{id}',
    [
        "controller" => "folder",
        "action"     => "rename",
    ]
)->setName("folder-rename");
// Delete an existing folder
$router->add(
    '/folder/delete/{id}',
    [
        "controller" => "folder",
        "action"     => "delete",
    ]
)->setName("folder-delete");

$router->handle();
