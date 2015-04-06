<?php

namespace MazeRunner;

class Position
{
    protected $x;
    protected $y;

    public function __construct($x = 1, $y = 1)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX($x = 1)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y = 1)
    {
        $this->y = $y;
    }

    public function move($x = 0, $y = 0)
    {
        $this->x += $x;
        $this->y += $y;
    }
}
