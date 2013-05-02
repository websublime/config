<?php
/**
 * ------------------------------------------------------------------------------------
 * PhpConfigLoaderTest.php
 * ------------------------------------------------------------------------------------
 *
 * @package Websublime
 * @author  Miguel Ramos <miguel.marques.ramos@gmail.com>
 * @link    https://www.websublime.com
 * @version 0.1
 *
 * This file is part of Websublime Project.
 *
 * Copyright (c) 2012 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
use Websublime\Config\Loader\PhpConfigLoader,
    Symfony\Component\Config\Resource\FileResource;

class PhpConfigLoaderTest extends \PHPUnit_Framework_TestCase {

    public function testPhpConfigLoaderInstance()
    {
        $php = new PhpConfigLoader(dirname(__DIR__));

        $this->assertInstanceOf('Websublime\Config\Loader\PhpConfigLoader', $php);
        print sprintf('PhpConfigLoader is instance: %s, with dirname: %s','Websublime\Config\Loader\PhpConfigLoader',dirname(__DIR__)).PHP_EOL;
    }

    public function testPhpConfigLoaderFile()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $config = $php->load('config.php','php');

        $this->assertArrayHasKey('config', $config);
        print sprintf('PhpFile have key: %s as an option.','config').PHP_EOL;
    }

    public function testPhpConfigLoaderAddResource()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $php->addResource(new FileResource($path.'/options.php'));
        $resource = $php->getResource('options');

        $this->assertFileExists($resource->getResource());
        print sprintf('PhpFile is present as: %s.',$resource->getResource()).PHP_EOL;
    }

    public function testPhpConfigLoaderResourcesRegister()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $php->addResource(new FileResource($path.'/options.php'));
        $php->addResource(new FileResource($path.'/config.php'));

        $resources = $php->getResources();

        $this->assertArrayHasKey('config', $resources);
        $this->assertArrayHasKey('options', $resources);

        print sprintf('PhpConfigLoader as %d resources.',count($resources)).PHP_EOL;
    }

    public function testPhpConfigLoaderResourcesLoad()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $php->addResource(new FileResource($path.'/options.php'));
        $php->addResource(new FileResource($path.'/config.php'));

        $resources = $php->loadResources();

        $this->assertArrayHasKey('config', $resources);
        $this->assertArrayHasKey('options', $resources);

        print sprintf('PhpConfigLoader as load %d resources.',count($resources)).PHP_EOL;
    }

    public function testPhpConfigLoaderExist()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $php->load('config.php','php');
        $exist = $php->exist('config');

        $this->assertTrue($exist);
        print sprintf('PhpConfigLoader as confirm that resource %s exist.','config').PHP_EOL;
    }

    public function testPhpConfigLoaderNotExist()
    {
        $path = dirname(__DIR__).'/tests/data';

        $php = new PhpConfigLoader($path);
        $exist = $php->exist('config');

        $this->assertFalse($exist);
        print sprintf('PhpConfigLoader as confirm that resource %s don\'t exist.','config').PHP_EOL;
    }
}
/** @end PhpConfigLoaderTest.php **/