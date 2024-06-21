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
 * Tests for reading TitleInfo element
 */
class TitleInfoReaderTest extends ModsReaderTest
{

    public function testGetTitleInfosForBookDocument()
    {
        $titleInfos = $this->bookReader->getTitleInfos();
        self::assertNotEmpty($titleInfos);
        self::assertEquals(2, count($titleInfos));
        self::assertNotEmpty($titleInfos[0]->getValue());
        self::assertEquals('Sound and fury', $titleInfos[0]->getTitle()->getValue());
        self::assertEquals('the making of the punditocracy', $titleInfos[0]->getSubTitle()->getValue());
    }

    public function testGetTitleInfosByQueryForBookDocument()
    {
        $titleInfos = $this->bookReader->getTitleInfos('[@xml:lang="fr"]');
        self::assertNotEmpty($titleInfos);
        self::assertEquals(1, count($titleInfos));
        self::assertNotEmpty($titleInfos[0]->getValue());
        self::assertNotEmpty($titleInfos[0]->getType());
        self::assertEquals('translated', $titleInfos[0]->getType());
        self::assertNotEmpty($titleInfos[0]->getNonSort());
        self::assertEquals('Le', $titleInfos[0]->getNonSort()->getValue());
        self::assertNotEmpty($titleInfos[0]->getTitle());
        self::assertEquals('bruit et la fureur', $titleInfos[0]->getTitle()->getValue());
        self::assertNotEmpty($titleInfos[0]->getSubTitle());
        self::assertEquals('la création de la punditocratie', $titleInfos[0]->getSubTitle()->getValue());
    }

    public function testGetTitleInfosForSerialDocument()
    {
        $titleInfos = $this->serialReader->getTitleInfos();
        self::assertNotEmpty($titleInfos);
        self::assertEquals(3, count($titleInfos));
        self::assertNotEmpty($titleInfos[0]->getValue());
        self::assertNotEmpty($titleInfos[0]->getTitle());
        self::assertEquals('E-JASL', $titleInfos[0]->getTitle()->getValue());
        self::assertNotEmpty($titleInfos[0]->getSubTitle());
        self::assertEquals('the electronic journal of academic and special librarianship', $titleInfos[0]->getSubTitle()->getValue());
    }

    public function testGetTitleInfosByQueryForSerialDocument()
    {
        $titleInfos = $this->serialReader->getTitleInfos('[@type="abbreviated"]');
        self::assertNotEmpty($titleInfos);
        self::assertEquals(1, count($titleInfos));
        self::assertNotEmpty($titleInfos[0]->getValue());
        self::assertEquals('E-JASL', $titleInfos[0]->getTitle()->getValue());
        self::assertNotEmpty($titleInfos[0]->getSubTitle());
        self::assertEquals('(Athabasca)', $titleInfos[0]->getSubTitle()->getValue());
    }

    public function testGetNoTitleInfosByQueryForSerialDocument()
    {
        $titleInfos = $this->serialReader->getTitleInfos('[@type="uniform"]');
        self::assertEmpty($titleInfos);
    }
}
