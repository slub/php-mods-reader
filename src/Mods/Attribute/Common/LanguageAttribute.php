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
     * Get the value of lang
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
     * Get the value of xmlLang
     *
     * @access public
     *
     * @return string
     */
    public function getXmlLang(): string
    {
        return $this->getStringAttribute('xmlLang');
    }

    /**
     * Get the value of script
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
     * Get the value of transliteration
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
