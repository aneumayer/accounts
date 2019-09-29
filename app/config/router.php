<?php

$router = $di->getRouter();

// Define your routes here

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
