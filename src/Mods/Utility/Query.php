<?php

/**
 * Copyright (C) 2024 Saxon State and University Library Dresden
 *
 * This file is part of the php-mods-reader.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Slub\Mods\Utility;

/**
 * Query class for the 'php-mods-reader' library.
 *
 * @access public
 */
class Query
{

    /**
     * @var string The query
     **/
    private string $xPath;

    /**
     * This creates the query eq. './xyz[@att="zty"]="vcx"'.
     *
     * @access public
     *
     * @param string $baseXpath The base XPath for element
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return void
     */
    public function __construct(string $baseXpath, string $xpath = '', array $attributes = [], string $value = '')
    {
        $parsedAttributes = !empty($attributes) ? $this->getParsedAttributes($attributes) : '';

        if (!empty($xpath) && !empty($parsedAttributes)) {
            $baseXpath .= !empty($value) ? '[' . $xpath . '[' . $parsedAttributes . ']="' . $value . '"]' : '[' . $xpath . '[' . $parsedAttributes . ']]';
        } else if (!empty($xpath) || !empty($parsedAttributes)) {
            $inner = !empty($xpath) ? $xpath : $parsedAttributes;
            $baseXpath .= !empty($value) ? '[' . $inner . ']="' . $value . '"' : '[' . $inner . ']';
        } else if (!empty($value)) {
            $baseXpath .= '="' . $value . '"';
        }

        $this->xPath = $baseXpath;
    }

    public function getXPath(): string
    {
        return $this->xPath;
    }

    private function getParsedAttributes(array $attributes): string
    {
        $parsedAttributes = '';

        $amountAttributes = count($attributes);

        if ($amountAttributes == 1) {
            foreach ($attributes as $key => $value) {
                $parsedAttributes .= '@' . $key . '="' . $value . '"';
            }

            return $parsedAttributes;
        }

        $index = 0;
        $lastIndex = $amountAttributes - 1;

        foreach ($attributes as $key => $value) {
            $parsedAttributes .= '@' . $key . '="' . $value . '"';
            if ($index < $lastIndex) {
                $parsedAttributes .= ' AND ';
            }
            $index++;
        }

        return $parsedAttributes;
    }
}
