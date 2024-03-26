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

namespace Slub\Mods\Attribute\Common\Miscellaneous;

/**
 * Trait for typeURI common attribute
 */
trait TypeUriAttribute
{

    /**
     * Get the value of type URI
     *
     * @access public
     *
     * @return string
     */
    public function getTypeUri(): string
    {
        return $this->getStringAttribute('typeURI');
    }
}
