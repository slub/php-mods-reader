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

namespace Slub\Mods\Element\Specific\OriginInfo;

use Slub\Mods\Attribute\Common\Miscellaneous\SuppliedAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\OriginInfo\Place\Cartographics;
use Slub\Mods\Element\Specific\OriginInfo\Place\PlaceTerm;
use Slub\Mods\Element\Xml\Element;

/**
 * Place MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#place
 *
 * @access public
 */
class Place extends BaseElement
{
    use SuppliedAttribute;

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
     * Get the array of the <placeTerms> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#placeterm
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return PlaceTerm[]
     */
    public function getPlaceTerms(string $query = ''): array
    {
        $placeTerms = [];
        $xpath = './mods:placeTerm' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $placeTerms[] = new PlaceTerm($value);
            }
        }
        return $placeTerms;
    }

    /**
     * Get the array of the <placeIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#placeidentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return BaseElement[]
     */
    public function getPlaceIdentifiers(string $query = ''): array
    {
        $placeIdentifiers = [];
        $xpath = './mods:placeIdentifier' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $placeIdentifiers[] = new BaseElement($value);
            }
        }
        return $placeIdentifiers;
    }

    /**
     * Get the array of the <cartographics> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#oiplacecartographics
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Cartographics[]
     */
    public function getCartographics(string $query = ''): array
    {
        $cartographics = [];
        $xpath = './mods:cartographics' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $cartographics[] = new Cartographics($value);
            }
        }
        return $cartographics;
    }
}
