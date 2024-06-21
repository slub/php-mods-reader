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

use Slub\Mods\Element\Note;
use Slub\Mods\ModsReaderTest;

/**
 * Tests for reading Note element
 */
class NoteReaderTest extends ModsReaderTest
{

    /**
     * @test
     */
    public function getNotesForBookDocument()
    {
        $notes = $this->bookReader->getNotes();
        self::assertNotEmpty($notes);
        self::assertEquals(2, count($notes));
        self::assertFirstNoteForBookDocument($notes[0]);
    }

    /**
     * @test
     */
    public function getNoteForBookDocument()
    {
        $note = $this->bookReader->getNote(1);
        self::assertSecondNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getFirstNoteForBookDocument()
    {
        $note = $this->bookReader->getFirstNote();
        self::assertFirstNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getLastNoteForBookDocument()
    {
        $note = $this->bookReader->getLastNote();
        self::assertSecondNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getNotesByQueryForBookDocument()
    {
        $notes = $this->bookReader->getNotes('[@type="bibliography"]');
        self::assertNotEmpty($notes);
        self::assertEquals(1, count($notes));
        self::assertSecondNoteForBookDocument($notes[0]);
    }

    /**
     * @test
     */
    public function getNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getNote(0, '[@type="bibliography"]');
        self::assertSecondNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getFirstNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getFirstNote('[@type="bibliography"]');
        self::assertSecondNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getLastNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getLastNote('[@type="bibliography"]');
        self::assertSecondNoteForBookDocument($note);
    }

    /**
     * @test
     */
    public function getNoNotesByQueryForBookDocument()
    {
        $notes = $this->bookReader->getNotes('[@type="xyz"]');
        self::assertEmpty($notes);
    }

    /**
     * @test
     */
    public function getNoNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getNote(0, '[@type="xyz"]');
        self::assertNull($note);
    }

    /**
     * @test
     */
    public function getNoFirstNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getFirstNote('[@type="xyz"]');
        self::assertNull($note);
    }

    /**
     * @test
     */
    public function getNoLastNoteByQueryForBookDocument()
    {
        $note = $this->bookReader->getLastNote('[@type="xyz"]');
        self::assertNull($note);
    }

    /**
     * @test
     */
    public function getNotesForSerialDocument()
    {
        $notes = $this->serialReader->getNotes();
        self::assertNotEmpty($notes);
        self::assertEquals(6, count($notes));
        self::assertFirstNoteForSerialDocument($notes[0]);
    }

    /**
     * @test
     */
    public function getNoteForSerialDocument()
    {
        $note = $this->serialReader->getNote(5);
        self::assertSixthNoteForSerialDocument($note);
    }

    /**
     * @test
     */
    public function getFirstNoteForSerialDocument()
    {
        $note = $this->serialReader->getFirstNote();
        self::assertFirstNoteForSerialDocument($note);
    }

    /**
     * @test
     */
    public function getLastNoteForSerialDocument()
    {
        $note = $this->serialReader->getLastNote();
        self::assertSixthNoteForSerialDocument($note);
    }

    /**
     * @test
     */
    public function getNotesByQueryForSerialDocument()
    {
        $notes = $this->serialReader->getNotes('[@type="system details"]');
        self::assertNotEmpty($notes);
        self::assertEquals(1, count($notes));
        self::assertFifthNoteForSerialDocument($notes[0]);
    }

    /**
     * @test
     */
    public function getNoNotesByQueryForSerialDocument()
    {
        $notes = $this->serialReader->getNotes('[@type="xyz"]');
        self::assertEmpty($notes);
    }

    private static function assertFirstNoteForBookDocument(Note $note)
    {
        self::assertNotEmpty($note->getValue());
        self::assertEquals('Eric Alterman.', $note->getValue());
        self::assertNotEmpty($note->getType());
        self::assertEquals('statement of responsibility', $note->getType());
    }

    private static function assertSecondNoteForBookDocument(Note $note)
    {
        self::assertNotEmpty($note->getValue());
        self::assertEquals('Includes bibliographical references (p. 291-312) and index.', $note->getValue());
        self::assertNotEmpty($note->getType());
        self::assertEquals('bibliography', $note->getType());
    }

    private static function assertFirstNoteForSerialDocument(Note $note)
    {
        self::assertNotEmpty($note->getValue());
        self::assertEquals('V. 3, no. 1/2 (winter 2002)-', $note->getValue());
        self::assertNotEmpty($note->getType());
        self::assertEquals('date/sequential designation', $note->getType());
    }

    private static function assertFifthNoteForSerialDocument(Note $note)
    {
        self::assertNotEmpty($note->getValue());
        self::assertEquals('Mode of access: World Wide Web.', $note->getValue());
        self::assertNotEmpty($note->getType());
        self::assertEquals('system details', $note->getType());
    }

    private static function assertSixthNoteForSerialDocument(Note $note)
    {
        self::assertNotEmpty($note->getValue());
        self::assertEquals('Electronic serial in HTML format.', $note->getValue());
        self::assertEmpty($note->getType());
    }
}
