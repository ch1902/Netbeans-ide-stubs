<?php

// php_solr PECL

/**
 *
 * @var string
 */
define('SOLR_EXTENSION_VERSION', "");

/**
 *
 * @var int
 */
define('SOLR_PATCH_VERSION', 0);

/**
 *
 * @var int
 */
define('SOLR_MINOR_VERSION', 0);

/**
 *
 * @var int
 */
define('SOLR_MAJOR_VERSION', 0);

/**
 * This function returns the current version of the extension as a string.
 * @link http://php.net/manual/en/function.solr-get-version.php
 * @return string It returns a string on success and FALSE on failure.
 */
function solr_get_version () { }

/**
 * Contains utility methods for retrieving the current extension version and preparing query phrases.
 */
abstract class SolrUtils
{
   /**
    * This method parses an response XML string from the Apache Solr server into a SolrObject. It throws a
    * SolrException if there was an error.
    * @link http://php.net/manual/en/solrutils.digestxmlresponse.php
    * @param string $xmlresponse <p>
    * The XML response string from the Solr server.
    * </p>
    * @param int $parse_mode <p>
    * Use SolrResponse::PARSE_SOLR_OBJ or SolrResponse::PARSE_SOLR_DOC
    * </p>
    * @return SolrObject Returns the SolrObject representing the XML response.
    */
   public static function digestXmlResponse ($xmlresponse, $parse_mode = 0) { }
   /**
    * <p>Lucene supports escaping special characters that are part of the query syntax.</p>
    * <p>The current list special characters are:</p>
    * <p>+ - && || ! ( ) { } [ ] ^ " ~ * ? : \ /</p>
    * <p>These characters are part of the query syntax and must be escaped</p>
    * @link http://php.net/manual/en/solrutils.escapequerychars.php
    * @param string $str <p>
    * This is the query string to be escaped.
    * </p>
    * @return string Returns the escaped string or FALSE on failure.
    */
   public static function escapeQueryChars ($str) { }
   /**
    * Returns the current Solr version.
    * @link http://php.net/manual/en/solrutils.getsolrversion.php
    * @return string The current version of the Apache Solr extension.
    */
   public static function getSolrVersion () { }
   /**
    * Prepares a phrase from an unescaped lucene string.
    * @link http://php.net/manual/en/solrutils.queryphrase.php
    * @param string $str <p>
    * The lucene phrase.
    * </p>
    * @return string Returns the phrase contained in double quotes.
    */
   public static function queryPhrase ($str) { }
}

/**
 * This class represents a Solr document that is about to be submitted to the Solr index.
 */
final class SolrInputDocument
{
   /**
    * Sorts the fields in ascending order.
    * @var integer
    */
   const SORT_DEFAULT = 1;
   /**
    * Sorts the fields in ascending order.
    * @var integer
    */
   const SORT_ASC = 1;
   /**
    * Sorts the fields in descending order.
    * @var integer
    */
   const SORT_DESC = 2;
   /**
    * Sorts the fields by name
    * @var integer
    */
   const SORT_FIELD_NAME = 1;
   /**
    * Sorts the fields by number of values.
    * @var integer
    */
   const SORT_FIELD_VALUE_COUNT = 2;
   /**
    * Sorts the fields by boost value.
    * @var integer
    */
   const SORT_FIELD_BOOST_VALUE = 4;
   /**
    * For multi-value fields, if a valid boost value is specified, the specified value will be multiplied
    * by the current boost value for this field.
    * @link http://php.net/manual/en/solrinputdocument.addfield.php
    * @param string $fieldName <p>
    * The name of the field
    * </p>
    * @param string $fieldValue <p>
    * The value for the field.
    * </p>
    * @param float $fieldBoostValue <p>
    * The index time boost for the field. Though this cannot be negative, you can still pass values less
    * than 1.0 but they must be greater than zero.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addField ($fieldName, $fieldValue, $fieldBoostValue = 0.0) { }
   /**
    * Resets the document by dropping all the fields and resets the document boost to zero.
    * @link http://php.net/manual/en/solrinputdocument.clear.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function clear () { }
   /**
    * Should not be called directly. It is used to create a deep copy of a SolrInputDocument.
    * @link http://php.net/manual/en/solrinputdocument.clone.php
    * @return void Creates a new SolrInputDocument instance.
    */
   public function __clone () { }
   /**
    * Constructor.
    * @link http://php.net/manual/en/solrinputdocument.construct.php
    * @return void None.
    */
   public function __construct () { }
   /**
    * Removes a field from the document.
    * @link http://php.net/manual/en/solrinputdocument.deletefield.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function deleteField ($fieldName) { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrinputdocument.destruct.php
    * @return void None.
    */
   public function __destruct () { }
   /**
    * Checks if a field exists
    * @link http://php.net/manual/en/solrinputdocument.fieldexists.php
    * @param string $fieldName <p>
    * Name of the field.
    * </p>
    * @return bool Returns TRUE if the field was found and FALSE if it was not found.
    */
   public function fieldExists ($fieldName) { }
   /**
    * Retrieves the current boost value for the document.
    * @link http://php.net/manual/en/solrinputdocument.getboost.php
    * @return float Returns the boost value on success and FALSE on failure.
    */
   public function getBoost () { }
   /**
    * Retrieves a field in the document.
    * @link http://php.net/manual/en/solrinputdocument.getfield.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return SolrDocumentField Returns a SolrDocumentField object on success and FALSE on failure.
    */
   public function getField ($fieldName) { }
   /**
    * Retrieves the boost value for a particular field.
    * @link http://php.net/manual/en/solrinputdocument.getfieldboost.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return float Returns the boost value for the field or FALSE if there was an error.
    */
   public function getFieldBoost ($fieldName) { }
   /**
    * Returns the number of fields in the document.
    * @link http://php.net/manual/en/solrinputdocument.getfieldcount.php
    * @return int Returns an integer on success or FALSE on failure.
    */
   public function getFieldCount () { }
   /**
    * Returns an array containing all the fields in the document.
    * @link http://php.net/manual/en/solrinputdocument.getfieldnames.php
    * @return array Returns an array on success and FALSE on failure.
    */
   public function getFieldNames () { }
   /**
    * Merges one input document into another.
    * @link http://php.net/manual/en/solrinputdocument.merge.php
    * @param SolrInputDocument $sourceDoc <p>
    * The source document.
    * </p>
    * @param bool $overwrite <p>
    * If this is TRUE it will replace matching fields in the destination document.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. In the future, this will be modified to return the
    * number of fields in the new document.
    */
   public function merge ($sourceDoc, $overwrite = true) { }
   /**
    * This is an alias of SolrInputDocument::clear
    * @link http://php.net/manual/en/solrinputdocument.reset.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function reset () { }
   /**
    * Sets the boost value for this document.
    * @link http://php.net/manual/en/solrinputdocument.setboost.php
    * @param float $documentBoostValue <p>
    * The index-time boost value for this document.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setBoost ($documentBoostValue) { }
   /**
    * Sets the index-time boost value for a field. This replaces the current boost value for this field.
    * @link http://php.net/manual/en/solrinputdocument.setfieldboost.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @param float $fieldBoostValue <p>
    * The index time boost value.
    * </p>
    * @return bool
    */
   public function setFieldBoost ($fieldName, $fieldBoostValue) { }
   /**
    * Sorts the fields within the document
    * @link http://php.net/manual/en/solrinputdocument.sort.php
    * @param int $sortOrderBy <p>
    * The sort criteria
    * </p>
    * @param int $sortDirection <p>
    * The sort direction
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function sort ($sortOrderBy, $sortDirection = SolrInputDocument::SORT_ASC) { }
   /**
    * Returns an array representation of the input document.
    * @link http://php.net/manual/en/solrinputdocument.toarray.php
    * @return array Returns an array containing the fields. It returns FALSE on failure.
    */
   public function toArray () { }
}

/**
 * Represents a Solr document retrieved from a query response.
 */
final class SolrDocument implements ArrayAccess, Iterator, Serializable
{
   /**
    * Default mode for sorting fields within the document.
    * @var integer
    */
   const SORT_DEFAULT = 1;
   /**
    * Sorts the fields in ascending order
    * @var integer
    */
   const SORT_ASC = 1;
   /**
    * Sorts the fields in descending order
    * @var integer
    */
   const SORT_DESC = 2;
   /**
    * Sorts the fields by field name.
    * @var integer
    */
   const SORT_FIELD_NAME = 1;
   /**
    * Sorts the fields by number of values in each field.
    * @var integer
    */
   const SORT_FIELD_VALUE_COUNT = 2;
   /**
    * Sorts the fields by thier boost values.
    * @var integer
    */
   const SORT_FIELD_BOOST_VALUE = 4;
   /**
    * This method adds a field to the SolrDocument instance.
    * @link http://php.net/manual/en/solrdocument.addfield.php
    * @param string $fieldName <p>
    * The name of the field
    * </p>
    * @param string $fieldValue <p>
    * The value of the field.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addField ($fieldName, $fieldValue) { }
   /**
    * Resets the current object. Discards all the fields and resets the document boost to zero.
    * @link http://php.net/manual/en/solrdocument.clear.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function clear () { }
   /**
    * Creates a copy of a SolrDocument object. Not to be called directly.
    * @link http://php.net/manual/en/solrdocument.clone.php
    * @return void None.
    */
   public function __clone () { }
   /**
    * Constructor for SolrDocument
    * @link http://php.net/manual/en/solrdocument.construct.php
    * @return void
    */
   public function __construct () { }
   /**
    * Retrieves the current field
    * @link http://php.net/manual/en/solrdocument.current.php
    * @return SolrDocumentField Returns the field
    */
   public function current () { }
   /**
    * Removes a field from the document.
    * @link http://php.net/manual/en/solrdocument.deletefield.php
    * @param string $fieldName <p>
    * Name of the field
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function deleteField ($fieldName) { }
   /**
    * Destructor for SolrDocument.
    * @link http://php.net/manual/en/solrdocument.destruct.php
    * @return void
    */
   public function __destruct () { }
   /**
    * Checks if the requested field as a valid fieldname in the document.
    * @link http://php.net/manual/en/solrdocument.fieldexists.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return bool Returns TRUE if the field is present and FALSE if it does not.
    */
   public function fieldExists ($fieldName) { }
   /**
    * Magic method for accessing the field as a property.
    * @link http://php.net/manual/en/solrdocument.get.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return SolrDocumentField Returns a SolrDocumentField instance.
    */
   public function __get ($fieldName) { }
   /**
    * Retrieves a field by name.
    * @link http://php.net/manual/en/solrdocument.getfield.php
    * @param string $fieldName <p>
    * Name of the field.
    * </p>
    * @return SolrDocumentField Returns a SolrDocumentField on success and FALSE on failure.
    */
   public function getField ($fieldName) { }
   /**
    * Returns the number of fields in this document. Multi-value fields are only counted once.
    * @link http://php.net/manual/en/solrdocument.getfieldcount.php
    * @return int Returns an integer on success and FALSE on failure.
    */
   public function getFieldCount () { }
   /**
    * Returns an array of fields names in the document.
    * @link http://php.net/manual/en/solrdocument.getfieldnames.php
    * @return array Returns an array containing the names of the fields in this document.
    */
   public function getFieldNames () { }
   /**
    * Returns a SolrInputDocument equivalent of the object. This is useful if one wishes to
    * resubmit/update a document retrieved from a query.
    * @link http://php.net/manual/en/solrdocument.getinputdocument.php
    * @return SolrInputDocument Returns a SolrInputDocument on success and NULL on failure.
    */
   public function getInputDocument () { }
   /**
    * Checks if a field exists
    * @link http://php.net/manual/en/solrdocument.isset.php
    * @param string $fieldName <p>
    * Name of the field.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function __isset ($fieldName) { }
   /**
    * Retrieves the current key.
    * @link http://php.net/manual/en/solrdocument.key.php
    * @return string Returns the current key.
    */
   public function key () { }
   /**
    * Merges source to the current SolrDocument.
    * @link http://php.net/manual/en/solrdocument.merge.php
    * @param SolrDocument $sourceDoc <p>
    * The source document.
    * </p>
    * @param bool $overwrite <p>
    * If this is TRUE then fields with the same name in the destination document will be overwritten.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function merge ($sourceDoc, $overwrite = true) { }
   /**
    * Moves the internal pointer to the next field.
    * @link http://php.net/manual/en/solrdocument.next.php
    * @return void This method has no return value.
    */
   public function next () { }
   /**
    * Checks if a particular field exists. This is used when the object is treated as an array.
    * @link http://php.net/manual/en/solrdocument.offsetexists.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function offsetExists ($fieldName) { }
   /**
    * This is used to retrieve the field when the object is treated as an array.
    * @link http://php.net/manual/en/solrdocument.offsetget.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return SolrDocumentField Returns a SolrDocumentField object.
    */
   public function offsetGet ($fieldName) { }
   /**
    * Used when the object is treated as an array to add a field to the document.
    * @link http://php.net/manual/en/solrdocument.offsetset.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @param string $fieldValue <p>
    * The value for this field.
    * </p>
    * @return void Returns TRUE on success or FALSE on failure.
    */
   public function offsetSet ($fieldName, $fieldValue) { }
   /**
    * Removes a field from the document.
    * @link http://php.net/manual/en/solrdocument.offsetunset.php
    * @param string $fieldName <p>
    * The name of the field.
    * </p>
    * @return void No return value.
    */
   public function offsetUnset ($fieldName) { }
   /**
    * This is an alias to SolrDocument::clear()
    * @link http://php.net/manual/en/solrdocument.reset.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function reset () { }
   /**
    * Resets the internal pointer to the beginning.
    * @link http://php.net/manual/en/solrdocument.rewind.php
    * @return void This method has no return value.
    */
   public function rewind () { }
   /**
    * Used for custom serialization.
    * @link http://php.net/manual/en/solrdocument.serialize.php
    * @return string Returns a string representing the serialized Solr document.
    */
   public function serialize () { }
   /**
    * Adds another field to the document. Used to set the fields as new properties.
    * @link http://php.net/manual/en/solrdocument.set.php
    * @param string $fieldName <p>
    * Name of the field.
    * </p>
    * @param string $fieldValue <p>
    * Field value.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function __set ($fieldName, $fieldValue) { }
   /**
    * Sorts the fields in the document
    * @link http://php.net/manual/en/solrdocument.sort.php
    * @param int $sortOrderBy <p>
    * The sort criteria.
    * </p>
    * @param int $sortDirection <p>
    * The sort direction.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function sort ($sortOrderBy, $sortDirection = SolrDocument::SORT_ASC) { }
   /**
    * Returns an array representation of the document.
    * @link http://php.net/manual/en/solrdocument.toarray.php
    * @return array Returns an array representation of the document.
    */
   public function toArray () { }
   /**
    * Custom serialization of SolrDocument objects
    * @link http://php.net/manual/en/solrdocument.unserialize.php
    * @param string $serialized <p>
    * An XML representation of the document.
    * </p>
    * @return void None.
    */
   public function unserialize ($serialized) { }
   /**
    * Custom serialization of SolrDocument objects
    * @link http://php.net/manual/en/solrdocument.unserialize.php
    * @param string $serialized <p>
    * An XML representation of the document.
    * </p>
    * @return void None.
    */
   public function unserialize ($serialized) { }
   /**
    * Checks if the current position internally is still valid. It is used during foreach operations.
    * @link http://php.net/manual/en/solrdocument.valid.php
    * @return bool Returns TRUE on success and FALSE if the current position is no longer valid.
    */
   public function valid () { }
}

/**
 * This represents a field in a Solr document. All its properties are read-only.
 */
final class SolrDocumentField
{
   /**
    * The name of the field.
    * @var string
    * @readonly
    */
   public $name;
   /**
    * The boost value for the field
    * @var float
    * @readonly
    */
   public $boost;
   /**
    * An array of values for this field
    * @var array
    * @readonly
    */
   public $values;
   /**
    * Constructor.
    * @link http://php.net/manual/en/solrdocumentfield.construct.php
    * @return void None.
    */
   public function __construct () { }
   /**
    * Destructor.
    * @link http://php.net/manual/en/solrdocumentfield.destruct.php
    * @return void None.
    */
   public function __destruct () { }
}

/**
 * This is an object whose properties can also by accessed using the array syntax. All its properties
 * are read-only.
 */
final class SolrObject implements ArrayAccess
{
   /**
    * Creates Solr object.
    * @link http://php.net/manual/en/solrobject.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * The destructor
    * @link http://php.net/manual/en/solrobject.destruct.php
    * @return void None.
    */
   public function __destruct () { }
   /**
    * Returns an array of all the names of the properties
    * @link http://php.net/manual/en/solrobject.getpropertynames.php
    * @return array Returns an array.
    */
   public function getPropertyNames () { }
   /**
    * Checks if the property exists. This is used when the object is treated as an array.
    * @link http://php.net/manual/en/solrobject.offsetexists.php
    * @param string $property_name <p>
    * The name of the property.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function offsetExists ($property_name) { }
   /**
    * Used to get the value of a property. This is used when the object is treated as an array.
    * @link http://php.net/manual/en/solrobject.offsetget.php
    * @param string $property_name <p>
    * Name of the property.
    * </p>
    * @return mixed Returns the property value.
    */
   public function offsetGet ($property_name) { }
   /**
    * Sets the value for a property. This is used when the object is treated as an array. This object is
    * read-only. This should never be attempted.
    * @link http://php.net/manual/en/solrobject.offsetset.php
    * @param string $property_name <p>
    * The name of the property.
    * </p>
    * @param string $property_value <p>
    * The new value.
    * </p>
    * @return void None.
    */
   public function offsetSet ($property_name, $property_value) { }
   /**
    * Sets the value for the property. This is used when the object is treated as an array. This object is
    * read-only. This should never be attempted.
    * @link http://php.net/manual/en/solrobject.offsetunset.php
    * @param string $property_name <p>
    * The name of the property.
    * </p>
    * @return void Returns TRUE on success or FALSE on failure.
    */
   public function offsetUnset ($property_name) { }
}

/**
 * Used to send requests to a Solr server. Currently, cloning and serialization of SolrClient instances
 * is not supported.
 */
final class SolrClient
{
   /**
    * Used when updating the search servlet.
    * @var integer
    */
   const SEARCH_SERVLET_TYPE = 1;
   /**
    * Used when updating the update servlet.
    * @var integer
    */
   const UPDATE_SERVLET_TYPE = 2;
   /**
    * Used when updating the threads servlet.
    * @var integer
    */
   const THREADS_SERVLET_TYPE = 4;
   /**
    * Used when updating the ping servlet.
    * @var integer
    */
   const PING_SERVLET_TYPE = 8;
   /**
    * Used when updating the terms servlet.
    * @var integer
    */
   const TERMS_SERVLET_TYPE = 16;
   /**
    * Used when retrieving system information from the system servlet.
    * @var integer
    */
   const SYSTEM_SERVLET_TYPE = 32;
   /**
    * This is the intial value for the search servlet.
    * @var string
    */
   const DEFAULT_SEARCH_SERVLET = 'select';
   /**
    * This is the intial value for the update servlet.
    * @var string
    */
   const DEFAULT_UPDATE_SERVLET = 'update';
   /**
    * This is the intial value for the threads servlet.
    * @var string
    */
   const DEFAULT_THREADS_SERVLET = 'admin/threads';
   /**
    * This is the intial value for the ping servlet.
    * @var string
    */
   const DEFAULT_PING_SERVLET = 'admin/ping';
   /**
    * This is the intial value for the terms servlet used for the TermsComponent
    * @var string
    */
   const DEFAULT_TERMS_SERVLET = 'terms';
   /**
    * This is the intial value for the system servlet used to obtain Solr Server information
    * @var string
    */
   const DEFAULT_SYSTEM_SERVLET = 'system';
   /**
    * This method adds a document to the index.
    * @link http://php.net/manual/en/solrclient.adddocument.php
    * @param SolrInputDocument $doc <p>
    * The SolrInputDocument instance.
    * </p>
    * @param bool $overwrite <p>
    * Whether to overwrite existing document or not. If FALSE there will be duplicates (several documents
    * with the same ID). Warning PECL Solr < 2.0 $allowDups was used instead of $overwrite, which does the
    * same functionality with exact opposite bool flag. $allowDups = false is the same as $overwrite =
    * true
    * </p>
    * @param int $commitWithin <p>
    * Number of milliseconds within which to auto commit this document. Available since Solr 1.4 . Default
    * (0) means disabled. When this value specified, it leaves the control of when to do the commit to
    * Solr itself, optimizing number of commits to a minimum while still fulfilling the update latency
    * requirements, and Solr will automatically do a commit when the oldest add in the buffer is due.
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse object or throws a SolrClientException on failure.
    */
   public function addDocument ($doc, $overwrite = true, $commitWithin = 0) { }
   /**
    * Adds a collection of documents to the index.
    * @link http://php.net/manual/en/solrclient.adddocuments.php
    * @param array $docs <p>
    * An array containing the collection of SolrInputDocument instances. This array must be an actual
    * variable.
    * </p>
    * @param bool $overwrite <p>
    * Whether to overwrite existing documents or not. If FALSE there will be duplicates (several documents
    * with the same ID). Warning PECL Solr < 2.0 $allowDups was used instead of $overwrite, which does the
    * same functionality with exact opposite bool flag. $allowDups = false is the same as $overwrite =
    * true
    * </p>
    * @param int $commitWithin <p>
    * Number of milliseconds within which to auto commit this document. Available since Solr 1.4 . Default
    * (0) means disabled. When this value specified, it leaves the control of when to do the commit to
    * Solr itself, optimizing number of commits to a minimum while still fulfilling the update latency
    * requirements, and Solr will automatically do a commit when the oldest add in the buffer is due.
    * </p>
    * @return void Returns a SolrUpdateResponse object or throws a SolrClientException on failure.
    */
   public function addDocuments ($docs, $overwrite = true, $commitWithin = 0) { }
   /**
    * This method finalizes all add/deletes made to the index.
    * @link http://php.net/manual/en/solrclient.commit.php
    * @param int $maxSegments <p>
    * Does nothing, kept for backward compatibility Warning DEPRECATED: will be removed in the next
    * release.
    * </p>
    * @param bool $softCommit <p>
    * This will refresh the 'view' of the index in a more performant manner, but without "on-disk"
    * guarantees. (Solr4.0+) A soft commit is much faster since it only makes index changes visible and
    * does not fsync index files or write a new index descriptor. If the JVM crashes or there is a loss of
    * power, changes that occurred after the last hard commit will be lost. Search collections that have
    * near-real-time requirements (that want index changes to be quickly visible to searches) will want to
    * soft commit often but hard commit less frequently.
    * </p>
    * @param bool $waitSearcher <p>
    * block until a new searcher is opened and registered as the main query searcher, making the changes
    * visible.
    * </p>
    * @param bool $expungeDeletes <p>
    * Merge segments with deletes away. (Solr1.4+)
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse object on success or throws a SolrClientException on failure.
    */
   public function commit ($maxSegments = 0, $softCommit = false, $waitSearcher = true, $expungeDeletes = false) { }
   /**
    * Constructor for the SolrClient object
    * @link http://php.net/manual/en/solrclient.construct.php
    * @param array $clientOptions <p>
    * This is an array containing one of the following keys : - secure (Boolean value indicating whether
    * or not to connect in secure mode) - hostname (The hostname for the Solr server) - port (The port
    * number) - path (The path to solr) - wt (The name of the response writer e.g. xml, phpnative) - login
    * (The username used for HTTP Authentication, if any) - password (The HTTP Authentication password) -
    * proxy_host (The hostname for the proxy server, if any) - proxy_port (The proxy port) - proxy_login
    * (The proxy username) - proxy_password (The proxy password) - timeout (This is maximum time in
    * seconds allowed for the http data transfer operation. Default is 30 seconds) - ssl_cert (File name
    * to a PEM-formatted file containing the private key + private certificate (concatenated in that
    * order) ) - ssl_key (File name to a PEM-formatted private key file only) - ssl_keypassword (Password
    * for private key) - ssl_cainfo (Name of file holding one or more CA certificates to verify peer with)
    * - ssl_capath (Name of directory holding multiple CA certificates to verify peer with ) Please note
    * the if the ssl_cert file only contains the private certificate, you have to specify a separate
    * ssl_key file The ssl_keypassword option is required if the ssl_cert or ssl_key options are set.
    * </p>
    * @return void
    */
   public function __construct ($clientOptions) { }
   /**
    * Deletes the document with the specified ID. Where ID is the value of the uniqueKey field declared in
    * the schema
    * @link http://php.net/manual/en/solrclient.deletebyid.php
    * @param string $id <p>
    * The value of the uniqueKey field declared in the schema
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success and throws a SolrClientException on failure.
    */
   public function deleteById ($id) { }
   /**
    * Deletes a collection of documents with the specified set of ids.
    * @link http://php.net/manual/en/solrclient.deletebyids.php
    * @param array $ids <p>
    * An array of IDs representing the uniqueKey field declared in the schema for each document to be
    * deleted. This must be an actual php variable.
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success and throws a SolrClientException on failure.
    */
   public function deleteByIds ($ids) { }
   /**
    * Removes all documents matching any of the queries
    * @link http://php.net/manual/en/solrclient.deletebyqueries.php
    * @param array $queries <p>
    * The array of queries. This must be an actual php variable.
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success and throws a SolrClientException on failure.
    */
   public function deleteByQueries ($queries) { }
   /**
    * Deletes all documents matching the given query.
    * @link http://php.net/manual/en/solrclient.deletebyquery.php
    * @param string $query <p>
    * The query
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success and throws a SolrClientException on failure.
    */
   public function deleteByQuery ($query) { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrclient.destruct.php
    * @return void Destructor for SolrClient
    */
   public function __destruct () { }
   /**
    * Returns the debug data for the last connection attempt
    * @link http://php.net/manual/en/solrclient.getdebug.php
    * @return string Returns a string on success and null if there is nothing to return.
    */
   public function getDebug () { }
   /**
    * Returns the client options set internally. Very useful for debugging. The values returned are
    * readonly and can only be set when the object is instantiated.
    * @link http://php.net/manual/en/solrclient.getoptions.php
    * @return array Returns an array containing all the options for the SolrClient object set internally.
    */
   public function getOptions () { }
   /**
    * Defragments the index for faster search performance.
    * @link http://php.net/manual/en/solrclient.optimize.php
    * @param int $maxSegments <p>
    * Optimizes down to at most this number of segments. Since Solr 1.3
    * </p>
    * @param bool $softCommit <p>
    * This will refresh the 'view' of the index in a more performant manner, but without "on-disk"
    * guarantees. (Solr4.0+)
    * </p>
    * @param bool $waitSearcher <p>
    * Block until a new searcher is opened and registered as the main query searcher, making the changes
    * visible.
    * </p>
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success or throws a SolrClientException on failure.
    */
   public function optimize ($maxSegments = 1, $softCommit = true, $waitSearcher = true) { }
   /**
    * Checks if the Solr server is still alive. Sends a HEAD request to the Apache Solr server.
    * @link http://php.net/manual/en/solrclient.ping.php
    * @return SolrPingResponse Returns a SolrPingResponse object on success and throws a SolrClientException on failure.
    */
   public function ping () { }
   /**
    * Sends a query to the server.
    * @link http://php.net/manual/en/solrclient.query.php
    * @param SolrParams $query <p>
    * A SolrParam object. It is recommended to use SolrQuery for advanced queries.
    * </p>
    * @return SolrQueryResponse Returns a SolrQueryResponse object on success and throws a SolrClientException object on failure.
    */
   public function query ($query) { }
   /**
    * Sends a raw XML update request to the server
    * @link http://php.net/manual/en/solrclient.request.php
    * @param string $raw_request <p>
    * An XML string with the raw request to the server.
    * </p>
    * @return void Returns a SolrUpdateResponse on success. Throws a SolrClientException on failure.
    */
   public function request ($raw_request) { }
   /**
    * Rollbacks all add/deletes made to the index since the last commit. It neither calls any event
    * listeners nor creates a new searcher.
    * @link http://php.net/manual/en/solrclient.rollback.php
    * @return SolrUpdateResponse Returns a SolrUpdateResponse on success or throws a SolrClientException on failure.
    */
   public function rollback () { }
   /**
    * Sets the response writer used to prepare the response from Solr
    * @link http://php.net/manual/en/solrclient.setresponsewriter.php
    * @param string $responseWriter <p>
    * One of the following : - xml - phpnative
    * </p>
    * @return void
    */
   public function setResponseWriter ($responseWriter) { }
   /**
    * Changes the specified servlet type to a new value
    * @link http://php.net/manual/en/solrclient.setservlet.php
    * @param int $type <p>
    * One of the following : - SolrClient::SEARCH_SERVLET_TYPE - SolrClient::UPDATE_SERVLET_TYPE -
    * SolrClient::THREADS_SERVLET_TYPE - SolrClient::PING_SERVLET_TYPE - SolrClient::TERMS_SERVLET_TYPE
    * </p>
    * @param string $value <p>
    * The new value for the servlet
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setServlet ($type, $value) { }
   /**
    * Checks the threads status
    * @link http://php.net/manual/en/solrclient.threads.php
    * @return void Returns a SolrGenericResponse object.
    */
   public function threads () { }
}

/**
 * Represents a response from the Solr server.
 */
abstract class SolrResponse
{
   /**
    * Documents should be parsed as SolrObject instances
    * @var integer
    */
   const PARSE_SOLR_OBJ = 0;
   /**
    * Documents should be parsed as SolrDocument instances.
    * @var integer
    */
   const PARSE_SOLR_DOC = 1;
   /**
    * The http status of the response.
    * @var integer
    */
   protected $http_status;
   /**
    * Whether to parse the solr documents as SolrObject or SolrDocument instances.
    * @var integer
    */
   protected $parser_mode;
   /**
    * Was there an error during the request
    * @var bool
    */
   protected $success;
   /**
    * Detailed message on http status
    * @var string
    */
   protected $http_status_message;
   /**
    * The request URL
    * @var string
    */
   protected $http_request_url;
   /**
    * A string of raw headers sent during the request.
    * @var string
    */
   protected $http_raw_request_headers;
   /**
    * The raw request sent to the server
    * @var string
    */
   protected $http_raw_request;
   /**
    * Response headers from the Solr server.
    * @var string
    */
   protected $http_raw_response_headers;
   /**
    * The response message from the server.
    * @var string
    */
   protected $http_raw_response;
   /**
    * The response in PHP serialized format.
    * @var string
    */
   protected $http_digested_response;
   /**
    * Returns the XML response as serialized PHP data
    * @link http://php.net/manual/en/solrresponse.getdigestedresponse.php
    * @return string Returns the XML response as serialized PHP data
    */
   public function getDigestedResponse () { }
   /**
    * Returns the HTTP status of the response.
    * @link http://php.net/manual/en/solrresponse.gethttpstatus.php
    * @return int Returns the HTTP status of the response.
    */
   public function getHttpStatus () { }
   /**
    * Returns more details on the HTTP status.
    * @link http://php.net/manual/en/solrresponse.gethttpstatusmessage.php
    * @return string Returns more details on the HTTP status
    */
   public function getHttpStatusMessage () { }
   /**
    * Returns the raw request sent to the Solr server.
    * @link http://php.net/manual/en/solrresponse.getrawrequest.php
    * @return string Returns the raw request sent to the Solr server
    */
   public function getRawRequest () { }
   /**
    * Returns the raw request headers sent to the Solr server.
    * @link http://php.net/manual/en/solrresponse.getrawrequestheaders.php
    * @return string Returns the raw request headers sent to the Solr server
    */
   public function getRawRequestHeaders () { }
   /**
    * Returns the raw response from the server.
    * @link http://php.net/manual/en/solrresponse.getrawresponse.php
    * @return string Returns the raw response from the server.
    */
   public function getRawResponse () { }
   /**
    * Returns the raw response headers from the server.
    * @link http://php.net/manual/en/solrresponse.getrawresponseheaders.php
    * @return string Returns the raw response headers from the server.
    */
   public function getRawResponseHeaders () { }
   /**
    * Returns the full URL the request was sent to.
    * @link http://php.net/manual/en/solrresponse.getrequesturl.php
    * @return string Returns the full URL the request was sent to
    */
   public function getRequestUrl () { }
   /**
    * Returns a SolrObject representing the XML response from the server.
    * @link http://php.net/manual/en/solrresponse.getresponse.php
    * @return SolrObject Returns a SolrObject representing the XML response from the server
    */
   public function getResponse () { }
   /**
    * Sets the parse mode.
    * @link http://php.net/manual/en/solrresponse.setparsemode.php
    * @param int $parser_mode <p>
    * SolrResponse::PARSE_SOLR_DOC parses documents in SolrDocument instances.
    * SolrResponse::PARSE_SOLR_OBJ parses document into SolrObjects.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setParseMode ($parser_mode = 0) { }
   /**
    * Used to check if the request to the server was successful.
    * @link http://php.net/manual/en/solrresponse.success.php
    * @return bool Returns TRUE if it was successful and FALSE if it was not.
    */
   public function success () { }
}

/**
 * Represents a response to a query request.
 */
final class SolrQueryResponse extends SolrResponse
{
   /**
    * Documents should be parsed as SolrObject instances
    * @var integer
    */
   const PARSE_SOLR_OBJ = 0;
   /**
    * Documents should be parsed as SolrDocument instances.
    * @var integer
    */
   const PARSE_SOLR_DOC = 1;
   /**
    * Constructor
    * @link http://php.net/manual/en/solrqueryresponse.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * Destructor.
    * @link http://php.net/manual/en/solrqueryresponse.destruct.php
    * @return void None
    */
   public function __destruct () { }
}

/**
 * Represents a response to an update request.
 */
final class SolrUpdateResponse extends SolrResponse
{
   /**
    * Documents should be parsed as SolrObject instances
    * @var integer
    */
   const PARSE_SOLR_OBJ = 0;
   /**
    * Documents should be parsed as SolrDocument instances.
    * @var integer
    */
   const PARSE_SOLR_DOC = 1;
   /**
    * Constructor
    * @link http://php.net/manual/en/solrupdateresponse.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrupdateresponse.destruct.php
    * @return void None
    */
   public function __destruct () { }
}

/**
 * Represents a response to a ping request to the server
 */
final class SolrPingResponse extends SolrResponse
{
   /**
    * Documents should be parsed as SolrObject instances
    * @var integer
    */
   const PARSE_SOLR_OBJ = 0;
   /**
    * Documents should be parsed as SolrDocument instances.
    * @var integer
    */
   const PARSE_SOLR_DOC = 1;
   /**
    * Constructor
    * @link http://php.net/manual/en/solrpingresponse.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrpingresponse.destruct.php
    * @return void None
    */
   public function __destruct () { }
   /**
    * Returns the response from the server. This should be empty because the request as a HEAD request.
    * @link http://php.net/manual/en/solrpingresponse.getresponse.php
    * @return string Returns an empty string.
    */
   public function getResponse () { }
}

/**
 * Represents a response from the solr server.
 */
final class SolrGenericResponse extends SolrResponse
{
   /**
    * Documents should be parsed as SolrObject instances
    * @var integer
    */
   const PARSE_SOLR_OBJ = 0;
   /**
    * Documents should be parsed as SolrDocument instances.
    * @var integer
    */
   const PARSE_SOLR_DOC = 1;
   /**
    * Constructor
    * @link http://php.net/manual/en/solrgenericresponse.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * Destructor.
    * @link http://php.net/manual/en/solrgenericresponse.destruct.php
    * @return void None
    */
   public function __destruct () { }
}

/**
 * Represents a collection of name-value pairs sent to the Solr server during a request.
 */
abstract class SolrParams implements Serializable
{
   /**
    * This is an alias for SolrParams::addParam
    * @link http://php.net/manual/en/solrparams.add.php
    * @param string $name <p>
    * The name of the parameter
    * </p>
    * @param string $value <p>
    * The value of the parameter
    * </p>
    * @return SolrParams Returns a SolrParams instance on success
    */
   final public function add ($name, $value) { }
   /**
    * Adds a parameter to the object. This is used for parameters that can be specified multiple times.
    * @link http://php.net/manual/en/solrparams.addparam.php
    * @param string $name <p>
    * Name of parameter
    * </p>
    * @param string $value <p>
    * Value of parameter
    * </p>
    * @return SolrParams Returns a SolrParam object on success and FALSE on failure.
    */
   public function addParam ($name, $value) { }
   /**
    * This is an alias for SolrParams::getParam
    * @link http://php.net/manual/en/solrparams.get.php
    * @param string $param_name <p>
    * Then name of the parameter
    * </p>
    * @return mixed Returns an array or string depending on the type of parameter
    */
   final public function get ($param_name) { }
   /**
    * Returns a parameter with name param_name
    * @link http://php.net/manual/en/solrparams.getparam.php
    * @param string $param_name <p>
    * The name of the parameter
    * </p>
    * @return mixed Returns a string or an array depending on the type of the parameter
    */
   final public function getParam ($param_name) { }
   /**
    * Returns an array of non URL-encoded parameters
    * @link http://php.net/manual/en/solrparams.getparams.php
    * @return array Returns an array of non URL-encoded parameters
    */
   final public function getParams () { }
   /**
    * Returns an array on URL-encoded parameters
    * @link http://php.net/manual/en/solrparams.getpreparedparams.php
    * @return array Returns an array on URL-encoded parameters
    */
   final public function getPreparedParams () { }
   /**
    * Used for custom serialization
    * @link http://php.net/manual/en/solrparams.serialize.php
    * @return string Used for custom serialization
    */
   final public function serialize () { }
   /**
    * An alias of SolrParams::setParam
    * @link http://php.net/manual/en/solrparams.set.php
    * @param string $name <p>
    * Then name of the parameter
    * </p>
    * @param string $value <p>
    * The parameter value
    * </p>
    * @return void Returns an instance of the SolrParams object on success
    */
   final public function set ($name, $value) { }
   /**
    * Sets the query parameter to the specified value. This is used for parameters that can only be
    * specified once. Subsequent calls with the same parameter name will override the existing value
    * @link http://php.net/manual/en/solrparams.setparam.php
    * @param string $name <p>
    * Name of the parameter
    * </p>
    * @param string $value <p>
    * Value of the parameter
    * </p>
    * @return SolrParams Returns a SolrParam object on success and FALSE on value.
    */
   public function setParam ($name, $value) { }
   /**
    * Returns all the name-value pair parameters in the object
    * @link http://php.net/manual/en/solrparams.tostring.php
    * @param bool $url_encode <p>
    * Whether to return URL-encoded values
    * </p>
    * @return string Returns a string on success and FALSE on failure.
    */
   final public function toString ($url_encode = false) { }
   /**
    * Used for custom serialization
    * @link http://php.net/manual/en/solrparams.unserialize.php
    * @param string $serialized <p>
    * The serialized representation of the object
    * </p>
    * @return void None
    */
   final public function unserialize ($serialized) { }
}

/**
 * Represents a collection of name-value pairs sent to the Solr server during a request.
 */
class SolrModifiableParams extends SolrParams implements Serializable
{
   /**
    * Constructor
    * @link http://php.net/manual/en/solrmodifiableparams.construct.php
    * @return void None
    */
   public function __construct () { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrmodifiableparams.destruct.php
    * @return void None
    */
   public function __destruct () { }
}

/**
 * Represents a collection of name-value pairs sent to the Solr server during a request.
 */
class SolrQuery extends SolrModifiableParams implements Serializable
{
   /**
    * Used to specify that the sorting should be in acending order
    * @var integer
    */
   const ORDER_ASC = 0;
   /**
    * Used to specify that the sorting should be in descending order
    * @var integer
    */
   const ORDER_DESC = 1;
   /**
    * Used to specify that the facet should sort by index
    * @var integer
    */
   const FACET_SORT_INDEX = 0;
   /**
    * Used to specify that the facet should sort by count
    * @var integer
    */
   const FACET_SORT_COUNT = 1;
   /**
    * Used in the TermsComponent
    * @var integer
    */
   const TERMS_SORT_INDEX = 0;
   /**
    * Used in the TermsComponent
    * @var integer
    */
   const TERMS_SORT_COUNT = 1;
   /**
    * <p>This method allows you to specify a field which should be treated as a facet.</p>
    * <p>It can be used multiple times with different field names to indicate multiple facet fields</p>
    * @link http://php.net/manual/en/solrquery.addfacetdatefield.php
    * @param string $dateField <p>
    * The name of the date field.
    * </p>
    * @return SolrQuery Returns a SolrQuery object.
    */
   public function addFacetDateField ($dateField) { }
   /**
    * Sets the facet.date.other parameter. Accepts an optional field override
    * @link http://php.net/manual/en/solrquery.addfacetdateother.php
    * @param string $value <p>
    * The value to use.
    * </p>
    * @param string $field_override <p>
    * The field name for the override.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addFacetDateOther ($value, $field_override) { }
   /**
    * Adds another field to the facet
    * @link http://php.net/manual/en/solrquery.addfacetfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addFacetField ($field) { }
   /**
    * Adds a facet query
    * @link http://php.net/manual/en/solrquery.addfacetquery.php
    * @param string $facetQuery <p>
    * The facet query
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addFacetQuery ($facetQuery) { }
   /**
    * <p>This method is used to used to specify a set of fields to return, thereby restricting the amount of
    * data returned in the response.</p>
    * <p>It should be called multiple time, once for each field name.</p>
    * @link http://php.net/manual/en/solrquery.addfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object
    */
   public function addField ($field) { }
   /**
    * Specifies a filter query
    * @link http://php.net/manual/en/solrquery.addfilterquery.php
    * @param string $fq <p>
    * The filter query
    * </p>
    * @return SolrQuery Returns the current SolrQuery object.
    */
   public function addFilterQuery ($fq) { }
   /**
    * Maps to hl.fl. This is used to specify that highlighted snippets should be generated for a
    * particular field
    * @link http://php.net/manual/en/solrquery.addhighlightfield.php
    * @param string $field <p>
    * Name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addHighlightField ($field) { }
   /**
    * Maps to mlt.fl. It specifies that a field should be used for similarity.
    * @link http://php.net/manual/en/solrquery.addmltfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addMltField ($field) { }
   /**
    * Maps to mlt.qf. It is used to specify query fields and their boosts
    * @link http://php.net/manual/en/solrquery.addmltqueryfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @param float $boost <p>
    * Its boost value
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addMltQueryField ($field, $boost) { }
   /**
    * Used to control how the results should be sorted.
    * @link http://php.net/manual/en/solrquery.addsortfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @param int $order <p>
    * The sort direction. This should be either SolrQuery::ORDER_ASC or SolrQuery::ORDER_DESC.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object.
    */
   public function addSortField ($field, $order = SolrQuery::ORDER_DESC) { }
   /**
    * Requests a return of sub results for values within the given facet. Maps to the stats.facet field
    * @link http://php.net/manual/en/solrquery.addstatsfacet.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addStatsFacet ($field) { }
   /**
    * Maps to stats.field parameter This methods adds another stats.field parameter.
    * @link http://php.net/manual/en/solrquery.addstatsfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function addStatsField ($field) { }
   /**
    * Constructor.
    * @link http://php.net/manual/en/solrquery.construct.php
    * @param string $q <p>
    * Optional search query
    * </p>
    * @return void None
    */
   public function __construct ($q) { }
   /**
    * Destructor
    * @link http://php.net/manual/en/solrquery.destruct.php
    * @return void None.
    */
   public function __destruct () { }
   /**
    * Returns the value of the facet parameter.
    * @link http://php.net/manual/en/solrquery.getfacet.php
    * @return bool Returns a boolean on success and NULL if not set
    */
   public function getFacet () { }
   /**
    * Returns the value for the facet.date.end parameter. This method accepts an optional field override
    * @link http://php.net/manual/en/solrquery.getfacetdateend.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set
    */
   public function getFacetDateEnd ($field_override) { }
   /**
    * Returns all the facet.date fields
    * @link http://php.net/manual/en/solrquery.getfacetdatefields.php
    * @return array Returns all the facet.date fields as an array or NULL if none was set
    */
   public function getFacetDateFields () { }
   /**
    * Returns the value of the facet.date.gap parameter. It accepts an optional field override
    * @link http://php.net/manual/en/solrquery.getfacetdategap.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set
    */
   public function getFacetDateGap ($field_override) { }
   /**
    * Returns the value of the facet.date.hardend parameter. Accepts an optional field override
    * @link http://php.net/manual/en/solrquery.getfacetdatehardend.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set
    */
   public function getFacetDateHardEnd ($field_override) { }
   /**
    * Returns the value for the facet.date.other parameter. This method accepts an optional field
    * override.
    * @link http://php.net/manual/en/solrquery.getfacetdateother.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return array Returns a string on success and NULL if not set.
    */
   public function getFacetDateOther ($field_override) { }
   /**
    * Returns the lower bound for the first date range for all date faceting on this field. Accepts an
    * optional field override
    * @link http://php.net/manual/en/solrquery.getfacetdatestart.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set
    */
   public function getFacetDateStart ($field_override) { }
   /**
    * Returns all the facet fields
    * @link http://php.net/manual/en/solrquery.getfacetfields.php
    * @return array Returns an array of all the fields and NULL if none was set
    */
   public function getFacetFields () { }
   /**
    * Returns the maximum number of constraint counts that should be returned for the facet fields. This
    * method accepts an optional field override
    * @link http://php.net/manual/en/solrquery.getfacetlimit.php
    * @param string $field_override <p>
    * The name of the field to override for
    * </p>
    * @return int Returns an integer on success and NULL if not set
    */
   public function getFacetLimit ($field_override) { }
   /**
    * Returns the value of the facet.method parameter. This accepts an optional field override.
    * @link http://php.net/manual/en/solrquery.getfacetmethod.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set
    */
   public function getFacetMethod ($field_override) { }
   /**
    * Returns the minimum counts for facet fields should be included in the response. It accepts an
    * optional field override
    * @link http://php.net/manual/en/solrquery.getfacetmincount.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return int Returns an integer on success and NULL if not set
    */
   public function getFacetMinCount ($field_override) { }
   /**
    * Returns the current state of the facet.missing parameter. This accepts an optional field override
    * @link http://php.net/manual/en/solrquery.getfacetmissing.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return bool Returns a boolean on success and NULL if not set
    */
   public function getFacetMissing ($field_override) { }
   /**
    * Returns an offset into the list of constraints to be used for pagination. Accepts an optional field
    * override
    * @link http://php.net/manual/en/solrquery.getfacetoffset.php
    * @param string $field_override <p>
    * The name of the field to override for.
    * </p>
    * @return int Returns an integer on success and NULL if not set
    */
   public function getFacetOffset ($field_override) { }
   /**
    * Returns the facet prefix
    * @link http://php.net/manual/en/solrquery.getfacetprefix.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getFacetPrefix ($field_override) { }
   /**
    * Returns all the facet queries
    * @link http://php.net/manual/en/solrquery.getfacetqueries.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getFacetQueries () { }
   /**
    * Returns an integer (SolrQuery::FACET_SORT_INDEX or SolrQuery::FACET_SORT_COUNT)
    * @link http://php.net/manual/en/solrquery.getfacetsort.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return int Returns an integer (SolrQuery::FACET_SORT_INDEX or SolrQuery::FACET_SORT_COUNT) on success or NULL
    * if not set.
    */
   public function getFacetSort ($field_override) { }
   /**
    * Returns the list of fields that will be returned in the response
    * @link http://php.net/manual/en/solrquery.getfields.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getFields () { }
   /**
    * Returns an array of filter queries. These are queries that can be used to restrict the super set of
    * documents that can be returned, without influencing score
    * @link http://php.net/manual/en/solrquery.getfilterqueries.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getFilterQueries () { }
   /**
    * Returns a boolean indicating whether or not to enable highlighted snippets to be generated in the
    * query response.
    * @link http://php.net/manual/en/solrquery.gethighlight.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getHighlight () { }
   /**
    * Returns the highlight field to use as backup or default. It accepts an optional override.
    * @link http://php.net/manual/en/solrquery.gethighlightalternatefield.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightAlternateField ($field_override) { }
   /**
    * Returns all the fields that Solr should generate highlighted snippets for
    * @link http://php.net/manual/en/solrquery.gethighlightfields.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getHighlightFields () { }
   /**
    * Returns the formatter for the highlighted output
    * @link http://php.net/manual/en/solrquery.gethighlightformatter.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightFormatter ($field_override) { }
   /**
    * Returns the text snippet generator for highlighted text. Accepts an optional field override.
    * @link http://php.net/manual/en/solrquery.gethighlightfragmenter.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightFragmenter ($field_override) { }
   /**
    * Returns the number of characters of fragments to consider for highlighting. Zero implies no
    * fragmenting. The entire field should be used.
    * @link http://php.net/manual/en/solrquery.gethighlightfragsize.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return int Returns an integer on success or NULL if not set.
    */
   public function getHighlightFragsize ($field_override) { }
   /**
    * Returns whether or not to enable highlighting for range/wildcard/fuzzy/prefix queries
    * @link http://php.net/manual/en/solrquery.gethighlighthighlightmultiterm.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getHighlightHighlightMultiTerm () { }
   /**
    * Returns the maximum number of characters of the field to return
    * @link http://php.net/manual/en/solrquery.gethighlightmaxalternatefieldlength.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getHighlightMaxAlternateFieldLength ($field_override) { }
   /**
    * Returns the maximum number of characters into a document to look for suitable snippets
    * @link http://php.net/manual/en/solrquery.gethighlightmaxanalyzedchars.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getHighlightMaxAnalyzedChars () { }
   /**
    * Returns whether or not the collapse contiguous fragments into a single fragment. Accepts an optional
    * field override.
    * @link http://php.net/manual/en/solrquery.gethighlightmergecontiguous.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getHighlightMergeContiguous ($field_override) { }
   /**
    * Returns the maximum number of characters from a field when using the regex fragmenter
    * @link http://php.net/manual/en/solrquery.gethighlightregexmaxanalyzedchars.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getHighlightRegexMaxAnalyzedChars () { }
   /**
    * Returns the regular expression used for fragmenting
    * @link http://php.net/manual/en/solrquery.gethighlightregexpattern.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightRegexPattern () { }
   /**
    * Returns the factor by which the regex fragmenter can deviate from the ideal fragment size to
    * accomodate the regular expression
    * @link http://php.net/manual/en/solrquery.gethighlightregexslop.php
    * @return float Returns a double on success and NULL if not set.
    */
   public function getHighlightRegexSlop () { }
   /**
    * Returns if a field will only be highlighted if the query matched in this particular field.
    * @link http://php.net/manual/en/solrquery.gethighlightrequirefieldmatch.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getHighlightRequireFieldMatch () { }
   /**
    * Returns the text which appears after a highlighted term. Accepts an optional field override
    * @link http://php.net/manual/en/solrquery.gethighlightsimplepost.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightSimplePost ($field_override) { }
   /**
    * Returns the text which appears before a highlighted term. Accepts an optional field override
    * @link http://php.net/manual/en/solrquery.gethighlightsimplepre.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return string Returns a string on success and NULL if not set.
    */
   public function getHighlightSimplePre ($field_override) { }
   /**
    * Returns the maximum number of highlighted snippets to generate per field. Accepts an optional field
    * override
    * @link http://php.net/manual/en/solrquery.gethighlightsnippets.php
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getHighlightSnippets ($field_override) { }
   /**
    * Returns whether or not to use SpanScorer to highlight phrase terms only when they appear within the
    * query phrase in the document.
    * @link http://php.net/manual/en/solrquery.gethighlightusephrasehighlighter.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getHighlightUsePhraseHighlighter () { }
   /**
    * Returns whether or not MoreLikeThis results should be enabled
    * @link http://php.net/manual/en/solrquery.getmlt.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getMlt () { }
   /**
    * Returns whether or not the query will be boosted by the interesting term relevance
    * @link http://php.net/manual/en/solrquery.getmltboost.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getMltBoost () { }
   /**
    * Returns the number of similar documents to return for each result
    * @link http://php.net/manual/en/solrquery.getmltcount.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltCount () { }
   /**
    * Returns all the fields to use for similarity
    * @link http://php.net/manual/en/solrquery.getmltfields.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getMltFields () { }
   /**
    * Returns the maximum number of query terms that will be included in any generated query
    * @link http://php.net/manual/en/solrquery.getmltmaxnumqueryterms.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMaxNumQueryTerms () { }
   /**
    * Returns the maximum number of tokens to parse in each document field that is not stored with
    * TermVector support
    * @link http://php.net/manual/en/solrquery.getmltmaxnumtokens.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMaxNumTokens () { }
   /**
    * Returns the maximum word length above which words will be ignored
    * @link http://php.net/manual/en/solrquery.getmltmaxwordlength.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMaxWordLength () { }
   /**
    * Returns the treshold frequency at which words will be ignored which do not occur in at least this
    * many docs
    * @link http://php.net/manual/en/solrquery.getmltmindocfrequency.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMinDocFrequency () { }
   /**
    * Returns the frequency below which terms will be ignored in the source document
    * @link http://php.net/manual/en/solrquery.getmltmintermfrequency.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMinTermFrequency () { }
   /**
    * Returns the minimum word length below which words will be ignored
    * @link http://php.net/manual/en/solrquery.getmltminwordlength.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getMltMinWordLength () { }
   /**
    * Returns the query fields and their boosts
    * @link http://php.net/manual/en/solrquery.getmltqueryfields.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getMltQueryFields () { }
   /**
    * Returns the main search query
    * @link http://php.net/manual/en/solrquery.getquery.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getQuery () { }
   /**
    * Returns the maximum number of documents from the complete result set to return to the client for
    * every request
    * @link http://php.net/manual/en/solrquery.getrows.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getRows () { }
   /**
    * Returns all the sort fields
    * @link http://php.net/manual/en/solrquery.getsortfields.php
    * @return array Returns an array on success and NULL if none of the parameters was set.
    */
   public function getSortFields () { }
   /**
    * Returns the offset in the complete result set for the queries where the set of returned documents
    * should begin.
    * @link http://php.net/manual/en/solrquery.getstart.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getStart () { }
   /**
    * Returns whether or not stats is enabled
    * @link http://php.net/manual/en/solrquery.getstats.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getStats () { }
   /**
    * Returns all the stats facets that were set
    * @link http://php.net/manual/en/solrquery.getstatsfacets.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getStatsFacets () { }
   /**
    * Returns all the statistics fields
    * @link http://php.net/manual/en/solrquery.getstatsfields.php
    * @return array Returns an array on success and NULL if not set.
    */
   public function getStatsFields () { }
   /**
    * Returns whether or not the TermsComponent is enabled
    * @link http://php.net/manual/en/solrquery.getterms.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getTerms () { }
   /**
    * Returns the field from which the terms are retrieved
    * @link http://php.net/manual/en/solrquery.gettermsfield.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getTermsField () { }
   /**
    * Returns whether or not to include the lower bound in the result set
    * @link http://php.net/manual/en/solrquery.gettermsincludelowerbound.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getTermsIncludeLowerBound () { }
   /**
    * Returns whether or not to include the upper bound term in the result set
    * @link http://php.net/manual/en/solrquery.gettermsincludeupperbound.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getTermsIncludeUpperBound () { }
   /**
    * Returns the maximum number of terms Solr should return
    * @link http://php.net/manual/en/solrquery.gettermslimit.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getTermsLimit () { }
   /**
    * Returns the term to start at
    * @link http://php.net/manual/en/solrquery.gettermslowerbound.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getTermsLowerBound () { }
   /**
    * Returns the maximum document frequency
    * @link http://php.net/manual/en/solrquery.gettermsmaxcount.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getTermsMaxCount () { }
   /**
    * Returns the minimum document frequency to return in order to be included
    * @link http://php.net/manual/en/solrquery.gettermsmincount.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getTermsMinCount () { }
   /**
    * Returns the prefix to which matching terms must be restricted. This will restrict matches to only
    * terms that start with the prefix
    * @link http://php.net/manual/en/solrquery.gettermsprefix.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getTermsPrefix () { }
   /**
    * Returns a boolean indicating whether or not to return the raw characters of the indexed term,
    * regardless of if it is human readable
    * @link http://php.net/manual/en/solrquery.gettermsreturnraw.php
    * @return bool Returns a boolean on success and NULL if not set.
    */
   public function getTermsReturnRaw () { }
   /**
    * SolrQuery::TERMS_SORT_INDEX indicates that the terms are returned by index order.
    * SolrQuery::TERMS_SORT_COUNT implies that the terms are sorted by term frequency (highest count
    * first)
    * @link http://php.net/manual/en/solrquery.gettermssort.php
    * @return int Returns an integer on success and NULL if not set.
    */
   public function getTermsSort () { }
   /**
    * Returns the term to stop at
    * @link http://php.net/manual/en/solrquery.gettermsupperbound.php
    * @return string Returns a string on success and NULL if not set.
    */
   public function getTermsUpperBound () { }
   /**
    * Returns the time in milliseconds allowed for the query to finish.
    * @link http://php.net/manual/en/solrquery.gettimeallowed.php
    * @return int Returns and integer on success and NULL if it is not set.
    */
   public function getTimeAllowed () { }
   /**
    * The name of the field
    * @link http://php.net/manual/en/solrquery.removefacetdatefield.php
    * @param string $field <p>
    * The name of the date field to remove
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeFacetDateField ($field) { }
   /**
    * Removes one of the facet.date.other parameters
    * @link http://php.net/manual/en/solrquery.removefacetdateother.php
    * @param string $value <p>
    * The value
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeFacetDateOther ($value, $field_override) { }
   /**
    * Removes one of the facet.date parameters
    * @link http://php.net/manual/en/solrquery.removefacetfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeFacetField ($field) { }
   /**
    * Removes one of the facet.query parameters.
    * @link http://php.net/manual/en/solrquery.removefacetquery.php
    * @param string $value <p>
    * The value
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeFacetQuery ($value) { }
   /**
    * Removes a field from the list of fields
    * @link http://php.net/manual/en/solrquery.removefield.php
    * @param string $field <p>
    * Name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeField ($field) { }
   /**
    * Removes a filter query.
    * @link http://php.net/manual/en/solrquery.removefilterquery.php
    * @param string $fq <p>
    * The filter query to remove
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeFilterQuery ($fq) { }
   /**
    * Removes one of the fields used for highlighting.
    * @link http://php.net/manual/en/solrquery.removehighlightfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeHighlightField ($field) { }
   /**
    * Removes one of the moreLikeThis fields.
    * @link http://php.net/manual/en/solrquery.removemltfield.php
    * @param string $field <p>
    * Name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeMltField ($field) { }
   /**
    * Removes one of the moreLikeThis query fields.
    * @link http://php.net/manual/en/solrquery.removemltqueryfield.php
    * @param string $queryField <p>
    * The query field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeMltQueryField ($queryField) { }
   /**
    * Removes one of the sort fields
    * @link http://php.net/manual/en/solrquery.removesortfield.php
    * @param string $field <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeSortField ($field) { }
   /**
    * Removes one of the stats.facet parameters
    * @link http://php.net/manual/en/solrquery.removestatsfacet.php
    * @param string $value <p>
    * The value
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeStatsFacet ($value) { }
   /**
    * Removes one of the stats.field parameters
    * @link http://php.net/manual/en/solrquery.removestatsfield.php
    * @param string $field <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function removeStatsField ($field) { }
   /**
    * If set to true, Solr places the name of the handle used in the response to the client for debugging
    * purposes.
    * @link http://php.net/manual/en/solrquery.setechohandler.php
    * @param bool $flag <p>
    * TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setEchoHandler ($flag) { }
   /**
    * Instructs Solr what kinds of Request parameters should be included in the response for debugging
    * purposes, legal values include:
    * @link http://php.net/manual/en/solrquery.setechoparams.php
    * @param string $type <p>
    * The type of parameters to include
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setEchoParams ($type) { }
   /**
    * Sets the explainOther common query parameter
    * @link http://php.net/manual/en/solrquery.setexplainother.php
    * @param string $query <p>
    * The Lucene query to identify a set of documents
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setExplainOther ($query) { }
   /**
    * Enables or disables faceting.
    * @link http://php.net/manual/en/solrquery.setfacet.php
    * @param bool $flag <p>
    * TRUE enables faceting and FALSE disables it.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacet ($flag) { }
   /**
    * Maps to facet.date.end
    * @link http://php.net/manual/en/solrquery.setfacetdateend.php
    * @param string $value <p>
    * See facet.date.end
    * </p>
    * @param string $field_override <p>
    * Name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetDateEnd ($value, $field_override) { }
   /**
    * Maps to facet.date.gap
    * @link http://php.net/manual/en/solrquery.setfacetdategap.php
    * @param string $value <p>
    * See facet.date.gap
    * </p>
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetDateGap ($value, $field_override) { }
   /**
    * Maps to facet.date.hardend
    * @link http://php.net/manual/en/solrquery.setfacetdatehardend.php
    * @param bool $value <p>
    * See facet.date.hardend
    * </p>
    * @param string $field_override <p>
    * The name of the field
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetDateHardEnd ($value, $field_override) { }
   /**
    * Maps to facet.date.start
    * @link http://php.net/manual/en/solrquery.setfacetdatestart.php
    * @param string $value <p>
    * See facet.date.start
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetDateStart ($value, $field_override) { }
   /**
    * Sets the minimum document frequency used for determining term count
    * @link http://php.net/manual/en/solrquery.setfacetenumcachemindefaultfrequency.php
    * @param int $frequency <p>
    * The minimum frequency
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetEnumCacheMinDefaultFrequency ($frequency, $field_override) { }
   /**
    * Maps to facet.limit. Sets the maximum number of constraint counts that should be returned for the
    * facet fields.
    * @link http://php.net/manual/en/solrquery.setfacetlimit.php
    * @param int $limit <p>
    * The maximum number of constraint counts
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetLimit ($limit, $field_override) { }
   /**
    * Specifies the type of algorithm to use when faceting a field. This method accepts optional field
    * override.
    * @link http://php.net/manual/en/solrquery.setfacetmethod.php
    * @param string $method <p>
    * The method to use.
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetMethod ($method, $field_override) { }
   /**
    * Sets the minimum counts for facet fields that should be included in the response
    * @link http://php.net/manual/en/solrquery.setfacetmincount.php
    * @param int $mincount <p>
    * The minimum count
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetMinCount ($mincount, $field_override) { }
   /**
    * Used to indicate that in addition to the Term-based constraints of a facet field, a count of all
    * matching results which have no value for the field should be computed
    * @link http://php.net/manual/en/solrquery.setfacetmissing.php
    * @param bool $flag <p>
    * TRUE turns this feature on. FALSE disables it.
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetMissing ($flag, $field_override) { }
   /**
    * Sets the offset into the list of constraints to allow for pagination.
    * @link http://php.net/manual/en/solrquery.setfacetoffset.php
    * @param int $offset <p>
    * The offset
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetOffset ($offset, $field_override) { }
   /**
    * Specifies a string prefix with which to limits the terms on which to facet.
    * @link http://php.net/manual/en/solrquery.setfacetprefix.php
    * @param string $prefix <p>
    * The prefix string
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetPrefix ($prefix, $field_override) { }
   /**
    * Determines the ordering of the facet field constraints
    * @link http://php.net/manual/en/solrquery.setfacetsort.php
    * @param int $facetSort <p>
    * Use SolrQuery::FACET_SORT_INDEX for sorting by index order or SolrQuery::FACET_SORT_COUNT for
    * sorting by count.
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setFacetSort ($facetSort, $field_override) { }
   /**
    * <p>Setting it to TRUE enables highlighted snippets to be generated in the query response.</p>
    * <p>Setting it to FALSE disables highlighting</p>
    * @link http://php.net/manual/en/solrquery.sethighlight.php
    * @param bool $flag <p>
    * Enable or disable highlighting
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlight ($flag) { }
   /**
    * If a snippet cannot be generated because there were no matching terms, one can specify a field to
    * use as the backup or default summary
    * @link http://php.net/manual/en/solrquery.sethighlightalternatefield.php
    * @param string $field <p>
    * The name of the backup field
    * </p>
    * @param string $field_override <p>
    * The name of the field we are overriding this setting for.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightAlternateField ($field, $field_override) { }
   /**
    * Specify a formatter for the highlight output.
    * @link http://php.net/manual/en/solrquery.sethighlightformatter.php
    * @param string $formatter <p>
    * Currently the only legal value is "simple"
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery
    */
   public function setHighlightFormatter ($formatter, $field_override) { }
   /**
    * Specify a text snippet generator for highlighted text.
    * @link http://php.net/manual/en/solrquery.sethighlightfragmenter.php
    * @param string $fragmenter <p>
    * The standard fragmenter is gap. Another option is regex, which tries to create fragments that
    * resembles a certain regular expression
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightFragmenter ($fragmenter, $field_override) { }
   /**
    * Sets the size, in characters, of fragments to consider for highlighting. "0" indicates that the
    * whole field value should be used (no fragmenting).
    * @link http://php.net/manual/en/solrquery.sethighlightfragsize.php
    * @param int $size <p>
    * The size, in characters, of fragments to consider for highlighting
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightFragsize ($size, $field_override) { }
   /**
    * Use SpanScorer to highlight phrase terms only when they appear within the query phrase in the
    * document.
    * @link http://php.net/manual/en/solrquery.sethighlighthighlightmultiterm.php
    * @param bool $flag <p>
    * Whether or not to use SpanScorer to highlight phrase terms only when they appear within the query
    * phrase in the document.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightHighlightMultiTerm ($flag) { }
   /**
    * <p>If SolrQuery::setHighlightAlternateField() was passed the value TRUE, this parameter specifies the
    * maximum number of characters of the field to return</p>
    * <p>Any value less than or equal to 0 means unlimited.</p>
    * @link http://php.net/manual/en/solrquery.sethighlightmaxalternatefieldlength.php
    * @param int $fieldLength <p>
    * The length of the field
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightMaxAlternateFieldLength ($fieldLength, $field_override) { }
   /**
    * Specifies the number of characters into a document to look for suitable snippets
    * @link http://php.net/manual/en/solrquery.sethighlightmaxanalyzedchars.php
    * @param int $value <p>
    * The number of characters into a document to look for suitable snippets
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightMaxAnalyzedChars ($value) { }
   /**
    * Whether or not to collapse contiguous fragments into a single fragment
    * @link http://php.net/manual/en/solrquery.sethighlightmergecontiguous.php
    * @param bool $flag <p>
    * Whether or not to collapse contiguous fragments into a single fragment
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightMergeContiguous ($flag, $field_override) { }
   /**
    * Specify the maximum number of characters to analyze from a field when using the regex fragmenter
    * @link http://php.net/manual/en/solrquery.sethighlightregexmaxanalyzedchars.php
    * @param int $maxAnalyzedChars <p>
    * The maximum number of characters to analyze from a field when using the regex fragmenter
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightRegexMaxAnalyzedChars ($maxAnalyzedChars) { }
   /**
    * Specifies the regular expression for fragmenting. This could be used to extract sentences
    * @link http://php.net/manual/en/solrquery.sethighlightregexpattern.php
    * @param string $value <p>
    * The regular expression for fragmenting. This could be used to extract sentences
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightRegexPattern ($value) { }
   /**
    * The factor by which the regex fragmenter can stray from the ideal fragment size ( specfied by
    * SolrQuery::setHighlightFragsize )to accomodate the regular expression
    * @link http://php.net/manual/en/solrquery.sethighlightregexslop.php
    * @param float $factor <p>
    * The factor by which the regex fragmenter can stray from the ideal fragment size
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightRegexSlop ($factor) { }
   /**
    * <p>If TRUE, then a field will only be highlighted if the query matched in this particular field.</p>
    * <p>This will only work if SolrQuery::setHighlightUsePhraseHighlighter() was set to TRUE</p>
    * @link http://php.net/manual/en/solrquery.sethighlightrequirefieldmatch.php
    * @param bool $flag <p>
    * TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightRequireFieldMatch ($flag) { }
   /**
    * Sets the text which appears before a highlighted term
    * @link http://php.net/manual/en/solrquery.sethighlightsimplepost.php
    * @param string $simplePost <p>
    * Sets the text which appears after a highlighted term The default is </em>
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery
    */
   public function setHighlightSimplePost ($simplePost, $field_override) { }
   /**
    * Sets the text which appears before a highlighted term
    * @link http://php.net/manual/en/solrquery.sethighlightsimplepre.php
    * @param string $simplePre <p>
    * The text which appears before a highlighted term
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightSimplePre ($simplePre, $field_override) { }
   /**
    * Sets the maximum number of highlighted snippets to generate per field
    * @link http://php.net/manual/en/solrquery.sethighlightsnippets.php
    * @param int $value <p>
    * The maximum number of highlighted snippets to generate per field
    * </p>
    * @param string $field_override <p>
    * The name of the field.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightSnippets ($value, $field_override) { }
   /**
    * Sets whether or not to use SpanScorer to highlight phrase terms only when they appear within the
    * query phrase in the document
    * @link http://php.net/manual/en/solrquery.sethighlightusephrasehighlighter.php
    * @param bool $flag <p>
    * Whether or not to use SpanScorer to highlight phrase terms only when they appear within the query
    * phrase in the document
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setHighlightUsePhraseHighlighter ($flag) { }
   /**
    * Enables or disables moreLikeThis
    * @link http://php.net/manual/en/solrquery.setmlt.php
    * @param bool $flag <p>
    * TRUE enables it and FALSE turns it off.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMlt ($flag) { }
   /**
    * Set if the query will be boosted by the interesting term relevance
    * @link http://php.net/manual/en/solrquery.setmltboost.php
    * @param bool $flag <p>
    * Sets to TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltBoost ($flag) { }
   /**
    * Set the number of similar documents to return for each result
    * @link http://php.net/manual/en/solrquery.setmltcount.php
    * @param int $count <p>
    * The number of similar documents to return for each result
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltCount ($count) { }
   /**
    * Sets the maximum number of query terms that will be included in any generated query.
    * @link http://php.net/manual/en/solrquery.setmltmaxnumqueryterms.php
    * @param int $value <p>
    * The maximum number of query terms that will be included in any generated query
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMaxNumQueryTerms ($value) { }
   /**
    * Specifies the maximum number of tokens to parse in each example doc field that is not stored with
    * TermVector support.
    * @link http://php.net/manual/en/solrquery.setmltmaxnumtokens.php
    * @param int $value <p>
    * The maximum number of tokens to parse
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMaxNumTokens ($value) { }
   /**
    * Sets the maximum word length above which words will be ignored.
    * @link http://php.net/manual/en/solrquery.setmltmaxwordlength.php
    * @param int $maxWordLength <p>
    * The maximum word length above which words will be ignored
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMaxWordLength ($maxWordLength) { }
   /**
    * The frequency at which words will be ignored which do not occur in at least this many docs.
    * @link http://php.net/manual/en/solrquery.setmltmindocfrequency.php
    * @param int $minDocFrequency <p>
    * Sets the frequency at which words will be ignored which do not occur in at least this many docs.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMinDocFrequency ($minDocFrequency) { }
   /**
    * Sets the frequency below which terms will be ignored in the source docs
    * @link http://php.net/manual/en/solrquery.setmltmintermfrequency.php
    * @param int $minTermFrequency <p>
    * The frequency below which terms will be ignored in the source docs
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMinTermFrequency ($minTermFrequency) { }
   /**
    * Sets the minimum word length below which words will be ignored.
    * @link http://php.net/manual/en/solrquery.setmltminwordlength.php
    * @param int $minWordLength <p>
    * The minimum word length below which words will be ignored
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setMltMinWordLength ($minWordLength) { }
   /**
    * Exclude the header from the returned results.
    * @link http://php.net/manual/en/solrquery.setomitheader.php
    * @param bool $flag <p>
    * TRUE excludes the header from the result.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setOmitHeader ($flag) { }
   /**
    * Sets the search query.
    * @link http://php.net/manual/en/solrquery.setquery.php
    * @param string $query <p>
    * The search query
    * </p>
    * @return SolrQuery Returns the current SolrQuery object
    */
   public function setQuery ($query) { }
   /**
    * Specifies the maximum number of rows to return in the result
    * @link http://php.net/manual/en/solrquery.setrows.php
    * @param int $rows <p>
    * The maximum number of rows to return
    * </p>
    * @return SolrQuery Returns the current SolrQuery object.
    */
   public function setRows ($rows) { }
   /**
    * Whether to show debug info
    * @link http://php.net/manual/en/solrquery.setshowdebuginfo.php
    * @param bool $flag <p>
    * Whether to show debug info. TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setShowDebugInfo ($flag) { }
   /**
    * Specifies the number of rows to skip. Useful in pagination of results.
    * @link http://php.net/manual/en/solrquery.setstart.php
    * @param int $start <p>
    * The number of rows to skip.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object.
    */
   public function setStart ($start) { }
   /**
    * Enables or disables the Stats component.
    * @link http://php.net/manual/en/solrquery.setstats.php
    * @param bool $flag <p>
    * TRUE turns on the stats component and FALSE disables it.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setStats ($flag) { }
   /**
    * Enables or disables the TermsComponent
    * @link http://php.net/manual/en/solrquery.setterms.php
    * @param bool $flag <p>
    * TRUE enables it. FALSE turns it off
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTerms ($flag) { }
   /**
    * Sets the name of the field to get the terms from
    * @link http://php.net/manual/en/solrquery.settermsfield.php
    * @param string $fieldname <p>
    * The field name
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsField ($fieldname) { }
   /**
    * Include the lower bound term in the result set.
    * @link http://php.net/manual/en/solrquery.settermsincludelowerbound.php
    * @param bool $flag <p>
    * Include the lower bound term in the result set
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsIncludeLowerBound ($flag) { }
   /**
    * Include the upper bound term in the result set.
    * @link http://php.net/manual/en/solrquery.settermsincludeupperbound.php
    * @param bool $flag <p>
    * TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsIncludeUpperBound ($flag) { }
   /**
    * Sets the maximum number of terms to return
    * @link http://php.net/manual/en/solrquery.settermslimit.php
    * @param int $limit <p>
    * The maximum number of terms to return. All the terms will be returned if the limit is negative.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsLimit ($limit) { }
   /**
    * Specifies the Term to start from
    * @link http://php.net/manual/en/solrquery.settermslowerbound.php
    * @param string $lowerBound <p>
    * The lower bound Term
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsLowerBound ($lowerBound) { }
   /**
    * Sets the maximum document frequency.
    * @link http://php.net/manual/en/solrquery.settermsmaxcount.php
    * @param int $frequency <p>
    * The maximum document frequency.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsMaxCount ($frequency) { }
   /**
    * Sets the minimum doc frequency to return in order to be included
    * @link http://php.net/manual/en/solrquery.settermsmincount.php
    * @param int $frequency <p>
    * The minimum frequency
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsMinCount ($frequency) { }
   /**
    * Restrict matches to terms that start with the prefix
    * @link http://php.net/manual/en/solrquery.settermsprefix.php
    * @param string $prefix <p>
    * Restrict matches to terms that start with the prefix
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsPrefix ($prefix) { }
   /**
    * If true, return the raw characters of the indexed term, regardless of if it is human readable
    * @link http://php.net/manual/en/solrquery.settermsreturnraw.php
    * @param bool $flag <p>
    * TRUE or FALSE
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsReturnRaw ($flag) { }
   /**
    * If SolrQuery::TERMS_SORT_COUNT, sorts the terms by the term frequency (highest count first). If
    * SolrQuery::TERMS_SORT_INDEX, returns the terms in index order
    * @link http://php.net/manual/en/solrquery.settermssort.php
    * @param int $sortType <p>
    * SolrQuery::TERMS_SORT_INDEX or SolrQuery::TERMS_SORT_COUNT
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsSort ($sortType) { }
   /**
    * Sets the term to stop at
    * @link http://php.net/manual/en/solrquery.settermsupperbound.php
    * @param string $upperBound <p>
    * The term to stop at
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTermsUpperBound ($upperBound) { }
   /**
    * The time allowed for a search to finish. This value only applies to the search and not to requests
    * in general. Time is in milliseconds. Values less than or equal to zero implies no time restriction.
    * Partial results may be returned, if there are any.
    * @link http://php.net/manual/en/solrquery.settimeallowed.php
    * @param int $timeAllowed <p>
    * The time allowed for a search to finish.
    * </p>
    * @return SolrQuery Returns the current SolrQuery object, if the return value is used.
    */
   public function setTimeAllowed ($timeAllowed) { }
}

/**
 * This is the base class for all exception thrown by the Solr extension classes.
 */
class SolrException extends Exception
{
   /**
    * The line in c-space source file where exception was generated
    * @var integer
    */
   protected $sourceline;
   /**
    * The c-space source file where exception was generated
    * @var string
    */
   protected $sourcefile;
   /**
    * The c-space function where exception was generated
    * @var string
    */
   protected $zif_name;
}

/**
 * An exception thrown when there is an error while making a request to the server from the client.
 */
class SolrClientException extends SolrException
{
   /**
    * Returns internal information where the Exception was thrown.
    * @link http://php.net/manual/en/solrclientexception.getinternalinfo.php
    * @return array Returns an array containing internal information where the error was thrown. Used only for debugging
    * by extension developers.
    */
   public function getInternalInfo () { }
}

/**
 * This object is thrown when an illeglal or invalid argument is passed to a method.
 */
class SolrIllegalArgumentException extends SolrException
{
   /**
    * Returns internal information where the Exception was thrown.
    * @link http://php.net/manual/en/solrillegalargumentexception.getinternalinfo.php
    * @return array Returns an array containing internal information where the error was thrown. Used only for debugging
    * by extension developers.
    */
   public function getInternalInfo () { }
}

/**
 * This object is thrown when an illegal or unsupported operation is performed on an object.
 */
class SolrIllegalOperationException extends SolrException
{
   /**
    * Returns internal information where the Exception was thrown.
    * @link http://php.net/manual/en/solrillegaloperationexception.getinternalinfo.php
    * @return array Returns an array containing internal information where the error was thrown. Used only for debugging
    * by extension developers.
    */
   public function getInternalInfo () { }
}

// end php_solr PECL

?>
