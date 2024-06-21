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

use Slub\Mods\Element\Note;

/**
 * Trait for reading Note element
 */
trait NoteReader
{

    /**
     * Get the the array of the <note> elements.
     * @see https://www.loc.gov/standards/mods/userguide/note.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Note[]
     */
    public function getNotes(string $query = ''): array
    {
        $notes = [];
        $values = $this->getValues('./mods:note' . $query);
        foreach ($values as $value) {
            $notes[] = new Note($value);
        }
        return $notes;
    }

    /**
     * Get the matching <note> element.
     * @see https://www.loc.gov/standards/mods/userguide/note.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Note
     */
    public function getNote(int $index, string $query = ''): ?Note
    {
        $values = $this->getValues('./mods:note' . $query);
        if (array_key_exists($index, $values)) {
            return new Note($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <note> element.
     * @see https://www.loc.gov/standards/mods/userguide/note.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Note
     */
    public function getFirstNote(string $query = ''): ?Note
    {
        return $this->getNote(0, $query);
    }

    /**
     * Get the the last matching <note> element.
     * @see https://www.loc.gov/standards/mods/userguide/note.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Note
     */
    public function getLastNote(string $query = ''): ?Note
    {
        $elements = $this->getNotes($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
