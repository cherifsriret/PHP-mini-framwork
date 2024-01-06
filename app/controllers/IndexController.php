<?php

    require "app/models/Course.php";
    class IndexController
    {
        public function index()
        {
            $courses = Course::fetchAll();
            return Helper::view("index", ['courses' => $courses]);
        }
    }