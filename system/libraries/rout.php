<?php
 class Rout {

     private $controller = defaultController;

     private $method = defaultMethod;

     private $param = defaultParam;

     public function __construct()
     {
         $url = $this->Url();

        if(!empty($url))
        {
            if(file_exists("../application/controller/" .$url[0]. ".php"))
            {
                $this->controller = ucwords($url[0]);

               unset($url[0]);
            }
            else
            {
                echo "file does not exists";
            }
        }

        require_once "../application/controller/".$this->controller.".php";

        $this->controller = new $this->controller;

        if(isset($url[1]) && !empty($url[1]))
        {
            if(method_exists($this->controller,$url[1]))
            {
                $this->method = $url[1];

                unset($url[1]);
            }
            else
            {
                echo "method is not found";
            }
        }

        if(isset($url))
        {
            $this->param = $url;
        }
        else
        {
            $this->param = [];
        }

        call_user_func_array([$this->controller,$this->method],$this->param);
     }

     public function Url()
     {
         if(isset($_GET['url']))
         {
             $url = $_GET['url'];
             $url = rtrim($url);
             $url = filter_var($url, FILTER_SANITIZE_URL);
             $url = explode("/",$url);

             return $url;
         }
     }
 }
?>