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
use Slub\Mods\Exception\IncorrectValueInAttributeException;

/**
 * AlternativeName MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/name.html#alternativename
 *
 * @access public
 */
class AlternativeName extends BaseNameElement
{
    use LanguageAttribute, IdAttribute, XlinkHrefAttribute, DisplayLabelAttribute;

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
     * Get the value of the 'altType' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#altType
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getAlternativeType(): string
    {
        $altType = $this->getStringAttribute('altType');

        if (empty($altType) || in_array($altType, $this->allowedAlternativeTypes)) {
            return $altType;
        }

        throw new IncorrectValueInAttributeException('altType', $altType);
    }
}
