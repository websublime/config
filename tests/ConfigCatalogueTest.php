<?php
/**
* ------------------------------------------------------------------------------------
* ConfigCatalogueTest.php
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
use Websublime\Config\ConfigCatalogue;

 class ConfigCatalogueTest extends \PHPUnit_Framework_TestCase {

    public function testConfigueCatalogueInstance()
    {
        $catalogue = new ConfigCatalogue(array());

        $this->assertInstanceOf('Websublime\Config\ConfigCatalogue', $catalogue);
        print sprintf('Catalogue is instance: %s','Websublime\Config\ConfigCatalogue').PHP_EOL;
    }

    public function testConfigCatalogueAddAtribute()
    {
        $catalogue = new ConfigCatalogue(array());
        $catalogue->add(array('option' => 'valueAtribute'));

        $this->assertCount(1, $catalogue->all());
        print sprintf('Catalogue add one atribute: %s',$catalogue->get('option')).PHP_EOL;
    }

    public function testConfigCatalogueAddAtributeNotArray()
    {
        $catalogue = new ConfigCatalogue(array());
        $catalogue->add('valueAtribute','option');

        $this->assertCount(1, $catalogue->all());
        print sprintf('Catalogue add one atribute with key: %s and value: %s', 'option', $catalogue->get('option')).PHP_EOL;
    }

    public function testConfigCatalogueGetNull()
    {
        $catalogue = new ConfigCatalogue(array());

        $this->assertNull($catalogue->get('option'));
        print sprintf('Catalogue get null if option do not exist: %s', $catalogue->get('option')).PHP_EOL;
    }

    public function testConfigCatalogueRemoveAtribute()
    {
        $catalogue = new ConfigCatalogue(array());
        $catalogue->add(array('option' => 'valueAtribute'));

        $this->assertTrue($catalogue->remove('option'));
        print sprintf('Catalogue get true removing a option: key = %s', 'option').PHP_EOL;
    }

    public function testConfigCatalogueAtributeExist()
    {
        $catalogue = new ConfigCatalogue(array());
        $catalogue->add(array('option' => 'valueAtribute'));

        $this->assertTrue($catalogue->exist('option'));
        print 'Catalogue get true if option exist.'.PHP_EOL;
    }
 }
/** @end ConfigCatalogueTest.php **/