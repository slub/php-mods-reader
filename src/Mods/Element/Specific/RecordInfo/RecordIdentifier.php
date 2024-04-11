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

namespace Slub\Mods\Element\Specific\RecordInfo;

use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * RecordIdentifier MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#recordidentifier
 *
 * @access public
 */
class RecordIdentifier extends BaseElement
{
    use LanguageAttribute;

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
     * Get the value of the 'source' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html#source
     *
     * @access public
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->getStringAttribute('source');
    }
}
