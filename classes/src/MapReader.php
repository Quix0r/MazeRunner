<?php

namespace MazeRunner;

class MapReader
{
    public $start;
    public $end;
    public $map = [];
    public $width;
    public $height;

    public function __construct($mapFile)
    {
        $this->initialiseMap(
            $this->readMapData($mapFile)
        );
    }

    protected function toPosition($data)
    {
        list($x, $y) = str_getcsv($data);
        return new Position($x, $y);
    }

    protected function readMapData($mapFile)
    {
        $data = file($mapFile, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

        $this->start = $this->toPosition($data[0]);
        $this->end = $this->toPosition($data[1]);

        return str_getcsv($data[2]);
    }

    protected function initialiseMap(array $map)
    {
        $this->calculateWidth($map);
        $this->calculateHeight($map);

        foreach ($map as $rowData) {
            $this->map[] = str_split(
                str_pad(decbin($rowData), $this->width, '0', STR_PAD_LEFT)
            );
        }
    }

    protected function calculateWidth(array $map)
    {
        $this->width = strlen(decbin(max($map)));
    }

    protected function calculateHeight(array $map)
    {
        $this->height = count($map);
    }
}
