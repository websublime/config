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
class ConfigueCatalogue {

    private $catalogue;

    public function __construct(array $itens)
    {
        $this->flatten($itens);
        $this->catalogue = $itens;
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