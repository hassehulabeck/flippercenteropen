<?php

// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoloader för klasserna
spl_autoload_register(function ($class_name) {
    include 'class/class.' . $class_name . '.php';
});



echo Header::getHeader();
echo Menu::getMenu();
echo "<section id='content'>";
if (isset($_GET['gameID'])) {
  $gid = $_GET['gameID'];

  // Get entries by game
  $game = new Game;
  $entryList = $game->getEntriesByGame($gid);
  // Get name of the game
  $gameName = $game->getGame($gid);
  echo "<h1>{$gameName[0]['fullName']}</h1>";

  echo "<table><tr><th>Player<th>Score<th>Qual.pts";
  foreach ($entryList as $row) {
    $score = number_format($row['score'], 0, ',', ' ');
    echo "<tr>
            <td>
              <a href=\"player.php?playerID={$row['playerID']}\">
                {$row['fullName']}
              </a>
            </td>
            <td class='siffror'>$score</td>
            <td class='siffror'>{$row['qualificationPoints']}</td>
          </tr>";
  }
  echo "</table>";
}
else {
  $gameList = Game::getGameList();
  echo "<table><tr><th>Namn<th>Bästa poäng<th>Medelpoäng";
  foreach ($gameList as $row) {
    echo "<tr>
            <td>
              <a href=\"game.php?gameID={$row['gameID']}\">
                {$row['fullName']}
              </a>
            </td>
            <td class='siffror'>" . number_format($row['maxScore'], 0, ',', ' ') . "</td>
            <td class='siffror'>" . number_format($row['avgScore'], 0, ',', ' ') . "</td>
          </tr>";
  }
  echo "</table>";
}
?>
</section>
</body>
</html>
