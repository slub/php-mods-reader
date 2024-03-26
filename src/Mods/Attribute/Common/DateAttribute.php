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

trait DateAttribute
{

    /**
     * @access private
     * @var array
     */
    private array $allowedEncodings = [
        'w3cdtf',
        'iso8601',
        'marc',
        'edtf',
        'temper'
    ];

    /**
     * @access private
     * @var array
     */
    private array $allowedPoints = [
        'start',
        'end'
    ];

    /**
     * @access private
     * @var array
     */
    private array $allowedQualifiers = [
        'approximate',
        'inferred',
        'questionable'
    ];

    /**
     * Get the value of encoding
     *
     * @access public
     *
     * @return string
     */
    public function getEncoding(): string
    {
        return $this->getStringAttribute('encoding');
    }

    /**
     * Get the value of point
     *
     * @access public
     *
     * @return string
     */
    public function getPoint(): string
    {
        return $this->getStringAttribute('point');
    }

    /**
     * Get the value of keyDate
     *
     * @access public
     *
     * @return bool
     */
    public function isKeyDate(): bool
    {
        return !empty($this->xml->attributes()->keyDate);
    }

    /**
     * Get the value of qualifier
     *
     * @access public
     *
     * @return string
     */
    public function getQualifier(): string
    {
        return $this->getStringAttribute('qualifier');
    }

    /**
     * Get the value of calendar
     *
     * @access public
     *
     * @return string
     */
    public function getCalendar(): string
    {
        return $this->getStringAttribute('calendar');
    }
}
