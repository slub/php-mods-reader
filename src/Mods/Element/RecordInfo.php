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
use Slub\Mods\Utility\Query;

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
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getRecordContentSources(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:recordContentSource' . $query);
    }

    /**
     * Get the array of the <recordContentSource> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordcontentsource
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getRecordContentSourcesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordContentSource', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }

    /**
     * Get the array of the <recordCreationDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordcreationdate
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordCreationDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:recordCreationDate' . $query);
    }

    /**
     * Get the array of the <recordCreationDate> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordcreationdate
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordCreationDatesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordCreationDate', $xpath, $attributes, $value);
        return $this->getDateElements($query->getXPath());
    }

    /**
     * Get the array of the <recordChangeDate> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordchangedate
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordChangeDates(string $query = ''): array
    {
        return $this->getDateElements('./mods:recordChangeDate' . $query);
    }

    /**
     * Get the array of the <recordChangeDate> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordchangedate
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return DateElement[]
     */
    public function getRecordChangeDatesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordChangeDate', $xpath, $attributes, $value);
        return $this->getDateElements($query->getXPath());
    }

    /**
     * Get the array of the <recordIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordidentifier
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return RecordIdentifier[]
     */
    public function getRecordIdentifiers(string $query = ''): array
    {
        return $this->getElements('./mods:recordIdentifier' . $query, RecordIdentifier::class);
    }

    /**
     * Get the array of the <recordIdentifier> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordidentifier
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return RecordIdentifier[]
     */
    public function getRecordIdentifiersByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordIdentifier', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), RecordIdentifier::class);
    }

    /**
     * Get the array of the <recordOrigin> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordorigin
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getRecordOrigins(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:recordOrigin' . $query);
    }

    /**
     * Get the array of the <recordOrigin> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordorigin
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return LanguageElement[]
     */
    public function getRecordOriginsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordOrigin', $xpath, $attributes, $value);
        return $this->getLanguageElements($query->getXPath());
    }

    /**
     * Get the array of the <recordInfoNote> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordinfonote
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return RecordInfoNote[]
     */
    public function getRecordInfoNotes(string $query = ''): array
    {
        return $this->getElements('./mods:recordInfoNote' . $query, RecordInfoNote::class);
    }

    /**
     * Get the array of the <recordInfoNote> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordinfonote
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return RecordInfoNote[]
     */
    public function getRecordInfoNotesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:recordInfoNote', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), RecordInfoNote::class);
    }

    /**
     * Get the array of the <languageOfCataloging> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#languageofcataloging
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageOfCataloging[]
     */
    public function getLanguageOfCatalogings(string $query = ''): array
    {
        return $this->getElements('./mods:languageOfCataloging' . $query, LanguageOfCataloging::class);
    }

    /**
     * Get the array of the <languageOfCataloging> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#languageofcataloging
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return LanguageOfCataloging[]
     */
    public function getLanguageOfCatalogingsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:languageOfCataloging', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), LanguageOfCataloging::class);
    }

    /**
     * Get the array of the <descriptionStandard> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#descriptionstandard
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getDescriptionStandards(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:descriptionStandard' . $query);
    }

    /**
     * Get the array of the <descriptionStandard> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#descriptionstandard
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getDescriptionStandardsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:descriptionStandard', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }
}
