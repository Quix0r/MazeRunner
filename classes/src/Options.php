<?php

namespace MazeRunner;

class Options
{
    /**
     * @var string[]
     */
    protected static $keyOptions = ['up:', 'down:', 'left:', 'right:', 'quit:'];

    /**
     * @var string[]
     */
    protected static $mazeOptions = ['reverse', 'flip:', 'transpose'];

    /**
     * @var string[]
     */
    protected static $mazeFlipOptions = ['Horizontal', 'Vertical'];

    /**
     * @param Config $config
     */
    public function keyOptions(Config $config)
    {
        $optionValues = getopt('', static::$keyOptions);

        foreach ($optionValues as $key => $value) {
            $config->keys->$key = $value[0];
        }
    }

    /**
     * @param Maze $maze
     * @throws \Exception
     */
    public function mazeOptions(Maze $maze)
    {
        $optionValues = getopt('', static::$mazeOptions);

        foreach ($optionValues as $key => $value) {
            switch($key) {
                case 'flip':
                    $this->flipMaze(
                        $maze,
                        explode(',', $value)
                    );
                    break;
                case 'transpose':
                    $maze->transpose();
                    break;
                case 'reverse':
                    $maze->reverse();
                    break;
            }
        }
    }

    /**
     * @param Maze $maze
     * @param string[] $values
     * @throws \Exception
     */
    protected function flipMaze(Maze $maze, $values)
    {
        foreach (array_map('trim', $values) as $value) {
            $value = ucfirst(strtolower($value));
            if (!in_array($value, static::$mazeFlipOptions, true)) {
                throw new \Exception('--flip value must be horizontal or vertical');
            }
            $method = "flip{$value}";
            $maze->$method();
        }
    }
}
