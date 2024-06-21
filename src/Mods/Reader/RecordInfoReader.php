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

use Slub\Mods\Element\RecordInfo;

/**
 * Trait for reading RecordInfo element
 */
trait RecordInfoReader
{

    /**
     * Get the the array of the <recordInfo> elements.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return RecordInfo[]
     */
    public function getRecordInfos(string $query = ''): array
    {
        $recordInfos = [];
        $values = $this->getValues('./mods:recordInfo' . $query);
        foreach ($values as $value) {
            $recordInfos[] = new RecordInfo($value);
        }
        return $recordInfos;
    }

    /**
     * Get the matching <recordInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?RecordInfo
     */
    public function getRecordInfo(int $index, string $query = ''): ?RecordInfo
    {
        $values = $this->getValues('./mods:recordInfo' . $query);
        if (array_key_exists($index, $values)) {
            return new RecordInfo($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <recordInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?RecordInfo
     */
    public function getFirstRecordInfo(string $query = ''): ?RecordInfo
    {
        return $this->getRecordInfo(0, $query);
    }

    /**
     * Get the the last matching <recordInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/recordinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?RecordInfo
     */
    public function getLastRecordInfo(string $query = ''): ?RecordInfo
    {
        $elements = $this->getRecordInfos($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
