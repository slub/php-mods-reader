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

namespace Slub\Mods\Element\Specific\Location;

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\Location\HoldingSimple\CopyInformation;

/**
 * HoldingSimple MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class HoldingSimple extends BaseElement
{

    /**
     * @access private
     * @var CopyInformation
     */
    private CopyInformation $copyInformation;

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
     * Get the value of copyInformation
     *
     * @access public
     *
     * @return CopyInformation
     */
    public function getCopyInformation(): CopyInformation
    {
        return $this->copyInformation;
    }
}
