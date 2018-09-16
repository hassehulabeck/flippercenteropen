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
if (isset($_GET['playerID'])) {
  $pid = $_GET['playerID'];
  // Get entries by player
  $player = new Player;
  $entryList = $player->getEntriesByPlayer($pid);

  // Get name of the player
  $playerName = $player->getPlayer($pid);
  echo "<h1>{$playerName['fullName']}</h1>";

  echo "<table><tr><th>Game<th>Score<th>Qual.pts";
  foreach ($entryList as $row) {
    $score = number_format($row['score'], 0, ',', ' ');
    echo "<tr>
            <td>
              <a href=\"game.php?gameID={$row['gameID']}\">
                {$row['abbreviation']}
              </a>
            </td>
            <td class='siffror'>$score</td>
            <td class='siffror'>{$row['qualificationPoints']}</td>
          </tr>";
  }
  echo "</table>";
}
else {
  $playerList = Player::playerList();
  echo "<table><tr><th>Namn<th>Tag<th>Land";
  foreach ($playerList as $row) {
    echo "<tr>
            <td>
              <a href=\"player.php?playerID={$row['playerID']}\">
                {$row['fullName']}
              </a>
            </td>
            <td>{$row['tag']}</td>
            <td>{$row['country']}</td>
          </tr>";
  }
  echo "</table>";
}
?>
</section>
</body>
</html>
