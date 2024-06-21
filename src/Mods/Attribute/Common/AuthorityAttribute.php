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

trait AuthorityAttribute
{

    /**
     * Get the value of the 'authority' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#authority
     *
     * @access public
     *
     * @return string
     */
    public function getAuthority(): string
    {
        return $this->getStringAttribute('authority');
    }

    /**
     * Get the value of the 'authorityURI' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#authorityURI
     *
     * @access public
     *
     * @return string
     */
    public function getAuthorityURI(): string
    {
        return $this->getStringAttribute('authorityURI');
    }

    /**
     * Get the value of the 'valueURI' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#valueURI
     *
     * @access public
     *
     * @return string
     */
    public function getValueURI(): string
    {
        return $this->getStringAttribute('valueURI');
    }
}
