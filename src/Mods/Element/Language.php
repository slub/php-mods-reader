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
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\Language\LanguageTerm;
use Slub\Mods\Element\Specific\Language\ScriptTerm;
use Slub\Mods\Element\Xml\Element;

/**
 * Language MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/language.html
 *
 * @access public
 */
class Language extends BaseElement
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
     * Get the value of the 'objectPart' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/language.html#objectpart
     *
     * @access public
     *
     * @return string
     */
    public function getObjectPart(): string
    {
        return $this->getStringAttribute('objectPart');
    }

    /**
     * Get the array of the <languageTerm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/language.html#languageterm
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageTerm[]
     */
    public function getLanguageTerms(string $query = ''): array
    {
        $languageTerms = [];
        $xpath = './mods:languageTerm' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $languageTerms[] = new LanguageTerm($value);
        }
        return $languageTerms;
    }

    /**
     * Get the array of the <scriptTerm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/language.html#scriptterm
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ScriptTerm[]
     */
    public function getScriptTerms(string $query = ''): array
    {
        $scriptTerms = [];
        $xpath = './mods:scriptTerm' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $scriptTerms[] = new ScriptTerm($value);
        }
        return $scriptTerms;
    }
}
