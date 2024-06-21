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

use Slub\Mods\Element\TableOfContents;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading TableOfContents element
 */
class TableOfContentsReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getTablesOfContentsForBookDocument()
    {
        $tablesOfContents = $this->bookReader->getTablesOfContents();
        self::assertNotEmpty($tablesOfContents);
        self::assertEquals(1, count($tablesOfContents));
        self::assertTableOfContentsForBookDocument($tablesOfContents[0]);
    }

    /**
     * @test
     */
    public function getTableOfContentsForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents(0);
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getFirstTableOfContentsForBookDocument()
    {
        $tableOfContents = $this->bookReader->getFirstTableOfContents();
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getLastTableOfContentsForBookDocument()
    {
        $tableOfContents = $this->bookReader->getLastTableOfContents();
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getTablesOfContentsByQueryForBookDocument()
    {
        $tablesOfContents = $this->bookReader->getTablesOfContents('[@displayLabel="Chapters"]');
        self::assertNotEmpty($tablesOfContents);
        self::assertEquals(1, count($tablesOfContents));
        self::assertTableOfContentsForBookDocument($tablesOfContents[0]);
    }

    /**
     * @test
     */
    public function getTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents(0, '[@displayLabel="Chapters"]');
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getFirstTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getFirstTableOfContents('[@displayLabel="Chapters"]');
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getLastTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getLastTableOfContents('[@displayLabel="Chapters"]');
        self::assertTableOfContentsForBookDocument($tableOfContents);
    }

    /**
     * @test
     */
    public function getNoTablesOfContentsByQueryForBookDocument()
    {
        $tablesOfContents = $this->bookReader->getTablesOfContents('[@displayLabel="Pages"]');
        self::assertEmpty($tablesOfContents);
    }

    /**
     * @test
     */
    public function getNoTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents(0, '[@displayLabel="Pages"]');
        self::assertNull($tableOfContents);
    }

    /**
     * @test
     */
    public function getNoFirstTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getFirstTableOfContents('[@displayLabel="Pages"]');
        self::assertNull($tableOfContents);
    }

    /**
     * @test
     */
    public function getNoLastTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getLastTableOfContents('[@displayLabel="Pages"]');
        self::assertNull($tableOfContents);
    }

    /**
     * @test
     */
    public function getNoTablesOfContentsForSerialDocument()
    {
        $tablesOfContents = $this->serialReader->getTablesOfContents();
        self::assertEmpty($tablesOfContents);
    }

    private static function assertTableOfContentsForBookDocument(TableOfContents $tableOfContents)
    {
        self::assertNotEmpty($tableOfContents->getValue());
        self::assertEquals('Bluegrass odyssey -- Hills of Tennessee -- Sassafrass -- Muddy river -- Take your shoes off Moses -- Let Smokey Mountain smoke get in your eyes -- Farewell party -- Faded love', $tableOfContents->getValue());
        self::assertNotEmpty($tableOfContents->getDisplayLabel());
        self::assertEquals('Chapters', $tableOfContents->getDisplayLabel());

        // TODO: implement reading of elements
    }
}
