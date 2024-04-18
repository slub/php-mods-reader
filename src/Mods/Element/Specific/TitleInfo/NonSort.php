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
use Slub\Mods\Exception\IncorrectValueInAttributeException;

/**
 * NonSort MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html#nonsort
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
     * Get the value of the 'xmlSpace' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#xmlspace
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getXmlSpace(): string
    {
        $xmlSpace = $this->getStringAttribute('xml:space');

        if (empty($xmlSpace) || in_array($xmlSpace, $this->allowedXmlSpaces)) {
            return $xmlSpace;
        }

        throw new IncorrectValueInAttributeException('xml:space', $xmlSpace);
    }
}
