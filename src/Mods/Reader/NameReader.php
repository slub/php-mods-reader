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

use Slub\Mods\Element\Name;

/**
 * Trait for reading Name element
 */
trait NameReader
{

    /**
     * Get the the array of the <name> elements.
     * @see https://www.loc.gov/standards/mods/userguide/name.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Name[]
     */
    public function getNames(string $query = ''): array
    {
        $names = [];
        $values = $this->getValues('./mods:name' . $query);
        foreach ($values as $value) {
            $names[] = new Name($value);
        }
        return $names;
    }

    /**
     * Get the matching <name> element.
     * @see https://www.loc.gov/standards/mods/userguide/name.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Name
     */
    public function getName(int $index, string $query = ''): ?Name
    {
        $values = $this->getValues('./mods:name' . $query);
        if (array_key_exists($index, $values)) {
            return new Name($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <name> element.
     * @see https://www.loc.gov/standards/mods/userguide/name.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Name
     */
    public function getFirstName(string $query = ''): ?Name
    {
        return $this->getName(0, $query);
    }

    /**
     * Get the the last matching <name> element.
     * @see https://www.loc.gov/standards/mods/userguide/name.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Name
     */
    public function getLastName(string $query = ''): ?Name
    {
        $elements = $this->getNames($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
