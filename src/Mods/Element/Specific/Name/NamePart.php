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
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Element\Common\BaseElement;

/**
 * NamePart MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/name.html#namepart
 *
 * @access public
 */
class NamePart extends BaseElement
{
    use LanguageAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'date',
        'family',
        'given',
        'termsOfAddress'
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
     * Get the value of the 'tpe' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#nameParttype
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
