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

namespace Slub\Mods\Element\Specific\OriginInfo\Place;

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;

/**
 * Cartographics MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#oiplacecartographics
 *
 * @access public
 */
class Cartographics extends BaseElement
{
    use AuthorityAttribute;

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
     * Get the value of the <projection> element.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#projection
     *
     * @access public
     *
     * @return ?LanguageElement
     */
    public function getProjection(string $query = ''): ?LanguageElement
    {
        return $this->getLanguageElement('./mods:projection' . $query);
    }

    /**
     * Get the value of the <scale> element.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#scale
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getScale(string $query = ''): ?LanguageElement
    {
        return $this->getLanguageElement('./mods:scale' . $query);
    }

    /**
     * Get the array of the <coordinates> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#coordinates
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getCoordinates(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:coordinates' . $query);
    }

    /**
     * Get the array of the <cartographicExtension> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#cartographicextension
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getCartographicExtensions(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:cartographicExtension' . $query);
    }
}
