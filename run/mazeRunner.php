<?php

include_once __DIR__ . '/../classes/Bootstrap.php';

$configFile = __DIR__ . '/config/config.ini';
$mapFile = __DIR__ . '/data/maze1.dat';

try {
    $mazeRunner = new MazeRunner\MazeRunner($configFile);
    $mazeRunner->setMaze($mapFile);
    $mazeRunner->run();
} catch (Exception $e) {
    echo 'ERROR: ', $e->getMessage();
}