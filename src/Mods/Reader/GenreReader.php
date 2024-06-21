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

use Slub\Mods\Element\Genre;

/**
 * Trait for reading Genre element
 */
trait GenreReader
{

    /**
     * Get the the array of the <genre> elements.
     * @see https://www.loc.gov/standards/mods/userguide/genre.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Genre[]
     */
    public function getGenres(string $query = ''): array
    {
        $genres = [];
        $values = $this->getValues('./mods:genre' . $query);
        foreach ($values as $value) {
            $genres[] = new Genre($value);
        }
        return $genres;
    }

    /**
     * Get the matching <genre> element.
     * @see https://www.loc.gov/standards/mods/userguide/genre.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Genre
     */
    public function getGenre(int $index, string $query = ''): ?Genre
    {
        $values = $this->getValues('./mods:genre' . $query);
        if (array_key_exists($index, $values)) {
            return new Genre($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <genre> element.
     * @see https://www.loc.gov/standards/mods/userguide/genre.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Genre
     */
    public function getFirstGenre(string $query = ''): ?Genre
    {
        return $this->getGenre(0, $query);
    }

    /**
     * Get the the last matching <genre> element.
     * @see https://www.loc.gov/standards/mods/userguide/genre.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Genre
     */
    public function getLastGenre(string $query = ''): ?Genre
    {
        $elements = $this->getGenres($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
