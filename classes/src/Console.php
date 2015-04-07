<?php

namespace MazeRunner;

class Console
{
    const CSI = "\033[";

    const STYLE_OFF = 'off';
    const STYLE_BOLD = 'bold';
    const STYLE_ITALIC = 'italic';
    const STYLE_UNDERLINE = 'underline';
    const STYLE_BLINK = 'blink';
    const STYLE_INVERSE = 'inverse';
    const STYLE_HIDDEN = 'hidden';

    protected static $styleCodes = [
        self::STYLE_OFF        => 0,
        self::STYLE_BOLD       => 1,
        self::STYLE_ITALIC     => 3,
        self::STYLE_UNDERLINE  => 4,
        self::STYLE_BLINK      => 5,
        self::STYLE_INVERSE    => 7,
        self::STYLE_HIDDEN     => 8,
    ];

    const COLOUR_BLACK = 'black';
    const COLOUR_RED = 'red';
    const COLOUR_GREEN = 'green';
    const COLOUR_YELLOW = 'yellow';
    const COLOUR_BLUE = 'blue';
    const COLOUR_MAGENTA = 'magenta';
    const COLOUR_CYAN = 'cyan';
    const COLOUR_WHITE = 'white';

    public static $styleColours = [
        self::COLOUR_BLACK      => 30,
        self::COLOUR_RED        => 31,
        self::COLOUR_GREEN      => 32,
        self::COLOUR_YELLOW     => 33,
        self::COLOUR_BLUE       => 34,
        self::COLOUR_MAGENTA    => 35,
        self::COLOUR_CYAN       => 36,
        self::COLOUR_WHITE      => 37,
    ];

    private $state = [
        'colour' => 37,
        'background' => 40,
    ];

    /**
     * Clear the screen, and set cursor position to top left
     */
    public function clearScreen()
    {
        echo self::CSI . '2J';
    }

    /**
     * Clear from the current cursor position to the end of line
     */
    public function clearLine()
    {
        echo self::CSI . '2K';
    }

    public function setStyle($style = 'off')
    {
        $style = strtolower($style);
        if (!isset(self::$styleCodes[$style])) {
            return;
        }

        echo self::CSI . self::$styleCodes[$style] . 'm';
    }

    private function applyState()
    {
        echo self::CSI . implode(';', $this->state) . 'm';
    }

    public function setColour($colour = self::COLOUR_WHITE)
    {
        $colour = strtolower($colour);
        if (!isset(self::$styleColours[$colour])) {
            return;
        }

        $this->state['colour'] = self::$styleColours[$colour];
        $this->applyState();
    }

    public function setBackground($colour = self::COLOUR_BLACK)
    {
        $colour = strtolower($colour);
        if (!isset(self::$styleColours[$colour])) {
            return;
        }

        $this->state['background'] = self::$styleColours[$colour] + 10;
        $this->applyState();
    }

    public function reset()
    {
        $this->state = [
            'colour' => self::$styleColours[self::COLOUR_WHITE],
            'background' => self::$styleColours[self::COLOUR_BLACK] + 10,
        ];
        echo self::CSI . '0m';
    }

    public function cursorUp($rows = 1)
    {
        //  CSI n A
        echo self::CSI . $rows . 'A';
    }

    public function cursorDown($rows = 1)
    {
        //  CSI n B
        echo self::CSI . $rows . 'B';
    }

    public function cursorRight($columns = 1)
    {
        //  CSI n C
        echo self::CSI . $columns . 'C';
    }

    public function cursorLeft($columns = 1)
    {
        //  CSI n D
        echo self::CSI . $columns . 'D';
    }

    public function cursorTo($row = 1, $column = 1)
    {
        //  CSI n ; m H
        echo self::CSI . $row . ';' . $column . 'H';
    }
}
