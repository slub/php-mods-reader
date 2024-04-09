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

namespace Slub\Mods\Element\Specific\Name;

use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Xml\Element;

/**
 * BaseNameElement class for the 'php-mods-reader' library.
 *
 * @access public
 */
class BaseNameElement extends BaseElement
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
     * Get the the array of the <namePart> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#namepart
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return NamePart[]
     */
    public function getNameParts(string $query = ''): array
    {
        $nameParts = [];
        $xpath = './mods:namePart' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $nameParts[] = new NamePart($value);
            }
        }
        return $nameParts;
    }

    /**
     * Get the the array of the <nameIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#nameidentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return NameIdentifier[]
     */
    public function getNameIdentifiers(string $query): array
    {
        $nameIdentifiers = [];
        $xpath = './mods:nameIdentifier' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $nameIdentifiers[] = new NameIdentifier($value);
            }
        }
        return $nameIdentifiers;
    }

    /**
     * Get the the array of the <displayForm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDisplayForms(string $query = ''): array
    {
        $displayForms = [];
        $xpath = './mods:displayForm' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $displayForms[] = new LanguageElement($value);
            }
        }
        return $displayForms;
    }

    /**
     * Get the the array of the <affiliation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getAffiliations(string $query = ''): array
    {
        $affiliations = [];
        $xpath = './mods:affiliation' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $affiliations[] = new AuthorityLanguageElement($value);
            }
        }
        return $affiliations;
    }

    /**
     * Get the the array of the <role> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#role
     *
     * @access public
     *
     * @param string $query The XPath query ''):for metadata search
     *
     * @return Role[]
     */
    public function getRoles(string $query = ''): array
    {
        $roles = [];
        $xpath = './mods:role' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $roles[] = new Role($value);
            }
        }
        return $roles;
    }

    /**
     * Get the the array of the <description> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#description
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDescriptions(string $query = ''): array
    {
        $descriptions = [];
        $xpath = './mods:description' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $descriptions[] = new LanguageElement($value);
            }
        }
        return $descriptions;
    }
}
