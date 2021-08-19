<?php

trait formValidation
{
  public static $error = array();

  public static function validation($fieldName, $label, $rules)
  {
      if ($_SERVER['REQUEST_METHOD'] == 'post' || $_SERVER['REQUEST_METHOD'] == 'POST')
      {
          $data = trim($_POST[$fieldName]);
      }
      else
      {
          echo "sorry it is not found";
      }

      $pattren = "/^[a-zA-Z]+$/";
      $intPattren = "/^[0-9]+$/";
      $rules = explode("|", $rules);

      if (in_array("required", $rules))
      {
          if (empty($data))
          {
              return self::$error[$fieldName] = $label . " is required";
          }
      }

      if (in_array("int", $rules))
      {
          if (!preg_match($intPattren, $data))
          {
              return self::$error[$fieldName] = $label . " must have only int numbers";
          }
      }

      if (in_array("not_int", $rules))
      {
          if (!preg_match($pattren, $data))
          {
              return self::$error[$fieldName] = $label . " must have only alphabet";
          }
      }

      if (in_array("min", $rules))
      {
          $maxLenIndex = array_search("min", $rules);
          $maxLenValue = $maxLenIndex + 1;
          $maxLenValue = $rules[$maxLenValue];

          if (strlen($data) < $maxLenValue)
          {
              return self::$error[$fieldName] = $label . " must have more than 4 letters";
          }
      }

      if (in_array("max", $rules))
      {
          $maxLenIndex = array_search("max", $rules);
          $maxLenValue = $maxLenIndex + 1;
          $maxLenValue = $rules[$maxLenValue];

          if (strlen($data) > $maxLenValue)
          {
              return self::$error[$fieldName] = $label . " must have less than 10 letters";
          }
      }

      if (in_array("confirm", $rules))
      {
          $confirmIndex = array_search("confirm", $rules);
          $passwordValue = $confirmIndex + 1;
          $passwordValue = $rules[$passwordValue];

          if ($_SERVER['REQUEST_METHOD'] == 'post' || $_SERVER['REQUEST_METHOD'] == 'POST')
          {
              $password = trim($_POST[$passwordValue]);
          }

          if ($password != $data)
          {
              return self::$error[$fieldName] = $label . " password must be the same";
          }
      }

      if (in_array("unique", $rules))
      {
          $uniqueIndex = array_search("unique", $rules);
          $tableIndex = $uniqueIndex + 1;
          $tableName = $rules[$tableIndex];

          if (database::countData($tableName, array('email' => $data)) > 0)
          {
              return self::$error[$fieldName] = " this email already exists";
          }
      }
  }

  public static function run()
  {
      if(empty(self::$error))
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  public static function setValue($fieldName)
  {
      if ($_SERVER['REQUEST_METHOD'] == 'post' || $_SERVER['REQUEST_METHOD'] == 'POST')
      {
          return $_POST[$fieldName];
      }
  }

  public static function hash($password)
  {
      if(!empty($password))
      {
          return password_hash($password, PASSWORD_DEFAULT);
      }
  }
}

?>