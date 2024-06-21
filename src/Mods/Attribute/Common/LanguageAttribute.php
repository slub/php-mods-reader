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

namespace Slub\Mods\Attribute\Common;

trait LanguageAttribute
{

    /**
     * Get the value of the 'lang' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#lang
     *
     * @access public
     *
     * @return string
     */
    public function getLang(): string
    {
        return $this->getStringAttribute('lang');
    }

    /**
     * Get the value of the 'xml:lang' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#xml:lang
     *
     * @access public
     *
     * @return string
     */
    public function getXmlLang(): string
    {
        return $this->getStringAttribute('xml:lang');
    }

    /**
     * Get the value of the 'script' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#script
     *
     * @access public
     *
     * @return string
     */
    public function getScript(): string
    {
        return $this->getStringAttribute('script');
    }

    /**
     * Get the value of the 'transliteration' attribute.
     * @see https://www.loc.gov/standards/mods/userguide/attributes.html#transliteration
     *
     * @access public
     *
     * @return string
     */
    public function getTransliteration(): string
    {
        return $this->getStringAttribute('transliteration');
    }
}
