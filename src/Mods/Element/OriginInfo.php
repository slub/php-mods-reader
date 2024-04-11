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
use Slub\Mods\Element\Specific\OriginInfo\Agent;
use Slub\Mods\Element\Specific\OriginInfo\DateOther;
use Slub\Mods\Element\Specific\OriginInfo\DisplayDate;
use Slub\Mods\Element\Specific\OriginInfo\Edition;
use Slub\Mods\Element\Specific\OriginInfo\Frequency;
use Slub\Mods\Element\Specific\OriginInfo\Issuance;
use Slub\Mods\Element\Specific\OriginInfo\Place;
use Slub\Mods\Element\Xml\Element;

/**
 * OriginInfo MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/origininfo.html
 *
 * @access public
 */
class OriginInfo extends BaseElement
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
     * Get the value of the 'eventType' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#eventType
     *
     * @access public
     *
     * @return string
     */
    public function getEventType(): string
    {
        return $this->getStringAttribute('eventType');
    }

    /**
     * Get the value of the 'eventTypeURI' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#eventTypeURI
     *
     * @access public
     *
     * @return string
     */
    public function getEventTypeURI(): string
    {
        return $this->getStringAttribute('eventTypeURI');
    }

    /**
     * Get the array of the <place> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#place
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Place[]
     */
    public function getPlaces(string $query = ''): array
    {
        $places = [];
        $xpath = './mods:place' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $places[] = new Place($value);
            }
        }
        return $places;
    }

    /**
     * Get the array of the <agent> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#agent
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Agent[]
     */
    public function getAgents(string $query = ''): array
    {
        $agents = [];
        $xpath = './mods:agent' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $agents[] = new Agent($value);
            }
        }
        return $agents;
    }

    /**
     * Get the array of the <dateIssued> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#dateissued
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getIssuedDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:dateIssued' . $query);
    }

    /**
     * Get the array of the <dateCreated> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#datecreated
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getCreatedDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:dateCreated' . $query);
    }

    /**
     * Get the the array of the <dateCaptured> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#datecaptured
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getCapturedDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:dateCaptured' . $query);
    }

    /**
     * Get the array of the <dateValid> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#datevalid
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getValidDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:dateValid' . $query);
    }

    /**
     * Get the array of the <dateModified> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#datemodified
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getModifiedDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:dateModified' . $query);
    }

    /**
     * Get the array of the <copyrightDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#copyrightdate
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getCopyrightDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:copyrightDate' . $query);
    }

    /**
     * Get the array of the <dateOther> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#dateother
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateOther[]
     */
    public function getOtherDates(string $query = ''): array
    {
        $otherDates = [];
        $xpath = './mods:dateOther' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $otherDates[] = new DateOther($value);
            }
        }
        return $otherDates;
    }

    /**
     * Get the array of the <displayDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#displayDate
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DisplayDate[]
     */
    public function getDisplayDates(string $query = ''): array
    {
        $displayDates = [];
        $xpath = './mods:displayDate' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $displayDates[] = new DisplayDate($value);
            }
        }
        return $displayDates;
    }

    /**
     * Get the array of the <edition> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#edition
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Edition[]
     */
    public function getEditions(string $query = ''): array
    {
        $editions = [];
        $xpath = './mods:edition' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $editions[] = new Edition($value);
            }
        }
        return $editions;
    }

    /**
     * Get the array of the <issuance> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#issuance
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Issuance[]
     */
    public function getIssuances(string $query = ''): array
    {
        $issuances = [];
        $xpath = './mods:issuance' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $issuances[] = new Issuance($value);
            }
        }
        return $issuances;
    }

    /**
     * Get the array of the <frequency> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html#frequency
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Frequency[]
     */
    public function getFrequencies(string $query = ''): array
    {
        $frequencies = [];
        $xpath = './mods:frequency' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $frequencies[] = new Frequency($value);
            }
        }
        return $frequencies;
    }
}
