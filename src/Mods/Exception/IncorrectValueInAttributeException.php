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

namespace Slub\Mods\Exception;

use Exception;
use Throwable;

class IncorrectValueInAttributeException extends Exception {

    /**
     * Constructor for the custom exception.
     *
     * @param string $attribute name of the attribute
     * @param string $value not allowed value
     * @param integer $code
     * @param Throwable|null $previous
     *
     * @return void
     */
    public function __construct(string $attribute, string $value, int $code = 0, Throwable $previous = null) {
        $message = 'Value "' . $value . '" is not allowed for attribute "' . $attribute . '".';
        parent::__construct($message, $code, $previous);
    }
}
