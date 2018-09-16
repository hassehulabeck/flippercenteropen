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

if (isset($_POST['submitEntry'])) {
  var_dump($_POST);
  $entry = new Entry;
  var_dump($entry->setupValues($_POST));
}

?>
<?php
  echo Header::getHeader();
  echo Menu::getMenu();
?>
<section id='content'>
<h1>Lista över spelare</h1>
<?php
$lista = Player::playerList();
echo "<table><tr><th>Namn<th>Tag<th>Land";
foreach ($lista as $row) {
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
?>
<h1>Lägg till spelare</h1>
<?php
$player = new Player();
echo $player->getPlayerForm();

// Skriv in resultat för en spelare
echo "<h1>Registrera entry</h1>";
$entryString = "<form action='index.php' method='POST'>";
$allaSpelare = Player::playerList();
$entryString .= "<select name='player'>";
foreach ($allaSpelare as $row) {
  $entryString .= "
  <option value='{$row['playerID']}'>
    {$row['fullName']}
  </option>";
}
$entryString .= "</select>";

// Hämta inputfält för alla spel.
$allaSpel = Game::getGameInput();
foreach ($allaSpel as $row) {
  $entryString .= "
  <label for ='{$row['abbreviation']}'>
    {$row['fullName']}
  </label>";
  $entryString .= "
    <input
      type='number'
      value=''
      id='{$row['gameID']}'
      name='g{$row['gameID']}'>
  ";
}
$entryString .= "<input type='submit' name='submitEntry' value='Registrera resultat'>";
$entryString .= "</form>";
echo $entryString

?>
</section>
</body>
</html>
