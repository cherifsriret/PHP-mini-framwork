<?php

require "app/models/Course.php";
    class CourseController
    {
     
    public function details()
    {


        if(isset($_GET['id']) && ctype_digit($_GET['id']))
        {
            $course = Course::fetchId($_GET["id"]);

            if($course == null)
            {
                // raising an exception maybe not the best solution
                throw new Exception("Course NOT FOUND.", 1);
            }
        }
        else
        {
            throw new Exception("Error retrieving the course. ID is not valid", 1);
        }
     
        return Helper::view('show_course',[
            'course' => $course
            ]);

    }
}