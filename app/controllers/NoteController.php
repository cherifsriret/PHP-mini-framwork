<?php

require "app/models/Course.php";
require "app/models/Note.php";
    class NoteController
    {
     
        public function index()
    {

        $courses = Course::fetchAll();

        foreach ($courses as $key => $course) {
            $course->setNotes( Note::fetchAll($course->getId()));
        }


        return Helper::view("show_notes",[
                'notes' => $courses
            ]);
    }



        
    public function addForm()
    {
        $courses = Course::fetchAll();
        return Helper::view('add_note', ['courses' => $courses]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // get current user id from session
            $current_user_id = Helper::getCurrentUserId();
            if(isset($_POST['course_id']) && isset($_POST['note']) && isset($_POST['coeficient']) && $current_user_id)
            {
                $note = new Note;
            	$note->setCourseId($_POST['course_id']);
            	$note->setCoeficient($_POST['coeficient']);
            	$note->setUserId($current_user_id);
            	$note->setNote($_POST['note']);
                $note->create();
                Helper::session('message', 'Created successfully');
                Helper::redirect(''); 
            }
            else
            {
                Helper::session('error', "Course can't be empty.");
                Helper::redirect('note_add'); 
            }
        }
    }

    public function updateForm()
    {
        if(isset($_GET['id']) && ctype_digit($_GET['id']))
        {
            $task = Task::fetchId($_GET["id"]);

            if($task == null)
            {
                // raising an exception maybe not the best solution
                throw new Exception("TASK NOT FOUND.", 1);
            }
        }
        else
        {
            throw new Exception("Error retrieving the task. ID is not valid", 1);
        }

        return Helper::view('update_task',[
                'task' => $task,
            ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(
                isset($_POST['id']) &&
                ctype_digit($_POST['id']) &&
                isset($_POST['description']) &&
                // isset($_POST['completed']) && // a checkbox is not sent if not checked
                isset($_POST['deadline'])
                )
            {
                $task = Task::fetchId($_POST["id"]);

                if($task == null)
                {
                   // raising an exception maybe not the best solution
                   throw new Exception("TASK NOT FOUND.", 1);
                }

                $task->setDescription($_POST['description']);
                $task->setCompleted(isset($_POST['completed']) ? 1 : 0);
                $task->setDeadline($_POST['deadline']);

                $task->update();
                Helper::session('message', 'Updated sucessfully');
            }
            else {
                throw new Exception("Some data are missing...", 1);
            }
            Helper::redirect('tasks');
        }
    }

    }