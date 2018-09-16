<?php
include_once "class.Db.php";

class Game {

  private $gameID;
  private $abbreviation;
  private $fullName;
  private $division;
  private $ipdbID;
  private $playoffGame;

  public static function getGameInput() {
    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      SELECT gameID, fullName, abbreviation
      FROM games
      WHERE 1
      ORDER BY fullName ASC
      ");
    if ($stmt->execute()){
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
      $result = $stmt->errorInfo();
    }
    return $result;
  }

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
      SELECT *, GREATEST(try1, try2) AS maxScore, ROUND(AVG(try1 + try2),0) AS avgScore
      FROM games
      JOIN entries ON entries.gameID = games.gameID
      WHERE 1
      GROUP BY games.gameID
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
