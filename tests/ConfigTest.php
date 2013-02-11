<?php
/**
* ------------------------------------------------------------------------------------
* ConfigTest.php
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
use Websublime\Config\Config,
    Websublime\Config\Loader\YamlConfigLoader;

class ConfigTest extends \PHPUnit_Framework_TestCase {

    public function testConfigueInstance()
    {
        $config = new Config();

        $this->assertInstanceOf('Websublime\Config\Config', $config);
        print sprintf('Config is instance: %s','Websublime\Config\Config').PHP_EOL;
    }

    public function testConfigGetCatalogue()
    {
        $config = new Config();
        $catalogue = $config->getCatalogue();

        $this->assertInstanceOf('Websublime\Config\ConfigCatalogue', $catalogue);
        print sprintf('ConfigCatalogue is instance: %s','Websublime\Config\ConfigCatalogue').PHP_EOL;
    }

    public function testConfigAddSimple()
    {
        $config = new Config();
        $config->add('Hello Option','option');
        $exist = $config->exist('option');

        $this->assertTrue($exist);
        print sprintf('ConfigueCatalogue as confirm that %s exist.','option').PHP_EOL;
    }

    public function testConfigAddArrayNoKey()
    {
        $config = new Config();
        $config->add(array('hello'=>'option'));
        $exist = $config->exist('hello');

        $this->assertTrue($exist);
        print sprintf('ConfigueCatalogue as confirm that %s exist.','hello').PHP_EOL;
    }

    public function testConfigAddArrayWithKey()
    {
        $config = new Config();
        $config->add(array('hello'=>'option'),'config');
        $exist = $config->exist('config.hello');

        $this->assertTrue($exist);
        print sprintf('ConfigueCatalogue as confirm that %s exist.','config.hello').PHP_EOL;
    }

    public function testConfigsetConfigResolver()
    {
        $yaml = new YamlConfigLoader(dirname(__DIR__));

        $config = new Config();
        $config->setConfigResolver($yaml);

        $resolver = $config->getConfigResolver();

        $this->assertInstanceOf('Websublime\Config\ConfigResolver', $resolver);
        print sprintf('Resolver is instance: %s','Websublime\Config\ConfigResolver').PHP_EOL;
    }
}

/** @end ConfigTest.php **/