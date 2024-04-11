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

namespace Slub\Mods\Element\Specific\Part;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;

/**
 * Detail MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class Detail extends BaseElement
{

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $number;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $caption;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $title;

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
     * Get the value of level
     *
     * @access public
     *
     * @return int
     */
    public function getLevel(): int
    {
        return $this->getIntAttribute('level');
    }

    /**
     * Get the value of number
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getNumber(): LanguageElement
    {
        return $this->number;
    }

    /**
     * Get the value of caption
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getCaption(): LanguageElement
    {
        return $this->caption;
    }

    /**
     * Get the value of title
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getTitle(): LanguageElement
    {
        return $this->title;
    }
}
