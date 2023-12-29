<?php
    require "app/models/User.php";

    class AuthController
    {
        public function loginForm()
        {
            //logut if already logged in
            session_start();
            unset($_SESSION['user']) ; 
            return Helper::view("login");
        }

        public function login()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                $dbh = App::get('dbh');

                $statement = $dbh->prepare("SELECT * FROM users WHERE email=:email");
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
                $statement->execute();
                $user = $statement->fetch();

                if ($user && password_verify($password, $user->getPassword())) {
                    // Authentication successful
                    session_start();
                    $_SESSION['user'] = $user;

                    // Redirect to home page after login
                    $path = App::get('config')['base_uri'] ;
                    header("Location: /{$path}");
                    exit;
                } else {
                    //redirect to login page with error
                    session_start();
                    $_SESSION['error'] = 'Invalid username or password';
                    $path = App::get('config')['base_uri'] . '/login_form';
                    header("Location: /{$path}");
                }
            }
        }


        public function logout()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //redirect to login page with error
                session_start();
                unset($_SESSION['user']) ; 
                $path = App::get('config')['base_uri'] . '/login_form';
                header("Location: /{$path}");
            }
        }


    }