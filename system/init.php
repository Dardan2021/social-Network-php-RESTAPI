<?php

spl_autoload_register(function($className){
include "libraries/$className.php";
});
include "settings.php";

$Rout = new Rout;

?>