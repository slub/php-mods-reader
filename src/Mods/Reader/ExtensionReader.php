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

use Slub\Mods\Element\Extension;
use Slub\Mods\Element\Xml\Element;

/**
 * Trait for reading Extension element
 */
trait ExtensionReader
{

    /**
     * Get the the array of the <extension> elements.
     * @see https://www.loc.gov/standards/mods/userguide/extension.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return Extension[]
     */
    public function getExtensions(string $query = ''): array
    {
        $extensions = [];
        $values = $this->getValues('./mods:extension' . $query);
        foreach ($values as $value) {
            $extensions[] = new Extension($value);
        }
        return $extensions;
    }

    /**
     * Get the matching <extension> element.
     * @see https://www.loc.gov/standards/mods/userguide/extension.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?Extension
     */
    public function getExtension(int $index, string $query = ''): ?Extension
    {
        $values = $this->getValues('./mods:extension' . $query);
        if (array_key_exists($index, $values)) {
            return new Extension($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <extension> element.
     * @see https://www.loc.gov/standards/mods/userguide/extension.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Extension
     */
    public function getFirstExtension(string $query = ''): ?Extension
    {
        return $this->getExtension(0, $query);
    }

    /**
     * Get the the last matching <extension> element.
     * @see https://www.loc.gov/standards/mods/userguide/extension.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?Extension
     */
    public function getLastExtension(string $query = ''): ?Extension
    {
        $elements = $this->getExtensions($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
