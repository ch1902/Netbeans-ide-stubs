<?php

// php_stem PECL

/**
 * Stem a word according to specific language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @param int $lang <p>
 * A language code to use for stemming, a STEM_* constant
 * </p>
 * @return 
 */
function stem ($str, $lang) { }

/**
 * Alias of stem
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @param int $lang <p>
 * A language code to use for stemming, a STEM_* constant
 * </p>
 * @return string
 */
function stem_porter ($str, $lang) { }

/**
 * Determine if a language stemmer is enabled
 * @param int $lang <p>
 * Language constant STEM_*
 * </p>
 * @return bool 
 */
function stem_enabled ($lang) { }

/**
 * Stem a word according to Danish language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_danish ($str) { }

/**
 * Stem a word according to Dutch language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_dutch ($str) { }

/**
 * Stem a word according to English language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_english ($str) { }

/**
 * Stem a word according to Finnish language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_finnish ($str) { }

/**
 * Stem a word according to French language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_french ($str) { }

/**
 * Stem a word according to German language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_german ($str) { }

/**
 * Stem a word according to Hungarian language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_hungarian ($str) { }

/**
 * Stem a word according to Italian language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_italian ($str) { }

/**
 * Stem a word according to Norwegian language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_norwegian ($str) { }

/**
 * Stem a word according to Portuguese language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_portuguese ($str) { }

/**
 * Stem a word according to Romanian language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_romanian ($str) { }

/**
 * Stem a word according to Russian language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_russian ($str) { }

/**
 * Stem a word according to Russian (unicode) language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_russian_unicode ($str) { }

/**
 * Stem a word according to Spanish language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_spanish ($str) { }

/**
 * Stem a word according to Swedish language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_swedish ($str) { }

/**
 * Stem a word according to Turkish (unicode) language rules
 * @param string $str <p>
 * A string to be stemmed
 * </p>
 * @return string
 */
function stem_turkish_unicode ($str) { }

/**
 * 
 * @var int
 */
define('STEM_PORTER', 1);
/**
 * 
 * @var int
 */
define('STEM_DANISH', 6);
/**
 * 
 * @var int
 */
define('STEM_DUTCH', 5);
/**
 * 
 * @var int
 */
define('STEM_ENGLISH', 2);
/**
 * 
 * @var int
 */
define('STEM_FINNISH', 13);
/**
 * 
 * @var int
 */
define('STEM_FRENCH', 3);
/**
 * 
 * @var int
 */
define('STEM_FRANCAIS', 3);
/**
 * @var int
 */
define('STEM_GERMAN', 7);
/**
 * 
 * @var int
 */
define('STEM_HUNGARIAN', 15);
/**
 * 
 * @var int
 */
define('STEM_ITALIAN', 8);
/**
 * 
 * @var int
 */
define('STEM_NORWEGIAN', 9);
/**
 * 
 * @var int
 */
define('STEM_PORTUGUESE', 10);
/**
 * 
 * @var int
 */
define('STEM_ROMANIAN', 16);
/**
 * 
 * @var int
 */
define('STEM_RUSSIAN', 11);
/**
 * 
 * @var int
 */
define('STEM_RUSSIAN_UNICODE', 14);
/**
 * 
 * @var int
 */
define('STEM_SPANISH', 4);
/**
 * 
 * @var int
 */
define('STEM_ESPANOL', 4);
/**
 * 
 * @var int
 */
define('STEM_SWEDISH', 12);


// end php_stem PECL

?>
