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
use Slub\Mods\Element\Xml\Element;

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
        $details = [];
        $xpath = './mods:detail' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $details[] = new Detail($value);
        }
        return $details;
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
        $extents = [];
        $xpath = './mods:extent' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $extents[] = new Extent($value);
        }
        return $extents;
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
        $texts = [];
        $xpath = './mods:text' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $texts[] = new Text($value);
        }
        return $texts;
    }
}
