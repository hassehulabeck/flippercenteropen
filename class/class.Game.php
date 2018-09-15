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
      SELECT *
      FROM games
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
      SELECT *
      FROM games
      WHERE 1
      ORDER BY abbreviation ASC
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

  public function getEntriesByGame($gid) {
    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      SELECT entries.*, CONCAT(UPPER(players.lastName), \" \", players.firstName) AS fullName
      FROM entries
      JOIN players ON players.playerID = entries.playerID
      WHERE entries.gameID = :gid
      ORDER BY entries.qualificationPoints DESC
      ");
      $stmt->bindParam(":gid", $gid);
      if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      else {
        $result = $stmt->errorInfo();
      }
      return $result;
  }

}
?>
