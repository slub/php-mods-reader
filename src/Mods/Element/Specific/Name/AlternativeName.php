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

use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\Name\NameIdentifier;

/**
 * AlternativeName MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class AlternativeName extends BaseElement
{
    use LanguageAttribute, IdAttribute, XlinkHrefAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var string
     */
    private string $alternativeType;

    /**
     * @access private
     * @var array
     */
    private array $allowedAlternativeTypes = [
        'formal name',
        'preferred name',
        'preferred name',
        'nickname',
        'no specific type'
    ];

    /**
     * @access private
     * @var NamePart
     */
    private NamePart $namePart;

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
        $this->nameIdentifier = new NameIdentifier($xml);
        $this->displayForm = new LanguageElement($xml);
        $this->affiliation = new AuthorityLanguageElement($xml);
        $this->role = new Role($xml);
        $this->description = new LanguageElement($xml);
    }

    /**
     * Get the value of alternative type
     *
     * @access public
     *
     * @return string
     */
    public function getAlternativeType(): string
    {
        return $this->getStringAttribute('alternativeType');
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
}
