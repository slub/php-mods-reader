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

use Slub\Mods\Element\AbstractElement;
use Slub\Mods\Element\Xml\Element;

/**
 * Trait for reading Abstract element
 */
trait AbstractReader
{

    /**
     * Get the value of the <abstract> element.
     * @see https://www.loc.gov/standards/mods/userguide/abstract.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?AbstractElement
     */
    public function getAbstract(string $query = ''): ?AbstractElement
    {
        $xpath = './mods:abstract' . $query;
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new AbstractElement($element->getFirstValue());
        }
        return null;
    }
}
