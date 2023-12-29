<?php

    return
    [
        'database' => [
            'dbname' => 'php_mini_framework',
            'username' => 'root',
            'password' => '',
            'hostname' => 'mysql:host=127.0.0.1',
            'port' => '3306',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci',
                PDO::ATTR_PERSISTENT => true
            ],
        ],
        'base_uri' => 'PHP-mini-framwork'
    ];