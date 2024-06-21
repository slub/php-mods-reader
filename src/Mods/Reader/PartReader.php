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

use Slub\Mods\Element\Part;

/**
 * Trait for reading Part element
 */
trait PartReader
{

    /**
     * Get the the array of the <part> elements.
     * @see https://www.loc.gov/standards/mods/userguide/part.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Part[]
     */
    public function getParts(string $query = ''): array
    {
        $parts = [];
        $values = $this->getValues('./mods:part' . $query);
        foreach ($values as $value) {
            $parts[] = new Part($value);
        }
        return $parts;
    }

    /**
     * Get the matching <part> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Part
     */
    public function getPart(int $index, string $query = ''): ?Part
    {
        $values = $this->getValues('./mods:part' . $query);
        if (array_key_exists($index, $values)) {
            return new Part($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <part> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Part
     */
    public function getFirstPart(string $query = ''): ?Part
    {
        return $this->getPart(0, $query);
    }

    /**
     * Get the the last matching <part> element.
     * @see https://www.loc.gov/standards/mods/userguide/part.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Part
     */
    public function getLastPart(string $query = ''): ?Part
    {
        $elements = $this->getParts($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
