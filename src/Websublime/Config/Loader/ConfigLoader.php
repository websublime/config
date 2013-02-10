<?php namespace Websublime\Config\Loader;
/**
* ------------------------------------------------------------------------------------
* ConfigLoader.php
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
use Symfony\Component\Config\Loader\FileLoader,
    Symfony\Component\Config\FileLocator,
    Websublime\Config\ConfigCatalogue;

abstract class ConfigLoader extends FileLoader {

    public function __construct(FileLocator $locator)
    {
        parent::__construct($locator);
    }

    /**
     * Method for loading resources of options.
     * 
     * @param  string $resource
     * @param  string $type
     * @return array
     */
    abstract public function load($resource, $type = 'php');
    
    /**
     * Method to add support for resource loader.
     * 
     * @param  string $resource
     * @param  string $type
     * @return 
     */
    public function supports($resource, $type = 'php')
    {
        return is_string($resource) && $type === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}

/** @end ConfigLoader.php **/