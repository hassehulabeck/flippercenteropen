<?php
class Db {

  public function connect() {
    include "db.php";
    try {
      $dbh = new PDO($connectString, $user, $pw);
    }
    catch(PDOException $err) {
      echo "Ojdå. Ingen kontakt med servern.<br />";
      file_put_contents('PDOErrors.txt', $err->getMessage(), FILE_APPEND);
    }
    return $dbh;
  }
}
?>
