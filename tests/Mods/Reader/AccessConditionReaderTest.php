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

use Slub\Mods\Element\AccessCondition;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading AccessCondition element
 */
class AccessConditionReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getAccessConditionsForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions();
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertAccessConditionForBookDocument($accessConditions[0]);
    }

    /**
     * @test
     */
    public function getAccessConditionForBookDocument()
    {
        $accessCondition = $this->bookReader->getAccessCondition(0);
        self::assertAccessConditionForBookDocument($accessCondition);
    }

    /**
     * @test
     */
    public function getFirstAccessConditionForBookDocument()
    {
        $accessCondition = $this->bookReader->getFirstAccessCondition();
        self::assertAccessConditionForBookDocument($accessCondition);
    }

    /**
     * @test
     */
    public function getLastAccessConditionForBookDocument()
    {
        $accessCondition = $this->bookReader->getLastAccessCondition();
        self::assertAccessConditionForBookDocument($accessCondition);
    }

    /**
     * @test
     */
    public function getAccessConditionsByQueryForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions('[@type="use and reproduction"]');
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertAccessConditionForBookDocument($accessConditions[0]);
    }

    /**
     * @test
     */
    public function getFirstAccessConditionByQueryForBookDocument()
    {
        $accessCondition = $this->bookReader->getFirstAccessCondition('[@type="use and reproduction"]');
        self::assertAccessConditionForBookDocument($accessCondition);
    }

    /**
     * @test
     */
    public function getLastAccessConditionByQueryForBookDocument()
    {
        $accessCondition = $this->bookReader->getLastAccessCondition('[@type="use and reproduction"]');
        self::assertAccessConditionForBookDocument($accessCondition);
    }

    /**
     * @test
     */
    public function getNoAccessConditionsByQueryForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions('[@type="restriction on access"]');
        self::assertEmpty($accessConditions);
    }

    /**
     * @test
     */
    public function getNoAccessConditionByQueryForBookDocument()
    {
        $accessCondition = $this->bookReader->getAccessCondition(1, '[@type="restriction on access"]');
        self::assertNull($accessCondition);
    }

    /**
     * @test
     */
    public function getNoFirstAccessConditionsByQueryForBookDocument()
    {
        $accessCondition = $this->bookReader->getFirstAccessCondition('[@type="restriction on access"]');
        self::assertNull($accessCondition);
    }

    /**
     * @test
     */
    public function getNoLastAccessConditionsByQueryForBookDocument()
    {
        $accessCondition = $this->bookReader->getLastAccessCondition('[@type="restriction on access"]');
        self::assertNull($accessCondition);
    }

    /**
     * @test
     */
    public function getAccessConditionsForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions();
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertAccessConditionForSerialDocument($accessConditions[0]);
    }

    /**
     * @test
     */
    public function getAccessConditionsByQueryForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions('[@type="restriction on access"]');
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertAccessConditionForSerialDocument($accessConditions[0]);
    }

    /**
     * @test
     */
    public function getNoAccessConditionsByQueryForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions('[@type="use and reproduction"]');
        self::assertEmpty($accessConditions);
    }

    private static function assertAccessConditionForBookDocument(AccessCondition $accessCondition)
    {
        self::assertNotEmpty($accessCondition->getValue());
        self::assertEquals('Use of this public-domain resource is unrestricted.', $accessCondition->getValue());
        self::assertNotEmpty($accessCondition->getType());
        self::assertEquals('use and reproduction', $accessCondition->getType());
        self::assertEmpty($accessCondition->getDisplayLabel());
        self::assertEmpty($accessCondition->getXlinkHref());
    }

    private static function assertAccessConditionForSerialDocument(AccessCondition $accessCondition)
    {
        self::assertNotEmpty($accessCondition->getValue());
        self::assertEquals('Open Access', $accessCondition->getValue());
        self::assertNotEmpty($accessCondition->getType());
        self::assertEquals('restriction on access', $accessCondition->getType());
        self::assertNotEmpty($accessCondition->getDisplayLabel());
        self::assertEquals('Access Status', $accessCondition->getDisplayLabel());
        // TODO: check out xlink
        // self::assertEquals('http://purl.org/eprint/accessRights/OpenAccess', $accessCondition->getXlinkHref());
    }
}
