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
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Note;
use Slub\Mods\Element\Specific\PhysicalDescription\Extent;
use Slub\Mods\Element\Specific\PhysicalDescription\Form;

/**
 * PhysicalDescription MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class PhysicalDescription extends BaseElement
{
    use LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var Form
     */
    private Form $form;

    /**
     * @access private
     * @var string
     */
    private string $reformattingQuality;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $internetMediaType;

    /**
     * @access private
     * @var Extent
     */
    private Extent $extent;

    /**
     * @access private
     * @var string
     */
    private string $digitalOrigin;

    /**
     * @access private
     * @var Note
     */
    private Note $note;

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

        $this->form = new Form($xml);
        $this->reformattingQuality = '';
        $this->internetMediaType = new LanguageElement($xml);
        $this->extent = new Extent($xml);
        $this->digitalOrigin = '';
        $this->note = new Note($xml);
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
     * Get the value of reformattingQuality
     *
     * @access public
     *
     * @return string
     */
    public function getReformattingQuality(): string
    {
        return $this->reformattingQuality;
    }

    /**
     * Get the value of internetMediaType
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getInternetMediaType(): LanguageElement
    {
        return $this->internetMediaType;
    }

    /**
     * Get the value of extent
     *
     * @access public
     *
     * @return Extent
     */
    public function getExtent(): Extent
    {
        return $this->extent;
    }

    /**
     * Get the value of digitalOrigin
     *
     * @access public
     *
     * @return string
     */
    public function getDigitalOrigin(): string
    {
        return $this->digitalOrigin;
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
}
