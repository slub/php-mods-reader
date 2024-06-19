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

use Slub\Mods\Element\PhysicalDescription;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading PhysicalDescription element
 */
class PhysicalDescriptionReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getPhysicalDescriptionsForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions();
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertPhysicalDescriptionForBookDocument($physicalDescriptions[0]);
    }

    /**
     * @test
     */
    public function getPhysicalDescriptionForBookDocument()
    {
        $physicalDescription = $this->bookReader->getPhysicalDescription(0);
        self::assertPhysicalDescriptionForBookDocument($physicalDescription);
    }

    /**
     * @test
     */
    public function getFirstPhysicalDescriptionForBookDocument()
    {
        $physicalDescription = $this->bookReader->getFirstPhysicalDescription();
        self::assertPhysicalDescriptionForBookDocument($physicalDescription);
    }

    /**
     * @test
     */
    public function getLastPhysicalDescriptionForBookDocument()
    {
        $physicalDescription = $this->bookReader->getLastPhysicalDescription();
        self::assertPhysicalDescriptionForBookDocument($physicalDescription);
    }

    /**
     * @test
     */
    public function getPhysicalDescriptionsByQueryForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="print"]');
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertPhysicalDescriptionForBookDocument($physicalDescriptions[0]);
    }

    /**
     * @test
     */
    public function getNoPhysicalDescriptionsByQueryForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertEmpty($physicalDescriptions);
    }

    /**
     * @test
     */
    public function getNoPhysicalDescriptionByQueryForBookDocument()
    {
        $physicalDescription = $this->bookReader->getPhysicalDescription(0, '[./mods:form[@authority="marcform"]="electronic"]');
        self::assertNull($physicalDescription);
    }

    /**
     * @test
     */
    public function getNoFirstPhysicalDescriptionByQueryForBookDocument()
    {
        $physicalDescription = $this->bookReader->getFirstPhysicalDescription('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertNull($physicalDescription);
    }

    /**
     * @test
     */
    public function getNoLastPhysicalDescriptionByQueryForBookDocument()
    {
        $physicalDescription = $this->bookReader->getLastPhysicalDescription('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertNull($physicalDescription);
    }

    /**
     * @test
     */
    public function getPhysicalDescriptionsForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions();
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertPhysicalDescriptionForSerialDocument($physicalDescriptions[0]);
    }

    /**
     * @test
     */
    public function getPhysicalDescriptionsByQueryForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertPhysicalDescriptionForSerialDocument($physicalDescriptions[0]);
    }

    /**
     * @test
     */
    public function getNoPhysicalDescriptionsByQueryForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="print"]');
        self::assertEmpty($physicalDescriptions);
    }

    private static function assertPhysicalDescriptionForBookDocument(PhysicalDescription $physicalDescription)
    {
        self::assertNotEmpty($physicalDescription->getValue());

        $forms = $physicalDescription->getForms();
        self::assertNotEmpty($forms);
        self::assertEquals('marcform', $forms[0]->getAuthority());
        self::assertEquals('print', $forms[0]->getValue());
        self::assertNotEmpty($physicalDescription->getExtents());
        self::assertEquals('vii, 322 p. ; 23 cm.', $physicalDescription->getExtents()[0]->getValue());
        self::assertNotEmpty($physicalDescription->getReformattingQualities());
        self::assertEquals('replacement', $physicalDescription->getReformattingQualities()[0]);
        self::assertNotEmpty($physicalDescription->getDigitalOrigins());
        self::assertEquals('born digital', $physicalDescription->getDigitalOrigins()[0]);
        self::assertEmpty($physicalDescription->getNotes());
    }

    private static function assertPhysicalDescriptionForSerialDocument(PhysicalDescription $physicalDescription)
    {
        self::assertNotEmpty($physicalDescription->getValue());
        self::assertNotEmpty($physicalDescription->getForms());

        $forms = $physicalDescription->getForms();
        self::assertEquals(2, count($forms));
        self::assertEquals('gmd', $forms[1]->getAuthority());
        self::assertEquals('electronic resource', $forms[1]->getValue());
        self::assertNotEmpty($physicalDescription->getInternetMediaTypes());
        self::assertEquals('text/html', $physicalDescription->getInternetMediaTypes()[0]->getValue());
        self::assertEmpty($physicalDescription->getExtents());
        self::assertEmpty($physicalDescription->getReformattingQualities());
        self::assertEmpty($physicalDescription->getDigitalOrigins());
        self::assertEmpty($physicalDescription->getNotes());
    }
}
