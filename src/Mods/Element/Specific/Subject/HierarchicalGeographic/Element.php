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

namespace Slub\Mods\Element\Specific\Subject\HierarchicalGeographic;

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * Element (HierarchicalGeographic) MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Element extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute;

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
     * Get the value of level
     *
     * @access public
     *
     * @return string
     */
    public function getLevel(): string
    {
        return $this->getStringAttribute('level');
    }

    /**
     * Get the value of period
     *
     * @access public
     *
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->getStringAttribute('period');
    }
}
