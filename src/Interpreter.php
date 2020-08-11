<?php

namespace Javanile\Wirecraft;

use Symfony\Component\Yaml\Yaml;

class Interpreter
{

    protected $abstractPath;

    protected $code;

    public function __construct($abstractPath)
    {
        $this->code = [];
        $this->abstractPath = $abstractPath;
    }

    public function loadFile($file, $abstract)
    {
        $abstractFile = $this->abstractPath.'/'.$abstract.'.yml';

        $abstractRules = Yaml::parseFile($abstractFile);
        $code = Yaml::parseFile($file);

        $this->processValidator($file, $code, $abstractRules['validator']);

        //var_dump($abstractRules);
        //var_dump($code);

        $this->code = array_merge($this->code, $code);
    }

    public function processValidator()
    {

    }

    public function dump()
    {
        return $this->code;
    }
}
