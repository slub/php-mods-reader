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

use Slub\Mods\Element\Subject;

/**
 * Trait for reading Subject element
 */
trait SubjectReader
{

    /**
     * Get the the array of the <subject> elements.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Subject[]
     */
    public function getSubjects(string $query = ''): array
    {
        $subjects = [];
        $values = $this->getValues('./mods:subject' . $query);
        foreach ($values as $value) {
            $subjects[] = new Subject($value);
        }
        return $subjects;
    }

    /**
     * Get the matching <subject> element.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Subject
     */
    public function getSubject(int $index, string $query = ''): ?Subject
    {
        $values = $this->getValues('./mods:subject' . $query);
        if (array_key_exists($index, $values)) {
            return new Subject($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <subject> element.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Subject
     */
    public function getFirstSubject(string $query = ''): ?Subject
    {
        return $this->getSubject(0, $query);
    }

    /**
     * Get the the last matching <subject> element.
     * @see https://www.loc.gov/standards/mods/userguide/subject.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Subject
     */
    public function getLastSubject(string $query = ''): ?Subject
    {
        $elements = $this->getSubjects($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
