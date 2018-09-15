<?php

class Menu {
  public static $returstring;

  public static function getMenu() {
    self::$returstring =
    "<ul id='links'>
      <li><a href='index.php'>Start</a></li>
      <li><a href='player.php'>Spelare</a></li>
      <li><a href='game.php'>Spel</a></li>
    </ul>";
    return self::$returstring;
  }
}
?>
