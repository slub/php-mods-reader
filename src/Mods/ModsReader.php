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

use Slub\Mods\Element\Xml\Element;
use Slub\Mods\Reader\AbstractReader;
use Slub\Mods\Reader\AccessConditionReader;
use Slub\Mods\Reader\ClassificationReader;
use Slub\Mods\Reader\ExtensionReader;
use Slub\Mods\Reader\GenreReader;
use Slub\Mods\Reader\IdentifierReader;
use Slub\Mods\Reader\LanguageReader;
use Slub\Mods\Reader\LocationReader;
use Slub\Mods\Reader\NameReader;
use Slub\Mods\Reader\NoteReader;
use Slub\Mods\Reader\OriginInfoReader;
use Slub\Mods\Reader\PartReader;
use Slub\Mods\Reader\PhysicalDescriptionReader;
use Slub\Mods\Reader\RecordInfoReader;
use Slub\Mods\Reader\RelatedItemReader;
use Slub\Mods\Reader\SubjectReader;
use Slub\Mods\Reader\TableOfContentsReader;
use Slub\Mods\Reader\TargetAudienceReader;
use Slub\Mods\Reader\TitleInfoReader;
use Slub\Mods\Reader\TypeOfResourceReader;

/**
 * Metadata MODS reader class for the 'php-mods-reader' library.
 * @see https://www.loc.gov/standards/mods/userguide/generalapp.html
 *
 * @access public
 */
class ModsReader
{

    use AbstractReader, AccessConditionReader, ClassificationReader, ExtensionReader, GenreReader, IdentifierReader, LanguageReader, LocationReader, NameReader, NoteReader, OriginInfoReader, PartReader, PhysicalDescriptionReader, RecordInfoReader, RelatedItemReader, SubjectReader, TableOfContentsReader, TargetAudienceReader, TitleInfoReader, TypeOfResourceReader;

    /**
     * @access protected
     * @var \SimpleXMLElement The metadata XML
     **/
    protected $xml;

    /**
     * This creates the MODS Reader for given XML
     *
     * @access public
     *
     * @param \SimpleXMLElement $xml The XML for reader
     *
     * @return void
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    /**
     * Get array of values for read element.
     *
     * @access private
     *
     * @param string $xpath for metadata search
     *
     * @return array
     */
    private function getValues(string $xpath): array
    {
        $element = new Element($this->xml, $xpath);
        return $element->getValues();
    }
}
