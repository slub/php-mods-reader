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

namespace Slub\Mods\Element\Common;

/**
 * MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class BaseElement
{

    /**
     * @access protected
     * @var \SimpleXMLElement The metadata XML
     */
    protected \SimpleXMLElement $xml;

    /**
     * This extracts the essential MODS metadata from XML
     *
     * @access public
     *
     * @param \SimpleXMLElement $xml The XML to extract the metadata from
     *
     * @return void
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    /**
     * Get the text value of element
     *
     * @access public
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->xml[0];
    }

    /**
     * Get the string value of attribute
     */
    protected function getStringAttribute($attribute): string
    {
        if ($this->xml->attributes() != null) {
            $value = $this->xml->attributes()->$attribute;

            if (!empty($value)) {
                return $value;
            }
        }
        return '';
    }
}