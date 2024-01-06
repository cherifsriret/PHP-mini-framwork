<?php
/**
 * 
 */
class Helper
{
    public static function display($data) 
    {
        echo "<pre>";    
        var_dump($data);
        echo "</pre>";    
    }

    public static function dd($data) 
    {
      Helper::display($data);
      die();
    }

    public static function view($name,$data = []) 
    {
        extract($data);
        return require "app/views/{$name}.view.php";
    }
    
    public static function redirect($path)
    {
        if (isset(App::get('config')['base_uri'])) {
           $path = App::get('config')['base_uri'] . '/' . $path;
        }
        header("Location: /{$path}");
        exit();
    }

    public static function session($type, $text)
    {
       $_SESSION[$type] = $text;
    }

    public static function getCurrentUserId()
    {
       return $_SESSION[ 'user'];
    }

    public static function group_by($array, $key) {
        $result = array();
        foreach ($array as $val) {
            $result[$val->$key][] = $val;
        }
        return $result;
    }

}