<?php

// php_dom_varimport PECL

/**
 * Import a an array of PHP variables to a DOMNode as an XML structure
 * @link https://github.com/DmitryKoterov/dom_varimport#readme
 * @param DOMDocument $dom <p>
 * The parent node or document to import the array to
 * </p>
 * @param array $var <p>
 * Array of variables to import
 * </p>
 * @param string $root <p>
 * Name of the root element to create for the imported array
 * </p>
 * @param string|null $item <p>
 * Name of the xml child element to create for each array item
 * </p><p>
 * If null is supplied invalid tag names are skipped
 * </p>
 * @param string|null $key <p>
 * Name of the attribute used for the array key
 * </p>
 * <p>
 * If null is supplied no array key attributes are added
 * </p>
 * @param bool $notice <p>
 * Show error notices when keys can not be converted to a valid XML element
 * </p>
 * @return bool <p>
 *
 * </p>
 */
function dom_varimport ($dom, $var, $root = 'root', $item = 'item', $key = 'key', $notice = false) { }

// end php_dom_varimport PECL

?>