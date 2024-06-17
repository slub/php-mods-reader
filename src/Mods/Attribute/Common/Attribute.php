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

namespace Slub\Mods\Attribute\Common;

/**
 * Trait for two general types of attributes
 */
trait Attribute
{

    /**
     * Get the string value of attribute.
     *
     * @access protected
     *
     * @param string $attribute name
     *
     * @return string
     */
    protected function getStringAttribute($attribute): string
    {
        if ($this->xml->attributes() != null) {
            $value = $this->xml->attributes()->$attribute;

            if (!empty($value)) {
                return $value;
            }
        }
        return '';
    }

    /**
     * Get the int value of attribute.
     *
     * @access protected
     *
     * @param string $attribute name
     *
     * @return int
     */
    protected function getIntAttribute($attribute): int
    {
        if ($this->xml->attributes() != null) {
            $value = $this->xml->attributes()->$attribute;

            if (!empty($value)) {
                return (int) $value;
            }
        }
        return 0;
    }
}
