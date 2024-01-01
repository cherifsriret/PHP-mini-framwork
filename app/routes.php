<?php

$router->define([

    ''=> ["action" => 'IndexController' , "is_protected" => true],
    'login_form'=> ["action" => 'AuthController@loginForm' , "is_protected" => false], //GET
    'login'=> ["action" => 'AuthController@login' , "is_protected" => false], //Post
    'logout'=>  ["action" => 'AuthController@logout' , "is_protected" => false], //Post
    'about' => ["action" => 'AboutController' , "is_protected" => false],   '',
    // 'register'=> 'AuthController@register',
    // 'register_post'=> 'AuthController@register_post',

    //PUT, 
    //PATCH

    //DELETE

]);