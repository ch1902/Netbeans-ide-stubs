<?php

// php_oauth PECL

class OAuth
{
   public $debug;
   
   public $sslChecks;
   
   public $debugInfo;

   /**
    * Creates a new OAuth object
    * @link http://php.net/manual/en/oauth.construct.php
    * @param string $consumer_key <p>
    * The consumer key provided by the service provider.
    * </p>
    * @param string $consumer_secret <p>
    * The consumer secret provided by the service provider.
    * </p>
    * @param string $signature_method <p>
    * This optional parameter defines which signature method to use, by default it is OAUTH_SIG_METHOD_HMACSHA1 (HMAC-SHA1). 
    * </p>
    * @param int $auth_type <p>
    * This optional parameter defines how to pass the OAuth parameters to a consumer, by default it is OAUTH_AUTH_TYPE_AUTHORIZATION (in the Authorization header).
    * </p>
    * @return OAuth
    */
   public function __construct ($consumer_key, $consumer_secret, $signature_method = OAUTH_SIG_METHOD_HMACSHA1, $auth_type = 0) { }
   /**
    * The destructor
    * @link http://php.net/manual/en/oauth.destruct.php
    * @return void
    */
   public function __destruct () { }
   /**
    * Turns off verbose request information (off by default). Alternatively, the debug property can be set to a FALSE value to turn debug off.
    * @link http://php.net/manual/en/oauth.disabledebug.php
    * @return bool
    */
   public function disableDebug () { }
   /**
    * Disable redirects from being followed automatically, thus allowing the request to be manually redirected.
    * @link http://php.net/manual/en/oauth.disableredirects.php
    * @return bool
    */
   public function disableRedirects () { }
   /**
    * Turns off the usual SSL peer certificate and host checks, this is not for production environments. Alternatively, the sslChecks member 
    * can be set to FALSE to turn SSL checks off. 
    * @link http://php.net/manual/en/oauth.disablesslchecks.php
    * @return bool
    */
   public function disableSSLChecks () { }
   /**
    * Turns on verbose request information useful for debugging, the debug information is stored in the debugInfo member. 
    * Alternatively, the debug member can be set to a non-FALSE value to turn debug on. 
    * @link http://php.net/manual/en/oauth.enabledebug.php
    * @return bool
    */
   public function enableDebug () { }
   /**
    * Follow and sign redirects automatically, which is enabled by default.
    * @link http://php.net/manual/en/oauth.enableredirects.php
    * @return bool
    */
   public function enableRedirects () { }
   /**
    * Turns on the usual SSL peer certificate and host checks (enabled by default). Alternatively, the sslChecks member can be 
    * set to a non-FALSE value to turn SSL checks off. 
    * @link http://php.net/manual/en/oauth.enablesslchecks.php
    * @return bool
    */
   public function enableSSLChecks () { }
   /**
    * Fetch an OAuth protected resource
    * @link http://php.net/manual/en/oauth.fetch.php
    * @param string $protected_resource_url <p>
    * URL to the OAuth protected resource. 
    * </p>
    * @param array $extra_parameters <p>
    * Extra parameters to send with the request for the resource.
    * </p>
    * @param string $http_method <p>
    * One of the OAUTH_HTTP_METHOD_* OAUTH constants, which includes GET, POST, PUT, HEAD, or DELETE.</p><p>
    * HEAD (OAUTH_HTTP_METHOD_HEAD) can be useful for discovering information prior to the request (if OAuth credentials are in the Authorization header).
    * </p>
    * @param array $http_headers <p>
    * HTTP client headers (such as User-Agent, Accept, etc.)
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function fetch ($protected_resource_url, $extra_parameters = array(), $http_method = OAUTH_HTTP_METHOD_GET, $http_headers = array()) { }
   /**
    * Generate a signature based on the final HTTP method, URL and a string/array of parameters.
    * @link http://php.net/manual/en/oauth.generatesignature.php
    * @param string $http_method <p>
    * HTTP method for request
    * </p>
    * @param string $url <p>
    * URL for request
    * </p>
    * @param mixed $extra_parameters <p>
    * String or array of additional parameters.
    * </p>
    * @return string A string containing the generated signature or FALSE on failure
    */
   public function generateSignature ($http_method, $url, $extra_parameters = array()) { }
   /**
    * Fetch an access token, secret and any additional response parameters from the service provider. 
    * @link http://php.net/manual/en/oauth.getaccesstoken.php
    * @param string $access_token_url <p>
    * URL to the access token API.
    * </p>
    * @param string $auth_session_handle <p>
    * Authorization session handle, this parameter does not have any citation in the core OAuth 1.0 specification 
    * but may be implemented by large providers. » See ScalableOAuth for more information.
    * </p>
    * @param string $verifier_token <p>
    * For service providers which support 1.0a, a verifier_token must be passed while exchanging the request token 
    * for the access token. If the verifier_token is present in $_GET or $_POST it is passed automatically and the 
    * caller does not need to specify a verifier_token (usually if the access token is exchanged at the oauth_callback URL).
    * </p>
    * @return array Returns an array containing the parsed OAuth response on success or FALSE on failure.
    */ 
   public function getAccessToken ($access_token_url, $auth_session_handle = '', $verifier_token = '') { }
   /**
    * Gets the Certificate Authority information, which includes the ca_path and ca_info set by OAuth::setCaPath(). 
    * @link http://php.net/manual/en/oauth.getcapath.php
    * @return array An array of Certificate Authority information, specifically as ca_path and ca_info keys within the returned associative array.
    */
   public function getCAPath () { }
   /**
    * Get the raw response of the most recent request. 
    * @link http://php.net/manual/en/oauth.getlastresponse.php
    * @return string Returns a string containing the last response. 
    */
   public function getLastResponse () { }
   /**
    * Get headers for last response. 
    * @link http://php.net/manual/en/oauth.getlastresponseheaders.php
    * @return string A string containing the last response's headers or FALSE on failure 
    */
   public function getLastResponseHeaders () { }
   /**
    * Get HTTP information about the last response. 
    * @link http://php.net/manual/en/oauth.getlastresponseinfo.php
    * @return array Returns an array containing the response information for the last request. Constants from curl_getinfo() may be used.
    */
   public function getLastResponseInfo () { }
   /**
    * Generate OAuth header string signature based on the final HTTP method, URL and a string/array of parameters
    * @link http://php.net/manual/en/oauth.getrequestheader.php
    * @param string $http_method <p>
    * HTTP method for request. 
    * </p>
    * @param string $url <p>
    * URL for request. 
    * </p>
    * @param mixed $extra_parameters <p>
    * String or array of additional parameters. 
    * </p>
    * @return string A string containing the generated request header or FALSE on failure 
    */
   public function getRequestHeader ($http_method, $url, $extra_parameters = array()) { }
   /**
    * Fetch a request token, secret and any additional response parameters from the service provider. 
    * @link http://php.net/manual/en/oauth.getrequesttoken.php
    * @param string $request_token_url <p>
    * URL to the request token API. 
    * </p>
    * @param string $callback_url <p>
    * OAuth callback URL. If callback_url is passed and is an empty value, it is set to "oob" to address the OAuth 2009.1 advisory. 
    * </p>
    * @return array Returns an array containing the parsed OAuth response on success or FALSE on failure. 
    */
   public function getRequestToken ($request_token_url, $callback_url = 'oob') { }
   /**
    * Set where the OAuth parameters should be passed. 
    * @link http://php.net/manual/en/oauth.setauthtype.php
    * @param int $auth_type <p>
    * auth_type can be one of the following flags (in order of decreasing preference as per OAuth 1.0 section 5.2):</p><ul>
    * <li>OAUTH_AUTH_TYPE_AUTHORIZATION - Pass the OAuth parameters in the HTTP Authorization header</li>
    * <li>OAUTH_AUTH_TYPE_FORM - Append the OAuth parameters to the HTTP POST request body</li>
    * <li>OAUTH_AUTH_TYPE_URI - Append the OAuth parameters to the request URI</li>
    * <li>OAUTH_AUTH_TYPE_NONE - None</li>
    * </ul>
    * @return bool Returns TRUE if a parameter is correctly set, otherwise FALSE (e.g., if an invalid auth_type is passed in.) 
    */
   public function setAuthType ($auth_type) { }
   /**
    * Sets the Certificate Authority (CA), both for path and info.
    * @link http://php.net/manual/en/oauth.setcapath.php
    * @param string $ca_path <p>
    * The CA Path being set.
    * </p>
    * @param string $ca_info <p>
    * The CA Info being set. 
    * </p>
    * @return mixed Returns TRUE on success, or FALSE if either ca_path or ca_info are considered invalid. 
    */
   public function setCAPath ($ca_path = '', $ca_info = '') { }
   /**
    * Sets the nonce for all subsequent requests. 
    * @link http://php.net/manual/en/oauth.setnonce.php
    * @param string $nonce <p>
    * The value for oauth_nonce.
    * </p>
    * @return bool Returns TRUE on success, or FALSE if the nonce is considered invalid.
    */
   public function setNonce ($nonce) { }
   /**
    * Sets the Request Engine, that will be sending the HTTP requests.
    * @link http://php.net/manual/en/oauth.setrequestengine.php
    * @param int $reqengine <p>
    * The desired request engine. Set to OAUTH_REQENGINE_STREAMS to use PHP Streams, or OAUTH_REQENGINE_CURL to use Curl.
    * </p>
    * @return void
    */
   public function setRequestEngine ($reqengine) { }
   /**
    * Sets the RSA certificate.
    * @link http://php.net/manual/en/oauth.setrsacertificate.php
    * @param string $cert <p>
    * The RSA certificate. 
    * </p>
    * @return bool Returns TRUE on success, or FALSE on failure (e.g., the RSA certificate cannot be parsed.) 
    */
   public function setRSACertificate ($cert) { }
   /**
    * Tweak specific SSL checks for requests. 
    * @link http://php.net/manual/en/oauth.setsslchecks.php
    * @param int $sslcheck <p>
    * One of the OAUTH_SSLCHECK_* constants
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   public function setSSLChecks ($sslcheck) { }
   /**
    * Sets the OAuth timestamp for subsequent requests.
    * @link http://php.net/manual/en/oauth.settimestamp.php
    * @param string $timestamp <p>
    * The timestamp. 
    * </p>
    * @return bool Returns TRUE, unless the timestamp is invalid, in which case FALSE is returned.
    */
   public function setTimestamp ($timestamp) { }
   /**
    * Set the token and secret for subsequent requests.
    * @link http://php.net/manual/en/oauth.settoken.php
    * @param string $token <p>
    * The OAuth token. 
    * </p>
    * @param string $token_secret <p>
    * The OAuth token secret. 
    * </p>
    * @return bool
    */
   public function setToken ($token, $token_secret) { }
   /**
    * Sets the OAuth version for subsequent requests 
    * @link http://php.net/manual/en/oauth.setversion.php
    * @param string $version <p>
    * OAuth version, default value is always "1.0" 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   public function setVersion ($version) { }
}

class OAuthProvider
{
   /**
    * Add required oauth provider parameters. 
    * @link http://php.net/manual/en/oauthprovider.addrequiredparameter.php
    * @param string $req_params <p>
    * The required parameters. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   final public function addRequiredParameter ($req_params) { }
   /**
    * Calls the registered consumer handler callback function, which is set with OAuthProvider::consumerHandler(). 
    * @link http://php.net/manual/en/oauthprovider.callconsumerhandler.php
    * @return void
    */
   public function callconsumerHandler () { }
   /**
    * Calls the registered timestamp handler callback function, which is set with OAuthProvider::timestampNonceHandler(). 
    * @link http://php.net/manual/en/oauthprovider.calltimestampnoncehandler.php
    * @return void
    */
   public function callTimestampNonceHandler () { }
   /**
    * Calls the registered token handler callback function, which is set with OAuthProvider::tokenHandler(). 
    * @link http://php.net/manual/en/oauthprovider.calltokenhandler.php
    * @return void
    */
   public function calltokenHandler () { }
   /**
    * Checks an OAuth request. 
    * @link http://php.net/manual/en/oauthprovider.checkoauthrequest.php
    * @param string $uri <p>
    * The optional URI, or endpoint. 
    * </p>
    * @param string $method <p>
    * The HTTP method. Optionally pass in one of the OAUTH_HTTP_METHOD_* OAuth constants. 
    * </p>
    * @return void
    */
   public function checkOAuthRequest ($uri = '', $method = OAUTH_HTTP_METHOD_GET) { }
   /**
    * Initiates a new OAuthProvider object. 
    * @link http://php.net/manual/en/oauthprovider.construct.php
    * @param array $params_array <p>
    * Setting these optional parameters is limited to the CLI SAPI. 
    * </p>
    * @return OAuthProvider
    */
   public function __construct ($params_array = array()) { }
   /**
    * Sets the consumer handler callback, which will later be called with OAuthProvider::callConsumerHandler(). 
    * @link http://
    * @param callable $callback_function <p>
    * The callable functions name.
    * </p>
    * @return void
    */
   public function consumerHandler ($callback_function) { }
   /**
    * Generates a string of pseudo-random bytes. 
    * @link http://php.net/manual/en/oauthprovider.generatetoken.php
    * @param int $size <p>
    * The desired token length, in terms of bytes. 
    * </p>
    * @param bool $strong <p>
    * Setting to TRUE means /dev/random will be used for entropy, as otherwise the non-blocking /dev/urandom is used. This parameter is ignored on Windows. 
    * </p>
    * @throws Exception If the strong parameter is TRUE, then an E_WARNING level error will be emitted when the fallback rand() implementation is used to 
    * fill the remaining random bytes (e.g., when not enough random data was found, initially).
    * @return string The generated token, as a string of bytes. 
    */
   final public static function generateToken ($size, $strong = false) { }
   /**
    * The 2-legged flow, or request signing. It does not require a token. 
    * @link http://php.net/manual/en/oauthprovider.is2leggedendpoint.php
    * @param mixed $params_array <p>
    * Array of parameters
    * </p>
    * @return OAuthProvider An OAuthProvider object.
    */
   public function is2LeggedEndpoint ($params_array) { }
   /**
    * Sets isRequestTokenEndpoint
    * @link http://php.net/manual/en/oauthprovider.isrequesttokenendpoint.php
    * @param bool $will_issue_request_token <p>
    * Sets whether or not it will issue a request token, thus determining if OAuthProvider::tokenHandler() needs to be called. 
    * </p>
    * @return void
    */
   public function isRequestTokenEndpoint ($will_issue_request_token) { }
   /**
    * Removes a required parameter. 
    * @link http://php.net/manual/en/oauthprovider.removerequiredparameter.php
    * @param string $req_params <p>
    * The required parameter to be removed
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure.
    */
   final public function removeRequiredParameter ($req_params) { }
   /**
    * Pass in a problem as an OAuthException, with possible problems listed in the OAuth constants section. 
    * @link http://php.net/manual/en/oauthprovider.reportproblem.php
    * @param string $oauthexception <p>
    * The OAuthException. 
    * </p>
    * @param bool $send_headers <p>
    * Whether to send headers
    * </p>
    * @return void
    */
   final public static function reportProblem ($oauthexception, $send_headers = true) { }
   /**
    * Sets a parameter. 
    * @link http://php.net/manual/en/oauthprovider.setparam.php
    * @param string $param_key <p>
    * The parameter key. 
    * </p>
    * @param mixed $param_val <p>
    * The optional parameter value. 
    * </p>
    * @return bool Returns TRUE on success or FALSE on failure. 
    */
   final public function setParam ($param_key, $param_val = '') { }
   /**
    * Sets the request tokens path. 
    * @link http://php.net/manual/en/oauthprovider.setrequesttokenpath.php
    * @param string $path <p>
    * The path. 
    * </p>
    * @return bool
    */
   final public function setRequestTokenPath ($path) { }
   /**
    * Sets the timestamp nonce handler callback, which will later be called with OAuthProvider::callTimestampNonceHandler(). 
    * Errors related to timestamp/nonce are thrown to this callback. 
    * @link http://php.net/manual/en/oauthprovider.timestampnoncehandler.php
    * @param callable $callback_function <p>
    * The callable functions name. 
    * </p>
    * @return void
    */
   public function timestampNonceHandler ($callback_function) { }
   /**
    * Sets the token handler callback, which will later be called with OAuthProvider::callTokenHandler(). 
    * @link http://php.net/manual/en/oauthprovider.tokenhandler.php
    * @param callable $callback_function <p>
    * The callable functions name. 
    * </p>
    * @return void
    */
   public function tokenHandler ($callback_function) { }
}

class OAuthException extends Exception
{
   /**
    * The response of the exception which occurred, if any
    * @var string
    */
   public $lastResponse;
   
   /**
    * Debug info
    * @var string
    */
   public $debugInfo;
}

/**
 * Generates a Signature Base String according to pecl/oauth. 
 * @link http://php.net/manual/en/function.oauth-get-sbs.php
 * @param string $http_method <p>
 * The HTTP method. 
 * </p>
 * @param string $uri <p>
 * URI to encode. 
 * </p>
 * @param array $request_parameters <p>
 * Array of request parameters. 
 * </p>
 * @return string Returns a Signature Base String. 
 */
function oauth_get_sbs ($http_method, $uri, $request_parameters = array()) { }

/**
 * Encodes a URI to » RFC 3986. 
 * @link http://php.net/manual/en/function.oauth-urlencode.php
 * @param string $uri <p>
 * URI to encode.
 * </p>
 * @return string Returns an » RFC 3986 encoded string.
 */
function oauth_urlencode ($uri) { }

/**
 * OAuth RSA-SHA1 signature method. 
 */
define('OAUTH_SIG_METHOD_RSASHA1', 'RSA-SHA1');

/**
 * OAuth HMAC-SHA1 signature method.
 */
define('OAUTH_SIG_METHOD_HMACSHA1', 'HMAC-SHA1');

/**
 * OAuth HMAC-SHA256 signature method. 
 */
define('OAUTH_SIG_METHOD_HMACSHA256', 'HMAC-SHA256');

/**
 * OAuth plain text signature method. 
 */
define('OAUTH_SIG_METHOD_PLAINTEXT', 'PLAINTEXT');

/**
 * This constant represents putting OAuth parameters in the Authorization header.
 */
define('OAUTH_AUTH_TYPE_AUTHORIZATION', 3);

/**
 * This constant indicates a NoAuth OAuth request.
 */
define('OAUTH_AUTH_TYPE_NONE', 4);

/**
 * This constant represents putting OAuth parameters in the request URI.
 */
define('OAUTH_AUTH_TYPE_URI', 1);

/**
 * This constant represents putting OAuth parameters as part of the HTTP POST body.
 */
define('OAUTH_AUTH_TYPE_FORM', 2);

/**
 * Use the GET method for the OAuth request.
 */
define('OAUTH_HTTP_METHOD_GET', 'GET');

/**
 * Use the POST method for the OAuth request.
 */
define('OAUTH_HTTP_METHOD_POST', 'POST');

/**
 * Use the PUT method for the OAuth request.
 */
define('OAUTH_HTTP_METHOD_PUT', 'PUT');

/**
 * Use the HEAD method for the OAuth request.
 */
define('OAUTH_HTTP_METHOD_HEAD', 'HEAD');

/**
 * Use the DELETE method for the OAuth request. 
 */
define('OAUTH_HTTP_METHOD_DELETE', 'DELETE');

/**
 * Used by OAuth::setRequestEngine() to set the engine to PHP streams, as opposed to OAUTH_REQENGINE_CURL for Curl. 
 */
define('OAUTH_REQENGINE_STREAMS', 1);

/**
 * Used by OAuth::setRequestEngine() to set the engine to Curl, as opposed to OAUTH_REQENGINE_STREAMS for PHP streams. 
 */
define('OAUTH_REQENGINE_CURL', 2);

/**
 * No OAuth SSL checking
 */
define('OAUTH_SSLCHECK_NONE', 0);

/**
 * OAuth check SSL host
 */
define('OAUTH_SSLCHECK_HOST', 1);

/**
 * OAuth check SSL peer
 */
define('OAUTH_SSLCHECK_PEER', 2);

/**
 * OAuth check both SSL
 */
define('OAUTH_SSLCHECK_BOTH', 3);

/**
 * Life is good. 
 */
define('OAUTH_OK', 0);

/**
 * The oauth_nonce value was used in a previous request, therefore it cannot be used now. 
 */
define('OAUTH_BAD_NONCE', 4);

/**
 * The oauth_timestamp value was not accepted by the service provider. In this case, the response should also contain the oauth_acceptable_timestamps parameter. 
 */
define('OAUTH_BAD_TIMESTAMP', 8);

/**
 * The oauth_consumer_key is temporarily unacceptable to the service provider. For example, the service provider may be throttling the consumer. 
 */
define('OAUTH_CONSUMER_KEY_UNKNOWN', 16);

/**
 * The consumer key was refused. 
 */
define('OAUTH_CONSUMER_KEY_REFUSED', 32);

/**
 * The oauth_signature is invalid, as it does not match the signature computed by the service provider. 
 */
define('OAUTH_INVALID_SIGNATURE', 64);

/**
 * The oauth_token has been consumed. It can no longer be used because it has already been used in the previous request(s). 
 */
define('OAUTH_TOKEN_USED', 128);

/**
 * The oauth_token has expired. 
 */
define('OAUTH_TOKEN_EXPIRED', 256);

/**
 * The oauth_token has been revoked, and will never be accepted. 
 */
define('OAUTH_TOKEN_REVOKED', 512);

/**
 * The oauth_token was not accepted by the service provider. The reason is not known, but it might be because the token 
 * was never issued, already consumed, expired, and/or forgotten by the service provider. 
 */
define('OAUTH_TOKEN_REJECTED', 1024);

/**
 * The oauth_verifier is incorrect. 
 */
define('OAUTH_VERIFIER_INVALID', 2048);

/**
 * A required parameter was not received. In this case, the response should also contain the oauth_parameters_absent parameter. 
 */
define('OAUTH_PARAMETER_ABSENT', 4096);

/**
 * The oauth_signature_method was not accepted by service provider. 
 */
define('OAUTH_SIGNATURE_METHOD_REJECTED', 8192);


// end php_oauth PECL

?>
