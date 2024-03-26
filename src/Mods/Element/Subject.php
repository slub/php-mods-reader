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

/**
 * Subject MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Subject extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $topic;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $geographic;

    /**
     * @access private
     * @var AuthorityDateLanguageElement
     */
    private AuthorityDateLanguageElement $temporal;

    /**
     * @access private
     * @var TitleInfo
     */
    private TitleInfo $titleInfo;

    /**
     * @access private
     * @var Name
     */
    private Name $name;

    /**
     * @access private
     * @var Genre
     */
    private Genre $genre;

    /**
     * @access private
     * @var HierarchicalGeographic
     */
    private HierarchicalGeographic $hierarchicalGeographic;

    /**
     * @access private
     * @var Cartographics
     */
    private Cartographics $cartographics;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $geographicCode;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $occupation;

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

        $this->topic = new AuthorityLanguageElement($xml);
        $this->geographic = new AuthorityLanguageElement($xml);
        $this->temporal = new AuthorityDateLanguageElement($xml);
        $this->titleInfo = new TitleInfo($xml);
        $this->name = new Name($xml);
        $this->genre = new Genre($xml);
        $this->hierarchicalGeographic = new HierarchicalGeographic($xml);
        $this->cartographics = new Cartographics($xml);
        $this->geographicCode = new AuthorityLanguageElement($xml);
        $this->occupation = new AuthorityLanguageElement($xml);
    }

    /**
     * Get the value of topic
     *
     * @access public
     *
     * @return AuthorityLanguageElement
     */
    public function getTopic(): AuthorityLanguageElement
    {
        return $this->topic;
    }

    /**
     * Get the value of geographic
     *
     * @access public
     *
     * @return AuthorityLanguageElement
     */
    public function getGeographic(): AuthorityLanguageElement
    {
        return $this->geographic;
    }

    /**
     * Get the value of temporal
     *
     * @access public
     *
     * @return AuthorityDateLanguageElement
     */
    public function getTemporal(): AuthorityDateLanguageElement
    {
        return $this->temporal;
    }

    /**
     * Get the value of titleInfo
     *
     * @access public
     *
     * @return TitleInfo
     */
    public function getTitleInfo(): TitleInfo
    {
        return $this->titleInfo;
    }

    /**
     * Get the value of name
     *
     * @access public
     *
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Get the value of genre
     *
     * @access public
     *
     * @return Genre
     */
    public function getGenre(): Genre
    {
        return $this->genre;
    }

    /**
     * Get the value of hierarchicalGeographic
     *
     * @access public
     *
     * @return HierarchicalGeographic
     */
    public function getHierarchicalGeographic(): HierarchicalGeographic
    {
        return $this->hierarchicalGeographic;
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

    /**
     * Get the value of geographicCode
     *
     * @access public
     *
     * @return AuthorityLanguageElement
     */
    public function getGeographicCode(): AuthorityLanguageElement
    {
        return $this->geographicCode;
    }

    /**
     * Get the value of occupation
     *
     * @access public
     *
     * @return AuthorityLanguageElement
     */
    public function getOccupation(): AuthorityLanguageElement
    {
        return $this->occupation;
    }
}
