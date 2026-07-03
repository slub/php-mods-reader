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
use Slub\Mods\Utility\Query;

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
     * @param string $query for metadata search
     *
     * @return PhysicalLocation[]
     */
    public function getPhysicalLocations(string $query = ''): array
    {
        return $this->getElements('./mods:physicalLocation' . $query, PhysicalLocation::class);
    }

    /**
     * Get the array of the <physicalLocation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#physicallocation
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return PhysicalLocation[]
     */
    public function getPhysicalLocationsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:namePart', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), PhysicalLocation::class);
    }

    /**
     * Get the value of the <shelfLocator> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#shelfLocator
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getShelfLocator(string $query = ''): ?LanguageElement
    {
        return $this->getLanguageElement('./mods:shelfLocator' . $query);
    }

    /**
     * Get the value of the <shelfLocator> element by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#shelfLocator
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return ?LanguageElement
     */
    public function getShelfLocatorByParameters(string $xpath = '', array $attributes = [], string $value = ''): ?LanguageElement
    {
        $query = new Query('./mods:shelfLocator', $xpath, $attributes, $value);
        return $this->getLanguageElement($query->getXPath());
    }

    /**
     * Get the array of the <url> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#url
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Url[]
     */
    public function getUrls(string $query = ''): array
    {
        return $this->getElements('./mods:url' . $query, Url::class);
    }

    /**
     * Get the array of the <url> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#url
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Url[]
     */
    public function getUrlsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:url', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Url::class);
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
        return $this->getElement('./mods:holdingSimple' . $query, HoldingSimple::class);
    }

    /**
     * Get the value of the <holdingSimple> element by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#holdingsimple
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return ?HoldingSimple
     */
    public function getHoldingSimpleByParameters(string $xpath = '', array $attributes = [], string $value = ''): ?HoldingSimple
    {
        $query = new Query('./mods:holdingSimple', $xpath, $attributes, $value);
        return $this->getElement($query->getXPath(), HoldingSimple::class);
    }

    /**
     * Get the value of the <holdingExternal> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#holdingexternal
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return string
     */
    public function getHoldingExternal(string $query = ''): string
    {
        $xpath = './mods:holdingExternal' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return $element->getFirstValue()->asXML();
        }
        return '';
    }
}
