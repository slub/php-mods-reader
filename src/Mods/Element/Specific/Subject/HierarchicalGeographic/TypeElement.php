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

namespace Slub\Mods\Element\Specific\Subject\HierarchicalGeographic;

/**
 * TypeElement MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class TypeElement extends Element
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
}
