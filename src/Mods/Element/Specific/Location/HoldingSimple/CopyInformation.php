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

namespace Slub\Mods\Element\Specific\Location\HoldingSimple;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Note;
use Slub\Mods\Element\Specific\Location\HoldingSimple\CopyInformation\EnumerationAndChronology;
use Slub\Mods\Element\Specific\Location\HoldingSimple\CopyInformation\ItemIdentifier;
use Slub\Mods\Element\Specific\PhysicalDescription\Form;

/**
 * HoldingSimple MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class CopyInformation extends BaseElement
{

    /**
     * @access private
     * @var Form
     */
    private Form $form;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $subLocation;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $shelfLocator;

    /**
     * @access private
     * @var string
     */
    private string $electronicLocator;

    /**
     * @access private
     * @var Note
     */
    private Note $note;

    /**
     * @access private
     * @var EnumerationAndChronology
     */
    private EnumerationAndChronology $enumerationAndChronology;

    /**
     * @access private
     * @var ItemIdentifier
     */
    private ItemIdentifier $itemIdentifier;

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
     * Get the value of form
     *
     * @access public
     *
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * Get the value of subLocation
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getSubLocation(): LanguageElement
    {
        return $this->subLocation;
    }

    /**
     * Get the value of shelfLocator
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getShelfLocator(): LanguageElement
    {
        return $this->shelfLocator;
    }

    /**
     * Get the value of electronicLocator
     *
     * @access public
     *
     * @return string
     */
    public function getElectronicLocator(): string
    {
        return $this->electronicLocator;
    }

    /**
     * Get the value of note
     *
     * @access public
     *
     * @return Note
     */
    public function getNote(): Note
    {
        return $this->note;
    }

    /**
     * Get the value of enumerationAndChronology
     *
     * @access public
     *
     * @return EnumerationAndChronology
     */
    public function getEnumerationAndChronology(): EnumerationAndChronology
    {
        return $this->enumerationAndChronology;
    }

    /**
     * Get the value of itemIdentifier
     *
     * @access public
     *
     * @return ItemIdentifier
     */
    public function getItemIdentifier(): ItemIdentifier
    {
        return $this->itemIdentifier;
    }
}
