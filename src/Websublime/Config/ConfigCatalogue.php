<?php namespace Websublime\Config;
/**
* ------------------------------------------------------------------------------------
* ConfigCatalogue.php
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

/**
 * Class for catalogue options configurations.
 */
class ConfigCatalogue implements ConfigCatalogueInterface {

    /**
     * Config options catalogue flatten array.
     * 
     * @var array
     */
    private $catalogue;

    /**
     * Construct method that accepts initial config options on array format.
     * It will transform the array if it is multidimensional on a flatten array.
     * 
     * @param array $itens
     */
    public function __construct(array $itens)
    {
        $this->flatten($itens);
        $this->catalogue = $itens;
    }

    /**
     * Method to add options to catalogue. This method expect option to be mandatory.
     * Case $option isn't array, $key must be present because it wont be flatten.
     * 
     * @param mixed $option
     * @param string $key
     */
    public function add($option, $key = null)
    {
        if(is_array($option)){

            if(is_null($key)){
                $this->flatten($option);
            } else {
                $option = array($key => $option);
                $this->flatten($option);
            }

            return $this->catalogue = array_merge($this->catalogue, $option);
        }

        if(is_null($key)){
            throw new \InvalidArgumentException(sprintf("The key expect a definition: %s gived. Your value is not a array.",'null'));
        }

        return $this->catalogue[$key] = $option;
    }

    /**
     * Method to remove an option from the catalogue. The $key arg identifies the option
     * to be unset.
     * 
     * @param  string $key
     * @return boolean
     */
    public function remove($key)
    {
        if($this->exist($key)){
            unset($this->catalogue[$key]);
            return true;
        }

        return false;
    }

    /**
     * Method to get the value of an option. The $key argument identifies the option.
     * 
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        if($this->exist($key)){
            return $this->catalogue[$key];
        }

        return null;
    }
    
    /**
     * Method to verify if an option exists. The $key argument identifies the option.
     * 
     * @param  string $key
     * @return boolean
     */
    public function exist($key)
    {
        return array_key_exists($key, $this->catalogue);
    }

    /**
     * Method to get all options in the catalogue.
     * 
     * @return array
     */
    public function all()
    {
        return $this->catalogue;
    }


    /**
     * Convert multidimensionals array in one level.
     * 
     * @param  array  $messages
     * @param  array $subnode
     * @param  string $path
     * @return array
     */
    protected function flatten(array &$messages, array $subnode = null, $path = null)
    {
        if (null === $subnode) {
            $subnode =& $messages;
        }
        foreach ($subnode as $key => $value) {
            if (is_array($value)) {
                $nodePath = $path ? $path.'.'.$key : $key;
                $this->flatten($messages, $value, $nodePath);
                if (null === $path) {
                    unset($messages[$key]);
                }
            } elseif (null !== $path) {
                $messages[$path.'.'.$key] = $value;
            }
        }
    }
}

/** @end ConfigCatalogue.php **/