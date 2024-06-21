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

use Slub\Mods\Element\Identifier;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Identifier element
 */
class IdentifierReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getIdentifiersForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers();
        self::assertNotEmpty($identifiers);
        self::assertEquals(2, count($identifiers));
        self::assertFirstIdentifierForBookDocument($identifiers[0]);
    }

    /**
     * @test
     */
    public function getIdentifierForBookDocument()
    {
        $identifier = $this->bookReader->getIdentifier(0);
        self::assertFirstIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getFirstIdentifierForBookDocument()
    {
        $identifier = $this->bookReader->getFirstIdentifier();
        self::assertFirstIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getLastIdentifierForBookDocument()
    {
        $identifier = $this->bookReader->getLastIdentifier();
        self::assertSecondIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getIdentifiersByQueryForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers('[@type="lccn"]');
        self::assertNotEmpty($identifiers);
        self::assertEquals(1, count($identifiers));
        self::assertSecondIdentifierForBookDocument($identifiers[0]);
    }

    /**
     * @test
     */
    public function getIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getIdentifier(0, '[@type="lccn"]');
        self::assertSecondIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getFirstIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getFirstIdentifier('[@type="lccn"]');
        self::assertSecondIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getLastIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getLastIdentifier('[@type="lccn"]');
        self::assertSecondIdentifierForBookDocument($identifier);
    }

    /**
     * @test
     */
    public function getNoIdentifiersByQueryForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers('[@type="xyz"]');
        self::assertEmpty($identifiers);
    }

    /**
     * @test
     */
    public function getNoIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getIdentifier(5, '[@type="lccn"]');
        self::assertNull($identifier);
    }

    /**
     * @test
     */
    public function getNoFirstIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getFirstIdentifier('[@type="xyz"]');
        self::assertNull($identifier);
    }

    /**
     * @test
     */
    public function getNoLastIdentifierByQueryForBookDocument()
    {
        $identifier = $this->bookReader->getLastIdentifier('[@type="xyz"]');
        self::assertNull($identifier);
    }

    /**
     * @test
     */
    public function getIdentifiersForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers();
        self::assertNotEmpty($identifiers);
        self::assertEquals(4, count($identifiers));
        self::assertFirstIdentifierForSerialDocument($identifiers[0]);
    }

    /**
     * @test
     */
    public function getIdentifierForSerialDocument()
    {
        $identifier = $this->serialReader->getIdentifier(2);
        self::assertThirdIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getFirstIdentifierForSerialDocument()
    {
        $identifier = $this->serialReader->getFirstIdentifier();
        self::assertFirstIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getLastIdentifierForSerialDocument()
    {
        $identifier = $this->serialReader->getLastIdentifier();
        self::assertFourthIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getIdentifiersByQueryForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers('[@type="issn"]');
        self::assertNotEmpty($identifiers);
        self::assertEquals(2, count($identifiers));
        self::assertSecondIdentifierForSerialDocument($identifiers[1]);
    }

    /**
     * @test
     */
    public function getIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getIdentifier(0, '[@type="issn"]');
        self::assertFirstIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getFirstIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getFirstIdentifier('[@type="lccn"]');
        self::assertThirdIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getLastIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getLastIdentifier('[@type="lccn"]');
        self::assertThirdIdentifierForSerialDocument($identifier);
    }

    /**
     * @test
     */
    public function getNoIdentifiersByQueryForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers('[@type="xyz"]');
        self::assertEmpty($identifiers);
    }

    /**
     * @test
     */
    public function getNoIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getIdentifier(2, '[@type="xyz"]');
        self::assertNull($identifier);
    }

    /**
     * @test
     */
    public function getNoFirstIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getFirstIdentifier('[@type="xyz"]');
        self::assertNull($identifier);
    }

    /**
     * @test
     */
    public function getNoLastIdentifierByQueryForSerialDocument()
    {
        $identifier = $this->serialReader->getLastIdentifier('[@type="xyz"]');
        self::assertNull($identifier);
    }

    private static function assertFirstIdentifierForBookDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('0801486394 (pbk. : acid-free, recycled paper)', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('isbn', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertFalse($identifier->isInvalid());
    }

    private static function assertSecondIdentifierForBookDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('99042030', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('lccn', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertFalse($identifier->isInvalid());
    }

    private static function assertFirstIdentifierForSerialDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('1704-8532', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('issn', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertFalse($identifier->isInvalid());
    }

    private static function assertSecondIdentifierForSerialDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('1525-321X', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('issn', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertTrue($identifier->isInvalid());
    }

    private static function assertThirdIdentifierForSerialDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('cn2002301668', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('lccn', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertFalse($identifier->isInvalid());
    }

    private static function assertFourthIdentifierForSerialDocument(Identifier $identifier)
    {
        self::assertNotEmpty($identifier->getValue());
        self::assertEquals('ocm51090366', $identifier->getValue());
        self::assertNotEmpty($identifier->getType());
        self::assertEquals('oclc', $identifier->getType());
        self::assertEmpty($identifier->getDisplayLabel());
        self::assertEmpty($identifier->getLang());
        self::assertFalse($identifier->isInvalid());
    }
}
