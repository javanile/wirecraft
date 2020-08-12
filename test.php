<?php

require_once 'vendor/autoload.php';

use Javanile\Wirecraft\Interpreter;

$interpreter = new Interpreter(__DIR__.'/abstract');

$interpreter->readFile(__DIR__.'/files/test.yml', 'index');

foreach ($interpreter->dump()['resources'] as $resource) {
    var_dump($resource);
}
