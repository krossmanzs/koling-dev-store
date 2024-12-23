<?php
$routes = [
    'auth/login' => 'AuthController@login',
    'auth/register' => 'AuthController@register',
    'auth/logout' => 'AuthController@logout',

    'admin' => 'AdminPanelController@index',
    'admin/products' => 'AdminProductController@index',
    'admin/products/create' => 'AdminProductController@create',
    'admin/products/edit/{id}' => 'AdminProductController@edit',
    'admin/products/delete/{id}' => 'AdminProductController@delete',
    'admin/transactions' => 'TransactionController@index',
    'admin/transactions/create' => 'TransactionController@create',
    'admin/transactions/edit/{id}' => 'TransactionController@updateStatus',
    'admin/transactions/delete/{id}' => 'TransactionController@delete',

    'order/create/{id}' => 'TransactionController@create',
];