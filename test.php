<?php

require_once 'vendor/autoload.php';

use Javanile\Wirecraft\Interpreter;

$interpreter = new Interpreter(__DIR__.'/abstract');

$interpreter->loadFile(__DIR__.'/files/test.yml', 'index');

foreach ($interpreter->dump()['resources'] as $resource) {

}
