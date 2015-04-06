<?php

include_once __DIR__ . '/../classes/Bootstrap.php';

$mapFile = __DIR__ . '/data/maze1.dat';

$mazeRunner = new MazeRunner\MazeRunner(__DIR__ . '/config/config.ini');
$mazeRunner->setMaze($mapFile);
$mazeRunner->run();
