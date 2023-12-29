<?php

$router->define([

    ''=> ["action" => 'IndexController' , "is_protected" => true],
    'login_form'=> ["action" => 'AuthController@loginForm' , "is_protected" => false], 
    'login'=> ["action" => 'AuthController@login' , "is_protected" => false], 
    'logout'=>  ["action" => 'AuthController@logout' , "is_protected" => false], 
    // 'register'=> 'AuthController@register',
    // 'register_post'=> 'AuthController@register_post',

]);