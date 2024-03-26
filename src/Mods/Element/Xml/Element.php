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

namespace Slub\Mods\Element\Xml;

/**
 * MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Element
{

    /**
     * @access protected
     * @var array|false
     */
    protected array $values;

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
     * @param string $xpath The XPath for metadata search
     *
     * @return void
     */
    public function __construct(\SimpleXMLElement $xml, string $xpath)
    {
        $this->xml = $xml;
        $this->xml->registerXPathNamespace('mods', 'http://www.loc.gov/mods/v3');

        $this->values = $this->xml->xpath($xpath);
    }

    /**
     * Check if element exists.
     *
     * @access public
     *
     * @return bool
     */
    public function exists(): bool
    {
        return $this->values != false;
    }

    /**
     * Get the value of the queried element
     *
     * @access public
     *
     * @return array|false
     */
    public function getValues(): array
    {
        return $this->values;
    }
}