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

use Slub\Mods\Element\Language;

/**
 * Trait for reading Language element
 */
trait LanguageReader
{

    /**
     * Get the array of the <language> elements.
     * @see https://www.loc.gov/standards/mods/userguide/language.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Language[]
     */
    public function getLanguages(string $query = ''): array
    {
        $languages = [];
        $values = $this->getValues('./mods:language' . $query);
        foreach ($values as $value) {
            $languages[] = new Language($value);
        }
        return $languages;
    }

    /**
     * Get the matching <language> element.
     * @see https://www.loc.gov/standards/mods/userguide/language.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Language
     */
    public function getLanguage(int $index, string $query = ''): ?Language
    {
        $values = $this->getValues('./mods:language' . $query);
        if (array_key_exists($index, $values)) {
            return new Language($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <language> element.
     * @see https://www.loc.gov/standards/mods/userguide/language.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Language
     */
    public function getFirstLanguage(string $query = ''): ?Language
    {
        return $this->getLanguage(0, $query);
    }

    /**
     * Get the the last matching <language> element.
     * @see https://www.loc.gov/standards/mods/userguide/language.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Language
     */
    public function getLastLanguage(string $query = ''): ?Language
    {
        $elements = $this->getLanguages($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
