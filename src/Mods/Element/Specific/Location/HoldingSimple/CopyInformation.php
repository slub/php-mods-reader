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

namespace Slub\Mods\Element\Specific\Location\HoldingSimple;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Note;
use Slub\Mods\Element\Specific\Location\HoldingSimple\CopyInformation\EnumerationAndChronology;
use Slub\Mods\Element\Specific\Location\HoldingSimple\CopyInformation\ItemIdentifier;
use Slub\Mods\Element\Specific\PhysicalDescription\Form;
use Slub\Mods\Element\Xml\Element;

/**
 * HoldingSimple MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/location.html#copyinformation
 *
 * @access public
 */
class CopyInformation extends BaseElement
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
     * Get the value of the <form> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#form
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?Form
     */
    public function getForm(string $query = ''): ?Form
    {
        $xpath = './mods:form' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new Form($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the the array of the <subLocation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#sublocation
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getSubLocations(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:subLocation' . $query);
    }

    /**
     * Get the the array of the <shelfLocator> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#copyshelflocator
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getShelfLocators(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:shelfLocator' . $query);
    }

    /**
     * Get the array of the <electronicLocator> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#electroniclocator
     *
     * @access public
     *
     * @return string[]
     */
    public function getElectronicLocators(): array
    {
        $electronicLocators = [];
        $element = new Element($this->xml, './mods:electronicLocator');
        foreach ($element->getValues() as $value) {
            $electronicLocators[] = $value;
        }
        return $electronicLocators;
    }

    /**
     * Get the array of the <note> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#copyInformationnote
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

    /**
     * Get the array of the <enumerationAndChronology> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#enumerationandchronology
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return EnumerationAndChronology[]
     */
    public function getEnumerationAndChronologies(string $query = ''): array
    {
        $enumerationAndChronologies = [];
        $xpath = './mods:enumerationAndChronology' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $enumerationAndChronologies[] = new EnumerationAndChronology($value);
        }
        return $enumerationAndChronologies;
    }

    /**
     * Get the the array of the <itemIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#itemidentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ItemIdentifier[]
     */
    public function getItemIdentifiers(string $query = ''): array
    {
        $itemIdentifiers = [];
        $xpath = './mods:itemIdentifier' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $itemIdentifiers[] = new ItemIdentifier($value);
        }
        return $itemIdentifiers;
    }
}
