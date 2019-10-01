<?php

$router = $di->getRouter();

// Registration routes
$router->add('/login', 'Registration::login');
$router->add('/logout', 'Registration::logout');
$router->add('/signup', 'Registration::signup');

// Folder actions
$router->add('/folder/view/{folder_id}', 'Folder::view');
$router->add('/folder/edit/{folder_id}', 'Folder::edit');
$router->add('/folder/delete/{folder_id}', 'Folder::delete');

// Account actions
$router->add('/account/view/{folder_id}', 'Account::view');
$router->add('/account/view/{folder_id}/{account_id}', 'Account::view');
$router->add('/account/edit/{folder_id}/{account_id}', 'Account::edit');
$router->add('/account/delete/{folder_id}/{account_id}', 'Account::delete');

// Account actions
$router->add('/transaction/view/{folder_id}/{account_id}', 'Account::view');
$router->add('/transaction/edit/{folder_id}/{account_id}/{transaction_id}', 'Account::edit');
$router->add('/transaction/delete/{folder_id}/{account_id}/{transaction_id}', 'Account::delete');

$router->handle();
