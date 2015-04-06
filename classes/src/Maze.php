<?php

namespace MazeRunner;

class Maze
{
    protected $console;
    protected $config;
    protected $start;
    public $end;
    protected $map;
    public $xOffset;
    public $width;
    public $yOffset;
    public $height;

    public function __construct(Console $console, Config $config, $mapFile)
    {
        $this->initialiseMaze($mapFile);

        $this->console = $console;
        $this->config = $config;
        $this->console->clearScreen();
    }

    protected function initialiseMaze($mapFile)
    {
        $mapReader = new MapReader($mapFile);

        $this->start = $mapReader->start;
        $this->end = $mapReader->end;
        $this->map = $mapReader->map;
        $this->width = $mapReader->width;
        $this->height = $mapReader->height;
    }

    public function render()
    {
        $this->xOffset = strlen($this->height);
        $this->yOffset = strlen($this->width) + 2;
        $this->renderHeader($this->xOffset + 2);

        echo $this->buildBorder($this->xOffset + 1, '.'), PHP_EOL;

        foreach ($this->map as $rowNumber => $rowData) {
            echo sprintf(" %{$this->xOffset}d|", (++$rowNumber));
            foreach ($rowData as $column) {
                if ($column) {
                    $this->console->setBackground($this->config->colours->maze);
                }
                echo ' ';
                $this->console->reset();
            }
            echo '|', PHP_EOL;
        }

        echo $this->buildBorder($this->xOffset + 1, "'"), PHP_EOL;

        $this->renderEndPoint();
        return $this->start;
    }

    protected function renderEndPoint()
    {
        $this->console->cursorTo($this->yOffset + $this->end->getY(), $this->xOffset + $this->end->getX() + 2);
        $this->console->setColour($this->config->colours->exit);
        echo $this->config->characters->exit;
        $this->console->reset();
    }

    protected function renderHeader($xOffset)
    {
        echo PHP_EOL;
        for ($line = strlen($this->width); $line > 0; --$line) {
            echo str_repeat(' ', $xOffset),
                implode(
                    '',
                    array_map(
                        function ($value) use ($line) {
                            return ($value >= pow(10, $line-1)) ? strrev($value)[$line-1] : ' ';
                        },
                        range(1, $this->width)
                    )
                ),
                PHP_EOL;
        }
    }

    protected function buildBorder($xOffset, $cornerChar)
    {
        return str_repeat(' ', $xOffset) .
            $cornerChar .
            str_repeat('-', $this->width) .
            $cornerChar;
    }

    public function isSpace(Position $position)
    {
        return empty($this->map[$position->getY()-1][$position->getX()-1]);
    }

    public function reverse()
    {
        $start = $this->end;
        $this->end = $this->start;
        $this->start = $start;
    }

    public function flipHorizontal()
    {
        $this->map = array_map(
            'array_reverse',
            $this->map
        );
        $this->start->setX($this->width - $this->start->getX() + 1);
        $this->end->setX($this->width - $this->end->getX() + 1);
    }

    public function flipVertical()
    {
        $this->map = array_reverse($this->map);
        $this->start->setY($this->height - $this->start->getY() + 1);
        $this->end->setY($this->height - $this->end->getY() + 1);
    }

    public function transposePosition(position $position)
    {
        list($x, $y) = [$position->getY(), $position->getX()];
        $position->setX($x);
        $position->setY($y);
    }

    public function transpose()
    {
        $this->map = call_user_func_array(
            'array_map',
            array_merge(
                array(null),
                $this->map
            )
        );
        list($this->width, $this->height) = [$this->height, $this->width];
        $this->transposePosition($this->start);
        $this->transposePosition($this->end);
    }
}
