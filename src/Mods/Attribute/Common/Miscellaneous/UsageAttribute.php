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

use Slub\Mods\Exception\IncorrectValueInAttributeException;

/**
 * Trait for usage common attribute
 */
trait UsageAttribute
{

    /**
     * @access private
     * @var array
     */
    private array $allowedUsages = [
        'primary',
        'primaryDisplay'
    ];

    /**
     * Get the value of the 'usage' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#usage
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getUsage(): string
    {
        $usage = $this->getStringAttribute('usage');

        if (empty($usage) || in_array($usage, $this->allowedUsages)) {
            return $usage;
        }

        throw new IncorrectValueInAttributeException('usage', $usage);
    }
}
