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

namespace Slub\Mods\Element\Specific\TitleInfo;

use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * NonSort MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class NonSort extends BaseElement
{
    use LanguageAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedXmlSpaces = [
        'default',
        'preserve'
    ];

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
     * Get the value of xmlSpace
     *
     * @access public
     *
     * @return string
     */
    public function getXmlSpace(): string
    {
        return $this->getStringAttribute('xmlSpace');
    }
}
