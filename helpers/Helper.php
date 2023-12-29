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
    

}