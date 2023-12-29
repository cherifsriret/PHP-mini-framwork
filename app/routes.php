<?php

$router->define([

    ''=> 'IndexController',
    'login'=> 'AuthController@login',
    'login_post'=> 'AuthController@login_post',
    'register'=> 'AuthController@register',
    'register_post'=> 'AuthController@register_post',

]);