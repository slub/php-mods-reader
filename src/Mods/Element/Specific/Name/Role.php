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

use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Specific\Name\RoleTerm;
use Slub\Mods\Element\Xml\Element;

/**
 * Role MODS metadata element class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/name.html#role
 *
 * @access public
 */
class Role extends BaseElement
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
     * Get the the array of the <roleTerm> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html#roleterm
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return RoleTerm[]
     */
    public function getRoleTerms(string $query = ''): array
    {
        $roleTerms = [];
        $xpath = './mods:roleTerm' . $query;
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $roleTerms[] = new RoleTerm($value);
        }
        return $roleTerms;
    }
}
