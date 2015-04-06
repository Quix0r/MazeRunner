<?php

namespace MazeRunner;

class Options
{
    protected static $keyOptions = ['up:', 'down:', 'left:', 'right:', 'quit:'];

    protected static $mazeOptions = ['reverse', 'flip:', 'transpose'];
    
    protected static $mazeFlipOptions = ['Horizontal', 'Vertical'];

    public function keyOptions(config $config)
    {
        $optionValues = getopt('', static::$keyOptions);

        foreach($optionValues as $key => $value) {
            $config->keys->$key = $value[0];
        }
    }

    public function mazeOptions(maze $maze)
    {
        $optionValues = getopt('', static::$mazeOptions);

        foreach($optionValues as $key => $values) {
            switch($key) {
                case 'flip' :
                    $this->flipMaze($maze, $values);
                    break;
                case 'transpose' :
                    $maze->transpose();
                    break;
                case 'reverse' :
                    $maze->reverse();
                    break;
            }
        }
    }

    protected function flipMaze(maze $maze, $values)
    {
        $values = explode(',', $values);
        foreach(array_map('trim', $values) as $value) {
            $value = ucfirst(strtolower($value));
            if (!in_array($value, static::$mazeFlipOptions, true)) {
                throw new \Exception('--flip value must be horizontal or vertical');
            }
            $method = "flip{$value}";
            $maze->$method();
        }
    }
}
