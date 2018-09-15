<?php

class Country {
  public static $countryList = [
    'SE',
    'FI',
    'NO',
    'US',
    'DK'
  ];
  public static $returstring;

  public static function getDropdown() {
    self::$returstring = "<select name='country'>";
    self::$returstring .= "<option value=''>-</option>";
    foreach(self::$countryList as $country) {
      self::$returstring .= "<option value='$country'>$country</option>";
    }
    self::$returstring .= "</select>";
    return self::$returstring;
  }
}

 ?>
