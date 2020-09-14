<?php

namespace Javanile\Wirecraft;

use Symfony\Component\Yaml\Yaml;

class Interpreter
{
    /**
     * @var array
     */
    protected $manifest;

    /**
     *
     */
    protected $filesCache;

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
        $this->manifest = [];
        $this->filesCache = [];
        $this->abstractPath = $abstractPath;
    }

    /**
     * @param $file
     * @param $abstractName
     */
    public function readFile($file, $abstractName)
    {
        $file = realpath($file);

        $manifest = $this->loadFileFromCache($file);
        $abstract = $this->loadAbstractFromCache($abstractName);

        if (isset($abstract['default'])) {
            $manifest = $this->processDefault($manifest, $abstract, $file);
        }

        if (isset($abstract['validate'])) {
            $manifest = $this->processValidate($manifest, $abstract, $file);
        }

        if (isset($abstract['resolve'])) {
            $manifest = $this->processResolve($manifest, $abstract, $file);
        }

        $this->manifest = array_replace_recursive($this->manifest, $manifest);
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function loadFileFromCache($file)
    {
        return Yaml::parseFile($file);
    }

    /**
     *
     * @param $abstractName
     * @return mixed
     */
    public function loadAbstractFromCache($abstractName)
    {
        if (empty($this->abstractList[$abstractName])) {
            $abstractFile = $this->abstractPath.'/'.$abstractName.'.yml';
            $this->abstractList[$abstractName] = Yaml::parseFile($abstractFile);
        }

        return $this->abstractList[$abstractName];
    }

    /**
     * @param $manifest
     * @param $abstract
     * @param $file
     */
    public function processDefault($manifest, $abstract, $file)
    {
        foreach ($abstract['default'] as $key => $value) {
            if (empty($manifest[$key])) {
                $manifest[$key] = $value;
            }
        }

        return $manifest;
    }

    /**
     * @param $file
     * @param $code
     * @param $validators
     */
    public function processValidate($manifest, $abstract, $file)
    {

    }

    /**
     * @param $manifest
     * @param $abstract
     * @param $file
     */
    public function processResolve($manifest, $abstract, $file)
    {
        foreach ($abstract['resolve'] as $key => $value) {
            if (empty($manifest[$key])) {
                $manifest[$key] = $value;
            }
        }

        return $manifest;
    }

    /**
     * @return array
     */
    public function dump()
    {
        return $this->manifest;
    }
}
