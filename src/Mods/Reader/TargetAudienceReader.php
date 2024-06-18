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

use Slub\Mods\Element\TargetAudience;

/**
 * Trait for reading TargetAudience element
 */
trait TargetAudienceReader
{

    /**
     * Get the the array of the <targetAudience> elements.
     * @see https://www.loc.gov/standards/mods/userguide/targetaudience.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return TargetAudience[]
     */
    public function getTargetAudiences(string $query = ''): array
    {
        $targetAudiences = [];
        $values = $this->getValues('./mods:targetAudience' . $query);
        foreach ($values as $value) {
            $targetAudiences[] = new TargetAudience($value);
        }
        return $targetAudiences;
    }

    /**
     * Get the matching <targetAudience> element.
     * @see https://www.loc.gov/standards/mods/userguide/targetaudience.html
     *
     * @access public
     *
     * @param int $index of the searched element
     * @param string $query for metadata search
     *
     * @return ?TargetAudience
     */
    public function getTargetAudience(int $index, string $query = ''): ?TargetAudience
    {
        $values = $this->getValues('./mods:targetAudience' . $query);
        if (array_key_exists($index, $values)) {
            return new TargetAudience($values[$index]);
        }
        return null;
    }

    /**
     * Get the the first matching <targetAudience> element.
     * @see https://www.loc.gov/standards/mods/userguide/targetaudience.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TargetAudience
     */
    public function getFirstTargetAudience(string $query = ''): ?TargetAudience
    {
        return $this->getTargetAudience(0, $query);
    }

    /**
     * Get the the last matching <targetAudience> element.
     * @see https://www.loc.gov/standards/mods/userguide/targetaudience.html
     *
     * @access public
     *
     * @param string $query for metadata search
     *
     * @return ?TargetAudience
     */
    public function getLastTargetAudience(string $query = ''): ?TargetAudience
    {
        $elements = $this->getTargetAudiences($query);
        $count = count($elements);
        if ($count > 0) {
            return $elements[$count - 1];
        }
        return null;
    }
}
