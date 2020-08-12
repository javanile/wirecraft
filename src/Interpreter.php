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
     *
     */
    protected $abstractList;

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
     * @param $abstractName
     */
    public function readFile($file, $abstractName)
    {
        $code = Yaml::parseFile($file);
        $abstract = $this->loadAbstract($abstractName);

        if (isset($abstract['default'])) {
            $this->processValidator($file, $code, $abstract['default']);
        }

        if (isset($abstract['validator'])) {
            $this->processValidator($file, $code, $abstract['validator']);
        }

        /*if (isset($abstractRules['validator'])) {
            $this->processValidator($file, $code, $abstractRules['validator']);
        }*/

        //var_dump($abstractRules);
        //var_dump($code);

        $this->code = array_merge($this->code, $code);
    }

    /**
     *
     * @param $abstractName
     * @return mixed
     */
    public function loadAbstract($abstractName)
    {
        if (empty($this->abstractList[$abstractName])) {
            $abstractFile = $this->abstractPath.'/'.$abstractName.'.yml';
            $this->abstractList[$abstractName] = Yaml::parseFile($abstractFile);
        }

        return $this->abstractList[$abstractName];
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
