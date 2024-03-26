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

namespace Slub\Mods\Element\Specific\Subject;

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic\Element;
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic\TypeElement;

/**
 * HierarchicalGeographic MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class HierarchicalGeographic extends BaseElement
{
    use AuthorityAttribute;

    /**
     * @access private
     * @var Element
     */
    private Element $continent;

    /**
     * @access private
     * @var Element
     */
    private Element $country;

    /**
     * @access private
     * @var TypeElement
     */
    private TypeElement $region;

    /**
     * @access private
     * @var TypeElement
     */
    private TypeElement $state;

    /**
     * @access private
     * @var Element
     */
    private Element $territory;

    /**
     * @access private
     * @var Element
     */
    private Element $county;

    /**
     * @access private
     * @var Element
     */
    private Element $city;

    /**
     * @access private
     * @var TypeElement
     */
    private TypeElement $citySection;

    /**
     * @access private
     * @var Element
     */
    private Element $island;

    /**
     * @access private
     * @var TypeElement
     */
    private TypeElement $area;

    /**
     * @access private
     * @var Element
     */
    private Element $extraterrestrialArea;

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
     * Get the value of continent
     *
     * @access public
     *
     * @return Element
     */
    public function getContinent(): Element
    {
        return $this->continent;
    }

    /**
     * Get the value of country
     *
     * @access public
     *
     * @return Element
     */
    public function getCountry(): Element
    {
        return $this->country;
    }

    /**
     * Get the value of region
     *
     * @access public
     *
     * @return TypeElement
     */
    public function getRegion(): TypeElement
    {
        return $this->region;
    }

    /**
     * Get the value of state
     *
     * @access public
     *
     * @return TypeElement
     */
    public function getState(): TypeElement
    {
        return $this->state;
    }

    /**
     * Get the value of territory
     *
     * @access public
     *
     * @return Element
     */
    public function getTerritory(): Element
    {
        return $this->territory;
    }

    /**
     * Get the value of county
     *
     * @access public
     *
     * @return Element
     */
    public function getCounty(): Element
    {
        return $this->county;
    }

    /**
     * Get the value of city
     *
     * @access public
     *
     * @return Element
     */
    public function getCity(): Element
    {
        return $this->city;
    }

    /**
     * Get the value of citySection
     *
     * @access public
     *
     * @return TypeElement
     */
    public function getCitySection(): TypeElement
    {
        return $this->citySection;
    }

    /**
     * Get the value of island
     *
     * @access public
     *
     * @return Element
     */
    public function getIsland(): Element
    {
        return $this->island;
    }

    /**
     * Get the value of area
     *
     * @access public
     *
     * @return TypeElement
     */
    public function getArea(): TypeElement
    {
        return $this->area;
    }

    /**
     * Get the value of extraterrestrialArea
     *
     * @access public
     *
     * @return Element
     */
    public function getExtraterrestrialArea(): Element
    {
        return $this->extraterrestrialArea;
    }
}
