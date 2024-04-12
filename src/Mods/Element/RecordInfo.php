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
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\DateElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\RecordInfo\LanguageOfCataloging;
use Slub\Mods\Element\Specific\RecordInfo\RecordIdentifier;
use Slub\Mods\Element\Specific\RecordInfo\RecordInfoNote;
use Slub\Mods\Element\Xml\Element;

/**
 * RecordInfo MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html
 *
 * @access public
 */
class RecordInfo extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $descriptionStandard;

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
     * Get the array of the <recordContentSource> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordcontentsource
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getRecordContentSources(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:recordContentSource' . $query);
    }

    /**
     * Get the array of the <recordCreationDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordcreationdate
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordCreationDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:recordCreationDate' . $query);
    }

    /**
     * Get the array of the <recordChangeDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordchangedate
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordChangeDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:recordChangeDate' . $query);
    }

    /**
     * Get the array of the <recordIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordidentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return RecordIdentifier[]
     */
    public function getRecordIdentifiers(string $query = ''): array
    {
        $recordIdentifiers = [];
        $xpath = './mods:recordIdentifier' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $recordIdentifiers[] = new RecordIdentifier($value);
            }
        }
        return $recordIdentifiers;
    }

    /**
     * Get the array of the <recordOrigin> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordorigin
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getRecordOrigins(string $query = ''): array
    {
        $recordOrigins = [];
        $xpath = './mods:recordOrigin' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $recordOrigins[] = new LanguageElement($value);
            }
        }
        return $recordOrigins;
    }

    /**
     * Get the array of the <recordIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordidentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return RecordIdentifier[]
     */
    public function getRecordInfoNotes(string $query = ''): array
    {
        $recordInfoNotes = [];
        $xpath = './mods:recordInfoNote' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $recordInfoNotes[] = new RecordInfoNote($value);
            }
        }
        return $recordInfoNotes;
    }

    /**
     * Get the array of the <languageOfCataloging> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#languageofcataloging
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageOfCataloging[]
     */
    public function getLanguageOfCatalogings(string $query = ''): array
    {
        $languageOfCatalogings = [];
        $xpath = './mods:languageOfCataloging' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $languageOfCatalogings[] = new LanguageOfCataloging($value);
            }
        }
        return $languageOfCatalogings;
    }

    /**
     * Get the array of the <descriptionStandard> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#descriptionstandard
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getDescriptionStandards(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:descriptionStandard' . $query);
    }

    /**
     * Get the array of the matching elements.
     *
     * @access public
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    private function getAuthorityLanguageElements(string $xpath): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $elements[] = new AuthorityLanguageElement($value);
            }
        }
        return $elements;
    }

    /**
     * Get the array of the matching elements.
     *
     * @access public
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return DateElement[]
     */
    private function getDateElements(string $xpath): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $elements[] = new DateElement($value);
            }
        }
        return $elements;
    }
}
