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

use Slub\Mods\Attribute\Common\Attribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Specific\OtherTypeAttribute;
use Slub\Mods\Exception\IncorrectValueInAttributeException;
use Slub\Mods\ModsReader;

/**
 * RelatedItem MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class RelatedItem extends ModsReader
{
    use Attribute, IdAttribute, XlinkHrefAttribute, DisplayLabelAttribute, OtherTypeAttribute;

        /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'preceding',
        'succeeding',
        'original',
        'host',
        'constituent',
        'series',
        'otherVersion',
        'otherFormat',
        'isReferencedBy',
        'references',
        'reviewOf'
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
     * Get the value of the 'type' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/relateditem.html#type
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getType(): string
    {
        $type = $this->getStringAttribute('type');

        if (empty($type) || in_array($type, $this->allowedTypes)) {
            return $type;
        }

        throw new IncorrectValueInAttributeException('type', $type);
    }
}
