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

namespace Slub\Mods\Reader;

use Slub\Mods\Element\Part;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Part element
 */
class PartReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getPartsForBookDocument()
    {
        $parts = $this->bookReader->getParts();
        self::assertNotEmpty($parts);
        self::assertEquals(2, count($parts));
        self::assertFirstPartForBookDocument($parts[0]);
    }

    /**
     * @test
     */
    public function getPartForBookDocument()
    {
        $part = $this->bookReader->getPart(1);
        self::assertSecondPartForBookDocument($part);
    }

    /**
     * @test
     */
    public function getFirstPartForBookDocument()
    {
        $part = $this->bookReader->getFirstPart();
        self::assertFirstPartForBookDocument($part);
    }

    /**
     * @test
     */
    public function getLastPartForBookDocument()
    {
        $part = $this->bookReader->getLastPart();
        self::assertSecondPartForBookDocument($part);
    }

    /**
     * @test
     */
    public function getPartsByQueryForBookDocument()
    {
        $parts = $this->bookReader->getParts('[@order="2"]');
        self::assertNotEmpty($parts);
        self::assertEquals(1, count($parts));
        self::assertSecondPartForBookDocument($parts[0]);
    }

    /**
     * @test
     */
    public function getNoPartsByQueryForBookDocument()
    {
        $parts = $this->bookReader->getParts('[@order="3"]');
        self::assertEmpty($parts);
    }

    /**
     * @test
     */
    public function getNoPartByQueryForBookDocument()
    {
        $part = $this->bookReader->getPart(0, '[@order="3"]');
        self::assertNull($part);
    }

    /**
     * @test
     */
    public function getNoFirstPartByQueryForBookDocument()
    {
        $part = $this->bookReader->getFirstPart('[@order="3"]');
        self::assertNull($part);
    }

    /**
     * @test
     */
    public function getNoLastPartByQueryForBookDocument()
    {
        $part = $this->bookReader->getLastPart('[@order="3"]');
        self::assertNull($part);
    }

    /**
     * @test
     */
    public function getNoPartsForSerialDocument()
    {
        $parts = $this->serialReader->getParts();
        self::assertEmpty($parts);
    }

    private static function assertFirstPartForBookDocument(Part $part)
    {
        self::assertNotEmpty($part->getValue());
        self::assertNotEmpty($part->getType());
        self::assertEquals('poem', $part->getType());
        self::assertNotEmpty($part->getOrder());
        self::assertEquals(1, $part->getOrder());

        $details = $part->getDetails();
        self::assertNotEmpty($details);

        $titles = $details[0]->getTitles();
        self::assertNotEmpty($titles);
        self::assertEquals('Wayfarers', $titles[0]->getValue());

        $extents = $part->getExtents();
        self::assertNotEmpty($extents);
        self::assertEquals('pages', $extents[0]->getUnit());
        self::assertEquals('97', $extents[0]->getStart()->getValue());
        self::assertEquals('98', $extents[0]->getEnd()->getValue());

        $dates = $part->getDates();
        self::assertNotEmpty($dates);
        self::assertEquals('marc', $dates[0]->getEncoding());
        self::assertEquals('1989', $dates[0]->getValue());

        $texts = $part->getTexts();
        self::assertNotEmpty($texts);
        self::assertEquals('Some random text', $texts[0]->getValue());
    }

    private static function assertSecondPartForBookDocument(Part $part)
    {
        self::assertNotEmpty($part->getValue());
        self::assertNotEmpty($part->getType());
        self::assertEquals('poem', $part->getType());
        self::assertNotEmpty($part->getOrder());
        self::assertEquals(2, $part->getOrder());

        $details = $part->getDetails();
        self::assertNotEmpty($details);
        self::assertEquals(2, count($details));
        self::assertEquals('begin', $details[0]->getType());
        self::assertEquals(1, $details[0]->getLevel());
        self::assertNotEmpty($details[0]->getTitles());
        self::assertEquals('Vagabonds', $details[0]->getTitles()[0]->getValue());

        $extents = $part->getExtents();
        self::assertNotEmpty($extents);
        self::assertEquals('pages', $extents[0]->getUnit());
        self::assertEquals('99', $extents[0]->getStart()->getValue());
        self::assertEquals('100', $extents[0]->getEnd()->getValue());
        self::assertEquals(2, $extents[0]->getTotal());
    }
}
