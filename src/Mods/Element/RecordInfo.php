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

namespace Slub\Mods\Element;

use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Element\Common\AuthorityLanguageElement;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\DateElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\RecordInfo\LanguageOfCataloging;
use Slub\Mods\Element\Specific\RecordInfo\RecordIdentifier;
use Slub\Mods\Element\Specific\RecordInfo\RecordInfoNote;

/**
 * RecordInfo MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class RecordInfo extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute, UsageAttribute;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $recordContentSource;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $recordCreationDate;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $recordChangeDate;

    /**
     * @access private
     * @var RecordIdentifier
     */
    private RecordIdentifier $recordIdentifier;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $recordOrigin;

    /**
     * @access private
     * @var RecordInfoNote
     */
    private RecordInfoNote $recordInfoNote;

    /**
     * @access private
     * @var LanguageOfCataloging
     */
    private LanguageOfCataloging $languageOfCataloging;

    /**
     * @access private
     * @var AuthorityLanguageElement
     */
    private AuthorityLanguageElement $descriptionStandard;

    /**
     * This extracts the essential MODS metadata from XML
     *
     * @access public
     *
     * @param \SimpleXMLElement $xml The XML to extract the metadata from
     *
     * @return void
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);
    }
}
