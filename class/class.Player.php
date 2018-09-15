<?php
include_once "class.Db.php";

class Player {
  private $playerID;
  private $firstName;
  private $lastName;
  private $tag;
  private $country;
  private $ifpaID;

  public function setter(array $playerData) {
    $this->firstName = $playerData['firstName'];
    $this->lastName = $playerData['lastName'];
    $this->tag = $playerData['tag'];
    $this->country = $playerData['country'];
    $this->ifpaID = $playerData['ifpaID'];

    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      INSERT INTO players
      (firstName, lastName, tag, country, ifpaID)
      VALUES
      (:fName, :lName, :tag,
      :country, :ifpaID)
      ON DUPLICATE KEY UPDATE country = :country
      ");
    $stmt->bindParam(":fName", $this->firstName);
    $stmt->bindParam(":lName", $this->lastName);
    $stmt->bindParam(":tag", $this->tag);
    $stmt->bindParam(":country", $this->country);
    $stmt->bindParam(":ifpaID", $this->ifpaID);
    if ($stmt->execute()) {
      $this->playerID = $dbh->lastInsertId();
    }
    else {
      var_dump($stmt->errorInfo());
      exit;
    }
    return $this->playerID;
  }

  public static function playerList() {
    $database = new Db();
    $dbh = $database->connect();
    $stmt = $dbh->prepare("
      SELECT
        playerID,
        CONCAT(UPPER(lastName), \", \", firstName) AS fullName,
        UPPER(tag) AS tag,
        country,
        ifpaID
      FROM
      players
      WHERE 1
      ORDER BY lastName ASC, firstName ASC
      ");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getPlayerForm() {
    $returstring = "<form action='index.php' method='POST'>";

    foreach ($this as $key=>$v) {
      if ($key != 'playerID') {
        $returstring .= "<br /><label for='$key'>$key</label>";
        if ($key == 'country') {
          $returstring .= Country::getDropdown();
        }
        else {
          $returstring .= "<input type='text' name='$key' value=''/>";
        }
      }
    }
    $returstring .= "<p><input type='submit' value='Lägg in spelare' name='submitPlayer' /></form>";
    return $returstring;
  }

}

?>
