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

namespace Slub\Mods\Attribute\Common\Linking;

trait AltRepGroupAttribute
{

    /**
     * Get used to link alternative representations of the same element content,
     * for different languages, scripts, transliterations, and translations.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#altRepGroup
     *
     * @access public
     *
     * @return string
     */
    public function getAltRepGroup(): string
    {
        return $this->getStringAttribute('altRepGroup');
    }
}
