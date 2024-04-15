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

namespace Slub\Mods\Element\Specific\Part;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Xml\Element;

/**
 * Extent MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/part.html#extent
 *
 * @access public
 */
class Extent extends BaseElement
{

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
        parent::__construct($xml);
    }

    /**
     * Get the value of the 'unit' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#unit
     *
     * @access public
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->getStringAttribute('unit');
    }

    /**
     * Get the value of the <start> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#start
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getStart(string $query = ''): LanguageElement
    {
        return $this->getLanguageElement('./mods:start' . $query);
    }

    /**
     * Get the value of the <end> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#end
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getEnd(string $query = ''): LanguageElement
    {
        return $this->getLanguageElement('./mods:end' . $query);
    }

    /**
     * Get the value of the <total> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#total
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return int value or 0 when no value found
     */
    public function getTotal(string $query = ''): int
    {
        $xpath = './mods:total' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return (int) $element->getValues()[0];
        }
        return 0;
    }

    /**
     * Get the value of the <list> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#list
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getList(string $query = ''): LanguageElement
    {
        return $this->getLanguageElement('./mods:list' . $query);
    }
}
