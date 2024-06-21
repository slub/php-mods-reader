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
namespace Slub\Mods;

use PHPUnit\Framework\TestCase;
use Slub\Mods\Exception\IncorrectValueInAttributeException;

class ModsReaderTest extends TestCase
{

    /**
     * @access protected
     * @var ModsReader The MODS metadata reader for book document
     **/
    protected $bookReader;

    /**
     * @access protected
     * @var ModsReader The MODS metadata reader for serial document
     **/
    protected $serialReader;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $xmlBook = simplexml_load_file(__DIR__.'/../resources/mods_book.xml');
        $this->bookReader = new ModsReader($xmlBook);

        $xmlSerial = simplexml_load_file(__DIR__.'/../resources/mods_serial.xml');
        $this->serialReader = new ModsReader($xmlSerial);
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
    }
}
