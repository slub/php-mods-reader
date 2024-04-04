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

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Attribute\Common\LanguageAttribute;
use Slub\Mods\Attribute\Common\Linking\AltRepGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\IdAttribute;
use Slub\Mods\Attribute\Common\Linking\NameTitleGroupAttribute;
use Slub\Mods\Attribute\Common\Linking\XlinkHrefAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\AltFormatAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\ContentTypeAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\DisplayLabelAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\SuppliedAttribute;
use Slub\Mods\Attribute\Common\Miscellaneous\UsageAttribute;
use Slub\Mods\Attribute\Specific\OtherTypeAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;
use Slub\Mods\Element\Specific\TitleInfo\NonSort;

/**
 * TitleInfo MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class TitleInfo extends BaseElement
{
    use AuthorityAttribute, LanguageAttribute, IdAttribute, XlinkHrefAttribute, AltRepGroupAttribute, NameTitleGroupAttribute, DisplayLabelAttribute, AltFormatAttribute, ContentTypeAttribute, UsageAttribute, SuppliedAttribute, OtherTypeAttribute;

    /**
     * @access private
     * @var array
     */
    private array $allowedTypes = [
        'abbreviated',
        'translated',
        'alternative',
        'uniform'
    ];

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $title;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $subTitle;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $partNumber;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $partName;

    /**
     * @access private
     * @var NonSort
     */
    private NonSort $nonSort;

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

        $this->title = new LanguageElement($xml);
        $this->subTitle = new LanguageElement($xml);
        $this->partNumber = new LanguageElement($xml);
        $this->partName = new LanguageElement($xml);
        $this->nonSort = new NonSort($xml);
    }

    /**
     * Get the value of type
     *
     * @access public
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->getStringAttribute('type');
    }

    /**
     * Get the value of title
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getTitle(): LanguageElement
    {
        return $this->title;
    }

    /**
     * Get the value of subTitle
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getSubTitle(): LanguageElement
    {
        return $this->subTitle;
    }

    /**
     * Get the value of partNumber
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getPartNumber(): LanguageElement
    {
        return $this->partNumber;
    }

    /**
     * Get the value of partName
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getPartName(): LanguageElement
    {
        return $this->partName;
    }

    /**
     * Get the value of nonSort
     *
     * @access public
     *
     * @return NonSort
     */
    public function getNonSort(): NonSort
    {
        return $this->nonSort;
    }
}
