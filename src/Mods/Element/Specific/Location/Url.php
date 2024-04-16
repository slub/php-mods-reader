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
use Slub\Mods\Exception\IncorrectValueInAttributeException;

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
     * Get the value of the 'dateLastAccessed' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#datelastaccessed
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getDateLastAccessed(): string
    {
        $dateLastAccessed = $this->getStringAttribute('dateLastAccessed');

        if (empty($dateLastAccessed) || in_array($dateLastAccessed, $this->allowedAccess)) {
            return $dateLastAccessed;
        }

        throw new IncorrectValueInAttributeException('dateLastAccessed', $dateLastAccessed);
    }

    /**
     * Get the value of the 'note' attribute.
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
     * Get the value of the 'access' attribute.
     *
     * @access public
     *
     * @return string
     * 
     * @throws IncorrectValueInAttributeException
     */
    public function getAccess(): string
    {
        $access = $this->getStringAttribute('access');

        if (empty($access) || in_array($access, $this->allowedAccess)) {
            return $access;
        }

        throw new IncorrectValueInAttributeException('access', $access);
    }
}
