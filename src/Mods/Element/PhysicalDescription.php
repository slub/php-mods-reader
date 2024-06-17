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
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Note;
use Slub\Mods\Element\Specific\PhysicalDescription\Extent;
use Slub\Mods\Element\Specific\PhysicalDescription\Form;
use Slub\Mods\Element\Xml\Element;

/**
 * PhysicalDescription MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html
 *
 * @access public
 */
class PhysicalDescription extends BaseElement
{
    use LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

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
     * Get the array of the <form> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html#form
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Form[]
     */
    public function getForms(string $query = ''): array
    {
        $forms = [];
        $xpath = './mods:form' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $forms[] = new Form($value);
        }
        return $forms;
    }

    /**
     * Get the array of the <reformattingQuality> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html#reformattingquality
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return string[]
     */
    public function getReformattingQualities(string $query = ''): array
    {
        $reformattingQualities = [];
        $xpath = './mods:reformattingQuality' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $reformattingQualities[] = $value;
        }
        return $reformattingQualities;
    }

    /**
     * Get the array of the <internetMediaType> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html#internetmediatype
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getInternetMediaTypes(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:internetMediaType' . $query);
    }

    /**
     * Get the array of the <extent> elements.
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Extent[]
     */
    public function getExtents(string $query = ''): array
    {
        $forms = [];
        $xpath = './mods:extent' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $forms[] = new Extent($value);
        }
        return $forms;
    }

    /**
     * Get the array of the <digitalOrigin> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html#digitalorigin
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return string[]
     */
    public function getDigitalOrigins(string $query = ''): array
    {
        $digitalOrigins = [];
        $xpath = './mods:digitalOrigin' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $digitalOrigins[] = $value;
        }
        return $digitalOrigins;
    }

    /**
     * Get the array of the <note> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html#note
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Note[]
     */
    public function getNotes(string $query = ''): array
    {
        $notes = [];
        $xpath = './mods:note' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $notes[] = new Note($value);
        }
        return $notes;
    }
}
