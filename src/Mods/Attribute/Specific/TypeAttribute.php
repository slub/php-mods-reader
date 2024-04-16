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

use Slub\Mods\Exception\IncorrectValueInAttributeException;

/**
 * Trait for type specific attribute
 */
trait TypeAttribute
{

    /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'text',
        'code'
    ];

    /**
     * Get the value of the 'type' attribute.
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getType(): string
    {
        $type = $this->getStringAttribute('type');

        if (empty($type) || in_array($type, $this->allowedTypes)) {
            return $type;
        }

        throw new IncorrectValueInAttributeException('type', $type);
    }
}
