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
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\Name\AlternativeName;
use Slub\Mods\Element\Specific\Name\BaseNameElement;
use Slub\Mods\Element\Xml\Element;

/**
 * Name MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/name.html
 *
 * @access public
 */
class Name extends BaseNameElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, NameTitleGroupAttribute, UsageAttribute, DisplayLabelAttribute;

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
     * @see https://www.loc.gov/standards/mods/userguide/name.html#type
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
     * Get the the array of the <alternativeName> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#alternativename
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AlternativeName[]
     */
    public function getAlternativeNames(string $query = ''): array
    {
        $alternativeNames = [];
        $xpath = './mods:alternativeName' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $alternativeNames[] = new AlternativeName($value);
        }
        return $alternativeNames;
    }

    /**
     * Get the value of the <etal> element.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#etal
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?LanguageElement
     */
    public function getEtal(string $query = ''): ?LanguageElement
    {
        $xpath = './mods:etal' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }
}
