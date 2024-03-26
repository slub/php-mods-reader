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
 * Extent MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class Extent extends BaseElement
{

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $start;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $end;

    /**
     * @access private
     * @var int
     */
    private int $total;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $list;

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
     * Get the value of unit
     *
     * @access public
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->getStringAttribute('unit');
    }

    /**
     * Get the value of start
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getStart(): LanguageElement
    {
        return $this->start;
    }

    /**
     * Get the value of end
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getEnd(): LanguageElement
    {
        return $this->end;
    }

    /**
     * Get the value of total
     *
     * @access public
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * Get the value of list
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getList(): LanguageElement
    {
        return $this->list;
    }
}
