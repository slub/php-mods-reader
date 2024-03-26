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

/**
 * Location MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Location extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var PhysicalLocation
     */
    private PhysicalLocation $physicalLocation;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $shelfLocator;

    /**
     * @access private
     * @var Url
     */
    private Url $url;

    /**
     * @access private
     * @var HoldingSimple
     */
    private HoldingSimple $holdingSimple;

    /**
     * @access private
     * @var string
     */
    private string $holdingExternal;

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
     * Get the value of physicalLocation
     *
     * @access public
     *
     * @return PhysicalLocation
     */
    public function getPhysicalLocation(): PhysicalLocation
    {
        return $this->physicalLocation;
    }

    /**
     * Get the value of shelfLocator
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getShelfLocator(): LanguageElement
    {
        return $this->shelfLocator;
    }

    /**
     * Get the value of url
     *
     * @access public
     *
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * Get the value of holdingSimple
     *
     * @access public
     *
     * @return HoldingSimple
     */
    public function getHoldingSimple(): HoldingSimple
    {
        return $this->holdingSimple;
    }

    /**
     * Get the value of holdingExternal
     *
     * @access public
     *
     * @return string
     */
    public function getHoldingExternal(): string
    {
        return $this->holdingExternal;
    }
}
