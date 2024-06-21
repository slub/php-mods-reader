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

use Slub\Mods\Element\Location;

/**
 * Trait for reading Location element
 */
trait LocationReader
{

    /**
     * Get the the array of the <location> elements.
     * @see https://www.loc.gov/standards/mods/userguide/location.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Location[]
     */
    public function getLocations(string $query = ''): array
    {
        $locations = [];
        $values = $this->getValues('./mods:location' . $query);
        foreach ($values as $value) {
            $locations[] = new Location($value);
        }
        return $locations;
    }

    /**
     * Get the matching <location> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Location
     */
    public function getLocation(int $index, string $query = ''): ?Location
    {
        $values = $this->getValues('./mods:location' . $query);
        if (array_key_exists($index, $values)) {
            return new Location($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <location> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Location
     */
    public function getFirstLocation(string $query = ''): ?Location
    {
        return $this->getLocation(0, $query);
    }

    /**
     * Get the the last matching <location> element.
     * @see https://www.loc.gov/standards/mods/userguide/location.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Location
     */
    public function getLastLocation(string $query = ''): ?Location
    {
        $elements = $this->getLocations($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
