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

use Slub\Mods\Element\Identifier;

/**
 * Trait for reading Identifier element
 */
trait IdentifierReader
{

    /**
     * Get the the array of the <identifier> elements.
     * @see https://www.loc.gov/standards/mods/userguide/identifier.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Identifier[]
     */
    public function getIdentifiers(string $query = ''): array
    {
        $identifiers = [];
        $values = $this->getValues('./mods:identifier' . $query);
        foreach ($values as $value) {
            $identifiers[] = new Identifier($value);
        }
        return $identifiers;
    }

    /**
     * Get the matching <identifier> element.
     * @see https://www.loc.gov/standards/mods/userguide/identifier.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Identifier
     */
    public function getIdentifier(int $index, string $query = ''): ?Identifier
    {
        $values = $this->getValues('./mods:identifier' . $query);
        if (array_key_exists($index, $values)) {
            return new Identifier($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <identifier> element.
     * @see https://www.loc.gov/standards/mods/userguide/identifier.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Identifier
     */
    public function getFirstIdentifier(string $query = ''): ?Identifier
    {
        return $this->getIdentifier(0, $query);
    }

    /**
     * Get the the last matching <identifier> element.
     * @see https://www.loc.gov/standards/mods/userguide/identifier.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Identifier
     */
    public function getLastIdentifier(string $query = ''): ?Identifier
    {
        $elements = $this->getIdentifiers($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
