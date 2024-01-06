<?php

/**
 * 
 */

 class Router 
 {

    protected $routes = [];

    public function define($routes) {
        $this->routes = $routes;
    }



    public static function load($file)
    {
        $router = new static;
        require 'app/'.$file;
        return $router;
    }


    public function direct($uri)
    {

        $uri = parse_url($uri)["path"];
        $prefix = App::get('config')['base_uri'] ?? null;
        if (isset($prefix) && !empty($prefix))
        {
            if(strncmp($uri,$prefix,strlen($prefix)) == 0)
            {
                if(empty($uri = substr($uri,strlen($prefix) + 1)))
                {
                    $uri = "";
                }
            }
        }

        if(array_key_exists($uri, $this->routes))
        {
            //check if is protected route and user not authenicated
            if($this->routes[$uri]['is_protected'] && empty($_SESSION['user']))
            {

                //redirect to login page
                $path = App::get('config')['base_uri'] . '/login_form';
                header("Location: /{$path}");
                exit;
            }

            return $this->callAction(
                ...explode('@',$this->routes[$uri]['action'])
            );
        }

        throw new Exception("No routes defined for this URI.",1);
    }

    protected function callAction($controller,$action = 'index')
    {
        require_once("app/controllers/". $controller  . ".php");
        $control = new $controller;
        if(!method_exists($control, $action))
        {
            throw new Exception("$controller does not respond to the action $action.");
        }
        return $control->$action();   
    }

 }