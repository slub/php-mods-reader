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

use Slub\Mods\Element\OriginInfo;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading OriginInfo element
 */
class OriginInfoReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getOriginInfosForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos();
        self::assertNotEmpty($originInfos);
        self::assertEquals(2, count($originInfos));
        self::assertFirstOriginInfoForBookDocument($originInfos[0]);
    }

    /**
     * @test
     */
    public function getOriginInfoForBookDocument()
    {
        $originInfo = $this->bookReader->getOriginInfo(1);
        self::assertSecondOriginInfoForBookDocument($originInfo);
    }

    /**
     * @test
     */
    public function getFirstOriginInfoForBookDocument()
    {
        $originInfo = $this->bookReader->getFirstOriginInfo();
        self::assertFirstOriginInfoForBookDocument($originInfo);
    }

    /**
     * @test
     */
    public function getLastOriginInfoForBookDocument()
    {
        $originInfo = $this->bookReader->getLastOriginInfo();
        self::assertSecondOriginInfoForBookDocument($originInfo);
    }

    /**
     * @test
     */
    public function getOriginInfosByQueryForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos('[@eventType="redaction"]');
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertSecondOriginInfoForBookDocument($originInfos[0]);
    }

    /**
     * @test
     */
    public function getNoOriginInfosByQueryForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos('[@eventType="xyz"]');
        self::assertEmpty($originInfos);

        $firstOriginInfo = $this->bookReader->getFirstOriginInfo('[@eventType="xyz"]');
        self::assertNull($firstOriginInfo);

        $lastOriginInfo = $this->bookReader->getLastOriginInfo('[@eventType="xyz"]');
        self::assertNull($lastOriginInfo);
    }

    /**
     * @test
     */
    public function getNoOriginInfoByQueryForBookDocument()
    {
        $originInfo = $this->bookReader->getOriginInfo(4, '[@eventType="xyz"]');
        self::assertNull($originInfo);
    }

    /**
     * @test
     */
    public function getNoFirstOriginInfoByQueryForBookDocument()
    {
        $originInfo = $this->bookReader->getFirstOriginInfo('[@eventType="xyz"]');
        self::assertNull($originInfo);
    }

    /**
     * @test
     */
    public function getNoLastOriginInfoByQueryForBookDocument()
    {
        $originInfo = $this->bookReader->getLastOriginInfo('[@eventType="xyz"]');
        self::assertNull($originInfo);
    }

    /**
     * @test
     */
    public function getOriginInfosForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos();
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertOriginInfoForSerialDocument($originInfos[0]);
    }

    /**
     * @test
     */
    public function getOriginInfosByQueryForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos('[@eventType="publication"]');
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertOriginInfoForSerialDocument($originInfos[0]);
    }

    /**
     * @test
     */
    public function getNoOriginInfosByQueryForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos('[@eventType="xyz"]');
        self::assertEmpty($originInfos);
    }

    private static function assertFirstOriginInfoForBookDocument(OriginInfo $originInfo)
    {
        self::assertNotEmpty($originInfo->getValue());
        self::assertNotEmpty($originInfo->getEventType());
        self::assertEquals('publication', $originInfo->getEventType());

        $places = $originInfo->getPlaces();
        self::assertNotEmpty($places);
        self::assertEquals(2, count($places));

        $placeTerms = $places[0]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('marccountry', $placeTerms[0]->getAuthority());
        self::assertEquals('code', $placeTerms[0]->getType());
        self::assertEquals('nyu', $placeTerms[0]->getValue());

        $issuedDates = $originInfo->getIssuedDates();
        self::assertNotEmpty($issuedDates);
        self::assertEquals(2, count($issuedDates));
        self::assertEquals('marc', $issuedDates[0]->getEncoding());
        self::assertEquals('2000', $issuedDates[0]->getValue());

        $issuances = $originInfo->getIssuances();
        self::assertNotEmpty($issuances);
        self::assertEquals('monographic', $issuances[0]->getValue());
    }

    private static function assertSecondOriginInfoForBookDocument(OriginInfo $originInfo)
    {
        self::assertNotEmpty($originInfo->getValue());
        self::assertNotEmpty($originInfo->getEventType());
        self::assertEquals('redaction', $originInfo->getEventType());

        $places = $originInfo->getPlaces();
        self::assertNotEmpty($places);
        self::assertEquals(2, count($places));

        $placeTerms = $places[1]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('text', $placeTerms[0]->getType());
        self::assertEquals('Ithaca, N.Y', $placeTerms[0]->getValue());

        $issuedDates = $originInfo->getIssuedDates();
        self::assertNotEmpty($issuedDates);
        self::assertEquals(2, count($issuedDates));
        self::assertEquals('marc', $issuedDates[0]->getEncoding());
        self::assertEquals('1999', $issuedDates[0]->getValue());

        self::assertEmpty($originInfo->getIssuances());
    }

    private static function assertOriginInfoForSerialDocument(OriginInfo $originInfo)
    {
        self::assertNotEmpty($originInfo->getValue());
        self::assertNotEmpty($originInfo->getEventType());
        self::assertEquals('publication', $originInfo->getEventType());

        $places = $originInfo->getPlaces();
        self::assertNotEmpty($places);
        self::assertEquals(2, count($places));

        $placeTerms = $places[0]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('marccountry', $placeTerms[0]->getAuthority());
        self::assertEquals('code', $placeTerms[0]->getType());
        self::assertEquals('abc', $placeTerms[0]->getValue());

        $issuedDates = $originInfo->getIssuedDates();
        self::assertNotEmpty($issuedDates);
        self::assertEquals(3, count($issuedDates));
        self::assertEquals('marc', $issuedDates[0]->getEncoding());
        self::assertEquals('start', $issuedDates[0]->getPoint());
        self::assertEquals('2002', $issuedDates[0]->getValue());

        $issuances = $originInfo->getIssuances();
        self::assertNotEmpty($issuances);
        self::assertEquals('serial', $issuances[0]->getValue());

        $frequencies = $originInfo->getFrequencies();
        self::assertNotEmpty($frequencies);
        self::assertEquals(2, count($frequencies));
        self::assertEquals('Three times a year', $frequencies[0]->getValue());

        $agents = $originInfo->getAgents();
        self::assertNotEmpty($agents);
        // TODO: extend agent with name
        //self::assertNotEmpty($agents[0]->getNamePart());
    }
}
