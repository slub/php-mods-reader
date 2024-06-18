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
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic\LevelPeriodElement;
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic\TypeElement;
use Slub\Mods\Element\Xml\Element;

/**
 * HierarchicalGeographic MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
 *
 * @access public
 */
class HierarchicalGeographic extends BaseElement
{
    use AuthorityAttribute;

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
     * Get the the array of the <continent> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#continent
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getContinents(string $query = ''): array
    {
        $continents = [];
        $xpath = './mods:continent' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $continents[] = new LevelPeriodElement($value);
        }
        return $continents;
    }

    /**
     * Get the the array of the <country> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#country
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getCountries(string $query = ''): array
    {
        $countries = [];
        $xpath = './mods:country' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $countries[] = new LevelPeriodElement($value);
        }
        return $countries;
    }

    /**
     * Get the the array of the <region> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#region
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TypeElement[]
     */
    public function getRegions(string $query = ''): array
    {
        $regions = [];
        $xpath = './mods:region' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $regions[] = new TypeElement($value, 'regionType');
        }
        return $regions;
    }

    /**
     * Get the the array of the <state> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#state
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TypeElement[]
     */
    public function getStates(string $query = ''): array
    {
        $states = [];
        $xpath = './mods:state' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $states[] = new TypeElement($value, 'stateType');
        }
        return $states;
    }

    /**
     * Get the the array of the <territory> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#territory
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getTerritories(string $query = ''): array
    {
        $territories = [];
        $xpath = './mods:territory' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $territories[] = new LevelPeriodElement($value);
        }
        return $territories;
    }

    /**
     * Get the the array of the <county> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#county
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getCounties(string $query = ''): array
    {
        $counties = [];
        $xpath = './mods:county' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $counties[] = new LevelPeriodElement($value);
        }
        return $counties;
    }

    /**
     * Get the the array of the <city> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#city
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getCities(string $query = ''): array
    {
        $cities = [];
        $xpath = './mods:city' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
                $cities[] = new LevelPeriodElement($value);
        }
        return $cities;
    }

    /**
     * Get the the array of the <citySection> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#citysection
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TypeElement[]
     */
    public function getCitySections(string $query = ''): array
    {
        $sections = [];
        $xpath = './mods:citySection' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $sections[] = new TypeElement($value, 'citySectionType');
        }
        return $sections;
    }

    /**
     * Get the the array of the <island> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#island
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getIslands(string $query = ''): array
    {
        $islands = [];
        $xpath = './mods:island' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $islands[] = new LevelPeriodElement($value);
        }
        return $islands;
    }

    /**
     * Get the the array of the <area> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#area
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TypeElement[]
     */
    public function getAreas(string $query = ''): array
    {
        $areas = [];
        $xpath = './mods:area' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $areas[] = new TypeElement($value, 'areaType');
        }
        return $areas;
    }

    /**
     * Get the the array of the <extraterrestrialArea> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#extraterrestrialarea
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LevelPeriodElement[]
     */
    public function getExtraterrestrialAreas(string $query = ''): array
    {
        $extraterrestrialAreas = [];
        $xpath = './mods:extraterrestrialArea' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $extraterrestrialAreas[] = new LevelPeriodElement($value);
        }
        return $extraterrestrialAreas;
    }
}
