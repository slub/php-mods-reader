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

use Slub\Mods\Exception\IncorrectValueInAttributeException;

trait DateAttribute
{

    /**
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
     * @var array
     */
    private array $allowedPoints = [
        'start',
        'end'
    ];

    /**
     * @var array
     */
    private array $allowedQualifiers = [
        'approximate',
        'inferred',
        'questionable'
    ];

    /**
     * Get the value of the 'encoding' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#encoding
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getEncoding(): string
    {
        $encoding = $this->getStringAttribute('encoding');

        if (empty($encoding) || in_array($encoding, $this->allowedEncodings)) {
            return $encoding;
        }

        throw new IncorrectValueInAttributeException('encoding', $encoding);
    }

    /**
     * Get the value of the 'point' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#point
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getPoint(): string
    {
        $point = $this->getStringAttribute('point');

        if (empty($point) || in_array($point, $this->allowedPoints)) {
            return $point;
        }

        throw new IncorrectValueInAttributeException('point', $point);
    }

    /**
     * Get the value of the 'keyDate' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#keyDate
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
     * Get the value of the 'qualifier' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#qualifier
     *
     * @access public
     *
     * @return string
     *
     * @throws IncorrectValueInAttributeException
     */
    public function getQualifier(): string
    {
        $qualifier = $this->getStringAttribute('qualifier');

        if (empty($qualifier) || in_array($qualifier, $this->allowedQualifiers)) {
            return $qualifier;
        }

        throw new IncorrectValueInAttributeException('qualifier', $qualifier);
    }

    /**
     * Get the value of the 'calendar' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#calendar
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
