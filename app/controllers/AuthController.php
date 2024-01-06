<?php
    require "app/models/User.php";

    class AuthController
    {
        public function loginForm()
        {
            //logut if already logged in
            unset($_SESSION['user']) ; 
            return Helper::view("login");
        }

        public function login()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                $dbh = App::get('dbh');
                $statement = $dbh->prepare("SELECT * FROM users WHERE email=?");
                $statement->bindParam(1, $email, PDO::PARAM_STR);
                $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
                $statement->execute();
                $user = $statement->fetch();

             
                if ($user && password_verify($password, $user->getPassword())) {
                    // Authentication successful
                    // Redirect to home page after login
                    Helper::session('user',  $user->getId());
                    Helper::redirect(''); 
                } else {
                    //redirect to login page with error
                    Helper::session('error', 'Invalid username or password');
                    Helper::redirect('login_form'); 
                }
            }
        }


        public function logout()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //redirect to login page
                Helper::redirect('login_form'); 
            }
        }


    }