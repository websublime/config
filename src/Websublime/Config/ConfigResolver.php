<?php namespace Websublime\Config;
/**
* ------------------------------------------------------------------------------------
* ConfigResolver.php
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

use Symfony\Component\Config\Loader\LoaderInterface,
    Symfony\Component\Config\Loader\LoaderResolver,
    Symfony\Component\Config\Loader\DelegatingLoader;

/**
 * Class to resolve dependents classes.
 */
class ConfigResolver {

    private $resolver;

    private $delegate;

    protected $loader;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;

        $this->resolver = new LoaderResolver(array($loader));

        $this->delegate = new DelegatingLoader($this->resolver);
    }

    public function getDelegateLoader()
    {
        return $this->delegate;
    }

    public function getLoaderResolver()
    {
        return $this->resolver;
    }

    public function __call($method, $args)
    {
        if(method_exists($this->resolver, $method)){
            return call_user_func_array(array($this->resolver, $method), $args);      
        }

        if(method_exists($this->delegate, $method)){
            return call_user_func_array(array($this->delegate, $method), $args);
        }

        if(method_exists($this->loader, $method)){
            return call_user_func_array(array($this->loader, $method), $args);
        }

        throw new BadMethodCallException("The method do not exist in ConfigResolver.", 1);  
        
    }
}

/** @end ConfigResolver.php **/