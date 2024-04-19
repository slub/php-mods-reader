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
namespace Slub\Mods;

use PHPUnit\Framework\TestCase;
use Slub\Mods\Exception\IncorrectValueInAttributeException;

class ModsReaderTest extends TestCase
{

    /**
     * @access private
     * @var ModsReader The MODS metadata reader for book document
     **/
    private $bookReader;

    /**
     * @access private
     * @var ModsReader The MODS metadata reader for serial document
     **/
    private $serialReader;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $xmlBook = simplexml_load_file(__DIR__.'/../resources/mods_book.xml');
        $this->bookReader = new ModsReader($xmlBook);

        $xmlSerial = simplexml_load_file(__DIR__.'/../resources/mods_serial.xml');
        $this->serialReader = new ModsReader($xmlSerial);
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
    }

    public function testGetAbstractForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract();
        self::assertNotNull($abstract);
        self::assertNotEmpty($abstract->getDisplayLabel());
        self::assertEquals('Content description', $abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for document which contains display label.', $abstract->getValue());
        self::assertTrue($abstract->isShareable());
    }

    public function testGetAbstractByQueryForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract('[@displayLabel="Content description"]');
        self::assertNotNull($abstract);
        self::assertNotEmpty($abstract->getDisplayLabel());
        self::assertEquals('Content description', $abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for document which contains display label.', $abstract->getValue());
        self::assertTrue($abstract->isShareable());
    }

    public function testGetNoAbstractByQueryForBookDocument()
    {
        $abstract = $this->bookReader->getAbstract('[@displayLabel="Random"]');
        self::assertNull($abstract);
    }

    public function testGetAbstractForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract();
        self::assertNotNull($abstract);
        self::assertEmpty($abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for non shareable document.', $abstract->getValue());
        self::assertFalse($abstract->isShareable());
    }

    public function testGetAbstractByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@shareable="no"]');
        self::assertNotNull($abstract);
        self::assertEmpty($abstract->getDisplayLabel());
        self::assertNotEmpty($abstract->getValue());
        self::assertEquals('Test description for non shareable document.', $abstract->getValue());
        self::assertFalse($abstract->isShareable());
    }

    public function testGetNoAbstractByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@shareable="yes"]');
        self::assertNull($abstract);
    }

    public function testGetAccessConditionsForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions();
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertNotEmpty($accessConditions[0]->getValue());
        self::assertEquals('Use of this public-domain resource is unrestricted.', $accessConditions[0]->getValue());
        self::assertNotEmpty($accessConditions[0]->getType());
        self::assertEquals('use and reproduction', $accessConditions[0]->getType());
        self::assertEmpty($accessConditions[0]->getDisplayLabel());
        self::assertEmpty($accessConditions[0]->getXlinkHref());
    }

    public function testGetAccessConditionsByQueryForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions('[@type="use and reproduction"]');
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertNotEmpty($accessConditions[0]->getValue());
        self::assertEquals('Use of this public-domain resource is unrestricted.', $accessConditions[0]->getValue());
        self::assertNotEmpty($accessConditions[0]->getType());
        self::assertEquals('use and reproduction', $accessConditions[0]->getType());
        self::assertEmpty($accessConditions[0]->getDisplayLabel());
        self::assertEmpty($accessConditions[0]->getXlinkHref());
    }

    public function testGetNoAccessConditionsByQueryForBookDocument()
    {
        $accessConditions = $this->bookReader->getAccessConditions('[@type="restriction on access"]');
        self::assertEmpty($accessConditions);
    }

    public function testGetAccessConditionsForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions();
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertNotEmpty($accessConditions[0]->getValue());
        self::assertEquals('Open Access', $accessConditions[0]->getValue());
        self::assertNotEmpty($accessConditions[0]->getType());
        self::assertEquals('restriction on access', $accessConditions[0]->getType());
        self::assertNotEmpty($accessConditions[0]->getDisplayLabel());
        self::assertEquals('Access Status', $accessConditions[0]->getDisplayLabel());
        // TODO: check out xlink
        //self::assertEquals('http://purl.org/eprint/accessRights/OpenAccess', $accessConditions[0]->getXlinkHref());
    }

    public function testGetAccessConditionsByQueryForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions('[@type="restriction on access"]');
        self::assertNotEmpty($accessConditions);
        self::assertEquals(1, count($accessConditions));
        self::assertNotEmpty($accessConditions[0]->getValue());
        self::assertEquals('Open Access', $accessConditions[0]->getValue());
        self::assertNotEmpty($accessConditions[0]->getType());
        self::assertEquals('restriction on access', $accessConditions[0]->getType());
        self::assertNotEmpty($accessConditions[0]->getDisplayLabel());
        self::assertEquals('Access Status', $accessConditions[0]->getDisplayLabel());
        // TODO: check out xlink
        //self::assertEquals('http://purl.org/eprint/accessRights/OpenAccess', $accessConditions[0]->getXlinkHref());
    }

    public function testGetNoAccessConditionsByQueryForSerialDocument()
    {
        $accessConditions = $this->serialReader->getAccessConditions('[@type="use and reproduction"]');
        self::assertEmpty($accessConditions);
    }

    public function testGetClassificationsForBookDocument()
    {
        $classifications = $this->bookReader->getClassifications();
        self::assertNotEmpty($classifications);
        self::assertEquals(2, count($classifications));
        self::assertNotEmpty($classifications[0]->getValue());
        self::assertEquals('PN4888.P6 A48 1999', $classifications[0]->getValue());
        self::assertNotEmpty($classifications[0]->getAuthority());
        self::assertEquals('lcc', $classifications[0]->getAuthority());
        self::assertEmpty($classifications[0]->getId());
        self::assertEmpty($classifications[0]->getUsage());
    }

    public function testGetClassificationsByQueryForBookDocument()
    {
        $classifications = $this->bookReader->getClassifications('[@authority="ddc"]');
        self::assertNotEmpty($classifications);
        self::assertEquals(1, count($classifications));
        self::assertNotEmpty($classifications[0]->getValue());
        self::assertEquals('071/.3', $classifications[0]->getValue());
        self::assertNotEmpty($classifications[0]->getEdition());
        self::assertEquals('21', $classifications[0]->getEdition());
        self::assertEmpty($classifications[0]->getDisplayLabel());
        self::assertEmpty($classifications[0]->getGenerator());
    }

    public function testGetNoClassificationsByQueryForBookDocument()
    {
        $classifications = $this->bookReader->getAccessConditions('[@generator="xyz"]');
        self::assertEmpty($classifications);
    }

    public function testGetClassificationsForSerialDocument()
    {
        $classifications = $this->serialReader->getClassifications();
        self::assertNotEmpty($classifications);
        self::assertEquals(1, count($classifications));
        self::assertNotEmpty($classifications[0]->getValue());
        self::assertEquals('027.7/05', $classifications[0]->getValue());
        self::assertNotEmpty($classifications[0]->getAuthority());
        self::assertEquals('ddc', $classifications[0]->getAuthority());
        self::assertNotEmpty($classifications[0]->getEdition());
        self::assertEquals('21', $classifications[0]->getEdition());
        self::assertEmpty($classifications[0]->getDisplayLabel());
        self::assertEmpty($classifications[0]->getGenerator());
    }

    public function testGetClassificationsByQueryForSerialDocument()
    {
        $classifications = $this->serialReader->getClassifications('[@authority="ddc"]');
        self::assertNotEmpty($classifications);
        self::assertEquals(1, count($classifications));
        self::assertNotEmpty($classifications[0]->getValue());
        self::assertEquals('027.7/05', $classifications[0]->getValue());
        self::assertNotEmpty($classifications[0]->getAuthority());
        self::assertEquals('ddc', $classifications[0]->getAuthority());
        self::assertNotEmpty($classifications[0]->getEdition());
        self::assertEquals('21', $classifications[0]->getEdition());
        self::assertEmpty($classifications[0]->getDisplayLabel());
        self::assertEmpty($classifications[0]->getGenerator());
    }

    public function testGetNoClassificationsByQueryForSerialDocument()
    {
        $classifications = $this->serialReader->getClassifications('[@edition="22"]');
        self::assertEmpty($classifications);
    }

    public function testGetExtensionsForBookDocument()
    {
        $extensions = $this->bookReader->getExtensions();

        $this->assertTrue(true, 'WIP');
    }

    public function testGetExtensionsForSerialDocument()
    {
        $extensions = $this->serialReader->getExtensions();

        $this->assertTrue(true, 'WIP');
    }

    public function testGetGenresForBookDocument()
    {
        $genres = $this->bookReader->getGenres();
        self::assertNotEmpty($genres);
        self::assertEquals(1, count($genres));
        self::assertNotEmpty($genres[0]->getValue());
        self::assertEquals('bibliography', $genres[0]->getValue());
        self::assertNotEmpty($genres[0]->getAuthority());
        self::assertEquals('marcgt', $genres[0]->getAuthority());
        self::assertEmpty($genres[0]->getLang());
        self::assertEmpty($genres[0]->getScript());
    }

    public function testGetGenresByQueryForBookDocument()
    {
        $genres = $this->bookReader->getGenres('[@authority="marcgt"]');
        self::assertNotEmpty($genres);
        self::assertEquals(1, count($genres));
        self::assertNotEmpty($genres[0]->getValue());
        self::assertEquals('bibliography', $genres[0]->getValue());
        self::assertNotEmpty($genres[0]->getAuthority());
        self::assertEquals('marcgt', $genres[0]->getAuthority());
        self::assertEmpty($genres[0]->getLang());
        self::assertEmpty($genres[0]->getScript());
    }

    public function testGetNoGenresByQueryForBookDocument()
    {
        $genres = $this->bookReader->getGenres('[@authority="merc"]');
        self::assertEmpty($genres);
    }

    public function testGetGenresForSerialDocument()
    {
        $genres = $this->serialReader->getGenres();
        self::assertNotEmpty($genres);
        self::assertEquals(2, count($genres));
        self::assertNotEmpty($genres[0]->getValue());
        self::assertEquals('periodical', $genres[0]->getValue());
        self::assertNotEmpty($genres[0]->getUsage());
        self::assertEquals('primary', $genres[0]->getUsage());
        self::assertEmpty($genres[0]->getDisplayLabel());
        self::assertEmpty($genres[0]->getTransliteration());
    }

    public function testGetGenresByQueryForSerialDocument()
    {
        $genres = $this->serialReader->getGenres('[@usage="primary"]');
        self::assertNotEmpty($genres);
        self::assertEquals(1, count($genres));
        self::assertNotEmpty($genres[0]->getValue());
        self::assertEquals('periodical', $genres[0]->getValue());
        self::assertNotEmpty($genres[0]->getUsage());
        self::assertEquals('primary', $genres[0]->getUsage());
        self::assertEmpty($genres[0]->getDisplayLabel());
        self::assertEmpty($genres[0]->getTransliteration());
    }

    public function testGetNoGenresByQueryForSerialDocument()
    {
        $genres = $this->serialReader->getGenres('[@type="xyz"]');
        self::assertEmpty($genres);
    }

    public function testGetIdentifiersForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers();
        self::assertNotEmpty($identifiers);
        self::assertEquals(2, count($identifiers));
        self::assertNotEmpty($identifiers[0]->getValue());
        self::assertEquals('0801486394 (pbk. : acid-free, recycled paper)', $identifiers[0]->getValue());
        self::assertNotEmpty($identifiers[0]->getType());
        self::assertEquals('isbn', $identifiers[0]->getType());
        self::assertEmpty($identifiers[0]->getLang());
        self::assertFalse($identifiers[0]->isInvalid());
    }

    public function testGetIdentifiersByQueryForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers('[@type="lccn"]');
        self::assertNotEmpty($identifiers);
        self::assertEquals(1, count($identifiers));
        self::assertNotEmpty($identifiers[0]->getValue());
        self::assertEquals('99042030', $identifiers[0]->getValue());
        self::assertNotEmpty($identifiers[0]->getType());
        self::assertEquals('lccn', $identifiers[0]->getType());
        self::assertEmpty($identifiers[0]->getLang());
        self::assertFalse($identifiers[0]->isInvalid());
    }

    public function testGetNoIdentifiersByQueryForBookDocument()
    {
        $identifiers = $this->bookReader->getIdentifiers('[@type="xyz"]');
        self::assertEmpty($identifiers);
    }

    public function testGetIdentifiersForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers();
        self::assertNotEmpty($identifiers);
        self::assertEquals(4, count($identifiers));
        self::assertNotEmpty($identifiers[0]->getValue());
        self::assertEquals('1704-8532', $identifiers[0]->getValue());
        self::assertNotEmpty($identifiers[0]->getType());
        self::assertEquals('issn', $identifiers[0]->getType());
        self::assertEmpty($identifiers[0]->getDisplayLabel());
        self::assertFalse($identifiers[0]->isInvalid());
    }

    public function testGetIdentifiersByQueryForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers('[@type="issn"]');
        self::assertNotEmpty($identifiers);
        self::assertEquals(2, count($identifiers));
        self::assertNotEmpty($identifiers[1]->getValue());
        self::assertEquals('1525-321X', $identifiers[1]->getValue());
        self::assertNotEmpty($identifiers[0]->getType());
        self::assertEquals('issn', $identifiers[1]->getType());
        self::assertEmpty($identifiers[1]->getDisplayLabel());
        self::assertTrue($identifiers[1]->isInvalid());
    }

    public function testGetNoIdentifiersByQueryForSerialDocument()
    {
        $identifiers = $this->serialReader->getIdentifiers('[@type="xyz"]');
        self::assertEmpty($identifiers);
    }

    public function testGetLanguagesForBookDocument()
    {
        $languages = $this->bookReader->getLanguages();
        self::assertNotEmpty($languages);
        self::assertEquals(2, count($languages));
        self::assertEmpty($languages[0]->getObjectPart());
        self::assertNotEmpty($languages[0]->getValue());
        self::assertNotEmpty($languages[0]->getLanguageTerms());
        self::assertNotEmpty($languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEquals('code', $languages[0]->getLanguageTerms()[0]->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerms()[0]->getAuthority());
        self::assertEquals('eng', $languages[0]->getLanguageTerms()[0]->getValue());
        self::assertNotEmpty($languages[0]->getScriptTerms());
        self::assertEquals('code', $languages[0]->getScriptTerms()[0]->getType());
        self::assertEquals('iso15924', $languages[0]->getScriptTerms()[0]->getAuthority());
        self::assertEquals('Latn', $languages[0]->getScriptTerms()[0]->getValue());
    }

    public function testGetLanguagesByQueryForBookDocument()
    {
        $languages = $this->bookReader->getLanguages('[@objectPart="summary"]');
        self::assertNotEmpty($languages);
        self::assertEquals(1, count($languages));
        self::assertNotEmpty($languages[0]->getObjectPart());
        self::assertEquals('summary', $languages[0]->getObjectPart());
        self::assertNotEmpty($languages[0]->getValue());
        self::assertNotEmpty($languages[0]->getLanguageTerms());
        self::assertNotEmpty($languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEquals('code', $languages[0]->getLanguageTerms()[0]->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerms()[0]->getAuthority());
        self::assertEquals('spa', $languages[0]->getLanguageTerms()[0]->getValue());
        self::assertNotEmpty($languages[0]->getScriptTerms());
        self::assertEquals('code', $languages[0]->getScriptTerms()[0]->getType());
        self::assertEquals('iso15924', $languages[0]->getScriptTerms()[0]->getAuthority());
        self::assertEquals('Latn', $languages[0]->getScriptTerms()[0]->getValue());
    }

    public function testGetNoLanguagesByQueryForBookDocument()
    {
        $languages = $this->bookReader->getLanguages('[@objectPart="abstract"]');
        self::assertEmpty($languages);
    }

    public function testGetLanguagesForSerialDocument()
    {
        $languages = $this->serialReader->getLanguages();
        self::assertNotEmpty($languages);
        self::assertEquals(1, count($languages));
        self::assertEmpty($languages[0]->getObjectPart());
        self::assertNotEmpty($languages[0]->getValue());
        self::assertNotEmpty($languages[0]->getLanguageTerms());
        self::assertNotEmpty($languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEquals('code', $languages[0]->getLanguageTerms()[0]->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerms()[0]->getAuthority());
        self::assertEquals('eng', $languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEmpty($languages[0]->getScriptTerms());
    }

    public function testGetLanguagesByQueryForSerialDocument()
    {
        $languages = $this->serialReader->getLanguages('[./mods:languageTerm[@type="code"]]');
        self::assertNotEmpty($languages);
        self::assertEquals(1, count($languages));
        self::assertEmpty($languages[0]->getObjectPart());
        self::assertNotEmpty($languages[0]->getValue());
        self::assertNotEmpty($languages[0]->getLanguageTerms());
        self::assertNotEmpty($languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEquals('code', $languages[0]->getLanguageTerms()[0]->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerms()[0]->getAuthority());
        self::assertEquals('eng', $languages[0]->getLanguageTerms()[0]->getValue());
        self::assertEmpty($languages[0]->getScriptTerms());
    }

    public function testGetNoLanguagesByQueryForSerialDocument()
    {
        $languages = $this->serialReader->getLanguages('[@objectPart="summary"]');
        self::assertEmpty($languages);
    }

    public function testGetLocationsForBookDocument()
    {
        $locations = $this->bookReader->getLocations();
        self::assertNotEmpty($locations);
        self::assertEquals(2, count($locations));
        self::assertNotEmpty($locations[0]->getValue());

        $physicalLocations = $locations[0]->getPhysicalLocations();
        self::assertNotEmpty($physicalLocations);
        self::assertEquals('marcorg', $physicalLocations[0]->getAuthority());
        self::assertEquals('MnRM', $physicalLocations[0]->getValue());

        $holdingSimple = $locations[0]->getHoldingSimple();
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

    public function testGetLocationsByQueryForBookDocument()
    {
        $locations = $this->bookReader->getLocations('[@displayLabel="links"]');
        self::assertNotEmpty($locations);
        self::assertEquals(1, count($locations));
        self::assertNotEmpty($locations[0]->getValue());

        $urls = $locations[0]->getUrls();
        self::assertNotEmpty($urls);
        self::assertEquals(4, count($urls));
        self::assertEquals('2024-01-27', $urls[0]->getDateLastAccessed());
        self::assertEquals('http://www.slub-dresden.de/some-url', $urls[0]->getValue());
        self::assertEquals('preview', $urls[1]->getAccess());
        self::assertEquals('http://www.slub-dresden.de/some-url/SLO-0000', $urls[1]->getValue());

        $this->expectException(IncorrectValueInAttributeException::class);
        $urls[3]->getAccess();
    }

    public function testGetNoLocationsByQueryForBookDocument()
    {
        $locations = $this->bookReader->getLocations('[@displayLabel="random"]');
        self::assertEmpty($locations);
    }

    public function testGetLocationsForSerialDocument()
    {
        $locations = $this->serialReader->getLocations();
        self::assertNotEmpty($locations);
        self::assertEquals(2, count($locations));
        self::assertNotEmpty($locations[0]->getUrls());
        self::assertEquals('electronic resource', $locations[0]->getUrls()[0]->getDisplayLabel());
        self::assertEquals('primaryDisplay', $locations[0]->getUrls()[0]->getUsage());
        self::assertEquals('http://bibpurl.oclc.org/web/7085', $locations[0]->getUrls()[0]->getValue());
    }

    public function testGetLocationsByQueryForSerialDocument()
    {
        $locations = $this->serialReader->getLocations('[./mods:url[@usage="primaryDisplay"]]');
        self::assertNotEmpty($locations);
        self::assertEquals(1, count($locations));
        self::assertNotEmpty($locations[0]->getUrls());
        self::assertEquals('electronic resource', $locations[0]->getUrls()[0]->getDisplayLabel());
        self::assertEquals('primaryDisplay', $locations[0]->getUrls()[0]->getUsage());
        self::assertEquals('http://bibpurl.oclc.org/web/7085', $locations[0]->getUrls()[0]->getValue());
    }

    public function testNoGetLocationsByQueryForSerialDocument()
    {
        $locations = $this->serialReader->getLocations('[@usage="rad"]');
        self::assertEmpty($locations);
    }

    public function testGetNamesForBookDocument()
    {
        $names = $this->bookReader->getNames();
        self::assertNotEmpty($names);
        self::assertEquals(2, count($names));
        self::assertNotEmpty($names[0]->getType());
        self::assertEquals('personal', $names[0]->getType());
        self::assertNotEmpty($names[0]->getUsage());
        self::assertEquals('primary', $names[0]->getUsage());
        self::assertNotEmpty($names[0]->getValue());
        self::assertNotEmpty($names[0]->getNameParts());
        self::assertEquals('Alterman, Eric.', $names[0]->getNameParts()[0]->getValue());
        $roles = $names[0]->getRoles();
        self::assertNotEmpty($roles);
        self::assertNotEmpty($roles[0]->getRoleTerms());
        self::assertEquals('text', $roles[0]->getRoleTerms()[0]->getType());
        self::assertEquals('marcrelator', $roles[0]->getRoleTerms()[0]->getAuthority());
        self::assertEquals('creator', $roles[0]->getRoleTerms()[0]->getValue());
    }

    public function testGetNamesByQueryForBookDocument()
    {
        $names = $this->bookReader->getNames('[@type="personal" and not(@usage="primary")]');
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertNotEmpty($names[0]->getType());
        self::assertEquals('personal', $names[0]->getType());
        self::assertEmpty($names[0]->getUsage());
        self::assertNotEmpty($names[0]->getValue());
        self::assertNotEmpty($names[0]->getNameParts());
        self::assertEquals(2, count($names[0]->getNameParts()));
        self::assertEquals('given', $names[0]->getNameParts()[0]->getType());
        self::assertEquals('Aron', $names[0]->getNameParts()[0]->getValue());
        $roles = $names[0]->getRoles();
        self::assertNotEmpty($roles);
        self::assertNotEmpty($roles[0]->getRoleTerms());
        self::assertEquals('text', $roles[0]->getRoleTerms()[0]->getType());
        self::assertEquals('marcrelator', $roles[0]->getRoleTerms()[0]->getAuthority());
        self::assertEquals('author', $roles[0]->getRoleTerms()[0]->getValue());
    }

    public function testGetNoNamesByQueryForBookDocument()
    {
        $names = $this->bookReader->getNames('[@type="corporate"]');
        self::assertEmpty($names);
    }

    public function testGetNamesForSerialDocument()
    {
        $names = $this->serialReader->getNames();
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertNotEmpty($names[0]->getValue());
        self::assertNotEmpty($names[0]->getNameParts());
        self::assertEquals(1, count($names[0]->getNameParts()));
        self::assertEquals('International Consortium for the Advancement of Academic Publication.', $names[0]->getNameParts()[0]->getValue());
    }

    public function testGetNamesByQueryForSerialDocument()
    {
        $names = $this->serialReader->getNames('[@type="corporate"]');
        self::assertNotEmpty($names);
        self::assertEquals(1, count($names));
        self::assertNotEmpty($names[0]->getValue());
        self::assertNotEmpty($names[0]->getNameParts());
        self::assertEquals(1, count($names[0]->getNameParts()));
        self::assertEquals('International Consortium for the Advancement of Academic Publication.', $names[0]->getNameParts()[0]->getValue());
    }

    public function testGetNoNamesByQueryForSerialDocument()
    {
        $names = $this->serialReader->getNames('[@type="personal"]');
        self::assertEmpty($names);
    }

    public function testGetNotesForBookDocument()
    {
        $notes = $this->bookReader->getNotes();
        self::assertNotEmpty($notes);
        self::assertEquals(2, count($notes));
        self::assertNotEmpty($notes[0]->getValue());
        self::assertEquals('Eric Alterman.', $notes[0]->getValue());
        self::assertNotEmpty($notes[0]->getType());
        self::assertEquals('statement of responsibility', $notes[0]->getType());
    }

    public function testGetNotesByQueryForBookDocument()
    {
        $notes = $this->bookReader->getNotes('[@type="bibliography"]');
        self::assertNotEmpty($notes);
        self::assertEquals(1, count($notes));
        self::assertNotEmpty($notes[0]->getValue());
        self::assertEquals('Includes bibliographical references (p. 291-312) and index.', $notes[0]->getValue());
        self::assertNotEmpty($notes[0]->getType());
        self::assertEquals('bibliography', $notes[0]->getType());
    }

    public function testGetNoNotesByQueryForBookDocument()
    {
        $notes = $this->bookReader->getNotes('[@type="xyz"]');
        self::assertEmpty($notes);
    }

    public function testGetNotesForSerialDocument()
    {
        $notes = $this->serialReader->getNotes();
        self::assertNotEmpty($notes);
        self::assertEquals(6, count($notes));
        self::assertNotEmpty($notes[0]->getValue());
        self::assertEquals('V. 3, no. 1/2 (winter 2002)-', $notes[0]->getValue());
        self::assertNotEmpty($notes[0]->getType());
        self::assertEquals('date/sequential designation', $notes[0]->getType());
    }

    public function testGetNotesByQueryForSerialDocument()
    {
        $notes = $this->serialReader->getNotes('[@type="system details"]');
        self::assertNotEmpty($notes);
        self::assertEquals(1, count($notes));
        self::assertNotEmpty($notes[0]->getValue());
        self::assertEquals('Mode of access: World Wide Web.', $notes[0]->getValue());
        self::assertNotEmpty($notes[0]->getType());
        self::assertEquals('system details', $notes[0]->getType());
    }

    public function testGetNoNotesByQueryForSerialDocument()
    {
        $notes = $this->serialReader->getNotes('[@type="xyz"]');
        self::assertEmpty($notes);
    }

    public function testGetOriginInfosForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos();
        self::assertNotEmpty($originInfos);
        self::assertEquals(2, count($originInfos));
        self::assertNotEmpty($originInfos[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getEventType());
        self::assertEquals('publication', $originInfos[0]->getEventType());
        self::assertNotEmpty($originInfos[0]->getPlaces());
        self::assertEquals(2, count($originInfos[0]->getPlaces()));
        $placeTerms = $originInfos[0]->getPlaces()[0]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('marccountry', $placeTerms[0]->getAuthority());
        self::assertEquals('code', $placeTerms[0]->getType());
        self::assertEquals('nyu', $placeTerms[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuedDates());
        self::assertEquals(2, count($originInfos[0]->getIssuedDates()));
        self::assertEquals('marc', $originInfos[0]->getIssuedDates()[0]->getEncoding());
        self::assertEquals('2000', $originInfos[0]->getIssuedDates()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuances());
        self::assertEquals('monographic', $originInfos[0]->getIssuances()[0]->getValue());
    }

    public function testGetOriginInfosByQueryForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos('[@eventType="redaction"]');
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertNotEmpty($originInfos[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getEventType());
        self::assertEquals('redaction', $originInfos[0]->getEventType());
        self::assertNotEmpty($originInfos[0]->getPlaces());
        self::assertEquals(2, count($originInfos[0]->getPlaces()));
        $placeTerms = $originInfos[0]->getPlaces()[1]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('text', $placeTerms[0]->getType());
        self::assertEquals('Ithaca, N.Y', $placeTerms[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuedDates());
        self::assertEquals(2, count($originInfos[0]->getIssuedDates()));
        self::assertEquals('marc', $originInfos[0]->getIssuedDates()[0]->getEncoding());
        self::assertEquals('1999', $originInfos[0]->getIssuedDates()[0]->getValue());
        self::assertEmpty($originInfos[0]->getIssuances());
    }

    public function testGetNoOriginInfosByQueryForBookDocument()
    {
        $originInfos = $this->bookReader->getOriginInfos('[@eventType="xyz"]');
        self::assertEmpty($originInfos);
    }

    public function testGetOriginInfosForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos();
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertNotEmpty($originInfos[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getEventType());
        self::assertEquals('publication', $originInfos[0]->getEventType());
        self::assertNotEmpty($originInfos[0]->getPlaces());
        self::assertEquals(2, count($originInfos[0]->getPlaces()));
        $placeTerms = $originInfos[0]->getPlaces()[0]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('marccountry', $placeTerms[0]->getAuthority());
        self::assertEquals('code', $placeTerms[0]->getType());
        self::assertEquals('abc', $placeTerms[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuedDates());
        self::assertEquals(3, count($originInfos[0]->getIssuedDates()));
        self::assertEquals('marc', $originInfos[0]->getIssuedDates()[0]->getEncoding());
        self::assertEquals('start', $originInfos[0]->getIssuedDates()[0]->getPoint());
        self::assertEquals('2002', $originInfos[0]->getIssuedDates()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuances());
        self::assertEquals('serial', $originInfos[0]->getIssuances()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getFrequencies());
        self::assertEquals(2, count($originInfos[0]->getFrequencies()));
        self::assertEquals('Three times a year', $originInfos[0]->getFrequencies()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getAgents());
        //self::assertNotEmpty($originInfos[0]->getAgents()[0]->getNamePart());
    }

    public function testGetOriginInfosByQueryForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos('[@eventType="publication"]');
        self::assertNotEmpty($originInfos);
        self::assertEquals(1, count($originInfos));
        self::assertNotEmpty($originInfos[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getEventType());
        self::assertEquals('publication', $originInfos[0]->getEventType());
        self::assertNotEmpty($originInfos[0]->getPlaces());
        self::assertEquals(2, count($originInfos[0]->getPlaces()));
        $placeTerms = $originInfos[0]->getPlaces()[0]->getPlaceTerms();
        self::assertNotEmpty($placeTerms);
        self::assertEquals('marccountry', $placeTerms[0]->getAuthority());
        self::assertEquals('code', $placeTerms[0]->getType());
        self::assertEquals('abc', $placeTerms[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuedDates());
        self::assertEquals(3, count($originInfos[0]->getIssuedDates()));
        self::assertEquals('marc', $originInfos[0]->getIssuedDates()[0]->getEncoding());
        self::assertEquals('start', $originInfos[0]->getIssuedDates()[0]->getPoint());
        self::assertEquals('2002', $originInfos[0]->getIssuedDates()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getIssuances());
        self::assertEquals('serial', $originInfos[0]->getIssuances()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getFrequencies());
        self::assertEquals(2, count($originInfos[0]->getFrequencies()));
        self::assertEquals('Three times a year', $originInfos[0]->getFrequencies()[0]->getValue());
        self::assertNotEmpty($originInfos[0]->getAgents());
        //self::assertNotEmpty($originInfos[0]->getAgents()[0]->getNamePart());
    }

    public function testGetNoOriginInfosByQueryForSerialDocument()
    {
        $originInfos = $this->serialReader->getOriginInfos('[@eventType="xyz"]');
        self::assertEmpty($originInfos);
    }

    public function testGetPartsForBookDocument()
    {
        $parts = $this->bookReader->getParts();
        self::assertNotEmpty($parts);
        self::assertEquals(2, count($parts));
        self::assertNotEmpty($parts[0]->getValue());
        self::assertNotEmpty($parts[0]->getType());
        self::assertEquals('poem', $parts[0]->getType());
        self::assertNotEmpty($parts[0]->getOrder());
        self::assertEquals(1, $parts[0]->getOrder());
        self::assertNotEmpty($parts[0]->getDetails());
        self::assertNotEmpty($parts[0]->getDetails()[0]->getTitles());
        self::assertEquals('Wayfarers', $parts[0]->getDetails()[0]->getTitles()[0]->getValue());
        self::assertNotEmpty($parts[0]->getExtents());
        self::assertEquals('pages', $parts[0]->getExtents()[0]->getUnit());
        self::assertEquals('97', $parts[0]->getExtents()[0]->getStart()->getValue());
        self::assertEquals('98', $parts[0]->getExtents()[0]->getEnd()->getValue());
        self::assertNotEmpty($parts[0]->getDates());
        self::assertEquals('marc', $parts[0]->getDates()[0]->getEncoding());
        self::assertEquals('1989', $parts[0]->getDates()[0]->getValue());
        self::assertNotEmpty($parts[0]->getTexts());
        self::assertEquals('Some random text', $parts[0]->getTexts()[0]->getValue());
    }

    public function testGetPartsByQueryForBookDocument()
    {
        $parts = $this->bookReader->getParts('[@order="2"]');
        self::assertNotEmpty($parts);
        self::assertEquals(1, count($parts));
        self::assertNotEmpty($parts[0]->getValue());
        self::assertNotEmpty($parts[0]->getType());
        self::assertEquals('poem', $parts[0]->getType());
        self::assertNotEmpty($parts[0]->getOrder());
        self::assertEquals(2, $parts[0]->getOrder());
        $details = $parts[0]->getDetails();
        self::assertNotEmpty($details);
        self::assertEquals(2, count($details));
        self::assertEquals('begin', $details[0]->getType());
        self::assertEquals(1, $details[0]->getLevel());
        self::assertNotEmpty($details[0]->getTitles());
        self::assertEquals('Vagabonds', $details[0]->getTitles()[0]->getValue());
        self::assertNotEmpty($parts[0]->getExtents());
        self::assertEquals('pages', $parts[0]->getExtents()[0]->getUnit());
        self::assertEquals('99', $parts[0]->getExtents()[0]->getStart()->getValue());
        self::assertEquals('100', $parts[0]->getExtents()[0]->getEnd()->getValue());
        self::assertEquals(2, $parts[0]->getExtents()[0]->getTotal());
    }

    public function testGetNoPartsByQueryForBookDocument()
    {
        $parts = $this->bookReader->getParts('[@order="3"]');
        self::assertEmpty($parts);
    }

    public function testGetNoPartsForSerialDocument()
    {
        $parts = $this->serialReader->getParts();
        self::assertEmpty($parts);
    }

    public function testGetPhysicalDescriptionsForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions();
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertNotEmpty($physicalDescriptions[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getForms());
        self::assertEquals('marcform', $physicalDescriptions[0]->getForms()[0]->getAuthority());
        self::assertEquals('print', $physicalDescriptions[0]->getForms()[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getExtents());
        self::assertEquals('vii, 322 p. ; 23 cm.', $physicalDescriptions[0]->getExtents()[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getReformattingQualities());
        self::assertEquals('replacement', $physicalDescriptions[0]->getReformattingQualities()[0]);
        self::assertNotEmpty($physicalDescriptions[0]->getDigitalOrigins());
        self::assertEquals('born digital', $physicalDescriptions[0]->getDigitalOrigins()[0]);
        self::assertEmpty($physicalDescriptions[0]->getNotes());
    }

    public function testGetPhysicalDescriptionsByQueryForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="print"]');
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertNotEmpty($physicalDescriptions[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getForms());
        self::assertEquals('marcform', $physicalDescriptions[0]->getForms()[0]->getAuthority());
        self::assertEquals('print', $physicalDescriptions[0]->getForms()[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getExtents());
        self::assertEquals('vii, 322 p. ; 23 cm.', $physicalDescriptions[0]->getExtents()[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getReformattingQualities());
        self::assertEquals('replacement', $physicalDescriptions[0]->getReformattingQualities()[0]);
        self::assertNotEmpty($physicalDescriptions[0]->getDigitalOrigins());
        self::assertEquals('born digital', $physicalDescriptions[0]->getDigitalOrigins()[0]);
        self::assertEmpty($physicalDescriptions[0]->getNotes());
    }

    public function testGetNoPhysicalDescriptionsByQueryForBookDocument()
    {
        $physicalDescriptions = $this->bookReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertEmpty($physicalDescriptions);
    }

    public function testGetPhysicalDescriptionsForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions();
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertNotEmpty($physicalDescriptions[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getForms());
        self::assertEquals(2, count($physicalDescriptions[0]->getForms()));
        self::assertEquals('gmd', $physicalDescriptions[0]->getForms()[1]->getAuthority());
        self::assertEquals('electronic resource', $physicalDescriptions[0]->getForms()[1]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getInternetMediaTypes());
        self::assertEquals('text/html', $physicalDescriptions[0]->getInternetMediaTypes()[0]->getValue());
        self::assertEmpty($physicalDescriptions[0]->getExtents());
        self::assertEmpty($physicalDescriptions[0]->getReformattingQualities());
        self::assertEmpty($physicalDescriptions[0]->getDigitalOrigins());
        self::assertEmpty($physicalDescriptions[0]->getNotes());
    }

    public function testGetPhysicalDescriptionsByQueryForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="electronic"]');
        self::assertNotEmpty($physicalDescriptions);
        self::assertEquals(1, count($physicalDescriptions));
        self::assertNotEmpty($physicalDescriptions[0]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getForms());
        self::assertEquals(2, count($physicalDescriptions[0]->getForms()));
        self::assertEquals('gmd', $physicalDescriptions[0]->getForms()[1]->getAuthority());
        self::assertEquals('electronic resource', $physicalDescriptions[0]->getForms()[1]->getValue());
        self::assertNotEmpty($physicalDescriptions[0]->getInternetMediaTypes());
        self::assertEquals('text/html', $physicalDescriptions[0]->getInternetMediaTypes()[0]->getValue());
        self::assertEmpty($physicalDescriptions[0]->getExtents());
        self::assertEmpty($physicalDescriptions[0]->getReformattingQualities());
        self::assertEmpty($physicalDescriptions[0]->getDigitalOrigins());
        self::assertEmpty($physicalDescriptions[0]->getNotes());
    }

    public function testGetNoPhysicalDescriptionsByQueryForSerialDocument()
    {
        $physicalDescriptions = $this->serialReader->getPhysicalDescriptions('[./mods:form[@authority="marcform"]="print"]');
        self::assertEmpty($physicalDescriptions);
    }

    public function testGetRecordInfosForBookDocument()
    {
        $recordInfos = $this->bookReader->getRecordInfos();
        self::assertNotEmpty($recordInfos);
        self::assertEquals(1, count($recordInfos));
        self::assertNotEmpty($recordInfos[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getDescriptionStandards());
        self::assertEquals('aacr', $recordInfos[0]->getDescriptionStandards()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordContentSources());
        self::assertEquals('marcorg', $recordInfos[0]->getRecordContentSources()[0]->getAuthority());
        self::assertEquals('DLC', $recordInfos[0]->getRecordContentSources()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordCreationDates());
        self::assertEquals('marc', $recordInfos[0]->getRecordCreationDates()[0]->getEncoding());
        self::assertEquals('990730', $recordInfos[0]->getRecordCreationDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordChangeDates());
        self::assertEquals('iso8601', $recordInfos[0]->getRecordChangeDates()[0]->getEncoding());
        self::assertEquals('20060801143536.0', $recordInfos[0]->getRecordChangeDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordIdentifiers());
        self::assertEquals('DE-14', $recordInfos[0]->getRecordIdentifiers()[0]->getSource());
        self::assertEquals('11761548', $recordInfos[0]->getRecordIdentifiers()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordOrigins());
        self::assertStringContainsString('Converted from MARCXML to MODS', $recordInfos[0]->getRecordOrigins()[0]->getValue());
    }

    public function testGetRecordInfosByQueryForBookDocument()
    {
        $recordInfos = $this->bookReader->getRecordInfos('[./mods:descriptionStandard="aacr"]');
        self::assertNotEmpty($recordInfos);
        self::assertEquals(1, count($recordInfos));
        self::assertNotEmpty($recordInfos[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getDescriptionStandards());
        self::assertEquals('aacr', $recordInfos[0]->getDescriptionStandards()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordContentSources());
        self::assertEquals('marcorg', $recordInfos[0]->getRecordContentSources()[0]->getAuthority());
        self::assertEquals('DLC', $recordInfos[0]->getRecordContentSources()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordCreationDates());
        self::assertEquals('marc', $recordInfos[0]->getRecordCreationDates()[0]->getEncoding());
        self::assertEquals('990730', $recordInfos[0]->getRecordCreationDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordChangeDates());
        self::assertEquals('iso8601', $recordInfos[0]->getRecordChangeDates()[0]->getEncoding());
        self::assertEquals('20060801143536.0', $recordInfos[0]->getRecordChangeDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordIdentifiers());
        self::assertEquals('DE-14', $recordInfos[0]->getRecordIdentifiers()[0]->getSource());
        self::assertEquals('11761548', $recordInfos[0]->getRecordIdentifiers()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordOrigins());
        self::assertStringContainsString('Converted from MARCXML to MODS', $recordInfos[0]->getRecordOrigins()[0]->getValue());
    }

    public function testGetNoRecordInfosByQueryForBookDocument()
    {
        $recordInfos = $this->bookReader->getRecordInfos('[./mods:descriptionStandard="xyz"]');
        self::assertEmpty($recordInfos);
    }

    public function testGetRecordInfosForSerialDocument()
    {
        $recordInfos = $this->serialReader->getRecordInfos();
        self::assertNotEmpty($recordInfos);
        self::assertEquals(1, count($recordInfos));
        self::assertNotEmpty($recordInfos[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getDescriptionStandards());
        self::assertEquals('aacr', $recordInfos[0]->getDescriptionStandards()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordContentSources());
        self::assertEquals('marcorg', $recordInfos[0]->getRecordContentSources()[0]->getAuthority());
        self::assertEquals('NLC', $recordInfos[0]->getRecordContentSources()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordCreationDates());

        $this->expectException(IncorrectValueInAttributeException::class);
        $recordInfos[0]->getRecordCreationDates()[0]->getEncoding();

        self::assertEquals('021127', $recordInfos[0]->getRecordCreationDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordChangeDates());
        self::assertEquals('iso8601', $recordInfos[0]->getRecordChangeDates()[0]->getEncoding());
        self::assertEquals('20080910160139.0', $recordInfos[0]->getRecordChangeDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordIdentifiers());
        self::assertEquals('15446420', $recordInfos[0]->getRecordIdentifiers()[0]->getValue());
        self::assertStringContainsString('Converted from MARCXML to MODS', $recordInfos[0]->getRecordOrigins()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordInfoNotes());
        self::assertEquals(2, count($recordInfos[0]->getRecordInfoNotes()));
        self::assertEquals('Some info', $recordInfos[0]->getRecordInfoNotes()[1]->getValue());

        $languages = $recordInfos[0]->getLanguageOfCatalogings();
        self::assertNotEmpty($languages);
        self::assertNotNull($languages[0]->getLanguageTerm());
        self::assertEquals('code', $languages[0]->getLanguageTerm()->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerm()->getAuthority());
        self::assertEquals('eng', $languages[0]->getLanguageTerm()->getValue());
        self::assertNotNull($languages[0]->getScriptTerm());
        self::assertEquals('code', $languages[0]->getScriptTerm()->getType());
        self::assertEquals('iso15924', $languages[0]->getScriptTerm()->getAuthority());
        self::assertEquals('Latn', $languages[0]->getScriptTerm()->getValue());
    }

    public function testGetRecordInfosByQueryForSerialDocument()
    {
        $recordInfos = $this->serialReader->getRecordInfos('[./mods:descriptionStandard="aacr"]');
        self::assertNotEmpty($recordInfos);
        self::assertEquals(1, count($recordInfos));
        self::assertNotEmpty($recordInfos[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getDescriptionStandards());
        self::assertEquals('aacr', $recordInfos[0]->getDescriptionStandards()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordContentSources());
        self::assertEquals('marcorg', $recordInfos[0]->getRecordContentSources()[0]->getAuthority());
        self::assertEquals('NLC', $recordInfos[0]->getRecordContentSources()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordCreationDates());

        $this->expectException(IncorrectValueInAttributeException::class);
        $recordInfos[0]->getRecordCreationDates()[0]->getEncoding();

        self::assertEquals('021127', $recordInfos[0]->getRecordCreationDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordChangeDates());
        self::assertEquals('iso8601', $recordInfos[0]->getRecordChangeDates()[0]->getEncoding());
        self::assertEquals('20080910160139.0', $recordInfos[0]->getRecordChangeDates()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordIdentifiers());
        self::assertEquals('15446420', $recordInfos[0]->getRecordIdentifiers()[0]->getValue());
        self::assertStringContainsString('Converted from MARCXML to MODS', $recordInfos[0]->getRecordOrigins()[0]->getValue());
        self::assertNotEmpty($recordInfos[0]->getRecordInfoNotes());
        self::assertEquals(2, count($recordInfos[0]->getRecordInfoNotes()));
        self::assertEquals('Some info', $recordInfos[0]->getRecordInfoNotes()[1]->getValue());

        $languages = $recordInfos[0]->getLanguageOfCatalogings();
        self::assertNotEmpty($languages);
        self::assertNotNull($languages[0]->getLanguageTerm());
        self::assertEquals('code', $languages[0]->getLanguageTerm()->getType());
        self::assertEquals('iso639-2b', $languages[0]->getLanguageTerm()->getAuthority());
        self::assertEquals('eng', $languages[0]->getLanguageTerm()->getValue());
        self::assertNotNull($languages[0]->getScriptTerm());
        self::assertEquals('code', $languages[0]->getScriptTerm()->getType());
        self::assertEquals('iso15924', $languages[0]->getScriptTerm()->getAuthority());
        self::assertEquals('Latn', $languages[0]->getScriptTerm()->getValue());
    }

    public function testGetNoRecordInfosByQueryForSerialDocument()
    {
        $recordInfos = $this->serialReader->getRecordInfos('[./mods:descriptionStandard="xyz"]');
        self::assertEmpty($recordInfos);
    }

    public function testGetNoRelatedItemsForBookDocument()
    {
        $relatedItems = $this->bookReader->getRelatedItems();
        self::assertEmpty($relatedItems);
    }

    public function testGetRelatedItemsForSerialDocument()
    {
        $relatedItems = $this->serialReader->getRelatedItems();
        self::assertNotEmpty($relatedItems);
        self::assertEquals(1, count($relatedItems));
        self::assertNotEmpty($relatedItems[0]->getValue());
        self::assertNotEmpty($relatedItems[0]->getType());
        self::assertEquals('preceding', $relatedItems[0]->getType());

        // TODO: implement reading of elements
    }

    public function testGetRelatedItemsByQueryForSerialDocument()
    {
        $relatedItems = $this->serialReader->getRelatedItems('[./mods:identifier="1525-321X"]');
        self::assertNotEmpty($relatedItems);
        self::assertEquals(1, count($relatedItems));
        self::assertNotEmpty($relatedItems[0]->getValue());
        self::assertNotEmpty($relatedItems[0]->getType());
        self::assertEquals('preceding', $relatedItems[0]->getType());

        // TODO: implement reading of elements
    }

    public function testGetNoRelatedItemsByQueryForSerialDocument()
    {
        $relatedItems = $this->serialReader->getRelatedItems('[./mods:identifier="15-32"]');
        self::assertEmpty($relatedItems);
    }

    public function testGetSubjectsForBookDocument()
    {
        $subjects = $this->bookReader->getSubjects();
        self::assertNotEmpty($subjects);
        self::assertEquals(8, count($subjects));
        self::assertNotEmpty($subjects[0]->getValue());
        $hierarchicalGeographics = $subjects[0]->getHierarchicalGeographics();
        self::assertNotEmpty($hierarchicalGeographics);
        self::assertNotEmpty($hierarchicalGeographics[0]->getCountries());
        self::assertEquals(2, count($hierarchicalGeographics[0]->getCountries()));
        self::assertEquals(1, $hierarchicalGeographics[0]->getCountries()[0]->getLevel());
        self::assertEquals('United Kingdom', $hierarchicalGeographics[0]->getCountries()[0]->getValue());
        self::assertNotEmpty($hierarchicalGeographics[0]->getRegions());
        self::assertEquals('North West', $hierarchicalGeographics[0]->getRegions()[0]->getValue());
        self::assertNotEmpty($hierarchicalGeographics[0]->getCounties());
        self::assertEquals('Cumbria', $hierarchicalGeographics[0]->getCounties()[0]->getValue());
        self::assertNotEmpty($hierarchicalGeographics[0]->getCities());
        self::assertEquals('Providence', $hierarchicalGeographics[0]->getCities()[0]->getValue());
        self::assertNotEmpty($hierarchicalGeographics[0]->getCitySections());
        self::assertEquals(2, count($hierarchicalGeographics[0]->getCitySections()));
        self::assertEquals('neighborhood', $hierarchicalGeographics[0]->getCitySections()[0]->getType());
        self::assertEquals(1, $hierarchicalGeographics[0]->getCitySections()[0]->getLevel());
        self::assertEquals('East Side', $hierarchicalGeographics[0]->getCitySections()[0]->getValue());
        self::assertNotEmpty($hierarchicalGeographics[0]->getAreas());
        self::assertEquals('national park', $hierarchicalGeographics[0]->getAreas()[0]->getType());
        self::assertEquals('Lake District', $hierarchicalGeographics[0]->getAreas()[0]->getValue());
    }

    public function testGetSubjectsByQueryForBookDocument()
    {
        $subjects = $this->bookReader->getSubjects('[./mods:topic="Mass media"]');
        self::assertNotEmpty($subjects);
        self::assertEquals(1, count($subjects));
        self::assertNotEmpty($subjects[0]->getAuthority());
        self::assertEquals('lcsh', $subjects[0]->getAuthority());
        self::assertNotEmpty($subjects[0]->getValue());
        self::assertNotEmpty($subjects[0]->getTopics());
        self::assertEquals(2, count($subjects[0]->getTopics()));
        self::assertEquals('Political aspects', $subjects[0]->getTopics()[1]->getValue());
        self::assertNotEmpty($subjects[0]->getGeographics());
        self::assertEquals(1, count($subjects[0]->getGeographics()));
        self::assertEquals('United States', $subjects[0]->getGeographics()[0]->getValue());
    }

    public function testGetNoSubjectsByQueryForBookDocument()
    {
        $subjects = $this->bookReader->getSubjects('[./mods:topic="Unknown"]');
        self::assertEmpty($subjects);
    }

    public function testGetSubjectsForSerialDocument()
    {
        $subjects = $this->serialReader->getSubjects();
        self::assertNotEmpty($subjects);
        self::assertEquals(7, count($subjects));
        self::assertNotEmpty($subjects[0]->getValue());
        self::assertNotEmpty($subjects[0]->getCartographics());

        // TODO: implement reading of cartographics
        /*self::assertNotEmpty($subjects[0]->getCartographics()[0]->getCoordinates());
        self::assertEquals('', $subjects[0]->getCartographics()[0]->getCoordinates()[0]->getValue());
        self::assertNotEmpty($subjects[0]->getCartographics()[0]->getScale());
        self::assertNotEmpty($subjects[0]->getCartographics()[0]->getProjection());*/
    }

    public function testGetSubjectsByQueryForSerialDocument()
    {
        $subjects = $this->serialReader->getSubjects('[./mods:genre="Directories"]');
        self::assertNotEmpty($subjects);
        self::assertEquals(1, count($subjects));
        self::assertNotEmpty($subjects[0]->getValue());
        self::assertNotEmpty($subjects[0]->getTopics());
        self::assertEquals('Web sites', $subjects[0]->getTopics()[0]->getValue());
        self::assertNotEmpty($subjects[0]->getGenres());
        self::assertEquals('Directories', $subjects[0]->getGenres()[0]->getValue());
    }

    public function testGetNoSubjectsByQueryForSerialDocument()
    {
        $subjects = $this->serialReader->getSubjects('[./mods:topic="Unknown"]');
        self::assertEmpty($subjects);
    }

    public function testGetTableOfContentsForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents();
        self::assertNotEmpty($tableOfContents);
        self::assertEquals(1, count($tableOfContents));
        self::assertNotEmpty($tableOfContents[0]->getValue());
        self::assertEquals('Bluegrass odyssey -- Hills of Tennessee -- Sassafrass -- Muddy river -- Take your shoes off Moses -- Let Smokey Mountain smoke get in your eyes -- Farewell party -- Faded love', $tableOfContents[0]->getValue());
        self::assertNotEmpty($tableOfContents[0]->getDisplayLabel());
        self::assertEquals('Chapters', $tableOfContents[0]->getDisplayLabel());

        // TODO: implement reading of elements
    }

    public function testGetTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents('[@displayLabel="Chapters"]');
        self::assertNotEmpty($tableOfContents);
        self::assertEquals(1, count($tableOfContents));
        self::assertNotEmpty($tableOfContents[0]->getValue());
        self::assertEquals('Bluegrass odyssey -- Hills of Tennessee -- Sassafrass -- Muddy river -- Take your shoes off Moses -- Let Smokey Mountain smoke get in your eyes -- Farewell party -- Faded love', $tableOfContents[0]->getValue());
        self::assertNotEmpty($tableOfContents[0]->getDisplayLabel());
        self::assertEquals('Chapters', $tableOfContents[0]->getDisplayLabel());

        // TODO: implement reading of elements
    }

    public function testGetNoTableOfContentsByQueryForBookDocument()
    {
        $tableOfContents = $this->bookReader->getTableOfContents('[@displayLabel="Pages"]');
        self::assertEmpty($tableOfContents);
    }

    public function testGetNoTableOfContentsForSerialDocument()
    {
        $tableOfContents = $this->serialReader->getTableOfContents();
        self::assertEmpty($tableOfContents);
    }

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

    public function testGetTypeOfResourceForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource();
        self::assertNotNull($typeOfResource);
        self::assertNotEmpty($typeOfResource->getDisplayLabel());
        self::assertEquals('format', $typeOfResource->getDisplayLabel());
        self::assertNotEmpty($typeOfResource->getValue());
        self::assertEquals('text', $typeOfResource->getValue());
    }

    public function testGetTypeOfResourceByQueryForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource('[@displayLabel="format"]');
        self::assertNotNull($typeOfResource);
        self::assertNotEmpty($typeOfResource->getDisplayLabel());
        self::assertEquals('format', $typeOfResource->getDisplayLabel());
        self::assertNotEmpty($typeOfResource->getValue());
        self::assertEquals('text', $typeOfResource->getValue());
    }

    public function testGetNoTypeOfResourceByQueryForBookDocument()
    {
        $typeOfResource = $this->bookReader->getTypeOfResource('[@displayLabel="random"]');
        self::assertNull($typeOfResource);
    }

    public function testGetTypeOfResourceForSerialDocument()
    {
        $typeOfResource = $this->serialReader->getTypeOfResource();
        self::assertNotNull($typeOfResource);
        self::assertEmpty($typeOfResource->getDisplayLabel());
        self::assertNotEmpty($typeOfResource->getValue());
        self::assertEquals('text', $typeOfResource->getValue());
    }

    public function testGetNoTypeOfResourceByQueryForSerialDocument()
    {
        $abstract = $this->serialReader->getAbstract('[@displayForm="format"]');
        self::assertNull($abstract);
    }
}
