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

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\AuthorityDateLanguageElement;
use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Name;
use Slub\Mods\Element\Specific\OriginInfo\Place\Cartographics;
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic;
use Slub\Mods\Element\Xml\Element;

/**
 * Subject MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/subject.html
 *
 * @access public
 */
class Subject extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

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
     * Get the the array of the <topic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#topic
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getTopics(string $query = ''): array
    {
        $topics = [];
        $xpath = './mods:topic' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $topics[] = new AuthorityLanguageElement($value);
        }
        return $topics;
    }

    /**
     * Get the the array of the <geographic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#geographic
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getGeographics(string $query = ''): array
    {
        $geographics = [];
        $xpath = './mods:geographic' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $geographics[] = new AuthorityLanguageElement($value);
        }
        return $geographics;
    }

    /**
     * Get the value of the <temporal> element.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#temporal
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityDateLanguageElement[]
     */
    public function getTemporals(string $query = ''): array
    {
        $temporals = [];
        $xpath = './mods:temporal' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $temporals[] = new AuthorityDateLanguageElement($value);
        }
        return $temporals;
    }

    /**
     * Get the the array of the <titleInfo> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#titleinfo
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return TitleInfo[]
     */
    public function getTitleInfos(string $query = ''): array
    {
        $titleInfos = [];
        $xpath = './mods:titleInfo' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $titleInfos[] = new TitleInfo($value);
        }
        return $titleInfos;
    }

    /**
     * Get the the array of the <name> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#name
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Name[]
     */
    public function getNames(string $query = ''): array
    {
        $names = [];
        $xpath = './mods:name' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $names[] = new Name($value);
        }
        return $names;
    }

    /**
     * Get the the array of the <genre> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#genre
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Genre[]
     */
    public function getGenres(string $query = ''): array
    {
        $genres = [];
        $xpath = './mods:genre' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $genres[] = new Genre($value);
        }
        return $genres;
    }

    /**
     * Get the the array of the <hierarchicalGeographic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return HierarchicalGeographic[]
     */
    public function getHierarchicalGeographics(string $query = ''): array
    {
        $hierarchicalGeographics = [];
        $xpath = './mods:hierarchicalGeographic' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $hierarchicalGeographics[] = new HierarchicalGeographic($value);
        }
        return $hierarchicalGeographics;
    }

    /**
     * Get the the array of the <cartographics> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
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
        foreach ($element->getValues() as $value) {
            $cartographics[] = new Cartographics($value);
        }
        return $cartographics;
    }

    /**
     * Get the the array of the <geographicCode> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#geographiccode
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getGeographicCodes(string $query = ''): array
    {
        $geographicCodes = [];
        $xpath = './mods:geographicCode' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $geographicCodes[] = new AuthorityLanguageElement($value);
        }
        return $geographicCodes;
    }

    /**
     * Get the the array of the <occupation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#occupation
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getOccupations(string $query = ''): array
    {
        $occupations = [];
        $xpath = './mods:occupation' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $occupations[] = new AuthorityLanguageElement($value);
        }
        return $occupations;
    }
}
