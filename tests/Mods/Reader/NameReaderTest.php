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

use Slub\Mods\Element\Name;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Name element
 */
class NameReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getNamesForBookDocument()
    {
        $names = $this->bookReader->getNames();
        self::assertNotEmpty($names);
        self::assertEquals(2, count($names));
        self::assertFirstNameForBookDocument($names[0]);
    }

    /**
     * @test
     */
    public function getNameForBookDocument()
    {
        $name = $this->bookReader->getName(1);
        self::assertSecondNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getFirstNameForBookDocument()
    {
        $name = $this->bookReader->getFirstName();
        self::assertFirstNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getLastNameForBookDocument()
    {
        $name = $this->bookReader->getLastName();
        self::assertSecondNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getNamesByQueryForBookDocument()
    {
        $names = $this->bookReader->getNames('[@type="personal" and not(@usage="primary")]');
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertSecondNameForBookDocument($names[0]);
    }

    /**
     * @test
     */
    public function getNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getName(0, '[@type="personal" and not(@usage="primary")]');
        self::assertSecondNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getFirstNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getFirstName('[@type="personal" and not(@usage="primary")]');
        self::assertSecondNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getLastNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getLastName('[@type="personal" and not(@usage="primary")]');
        self::assertSecondNameForBookDocument($name);
    }

    /**
     * @test
     */
    public function getNoNamesByQueryForBookDocument()
    {
        $names = $this->bookReader->getNames('[@type="corporate"]');
        self::assertEmpty($names);
    }

    /**
     * @test
     */
    public function getNoNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getName(3, '[@type="corporate"]');
        self::assertNull($name);
    }

    /**
     * @test
     */
    public function getNoFirstNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getFirstName('[@type="corporate"]');
        self::assertNull($name);
    }

    /**
     * @test
     */
    public function getNoLastNameByQueryForBookDocument()
    {
        $name = $this->bookReader->getLastName('[@type="corporate"]');
        self::assertNull($name);
    }

    /**
     * @test
     */
    public function getNamesForSerialDocument()
    {
        $names = $this->serialReader->getNames();
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertNameForSerialDocument($names[0]);
    }

    /**
     * @test
     */
    public function getNamesByQueryForSerialDocument()
    {
        $names = $this->serialReader->getNames('[@type="corporate"]');
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertNameForSerialDocument($names[0]);
    }

    /**
     * @test
     */
    public function getNoNamesByQueryForSerialDocument()
    {
        $names = $this->serialReader->getNames('[@type="personal"]');
        self::assertEmpty($names);
    }

    private static function assertFirstNameForBookDocument(Name $name)
    {
        self::assertNotEmpty($name->getType());
        self::assertEquals('personal', $name->getType());
        self::assertNotEmpty($name->getUsage());
        self::assertEquals('primary', $name->getUsage());
        self::assertNotEmpty($name->getValue());

        $nameParts = $name->getNameParts();
        self::assertNotEmpty($nameParts);
        self::assertEquals('Alterman, Eric.', $nameParts[0]->getValue());

        $roles = $name->getRoles();
        self::assertNotEmpty($roles);

        $roleTerms = $roles[0]->getRoleTerms();
        self::assertNotEmpty($roleTerms);
        self::assertEquals('text', $roleTerms[0]->getType());
        self::assertEquals('marcrelator', $roleTerms[0]->getAuthority());
        self::assertEquals('creator', $roleTerms[0]->getValue());
    }

    private static function assertSecondNameForBookDocument(Name $name)
    {
        self::assertNotEmpty($name->getType());
        self::assertEquals('personal', $name->getType());
        self::assertEmpty($name->getUsage());
        self::assertNotEmpty($name->getValue());

        $nameParts = $name->getNameParts();
        self::assertNotEmpty($name->getNameParts());
        self::assertEquals(2, count($nameParts));
        self::assertEquals('given', $nameParts[0]->getType());
        self::assertEquals('Aron', $nameParts[0]->getValue());

        $roles = $name->getRoles();
        self::assertNotEmpty($roles);

        $roleTerms = $roles[0]->getRoleTerms();
        self::assertNotEmpty($roleTerms);
        self::assertEquals('text', $roleTerms[0]->getType());
        self::assertEquals('marcrelator', $roleTerms[0]->getAuthority());
        self::assertEquals('author', $roleTerms[0]->getValue());
    }

    private static function assertNameForSerialDocument(Name $name)
    {
        self::assertNotEmpty($name->getValue());

        $nameParts = $name->getNameParts();
        self::assertNotEmpty($name->getNameParts());
        self::assertEquals(1, count($nameParts));
        self::assertEquals('International Consortium for the Advancement of Academic Publication.', $nameParts[0]->getValue());
    }
}
