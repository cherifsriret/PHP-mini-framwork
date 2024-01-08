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


    public static function logAction($action)
    {
      // Log the action
        $logMessage = date('Y-m-d H:i:s') . ' - ' . $action .' By user :'.static::getCurrentUserId(). PHP_EOL;
        // Specify the log file path
        $logFilePath =  'logfile.txt';
    
        // Write to the log file
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);
    }


}