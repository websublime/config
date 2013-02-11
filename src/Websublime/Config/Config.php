<?php namespace Websublime\Config;
/**
* ------------------------------------------------------------------------------------
* Config.php
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
use Symfony\Component\Config\Loader\LoaderInterface,
    Websublime\Config\Loader\ConfigLoaderException;

class Config {

    private $catalogue;

    private $resolver;

    public function __construct($itens = array())
    {
        $this->catalogue = new ConfigCatalogue($itens);
    }

    public function getCatalogue()
    {
        return $this->catalogue;
    }

    public function import($file)
    {
        if(is_null($this->resolver)){
            throw new BadMethodCallException("Please first setConfigResolver() to know what to use to import a file.", 1);   
        }

        $loader = $this->resolver->getDelegateLoader();

        $type = pathinfo($file,PATHINFO_EXTENSION);

        if($type == 'yml' OR $type == 'php'){
            $loaded = $loader->load($file, $type);

            $name = (basename($file, ".".$type));

            $this->add($loaded, $name);
        } else {
            throw new ConfigLoaderException($file, 'The file you selected is not valid for loading with current ConfigLoaders.', 1); 
        }
        
    }

    public function setConfigResolver(LoaderInterface $loader)
    {
        $this->resolver = new ConfigResolver($loader);
    }

    public function getConfigResolver()
    {
        return $this->resolver;
    }

    public function __call($method, $args)
    {
        if(!method_exists($this->catalogue, $method)){
            throw new BadMethodCallException("The method do not exist in ConfigCatalogue.", 1);        
        }

        return call_user_func_array(array($this->catalogue, $method), $args);
    }
}

/** @end Config.php **/