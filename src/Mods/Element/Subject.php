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
use Slub\Mods\Element\Specific\OriginInfo\Place\Cartographics;
use Slub\Mods\Element\Specific\Subject\HierarchicalGeographic;
use Slub\Mods\Utility\Query;

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
     * Get the array of the <topic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#topic
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getTopics(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:topic' . $query);
    }

    /**
     * Get the array of the <topic> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#topic
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getTopicsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:topic', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }

    /**
     * Get the array of the <geographic> elements.
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
        return $this->getAuthorityLanguageElements('./mods:geographic' . $query);
    }

    /**
     * Get the array of the <geographic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#geographic
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getGeographicsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:geographic', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
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
        return $this->getElements('./mods:temporal' . $query, AuthorityDateLanguageElement::class);
    }

    /**
     * Get the value of the <temporal> element by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#temporal
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityDateLanguageElement[]
     */
    public function getTemporalsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:temporal', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), AuthorityDateLanguageElement::class);
    }

    /**
     * Get the array of the <titleInfo> elements.
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
        return $this->getElements('./mods:titleInfo' . $query, TitleInfo::class);
    }

    /**
     * Get the array of the <titleInfo> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#titleinfo
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return TitleInfo[]
     */
    public function getTitleInfosByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:titleInfo', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), TitleInfo::class);
    }

    /**
     * Get the array of the <name> elements.
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
        return $this->getElements('./mods:name' . $query, Name::class);
    }

    /**
     * Get the array of the <name> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#name
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Name[]
     */
    public function getNamesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:name', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Name::class);
    }

    /**
     * Get the array of the <genre> elements.
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
        return $this->getElements('./mods:genre' . $query, Genre::class);
    }
    /**
     * Get the array of the <genre> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#genre
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Genre[]
     */
    public function getGenresByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:genre', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Genre::class);
    }


    /**
     * Get the array of the <hierarchicalGeographic> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return HierarchicalGeographic[]
     */
    public function getHierarchicalGeographics(string $query = ''): array
    {
        return $this->getElements('./mods:hierarchicalGeographic' . $query, HierarchicalGeographic::class);
    }

    /**
     * Get the array of the <hierarchicalGeographic> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return HierarchicalGeographic[]
     */
    public function getHierarchicalGeographicsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:hierarchicalGeographic', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), HierarchicalGeographic::class);
    }

    /**
     * Get the array of the <cartographics> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Cartographics[]
     */
    public function getCartographics(string $query = ''): array
    {
        return $this->getElements('./mods:cartographics' . $query, Cartographics::class);
    }

    /**
     * Get the array of the <cartographics> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#hierarchicalgeographic
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Cartographics[]
     */
    public function getCartographicsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:cartographics', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Cartographics::class);
    }

    /**
     * Get the array of the <geographicCode> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#geographiccode
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getGeographicCodes(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:geographicCode' . $query);
    }

    /**
     * Get the array of the <geographicCode> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#geographiccode
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getGeographicCodesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:geographicCode', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }


    /**
     * Get the array of the <occupation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#occupation
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getOccupations(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:occupation' . $query);
    }

    /**
     * Get the array of the <occupation> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#occupation
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getOccupationsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:occupation', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }
}
