<?php

namespace MazeRunner;

class Config
{
    /**
     * @var StdClass
     *
     * Properties are:
     *   - up
     *   - down
     *   - left
     *   - right
     *   - quit
     */
    public $keys;

    /**
     * @var StdClass
     *
     * Properties are:
     *   - maze
     *   - exit
     *   - runner
     */
    public $colours;

    /**
     * @var StdClass
     *
     * Properties are:
     *   - exit
     *   - runner
     */
    public $characters;

    /**
     * @param string $configFile Name/Path of the configuration file
     * @throws \Exception
     */
    public function __construct($configFile)
    {
        $this->initialise($configFile);
    }

    /**
     * @param $configFile Name/Path of the configuration file
     * @throws \Exception
     */
    public function initialise($configFile)
    {
        if (!file_exists($configFile) || !is_readable($configFile)) {
            throw new \Exception('Unable to read configuration file');
        }
        $configuration = parse_ini_file($configFile, true);
        foreach ($configuration as $key => $value) {
            $this->$key = (object) $value;
        }
    }
}
