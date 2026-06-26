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
        return $this->getElements($xpath, AuthorityLanguageElement::class);
    }

    /**
     * Get the array of the matching elements.
     *
     * @access protected
     *
     * @param string $xpath The XPath for metadata search
     *
     * @return DateElement[]
     */
    protected function getDateElements(string $xpath): array
    {
        return $this->getElements($xpath, DateElement::class);
    }

    /**
     * Get the matching element or null if there is no match.
     *
     * @access protected
     *
     * @param string $xpath The XPath query for metadata search
     *
     * @return ?LanguageElement
     */
    protected function getLanguageElement(string $xpath): ?LanguageElement
    {
        return $this->getElement($xpath, LanguageElement::class);
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
        return $this->getElements($xpath, LanguageElement::class);
    }

    /**
     * Generic helper to map XML Element values to element objects.
     *
     * @access protected
     *
     * @param string $xpath The XPath query for metadata search
     * @param string $class The fully-qualified class name of the element wrapper
     *
     * @return array
     */
    protected function getElements(string $xpath, string $class): array
    {
        $elements = [];
        $element = new Element($this->xml, $xpath);
        foreach ($element->getValues() as $value) {
            $elements[] = new $class($value);
        }
        return $elements;
    }

    /**
     * Get the matching element or null if there is no match.
     *
     * Generic typed helper (phpdoc only).
     *
     * @template T of BaseElement
     * @param string $xpath The XPath query for metadata search
     * @param class-string<T> $class The fully-qualified class name of the element wrapper
     *
     * @return T|null
     */
    protected function getElement(string $xpath, string $class): ?BaseElement
    {
        $element = new Element($this->xml, $xpath);
        if ($element->exists()) {
            return new $class($element->getFirstValue());
        }
        return null;
    }
}
