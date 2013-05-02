<?php namespace Websublime\Config;
/**
* ------------------------------------------------------------------------------------
* ConfigLocator.php
* ------------------------------------------------------------------------------------
*
* @package Websublime
* @author  Miguel Ramos <miguel.marques.ramos@gmail.com>
* @link    https://www.websublime.com
* @version 0.2
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
use Symfony\Component\Config\FileLocator;

/**
 * Class for register paths to find config files.
 */
class ConfigLocator extends FileLocator {

    /**
     * Method construct that accepts an arrays of dirs paths.
     * 
     * @param array $dirs
     */
    public function __construct(array $dirs = array())
    {
        parent::__construct($dirs);
    }

    /**
     * Method to add a path or an array of paths to locator for future search of files.
     * 
     * @param string/array $path
     */
    public function addPath($path)
    {
        if(is_string($path)){
            $this->paths[] = $path;            
        }
        
        if(is_array($path)){
            $this->paths = array_merge($this->paths, $paths);
        }
    }

    /**
     * Method to get all paths registered.
     * 
     * @return array
     */
    public function getPaths()
    {
        return $this->paths;
    }
}

/** @end ConfigLocator.php **/