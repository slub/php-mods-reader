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

use Slub\Mods\Element\Classification;

/**
 * Trait for reading Classification element
 */
trait ClassificationReader
{
    /**
     * Get the the array of the <classification> elements.
     * @see https://www.loc.gov/standards/mods/userguide/classification.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Classification[]
     */
    public function getClassifications(string $query = ''): array
    {
        $classifications = [];
        $values = $this->getValues('./mods:classification' . $query);
        foreach ($values as $value) {
            $classifications[] = new Classification($value);
        }
        return $classifications;
    }

    /**
     * Get the matching <classification> element.
     * @see https://www.loc.gov/standards/mods/userguide/classification.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Classification
     */
    public function getClassification(int $index, string $query = ''): ?Classification
    {
        $values = $this->getValues('./mods:classification' . $query);
        if (array_key_exists($index, $values)) {
            return new Classification($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <classification> element.
     * @see https://www.loc.gov/standards/mods/userguide/classification.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Classification
     */
    public function getFirstClassification(string $query = ''): ?Classification
    {
        return $this->getClassification(0, $query);
    }

    /**
     * Get the the last matching <classification> element.
     * @see https://www.loc.gov/standards/mods/userguide/classification.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Classification
     */
    public function getLastClassification(string $query = ''): ?Classification
    {
        $elements = $this->getClassifications($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
