<?php

// Se alla fel under development.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoloader för klasserna
spl_autoload_register(function ($class_name) {
    include 'class/class.' . $class_name . '.php';
});

// Lägg till spelare
if (isset($_POST['submitPlayer'])) {

  $player = new Player();
  echo $player->setter($_POST);

}


?>
<h1>Lista över spelare</h1>
<?php
$lista = Player::playerList();
echo "<table><tr><th>Namn<th>Tag<th>Land";
foreach ($lista as $row) {
  echo "<tr>
          <a href=\"player.php?playerID={$row['playerID']}\">
            <td>{$row['fullName']}</td>
          </a>
          <td>{$row['tag']}</td>
          <td>{$row['country']}</td>
        </tr>";
}
echo "</table>";
?>
<h1>Lägg till spelare</h1>
<?php
$player = new Player();
echo $player->getPlayerForm();
?>
