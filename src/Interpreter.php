<?php

namespace Javanile\Wirecraft;

use Symfony\Component\Yaml\Yaml;

class Interpreter
{
    /**
     * @var array
     */
    protected $code;

    /**
     * @var
     */
    protected $abstractPath;

    /**
     * Interpreter constructor.
     *
     * @param $abstractPath
     */
    public function __construct($abstractPath)
    {
        $this->code = [];
        $this->abstractPath = $abstractPath;
    }

    /**
     * @param $file
     * @param $abstract
     */
    public function readFile($file, $abstract)
    {
        $code = Yaml::parseFile($file);

        $abstractFile = $this->abstractPath.'/'.$abstract.'.yml';
        $abstractRules = Yaml::parseFile($abstractFile);

        if (isset($abstractRules['validator'])) {
            $this->processValidator($file, $code, $abstractRules['validator']);
        }

        if (isset($abstractRules['validator'])) {
            $this->processValidator($file, $code, $abstractRules['validator']);
        }

        //var_dump($abstractRules);
        //var_dump($code);

        $this->code = array_merge($this->code, $code);
    }

    /**
     * @param $file
     * @param $code
     * @param $validators
     */
    public function processValidator($file, $code, $validators)
    {

    }

    /**
     * @return array
     */
    public function dump()
    {
        return $this->code;
    }
}
