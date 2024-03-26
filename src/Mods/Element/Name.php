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
use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\Name\AlternativeName;
use Slub\Mods\Element\Specific\Name\NameIdentifier;
use Slub\Mods\Element\Specific\Name\NamePart;
use Slub\Mods\Element\Specific\Name\Role;
use Slub\Mods\Element\Xml\Element;

/**
 * Name MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Name extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, NameTitleGroupAttribute, UsageAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'personal',
        'corporate',
        'conference',
        'family'
    ];

    /**
     * @access private
     * @var array
     */
    private array $nameParts = [];

    /**
     * @access private
     * @var array
     */
    private array $alternativeNames = [];

    /**
     * @access private
     * @var array
     */
    private array $nameIdentifiers = [];

    /**
     * @access private
     * @var array
     */
    private array $displayForms = [];

    /**
     * @access private
     * @var array
     */
    private array $affiliations = [];

    /**
     * @access private
     * @var array
     */
    private array $roles = [];

    /**
     * @access private
     * @var array
     */
    private array $descriptions = [];

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $etal;

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
     * Get the value of type
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
     * Get the value of namePart
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return NamePart[]
     */
    public function getNameParts(string $query = ''): array
    {
        if (empty($this->nameParts)) {
            $xpath = './mods:namePart' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->nameParts[] = new NamePart($value);
                }
            }
        }

        return $this->nameParts;
    }

    /**
     * Get the value of alternativeName
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AlternativeName[]
     */
    public function getAlternativeNames(string $query = ''): array
    {
        if (empty($this->alternativeNames)) {
            $xpath = './mods:alternativeName' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->alternativeNames[] = new AlternativeName($value);
                }
            }
        }

        return $this->alternativeNames;
    }

    /**
     * Get the value of nameIdentifier
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return NameIdentifier
     */
    public function getNameIdentifier(string $query): array
    {
        if (empty($this->nameIdentifiers)) {
            $xpath = './mods:nameIdentifier' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->nameIdentifiers[] = new NameIdentifier($value);
                }
            }
        }

        return $this->nameIdentifiers;
    }

    /**
     * Get the value of displayForm
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDisplayForms(string $query = ''): array
    {
        if (empty($this->displayForms)) {
            $xpath = './mods:displayForm' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->displayForms[] = new LanguageElement($value);
                }
            }
        }

        return $this->displayForms;
    }

    /**
     * Get the value of affiliation
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    public function getAffiliations(string $query = ''): array
    {
        if (empty($this->affiliations)) {
            $xpath = './mods:affiliation' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->affiliations[] = new AuthorityLanguageElement($value);
                }
            }
        }

        return $this->affiliations;
    }

    /**
     * Get the array of roles
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return Role[]
     */
    public function getRoles(string $query = ''): array
    {
        if (empty($this->roles)) {
            $xpath = './mods:role' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->roles[] = new AuthorityLanguageElement($value);
                }
            }
        }

        return $this->roles;
    }

    /**
     * Get the value of description
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return LanguageElement[]
     */
    public function getDescriptions(string $query = ''): array
    {
        if (empty($this->descriptions)) {
            $xpath = './mods:description' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->descriptions[] = new LanguageElement($value);
                }
            }
        }

        return $this->descriptions;
    }

    /**
     * Get the value of etal
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getEtal(): LanguageElement
    {
        return $this->etal;
    }
}
