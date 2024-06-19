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

use Slub\Mods\Element\TypeOfResource;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading TypeOfResource element
 */
class TypeOfResourceReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getTypeOfResourceForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource();
        self::assertTypeOfResourceForBookDocument($typeOfResource);
    }

    /**
     * @test
     */
    public function getTypeOfResourceByQueryForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource('[@displayLabel="format"]');
        self::assertTypeOfResourceForBookDocument($typeOfResource);
    }

    /**
     * @test
     */
    public function getNoTypeOfResourceByQueryForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource('[@displayLabel="random"]');
        self::assertNull($typeOfResource);
    }

    /**
     * @test
     */
    public function getTypeOfResourceForSerialDocument()
    {
        $typeOfResource = $this->serialReader->getTypeOfResource();
        self::assertNotNull($typeOfResource);
        self::assertEmpty($typeOfResource->getDisplayLabel());
        self::assertNotEmpty($typeOfResource->getValue());
        self::assertEquals('text', $typeOfResource->getValue());
    }

    /**
     * @test
     */
    public function getNoTypeOfResourceByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@displayForm="format"]');
        self::assertNull($abstract);
    }

    private static function assertTypeOfResourceForBookDocument(TypeOfResource $typeOfResource)
    {
        self::assertNotNull($typeOfResource);
        self::assertNotEmpty($typeOfResource->getDisplayLabel());
        self::assertEquals('format', $typeOfResource->getDisplayLabel());
        self::assertNotEmpty($typeOfResource->getValue());
        self::assertEquals('text', $typeOfResource->getValue());
    }
}
