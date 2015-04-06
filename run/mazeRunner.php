<?php

include_once __DIR__ . '/../classes/Bootstrap.php';

$mapFile = __DIR__ . '/data/maze1.dat';

try {
    $mazeRunner = new MazeRunner\MazeRunner(__DIR__ . '/config/config.ini');
    $mazeRunner->setMaze($mapFile);
    $mazeRunner->run();
} catch (Exception $e) {
    echo 'ERROR: ', $e->getMessage();
}