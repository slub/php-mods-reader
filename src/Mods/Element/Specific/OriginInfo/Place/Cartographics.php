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

namespace Slub\Mods\Element\Specific\OriginInfo\Place;

use Slub\Mods\Attribute\Common\AuthorityAttribute;
use Slub\Mods\Element\Common\BaseElement;
use Slub\Mods\Element\Common\LanguageElement;

/**
 * Cartographics MODS metadata element class for the 'php-mods-reader' library.
 *
 * @access public
 */
class Cartographics extends BaseElement
{
    use AuthorityAttribute;

    /**
     * @access private
     * @var array<LanguageElement>
     */
    private array $coordinates;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $projection;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $scale;

    /**
     * @access private
     * @var LanguageElement
     */
    private LanguageElement $cartographicExtension;

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

        $this->projection = new LanguageElement($xml);
        $this->scale = new LanguageElement($xml);
        $this->cartographicExtension = new LanguageElement($xml);
    }

    /**
     * Get the value of coordinates
     *
     * @access public
     *
     * @return array
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * Get the value of projection
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getProjection(): LanguageElement
    {
        return $this->projection;
    }

    /**
     * Get the value of scale
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getScale(): LanguageElement
    {
        return $this->scale;
    }

    /**
     * Get the value of cartographicExtension
     *
     * @access public
     *
     * @return LanguageElement
     */
    public function getCartographicExtension(): LanguageElement
    {
        return $this->cartographicExtension;
    }
}