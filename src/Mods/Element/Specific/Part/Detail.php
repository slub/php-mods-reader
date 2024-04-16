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

namespace Slub\Mods\Element\Specific\Part;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;

/**
 * Detail MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/part.html#detail
 *
 * @access public
 */
class Detail extends BaseElement
{

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
     * Get the value of the 'type' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#detailtype
     *
     * @access public
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->getStringAttribute('type');
    }

    /**
     * Get the value of the 'level' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#level
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
     * Get the array of the <number> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#number
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getNumbers(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:number' . $query);
    }

    /**
     * Get the array of the <caption> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#caption
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getCaptions(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:caption' . $query);
    }

    /**
     * Get the array of the <title> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#title
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement
     */
    public function getTitles(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:title' . $query);
    }
}
