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

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Linking\NameTitleGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\AltFormatAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\ContentTypeAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\SuppliedAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Attribute\Specific\OtherTypeAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\TitleInfo\NonSort;
use Slub\Mods\Element\Xml\Element;
use Slub\Mods\Exception\IncorrectValueInAttributeException;

/**
 * TitleInfo MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html
 *
 * @access public
 */
class TitleInfo extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, NameTitleGroupAttribute, DisplayLabelAttribute, AltFormatAttribute, ContentTypeAttribute, UsageAttribute, SuppliedAttribute, OtherTypeAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'abbreviated',
        'translated',
        'alternative',
        'uniform'
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
     * Get the value of the 'type' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#type
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getType(): string
    {
        $type = $this->getStringAttribute('type');

        if (empty($type) || in_array($type, $this->allowedTypes)) {
            return $type;
        }

        throw new IncorrectValueInAttributeException('type', $type);
    }

    /**
     * Get the value of the <title> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#title
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getTitle(string $query = ''): ?LanguageElement
    {
        $xpath = './mods:title' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the value of the <subTitle> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#subtitle
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getSubTitle(string $query = ''): ?LanguageElement
    {
        $xpath = './mods:subTitle' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the value of the <partNumber> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#partnumber
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getPartNumber(string $query = ''): ?LanguageElement
    {
        $xpath = './mods:partNumber' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the the array of the <partName> elements.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#partname
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getPartName(string $query = ''): array
    {
        $partNames = [];
        $xpath = './mods:partName' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $partNames[] = new LanguageElement($value);
        }
        return $partNames;
    }

    /**
     * Get the value of the <nonSort> element.
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return ?NonSort
     */
    public function getNonSort(string $query = ''): ?NonSort
    {
        $xpath = './mods:nonSort' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new NonSort($element->getValues()[0]);
        }
        return null;
    }
}
