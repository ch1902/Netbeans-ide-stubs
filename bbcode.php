<?php

// php_bbcode PECL

/**
 *  Adds a tag to an existing BBCode_Container tag_set using tag_rules. 
 *
 * @link http://php.net/manual/en/function.bbcode-add-element.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource, returned by bbcode_create().
 * </p>
 * @param string $tag_name <p>
 * The new tag to add to the BBCode_Container tag_set.
 * </p>
 * @param array $tag_rules <p>
 * An associative array containing the parsing rules; see bbcode_create() for the available keys.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function bbcode_add_element ($bbcode_container, $tag_name, $tag_rules) { } 

/**
 * Adds a smiley to the parser
 *
 * @link http://php.net/manual/en/function.bbcode-add-smiley.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource, returned by bbcode_create(). 
 * </p>
 * @param string $smiley <p>
 * The string that will be replaced when found.
 * </p>
 * @param string $replace_by <p>
 * The string that replace smiley when found.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function bbcode_add_smiley ($bbcode_container, $smiley, $replace_by) { } 

/**
 * This function returns a new BBCode Resource used to parse BBCode strings.
 *
 * @link http://php.net/manual/en/function.bbcode-create.php
 * @param array $bbcode_initial_tags <p>
 * An associative array containing the tag names as keys and parameters required to correctly parse BBCode as their value. The following key/value pairs are supported: 
 * </p><ul>
 * <li><em>flags</em> - a flag set based on the <code>BBCODE_FLAGS_*</code> constants</li>
 * <li><em>type</em> - an int indicating the type of tag. Use the <code>BBCODE_TYPE_*</code> constants</li>
 * <li><em>open_tag</em> - the HTML replacement string for the open tag</li>
 * <li><em>close_tag</em> - the HTML replacement string for the close tag</li>
 * <li><em>default_arg</em> - use this value as the default argument if none is provided and tag_type is of type <code>OPTARG</code></li>
 * <li><em>content_handling</em> - Gives the callback used for modification of the content. Object Oriented Notation supported only since 0.10.1 callback prototype is string <code>function (string $content, string $argument)</code></li>
 * <li><em>param_handling</em> - Gives the callback used for modification of the argument. Object Oriented Notation supported only since 0.10.1 callback prototype is string <code>function (string $content, string $argument)</code></li>
 * <li><em>childs</em> - List of accepted children for the tag. The format of the list is a comma separated string. If the list starts with ! it will be the list of rejected children for the tag. </li>
 * <li><em>parent</em> - List of accepted parents for the tag. The format of the list is a comma separated string. </li>
 * </ul>
 * @return resource Returns a BBCode_Container
 */
function bbcode_create ($bbcode_initial_tags = array()) { } 

/**
 *  This function closes the resource opened by bbcode_create(). 
 *
 * @link http://php.net/manual/en/function.bbcode-destroy.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource returned by bbcode_create(). 
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure. 
 */
function bbcode_destroy (resource $bbcode_container) { } 

/**
 *  This function parse the string to_parse following the rules in the bbcode_container created by bbcode_create() 
 *
 * @link http://php.net/manual/en/function.bbcode-parse.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource returned by bbcode_create(). 
 * </p>
 * @param string $to_parse <p>
 * The string we need to parse. 
 * </p>
 * @return string Returns the parsed string, or FALSE on failure.
 */
function bbcode_parse ($bbcode_container, $to_parse ) { } 

/**
 * Attaches another parser to the bbcode_container. This parser is used only when arguments must be parsed. 
 * If this function is not used, the default argument parser is the parser itself.
 *
 * @link http://php.net/manual/en/function.bbcode-set-arg-parser.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource, returned by bbcode_create(). 
 * </p>
 * @param resource $bbcode_arg_parser <p>
 * BBCode_Container resource, returned by bbcode_create(). It will be used only for parsed arguments 
 * </p>
 * @return Returns TRUE on success or FALSE on failure. 
 */
function bbcode_set_arg_parser ($bbcode_container, $bbcode_arg_parser) { } 

/**
 * Set or alter parser options
 *
 * @link http://php.net/manual/en/function.bbcode-set-flags.php
 * @param resource $bbcode_container <p>
 * BBCode_Container resource, returned by bbcode_create(). 
 * </p>
 * @param int $flags <p>
 * The flag set that must be applied to the bbcode_container options 
 * </p>
 * @param int $mode <p>
 * One of the <code>BBCODE_SET_FLAGS_*</code> constant to set, unset a specific flag set or to replace the flag set by flags. 
 * </p>
 * @return Returns TRUE on success or FALSE on failure. 
 */
function bbcode_set_flags ($bbcode_container, $flags, $mode = BBCODE_SET_FLAGS_SET) { } 


/**
 * This BBCode tag does not accept any arguments. 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_TYPE_NOARG', 1);
    
/**
 * This BBCode tag does not have a corresponding close tag. 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_TYPE_SINGLE', 2);
    
/**
 * This BBCode tag need an argument. 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_TYPE_ARG', 3);
    
/**
 * This BBCode tag accept an optional argument. 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_TYPE_OPTARG', 4);
    
/**
 * This BBCode tag is the special tag root (nesting level 0). 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_TYPE_ROOT', 5);
    
/**
 * This BBCode tag require argument sub-parsing (the argument is also parsed by the BBCode extension). 
 * As Of 0.10.2 another parser can be used as argument parser.
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_ARG_PARSING', 1);
     
/**
 * This BBCode Tag does not accept content (it voids it automatically). 
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_CDATA_NOT_ALLOWED', 2);
    
/**
 * This BBCode Tag accepts smileys. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_SMILEYS_ON', 4);
    
/**
 * This BBCode Tag does not accept smileys. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_SMILEYS_OFF', 8);
    
/**
 * This BBCode Tag automatically closes if another tag of the same type is found at the same nesting level. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_ONE_OPEN_PER_LEVEL', 16);
    
/**
 * This BBCode Tag is automatically removed if content is empty it allows to produce lighter HTML
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_REMOVE_IF_EMPTY', 32);
    
/**
 * This BBCode Tag does not allow unclosed children to reopen when automatically closed. 
 * @since 0.10.3
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FLAGS_DENY_REOPEN_CHILD', 64);
    
/**
 * This is a parser option allowing argument quoting with double quotes (") 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_ARG_DOUBLE_QUOTE', 1);
    
/**
 * This is a parser option allowing argument quoting with single quotes (') 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_ARG_SINGLE_QUOTE', 2);
    
/**
 * This is a parser option allowing argument quoting with HTML version of double quotes (&quot;) 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_ARG_HTML_QUOTE', 4);
    
/**
 * This is a parser option allowing argument quotes to be escaped this permit the quote delimiter to be found 
 * in the string escaping character is \ it can escape any quoting character or itself, if found in front of a 
 * non escapable character, it will be dropped. Default behaviour is not to use escaping. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_ARG_QUOTE_ESCAPING', 16);
    
/**
 * This is a parser option changing the way errors are treated. It automatically closes tag in the order they 
 * are opened. And treat tags with only an open tag as if there were a close tag present. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_AUTO_CORRECT', 256);
    
/**
 * This is a parser option changing the way errors are treated. It automatically reopens tag if close tags are not in the good order. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_CORRECT_REOPEN_TAGS', 512);
    
/**
 * This is a parser option disabling the BBCode parsing it can be useful if only the "smiley" replacement must be used. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_DISABLE_TREE_BUILD', 8192);
    
/**
 * This is a parser option setting smileys to ON if no flag is given at tag level. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_DEFAULT_SMILEYS_ON', 1024);
    
/**
 * This is a parser option setting smileys to OFF if no flag is given at tag level. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_DEFAULT_SMILEYS_OFF', 2048);
    
/**
 * This is a parser option disabling completely the smileys parsing. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_FORCE_SMILEYS_OFF', 4096);
    
/**
 * Use a case insensitive Detection for smileys instead of a simple binary search. 
 * @since 0.10.3
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_SMILEYS_CASE_INSENSITIVE', 16384);
    
/**
 * This permits to SET the complete flag set on a parser. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_SET_FLAGS_SET', 0);
    
/**
 * This permits to switch a flag set ON on a parser. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_SET_FLAGS_ADD', 1);
    
/**
 * This permits to switch a flag set OFF on a parser. 
 * @since 0.10.2
 * @link http://php.net/manual/en/bbcode.constants.php
 */ 
define('BBCODE_SET_FLAGS_REMOVE', 2);
    

// end of php_bbcode PECL
?>
