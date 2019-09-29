<?php

$router = $di->getRouter();

// Registration routes
$router->add('/login', 'Registration::login');
$router->add('/logout', 'Registration::logout');
$router->add('/signup', 'Registration::signup');

// Folder actions
$router->add('/folder/view/{id}', 'Folder::view');
$router->add('/folder/rename/{id}', 'Folder::rename');
$router->add('/folder/delete/{id}', 'Folder::delete');

$router->handle();
