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

use Slub\Mods\Element\TableOfContents;

/**
 * Trait for reading TableOfContents element
 */
trait TableOfContentsReader
{

    /**
     * Get the the array of the <tableOfContents> elements.
     * @see https://www.loc.gov/standards/mods/userguide/tableofcontents.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TableOfContents[]
     */
    public function getTablesOfContents(string $query = ''): array
    {
        $tableOfContents = [];
        $values = $this->getValues('./mods:tableOfContents' . $query);
        foreach ($values as $value) {
            $tableOfContents[] = new TableOfContents($value);
        }
        return $tableOfContents;
    }

    /**
     * Get the matching <tableOfContents> element.
     * @see https://www.loc.gov/standards/mods/userguide/tableofcontents.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?TableOfContents
     */
    public function getTableOfContents(int $index, string $query = ''): ?TableOfContents
    {
        $values = $this->getValues('./mods:tableOfContents' . $query);
        if (array_key_exists($index, $values)) {
            return new TableOfContents($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <tableOfContents> element.
     * @see https://www.loc.gov/standards/mods/userguide/tableofcontents.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TableOfContents
     */
    public function getFirstTableOfContents(string $query = ''): ?TableOfContents
    {
        return $this->getTableOfContents(0, $query);
    }

    /**
     * Get the the last matching <tableOfContents> element.
     * @see https://www.loc.gov/standards/mods/userguide/tableofcontents.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TableOfContents
     */
    public function getLastTableOfContents(string $query = ''): ?TableOfContents
    {
        $elements = $this->getTablesOfContents($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
