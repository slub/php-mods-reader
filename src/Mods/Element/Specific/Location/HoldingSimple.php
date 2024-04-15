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
use Slub\Mods\Element\Xml\Element;

/**
 * HoldingSimple MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/location.html#holdingsimple
 *
 * @access public
 */
class HoldingSimple extends BaseElement
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
     * Get the the array of the <copyInformation> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html#copyinformation
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return CopyInformation[]
     */
    public function getCopyInformation(string $query = ''): array
    {
        $copyInformation = [];
        $xpath = './mods:copyInformation' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $copyInformation[] = new CopyInformation($value);
            }
        }
        return $copyInformation;
    }
}
