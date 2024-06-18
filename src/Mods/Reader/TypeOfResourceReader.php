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

namespace Slub\Mods\Reader;

use Slub\Mods\Element\TypeOfResource;
use Slub\Mods\Element\Xml\Element;

/**
 * Trait for reading TypeOfResource element
 */
trait TypeOfResourceReader
{

    /**
     * Get the value of the <typeOfResource> element.
     * @see https://www.loc.gov/standards/mods/userguide/typeofresource.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TypeOfResource
     */
    public function getTypeOfResource(string $query = ''): ?TypeOfResource
    {
        $xpath = './mods:typeOfResource' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new TypeOfResource($element->getFirstValue());
        }
        return null;
    }
}
