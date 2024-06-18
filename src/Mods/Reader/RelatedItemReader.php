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

use Slub\Mods\Element\RelatedItem;

/**
 * Trait for reading RelatedItem element
 */
trait RelatedItemReader
{

    /**
     * Get the the array of the <relatedItem> elements.
     * @see https://www.loc.gov/standards/mods/userguide/relateditem.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return RelatedItem[]
     */
    public function getRelatedItems(string $query = ''): array
    {
        $relatedItems = [];
        $values = $this->getValues('./mods:relatedItem' . $query);
        foreach ($values as $value) {
            $relatedItems[] = new RelatedItem($value);
        }
        return $relatedItems;
    }

    /**
     * Get the matching <relatedItem> element.
     * @see https://www.loc.gov/standards/mods/userguide/relateditem.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?RelatedItem
     */
    public function getRelatedItem(int $index, string $query = ''): ?RelatedItem
    {
        $values = $this->getValues('./mods:relatedItem' . $query);
        if (array_key_exists($index, $values)) {
            return new RelatedItem($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <relatedItem> element.
     * @see https://www.loc.gov/standards/mods/userguide/relateditem.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?RelatedItem
     */
    public function getFirstRelatedItem(string $query = ''): ?RelatedItem
    {
        return $this->getRelatedItem(0, $query);
    }

    /**
     * Get the the last matching <relatedItem> element.
     * @see https://www.loc.gov/standards/mods/userguide/relateditem.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?RelatedItem
     */
    public function getLastRelatedItem(string $query = ''): ?RelatedItem
    {
        $elements = $this->getRelatedItems($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
