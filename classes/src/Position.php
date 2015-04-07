<?php

namespace MazeRunner;

class Position
{
    /**
     * The X-Coordinate of this position
     *
     * @var integer
     */
    protected $x;

    /**
     * The Y-Coordinate of this position
     *
     * @var integer
     */
    protected $y;

    /**
     * Create a new pair of coordinates as a position
     *
     * @param integer $x
     * @param integer $y
     */
    public function __construct($x = 1, $y = 1)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get the current X-Coordinate for this position
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the current X-Coordinate for this position to an absolute value
     *
     * @param integer $x
     */
    public function setX($x = 1)
    {
        $this->x = $x;
    }

    /**
     * Get the current Y-Coordinate for this position
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set the current Y-Coordinate for this position to an absolute value
     *
     * @param integer $y
     */
    public function setY($y = 1)
    {
        $this->y = $y;
    }

    /**
     * Move the current Ccordinates for this position relative to the current Coordinates
     *
     * @param integer $x
     * @param integer $y
     */
    public function move($x = 0, $y = 0)
    {
        $this->x += $x;
        $this->y += $y;
    }
}
