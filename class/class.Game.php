<?php
include_once "class.Db.php";

class Game {

  private $gameID;
  private $abbreviation;
  private $fullName;
  private $division;
  private $ipdbID;
  private $playoffGame;

  public function getGame($id) {
    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      SELECT
      FROM game
      WHERE gameID = :gid
      ");
    $stmt->bindParam(":gid", $id);
    if ($stmt->execute()){
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      $result = $stmt->errorInfo();
    }
    return $result;
  }

  public static function getGameList() {
    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      SELECT
      FROM game
      WHERE 1
      ORDER BY abbr ASC
      ");
    $stmt->bindParam(":gid", $id);
    if ($stmt->execute()){
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      $result = $stmt->errorInfo();
    }
    return $result;
  }
}
?>
