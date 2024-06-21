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

namespace Slub\Mods\Attribute\Specific;

/**
 * Trait for invalid specific attribute
 */
trait InvalidAttribute
{

    /**
     * Get the value of the 'invalid' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/identifier.html#invalid
     *
     * @access public
     *
     * @return bool
     */
    public function isInvalid(): bool
    {
        return !empty($this->xml->attributes()->invalid);
    }
}
