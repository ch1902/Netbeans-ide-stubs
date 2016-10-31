<?php

// php_sphinx PECL
/**
 *  The SphinxClient class provides object-oriented interface to Sphinx. 
 */
class SphinxClient 
{
   /**
    *  Adds query with the current settings to multi-query batch. This method doesn't affect current settings (sorting, filtering, grouping etc.) in any way. 
    * @link http://php.net/manual/en/sphinxclient.addquery.php
    * @param string $query <p>
    * Query string
    * </p>
    * @param string $index <p>
    * An index name (or names). 
    * </p>
    * @param string $comment <p>
    * A comment
    * </p>
    * @return int Returns an index in an array of results that will be returned by SphinxClient::runQueries call or false on error. 
    */
   public function addQuery ($query, $index = "*", $comment = "") { }
   /**
    * Connects to searchd, requests it to generate excerpts (snippets) from the given documents, and returns the results.
    * @link http://php.net/manual/en/sphinxclient.buildexcerpts.php
    * @param array $docs <p>
    * Array of strings with documents' contents. 
    * </p>
    * @param string $index <p>
    * Index name.
    * </p>
    * @param string $words <p>
    * Keywords to highlight.
    * </p>
    * @param array $opts <p>
    * Associative array of additional highlighting options (see below).
    * </p><ul>
    * <li>"before_match" - A string to insert before a keyword match. Default is "<b>".</li>
    * <li>"after_match" - A string to insert after a keyword match. Default is "</b>".</li>
    * <li>"chunk_separator" - A string to insert between snippet chunks (passages). Default is " ... ".</li>
    * <li>"limit" - Maximum snippet size, in symbols (codepoints). Integer, default is 256.</li>
    * <li>"around" - How much words to pick around each matching keywords block. Integer, default is 5.</li>
    * <li>"exact_phrase" - Whether to highlight exact query phrase matches only instead of individual keywords. Boolean, default is FALSE.</li>
    * <li>"single_passage" - Whether to extract single best passage only. Boolean, default is FALSE.</li>
    * </ul>
    * @return array Returns array of snippets on success or FALSE on failure.
    */
   public function buildExcerpts ($docs, $index, $words, $opts) { }
   /**
    * Extracts keywords from query using tokenizer settings for the given index, optionally with per-keyword occurrence statistics.
    * @link http://php.net/manual/en/sphinxclient.buildkeywords.php
    * @param string $query <p>
    * A query to extract keywords from.
    * </p>
    * @param string $index <p>
    * An index to get tokenizing settings and keyword occurrence statistics from. 
    * </p>
    * @param bool $hits <p>
    * A boolean flag to enable/disable keyword statistics generation. 
    * </p>
    * @return array Returns an array of associative arrays with per-keyword information.
    */
   public function buildKeywords ($query, $index, $hits) { }
   /**
    * Closes previously opened persistent connection. 
    * @link http://php.net/manual/en/sphinxclient.close.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function close () { }
   /**
    * Creates a new SphinxClient object.
    * @link http://php.net/manual/en/sphinxclient.construct.php
    * @return SphinxClient
    */
   public function __construct () { }
   /**
    * Escapes characters that are treated as special operators by the query language parser.
    * @link http://php.net/manual/en/sphinxclient.escapestring.php
    * @param string $string <p>
    * String to escape.
    * </p>
    * @return string
    */
   public function escapeString ($string) { }
   /**
    * Returns string with the last error message. If there were no errors during the previous API call, empty string 
    * is returned. This method doesn't reset the error message, so you can safely call it several times. 
    * @link http://php.net/manual/en/sphinxclient.getlasterror.php
    * @return string Returns the last error message or an empty string if there were no errors.
    */
   public function getLastError () { }
   /**
    * Returns last warning message. If there were no warnings during the previous API call, empty string is returned. 
    * This method doesn't reset the warning, so you can safely call it several times. 
    * @link http://php.net/manual/en/sphinxclient.getlastwarning.php
    * @return string Returns the last warning message or an empty string if there were no warnings.
    */
   public function getLastWarning () { }
   /**
    * Opens persistent connection to the server.
    * @link http://php.net/manual/en/sphinxclient.open.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function open () { }
   /**
    * Connects to searchd server, runs the given search query with the current settings, obtains and returns the result set. 
    * @link http://
    * @param string $query <p>
    * Query string.
    * </p>
    * @param string $index <p>
    * An index name (or names).
    * </p>
    * @param string $comment <p>
    * A comment
    * </p>
    * @return array <p>On success, SphinxClient::query() returns a list of found matches and additional per-query statistics. 
    * The result set is a hash utilize other structures instead of hash) with the following keys and values:</p><ul>
    * <li>"matches" - An array with found document IDs as keys and their weight and attributes values as values</li>
    * <li>"total" - Total number of matches found and retrieved (depends on your settings)</li>
    * <li>"total_found" - Total number of found documents matching the query</li>
    * <li>"words" - An array with words (case-folded and stemmed) as keys and per-word statistics as values</li>
    * <li>"error" - Query error message reported by searchd</li>
    * <li>"warning" - Query warning reported by searchd</li>
    * </ul>
    */
   public function query ($query, $index = "*", $comment = "") { }
   /**
    * Clears all currently set filters. This call is normally required when using multi-queries. You might want to set different 
    * filters for different queries in the batch. To do that, you should call SphinxClient::resetFilters() and add new filters 
    * using the respective calls. 
    * @link http://php.net/manual/en/sphinxclient.resetfilters.php
    * @return void
    */
   public function resetFilters () { }
   /**
    * Clears all currently group-by settings, and disables group-by. This call is normally required only when using multi-queries. 
    * @link http://php.net/manual/en/sphinxclient.resetgroupby.php
    * @return void
    */
   public function resetGroupBy () { }
   /**
    * Connects to searchd, runs a batch of all queries added using SphinxClient::addQuery, obtains and returns the result sets.
    * @link http://php.net/manual/en/sphinxclient.runqueries.php
    * @return array Returns FALSE on failure and array of result sets on success.
    */
   public function runQueries () { }
   /**
    * Controls the format of search results set arrays (whether matches should be returned as an array or a hash). 
    * @link http://
    * @param bool $array_result <p>
    * If $array_result is FALSE, matches are returned as a hash with document IDs as keys, and other information (weight, attributes) 
    * as values. If array_result is TRUE, matches are returned as a plain array with complete per-match information including document IDs.
    * </p> 
    * @return bool Always returns TRUE. 
    */
   public function setArrayResult ($array_result = false) { }
   /**
    * Sets connection timeout (in seconds) for searchd connection.
    * @link http://php.net/manual/en/sphinxclient.setconnecttimeout.php
    * @param float $timeout <p>
    * Timeout in seconds
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setConnectTimeout ($timeout) { }
   /**
    *  Binds per-field weights by name.
    * <p>Match ranking can be affected by per-field weights. See » Sphinx documentation for an explanation on how phrase 
    * proximity ranking is affected. This call lets you specify non-default weights for full-text fields.</p>
    * <p>The weights must be positive 32-bit integers, so be careful not to hit 32-bit integer maximum. The final weight is 
    * a 32-bit integer too. Default weight value is 1. Unknown field names are silently ignored.</p>
    * @link http://php.net/manual/en/sphinxclient.setfieldweights.php
    * @param array $weights <p>
    * Associative array of field names and field weights.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setFieldWeights ($weights) { }
   /**
    * Adds new integer values set filter to the existing list of filters.
    * @link http://php.net/manual/en/sphinxclient.setfilter.php
    * @param string $attribute <p>
    * An attribute name.
    * </p>
    * @param array $values <p>
    * Plain array of integer values.
    * </p>
    * @param bool $exclude <p>
    * If set to TRUE, matching documents are excluded from the result set. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setFilter ($attribute, $values, $exclude = false) { }
   /**
    * Adds new float range filter to the existing list of filters. Only those documents which have attribute value stored 
    * in the index between min and max (including values that are exactly equal to min or max) will be matched (or rejected, 
    * if exclude is TRUE).
    * @link http://php.net/manual/en/sphinxclient.setfilterfloatrange.php
    * @param string $attribute <p>
    * An attribute name.
    * </p>
    * @param float $min <p>
    * Minimum value.
    * </p>
    * @param float $max <p>
    * Maximum value.
    * </p>
    * @param bool $exclude <p>
    * If set to TRUE, matching documents are excluded from the result set.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setFilterFloatRange ($attribute, $min, $max, $exclude = false) { }
   /**
    * Adds new integer range filter to the existing list of filters. Only those documents which have attribute value stored in 
    * the index between min and max (including values that are exactly equal to min or max) will be matched (or rejected, 
    * if exclude is TRUE).
    * @link http://php.net/manual/en/sphinxclient.setfilterrange.php
    * @param string $attribute <p>
    * An attribute name.
    * </p>
    * @param int $min <p>
    * Minimum value. 
    * </p>
    * @param int $max <p>
    * Maximum value. 
    * </p>
    * @param bool $exclude <p>
    * If set to TRUE, matching documents are excluded from the result set. 
    * </p>
    * @return bool
    */
   public function setFilterRange ($attribute, $min, $max, $exclude = false) { }
   /**
    * <p>Sets anchor point for a geosphere distance (geodistance) calculations and enables them.</p>
    * <p>Once an anchor point is set, you can use magic "@geodist" attribute name in your filters and/or sorting expressions.</p>
    * @link http://php.net/manual/en/sphinxclient.setgeoanchor.php
    * @param string $attrlat <p>
    * Name of a latitude attribute.
    * </p>
    * @param string $attrlong <p>
    * Name of a longitude attribute.
    * </p>
    * @param float $latitude <p>
    * Anchor latitude in radians.
    * </p>
    * @param float $longitude <p>
    * Anchor longitude in radians.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setGeoAnchor ($attrlat, $attrlong, $latitude, $longitude) { }
   /**
    * <p>Sets grouping attribute, function, and group sorting mode, and enables grouping.</p>
    * <p>Grouping feature is very similar to GROUP BY clause in SQL. Results produced by this function call are going to be the same 
    * as produced by the following pseudo code: <code>SELECT ... GROUP BY $func($attribute) ORDER BY $groupsort</code>.</p>
    * @link http://php.net/manual/en/sphinxclient.setgroupby.php
    * @param string $attribute <p>
    * A string containing group-by attribute name. 
    * </p>
    * @param int $func <p>
    * Constant, which sets a function applied to the attribute value in order to compute group-by key. 
    * </p>
    * @param string $groupsort <p>
    * An optional clause controlling how the groups are sorted.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setGroupBy ($attribute, $func, $groupsort = "@group desc") { }
   /**
    * Sets attribute name for per-group distinct values count calculations. Only available for grouping queries. For each group, 
    * all values of attribute will be stored, then the amount of distinct values will be calculated and returned to the client. 
    * This feature is similar to COUNT(DISTINCT) clause in SQL. 
    * @link http://php.net/manual/en/sphinxclient.setgroupdistinct.php
    * @param string $attribute <p>
    * A string containing group-by attribute name. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setGroupDistinct ($attribute) { }
   /**
    * Sets an accepted range of document IDs. Default range is from 0 to 0, i.e. no limit. Only those records that have document 
    * ID between min and max (including IDs exactly equal to min or max) will be matched. 
    * @link http://php.net/manual/en/sphinxclient.setidrange.php
    * @param int $min <p>
    * Minimum ID value.
    * </p>
    * @param int $max <p>
    * Maximum ID value.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setIDRange ($min, $max) { }
   /**
    * Sets per-index weights and enables weighted summing of match weights across different indexes. 
    * @link http://php.net/manual/en/sphinxclient.setindexweights.php
    * @param array $weights <p>
    * An associative array mapping string index names to integer weights. Default is empty array, i.e. weighting summing is disabled.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setIndexWeights ($weights) { }
   /**
    * Sets offset into server-side result set and amount of matches to return to client starting from that offset (limit). 
    * Can additionally control maximum server-side result set size for current query (max_matches) and the threshold amount 
    * of matches to stop searching at (cutoff). 
    * @link http://php.net/manual/en/sphinxclient.setlimits.php
    * @param int $offset <p>
    * Result set offset.
    * </p>
    * @param int $limit <p>
    * Amount of matches to return.
    * </p>
    * @param int $max_matches <p>
    * Controls how much matches searchd will keep in RAM while searching. 
    * </p>
    * @param int $cutoff <p>
    * Used for advanced performance control. It tells searchd to forcibly stop search query once cutoff matches have been found and processed. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setLimits ($offset, $limit, $max_matches = 0, $cutoff = 0) { }
   /**
    * <p>Sets full-text query matching mode. mode is one of the constants listed below.</p> <ul>
    * <li>SPH_MATCH_ALL - Match all query words (default mode).</li>
    * <li>SPH_MATCH_ANY - Match any of query words.</li>
    * <li>SPH_MATCH_PHRASE - Match query as a phrase, requiring perfect match.</li>
    * <li>SPH_MATCH_BOOLEAN - Match query as a boolean expression.</li>
    * <li>SPH_MATCH_EXTENDED - Match query as an expression in Sphinx internal query language.</li>
    * <li>SPH_MATCH_FULLSCAN - Enables fullscan.</li>
    * <li>SPH_MATCH_EXTENDED2 - The same as SPH_MATCH_EXTENDED plus ranking and quorum searching support.</li>
    * </ul>
    * @link http://php.net/manual/en/sphinxclient.setmatchmode.php
    * @param int $mode <p>
    * Matching mode. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setMatchMode ($mode) { }
   /**
    * Sets maximum search query time. 
    * @link http://php.net/manual/en/sphinxclient.setmaxquerytime.php
    * @param int $qtime <p>
    * Maximum query time, in milliseconds. It must be a non-negative integer. Default value is 0, i.e. no limit.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setMaxQueryTime ($qtime) { }
   /**
    * Sets temporary (per-query) per-document attribute value overrides. Override feature lets you "temporary" update attribute 
    * values for some documents within a single query, leaving all other queries unaffected. This might be useful for personalized data
    * @link http://php.net/manual/en/sphinxclient.setoverride.php
    * @param string $attribute <p>
    * An attribute name. 
    * </p>
    * @param int $type <p>
    * An attribute type. Only supports scalar attributes. 
    * </p>
    * @param array $values <p>
    * Array of attribute values that maps document IDs to overridden attribute values.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setOverride ($attribute, $type, $values) { }
   /**
    * <p>Sets ranking mode. Only available in SPH_MATCH_EXTENDED2 matching mode.</p><ul>
    * <li>SPH_RANK_PROXIMITY_BM25 - Default ranking mode which uses both proximity and BM25 ranking.</li>
    * <li>SPH_RANK_BM25 - Statistical ranking mode which uses BM25 ranking only (similar to most of other full-text engines). 
    * This mode is faster, but may result in worse quality on queries which contain more than 1 keyword.</li>
    * <li>SPH_RANK_NONE - Disables ranking. This mode is the fastest. It is essentially equivalent to boolean searching, 
    * a weight of 1 is assigned to all matches.</li>
    * </ul>
    * @link http://php.net/manual/en/sphinxclient.setrankingmode.php
    * @param int $ranker <p>
    * Ranking mode.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setRankingMode ($ranker) { }
   /**
    * Sets distributed retry count and delay.
    * <p>On temporary failures searchd will attempt up to count retries per agent. delay is the delay between the retries, 
    * in milliseconds. Retries are disabled by default. Note that this call will not make the API itself retry on temporary 
    * failure; it only tells searchd to do so.</p>
    * @link http://php.net/manual/en/sphinxclient.setretries.php
    * @param int $count <p>
    * Number of retries. 
    * </p>
    * @param int $delay <p>
    * Delay between retries, in milliseconds.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setRetries ($count, $delay = 0) { }
   /**
    * Sets the select clause, listing specific attributes to fetch, and expressions to compute and fetch. 
    * @link http://php.net/manual/en/sphinxclient.setselect.php
    * @version 1.0.1
    * @param string $clause <p>
    * SQL-like clause. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setSelect ($clause) { }
   /**
    * Sets searchd host name and TCP port. All subsequent requests will use the new host and port settings. 
    * Default host and port are 'localhost' and 3312, respectively. 
    * @link http://php.net/manual/en/sphinxclient.setserver.php
    * @param string $server <p>
    * IP or hostname. 
    * </p>
    * @param int $port <p>
    * Port number. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setServer ($server, $port) { }
   /**
    * <p>Sets matches sorting mode. See available modes below.</p><ul>
    * <li>SPH_SORT_RELEVANCE - Sort by relevance in descending order (best matches first).</li>
    * <li>SPH_SORT_ATTR_DESC - Sort by an attribute in descending order (bigger attribute values first).</li>
    * <li>SPH_SORT_ATTR_ASC - Sort by an attribute in ascending order (smaller attribute values first).</li>
    * <li>SPH_SORT_TIME_SEGMENTS - Sort by time segments (last hour/day/week/month) in descending order, and then by relevance in descending order.</li>
    * <li>SPH_SORT_EXTENDED - Sort by SQL-like combination of columns in ASC/DESC order.</li>
    * <li>SPH_SORT_EXPR - Sort by an arithmetic expression.</li>
    * </ul>
    * @link http://php.net/manual/en/sphinxclient.setsortmode.php
    * @param int $mode <p>
    * Sorting mode.
    * </p>
    * @param string $sortby <p>
    * Sorting column
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setSortMode ($mode, $sortby = "") { }
   /**
    * Queries searchd status, and returns an array of status variable name and value pairs. 
    * @link http://php.net/manual/en/sphinxclient.status.php
    * @return array Returns an associative array of search server statistics or FALSE on failure. 
    */
   public function status () { }
   /**
    * Instantly updates given attribute values in given documents. 
    * @link http://php.net/manual/en/sphinxclient.updateattributes.php
    * @param string $index <p>
    * Name of the index (or indexes) to be updated. 
    * </p>
    * @param array $attributes <p>
    * Array of attribute names, listing attributes that are updated. 
    * </p>
    * @param array $values <p>
    * Associative array containing document IDs as keys and array of attribute values as values. 
    * </p>
    * @param bool $mva <p>
    * Are attributes multi-value attributes
    * </p>
    * @return int Returns number of actually updated documents (0 or more) on success, or FALSE on failure. 
    */
   public function updateAttributes ($index, $attributes, $values, $mva = false) { }
}

/**
 * 
 */
define('SEARCHD_OK', 0);
/**
 * 
 */
define('SEARCHD_ERROR', 1);
/**
 * 
 */
define('SEARCHD_RETRY', 2);
/**
 * 
 */
define('SEARCHD_WARNING', 3);
/**
 * 
 */
define('SPH_MATCH_ALL', 0);
/**
 * 
 */
define('SPH_MATCH_ANY', 1);
/**
 * 
 */
define('SPH_MATCH_PHRASE', 2);
/**
 * 
 */
define('SPH_MATCH_BOOLEAN', 3);
/**
 * 
 */
define('SPH_MATCH_EXTENDED', 4);
/**
 * 
 */
define('SPH_MATCH_FULLSCAN', 5);
/**
 * 
 */
define('SPH_MATCH_EXTENDED2', 6);
/**
 * 
 */
define('SPH_RANK_PROXIMITY_BM25', 0);
/**
 * 
 */
define('SPH_RANK_BM25', 1);
/**
 * 
 */
define('SPH_RANK_NONE', 2);
/**
 * 
 */
define('SPH_RANK_WORDCOUNT', 3);
/**
 * 
 */
define('SPH_SORT_RELEVANCE', 0);
/**
 * 
 */
define('SPH_SORT_ATTR_DESC', 1);
/**
 * 
 */
define('SPH_SORT_ATTR_ASC', 2);
/**
 * 
 */
define('SPH_SORT_TIME_SEGMENTS', 3);
/**
 * 
 */
define('SPH_SORT_EXTENDED', 4);
/**
 * 
 */
define('SPH_SORT_EXPR', 5);
/**
 * 
 */
define('SPH_FILTER_VALUES', 0);
/**
 * 
 */
define('SPH_FILTER_RANGE', 1);
/**
 * 
 */
define('SPH_FILTER_FLOATRANGE', 2);
/**
 * 
 */
define('SPH_ATTR_INTEGER', 1);
/**
 * 
 */
define('SPH_ATTR_TIMESTAMP', 2);
/**
 * 
 */
define('SPH_ATTR_ORDINAL', 3);
/**
 * 
 */
define('SPH_ATTR_BOOL', 4);
/**
 * 
 */
define('SPH_ATTR_FLOAT', 5);
/**
 * 
 */
define('SPH_ATTR_MULTI', 1073741825);
/**
 * 
 */
define('SPH_GROUPBY_DAY', 0);
/**
 * 
 */
define('SPH_GROUPBY_WEEK', 1);
/**
 * 
 */
define('SPH_GROUPBY_MONTH', 2);
/**
 * 
 */
define('SPH_GROUPBY_YEAR', 3);
/**
 * 
 */
define('SPH_GROUPBY_ATTR', 4);
/**
 * 
 */
define('SPH_GROUPBY_ATTRPAIR', 5); 

// end php_sphinx PECL

?>
