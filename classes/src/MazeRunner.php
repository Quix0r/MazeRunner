<?php

namespace MazeRunner;

class MazeRunner
{
    protected $console;
    protected $config;
    protected $maze;
    protected $position;

    public function __construct($config)
    {
        $this->console = new Console();
        $this->config = new Config($config);
        (new Options)->keyOptions($this->config);
    }

    public function setMaze($mapFile)
    {
        $this->maze = new maze($this->console, $this->config, $mapFile);
        (new Options)->mazeOptions($this->maze);
        $this->position = $this->maze->render();
        $this->displayPosition();
    }

    public function displayPosition()
    {
        $this->console->cursorTo(
            $this->maze->yOffset + $this->position->getY(),
            $this->maze->xOffset + $this->position->getX() + 2
        );
        $this->console->setColour($this->config->colours->runner);
        echo $this->config->characters->runner;
        $this->console->reset();
    }

    public function blankPosition()
    {
        $this->console->cursorTo(
            $this->maze->yOffset + $this->position->getY(),
            $this->maze->xOffset + $this->position->getX() + 2
        );
        echo ' ';
        $this->console->reset();
    }

    public function setInputPosition()
    {
        // Cursor movement is row then column (y then x)
        $this->console->cursorTo($this->maze->yOffset + $this->maze->height + 2, 1);
    }

    protected function movePosition($x = 0, $y = 0)
    {
        $oldPosition = clone $this->position;
        $this->blankPosition();
        $this->position->move($x, $y);
        if (($this->position->getX() < 1) || ($this->position->getY() < 1) ||
            ($this->position->getX() > $this->maze->width) || ($this->position->getY() > $this->maze->height)) {
            // Trying to move outside the boundaries of the maze
            $this->position = $oldPosition;
        } elseif (!$this->maze->isSpace($this->position)) {
            // Trying to move through a wall
            $this->position = $oldPosition;
        }
        $this->displayPosition();
    }

    public function run()
    {
        $this->setInputPosition();
        do {
            do {
                // A character from STDIN, ignoring null characters
                $keyPressed = fgetc(STDIN);
            } while (empty($keyPressed));

            $this->assessKeyPress($keyPressed);

            if ($this->position == $this->maze->end) {
                echo '***  WINNER  ***';
                break;
            }
        } while ($keyPressed != $this->config->keys->quit);
    }

    protected function assessKeyPress($keyPressed)
    {
        if ($keyPressed != "\n" && $keyPressed != "\r") {
            switch(strtolower($keyPressed)) {
                case $this->config->keys->up:
                    $this->movePosition(0, -1);
                    break;
                case $this->config->keys->left:
                    $this->movePosition(-1, 0);
                    break;
                case $this->config->keys->right:
                    $this->movePosition(1, 0);
                    break;
                case $this->config->keys->down:
                    $this->movePosition(0, 1);
                    break;
            }
        }
        $this->setInputPosition();
        $this->console->clearLine();
    }
}
