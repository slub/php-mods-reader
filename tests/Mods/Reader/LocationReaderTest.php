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

use Slub\Mods\Element\Location;
use Slub\Mods\Exception\IncorrectValueInAttributeException;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Location element
 */
class LocationReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getLocationsForBookDocument()
    {
        $locations = $this->bookReader->getLocations();
        self::assertNotEmpty($locations);
        self::assertEquals(2, count($locations));
        self::assertFirstLocationForBookDocument($locations[0]);
    }

    /**
     * @test
     */
    public function getLocationForBookDocument()
    {
        $location = $this->bookReader->getLocation(1);
        self::assertSecondLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function getFirstLocationForBookDocument()
    {
        $location = $this->bookReader->getFirstLocation();
        self::assertFirstLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function getLastLocationForBookDocument()
    {
        $location = $this->bookReader->getLastLocation();
        self::assertSecondLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function getLocationsByQueryForBookDocument()
    {
        $locations = $this->bookReader->getLocations('[@displayLabel="links"]');
        self::assertNotEmpty($locations);
        self::assertEquals(1, count($locations));
        self::assertSecondLocationForBookDocument($locations[0]);

        $this->expectException(IncorrectValueInAttributeException::class);
        $locations[0]->getUrls()[3]->getAccess();
    }

    /**
     * @test
     */
    public function getLocationByQueryForBookDocument()
    {
        $location = $this->bookReader->getLocation(0, '[@displayLabel="links"]');
        self::assertSecondLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function testGetFirstLocationByQueryForBookDocument()
    {
        $location = $this->bookReader->getFirstLocation('[@displayLabel="links"]');
        self::assertSecondLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function getLastLocationForByQueryBookDocument()
    {
        $location = $this->bookReader->getLastLocation('[@displayLabel="links"]');
        self::assertSecondLocationForBookDocument($location);
    }

    /**
     * @test
     */
    public function getNoLocationsByQueryForBookDocument()
    {
        $locations = $this->bookReader->getLocations('[@displayLabel="random"]');
        self::assertEmpty($locations);
    }

    /**
     * @test
     */
    public function getNoLocationByQueryForBookDocument()
    {
        $location = $this->bookReader->getLocation(6, '[@displayLabel="links"]');
        self::assertNull($location);
    }

    /**
     * @test
     */
    public function getNoFirstLocationByQueryForBookDocument()
    {
        $location = $this->bookReader->getFirstLocation('[@displayLabel="random"]');
        self::assertNull($location);
    }

    /**
     * @test
     */
    public function getNoLastLocationByQueryForBookDocument()
    {
        $location = $this->bookReader->getLastLocation('[@displayLabel="random"]');
        self::assertNull($location);
    }

    /**
     * @test
     */
    public function getLocationsForSerialDocument()
    {
        $locations = $this->serialReader->getLocations();
        self::assertNotEmpty($locations);
        self::assertEquals(2, count($locations));
        self::assertLocationForSerialDocument($locations[0]);
    }

    /**
     * @test
     */
    public function getLocationsByQueryForSerialDocument()
    {
        $locations = $this->serialReader->getLocations('[./mods:url[@usage="primaryDisplay"]]');
        self::assertNotEmpty($locations);
        self::assertEquals(1, count($locations));
        self::assertLocationForSerialDocument($locations[0]);
    }

    /**
     * @test
     */
    public function getNoLocationsByQueryForSerialDocument()
    {
        $locations = $this->serialReader->getLocations('[@usage="rad"]');
        self::assertEmpty($locations);
    }

    private static function assertFirstLocationForBookDocument(Location $location)
    {
        self::assertNotEmpty($location->getValue());

        $physicalLocations = $location->getPhysicalLocations();
        self::assertNotEmpty($physicalLocations);
        self::assertEquals('marcorg', $physicalLocations[0]->getAuthority());
        self::assertEquals('MnRM', $physicalLocations[0]->getValue());

        $holdingSimple = $location->getHoldingSimple();
        self::assertNotNull($holdingSimple);

        $copyInformation = $holdingSimple->getCopyInformation();
        self::assertNotEmpty($copyInformation);
        self::assertNotEmpty($copyInformation[0]->getSubLocations());
        self::assertEquals('Reading room', $copyInformation[0]->getSubLocations()[0]->getValue());
        self::assertNotEmpty($copyInformation[0]->getShelfLocators());
        self::assertEquals('QH511.A1J68', $copyInformation[0]->getShelfLocators()[0]->getValue());
        self::assertEquals('1', $copyInformation[0]->getEnumerationAndChronologies()[0]->getUnitType());
        self::assertEquals('v.1-v.2 1999-2002', $copyInformation[0]->getEnumerationAndChronologies()[0]->getValue());
    }

    private static function assertSecondLocationForBookDocument(Location $location)
    {
        self::assertNotEmpty($location->getValue());

        $urls = $location->getUrls();
        self::assertNotEmpty($urls);
        self::assertEquals(4, count($urls));
        self::assertEquals('2024-01-27', $urls[0]->getDateLastAccessed());
        self::assertEquals('http://www.slub-dresden.de/some-url', $urls[0]->getValue());
        self::assertEquals('preview', $urls[1]->getAccess());
        self::assertEquals('http://www.slub-dresden.de/some-url/SLO-0000', $urls[1]->getValue());
    }

    private static function assertLocationForSerialDocument(Location $location)
    {
        $urls = $location->getUrls();
        self::assertNotEmpty($urls);
        self::assertEquals('electronic resource', $urls[0]->getDisplayLabel());
        self::assertEquals('primaryDisplay', $urls[0]->getUsage());
        self::assertEquals('http://bibpurl.oclc.org/web/7085', $urls[0]->getValue());
    }
}
