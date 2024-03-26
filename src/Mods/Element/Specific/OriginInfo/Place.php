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
use Slub\Mods\Element\Specific\OriginInfo\Place\PlaceIdentifier;

/**
 * Place MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Place extends BaseElement
{
    use SuppliedAttribute;

    /**
     * @access private
     * @var array
     */
    private array $placeTerms;

    /**
     * @access private
     * @var PlaceIdentifier
     */
    private PlaceIdentifier $placeIdentifier;

    /**
     * @access private
     * @var Cartographics
     */
    private Cartographics $cartographics;

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
     * Get the value of placeTerms
     *
     * @access public
     *
     * @return array
     */
    public function getPlaceTerms(): array
    {
        return $this->placeTerms;
    }

    /**
     * Get the value of placeIdentifier
     *
     * @access public
     *
     * @return PlaceIdentifier
     */
    public function getPlaceIdentifier(): PlaceIdentifier
    {
        return $this->placeIdentifier;
    }

    /**
     * Get the value of cartographics
     *
     * @access public
     *
     * @return Cartographics
     */
    public function getCartographics(): Cartographics
    {
        return $this->cartographics;
    }
}
