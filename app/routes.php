<?php

$router->define([

    ''=> ["action" => 'IndexController' , "is_protected" => true],
    'login_form'=> ["action" => 'AuthController@loginForm' , "is_protected" => false], //GET
    'login'=> ["action" => 'AuthController@login' , "is_protected" => false], //Post
    'logout'=>  ["action" => 'AuthController@logout' , "is_protected" => false], //Post
    'about' => ["action" => 'AboutController' , "is_protected" => false],   
   
    'notes' => ["action" => 'NoteController' , "is_protected" => true], //GET 
    'note_add_form' => ["action" => 'NoteController@addForm' , "is_protected" => true], //GET 
    'note_add' => ["action" => 'NoteController@add' , "is_protected" => true], //POST 
 
    'note_update_form' => ["action" => 'NoteController@updateForm' , "is_protected" => true], //GET 
    'note_update' => ["action" => 'NoteController@update' , "is_protected" => true], //POST 

    'details_course' => ["action" => 'CourseController@details' , "is_protected" => true], //GET 


    // 'register'=> 'AuthController@register',
    // 'register_post'=> 'AuthController@register_post',

    //PUT, 
    //PATCH

    //DELETE

]);