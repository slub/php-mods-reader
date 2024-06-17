# MODS Metadata Reader for PHP

The library is designed to facilitate the parsing and interpretation of Metadata Object Description Schema ([MODS](https://www.loc.gov/standards/mods/)) metadata within PHP applications.

[MODS](https://www.loc.gov/standards/mods/) is a widely used metadata standard for describing digital resources such as electronic texts, images, and multimedia. It provides a flexible framework for describing various aspects of digital resources, including bibliographic information, administrative metadata, and structural metadata.

It provides developers with a set of tools and functions to easily extract, manipulate, and utilize MODS metadata within their PHP applications. It enables users to parse MODS XML documents, extract metadata elements, and querying metadata.

The library requires at least PHP 7.4.

## Usage

* Create new instance of reader and pass the MODS XML as SimpleXMLElement.
* Get needed elements or attributes.

* Example (omitting empty and null checks):

```php
$modsReader = new ModsReader($this->xml);

// get all titleInfo elements
$titleInfos = $modsReader->getTitleInfos();

// get first titleInfo element
$firstTitleInfo = $modsReader->getFirstTitleInfo();

// get first titleInfo element
$lastTitleInfo = $modsReader->getLastTitleInfo();

// get name elements which match to give string query
$authors = $modsReader->getNames('[./mods:role/mods:roleTerm[@type="code" and @authority="marcrelator"]="aut"]');

// get nameIdentifier for first name element if its type attribute is equal to 'orcid'
$identifier = $authors[0]->getNameIdentifier('[@type="orcid"]');

// get string value of element
$value = $identifier->getValue();

// get 'type' attribute of element
$type = $identifier->getType();

// get child elements of element
$places = [];
$originInfos = $this->modsReader->getOriginInfos('[not(./mods:edition="[Electronic ed.]")]');
foreach ($originInfos as $originInfo) {
    foreach ($originInfo->getPlaces() as $place) {
        foreach ($place->getPlaceTerms() as $placeTerm) {
            $places[] = $placeTerm->getValue();
        }
    }
}
```

## TODOs:

* Add missing reading of metadata
* Add alternative functions (use params instead of string queries) for reading of metadata
* Add logging
* Add test coverage
