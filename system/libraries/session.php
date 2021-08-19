<?php
trait session
{
    public static function startSession()
    {
        session_start();
    }

    public static function setSession($name, $value)
    {
        if(!empty($name))
        {
            if(is_array($name) && empty($value))
            {
                foreach($name as $key => $sessionName)
                {
                    $_SESSION[$key] = $sessionName;
                }
            }
            else if(!is_array($name) && !empty($value))
            {
                $_SESSION[$name] = $value;
            }
        }
    }

    public static function setFlashMessage($name, $message)
    {
        if(!empty($name) && !empty($message))
        {
            $_SESSION[$name] = $message;
        }
    }

    public static function flash($name, $class)
    {
        if(!empty($name))
        {
            echo "<div class='" . $class . "'>" . $_SESSION[$name] . "</div>";
            unset($_SESSION[$name]);
        }
    }

    public static function unsetSession($name)
    {
        if(is_array($name))
        {
            foreach($name as $key)
            {
                unset($_SESSION[$key]);
            }
        }
        else
        {
            unset($_SESSION[$name]);
        }
    }

    public static function destroySession()
    {
        session_destroy();
    }
}