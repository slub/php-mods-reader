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

namespace Slub\Mods\Element\Specific\OriginInfo;

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

/**
 * Agent MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Agent extends BaseElement
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
     * @var NamePart
     */
    private NamePart $namePart;

    /**
     * @access private
     * @var AlternativeName
     */
    private AlternativeName $alternativeName;

    /**
     * @access private
     * @var NameIdentifier
     */
    private NameIdentifier $nameIdentifier;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $displayForm;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $affiliation;

    /**
     * @access private
     * @var Role
     */
    private Role $role;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $description;

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

        $this->namePart = new NamePart($xml);
        $this->alternativeName = new AlternativeName($xml);
        $this->nameIdentifier = new NameIdentifier($xml);
        $this->displayForm = new LanguageElement($xml);
        $this->affiliation = new AuthorityLanguageElement($xml);
        $this->role = new Role($xml);
        $this->description = new LanguageElement($xml);
        $this->etal = new LanguageElement($xml);
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
     * @return NamePart
     */
    public function getNamePart(): NamePart
    {
        return $this->namePart;
    }

    /**
     * Get the value of alternativeName
     *
     * @access public
     *
     * @return AlternativeName
     */
    public function getAlternativeName(): AlternativeName
    {
        return $this->alternativeName;
    }

    /**
     * Get the value of nameIdentifier
     *
     * @access public
     *
     * @return NameIdentifier
     */
    public function getNameIdentifier(): NameIdentifier
    {
        return $this->nameIdentifier;
    }

    /**
     * Get the value of displayForm
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getDisplayForm(): LanguageElement
    {
        return $this->displayForm;
    }

    /**
     * Get the value of affiliation
     *
     * @access public
     *
     * @return AuthorityLanguageElement
     */
    public function getAffiliation(): AuthorityLanguageElement
    {
        return $this->affiliation;
    }

    /**
     * Get the value of role
     *
     * @access public
     *
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * Get the value of description
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getDescription(): LanguageElement
    {
        return $this->description;
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
