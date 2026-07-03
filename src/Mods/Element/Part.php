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
use Slub\Mods\Element\Common\DateElement;
use Slub\Mods\Element\Specific\Part\Detail;
use Slub\Mods\Element\Specific\Part\Extent;
use Slub\Mods\Element\Specific\Part\Text;
use Slub\Mods\Utility\Query;

/**
 * Part MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/part.html
 *
 * @access public
 */
class Part extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

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
     * @see https://www.loc.gov/standards/mods/userguide/part.html#type
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
     * Get the value of the 'order' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#order
     *
     * @access public
     *
     * @return int
     */
    public function getOrder(): int
    {
        return $this->getIntAttribute('order');
    }

    /**
     * Get the array of the <detail> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#detail
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Detail[]
     */
    public function getDetails(string $query = ''): array
    {
        return $this->getElements('./mods:detail' . $query, Detail::class);
    }

    /**
     * Get the array of the <detail> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#detail
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Detail[]
     */
    public function getDetailsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:detail', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Detail::class);
    }

    /**
     * Get the array of the <extent> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#extent
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Extent[]
     */
    public function getExtents(string $query = ''): array
    {
        return $this->getElements('./mods:extent' . $query, Extent::class);
    }

    /**
     * Get the array of the <extent> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#extent
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Extent[]
     */
    public function getExtentsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:extent', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Extent::class);
    }

    /**
     * Get the array of the <date> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#date
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return DateElement[]
     */
    public function getDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:date' . $query);
    }

    /**
     * Get the array of the <date> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#date
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return DateElement[]
     */
    public function getDatesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:date', $xpath, $attributes, $value);
        return $this->getDateElements($query->getXPath());
    }

    /**
     * Get the array of the <text> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#text
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Text[]
     */
    public function getTexts(string $query = ''): array
    {
        return $this->getElements('./mods:text' . $query, Text::class);
    }

    /**
     * Get the array of the <text> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/part.html#text
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Text[]
     */
    public function getTextsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:text', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Text::class);
    }
}
