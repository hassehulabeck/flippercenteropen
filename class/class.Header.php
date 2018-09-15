<?php

class Header {
  public static $returstring;

  public static function getHeader() {
    self::$returstring = "<html>
    <head>
      <link rel=\"stylesheet\" href=\"css/style.css\">
    </head>
    <body>";
    return self::$returstring;
  }
}

 ?>
