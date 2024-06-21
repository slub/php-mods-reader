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

use Slub\Mods\Element\PhysicalDescription;

/**
 * Trait for reading PhysicalDescription element
 */
trait PhysicalDescriptionReader
{

    /**
     * Get the the array of the <physicalDescription> elements.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return PhysicalDescription[]
     */
    public function getPhysicalDescriptions(string $query = ''): array
    {
        $physicalDescriptions = [];
        $values = $this->getValues('./mods:physicalDescription' . $query);
        foreach ($values as $value) {
            $physicalDescriptions[] = new PhysicalDescription($value);
        }
        return $physicalDescriptions;
    }

    /**
     * Get the matching <physicalDescription> element.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?PhysicalDescription
     */
    public function getPhysicalDescription(int $index, string $query = ''): ?PhysicalDescription
    {
        $values = $this->getValues('./mods:physicalDescription' . $query);
        if (array_key_exists($index, $values)) {
            return new PhysicalDescription($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <physicalDescription> element.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?PhysicalDescription
     */
    public function getFirstPhysicalDescription(string $query = ''): ?PhysicalDescription
    {
        return $this->getPhysicalDescription(0, $query);
    }

    /**
     * Get the the last matching <physicalDescription> element.
     * @see https://www.loc.gov/standards/mods/userguide/physicaldescription.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?PhysicalDescription
     */
    public function getLastPhysicalDescription(string $query = ''): ?PhysicalDescription
    {
        $elements = $this->getPhysicalDescriptions($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
