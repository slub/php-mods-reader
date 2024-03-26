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
use Slub\Mods\Element\Specific\OriginInfo\Agent;
use Slub\Mods\Element\Specific\OriginInfo\DateOther;
use Slub\Mods\Element\Specific\OriginInfo\DisplayDate;
use Slub\Mods\Element\Specific\OriginInfo\Edition;
use Slub\Mods\Element\Specific\OriginInfo\Frequency;
use Slub\Mods\Element\Specific\OriginInfo\Issuance;

/**
 * OriginInfo MODS metadata element class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class OriginInfo extends BaseElement
{
    use LanguageAttribute, IdAttribute, AltRepGroupAttribute, DisplayLabelAttribute;

    /**
     * @access private
     * @var array
     */
    private array $places;

    /**
     * @access private
     * @var Agent
     */
    private Agent $agent;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $dateIssued;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $dateCreated;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $dateCaptured;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $dateValid;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $dateModified;

    /**
     * @access private
     * @var DateElement
     */
    private DateElement $copyrightDate;

    /**
     * @access private
     * @var DateOther
     */
    private DateOther $dateOther;

    /**
     * @access private
     * @var DisplayDate
     */
    private DisplayDate $displayDate;

    /**
     * @access private
     * @var Edition
     */
    private Edition $edition;

    /**
     * @access private
     * @var Issuance
     */
    private Issuance $issuance;

    /**
     * @access private
     * @var Frequency
     */
    private Frequency $frequency;

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

        $this->places = [];
        $this->agent = new Agent($xml);
        $this->dateIssued = new DateElement($xml);
        $this->dateCreated = new DateElement($xml);
        $this->dateCaptured = new DateElement($xml);
        $this->dateValid = new DateElement($xml);
        $this->dateModified = new DateElement($xml);
        $this->copyrightDate = new DateElement($xml);
        $this->dateOther = new DateOther($xml);
        $this->displayDate = new DisplayDate($xml);
        $this->edition = new Edition($xml);
        $this->issuance = new Issuance($xml);
        $this->frequency = new Frequency($xml);
    }

    /**
     * Get the value of eventType
     *
     * @access public
     *
     * @return string
     */
    public function getEventType(): string
    {
        return $this->getStringAttribute('eventType');
    }

    /**
     * Get the value of eventTypeURI
     *
     * @access public
     *
     * @return string
     */
    public function getEventTypeURI(): string
    {
        return $this->getStringAttribute('eventTypeURI');
    }

    /**
     * Get the value of places
     *
     * @access public
     *
     * @return array
     */
    public function getPlaces(): array
    {
        return $this->places;
    }

    /**
     * Get the value of agent
     *
     * @access public
     *
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * Get the value of dateIssued
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDateIssued(): DateElement
    {
        return $this->dateIssued;
    }

    /**
     * Get the value of dateCreated
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDateCreated(): DateElement
    {
        return $this->dateCreated;
    }

    /**
     * Get the value of dateCaptured
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDateCaptured(): DateElement
    {
        return $this->dateCaptured;
    }

    /**
     * Get the value of dateValid
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDateValid(): DateElement
    {
        return $this->dateValid;
    }

    /**
     * Get the value of dateModified
     *
     * @access public
     *
     * @return DateElement
     */
    public function getDateModified(): DateElement
    {
        return $this->dateModified;
    }

    /**
     * Get the value of copyrightDate
     *
     * @access public
     *
     * @return DateElement
     */
    public function getCopyrightDate(): DateElement
    {
        return $this->copyrightDate;
    }

    /**
     * Get the value of dateOther
     *
     * @access public
     *
     * @return DateOther
     */
    public function getDateOther(): DateOther
    {
        return $this->dateOther;
    }

    /**
     * Get the value of displayDate
     *
     * @access public
     *
     * @return DisplayDate
     */
    public function getDisplayDate(): DisplayDate
    {
        return $this->displayDate;
    }

    /**
     * Get the value of edition
     *
     * @access public
     *
     * @return Edition
     */
    public function getEdition(): Edition
    {
        return $this->edition;
    }

    /**
     * Get the value of issuance
     *
     * @access public
     *
     * @return Issuance
     */
    public function getIssuance(): Issuance
    {
        return $this->issuance;
    }

    /**
     * Get the value of frequency
     *
     * @access public
     *
     * @return Frequency
     */
    public function getFrequency(): Frequency
    {
        return $this->frequency;
    }
}
