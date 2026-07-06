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
use Slub\Mods\Utility\Query;

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
     * Get the array of the <namePart> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#namepart
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return NamePart[]
     */
    public function getNameParts(string $query = ''): array
    {
        return $this->getElements('./mods:namePart' . $query, NamePart::class);
    }

    /**
     * Get the array of the <namePart> elements by given parameters.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#namepart
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return NamePart[]
     */
    public function getNamePartsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:namePart', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), NamePart::class);
    }

    /**
     * Get the array of the <nameIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#nameidentifier
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return NameIdentifier[]
     */
    public function getNameIdentifiers(string $query): array
    {
        return $this->getElements('./mods:nameIdentifier' . $query, NameIdentifier::class);
    }

    /**
     * Get the array of the <nameIdentifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#nameidentifier
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return NameIdentifier[]
     */
    public function getNameIdentifiersByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:nameIdentifier', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), NameIdentifier::class);
    }

    /**
     * Get the array of the <displayForm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDisplayForms(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:displayForm' . $query);
    }

    /**
     * Get the array of the <displayForm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDisplayFormsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:displayForm', $xpath, $attributes, $value);
        return $this->getLanguageElements($query->getXPath());
    }

    /**
     * Get the array of the <affiliation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getAffiliations(string $query = ''): array
    {
        return $this->getAuthorityLanguageElements('./mods:affiliation' . $query);
    }

    /**
     * Get the array of the <affiliation> elements by given parameters.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#displayform
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getAffiliationsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:affiliation', $xpath, $attributes, $value);
        return $this->getAuthorityLanguageElements($query->getXPath());
    }

    /**
     * Get the array of the <role> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#role
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Role[]
     */
    public function getRoles(string $query = ''): array
    {
        return $this->getElements('./mods:role' . $query, Role::class);
    }

    /**
     * Get the array of the <role> elements by parameters.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#role
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return Role[]
     */
    public function getRolesByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:role', $xpath, $attributes, $value);
        return $this->getElements($query->getXPath(), Role::class);
    }

    /**
     * Get the array of the <description> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#description
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDescriptions(string $query = ''): array
    {
        return $this->getLanguageElements('./mods:description' . $query);
    }

    /**
     * Get the array of the <description> elements by given parameters.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#description
     *
     * @access public
     *
     * @param string $xpath The XPath query for metadata search
     * @param array $attributes The array of attributes ['attribute' => 'value']
     * @param string $value The value for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDescriptionsByParameters(string $xpath = '', array $attributes = [], string $value = ''): array
    {
        $query = new Query('./mods:description', $xpath, $attributes, $value);
        return $this->getLanguageElements($query->getXPath());
    }
}
