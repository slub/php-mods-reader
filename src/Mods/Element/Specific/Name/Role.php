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
 *
 * @access public
 */
class Role extends BaseElement
{

    /**
     * @access private
     * @var array
     */
    private array $roleTerms = [];

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
     * Get the value of role term
     *
     * @access public
     *
     * @param string $query The XPath query for metadata search
     *
     * @return RoleTerm[]
     */
    public function getRoleTerms(string $query = ''): array
    {
        if (empty($this->roleTerms)) {
            $xpath = './mods:roleTerm' . $query;
            $element = new Element($this->xml, $xpath);

            if ($element->exists()) {
                foreach ($element->getValues() as $value) {
                    $this->roleTerms[] = new RoleTerm($value);
                }
            }
        }

        return $this->roleTerms;
    }
}
