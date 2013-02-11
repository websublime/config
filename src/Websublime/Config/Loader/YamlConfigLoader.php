<?php namespace Websublime\Config\Loader;
/**
* ------------------------------------------------------------------------------------
* YamlConfigLoader.php
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
use Symfony\Component\Yaml\Yaml,
    Symfony\Component\Config\Resource\FileResource,
    Websublime\Config\ConfigLocator;

/**
 * Class to load yaml resources.
 */
class YamlConfigLoader extends ConfigLoader {

    /**
     * Cached file resources.
     * 
     * @var array
     */
    private $resources = array();

    /**
     * Method to construct class that depends on a path or array of paths
     * where it can search for resources.
     * 
     * @param string/array $path
     */
    public function __construct($path)
    {
        $locator = is_array($path) ? new ConfigLocator($path) : new ConfigLocator(array($path));

        parent::__construct($locator);
    }

    /**
     * Method to load options from an resource file
     * @param  string $resource
     * @param  string $type
     * @return array
     */
    public function load($resource, $type = 'yml')
    {
        $file = $this->getLocator()->locate($resource);
        
        $preferences = Yaml::parse($file);
        
        if (!is_array($preferences)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" must contain a YAML array.', $resource));
        }

        $this->addResource(new FileResource($file));

        return $preferences;
    }

    /**
     * Method to add resources to be load.
     * 
     * @param FileResource $resource
     */
    public function addResource(FileResource $resource)
    {
        $name = (basename($resource->getResource(), ".yml"));

        if(!array_key_exists($name, $this->resources)){
            $this->resources[$name] = $resource;
        }
    }

    /**
     * Method to get cached resources.
     * 
     * @param  string $name
     * @return FileResource
     */
    public function getResource($name)
    {
        if($this->exist($name)){
            return $this->resources[$name];
        }
    }

    /**
     * Method to get all cached resources.
     * 
     * @return array
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Method to load all registered resources.
     * 
     * @return array
     */
    public function loadResources()
    {
        $loaded = array();

        foreach ($this->resources as $name => $resource) {
            $loaded[$name] = $this->load($resource->getResource());
        }

        return $loaded;
    }

    /**
     * Method to check if resource exist in cache.
     * @param  string $resource
     * @return boolean
     */
    public function exist($resource)
    {
        if(array_key_exists($resource, $this->resources)){
            try {
                $this->getLocator()->locate($resource.'.yml');
            } catch (InvalidArgumentException $e) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Method to remove a registered resource.
     * 
     * @param  string $resource
     * @return void
     */
    public function remove($resource)
    {
        if($this->exist($resource)){
            unset($this->resources[$resource]);
        }
    }

}

/** @end YamlConfigLoader.php **/