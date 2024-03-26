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

trait IdAttribute
{

    /**
     * Get the value of id
     *
     * @access public
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->getStringAttribute('ID');
    }

        /**
     * Get the value of idRef
     *
     * @access public
     *
     * @return string
     */
    public function getIdRef(): string
    {
        return $this->getStringAttribute('IDREF');
    }
}
