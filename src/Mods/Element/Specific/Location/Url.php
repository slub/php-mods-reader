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

namespace Slub\Mods\Element\Specific\Location;

use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * Url MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class Url extends BaseElement
{
    use DisplayLabelAttribute, UsageAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedAccess = [
        'preview',
        'raw object',
        'object in context'
    ];

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
     * Get the value of dateLastAccessed
     *
     * @access public
     *
     * @return string
     */
    public function getDateLastAccessed(): string
    {
        return $this->getStringAttribute('dateLastAccessed');
    }

    /**
     * Get the value of note
     *
     * @access public
     *
     * @return string
     */
    public function getNote(): string
    {
        return $this->getStringAttribute('note');
    }

    /**
     * Get the value of access
     *
     * @access public
     *
     * @return string
     */
    public function getAccess(): string
    {
        return $this->getStringAttribute('access');
    }
}
