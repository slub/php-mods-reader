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
 * Element (HierarchicalGeographic) MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class LevelPeriodElement extends BaseElement
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
     * Get the value of the 'level' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#level
     *
     * @access public
     *
     * @return int
     */
    public function getLevel(): int
    {
        return $this->getIntAttribute('level');
    }

    /**
     * Get the value of the 'period' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html#period
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
