<?php
class Welcome extends myFramework
{
   public static function index()
   {
       echo "index method from controller";
       self::view("appView");
   }
}