<?php

// php_http PECL

/**
 * The HttpDeflateStream class
 */
class HttpDeflateStream
{
   /**
    * gzip encoding
    * @var int
    */
   const TYPE_GZIP = 0;

   /**
    * zlib AKA deflate encoding
    * @var int
    */
   const TYPE_ZLIB = 0;

   /**
    * raw deflate encoding
    * @var int
    */
   const TYPE_RAW = 0;

   /**
    * default compression level
    * @var int
    */
   const LEVEL_DEF = 0;

   /**
    * minimum compression level
    * @var int
    */
   const LEVEL_MIN = 0;

   /**
    * maximum compression level
    * @var int
    */
   const LEVEL_MAX = 0;

   /**
    * default strategy
    * @var int
    */
   const STRATEGY_DEF = 0;

   /**
    * filtered strategy
    * @var int
    */
   const STRATEGY_FILT = 0;

   /**
    * Huffman strategy
    * @var int
    */
   const STRATEGY_HUFF = 0;

   /**
    * RLE strategy
    * @var int
    */
   const STRATEGY_RLE = 0;

   /**
    * fixed strategy
    * @var int
    */
   const STRATEGY_FIXED = 0;

   /**
    * no forced flush
    * @var int
    */
   const FLUSH_NONE = 0;

   /**
    * synching flush
    * @var int
    */
   const FLUSH_SYNC = 0;

   /**
    * full flush
    * @var int
    */
   const FLUSH_FULL = 0;

   /**
    * <p>Creates a new HttpDeflateStream object instance.</p>
    * <p>See the deflate stream constants table for possible flags.</p>
    * @link http://php.net/manual/en/httpdeflatestream.construct.php
    * @param int $flags <p>
    * initialization flags
    * </p>
    * @return void 
    */
   public function __construct ($flags = 0) { }
   /**
    * <p>Creates a new HttpDeflateStream object instance.</p>
    * <p>See the deflate stream constants table for possible flags.</p>
    * @link http://php.net/manual/en/httpdeflatestream.factory.php
    * @param int $flags <p>
    * initialization flags
    * </p>
    * @param string $class_name <p>
    * name of a subclass of HttpDeflateStream
    * </p>
    * @return HttpDeflateStream 
    */
   static public function factory ($flags = 0, $class_name = "HttpDeflateStream") { }
   /**
    * Finalizes the deflate stream. The deflate stream can be reused after finalizing.
    * @link http://php.net/manual/en/httpdeflatestream.finish.php
    * @param string $data <p>
    * data to deflate
    * </p>
    * @return string Returns the final part of deflated data.
    */
   public function finish ($data) { }
   /**
    * Flushes the deflate stream.
    * @link http://php.net/manual/en/httpdeflatestream.flush.php
    * @param string $data <p>
    * more data to deflate
    * </p>
    * @return string Returns some deflated data as string on success or FALSE on failure.
    */
   public function flush ($data) { }
   /**
    * Passes more data through the deflate stream.
    * @link http://php.net/manual/en/httpdeflatestream.update.php
    * @param string $data <p>
    * data to deflate
    * </p>
    * @return string Returns deflated data on success or FALSE on failure.
    */
   public function update ($data) { }
}

/**
 * The HttpInflateStream class
 */
class HttpInflateStream 
{
   /**
    * no forced flush
    * @var int
    */
   const FLUSH_NONE = 0;

   /**
    * synching flush
    * @var int
    */
   const FLUSH_SYNC = 0;

   /**
    * full flush
    * @var int
    */
   const FLUSH_FULL = 0;
   /**
    * <p>Creates a new HttpInflateStream object instance.</p>
    * <p>See the inflate constants table for possible flags.</p>
    * @link http://php.net/manual/en/httpinflatestream.construct.php
    * @param int $flags <p>
    * initialization flags
    * </p>
    * @return void 
    */
   public function __construct ($flags = 0) { }
   /**
    * <p>Creates a new HttpInflateStream object instance.</p>
    * <p>See the inflate constants table for possible flags.</p>
    * @link http://php.net/manual/en/httpinflatestream.factory.php
    * @param int $flags <p>
    * initialization flags
    * </p>
    * @param string $class_name <p>
    * name of a subclass of HttpInflateStream
    * </p>
    * @return HttpInflateStream 
    */
   public function factory ($flags = 0, $class_name = "HttpInflateStream") { }
   /**
    * Finalizes the inflate stream. The inflate stream can be reused after finalizing.
    * @link http://php.net/manual/en/httpinflatestream.finish.php
    * @param string $data <p>
    * data to inflate
    * </p>
    * @return string Returns the final part of inflated data.
    */
   public function finish ($data) { }
   /**
    * <p>Flushes the inflate stream.</p>
    * <p>Flushing usually has no effect on inflate streams.</p>
    * @link http://php.net/manual/en/httpinflatestream.flush.php
    * @param string $data <p>
    * more data to inflate
    * </p>
    * @return string Returns some inflated data as string on success or FALSE on failure.
    */
   public function flush ($data) { }
   /**
    * Passes more data through the inflate stream.
    * @link http://php.net/manual/en/httpinflatestream.update.php
    * @param string $data <p>
    * data to inflate
    * </p>
    * @return string Returns inflated data on success or FALSE on failure.
    */
   public function update ($data) { }
}

/**
 * The HttpMessage class
 */
class HttpMessage implements Iterator, Countable, Serializable 
{
   /**
    * message has is of no specific type
    * @var int
    */
   const TYPE_NONE = 0;

   /**
    * message is a request style HTTP message
    * @var int
    */
   const TYPE_REQUEST = 0;

   /**
    * message is a response style HTTP message
    * @var int
    */
   const TYPE_RESPONSE = 0;
   /**
    * message type
    * @var int
    */
   protected $type = 0;

   /**
    * message body
    * @var string
    */
   protected $body = "";

   /**
    * HTTP protocol version
    * @var float
    */
   protected $httpVersion = 0.0;

   /**
    * message headers
    * @var array
    */
   protected $headers = array();

   /**
    * request method name
    * @var string
    */
   protected $requestMethod = "";

   /**
    * request URL
    * @var requestUrl
    */
   protected $string = null;

   /**
    * response code
    * @var int
    */
   protected $responseCode = 0;

   /**
    * response status message
    * @var string
    */
   protected $responseStatus = "";

   /**
    * reference to parent message
    * @var HttpMessage
    */
   protected $parentMessage = null;
   /**
    * Add headers. If append is true, headers with the same name will be separated, else overwritten.
    * @link http://php.net/manual/en/httpmessage.addheaders.php
    * @param array $headers <p>
    * associative array containing the additional HTTP headers to add to the messages existing headers
    * </p>
    * @param bool $append <p>
    * if true, and a header with the same name of one to add exists already, this respective header will 
    * be converted to an array containing both header values, otherwise it will be overwritten with the 
    * new header value
    * </p>
    * @return void Returns TRUE on success or FALSE on failure.
    */
   public function addHeaders ($headers, $append = false) { }
   /**
    * <p>Instantiate a new HttpMessage object.</p>
    * <p>The constructed object will actually represent the last message of the passed string. If there were 
    * prior messages, those can be accessed by HttpMessage:: getParentMessage().</p>
    * @link http://php.net/manual/en/httpmessage.construct.php
    * @param string $message <p>
    * a single or several consecutive HTTP messages
    * </p>
    * @return void 
    */
   public function __construct ($message) { }
   /**
    * Returns a clone of an HttpMessage object detached from any parent messages.
    * @link http://php.net/manual/en/httpmessage.detach.php
    * @return HttpMessage Returns detached HttpMessage object copy.
    */
   public function detach () { }
   /**
    * Create an HttpMessage object from a string.
    * @link http://php.net/manual/en/httpmessage.factory.php
    * @param string $raw_message <p>
    * a single or several consecutive HTTP messages
    * </p>
    * @param string $class_name <p>
    * a class extending HttpMessage
    * </p>
    * @return HttpMessage Returns an HttpMessage object on success or NULL on failure.
    */
   static public function factory ($raw_message, $class_name = "HttpMessage") { }
   /**
    * Create an HttpMessage object from script environment.
    * @link http://php.net/manual/en/httpmessage.fromenv.php
    * @param int $message_type <p>
    * The message type. See HttpMessage type constants.
    * </p>
    * @param string $class_name <p>
    * a class extending HttpMessage
    * </p>
    * @return HttpMessage Returns an HttpMessage object on success or NULL on failure.
    */
   static public function fromEnv ($message_type, $class_name = "HttpMessage") { }
   /**
    * Create an HttpMessage object from a string.
    * @link http://php.net/manual/en/httpmessage.fromstring.php
    * @param string $raw_message <p>
    * a single or several consecutive HTTP messages
    * </p>
    * @param string $class_name <p>
    * a class extending HttpMessage
    * </p>
    * @return HttpMessage Returns an HttpMessage object on success or NULL on failure.
    */
   static public function fromString ($raw_message, $class_name = "HttpMessage") { }
   /**
    * Get the body of the parsed HttpMessage.
    * @link http://php.net/manual/en/httpmessage.getbody.php
    * @return string Returns the message body as string.
    */
   public function getBody () { }
   /**
    * Get message header.
    * @link http://php.net/manual/en/httpmessage.getheader.php
    * @param string $header <p>
    * header name
    * </p>
    * @return string Returns the header value on success or NULL if the header does not exist.
    */
   public function getHeader ($header) { }
   /**
    * Get message headers.
    * @link http://php.net/manual/en/httpmessage.getheaders.php
    * @return array Returns an associative array containing the messages HTTP headers.
    */
   public function getHeaders () { }
   /**
    * Get the HTTP Protocol Version of the Message.
    * @link http://php.net/manual/en/httpmessage.gethttpversion.php
    * @return string Returns the HTTP protocol version as string.
    */
   public function getHttpVersion () { }
   /**
    * Get parent Message.
    * @link http://php.net/manual/en/httpmessage.getparentmessage.php
    * @return HttpMessage Returns the parent HttpMessage object.
    */
   public function getParentMessage () { }
   /**
    * Get the Request Method of the Message.
    * @link http://php.net/manual/en/httpmessage.getrequestmethod.php
    * @return string Returns the request method name on success, or FALSE if the message is not of type 
    * HttpMessage::TYPE_REQUEST.
    */
   public function getRequestMethod () { }
   /**
    * Get the Request URL of the Message.
    * @link http://php.net/manual/en/httpmessage.getrequesturl.php
    * @return string Returns the request URL as string on success, or FALSE if the message is not of type 
    * HttpMessage::TYPE_REQUEST.
    */
   public function getRequestUrl () { }
   /**
    * Get the Response Code of the Message.
    * @link http://php.net/manual/en/httpmessage.getresponsecode.php
    * @return int Returns the HTTP response code if the message is of type HttpMessage::TYPE_RESPONSE, else FALSE.
    */
   public function getResponseCode () { }
   /**
    * Get the Response Status of the message (i.e. the string following the response code).
    * @link http://php.net/manual/en/httpmessage.getresponsestatus.php
    * @return string Returns the HTTP response status string if the message is of type HttpMessage::TYPE_RESPONSE, else 
    * FALSE.
    */
   public function getResponseStatus () { }
   /**
    * Get Message Type. Either HTTP_MSG_NONE, HTTP_MSG_REQUEST or HTTP_MSG_RESPONSE.
    * @link http://php.net/manual/en/httpmessage.gettype.php
    * @return int Returns the HttpMessage::TYPE.
    */
   public function getType () { }
   /**
    * Attempts to guess the content type of the message body through libmagic.
    * @link http://php.net/manual/en/httpmessage.guesscontenttype.php
    * @param string $magic_file <p>
    * the magic.mime database to use
    * </p>
    * @param int $magic_mode <p>
    * flags for libmagic
    * </p>
    * @return string Returns the guessed content type on success or FALSE on failure.
    */
   public function guessContentType ($magic_file, $magic_mode = MAGIC_MIME) { }
   /**
    * Prepends message(s) to the HTTP message.
    * @link http://php.net/manual/en/httpmessage.prepend.php
    * @param HttpMessage $message <p>
    * HttpMessage object to prepend
    * </p>
    * @param bool $top <p>
    * whether to prepend to the top most or right this message
    * </p>
    * @return void 
    */
   public function prepend ($message, $top = true) { }
   /**
    * Reorders the message chain in reverse order.
    * @link http://php.net/manual/en/httpmessage.reverse.php
    * @return HttpMessage Returns the most parent HttpMessage object.
    */
   public function reverse () { }
   /**
    * <p>Send the Message according to its type as Response or Request.</p>
    * <p>This provides limited functionality compared to HttpRequest and HttpResponse.</p>
    * @link http://php.net/manual/en/httpmessage.send.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function send () { }
   /**
    * <p>Set the body of the HttpMessage.</p>
    * <p>Don't forget to update any headers accordingly.</p>
    * @link http://php.net/manual/en/httpmessage.setbody.php
    * @param string $body <p>
    * the new body of the message
    * </p>
    * @return void 
    */
   public function setBody ($body) { }
   /**
    * Sets new headers.
    * @link http://php.net/manual/en/httpmessage.setheaders.php
    * @param array $headers <p>
    * associative array containing the new HTTP headers, which will replace all previous HTTP headers of 
    * the message
    * </p>
    * @return void 
    */
   public function setHeaders ($headers) { }
   /**
    * Set the HTTP Protocol version of the Message.
    * @link http://php.net/manual/en/httpmessage.sethttpversion.php
    * @param string $version <p>
    * the HTTP protocol version
    * </p>
    * @return bool Returns TRUE on success, or FALSE if supplied version is out of range (1.0/1.1).
    */
   public function setHttpVersion ($version) { }
   /**
    * Set the Request Method of the HTTP Message.
    * @link http://php.net/manual/en/httpmessage.setrequestmethod.php
    * @param string $method <p>
    * the request method name
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the message is not of type HttpMessage::TYPE_REQUEST or an 
    * invalid request method was supplied.
    */
   public function setRequestMethod ($method) { }
   /**
    * Set the Request URL of the HTTP Message.
    * @link http://php.net/manual/en/httpmessage.setrequesturl.php
    * @param string $url <p>
    * the request URL
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the message is not of type HttpMessage::TYPE_REQUEST or 
    * supplied URL was empty.
    */
   public function setRequestUrl ($url) { }
   /**
    * Set the response code of an HTTP Response Message.
    * @link http://php.net/manual/en/httpmessage.setresponsecode.php
    * @param int $code <p>
    * HTTP response code
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the message is not of type HttpMessage::TYPE_RESPONSE or the 
    * response code is out of range (100-510).
    */
   public function setResponseCode ($code) { }
   /**
    * Set the Response Status of the HTTP message (i.e. the string following the response code).
    * @link http://php.net/manual/en/httpmessage.setresponsestatus.php
    * @param string $status <p>
    * the response status text
    * </p>
    * @return bool Returns TRUE on success or FALSE if the message is not of type HttpMessage::TYPE_RESPONSE.
    */
   public function setResponseStatus ($status) { }
   /**
    * Set Message Type. Either HTTP_MSG_NONE, HTTP_MSG_REQUEST or HTTP_MSG_RESPONSE.
    * @link http://php.net/manual/en/httpmessage.settype.php
    * @param int $type <p>
    * the HttpMessage::TYPE_*
    * </p>
    * @return void 
    */
   public function setType ($type) { }
   /**
    * Creates an object regarding to the type of the message.
    * @link http://php.net/manual/en/httpmessage.tomessagetypeobject.php
    * @return HttpRequest|HttpResponse Returns either an HttpRequest or HttpResponse object on success, or NULL on failure.
    */
   public function toMessageTypeObject () { }
   /**
    * Get the string representation of the Message.
    * @link http://php.net/manual/en/httpmessage.tostring.php
    * @param bool $include_parent <p>
    * specifies whether the returned string should also contain any parent messages
    * </p>
    * @return string Returns the message as string.
    */
   public function toString ($include_parent = false) { }
}

/**
 * The HttpQueryString class
 */
class HttpQueryString implements ArrayAccess, Serializable 
{
   /**
    * retrieve query param as bool
    * @var int
    */
   const TYPE_BOOL = 0;

   /**
    * retrieve query param as int
    * @var int
    */
   const TYPE_INT = 0;

   /**
    * retrieve query param as float
    * @var int
    */
   const TYPE_FLOAT = 0;

   /**
    * retrieve query param as string
    * @var int
    */
   const TYPE_STRING = 0;

   /**
    * retrieve query param as array
    * @var int
    */
   const TYPE_ARRAY = 0;

   /**
    * retrieve query param as object
    * @var int
    */
   const TYPE_OBJECT = 0;
   /**
    * query parameters
    * @var array
    */
   private $queryArray = array();

   /**
    * serialized query parameters
    * @var string
    */
   private $queryString = "";
   /**
    * holds singletons
    * @var array
    */
   private static $instance = array();
   /**
    * <p>Creates a new HttpQueryString object instance.</p>
    * <p>Operates on and modifies $_GET and $_SERVER['QUERY_STRING'] if global is TRUE.</p>
    * @link http://php.net/manual/en/httpquerystring.construct.php
    * @param bool $global <p>
    * whether to operate on $_GET and $_SERVER['QUERY_STRING']
    * </p>
    * @param mixed $add <p>
    * additional/initial query string parameters
    * </p>
    * @return void 
    */
   final public function __construct ($global = true, $add) { }
   /**
    * <p>Get (part of) the query string.</p>
    * <p>The type parameter is either one of the HttpQueryString::TYPE_* constants or a type abbreviation 
    * like "b" for bool, "i" for int, "f" for float, "s" for string, "a" for array and "o" for a stdClass 
    * object.</p>
    * @link http://php.net/manual/en/httpquerystring.get.php
    * @param string $key <p>
    * key of the query string param to retrieve
    * </p>
    * @param mixed $type <p>
    * which variable type to enforce
    * </p>
    * @param mixed $defval <p>
    * default value if key does not exist
    * </p>
    * @param bool $delete <p>
    * whether to remove the key/value pair from the query string
    * </p>
    * @return mixed Returns the value of the query string param or the whole query string if no key was specified on 
    * success or defval if key does not exist.
    */
   public function get ($key, $type = 0, $defval = NULL, $delete = false) { }
   /**
    * Copies the query string object and sets provided params at the clone.
    * @link http://php.net/manual/en/httpquerystring.mod.php
    * @param mixed $params <p>
    * query string params to add
    * </p>
    * @return HttpQueryString Returns a new HttpQueryString object
    */
   public function mod ($params) { }
   /**
    * Set query string entry/entries. NULL values will unset the variable.
    * @link http://php.net/manual/en/httpquerystring.set.php
    * @param mixed $params <p>
    * query string params to add
    * </p>
    * @return string Returns the current query string.
    */
   public function set ($params) { }
   /**
    * Get a single instance (differentiates between the global setting).
    * @link http://php.net/manual/en/httpquerystring.singleton.php
    * @param bool $global <p>
    * whether to operate on $_GET and $_SERVER['QUERY_STRING']
    * </p>
    * @return HttpQueryString Returns always the same HttpQueryString instance regarding the global setting.
    */
   static public function singleton ($global = true) { }
   /**
    * Get the query string represented as associative array.
    * @link http://php.net/manual/en/httpquerystring.toarray.php
    * @return array Returns the array representation of the query string.
    */
   public function toArray () { }
   /**
    * Get the query string.
    * @link http://php.net/manual/en/httpquerystring.tostring.php
    * @return string Returns the string representation of the query string.
    */
   public function toString () { }
   /**
    * <p>Converts the query string from the source encoding ie to the target encoding oe.</p>
    * <p>Don't use any character set that can contain NUL bytes like UTF-16.</p>
    * <p>This method requires ext/iconv to be enabled and loaded.</p>
    * @link http://php.net/manual/en/httpquerystring.xlate.php
    * @param string $ie <p>
    * input encoding
    * </p>
    * @param string $oe <p>
    * output encoding
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function xlate ($ie, $oe) { }
}

/**
 * The HttpRequest
 */
class HttpRequest 
{
   /**
    * GET request method
    * @var integer
    */
   const METH_GET = 0;

   /**
    * HEAD request method
    * @var integer
    */
   const METH_HEAD = 0;

   /**
    * POST request method
    * @var integer
    */
   const METH_POST = 0;

   /**
    * PUT request method
    * @var integer
    */
   const METH_PUT = 0;

   /**
    * DELETE request method
    * @var integer
    */
   const METH_DELETE = 0;

   /**
    * OPTIONS request method
    * @var integer
    */
   const METH_OPTIONS = 0;

   /**
    * TRACE request method
    * @var integer
    */
   const METH_TRACE = 0;

   /**
    * CONNECT request method
    * @var integer
    */
   const METH_CONNECT = 0;

   /**
    * PROPFIND request method
    * @var integer
    */
   const METH_PROPFIND = 0;

   /**
    * PROPPATCH request method
    * @var integer
    */
   const METH_PROPPATCH = 0;

   /**
    * MKCOL request method
    * @var integer
    */
   const METH_MKCOL = 0;

   /**
    * COPY request method
    * @var integer
    */
   const METH_COPY = 0;

   /**
    * MOVE request method
    * @var integer
    */
   const METH_MOVE = 0;

   /**
    * LOCK request method
    * @var integer
    */
   const METH_LOCK = 0;

   /**
    * UNLOCK request method
    * @var integer
    */
   const METH_UNLOCK = 0;

   /**
    * VERSION-CONTROL request method
    * @var integer
    */
   const METH_VERSION_CONTROL = 0;

   /**
    * REPORT request method
    * @var integer
    */
   const METH_REPORT = 0;

   /**
    * CHECKOUT request method
    * @var integer
    */
   const METH_CHECKOUT = 0;

   /**
    * CHECKIN request method
    * @var integer
    */
   const METH_CHECKIN = 0;

   /**
    * UNCHECKOUT request method
    * @var integer
    */
   const METH_UNCHECKOUT = 0;

   /**
    * MKWORKSPACE request method
    * @var integer
    */
   const METH_MKWORKSPACE = 0;

   /**
    * UPDATE request method
    * @var integer
    */
   const METH_UPDATE = 0;

   /**
    * LABEL request method
    * @var integer
    */
   const METH_LABEL = 0;

   /**
    * MERGE request method
    * @var integer
    */
   const METH_MERGE = 0;

   /**
    * BASELINE-CONTROL request method
    * @var integer
    */
   const METH_BASELINE_CONTROL = 0;

   /**
    * MKACTIVITY request method
    * @var integer
    */
   const METH_MKACTIVITY = 0;

   /**
    * ACL request method
    * @var integer
    */
   const METH_ACL = 0;

   /**
    * HTTP protocol version 1.0
    * @var integer
    */
   const VERSION_1_0 = 0;

   /**
    * HTTP protocol version 1.1
    * @var integer
    */
   const VERSION_1_1 = 0;

   /**
    * any HTTP protocol version
    * @var integer
    */
   const VERSION_ANY = 0;

   /**
    * basic authentication
    * @var integer
    */
   const AUTH_BASIC = 0;

   /**
    * digest authentication
    * @var integer
    */
   const AUTH_DIGEST = 0;

   /**
    * NTLM authentication
    * @var integer
    */
   const AUTH_NTLM = 0;

   /**
    * GSS negotiate authentication
    * @var integer
    */
   const AUTH_GSSNEG = 0;

   /**
    * any authentication
    * @var integer
    */
   const AUTH_ANY = 0;

   /**
    * SOCKS v4 proxy
    * @var integer
    */
   const PROXY_SOCKS4 = 0;

   /**
    * SOCKS v5 proxy
    * @var integer
    */
   const PROXY_SOCKS5 = 0;

   /**
    * HTTP proxy
    * @var integer
    */
   const PROXY_HTTP = 0;

   /**
    * use TLS v1
    * @var integer
    */
   const SSL_VERSION_TLSv1 = 0;

   /**
    * use SSL v2
    * @var integer
    */
   const SSL_VERSION_SSLv2 = 0;

   /**
    * use SSL v3
    * @var integer
    */
   const SSL_VERSION_SSLv3 = 0;

   /**
    * use any SSL/TLS method
    * @var integer
    */
   const SSL_VERSION_ANY = 0;

   /**
    * resolve via IPv4 only
    * @var integer
    */
   const IPRESOLVE_V4 = 0;

   /**
    * resolve via IPv6 only
    * @var integer
    */
   const IPRESOLVE_V6 = 0;

   /**
    * use any resolving methods
    * @var integer
    */
   const IPRESOLVE_ANY = 0;
   /**
    * request options to configure the request; see request options
    * @var array
    */
   private $options = array();

   /**
    * form data: array("fieldname" => "fieldvalue")
    * @var array
    */
   private $postFields = array();

   /**
    * files to upload: array(array("name" => "image", "file" => "/home/u/images/u.png", "type" => 
    * "image/png"))
    * @var array
    */
   private $postFiles = array();

   /**
    * information (statistical) about the request/response; see Request/response information
    * @var array
    */
   private $responseInfo = array();

   /**
    * the response message
    * @var HttpMessage
    */
   private $responseMessage = null;

   /**
    * the numerical response code
    * @var integer
    */
   private $responseCode = 0;

   /**
    * the literal response status text
    * @var string
    */
   private $responseStatus = "";

   /**
    * the request method to use
    * @var integer
    */
   private $method = 0;

   /**
    * the request url
    * @var string
    */
   private $url = "";

   /**
    * the content type to use for raw post requests
    * @var string
    */
   private $contentType = "";

   /**
    * raw post data
    * @var string
    */
   private $rawPostData = "";

   /**
    * query parameters
    * @var string
    */
   private $queryData = "";

   /**
    * the file to upload with a PUT request
    * @var string
    */
   private $putFile = "";

   /**
    * raw data to upload with a PUT request
    * @var string
    */
   private $putData = "";

   /**
    * the whole request/response history if history logging is enabled
    * @var HttpMessage
    */
   private $history = null;

   /**
    * whether to enable history logging
    * @var boolean
    */
   public $recordHistory = true;
   /**
    * Add custom cookies.
    * @link http://php.net/manual/en/httprequest.addcookies.php
    * @param array $cookies <p>
    * an associative array containing any cookie name/value pairs to add
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addCookies ($cookies) { }
   /**
    * Add request header name/value pairs.
    * @link http://php.net/manual/en/httprequest.addheaders.php
    * @param array $headers <p>
    * an associative array as parameter containing additional header name/value pairs
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addHeaders ($headers) { }
   /**
    * <p>Adds POST data entries, leaving previously set unchanged, unless a post entry with the same name 
    * already exists.</p>
    * <p>Affects only POST and custom requests.</p>
    * @link http://php.net/manual/en/httprequest.addpostfields.php
    * @param array $post_data <p>
    * an associative array as parameter containing the post fields
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addPostFields ($post_data) { }
   /**
    * <p>Add a file to the POST request, leaving previously set files unchanged.</p>
    * <p>Affects only POST and custom requests. Cannot be used with raw post data.</p>
    * @link http://php.net/manual/en/httprequest.addpostfile.php
    * @param string $name <p>
    * the form element name
    * </p>
    * @param string $file <p>
    * the path to the file
    * </p>
    * @param string $content_type <p>
    * the content type of the file
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the content type seems not to contain a primary and a secondary 
    * content type part.
    */
   public function addPostFile ($name, $file, $content_type = "application/x-octetstream") { }
   /**
    * <p>Add PUT data, leaving previously set PUT data unchanged.</p>
    * <p>Affects only PUT requests.</p>
    * @link http://php.net/manual/en/httprequest.addputdata.php
    * @param string $put_data <p>
    * the data to concatenate
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addPutData ($put_data) { }
   /**
    * <p>Add parameters to the query parameter list, leaving previously set unchanged.</p>
    * <p>Affects any request type.</p>
    * @link http://php.net/manual/en/httprequest.addquerydata.php
    * @param array $query_params <p>
    * an associative array as parameter containing the query fields to add
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addQueryData ($query_params) { }
   /**
    * <p>Add raw post data, leaving previously set raw post data unchanged.</p>
    * <p>Affects only POST and custom requests.</p>
    * @link http://php.net/manual/en/httprequest.addrawpostdata.php
    * @param string $raw_post_data <p>
    * the raw post data to concatenate
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addRawPostData ($raw_post_data) { }
   /**
    * Set additional SSL options.
    * @link http://php.net/manual/en/httprequest.addssloptions.php
    * @param array $options <p>
    * an associative array as parameter containing additional SSL specific options
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function addSslOptions ($options) { }
   /**
    * <p>Clears all history messages.</p>
    * <p>History is only logged if recordHistory was enabled.</p>
    * @link http://php.net/manual/en/httprequest.clearhistory.php
    * @return void 
    */
   public function clearHistory () { }
   /**
    * Instantiate a new HttpRequest object.
    * @link http://php.net/manual/en/httprequest.construct.php
    * @param string $url <p>
    * the target request url
    * </p>
    * @param int $request_method <p>
    * the request method to use
    * </p>
    * @param array $options <p>
    * an associative array with request options
    * </p>
    * @return void 
    */
   public function __construct ($url, $request_method = HTTP_METH_GET, $options) { }
   /**
    * <p>Enable automatic sending of received cookies.</p>
    * <p>Note that custom set cookies will be sent anyway.</p>
    * @link http://php.net/manual/en/httprequest.enablecookies.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function enableCookies () { }
   /**
    * Get the previously set content type.
    * @link http://php.net/manual/en/httprequest.getcontenttype.php
    * @return string Returns the previously set content type as string.
    */
   public function getContentType () { }
   /**
    * Get previously set cookies.
    * @link http://php.net/manual/en/httprequest.getcookies.php
    * @return array Returns an associative array containing any previously set cookies.
    */
   public function getCookies () { }
   /**
    * Get previously set request headers.
    * @link http://php.net/manual/en/httprequest.getheaders.php
    * @return array Returns an associative array containing all currently set headers.
    */
   public function getHeaders () { }
   /**
    * <p>Get all sent requests and received responses as an HttpMessage object.</p>
    * <p>If you want to record history, set the instance variable HttpRequest::recordHistory to TRUE.</p>
    * <p>The returned object references the last received response, use HttpMessage::getParentMessage() to 
    * access the data of previously sent requests and received responses.</p>
    * @link http://php.net/manual/en/httprequest.gethistory.php
    * @return HttpMessage Returns an HttpMessage object representing the complete request/response history.
    */
   public function getHistory () { }
   /**
    * Get the previously set request method.
    * @link http://php.net/manual/en/httprequest.getmethod.php
    * @return int Returns the currently set request method.
    */
   public function getMethod () { }
   /**
    * Get currently set options.
    * @link http://php.net/manual/en/httprequest.getoptions.php
    * @return array Returns an associative array containing currently set options.
    */
   public function getOptions () { }
   /**
    * Get previously set POST data.
    * @link http://php.net/manual/en/httprequest.getpostfields.php
    * @return array Returns the currently set post fields as associative array.
    */
   public function getPostFields () { }
   /**
    * Get all previously added POST files.
    * @link http://php.net/manual/en/httprequest.getpostfiles.php
    * @return array Returns an array containing currently set post files.
    */
   public function getPostFiles () { }
   /**
    * Get previously set PUT data.
    * @link http://php.net/manual/en/httprequest.getputdata.php
    * @return string Returns a string containing the currently set PUT data.
    */
   public function getPutData () { }
   /**
    * Get previously set put file.
    * @link http://php.net/manual/en/httprequest.getputfile.php
    * @return string Returns a string containing the path to the currently set put file.
    */
   public function getPutFile () { }
   /**
    * Get the current query data in form of an urlencoded query string.
    * @link http://php.net/manual/en/httprequest.getquerydata.php
    * @return string Returns a string containing the urlencoded query.
    */
   public function getQueryData () { }
   /**
    * Get previously set raw post data.
    * @link http://php.net/manual/en/httprequest.getrawpostdata.php
    * @return string Returns a string containing the currently set raw post data.
    */
   public function getRawPostData () { }
   /**
    * Get sent HTTP message.
    * @link http://php.net/manual/en/httprequest.getrawrequestmessage.php
    * @return string Returns an HttpMessage in a form of a string.
    */
   public function getRawRequestMessage () { }
   /**
    * Get the entire HTTP response.
    * @link http://php.net/manual/en/httprequest.getrawresponsemessage.php
    * @return string Returns the complete web server response, including the headers in a form of a string.
    */
   public function getRawResponseMessage () { }
   /**
    * <p>Get sent HTTP message.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response. Use HttpMessage::getParentMessage() to access the data of previously sent requests within 
    * this request cycle.</p>
    * <p>Note that the internal request message is immutable, that means that the request message received 
    * through HttpRequest::getRequestMessage() will always look the same for the same request, regardless 
    * of any changes you may have made to the returned object.</p>
    * @link http://php.net/manual/en/httprequest.getrequestmessage.php
    * @return HttpMessage Returns an HttpMessage object representing the sent request.
    */
   public function getRequestMessage () { }
   /**
    * <p>Get the response body after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponsebody.php
    * @return string Returns a string containing the response body.
    */
   public function getResponseBody () { }
   /**
    * <p>Get the response code after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponsecode.php
    * @return int Returns an int representing the response code.
    */
   public function getResponseCode () { }
   /**
    * <p>Get response cookie(s) after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponsecookies.php
    * @param int $flags <p>
    * http_parse_cookie() flags
    * </p>
    * @param array $allowed_extras <p>
    * allowed keys treated as extra information instead of cookie names
    * </p>
    * @return array Returns an array of stdClass objects like http_parse_cookie() would return.
    */
   public function getResponseCookies ($flags = 0, $allowed_extras) { }
   /**
    * <p>Get all response data after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponsedata.php
    * @return array Returns an associative array with the key "headers" containing an associative array holding all 
    * response headers, as well as the key "body" containing a string with the response body.
    */
   public function getResponseData () { }
   /**
    * <p>Get response header(s) after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponseheader.php
    * @param string $name <p>
    * header to read; if empty, all response headers will be returned
    * </p>
    * @return mixed Returns either a string with the value of the header matching name if requested, FALSE on failure, 
    * or an associative array containing all response headers.
    */
   public function getResponseHeader ($name) { }
   /**
    * <p>Get response info after the request has been sent.</p>
    * <p>See http_get() for a full list of returned info.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response.</p>
    * @link http://php.net/manual/en/httprequest.getresponseinfo.php
    * @param string $name <p>
    * the info to read; if empty or omitted, an associative array containing all available info will be 
    * returned
    * </p>
    * @return mixed Returns either a scalar containing the value of the info matching name if requested, FALSE on 
    * failure, or an associative array containing all available info.
    */
   public function getResponseInfo ($name) { }
   /**
    * <p>Get the full response as HttpMessage object after the request has been sent.</p>
    * <p>If redirects were allowed and several responses were received, the data references the last received 
    * response. Use HttpMessage::getParentMessage() to access the data of previously received responses 
    * within this request cycle.</p>
    * @link http://php.net/manual/en/httprequest.getresponsemessage.php
    * @return HttpMessage Returns an HttpMessage object of the response.
    */
   public function getResponseMessage () { }
   /**
    * Get the response status (i.e. the string after the response code) after the message has been sent.
    * @link http://php.net/manual/en/httprequest.getresponsestatus.php
    * @return string Returns a string containing the response status text.
    */
   public function getResponseStatus () { }
   /**
    * Get previously set SSL options.
    * @link http://php.net/manual/en/httprequest.getssloptions.php
    * @return array Returns an associative array containing any previously set SSL options.
    */
   public function getSslOptions () { }
   /**
    * Get the previously set request URL.
    * @link http://php.net/manual/en/httprequest.geturl.php
    * @return string Returns the currently set request url as string.
    */
   public function getUrl () { }
   /**
    * <p>Reset all automatically received/sent cookies.</p>
    * <p>Note that custom set cookies are not affected.</p>
    * @link http://php.net/manual/en/httprequest.resetcookies.php
    * @param bool $session_only <p>
    * whether only session cookies should be reset (needs libcurl >= v7.15.4, else libcurl >= v7.14.1)
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function resetCookies ($session_only = false) { }
   /**
    * <p>Send the HTTP request.</p>
    * <p>While an exception may be thrown, the transfer could have succeeded at least partially, so you might 
    * want to check the return values of various HttpRequest::getResponse*() methods.</p>
    * @link http://php.net/manual/en/httprequest.send.php
    * @return HttpMessage Returns the received response as HttpMessage object.
    */
   public function send () { }
   /**
    * Set request body to send, overwriting previously set request body.
    * @link http://php.net/manual/en/httprequest.setbody.php
    * @param string $request_body_data <p>
    * The request body to overwrite the existing request body with. Caution Ensure that a Content-Type is 
    * specified in the request body.
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   function setBody ($request_body_data) { }
   /**
    * Set the content type the post request should have.
    * @link http://php.net/manual/en/httprequest.setcontenttype.php
    * @param string $content_type <p>
    * the content type of the request (primary/secondary)
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the content type does not seem to contain a primary and a 
    * secondary part.
    */
   public function setContentType ($content_type) { }
   /**
    * Set custom cookies.
    * @link http://php.net/manual/en/httprequest.setcookies.php
    * @param array $cookies <p>
    * an associative array as parameter containing cookie name/value pairs; if empty or omitted, all 
    * previously set cookies will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setCookies ($cookies) { }
   /**
    * Set request header name/value pairs.
    * @link http://php.net/manual/en/httprequest.setheaders.php
    * @param array $headers <p>
    * an associative array as parameter containing header name/value pairs; if empty or omitted, all 
    * previously set headers will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setHeaders ($headers) { }
   /**
    * Set the request method.
    * @link http://php.net/manual/en/httprequest.setmethod.php
    * @param int $request_method <p>
    * the request method to use
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setMethod ($request_method) { }
   /**
    * <p>Set the request options to use.</p>
    * <p>See the full list of request options.</p>
    * @link http://php.net/manual/en/httprequest.setoptions.php
    * @param array $options <p>
    * an associative array, which values will overwrite the currently set request options; if empty or 
    * omitted, the options of the HttpRequest object will be reset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setOptions ($options) { }
   /**
    * <p>Set the POST data entries, overwriting previously set POST data.</p>
    * <p>Affects only POST and custom requests.</p>
    * @link http://php.net/manual/en/httprequest.setpostfields.php
    * @param array $post_data <p>
    * an associative array containing the post fields; if empty, the post data will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setPostFields ($post_data) { }
   /**
    * <p>Set files to post, overwriting previously set post files.</p>
    * <p>Affects only POST and requests. Cannot be used with raw post data.</p>
    * @link http://php.net/manual/en/httprequest.setpostfiles.php
    * @param array $post_files <p>
    * an array containing the files to post; if empty, the post files will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setPostFiles ($post_files) { }
   /**
    * <p>Set PUT data to send, overwriting previously set PUT data.</p>
    * <p>Affects only PUT requests.</p>
    * <p>Only either PUT data or PUT file can be used for each request. PUT data has higher precedence and 
    * will be used even if a PUT file is set.</p>
    * @link http://php.net/manual/en/httprequest.setputdata.php
    * @param string $put_data <p>
    * the data to upload
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setPutData ($put_data) { }
   /**
    * Set file to put. Affects only PUT requests.
    * @link http://php.net/manual/en/httprequest.setputfile.php
    * @param string $file <p>
    * the path to the file to send; if empty or omitted the put file will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setPutFile ($file = "") { }
   /**
    * <p>Set the URL query parameters to use, overwriting previously set query parameters.</p>
    * <p>Affects any request types.</p>
    * @link http://php.net/manual/en/httprequest.setquerydata.php
    * @param mixed $query_data <p>
    * a string or associative array parameter containing the pre-encoded query string or to be encoded 
    * query fields; if empty, the query data will be unset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setQueryData ($query_data) { }
   /**
    * <p>Set raw post data to send, overwriting previously set raw post data. Don't forget to specify a 
    * content type. Affects only POST and custom requests.</p>
    * <p>Only either post fields or raw post data can be used for each request. Raw post data has higher 
    * precedence and will be used even if post fields are set.</p>
    * @link http://php.net/manual/en/httprequest.setrawpostdata.php
    * @param string $raw_post_data <p>
    * raw post data
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setRawPostData ($raw_post_data) { }
   /**
    * Set SSL options.
    * @link http://php.net/manual/en/httprequest.setssloptions.php
    * @param array $options <p>
    * an associative array containing any SSL specific options; if empty or omitted, the SSL options will 
    * be reset
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setSslOptions ($options) { }
   /**
    * Set the request URL.
    * @link http://php.net/manual/en/httprequest.seturl.php
    * @param string $url <p>
    * the request url
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setUrl ($url) { }
}

/**
 * The HttpRequestPool class 
 */
class HttpRequestPool implements Iterator, Countable 
{
   /**
    * <p>Attach an HttpRequest object to this HttpRequestPool.</p>
    * <p>Set all options prior attaching!</p>
    * @link http://php.net/manual/en/httprequestpool.attach.php
    * @param HttpRequest $request <p>
    * an HttpRequest object not already attached to any HttpRequestPool object
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function attach ($request) { }
   /**
    * <p>Instantiate a new HttpRequestPool object. An HttpRequestPool is able to send several HttpRequests in 
    * parallel.</p>
    * <p>Accepts virtually infinite optional parameters each referencing an HttpRequest object.</p>
    * @link http://php.net/manual/en/httprequestpool.construct.php
    * @param HttpRequest $request <p>
    * HttpRequest object to attach
    * </p>
    * @param HttpRequest $_ <p>
    * 
    * </p>
    * @return void 
    */
   public function __construct ($request, $_) { }
   /**
    * Clean up HttpRequestPool object.
    * @link http://php.net/manual/en/httprequestpool.destruct.php
    * @return void 
    */
   function __destruct () { }
   /**
    * Detach an HttpRequest object from this HttpRequestPool.
    * @link http://php.net/manual/en/httprequestpool.detach.php
    * @param HttpRequest $request <p>
    * an HttpRequest object attached to this HttpRequestPool object
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   function detach ($request) { }
   /**
    * Get attached HttpRequest objects.
    * @link http://php.net/manual/en/httprequestpool.getattachedrequests.php
    * @return array Returns an array containing all currently attached HttpRequest objects.
    */
   function getAttachedRequests () { }
   /**
    * Get attached HttpRequest objects that already have finished their work.
    * @link http://php.net/manual/en/httprequestpool.getfinishedrequests.php
    * @return array Returns an array containing all attached HttpRequest objects that already have finished their work.
    */
   function getFinishedRequests () { }
   /**
    * Detach all attached HttpRequest objects.
    * @link http://php.net/manual/en/httprequestpool.reset.php
    * @return void 
    */
   function reset () { }
   /**
    * Send all attached HttpRequest objects in parallel.
    * @link http://php.net/manual/en/httprequestpool.send.php
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   function send () { }
   /**
    * Returns TRUE until each request has finished its transaction.
    * @link http://php.net/manual/en/httprequestpool.socketperform.php
    * @return bool Returns TRUE until each request has finished its transaction.
    */
   protected function socketPerform () { }
   /**
    * Perform socket select
    * @link http://php.net/manual/en/httprequestpool.socketselect.php
    * @param float $timeout <p>
    * 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   protected function socketSelect ($timeout = 0) { }
}

/**
 * The HttpResponse
 */
class HttpResponse 
{
   /**
    * guess applicable redirect method
    * @var integer
    */
   const REDIRECT = 0;

   /**
    * permanent redirect (301 Moved permanently)
    * @var integer
    */
   const REDIRECT_PERM = 0;

   /**
    * standard redirect (302 Found)
    * @var integer
    */
   const REDIRECT_FOUND = 0;

   /**
    * redirect applicable to POST requests (303 See other)
    * @var integer
    */
   const REDIRECT_POST = 0;

   /**
    * proxy redirect (305 Use proxy)
    * @var integer
    */
   const REDIRECT_PROXY = 0;

   /**
    * temporary redirect (307 Temporary Redirect)
    * @var integer
    */
   const REDIRECT_TEMP = 0;
   /**
    * whether caching the response should be attempted
    * @var boolean
    */
   protected static $cache = true;

   /**
    * whether the sent entity should be gzip'ed on the fly
    * @var boolean
    */
   protected static $gzip = true;

   /**
    * the generated or custom ETag
    * @var string
    */
   protected static $eTag = "";

   /**
    * the generated or custom timestamp of last modification
    * @var integer
    */
   protected static $lastModified = 0;

   /**
    * Cache-Control setting
    * @var string
    */
   protected static $cacheControl = "";

   /**
    * the Content-Type of the sent entity
    * @var string
    */
   protected static $contentType = "";

   /**
    * the Content-Disposition of the sent entity
    * @var string
    */
   protected static $contentDisposition = "";

   /**
    * the chunk buffer size used for throttling
    * @var integer
    */
   protected static $bufferSize = 0;

   /**
    * the seconds to delay when throttling
    * @var double
    */
   protected static $throttleDelay = 0.0;
   /**
    * Capture script output.
    * @link http://php.net/manual/en/httpresponse.capture.php
    * @return void 
    */
   static function capture () { }
   /**
    * Get current buffer size.
    * @link http://php.net/manual/en/httpresponse.getbuffersize.php
    * @return int Returns an int representing the current buffer size in bytes.
    */
   static function getBufferSize () { }
   /**
    * Get current caching setting.
    * @link http://php.net/manual/en/httpresponse.getcache.php
    * @return bool Returns TRUE if caching should be attempted, else FALSE.
    */
   static function getCache () { }
   /**
    * Get current caching setting.
    * @link http://php.net/manual/en/httpresponse.getcache.php
    * @return bool Returns TRUE if caching should be attempted, else FALSE.
    */
   static function getCache () { }
   /**
    * Get current Content-Disposition setting.
    * @link http://php.net/manual/en/httpresponse.getcontentdisposition.php
    * @return string Returns the current content disposition as string like sent in a header.
    */
   static function getContentDisposition () { }
   /**
    * Get current Content-Type header setting.
    * @link http://php.net/manual/en/httpresponse.getcontenttype.php
    * @return string Returns the currently set content type as string.
    */
   static function getContentType () { }
   /**
    * Get the previously set data to be sent.
    * @link http://php.net/manual/en/httpresponse.getdata.php
    * @return string Returns a string containing the previously set data to send.
    */
   static function getData () { }
   /**
    * Get calculated or previously set custom ETag.
    * @link http://php.net/manual/en/httpresponse.getetag.php
    * @return string Returns the calculated or previously set ETag as unquoted string.
    */
   static function getETag () { }
   /**
    * Get the previously set file to be sent.
    * @link http://php.net/manual/en/httpresponse.getfile.php
    * @return string Returns the previously set path to the file to send as string.
    */
   static function getFile () { }
   /**
    * Get current gzip'ing setting.
    * @link http://php.net/manual/en/httpresponse.getgzip.php
    * @return bool Returns TRUE if GZip compression is enabled, else FALSE.
    */
   static function getGzip () { }
   /**
    * <p>Get header(s) about to be sent.</p>
    * <p>This may not work as expected with the following SAPI(s): Apache2 w/PHP < 5.1.3.</p>
    * @link http://php.net/manual/en/httpresponse.getheader.php
    * @param string $name <p>
    * specifies the name of the header to read; if empty or omitted, an associative array with all headers 
    * will be returned
    * </p>
    * @return mixed Returns either a string containing the value of the header matching name, FALSE on failure, or an 
    * associative array with all headers.
    */
   static function getHeader ($name) { }
   /**
    * Get calculated or previously set custom Last-Modified date.
    * @link http://php.net/manual/en/httpresponse.getlastmodified.php
    * @return int Returns the calculated or previously set Unix timestamp.
    */
   static function getLastModified () { }
   /**
    * This function is an alias of: http_get_request_body().
    * @link http://php.net/manual/en/httpresponse.getrequestbody.php
    * @return string 
    */
   static function getRequestBody () { }
   /**
    * This function is an alias of: http_get_request_body_stream().
    * @link http://php.net/manual/en/httpresponse.getrequestbodystream.php
    * @return resource 
    */
   static function getRequestBodyStream () { }
   /**
    * This function is an alias of: http_get_request_headers().
    * @link http://php.net/manual/en/httpresponse.getrequestheaders.php
    * @return array 
    */
   static function getRequestHeaders () { }
   /**
    * Get the previously set resource to be sent.
    * @link http://php.net/manual/en/httpresponse.getstream.php
    * @return resource Returns the previously set resource.
    */
   static function getStream () { }
   /**
    * Get the current throttle delay.
    * @link http://php.net/manual/en/httpresponse.getthrottledelay.php
    * @return float Returns a double representing the throttle delay in seconds.
    */
   static function getThrottleDelay () { }
   /**
    * <p>Attempts to guess the content type of supplied payload through libmagic.</p>
    * <p>If the attempt is successful, the guessed Content-Type will automatically be set as response 
    * Content-Type.</p>
    * @link http://php.net/manual/en/httpresponse.guesscontenttype.php
    * @param string $magic_file <p>
    * specifies the magic.mime database to use
    * </p>
    * @param int $magic_mode <p>
    * flags for libmagic
    * </p>
    * @return string Returns the guessed content type on success or FALSE on failure.
    */
   static function guessContentType ($magic_file, $magic_mode = MAGIC_MIME) { }
   /**
    * This function is an alias of: http_redirect().
    * @link http://php.net/manual/en/httpresponse.redirect.php
    * @param string $url <p>
    * 
    * </p>
    * @param array $params <p>
    * 
    * </p>
    * @param bool $session <p>
    * 
    * </p>
    * @param int $status <p>
    * 
    * </p>
    * @return void 
    */
   static function redirect ($url, $params, $session = false, $status) { }
   /**
    * <p>Finally send the entity.</p>
    * <p>A successful caching attempt will exit PHP, and write a log entry if the INI setting http.log.cache 
    * is set. See the INI setting http.force_exit for what "exits" means.</p>
    * @link http://php.net/manual/en/httpresponse.send.php
    * @param bool $clean_ob <p>
    * whether to destroy all previously started output handlers and their buffers
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function send ($clean_ob = true) { }
   /**
    * <p>Sets the send buffer size of the throttling mechanism.</p>
    * <p>This may not work as expected with the following SAPI(s): FastCGI.</p>
    * @link http://php.net/manual/en/httpresponse.setbuffersize.php
    * @param int $bytes <p>
    * the chunk size in bytes
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setBufferSize ($bytes) { }
   /**
    * <p>Whether it should be attempted to cache the entity.</p>
    * <p>This will result in necessary caching headers and checks of clients If-Modified-Since and 
    * If-None-Match headers. If one of those headers matches a 304 Not Modified status code will be 
    * issued.</p>
    * <p>If you're using sessions, be sure that you set session.cache_limiter to something more appropriate 
    * than "no-cache"!</p>
    * @link http://php.net/manual/en/httpresponse.setcache.php
    * @param bool $cache <p>
    * whether caching should be attempted
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setCache ($cache) { }
   /**
    * Define a custom Cache-Control header, usually being private or public;
    * @link http://php.net/manual/en/httpresponse.setcachecontrol.php
    * @param string $control <p>
    * the primary cache control setting
    * </p>
    * @param int $max_age <p>
    * the max-age in seconds, suggesting how long the cache entry is valid on the client side
    * </p>
    * @param bool $must_revalidate <p>
    * whether the cached entity should be revalidated by the client for every request
    * </p>
    * @return bool Returns TRUE on success, or FALSE if control does not match one of public, private or no-cache.
    */
   static function setCacheControl ($control, $max_age = 0, $must_revalidate = true) { }
   /**
    * Set the Content-Disposition. The Content-Disposition header is very useful if the data actually 
    * being sent came from a file or something similar, that should be "saved" by the client/user (i.e. by 
    * the browser's "Save as..." popup window).
    * @link http://php.net/manual/en/httpresponse.setcontentdisposition.php
    * @param string $filename <p>
    * the file name the "Save as..." dialog should display
    * </p>
    * @param bool $inline <p>
    * if set to true and the user agent knows how to handle the content type, it will probably not cause 
    * the popup window to be shown
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setContentDisposition ($filename, $inline = false) { }
   /**
    * Set the Content-Type of the sent entity.
    * @link http://php.net/manual/en/httpresponse.setcontenttype.php
    * @param string $content_type <p>
    * the content type of the sent entity (primary/secondary)
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the content type does not seem to contain a primary and 
    * secondary content type part.
    */
   static function setContentType ($content_type) { }
   /**
    * Set the data to be sent.
    * @link http://php.net/manual/en/httpresponse.setdata.php
    * @param mixed $data <p>
    * data to send
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setData ($data) { }
   /**
    * Set a custom ETag. Use this only if you know what you're doing.
    * @link http://php.net/manual/en/httpresponse.setetag.php
    * @param string $etag <p>
    * unquoted string as parameter containing the ETag
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setETag ($etag) { }
   /**
    * Set the file to be sent.
    * @link http://php.net/manual/en/httpresponse.setfile.php
    * @param string $file <p>
    * the path to the file to send
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setFile ($file) { }
   /**
    * Enable on-thy-fly gzip'ing of the sent entity.
    * @link http://php.net/manual/en/httpresponse.setgzip.php
    * @param bool $gzip <p>
    * whether GZip compression should be enabled
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setGzip ($gzip) { }
   /**
    * Send an HTTP header.
    * @link http://php.net/manual/en/httpresponse.setheader.php
    * @param string $name <p>
    * the name of the header
    * </p>
    * @param mixed $value <p>
    * the value of the header; if not set, no header with this name will be sent
    * </p>
    * @param bool $replace <p>
    * whether an existing header should be replaced
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setHeader ($name, $value, $replace = true) { }
   /**
    * Set a custom Last-Modified date.
    * @link http://php.net/manual/en/httpresponse.setlastmodified.php
    * @param int $timestamp <p>
    * Unix timestamp representing the last modification time of the sent entity
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setLastModified ($timestamp) { }
   /**
    * Set the resource to be sent.
    * @link http://php.net/manual/en/httpresponse.setstream.php
    * @param resource $stream <p>
    * already opened stream from which the data to send will be read
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setStream ($stream) { }
   /**
    * <p>Sets the throttle delay.</p>
    * <p>This may not work as expected with the following SAPI(s): FastCGI.</p>
    * @link http://php.net/manual/en/httpresponse.setthrottledelay.php
    * @param float $seconds <p>
    * seconds to sleep after each chunk sent
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   static function setThrottleDelay ($seconds) { }
   /**
    * This function is an alias of: http_send_status().
    * @link http://php.net/manual/en/httpresponse.status.php
    * @param int $status <p>
    * 
    * </p>
    * @return bool 
    */
   static function status ($status) { }
}

/**
 * <p>Attempts to cache the sent entity by its ETag, either supplied or generated by the hash algorithm 
 * specified by the INI setting http.etag.mode.</p>
 * <p>If the clients If-None-Match header matches the supplied/calculated ETag, the body is considered 
 * cached on the clients side and a 304 Not Modified status code is issued.</p>
 * <p>A log entry is written to the cache log if the INI setting http.log.cache is set and the cache 
 * attempt was successful.</p>
 * <p>If this function is used outside the http_send_*() API, it facilitates the ob_etaghandler().</p>
 * @link http://php.net/manual/en/function.http-cache-etag.php
 * @param string $etag <p>
 * custom ETag
 * </p>
 * @return bool Returns FALSE or exits on success with 304 Not Modified if the entity is cached. See the INI setting 
 * http.force_exit for what "exits" means.
 */
function http_cache_etag ($etag) { }

/**
 * <p>Attempts to cache the sent entity by its last modification date.</p>
 * <p>If the supplied argument is greater than 0, it is handled as timestamp and will be sent as date of 
 * last modification. If it is 0 or omitted, the current time will be sent as Last-Modified date. If 
 * it's negative, it is handled as expiration time in seconds, which means that if the requested last 
 * modification date is not between the calculated timespan, the Last-Modified header is updated and 
 * the actual body will be sent.</p>
 * <p>A log entry will be written to the cache log if the INI setting http.log.cache is set and the cache 
 * attempt was successful.</p>
 * @link http://php.net/manual/en/function.http-cache-last-modified.php
 * @param int $timestamp_or_expires <p>
 * Unix timestamp
 * </p>
 * @return bool Returns FALSE or exits on success with 304 Not Modified if the entity is cached. See the INI setting 
 * http.force_exit for what "exits" means.
 */
function http_cache_last_modified ($timestamp_or_expires) { }

/**
 * Decodes a string which is HTTP-chunked encoded.
 * @link http://php.net/manual/en/function.http-chunked-decode.php
 * @param string $encoded <p>
 * chunked encoded string
 * </p>
 * @return string Returns the decoded string on success or FALSE on failure.
 */
function http_chunked_decode ($encoded) { }

/**
 * <p>Compress data with gzip, zlib AKA deflate or raw deflate encoding.</p>
 * <p>See the deflate constants table for possible values for the flags parameter.</p>
 * @link http://php.net/manual/en/function.http-deflate.php
 * @param string $data <p>
 * String containing the data that should be encoded
 * </p>
 * @param int $flags <p>
 * deflate options
 * </p>
 * @return string Returns the encoded string on success, or NULL on failure.
 */
function http_deflate ($data, $flags = 0) { }

/**
 * Decompress data compressed with either gzip, deflate AKA zlib or raw deflate encoding.
 * @link http://php.net/manual/en/function.http-inflate.php
 * @param string $data <p>
 * string containing the compressed data
 * </p>
 * @return string Returns the decoded string on success, or NULL on failure.
 */
function http_inflate ($data) { }

/**
 * Build a cookie string from an array/object like returned by http_parse_cookie().
 * @link http://php.net/manual/en/function.http-build-cookie.php
 * @param array $cookie <p>
 * a cookie list like returned from http_parse_cookie()
 * </p>
 * @return string Returns the cookie(s) as string.
 */
function http_build_cookie ($cookie) { }

/**
 * Compose a valid HTTP date regarding RFC 1123 looking like: Wed, 22 Dec 2004 11:34:47 GMT.
 * @link http://php.net/manual/en/function.http-date.php
 * @param int $timestamp <p>
 * Unix timestamp; current time if omitted
 * </p>
 * @return string Returns the HTTP date as string.
 */
function http_date ($timestamp) { }

/**
 * <p>Create a stream to read the raw request body (e.g. POST or PUT data).</p>
 * <p>This function can only be used once if the request method was another than POST.</p>
 * @link http://php.net/manual/en/function.http-get-request-body-stream.php
 * @return resource Returns the raw request body as stream on success or NULL on failure.
 */
function http_get_request_body_stream () { }

/**
 * <p>Get the raw request body (e.g. POST or PUT data).</p>
 * <p>This function can not be used after http_get_request_body_stream() if the request method was another 
 * than POST.</p>
 * @link http://php.net/manual/en/function.http-get-request-body.php
 * @return string Returns the raw request body as string on success or NULL on failure.
 */
function http_get_request_body () { }

/**
 * Get a list of incoming HTTP headers.
 * @link http://php.net/manual/en/function.http-get-request-headers.php
 * @return array Returns an associative array of incoming request headers.
 */
function http_get_request_headers () { }

/**
 * Matches the given ETag against the clients If-Match resp. If-None-Match HTTP headers.
 * @link http://php.net/manual/en/function.http-match-etag.php
 * @param string $etag <p>
 * the ETag to match
 * </p>
 * @param bool $for_range <p>
 * if set to TRUE, the header usually used to validate HTTP ranges will be checked
 * </p>
 * @return bool Returns TRUE if ETag matches or the header contained the asterisk ("*"), else FALSE.
 */
function http_match_etag ($etag, $for_range = false) { }

/**
 * Matches the given Unix timestamp against the clients If-Modified-Since resp. If-Unmodified-Since 
 * HTTP headers.
 * @link http://php.net/manual/en/function.http-match-modified.php
 * @param int $timestamp <p>
 * Unix timestamp; current time, if omitted
 * </p>
 * @param bool $for_range <p>
 * if set to TRUE, the header usually used to validate HTTP ranges will be checked
 * </p>
 * @return bool Returns TRUE if timestamp represents an earlier date than the header, else FALSE.
 */
function http_match_modified ($timestamp = -1, $for_range = false) { }

/**
 * Match an incoming HTTP header.
 * @link http://php.net/manual/en/function.http-match-request-header.php
 * @param string $header <p>
 * the header name (case-insensitive)
 * </p>
 * @param string $value <p>
 * the header value that should be compared
 * </p>
 * @param bool $match_case <p>
 * whether the value should be compared case sensitively
 * </p>
 * @return bool Returns TRUE if header value matches, else FALSE.
 */
function http_match_request_header ($header, $value, $match_case = false) { }

/**
 * <p>Check for features that require external libraries.</p>
 * <p>See the feature support constants table for possible values for the feature argument.</p>
 * @link http://php.net/manual/en/function.http-support.php
 * @param int $feature <p>
 * feature to probe for
 * </p>
 * @return int Returns integer, whether requested feature is supported, or a bitmask with all supported features if 
 * feature was omitted.
 */
function http_support ($feature = 0) { }

/**
 * This function negotiates the clients preferred charset based on its Accept-Charset HTTP header. The 
 * qualifier is recognized and charsets without qualifier are rated highest.
 * @link http://php.net/manual/en/function.http-negotiate-charset.php
 * @param array $supported <p>
 * array containing the supported charsets as values
 * </p>
 * @param array &$result <p>
 * will be filled with an array containing the negotiation results
 * </p>
 * @return string Returns the negotiated charset or the default charset (i.e. first array entry) if none match.
 */
function http_negotiate_charset ($supported, &$result) { }

/**
 * This function negotiates the clients preferred content type based on its Accept HTTP header. The 
 * qualifier is recognized and content types without qualifier are rated highest.
 * @link http://php.net/manual/en/function.http-negotiate-content-type.php
 * @param array $supported <p>
 * array containing the supported content types as values
 * </p>
 * @param array &$result <p>
 * will be filled with an array containing the negotiation results
 * </p>
 * @return string Returns the negotiated content type or the default content type (i.e. first array entry) if none 
 * match.
 */
function http_negotiate_content_type ($supported, &$result) { }

/**
 * This function negotiates the clients preferred language based on its Accept-Language HTTP header. 
 * The qualifier is recognized and languages without qualifier are rated highest. The qualifier will be 
 * decreased by 10% for partial matches (i.e. matching primary language).
 * @link http://php.net/manual/en/function.http-negotiate-language.php
 * @param array $supported <p>
 * array containing the supported languages as values
 * </p>
 * @param array &$result <p>
 * will be filled with an array containing the negotiation results
 * </p>
 * @return string Returns the negotiated language or the default language (i.e. first array entry) if none match.
 */
function http_negotiate_language ($supported, &$result) { }

/**
 * <p>For use with ob_start().</p>
 * <p>The deflate output buffer handler can only be used once.</p>
 * <p>It conflicts with ob_gzhandler() and zlib.output_compression as well and should not be used after 
 * mbstring extension's mb_output_handler() and session extension's URL-Rewriter (AKA 
 * session.use_trans_sid).</p>
 * @link http://php.net/manual/en/function.ob-deflatehandler.php
 * @param string $data <p>
 * 
 * </p>
 * @param int $mode <p>
 * 
 * </p>
 * @return string 
 */
function ob_deflatehandler ($data, $mode) { }

/**
 * <p>For use with ob_start().</p>
 * <p>Output buffer handler generating an ETag with the hash algorithm specified with the INI setting 
 * http.etag.mode.</p>
 * <p>This output handler is used by http_cache_etag().</p>
 * @link http://php.net/manual/en/function.ob-etaghandler.php
 * @param string $data <p>
 * 
 * </p>
 * @param int $mode <p>
 * 
 * </p>
 * @return string 
 */
function ob_etaghandler ($data, $mode) { }

/**
 * <p>For use with ob_start().</p>
 * <p>Same restrictions as with ob_deflatehandler() apply.</p>
 * @link http://php.net/manual/en/function.ob-inflatehandler.php
 * @param string $data <p>
 * 
 * </p>
 * @param int $mode <p>
 * 
 * </p>
 * @return string 
 */
function ob_inflatehandler ($data, $mode) { }

/**
 * Parses HTTP cookies like sent in a response into a struct.
 * @link http://php.net/manual/en/function.http-parse-cookie.php
 * @param string $cookie <p>
 * string containing the value of a Set-Cookie response header
 * </p>
 * @param int $flags <p>
 * parse flags (HTTP_COOKIE_PARSE_RAW)
 * </p>
 * @param array $allowed_extras <p>
 * array containing recognized extra keys; by default all unknown keys will be treated as cookie names
 * </p>
 * @return object Returns a stdClass object on success or FALSE on failure.
 */
function http_parse_cookie ($cookie, $flags, $allowed_extras) { }

/**
 * Parses HTTP headers into an associative array.
 * @link http://php.net/manual/en/function.http-parse-headers.php
 * @param string $header <p>
 * string containing HTTP headers
 * </p>
 * @return array Returns an array on success or FALSE on failure.
 */
function http_parse_headers ($header) { }

/**
 * Parses the HTTP message into a simple recursive object.
 * @link http://php.net/manual/en/function.http-parse-message.php
 * @param string $message <p>
 * string containing a single HTTP message or several consecutive HTTP messages
 * </p>
 * @return object Returns a hierarchical object structure of the parsed messages.
 */
function http_parse_message ($message) { }

/**
 * <p>Parse parameter list.</p>
 * <p>See the params parsing constants table for possible values of the flags argument.</p>
 * @link http://php.net/manual/en/function.http-parse-params.php
 * @param string $param <p>
 * Parameters
 * </p>
 * @param int $flags <p>
 * Parse flags
 * </p>
 * @return object Returns parameter list as stdClass object.
 */
function http_parse_params ($param, $flags = HTTP_PARAMS_DEFAULT) { }

/**
 * Clean up (close) persistent handles, optionally identified with ident.
 * @link http://php.net/manual/en/function.http-persistent-handles-clean.php
 * @param string $ident <p>
 * the identification string
 * </p>
 * @return void
 */
function http_persistent_handles_clean ($ident) { }

/**
 * List statistics about persistent handles usage.
 * @link http://php.net/manual/en/function.http-persistent-handles-count.php
 * @return object Returns persistent handles statistics as stdClass object on success or FALSE on failure.
 */
function http_persistent_handles_count () { }

/**
 * Query or define the ident of persistent handles.
 * @link http://php.net/manual/en/function.http-persistent-handles-ident.php
 * @param string $ident <p>
 * the identification string
 * </p>
 * @return string Returns the prior ident as string on success or FALSE on failure.
 */
function http_persistent_handles_ident ($ident) { }

/**
 * <p>Performs an HTTP GET request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-get.php
 * @param string $url <p>
 * URL
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Will be filled with request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_get ($url, $options, &$info) { }

/**
 * <p>Performs an HTTP HEAD request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-head.php
 * @param string $url <p>
 * URL
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_head ($url, $options, &$info) { }

/**
 * <p>Performs an HTTP POST request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-post-data.php
 * @param string $url <p>
 * URL
 * </p>
 * @param string $data <p>
 * String containing the pre-encoded post data
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_post_data ($url, $data, $options, &$info) { }

/**
 * <p>Performs an HTTP POST request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-post-fields.php
 * @param string $url <p>
 * URL
 * </p>
 * @param array $data <p>
 * Associative array of POST values
 * </p>
 * @param array $files <p>
 * Array of files to post
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_post_fields ($url, $data, $files, $options, &$info) { }

/**
 * <p>Performs an HTTP PUT request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-put-data.php
 * @param string $url <p>
 * URL
 * </p>
 * @param string $data <p>
 * PUT request body
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_put_data ($url, $data, $options, &$info) { }

/**
 * <p>Performs an HTTP PUT request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-put-file.php
 * @param string $url <p>
 * URL
 * </p>
 * @param string $file <p>
 * The file to put
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_put_file ($url, $file, $options, &$info) { }

/**
 * <p>Performs an HTTP PUT request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-put-stream.php
 * @param string $url <p>
 * URL
 * </p>
 * @param resource $stream <p>
 * The stream to read the PUT request body from
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_put_stream ($url, $stream, $options, &$info) { }

/**
 * Generate x-www-form-urlencoded resp. form-data encoded request body.
 * @link http://php.net/manual/en/function.http-request-body-encode.php
 * @param array $fields <p>
 * POST fields
 * </p>
 * @param array $files <p>
 * POST files
 * </p>
 * @return string Returns encoded string on success or FALSE on failure.
 */
function http_request_body_encode ($fields, $files) { }

/**
 * Check if a request method is registered (or available by default).
 * @link http://php.net/manual/en/function.http-request-method-exists.php
 * @param mixed $method <p>
 * request method name or ID
 * </p>
 * @return int Returns TRUE if the request method is known, else FALSE.
 */
function http_request_method_exists ($method) { }

/**
 * Get the literal string representation of a standard or registered request method.
 * @link http://php.net/manual/en/function.http-request-method-name.php
 * @param int $method <p>
 * request method ID
 * </p>
 * @return string Returns the request method name as string on success or FALSE on failure.
 */
function http_request_method_name ($method) { }

/**
 * Register a custom request method.
 * @link http://php.net/manual/en/function.http-request-method-register.php
 * @param string $method <p>
 * the request method name to register
 * </p>
 * @return int Returns the ID of the request method on success or FALSE on failure.
 */
function http_request_method_register ($method) { }

/**
 * Unregister a previously registered custom request method.
 * @link http://php.net/manual/en/function.http-request-method-unregister.php
 * @param mixed $method <p>
 * The request method name or ID
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_request_method_unregister ($method) { }

/**
 * <p>Performs a custom HTTP request on the supplied url.</p>
 * <p>See the full list of request options.</p>
 * @link http://php.net/manual/en/function.http-request.php
 * @param int $method <p>
 * Request method
 * </p>
 * @param string $url <p>
 * URL
 * </p>
 * @param string $body <p>
 * Request body
 * </p>
 * @param array $options <p>
 * request options
 * </p>
 * @param array &$info <p>
 * Request/response information
 * </p>
 * @return string Returns the HTTP response(s) as string on success, or FALSE on failure.
 */
function http_request ($method, $url, $body, $options, &$info) { }

/**
 * <p>Redirect to the given url.</p>
 * <p>The supplied url will be expanded with http_build_url(), the params array will be treated with 
 * http_build_str() and the session identification will be appended if session is true. The HTTP 
 * response code will be set according to status. You can use one of the redirect constants for 
 * convenience. Please see » RFC 2616 for which redirect response code to use in which situation. By 
 * default PHP will decide which response status fits best.</p>
 * <p>To be RFC compliant, "Redirecting to <a>URL</a>." will be displayed, if the client doesn't redirect 
 * immediately, and the request method was another one than HEAD.</p>
 * <p>A log entry will be written to the redirect log, if the INI setting http.log.redirect is set and the 
 * redirect attempt was successful.</p>
 * @link http://php.net/manual/en/function.http-redirect.php
 * @param string $url <p>
 * the URL to redirect to
 * </p>
 * @param array $params <p>
 * associative array of query parameters
 * </p>
 * @param bool $session <p>
 * whether to append session information
 * </p>
 * @param int $status <p>
 * custom response status code
 * </p>
 * @return bool Returns FALSE or exits on success with the specified redirection status code. See the INI setting 
 * http.force_exit for what "exits" means.
 */
function http_redirect ($url, $params, $session = false, $status = 0) { }

/**
 * Send the Content-Disposition. The Content-Disposition header is very useful if the data actually 
 * being sent came from a file or something similar, that should be "saved" by the client/user (i.e. by 
 * the browser's "Save as..." popup window).
 * @link http://php.net/manual/en/function.http-send-content-disposition.php
 * @param string $filename <p>
 * the file name the "Save as..." dialog should display
 * </p>
 * @param bool $inline <p>
 * if set to TRUE and the user agent knows how to handle the content type, it will probably not cause 
 * the popup window to be shown
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_content_disposition ($filename, $inline = false) { }

/**
 * Send the Content-Type of the sent entity.
 * @link http://php.net/manual/en/function.http-send-content-type.php
 * @param string $content_type <p>
 * the desired content type (primary/secondary)
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_content_type ($content_type = "application/x-octetstream") { }

/**
 * Sends raw data with support for (multiple) range requests.
 * @link http://php.net/manual/en/function.http-send-data.php
 * @param string $data <p>
 * data to send
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_data ($data) { }

/**
 * <p>Sends a file with support for (multiple) range requests.</p>
 * <p>This functions behaviour and further action is dependent on the following INI settings: 
 * http.send.not_found_404 and http.log.not_found.</p>
 * <p>If the INI setting http.send.not_found_404 is enabled and the INI setting http.log.not_found points 
 * to a writable file, a log message is written when the file was not found.</p>
 * @link http://php.net/manual/en/function.http-send-file.php
 * @param string $file <p>
 * the file to send
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_file ($file) { }

/**
 * Send a Last-Modified header with a valid HTTP date.
 * @link http://php.net/manual/en/function.http-send-last-modified.php
 * @param int $timestamp <p>
 * a Unix timestamp, converted to a valid HTTP date; if omitted, the current time will be sent
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_last_modified ($timestamp = time()) { }

/**
 * Send HTTP status code.
 * @link http://php.net/manual/en/function.http-send-status.php
 * @param int $status <p>
 * HTTP status code (100-599)
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_status ($status) { }

/**
 * Sends an already opened stream with support for (multiple) range requests.
 * @link http://php.net/manual/en/function.http-send-stream.php
 * @param resource $stream <p>
 * stream to read from (must be seekable)
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function http_send_stream ($stream) { }

/**
 * <p>Sets the throttle delay and send buffer size.</p>
 * <p>This may not work as expected with the following SAPI(s): FastCGI.</p>
 * @link http://php.net/manual/en/function.http-throttle.php
 * @param float $sec <p>
 * seconds to sleep after each chunk sent
 * </p>
 * @param int $bytes <p>
 * the chunk size in bytes
 * </p>
 * @return void 
 */
function http_throttle ($sec, $bytes = 40960) { }

/**
 * Builds a query string from an array of query variables. In effect, this function is the opposite of 
 * parse_str().
 * @link http://php.net/manual/en/function.http-build-str.php
 * @param array $query <p>
 * associative array of query string parameters
 * </p>
 * @param string $prefix <p>
 * top level prefix
 * </p>
 * @param string $arg_separator <p>
 * argument separator to use (by default the INI setting arg_separator.output will be used, or "&" if 
 * neither is set
 * </p>
 * @return string Returns the built query as string on success or FALSE on failure.
 */
function http_build_str ($query, $prefix, $arg_separator = ini_get("arg_separator.output")) { }

/**
 * <p>Build a URL.</p>
 * <p>The parts of the second URL will be merged into the first according to the flags argument.</p>
 * @link http://php.net/manual/en/function.http-build-url.php
 * @param mixed $url <p>
 * (part(s) of) an URL in form of a string or associative array like parse_url() returns
 * </p>
 * @param mixed $parts <p>
 * same as the first argument
 * </p>
 * @param int $flags <p>
 * a bitmask of binary or'ed HTTP_URL constants; HTTP_URL_REPLACE is the default
 * </p>
 * @param array &$new_url <p>
 * if set, it will be filled with the parts of the composed url like parse_url() would return
 * </p>
 * @return string Returns the new URL as string on success or FALSE on failure.
 */
function http_build_url ($url, $parts, $flags = HTTP_URL_REPLACE, &$new_url) { }

/**
 * whether support to issue HTTP requests over SSL is given, ie. linked libcurl was built with SSL 
 * support
 * @var int
 */
define('HTTP_SUPPORT_SSLREQUESTS', 0);

/**
 * whether support for zlib encodings is given, ie. libz support was compiled in
 * @var int
 */
define('HTTP_SUPPORT_ENCODINGS', 0);

/**
 * whether support to guess the Content-Type of HTTP messages is given, ie. libmagic support was 
 * compiled in
 * @var int
 */
define('HTTP_SUPPORT_MAGICMIME', 0);

/**
 * whether support to issue HTTP requests is given, ie. libcurl support was compiled in
 * @var int
 */
define('HTTP_SUPPORT_REQUESTS', 0);

/**
 * querying for this constant will always return TRUE
 * @var int
 */
define('HTTP_SUPPORT', 0);

/**
 * all three values above, bitwise or'ed
 * @var int
 */
define('HTTP_PARAMS_DEFAULT', 0);

/**
 * raise PHP warnings on parse errors
 * @var int
 */
define('HTTP_PARAMS_RAISE_ERROR', 0);

/**
 * continue parsing after an error occurred
 * @var int
 */
define('HTTP_PARAMS_ALLOW_FAILURE', 0);

/**
 * allow commands additionally to semicolons as separator
 * @var int
 */
define('HTTP_PARAMS_ALLOW_COMMA', 0);

/**
 * whether "httpOnly" was found in the cookie's parameter list
 * @var int
 */
define('HTTP_COOKIE_HTTPONLY', 0);

/**
 * whether "secure" was found in the cookie's parameters list
 * @var int
 */
define('HTTP_COOKIE_SECURE', 0);

/**
 * don't urldecode values
 * @var int
 */
define('HTTP_COOKIE_PARSE_RAW', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_STRATEGY_FIXED', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_STRATEGY_RLE', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_STRATEGY_HUFF', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_STRATEGY_FILT', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_STRATEGY_DEF', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_TYPE_RAW', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_TYPE_GZIP', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_TYPE_ZLIB', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_LEVEL_MAX', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_LEVEL_MIN', 0);

/**
 * 
 * @var int
 */
define('HTTP_DEFLATE_LEVEL_DEF', 0);

/**
 * full data flush
 * @var int
 */
define('HTTP_ENCODING_STREAM_FLUSH_FULL', 0);

/**
 * synchronized flush only
 * @var int
 */
define('HTTP_ENCODING_STREAM_FLUSH_SYNC', 0);

/**
 * don't flush
 * @var int
 */
define('HTTP_ENCODING_STREAM_FLUSH_NONE', 0);

/**
 * querystring operation failure
 * @var int
 */
define('HTTP_E_QUERYSTRING', 0);

/**
 * invalid URL
 * @var int
 */
define('HTTP_E_URL', 0);

/**
 * response failure
 * @var int
 */
define('HTTP_E_RESPONSE', 0);

/**
 * socket exception
 * @var int
 */
define('HTTP_E_SOCKET', 0);

/**
 * request pool failure
 * @var int
 */
define('HTTP_E_REQUEST_POOL', 0);

/**
 * request failure
 * @var int
 */
define('HTTP_E_REQUEST', 0);

/**
 * encoding/decoding error
 * @var int
 */
define('HTTP_E_ENCODING', 0);

/**
 * with operation incompatible message type
 * @var int
 */
define('HTTP_E_MESSAGE_TYPE', 0);

/**
 * unknown/invalid request method
 * @var int
 */
define('HTTP_E_REQUEST_METHOD', 0);

/**
 * HTTP header parse error
 * @var int
 */
define('HTTP_E_MALFORMED_HEADERS', 0);

/**
 * header() or similar operation failed
 * @var int
 */
define('HTTP_E_HEADER', 0);

/**
 * an invalid parameter was passed
 * @var int
 */
define('HTTP_E_INVALID_PARAM', 0);

/**
 * runtime error
 * @var int
 */
define('HTTP_E_RUNTIME', 0);

/**
 * response style message
 * @var int
 */
define('HTTP_MSG_RESPONSE', 0);

/**
 * request style message
 * @var int
 */
define('HTTP_MSG_REQUEST', 0);

/**
 * the message is of no specific type
 * @var int
 */
define('HTTP_MSG_NONE', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_OBJECT', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_ARRAY', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_STRING', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_FLOAT', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_INT', 0);

/**
 * 
 * @var int
 */
define('HTTP_QUERYSTRING_TYPE_BOOL', 0);

/**
 * try any authentication scheme
 * @var int
 */
define('HTTP_AUTH_ANY', 0);

/**
 * use "GSS-NEGOTIATE" authentication
 * @var int
 */
define('HTTP_AUTH_GSSNEG', 0);

/**
 * use "NTLM" authentication
 * @var int
 */
define('HTTP_AUTH_NTLM', 0);

/**
 * use "digest" authentication
 * @var int
 */
define('HTTP_AUTH_DIGEST', 0);

/**
 * use "basic" authentication
 * @var int
 */
define('HTTP_AUTH_BASIC', 0);

/**
 * HTTP version 1.1
 * @var int
 */
define('HTTP_VERSION_1_1', 0);

/**
 * HTTP version 1.0
 * @var int
 */
define('HTTP_VERSION_1_0', 0);

/**
 * no specific HTTP protocol version
 * @var int
 */
define('HTTP_VERSION_ANY', 0);

/**
 * use SSLv2 only
 * @var int
 */
define('HTTP_SSL_VERSION_SSLv2', 0);

/**
 * use SSLv3 only
 * @var int
 */
define('HTTP_SSL_VERSION_SSLv3', 0);

/**
 * use TLSv1 only
 * @var int
 */
define('HTTP_SSL_VERSION_TLSv1', 0);

/**
 * no specific SSL protocol version
 * @var int
 */
define('HTTP_SSL_VERSION_ANY', 0);

/**
 * standard HTTP proxy
 * @var int
 */
define('HTTP_PROXY_HTTP', 0);

/**
 * the proxy is a SOCKS5 type proxy
 * @var int
 */
define('HTTP_PROXY_SOCKS5', 0);

/**
 * the proxy is a SOCKS4 type proxy
 * @var int
 */
define('HTTP_PROXY_SOCKS4', 0);

/**
 * use any IP mechanism only for name lookups
 * @var int
 */
define('HTTP_IPRESOLVE_ANY', 0);

/**
 * use IPv6 only for name lookups
 * @var int
 */
define('HTTP_IPRESOLVE_V6', 0);

/**
 * use IPv4 only for name lookups
 * @var int
 */
define('HTTP_IPRESOLVE_V4', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_ACL', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_MKACTIVITY', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_BASELINE_CONTROL', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_MERGE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_LABEL', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_UPDATE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_MKWORKSPACE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_UNCHECKOUT', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_CHECKIN', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_CHECKOUT', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_REPORT', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_VERSION_CONTROL', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_UNLOCK', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_LOCK', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_MOVE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_COPY', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_MKCOL', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_PROPPATCH', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_PROPFIND', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_CONNECT', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_TRACE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_OPTIONS', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_DELETE', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_PUT', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_POST', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_HEAD', 0);

/**
 * 
 * @var int
 */
define('HTTP_METH_GET', 0);

/**
 * temporary redirect (307 Temporary Redirect)
 * @var int
 */
define('HTTP_REDIRECT_TEMP', 0);

/**
 * proxy redirect (305 Use proxy)
 * @var int
 */
define('HTTP_REDIRECT_PROXY', 0);

/**
 * redirect applicable to POST requests (303 See other)
 * @var int
 */
define('HTTP_REDIRECT_POST', 0);

/**
 * standard redirect (302 Found)
 * @var int
 */
define('HTTP_REDIRECT_FOUND', 0);

/**
 * permanent redirect (301 Moved permanently)
 * @var int
 */
define('HTTP_REDIRECT_PERM', 0);

/**
 * guess applicable redirect method
 * @var int
 */
define('HTTP_REDIRECT', 0);

/**
 * strip anything but scheme and host
 * @var int
 */
define('HTTP_URL_STRIP_ALL', 0);

/**
 * strip any fragments (#identifier)
 * @var int
 */
define('HTTP_URL_STRIP_FRAGMENT', 0);

/**
 * strip query string
 * @var int
 */
define('HTTP_URL_STRIP_QUERY', 0);

/**
 * strip complete path
 * @var int
 */
define('HTTP_URL_STRIP_PATH', 0);

/**
 * strip explicit port numbers
 * @var int
 */
define('HTTP_URL_STRIP_PORT', 0);

/**
 * strip any authentication information
 * @var int
 */
define('HTTP_URL_STRIP_AUTH', 0);

/**
 * strip any password authentication information
 * @var int
 */
define('HTTP_URL_STRIP_PASS', 0);

/**
 * strip any user authentication information
 * @var int
 */
define('HTTP_URL_STRIP_USER', 0);

/**
 * join query strings
 * @var int
 */
define('HTTP_URL_JOIN_QUERY', 0);

/**
 * join relative paths
 * @var int
 */
define('HTTP_URL_JOIN_PATH', 0);

/**
 * replace every part of the first URL when there's one of the second URL
 * @var int
 */
define('HTTP_URL_REPLACE', 0);


// end php_http PECL

?>
