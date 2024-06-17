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

namespace Slub\Mods\Element;

use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\Location\HoldingSimple;
use Slub\Mods\Element\Specific\Location\PhysicalLocation;
use Slub\Mods\Element\Specific\Location\Url;
use Slub\Mods\Element\Xml\Element;

/**
 * Location MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/location.html
 *
 * @access public
 */
class Location extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

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
     * Get the array of the <physicalLocation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#physicallocation
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return PhysicalLocation[]
     */
    public function getPhysicalLocations(string $query = ''): array
    {
        $physicalLocations = [];
        $xpath = './mods:physicalLocation' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $physicalLocations[] = new PhysicalLocation($value);
        }
        return $physicalLocations;
    }

    /**
     * Get the value of the <shelfLocator> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#shelfLocator
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getShelfLocator(string $query = ''): ?LanguageElement
    {
        $xpath = './mods:shelfLocator' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the the array of the <url> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#url
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Url[]
     */
    public function getUrls(string $query = ''): array
    {
        $urls = [];
        $xpath = './mods:url' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $urls[] = new Url($value);
        }
        return $urls;
    }

    /**
     * Get the value of the <holdingSimple> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#holdingsimple
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?HoldingSimple
     */
    public function getHoldingSimple(string $query = ''): ?HoldingSimple
    {
        $xpath = './mods:holdingSimple' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new HoldingSimple($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the value of the <holdingExternal> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#holdingexternal
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return string
     */
    public function getHoldingExternal(string $query = ''): string
    {
        $xpath = './mods:holdingExternal' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return $element->getValues()[0]->asXML();
        }
        return '';
    }
}
