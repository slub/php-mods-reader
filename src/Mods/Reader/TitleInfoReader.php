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

use Slub\Mods\Element\TitleInfo;

/**
 * Trait for reading TitleInfo element
 */
trait TitleInfoReader
{

    /**
     * Get the the array of the <titleInfo> elements.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TitleInfo[]
     */
    public function getTitleInfos(string $query = ''): array
    {
        $titleInfos = [];
        $values = $this->getValues('./mods:titleInfo' . $query);
        foreach ($values as $value) {
            $titleInfos[] = new TitleInfo($value);
        }
        return $titleInfos;
    }

    /**
     * Get the matching <titleInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?TitleInfo
     */
    public function getTitleInfo(int $index, string $query = ''): ?TitleInfo
    {
        $values = $this->getValues('./mods:titleInfo' . $query);
        if (array_key_exists($index, $values)) {
            return new TitleInfo($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <titleInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TitleInfo
     */
    public function getFirstTitleInfo(string $query = ''): ?TitleInfo
    {
        return $this->getTitleInfo(0, $query);
    }

    /**
     * Get the the last matching <titleInfo> element.
     * @see https://www.loc.gov/standards/mods/userguide/titleinfo.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TitleInfo
     */
    public function getLastTitleInfo(string $query = ''): ?TitleInfo
    {
        $elements = $this->getTitleInfos($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
