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

namespace Slub\Mods\Element\Specific\RecordInfo;

use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\Language\LanguageTerm;
use Slub\Mods\Element\Specific\Language\ScriptTerm;
use Slub\Mods\Element\Xml\Element;

/**
 * LanguageOfCataloging MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#languageofcataloging
 *
 * @access public
 */
class LanguageOfCataloging extends BaseElement
{
    use IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

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
     * Get the value of 'objectPart' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#objectpart
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
     * Get the value of the <languageTerm> element.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#languageterm
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?LanguageTerm
     */
    public function getLanguageTerm(string $query = ''): ?LanguageTerm
    {
        $xpath = './mods:languageTerm' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageTerm($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the value of the <scriptTerm> element.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#scriptterm
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?ScriptTerm
     */
    public function getScriptTerm(string $query = ''): ?ScriptTerm
    {
        $xpath = './mods:scriptTerm' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new ScriptTerm($element->getValues()[0]);
        }
        return null;
    }
}
