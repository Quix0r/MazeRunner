<?php

namespace MazeRunner;

class Config
{
    public $keys;
    public $colours;
    public $characters;

    public function __construct($config)
    {
        $this->initialise($config);
    }

    public function initialise($config)
    {
        if (!file_exists($config) || !is_readable($config)) {
            throw new \Exception('Unable to read configuration file');
        }
        $configuration = parse_ini_file($config, true);
        foreach ($configuration as $key => $value) {
            $value = (object) $value;
            $this->$key = $value;
        }
    }
}
