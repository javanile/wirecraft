<?php

namespace Javanile\Wirecraft\Tests;

use Javanile\Wirecraft\Interpreter;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    public function testReadFile()
    {
        $interpreter = new Interpreter(__DIR__.'/fixtures/abstract');
        $interpreter->readFile(__DIR__.'/fixtures/test.yml', 'default');

        $actual = $interpreter->dump();
        $expected = [
            'name' => 'test.yml',
            'static-value' => 'Hello World!',
            //'self-value' => 'Hello World!',
            'implemented-value' => [
                'key' => 'value'
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}
