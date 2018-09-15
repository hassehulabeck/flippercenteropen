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
$gameList = Game::getGameList();
echo "<table><tr><th>Namn<th>Tag<th>Land";
foreach ($gameList as $row) {
  echo "<tr>
          <td>
            <a href=\"game.php?gameID={$row['gameID']}\">
              {$row['fullName']}
            </a>
          </td>
        </tr>";
}
echo "</table>";
?>
</section>
</body>
</html>
