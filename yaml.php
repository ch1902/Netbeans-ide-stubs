<?php

// php_yaml PECL

/**
 * Generate a YAML representation of the provided data in the filename.
 *
 * @link http://php.net/manual/en/function.yaml-emit-file.php
 * @param string $filename <p>
 * Path to the file.
 * </p>
 * @param mixed $data <p>
 * The data being encoded. Can be any type except a resource.
 * </p>
 * @param int $encoding <p>
 * Output character encoding chosen from YAML_ANY_ENCODING, YAML_UTF8_ENCODING, YAML_UTF16LE_ENCODING, YAML_UTF16BE_ENCODING.
 * </p>
 * @param int $linebreak <p>
 * Output linebreak style chosen from YAML_ANY_BREAK, YAML_CR_BREAK, YAML_LN_BREAK, YAML_CRLN_BREAK.
 * </p>
 * @param array $callbacks <p>
 * Content handlers for emitting YAML nodes. Associative array of classname => callable mappings. See emit callbacks for more details.
 * </p>
 * @return Returns TRUE on success. 
 */
function yaml_emit_file ($filename, $data, $encoding = YAML_ANY_ENCODING, $linebreak = YAML_ANY_BREAK, $callbacks = array()) { }

/**
 * Generate a YAML representation of the provided data.
 *
 * @link http://php.net/manual/en/function.yaml-emit.php
 * @param mixed $data <p>
 * The data being encoded. Can be any type except a resource.
 * </p>
 * @param int $encoding <p>
 * Output character encoding chosen from YAML_ANY_ENCODING, YAML_UTF8_ENCODING, YAML_UTF16LE_ENCODING, YAML_UTF16BE_ENCODING. 
 * </p>
 * @param int $linebreak <p>
 * Output linebreak style chosen from YAML_ANY_BREAK, YAML_CR_BREAK, YAML_LN_BREAK, YAML_CRLN_BREAK.
 * </p>
 * @param array $callbacks <p>
 * Content handlers for emitting YAML nodes. Associative array of classname => callable mappings. See emit callbacks for more details.
 * </p>
 * @return  Returns a YAML encoded string on success. 
 */
function yaml_emit ($data, $encoding = YAML_ANY_ENCODING, $linebreak = YAML_ANY_BREAK, $callbacks = array()) { }

/**
 * Convert all or part of a YAML document stream read from a file to a PHP variable.
 *
 * @link http://php.net/manual/en/function.yaml-parse-file.php
 * @param string $filename <p>
 * Path to the file.
 * </p>
 * @param int $pos <p>
 * Document to extract from stream (-1 for all documents, 0 for first document, ...).
 * </p>
 * @param int $ndocs <p>
 * If ndocs is provided, then it is filled with the number of documents found in stream.
 * </p>
 * @param array $callbacks <p>
 * Content handlers for YAML nodes. Associative array of YAML tag => callable mappings. See parse callbacks for more details.
 * </p>
 * @return  Returns the value encoded in input in appropriate PHP type or FALSE on failure. If pos is -1 an array will be returned with one entry for each document found in the stream. 
 */
function yaml_parse_file ($filename, $pos = 0, &$ndocs = null, $callbacks = array()) { }

/**
 * Convert all or part of a YAML document stream read from a URL to a PHP variable.
 *
 * @link http://php.net/manual/en/function.yaml-parse-url.php
 * @param string $url <p>
 * url should be of the form "scheme://...". PHP will search for a protocol handler (also known as a wrapper) for that scheme. If no wrappers for that protocol are registered, PHP will emit a notice to help you track potential problems in your script and then continue as though filename specifies a regular file.
 * </p>
 * @param int $pos <p>
 * Document to extract from stream (-1 for all documents, 0 for first document, ...).
 * </p>
 * @param int $ndocs <p>
 * If ndocs is provided, then it is filled with the number of documents found in stream.
 * </p>
 * @param array $callbacks <p>
 * Content handlers for YAML nodes. Associative array of YAML tag => callable mappings. See parse callbacks for more
 * </p>
 * @return Returns the value encoded in input in appropriate PHP type or FALSE on failure. If pos is -1 an array will be returned with one entry for each document found in the stream.
 */
function yaml_parse_url ($url, $pos = 0, &$ndocs = null, $callbacks = array()) { }

/**
 * Convert all or part of a YAML document stream to a PHP variable. 
 *
 * @link http://php.net/manual/en/function.yaml-parse.php
 * @param string $input <p>
 * The string to parse as a YAML document stream.
 * </p>
 * @param int $pos <p>
 * Document to extract from stream (-1 for all documents, 0 for first document, ...).
 * </p>
 * @param int $ndocs <p>
 * If ndocs is provided, then it is filled with the number of documents found in stream.
 * </p>
 * @param array $callbacks <p>
 * Content handlers for YAML nodes. Associative array of YAML tag => callable mappings. See parse callbacks for more details.
 * </p>
 * @return  Returns the value encoded in input in appropriate PHP type or FALSE on failure. If pos is -1 an array will be returned with one entry for each document found in the stream. 
 */
function yaml_parse ($input, $pos = 0, &$ndocs = null, $callbacks = array()) { }

/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_ANY_SCALAR_STYLE', 0);
/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_PLAIN_SCALAR_STYLE', 1);
/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_SINGLE_QUOTED_SCALAR_STYLE', 2);
/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_DOUBLE_QUOTED_SCALAR_STYLE', 3);
/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_LITERAL_SCALAR_STYLE', 4);
/**
 * Scalar entity style usable by yaml_parse() 
 */
define('YAML_FOLDED_SCALAR_STYLE', 5);
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_NULL_TAG', "tag:yaml.org,2002:null");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_BOOL_TAG', "tag:yaml.org,2002:bool");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_STR_TAG', "tag:yaml.org,2002:str");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_INT_TAG', "tag:yaml.org,2002:int");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_FLOAT_TAG', "tag:yaml.org,2002:float");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_TIMESTAMP_TAG', "tag:yaml.org,2002:timestamp");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_SEQ_TAG', "tag:yaml.org,2002:seq");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_MAP_TAG', "tag:yaml.org,2002:map");
/**
 * Tags usable by yaml_parse() callback methods
 */
define('YAML_PHP_TAG', "!php/object");
/**
 * Let the emitter choose an encoding. 
 */
define('YAML_ANY_ENCODING', 0);
/**
 * Encode as UTF8. 
 */
define('YAML_UTF8_ENCODING', 1);
/**
 * Encode as UTF16LE. 
 */
define('YAML_UTF16LE_ENCODING', 2);
/**
 * Encode as UTF16BE. 
 */
define('YAML_UTF16BE_ENCODING', 3);
/**
 * Let emitter choose linebreak character. 
 */
define('YAML_ANY_BREAK', 0);
/**
 * Use \r as break character (Mac style). 
 */
define('YAML_CR_BREAK', 1);
/**
 * Use \n as break character (Unix style). 
 */
define('YAML_LN_BREAK', 2);
/**
 * Use \r\n as break character (DOS style). 
 */
define('YAML_CRLN_BREAK', 3);


// end php_lua PECL

?>
