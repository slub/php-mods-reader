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

use Slub\Mods\Element\OriginInfo;

/**
 * Trait for reading OriginInfo element
 */
trait OriginInfoReader
{

    /**
     * Get the the array of the <originInfo> elements.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return OriginInfo[]
     */
    public function getOriginInfos(string $query = ''): array
    {
        $originInfos = [];
        $values = $this->getValues('./mods:originInfo' . $query);
        foreach ($values as $value) {
            $originInfos[] = new OriginInfo($value);
        }
        return $originInfos;
    }

    /**
     * Get the matching <originInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?OriginInfo
     */
    public function getOriginInfo(int $index, string $query = ''): ?OriginInfo
    {
        $values = $this->getValues('./mods:originInfo' . $query);
        if (array_key_exists($index, $values)) {
            return new OriginInfo($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <originInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?OriginInfo
     */
    public function getFirstOriginInfo(string $query = ''): ?OriginInfo
    {
        return $this->getOriginInfo(0, $query);
    }

    /**
     * Get the the last matching <originInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/origininfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?OriginInfo
     */
    public function getLastOriginInfo(string $query = ''): ?OriginInfo
    {
        $elements = $this->getOriginInfos($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
