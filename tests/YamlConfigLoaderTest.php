<?php
/**
* ------------------------------------------------------------------------------------
* YamlConfigLoaderTest.php
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

use Websublime\Config\Loader\YamlConfigLoader,
    Symfony\Component\Config\Resource\FileResource;

class YamlConfigLoaderTest extends \PHPUnit_Framework_TestCase {

    public function testYamlConfigLoaderInstance()
    {
        $yaml = new YamlConfigLoader(dirname(__DIR__));

        $this->assertInstanceOf('Websublime\Config\Loader\YamlConfigLoader', $yaml);
        print sprintf('YamlConfigLoader is instance: %s, with dirname: %s','Websublime\Config\Loader\YamlConfigLoader',dirname(__DIR__)).PHP_EOL;
    }

    public function testYamlConfigLoaderFile()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $config = $yaml->load('config.yaml','yaml');

        $this->assertArrayHasKey('config', $config);
        print sprintf('YamlFile have key: %s as an option.','config').PHP_EOL;
    }

    public function testYamlConfigLoaderAddResource()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $yaml->addResource(new FileResource($path.'/options.yaml'));
        $resource = $yaml->getResource('options');

        $this->assertFileExists($resource->getResource());
        print sprintf('YamlFile is present as: %s.',$resource->getResource()).PHP_EOL;
    }

    public function testYamlConfigLoaderResourcesRegister()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $yaml->addResource(new FileResource($path.'/options.yaml'));
        $yaml->addResource(new FileResource($path.'/config.yaml'));

        $resources = $yaml->getResources();

        $this->assertArrayHasKey('config', $resources);
        $this->assertArrayHasKey('options', $resources);

        print sprintf('YamlConfigLoader as %d resources.',count($resources)).PHP_EOL;
    }

    public function testYamlConfigLoaderResourcesLoad()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $yaml->addResource(new FileResource($path.'/options.yaml'));
        $yaml->addResource(new FileResource($path.'/config.yaml'));

        $resources = $yaml->loadResources();

        $this->assertArrayHasKey('config', $resources);
        $this->assertArrayHasKey('options', $resources);

        print sprintf('YamlConfigLoader as load %d resources.',count($resources)).PHP_EOL;
    }

    public function testYamlConfigLoaderExist()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $yaml->load('config.yaml','yaml');
        $exist = $yaml->exist('config');

        $this->assertTrue($exist);
        print sprintf('YamlConfigLoader as confirm that resource %s exist.','config').PHP_EOL;
    }

    public function testYamlConfigLoaderNotExist()
    {
        $path = dirname(__DIR__).'/tests/data';

        $yaml = new YamlConfigLoader($path);
        $exist = $yaml->exist('config');

        $this->assertFalse($exist);
        print sprintf('YamlConfigLoader as confirm that resource %s don\'t exist.','config').PHP_EOL;
    }
}

/** @end YamlConfigLoaderTest.php **/