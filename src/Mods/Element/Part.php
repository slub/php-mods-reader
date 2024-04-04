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
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\DateElement;
use Slub\Mods\Element\Specific\Part\Detail;
use Slub\Mods\Element\Specific\Part\Extent;
use Slub\Mods\Element\Specific\Part\Text;

/**
 * Part MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class Part extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var Detail
     */
    private Detail $detail;

    /**
     * @access private
     * @var Extent
     */
    private Extent $extent;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $date;

    /**
     * @access private
     * @var Text
     */
    private Text $text;

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
     * Get the value of order
     *
     * @access public
     *
     * @return int
     */
    public function getOrder(): int
    {
        $value = $this->xml->attributes()->order;

        if (!empty($value)) {
            return (int) $value;
        }
        return 0;
    }

    /**
     * Get the value of detail
     *
     * @access public
     *
     * @return Detail
     */
    public function getDetail(): Detail
    {
        return $this->detail;
    }

    /**
     * Get the value of extent
     *
     * @access public
     *
     * @return Extent
     */
    public function getExtent(): Extent
    {
        return $this->extent;
    }

    /**
     * Get the value of date
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDate(): DateElement
    {
        return $this->date;
    }

    /**
     * Get the value of text
     *
     * @access public
     *
     * @return Text
     */
    public function getText(): Text
    {
        return $this->text;
    }
}
