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
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * TypeOfResource MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class TypeOfResource extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

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
     * Get the value of collection
     *
     * @access public
     *
     * @return bool
     */
    public function isCollection(): bool
    {
        return !empty($this->xml->attributes()->collection);
    }

    /**
     * Get the value of manuscript
     *
     * @access public
     *
     * @return bool
     */
    public function isManuscript(): bool
    {
        return !empty($this->xml->attributes()->manuscript);
    }
}
