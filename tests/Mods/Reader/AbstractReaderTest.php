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

use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Abstract element
 */
class AbstractReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getAbstractForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract();
        self::assertNotNull($abstract);
        self::assertNotEmpty($abstract->getDisplayLabel());
        self::assertEquals('Content description', $abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for document which contains display label.', $abstract->getValue());
        self::assertTrue($abstract->isShareable());
    }

    /**
     * @test
     */
    public function getAbstractByQueryForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract('[@displayLabel="Content description"]');
        self::assertNotNull($abstract);
        self::assertNotEmpty($abstract->getDisplayLabel());
        self::assertEquals('Content description', $abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for document which contains display label.', $abstract->getValue());
        self::assertTrue($abstract->isShareable());
    }

    /**
     * @test
     */
    public function getNoAbstractByQueryForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract('[@displayLabel="Random"]');
        self::assertNull($abstract);
    }

    /**
     * @test
     */
    public function getAbstractForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract();
        self::assertNotNull($abstract);
        self::assertEmpty($abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for non shareable document.', $abstract->getValue());
        self::assertFalse($abstract->isShareable());
    }

    /**
     * @test
     */
    public function getAbstractByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@shareable="no"]');
        self::assertNotNull($abstract);
        self::assertEmpty($abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for non shareable document.', $abstract->getValue());
        self::assertFalse($abstract->isShareable());
    }

    /**
     * @test
     */
    public function getNoAbstractByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@shareable="yes"]');
        self::assertNull($abstract);
    }
}
