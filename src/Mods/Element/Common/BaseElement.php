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

namespace Slub\Mods\Element\Common;

use Slub\Mods\Attribute\Common\Attribute;
use Slub\Mods\Element\Xml\Element;

/**
 * MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class BaseElement
{
    use Attribute;

    /**
     * @access protected
     * @var \SimpleXMLElement The metadata XML
     */
    protected \SimpleXMLElement $xml;

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
        $this->xml = $xml;
    }

    /**
     * Get the text value of element.
     *
     * @access public
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->xml[0];
    }

    /**
     * Get the array of the matching elements.
     *
     * @access protected
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return AuthorityLanguageElement[]
     */
    protected function getAuthorityLanguageElements(string $xpath): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $elements[] = new AuthorityLanguageElement($value);
            }
        }
        return $elements;
    }

    /**
     * Get the the array of the matching elements.
     *
     * @access protected
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return DateElement[]
     */
    protected function getDateElements(string $xpath): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $elements[] = new DateElement($value);
            }
        }
        return $elements;
    }

    /**
     * Get the matching element or null if there is not match.
     *
     * @access protected
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return ?LanguageElement
     */
    protected function getLanguageElement(string $xpath): ?LanguageElement
    {
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new LanguageElement($element->getValues()[0]);
        }
        return null;
    }

    /**
     * Get the array of the matching elements.
     *
     * @access protected
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return LanguageElement[]
     */
    protected function getLanguageElements(string $xpath): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            foreach ($element->getValues() as $value) {
                $elements[] = new LanguageElement($value);
            }
        }
        return $elements;
    }
}
