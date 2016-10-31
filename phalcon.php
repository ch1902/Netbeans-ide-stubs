<?php

namespace \Phalcon {
    /**
     * Phalcon\Acl
     * This component allows to manage ACL lists. An access control list (ACL) is a list
     * of permissions attached to an object. An ACL specifies which users or system processes
     * are granted access to objects, as well as what operations are allowed on given objects.
     * <code>
     * use Phalcon\Acl;
     * use Phalcon\Acl\Role;
     * use Phalcon\Acl\Resource;
     * use Phalcon\Acl\Adapter\Memory;
     * $acl = new Memory();
     * //Default action is deny access
     * $acl->setDefaultAction(Acl::DENY);
     * //Create some roles
     * $roleAdmins = new Role('Administrators', 'Super-User role');
     * $roleGuests = new Role('Guests');
     * //Add "Guests" role to acl
     * $acl->addRole($roleGuests);
     * //Add "Designers" role to acl
     * $acl->addRole('Designers');
     * //Define the "Customers" resource
     * $customersResource = new Resource('Customers', 'Customers management');
     * //Add "customers" resource with a couple of operations
     * $acl->addResource($customersResource, 'search');
     * $acl->addResource($customersResource, array('create', 'update'));
     * //Set access level for roles into resources
     * $acl->allow('Guests', 'Customers', 'search');
     * $acl->allow('Guests', 'Customers', 'create');
     * $acl->deny('Guests', 'Customers', 'update');
     * //Check whether role has access to the operations
     * $acl->isAllowed('Guests', 'Customers', 'edit'); //Returns 0
     * $acl->isAllowed('Guests', 'Customers', 'search'); //Returns 1
     * $acl->isAllowed('Guests', 'Customers', 'create'); //Returns 1
     * </code>
     */
    abstract class Acl
    {
        const ALLOW = 1;
        const DENY = 0;
    }

    /**
     * Phalcon\Application
     * Base class for Phalcon\Cli\Console and Phalcon\Mvc\Application.
     */
    abstract class Application extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface
    {
        protected $_eventsManager;
        protected $_dependencyInjector;
        /**
         * @var string
         */
        protected $_defaultModule;
        /**
         * @var array
         */
        protected $_modules = array();
        /**
         * Phalcon\Application
         *
         * @param mixed $dependencyInjector 
         */
        public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         * @return Application 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Register an array of modules present in the application
         * <code>
         * $this->registerModules(
         * [
         * 'frontend' => [
         * 'className' => 'Multiple\Frontend\Module',
         * 'path'      => '../apps/frontend/Module.php'
         * ],
         * 'backend' => [
         * 'className' => 'Multiple\Backend\Module',
         * 'path'      => '../apps/backend/Module.php'
         * ]
         * ]
         * );
         * </code>
         *
         * @param array $modules 
         * @param bool $merge 
         * @return Application 
         */
        public function registerModules(array $modules, $merge = false) {}
        /**
         * Return the modules registered in the application
         *
         * @return array 
         */
        public function getModules() {}
        /**
         * Gets the module definition registered in the application via module name
         *
         * @param string $name 
         * @return array|object 
         */
        public function getModule($name) {}
        /**
         * Sets the module name to be used if the router doesn't return a valid module
         *
         * @param string $defaultModule 
         * @return Application 
         */
        public function setDefaultModule($defaultModule) {}
        /**
         * Returns the default module name
         *
         * @return string 
         */
        public function getDefaultModule() {}
        /**
         * Handles a request
         */
        abstract public function handle();
    }

    /**
     * Phalcon\Config
     * Phalcon\Config is designed to simplify the access to, and the use of, configuration data within applications.
     * It provides a nested object property based user interface for accessing this configuration data within
     * application code.
     * <code>
     * $config = new \Phalcon\Config(array(
     * "database" => array(
     * "adapter" => "Mysql",
     * "host" => "localhost",
     * "username" => "scott",
     * "password" => "cheetah",
     * "dbname" => "test_db"
     * ),
     * "phalcon" => array(
     * "controllersDir" => "../app/controllers/",
     * "modelsDir" => "../app/models/",
     * "viewsDir" => "../app/views/"
     * )
     * ));
     * </code>
     */
    class Config implements \ArrayAccess, \Countable
    {
        /**
         * Phalcon\Config constructor
         *
         * @param array $arrayConfig 
         */
        public function __construct(array $arrayConfig = null) {}
        /**
         * Allows to check whether an attribute is defined using the array-syntax
         * <code>
         * var_dump(isset($config['database']));
         * </code>
         *
         * @param mixed $index 
         * @return bool 
         */
        public function offsetExists($index) {}
        /**
         * Gets an attribute from the configuration, if the attribute isn't defined returns null
         * If the value is exactly null or is not defined the default value will be used instead
         * <code>
         * echo $config->get('controllersDir', '../app/controllers/');
         * </code>
         *
         * @param mixed $index 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function get($index, $defaultValue = null) {}
        /**
         * Gets an attribute using the array-syntax
         * <code>
         * print_r($config['database']);
         * </code>
         *
         * @param mixed $index 
         * @return string 
         */
        public function offsetGet($index) {}
        /**
         * Sets an attribute using the array-syntax
         * <code>
         * $config['database'] = array('type' => 'Sqlite');
         * </code>
         *
         * @param mixed $index 
         * @param mixed $value 
         */
        public function offsetSet($index, $value) {}
        /**
         * Unsets an attribute using the array-syntax
         * <code>
         * unset($config['database']);
         * </code>
         *
         * @param mixed $index 
         */
        public function offsetUnset($index) {}
        /**
         * Merges a configuration into the current one
         * <code>
         * $appConfig = new \Phalcon\Config(array('database' => array('host' => 'localhost')));
         * $globalConfig->merge($config2);
         * </code>
         *
         * @param mixed $config 
         * @return Config 
         */
        public function merge(Config $config) {}
        /**
         * Converts recursively the object to an array
         * <code>
         * print_r($config->toArray());
         * </code>
         *
         * @return array 
         */
        public function toArray() {}
        /**
         * Returns the count of properties set in the config
         * <code>
         * print count($config);
         * </code>
         * or
         * <code>
         * print $config->count();
         * </code>
         *
         * @return int 
         */
        public function count() {}
        /**
         * Restores the state of a Phalcon\Config object
         *
         * @param array $data 
         * @return Config 
         */
        public static function __set_state(array $data) {}
        /**
         * Helper method for merge configs (forwarding nested config instance)
         *
         * @param Config $config 
         * @param Config $instance = null
         * @return Config config
         */
        protected final function _merge(Config $config, $instance = null) {}
    }

    /**
     * Phalcon\Crypt
     * Provides encryption facilities to phalcon applications
     * <code>
     * $crypt = new \Phalcon\Crypt();
     * $key = 'le password';
     * $text = 'This is a secret text';
     * $encrypted = $crypt->encrypt($text, $key);
     * echo $crypt->decrypt($encrypted, $key);
     * </code>
     */
    class Crypt implements \Phalcon\CryptInterface
    {
        const PADDING_DEFAULT = 0;
        const PADDING_ANSI_X_923 = 1;
        const PADDING_PKCS7 = 2;
        const PADDING_ISO_10126 = 3;
        const PADDING_ISO_IEC_7816_4 = 4;
        const PADDING_ZERO = 5;
        const PADDING_SPACE = 6;
        protected $_key;
        protected $_padding = 0;
        protected $_cipher = "aes-256-cfb";
        /**
         * Changes the padding scheme used
         *
         * @param int $scheme 
         * @return \Phalcon\CryptInterface 
         */
        public function setPadding($scheme) {}
        /**
         * Sets the cipher algorithm
         *
         * @param string $cipher 
         * @return Crypt 
         */
        public function setCipher($cipher) {}
        /**
         * Returns the current cipher
         *
         * @return string 
         */
        public function getCipher() {}
        /**
         * Sets the encryption key
         *
         * @param string $key 
         * @return Crypt 
         */
        public function setKey($key) {}
        /**
         * Returns the encryption key
         *
         * @return string 
         */
        public function getKey() {}
        /**
         * Pads texts before encryption
         *
         * @see http://www.di-mgt.com.au/cryptopad.html
         * @param string $text 
         * @param string $mode 
         * @param int $blockSize 
         * @param int $paddingType 
         */
        protected function _cryptPadText($text, $mode, $blockSize, $paddingType) {}
        /**
         * Removes padding @a padding_type from @a text
         * If the function detects that the text was not padded, it will return it unmodified
         *
         * @param string $text Message to be unpadded
         * @param string $mode Encryption mode; unpadding is applied only in CBC or ECB mode
         * @param int $blockSize Cipher block size
         * @param int $paddingType Padding scheme
         */
        protected function _cryptUnpadText($text, $mode, $blockSize, $paddingType) {}
        /**
         * Encrypts a text
         * <code>
         * $encrypted = $crypt->encrypt("Ultra-secret text", "encrypt password");
         * </code>
         *
         * @param string $text 
         * @param string $key 
         * @return string 
         */
        public function encrypt($text, $key = null) {}
        /**
         * Decrypts an encrypted text
         * <code>
         * echo $crypt->decrypt($encrypted, "decrypt password");
         * </code>
         *
         * @param string $text 
         * @param mixed $key 
         * @return string 
         */
        public function decrypt($text, $key = null) {}
        /**
         * Encrypts a text returning the result as a base64 string
         *
         * @param string $text 
         * @param mixed $key 
         * @param bool $safe 
         * @return string 
         */
        public function encryptBase64($text, $key = null, $safe = false) {}
        /**
         * Decrypt a text that is coded as a base64 string
         *
         * @param string $text 
         * @param mixed $key 
         * @param bool $safe 
         * @return string 
         */
        public function decryptBase64($text, $key = null, $safe = false) {}
        /**
         * Returns a list of available ciphers
         *
         * @return array 
         */
        public function getAvailableCiphers() {}
    }

    /**
     * Phalcon\CryptInterface
     * Interface for Phalcon\Crypt
     */
    interface CryptInterface
    {
        /**
         * Sets the cipher algorithm
         *
         * @param string $cipher 
         * @return CryptInterface 
         */
        public function setCipher($cipher);
        /**
         * Returns the current cipher
         *
         * @return string 
         */
        public function getCipher();
        /**
         * Sets the encryption key
         *
         * @param string $key 
         * @return CryptInterface 
         */
        public function setKey($key);
        /**
         * Returns the encryption key
         *
         * @return string 
         */
        public function getKey();
        /**
         * Encrypts a text
         *
         * @param string $text 
         * @param mixed $key 
         * @return string 
         */
        public function encrypt($text, $key = null);
        /**
         * Decrypts a text
         *
         * @param string $text 
         * @param string $key 
         * @return string 
         */
        public function decrypt($text, $key = null);
        /**
         * Encrypts a text returning the result as a base64 string
         *
         * @param string $text 
         * @param mixed $key 
         * @return string 
         */
        public function encryptBase64($text, $key = null);
        /**
         * Decrypt a text that is coded as a base64 string
         *
         * @param string $text 
         * @param mixed $key 
         * @return string 
         */
        public function decryptBase64($text, $key = null);
        /**
         * Returns a list of available cyphers
         *
         * @return array 
         */
        public function getAvailableCiphers();
    }

    /**
     * Phalcon\Db
     * Phalcon\Db and its related classes provide a simple SQL database interface for Phalcon Framework.
     * The Phalcon\Db is the basic class you use to connect your PHP application to an RDBMS.
     * There is a different adapter class for each brand of RDBMS.
     * This component is intended to lower level database operations. If you want to interact with databases using
     * higher level of abstraction use Phalcon\Mvc\Model.
     * Phalcon\Db is an abstract class. You only can use it with a database adapter like Phalcon\Db\Adapter\Pdo
     * <code>
     * use Phalcon\Db;
     * use Phalcon\Db\Exception;
     * use Phalcon\Db\Adapter\Pdo\Mysql as MysqlConnection;
     * try {
     * $connection = new MysqlConnection(array(
     * 'host' => '192.168.0.11',
     * 'username' => 'sigma',
     * 'password' => 'secret',
     * 'dbname' => 'blog',
     * 'port' => '3306',
     * ));
     * $result = $connection->query("SELECTFROM robots LIMIT 5");
     * $result->setFetchMode(Db::FETCH_NUM);
     * while ($robot = $result->fetch()) {
     * print_r($robot);
     * }
     * } catch (Exception $e) {
     * echo $e->getMessage(), PHP_EOL;
     * }
     * </code>
     */
    abstract class Db
    {
        const FETCH_LAZY = 1;
        const FETCH_ASSOC = 2;
        const FETCH_NAMED = 11;
        const FETCH_NUM = 3;
        const FETCH_BOTH = 4;
        const FETCH_OBJ = 5;
        const FETCH_BOUND = 6;
        const FETCH_COLUMN = 7;
        const FETCH_CLASS = 8;
        const FETCH_INTO = 9;
        const FETCH_FUNC = 10;
        const FETCH_GROUP = 65536;
        const FETCH_UNIQUE = 196608;
        const FETCH_KEY_PAIR = 12;
        const FETCH_CLASSTYPE = 262144;
        const FETCH_SERIALIZE = 524288;
        const FETCH_PROPS_LATE = 1048576;
        /**
         * Enables/disables options in the Database component
         *
         * @param array $options 
         */
        public static function setup(array $options) {}
    }

    /**
     * Phalcon\Debug
     * Provides debug capabilities to Phalcon applications
     */
    class Debug
    {
        protected $_uri = "//static.phalconphp.com/www/debug/3.0.x/";
        protected $_theme = "default";
        protected $_hideDocumentRoot = false;
        protected $_showBackTrace = true;
        protected $_showFiles = true;
        protected $_showFileFragment = false;
        protected $_data;
        static protected $_isActive;
        /**
         * Change the base URI for static resources
         *
         * @param string $uri 
         * @return Debug 
         */
        public function setUri($uri) {}
        /**
         * Sets if files the exception's backtrace must be showed
         *
         * @param bool $showBackTrace 
         * @return Debug 
         */
        public function setShowBackTrace($showBackTrace) {}
        /**
         * Set if files part of the backtrace must be shown in the output
         *
         * @param bool $showFiles 
         * @return Debug 
         */
        public function setShowFiles($showFiles) {}
        /**
         * Sets if files must be completely opened and showed in the output
         * or just the fragment related to the exception
         *
         * @param bool $showFileFragment 
         * @return Debug 
         */
        public function setShowFileFragment($showFileFragment) {}
        /**
         * Listen for uncaught exceptions and unsilent notices or warnings
         *
         * @param bool $exceptions 
         * @param bool $lowSeverity 
         * @return Debug 
         */
        public function listen($exceptions = true, $lowSeverity = false) {}
        /**
         * Listen for uncaught exceptions
         *
         * @return Debug 
         */
        public function listenExceptions() {}
        /**
         * Listen for unsilent notices or warnings
         *
         * @return Debug 
         */
        public function listenLowSeverity() {}
        /**
         * Halts the request showing a backtrace
         */
        public function halt() {}
        /**
         * Adds a variable to the debug output
         *
         * @param mixed $varz 
         * @param string $key 
         * @return Debug 
         */
        public function debugVar($varz, $key = null) {}
        /**
         * Clears are variables added previously
         *
         * @return Debug 
         */
        public function clearVars() {}
        /**
         * Escapes a string with htmlentities
         *
         * @param mixed $value 
         * @return string 
         */
        protected function _escapeString($value) {}
        /**
         * Produces a recursive representation of an array
         *
         * @param array $argument 
         * @param mixed $n 
         * @return string|null 
         */
        protected function _getArrayDump(array $argument, $n = 0) {}
        /**
         * Produces an string representation of a variable
         *
         * @param mixed $variable 
         * @return string 
         */
        protected function _getVarDump($variable) {}
        /**
         * Returns the major framework's version
         *
         * @return string 
         */
        public function getMajorVersion() {}
        /**
         * Generates a link to the current version documentation
         *
         * @return string 
         */
        public function getVersion() {}
        /**
         * Returns the css sources
         *
         * @return string 
         */
        public function getCssSources() {}
        /**
         * Returns the javascript sources
         *
         * @return string 
         */
        public function getJsSources() {}
        /**
         * Shows a backtrace item
         *
         * @param int $n 
         * @param array $trace 
         */
        protected final function showTraceItem($n, array $trace) {}
        /**
         * Throws an exception when a notice or warning is raised
         *
         * @param mixed $severity 
         * @param mixed $message 
         * @param mixed $file 
         * @param mixed $line 
         * @param mixed $context 
         */
        public function onUncaughtLowSeverity($severity, $message, $file, $line, $context) {}
        /**
         * Handles uncaught exceptions
         *
         * @param mixed $exception 
         * @return bool 
         */
        public function onUncaughtException(\Exception $exception) {}
    }

    /**
     * Phalcon\Di
     * Phalcon\Di is a component that implements Dependency Injection/Service Location
     * of services and it's itself a container for them.
     * Since Phalcon is highly decoupled, Phalcon\Di is essential to integrate the different
     * components of the framework. The developer can also use this component to inject dependencies
     * and manage global instances of the different classes used in the application.
     * Basically, this component implements the `Inversion of Control` pattern. Applying this,
     * the objects do not receive their dependencies using setters or constructors, but requesting
     * a service dependency injector. This reduces the overall complexity, since there is only one
     * way to get the required dependencies within a component.
     * Additionally, this pattern increases testability in the code, thus making it less prone to errors.
     * <code>
     * $di = new \Phalcon\Di();
     * //Using a string definition
     * $di->set("request", "Phalcon\Http\Request", true);
     * //Using an anonymous function
     * $di->set("request", function(){
     * return new \Phalcon\Http\Request();
     * }, true);
     * $request = $di->getRequest();
     * </code>
     */
    class Di implements \Phalcon\DiInterface
    {
        /**
         * List of registered services
         */
        protected $_services;
        /**
         * List of shared instances
         */
        protected $_sharedInstances;
        /**
         * To know if the latest resolved instance was shared or not
         */
        protected $_freshInstance = false;
        /**
         * Events Manager
         *
         * @var \Phalcon\Events\ManagerInterface
         */
        protected $_eventsManager;
        /**
         * Latest DI build
         */
        static protected $_default;
        /**
         * Phalcon\Di constructor
         */
        public function __construct() {}
        /**
         * Sets the internal event manager
         *
         * @param mixed $eventsManager 
         */
        public function setInternalEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getInternalEventsManager() {}
        /**
         * Registers a service in the services container
         *
         * @param string $name 
         * @param mixed $definition 
         * @param bool $shared 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function set($name, $definition, $shared = false) {}
        /**
         * Registers an "always shared" service in the services container
         *
         * @param string $name 
         * @param mixed $definition 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function setShared($name, $definition) {}
        /**
         * Removes a service in the services container
         * It also removes any shared instance created for the service
         *
         * @param string $name 
         */
        public function remove($name) {}
        /**
         * Attempts to register a service in the services container
         * Only is successful if a service hasn't been registered previously
         * with the same name
         *
         * @param string $name 
         * @param mixed $definition 
         * @param bool $shared 
         * @return bool|\Phalcon\Di\ServiceInterface 
         */
        public function attempt($name, $definition, $shared = false) {}
        /**
         * Sets a service using a raw Phalcon\Di\Service definition
         *
         * @param string $name 
         * @param mixed $rawDefinition 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition) {}
        /**
         * Returns a service definition without resolving
         *
         * @param string $name 
         * @return mixed 
         */
        public function getRaw($name) {}
        /**
         * Returns a Phalcon\Di\Service instance
         *
         * @param string $name 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function getService($name) {}
        /**
         * Resolves the service based on its configuration
         *
         * @param string $name 
         * @param mixed $parameters 
         * @return mixed 
         */
        public function get($name, $parameters = null) {}
        /**
         * Resolves a service, the resolved service is stored in the DI, subsequent requests for this service will return the same instance
         *
         * @param string $name 
         * @param array $parameters 
         * @return mixed 
         */
        public function getShared($name, $parameters = null) {}
        /**
         * Check whether the DI contains a service by a name
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name) {}
        /**
         * Check whether the last service obtained via getShared produced a fresh instance or an existing one
         *
         * @return bool 
         */
        public function wasFreshInstance() {}
        /**
         * Return the services registered in the DI
         *
         * @return Service[] 
         */
        public function getServices() {}
        /**
         * Check if a service is registered using the array syntax
         *
         * @param string $name 
         * @return bool 
         */
        public function offsetExists($name) {}
        /**
         * Allows to register a shared service using the array syntax
         * <code>
         * $di["request"] = new \Phalcon\Http\Request();
         * </code>
         *
         * @param string $name 
         * @param mixed $definition 
         * @return boolean 
         */
        public function offsetSet($name, $definition) {}
        /**
         * Allows to obtain a shared service using the array syntax
         * <code>
         * var_dump($di["request"]);
         * </code>
         *
         * @param string $name 
         * @return mixed 
         */
        public function offsetGet($name) {}
        /**
         * Removes a service from the services container using the array syntax
         *
         * @param string $name 
         * @return bool 
         */
        public function offsetUnset($name) {}
        /**
         * Magic method to get or set services using setters/getters
         *
         * @param string $method 
         * @param array $arguments 
         * @return mixed|null 
         */
        public function __call($method, $arguments = null) {}
        /**
         * Set a default dependency injection container to be obtained into static methods
         *
         * @param mixed $dependencyInjector 
         */
        public static function setDefault(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Return the latest DI created
         *
         * @return \Phalcon\DiInterface 
         */
        public static function getDefault() {}
        /**
         * Resets the internal default DI
         */
        public static function reset() {}
    }

    /**
     * Phalcon\DiInterface
     * Interface for Phalcon\Di
     */
    interface DiInterface extends \ArrayAccess
    {
        /**
         * Registers a service in the services container
         *
         * @param string $name 
         * @param mixed $definition 
         * @param boolean $shared 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function set($name, $definition, $shared = false);
        /**
         * Registers an "always shared" service in the services container
         *
         * @param string $name 
         * @param mixed $definition 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function setShared($name, $definition);
        /**
         * Removes a service in the services container
         *
         * @param string $name 
         */
        public function remove($name);
        /**
         * Attempts to register a service in the services container
         * Only is successful if a service hasn't been registered previously
         * with the same name
         *
         * @param string $name 
         * @param mixed $definition 
         * @param boolean $shared 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function attempt($name, $definition, $shared = false);
        /**
         * Resolves the service based on its configuration
         *
         * @param string $name 
         * @param array $parameters 
         * @return mixed 
         */
        public function get($name, $parameters = null);
        /**
         * Returns a shared service based on their configuration
         *
         * @param string $name 
         * @param array $parameters 
         * @return mixed 
         */
        public function getShared($name, $parameters = null);
        /**
         * Sets a service using a raw Phalcon\Di\Service definition
         *
         * @param string $name 
         * @param mixed $rawDefinition 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition);
        /**
         * Returns a service definition without resolving
         *
         * @param string $name 
         * @return mixed 
         */
        public function getRaw($name);
        /**
         * Returns the corresponding Phalcon\Di\Service instance for a service
         *
         * @param string $name 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function getService($name);
        /**
         * Check whether the DI contains a service by a name
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name);
        /**
         * Check whether the last service obtained via getShared produced a fresh instance or an existing one
         *
         * @return bool 
         */
        public function wasFreshInstance();
        /**
         * Return the services registered in the DI
         *
         * @return \Phalcon\Di\ServiceInterface[] 
         */
        public function getServices();
        /**
         * Set a default dependency injection container to be obtained into static methods
         *
         * @param mixed $dependencyInjector 
         */
        public static function setDefault(\Phalcon\DiInterface $dependencyInjector);
        /**
         * Return the last DI created
         *
         * @return \Phalcon\DiInterface 
         */
        public static function getDefault();
        /**
         * Resets the internal default DI
         */
        public static function reset();
    }

    /**
     * Phalcon\Dispatcher
     * This is the base class for Phalcon\Mvc\Dispatcher and Phalcon\Cli\Dispatcher.
     * This class can't be instantiated directly, you can use it to create your own dispatchers.
     */
    abstract class Dispatcher implements \Phalcon\DispatcherInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
    {
        const EXCEPTION_NO_DI = 0;
        const EXCEPTION_CYCLIC_ROUTING = 1;
        const EXCEPTION_HANDLER_NOT_FOUND = 2;
        const EXCEPTION_INVALID_HANDLER = 3;
        const EXCEPTION_INVALID_PARAMS = 4;
        const EXCEPTION_ACTION_NOT_FOUND = 5;
        protected $_dependencyInjector;
        protected $_eventsManager;
        protected $_activeHandler;
        protected $_finished;
        protected $_forwarded = false;
        protected $_moduleName = null;
        protected $_namespaceName = null;
        protected $_handlerName = null;
        protected $_actionName = null;
        protected $_params = array();
        protected $_returnedValue = null;
        protected $_lastHandler = null;
        protected $_defaultNamespace = null;
        protected $_defaultHandler = null;
        protected $_defaultAction = "";
        protected $_handlerSuffix = "";
        protected $_actionSuffix = "Action";
        protected $_previousNamespaceName = null;
        protected $_previousHandlerName = null;
        protected $_previousActionName = null;
        protected $_modelBinding = false;
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets the default action suffix
         *
         * @param string $actionSuffix 
         */
        public function setActionSuffix($actionSuffix) {}
        /**
         * Gets the default action suffix
         *
         * @return string 
         */
        public function getActionSuffix() {}
        /**
         * Sets the module where the controller is (only informative)
         *
         * @param string $moduleName 
         */
        public function setModuleName($moduleName) {}
        /**
         * Gets the module where the controller class is
         *
         * @return string 
         */
        public function getModuleName() {}
        /**
         * Sets the namespace where the controller class is
         *
         * @param string $namespaceName 
         */
        public function setNamespaceName($namespaceName) {}
        /**
         * Gets a namespace to be prepended to the current handler name
         *
         * @return string 
         */
        public function getNamespaceName() {}
        /**
         * Sets the default namespace
         *
         * @param string $namespaceName 
         */
        public function setDefaultNamespace($namespaceName) {}
        /**
         * Returns the default namespace
         *
         * @return string 
         */
        public function getDefaultNamespace() {}
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         */
        public function setDefaultAction($actionName) {}
        /**
         * Sets the action name to be dispatched
         *
         * @param string $actionName 
         */
        public function setActionName($actionName) {}
        /**
         * Gets the latest dispatched action name
         *
         * @return string 
         */
        public function getActionName() {}
        /**
         * Sets action params to be dispatched
         *
         * @param array $params 
         */
        public function setParams($params) {}
        /**
         * Gets action params
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Set a param by its name or numeric index
         *
         * @param mixed $param 
         * @param mixed $value 
         */
        public function setParam($param, $value) {}
        /**
         * Gets a param by its name or numeric index
         *
         * @param mixed $param 
         * @param string|array $filters 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getParam($param, $filters = null, $defaultValue = null) {}
        /**
         * Check if a param exists
         *
         * @param mixed $param 
         * @return boolean 
         */
        public function hasParam($param) {}
        /**
         * Returns the current method to be/executed in the dispatcher
         *
         * @return string 
         */
        public function getActiveMethod() {}
        /**
         * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
         *
         * @return bool 
         */
        public function isFinished() {}
        /**
         * Sets the latest returned value by an action manually
         *
         * @param mixed $value 
         */
        public function setReturnedValue($value) {}
        /**
         * Returns value returned by the latest dispatched action
         *
         * @return mixed 
         */
        public function getReturnedValue() {}
        /**
         * Enable/Disable model binding during dispatch
         *
         * @param boolean $value 
         */
        public function setModelBinding($value) {}
        /**
         * Dispatches a handle action taking into account the routing parameters
         *
         * @return object 
         */
        public function dispatch() {}
        /**
         * Dispatches a handle action taking into account the routing parameters
         *
         * @return object 
         */
        protected function _dispatch() {}
        /**
         * Forwards the execution flow to another controller/action
         * Dispatchers are unique per module. Forwarding between modules is not allowed
         * <code>
         * $this->dispatcher->forward(array("controller" => "posts", "action" => "index"));
         * </code>
         *
         * @param array $forward 
         */
        public function forward($forward) {}
        /**
         * Check if the current executed action was forwarded by another one
         *
         * @return bool 
         */
        public function wasForwarded() {}
        /**
         * Possible class name that will be located to dispatch the request
         *
         * @return string 
         */
        public function getHandlerClass() {}
        /**
         * @param mixed $handler 
         * @param string $actionMethod 
         * @param array $params 
         */
        public function callActionMethod($handler, $actionMethod, array $params = array()) {}
        /**
         * Set empty properties to their defaults (where defaults are available)
         */
        protected function _resolveEmptyProperties() {}
    }

    /**
     * Phalcon\DispatcherInterface
     * Interface for Phalcon\Dispatcher
     */
    interface DispatcherInterface
    {
        /**
         * Sets the default action suffix
         *
         * @param string $actionSuffix 
         */
        public function setActionSuffix($actionSuffix);
        /**
         * Gets the default action suffix
         *
         * @return string 
         */
        public function getActionSuffix();
        /**
         * Sets the default namespace
         *
         * @param string $defaultNamespace 
         */
        public function setDefaultNamespace($defaultNamespace);
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         */
        public function setDefaultAction($actionName);
        /**
         * Sets the namespace which the controller belongs to
         *
         * @param string $namespaceName 
         */
        public function setNamespaceName($namespaceName);
        /**
         * Sets the module name which the application belongs to
         *
         * @param string $moduleName 
         */
        public function setModuleName($moduleName);
        /**
         * Sets the action name to be dispatched
         *
         * @param string $actionName 
         */
        public function setActionName($actionName);
        /**
         * Gets last dispatched action name
         *
         * @return string 
         */
        public function getActionName();
        /**
         * Sets action params to be dispatched
         *
         * @param array $params 
         */
        public function setParams($params);
        /**
         * Gets action params
         *
         * @return array 
         */
        public function getParams();
        /**
         * Set a param by its name or numeric index
         *
         * @param mixed $param 
         * @param mixed $value 
         */
        public function setParam($param, $value);
        /**
         * Gets a param by its name or numeric index
         *
         * @param mixed $param 
         * @param string|array $filters 
         * @return mixed 
         */
        public function getParam($param, $filters = null);
        /**
         * Check if a param exists
         *
         * @param mixed $param 
         * @return boolean 
         */
        public function hasParam($param);
        /**
         * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
         *
         * @return bool 
         */
        public function isFinished();
        /**
         * Returns value returned by the latest dispatched action
         *
         * @return mixed 
         */
        public function getReturnedValue();
        /**
         * Dispatches a handle action taking into account the routing parameters
         *
         * @return object 
         */
        public function dispatch();
        /**
         * Forwards the execution flow to another controller/action
         *
         * @param array $forward 
         */
        public function forward($forward);
    }

    /**
     * Phalcon\Escaper
     * Escapes different kinds of text securing them. By using this component you may
     * prevent XSS attacks.
     * This component only works with UTF-8. The PREG extension needs to be compiled with UTF-8 support.
     * <code>
     * $escaper = new \Phalcon\Escaper();
     * $escaped = $escaper->escapeCss("font-family: <Verdana>");
     * echo $escaped; // font\2D family\3A \20 \3C Verdana\3E
     * </code>
     */
    class Escaper implements \Phalcon\EscaperInterface
    {
        protected $_encoding = "utf-8";
        protected $_htmlEscapeMap = null;
        protected $_htmlQuoteType = 3;
        protected $_doubleEncode = true;
        /**
         * Sets the encoding to be used by the escaper
         * <code>
         * $escaper->setEncoding('utf-8');
         * </code>
         *
         * @param string $encoding 
         */
        public function setEncoding($encoding) {}
        /**
         * Returns the internal encoding used by the escaper
         *
         * @return string 
         */
        public function getEncoding() {}
        /**
         * Sets the HTML quoting type for htmlspecialchars
         * <code>
         * $escaper->setHtmlQuoteType(ENT_XHTML);
         * </code>
         *
         * @param int $quoteType 
         */
        public function setHtmlQuoteType($quoteType) {}
        /**
         * Sets the double_encode to be used by the escaper
         * <code>
         * $escaper->setDoubleEncode(false);
         * </code>
         *
         * @param bool $doubleEncode 
         */
        public function setDoubleEncode($doubleEncode) {}
        /**
         * Detect the character encoding of a string to be handled by an encoder
         * Special-handling for chr(172) and chr(128) to chr(159) which fail to be detected by mb_detect_encoding()
         *
         * @param string $str 
         * @return string|null 
         */
        public final function detectEncoding($str) {}
        /**
         * Utility to normalize a string's encoding to UTF-32.
         *
         * @param string $str 
         * @return string 
         */
        public final function normalizeEncoding($str) {}
        /**
         * Escapes a HTML string. Internally uses htmlspecialchars
         *
         * @param string $text 
         * @return string 
         */
        public function escapeHtml($text) {}
        /**
         * Escapes a HTML attribute string
         *
         * @param string $attribute 
         * @return string 
         */
        public function escapeHtmlAttr($attribute) {}
        /**
         * Escape CSS strings by replacing non-alphanumeric chars by their hexadecimal escaped representation
         *
         * @param string $css 
         * @return string 
         */
        public function escapeCss($css) {}
        /**
         * Escape javascript strings by replacing non-alphanumeric chars by their hexadecimal escaped representation
         *
         * @param string $js 
         * @return string 
         */
        public function escapeJs($js) {}
        /**
         * Escapes a URL. Internally uses rawurlencode
         *
         * @param string $url 
         * @return string 
         */
        public function escapeUrl($url) {}
    }

    /**
     * Phalcon\EscaperInterface
     * Interface for Phalcon\Escaper
     */
    interface EscaperInterface
    {
        /**
         * Sets the encoding to be used by the escaper
         *
         * @param string $encoding 
         */
        public function setEncoding($encoding);
        /**
         * Returns the internal encoding used by the escaper
         *
         * @return string 
         */
        public function getEncoding();
        /**
         * Sets the HTML quoting type for htmlspecialchars
         *
         * @param int $quoteType 
         */
        public function setHtmlQuoteType($quoteType);
        /**
         * Escapes a HTML string
         *
         * @param string $text 
         * @return string 
         */
        public function escapeHtml($text);
        /**
         * Escapes a HTML attribute string
         *
         * @param string $text 
         * @return string 
         */
        public function escapeHtmlAttr($text);
        /**
         * Escape CSS strings by replacing non-alphanumeric chars by their hexadecimal representation
         *
         * @param string $css 
         * @return string 
         */
        public function escapeCss($css);
        /**
         * Escape Javascript strings by replacing non-alphanumeric chars by their hexadecimal representation
         *
         * @param string $js 
         * @return string 
         */
        public function escapeJs($js);
        /**
         * Escapes a URL. Internally uses rawurlencode
         *
         * @param string $url 
         * @return string 
         */
        public function escapeUrl($url);
    }

    /**
     * Phalcon\Exception
     * All framework exceptions should use or extend this exception
     */
    class Exception extends \Exception
    {
    }

    /**
     * Phalcon\Filter
     * The Phalcon\Filter component provides a set of commonly needed data filters. It provides
     * object oriented wrappers to the php filter extension. Also allows the developer to
     * define his/her own filters
     * <code>
     * $filter = new \Phalcon\Filter();
     * $filter->sanitize("some(one)@exa\\mple.com", "email"); // returns "someone@example.com"
     * $filter->sanitize("hello<<", "string"); // returns "hello"
     * $filter->sanitize("!100a019", "int"); // returns "100019"
     * $filter->sanitize("!100a019.01a", "float"); // returns "100019.01"
     * </code>
     */
    class Filter implements \Phalcon\FilterInterface
    {
        const FILTER_EMAIL = "email";
        const FILTER_ABSINT = "absint";
        const FILTER_INT = "int";
        const FILTER_INT_CAST = "int!";
        const FILTER_STRING = "string";
        const FILTER_FLOAT = "float";
        const FILTER_FLOAT_CAST = "float!";
        const FILTER_ALPHANUM = "alphanum";
        const FILTER_TRIM = "trim";
        const FILTER_STRIPTAGS = "striptags";
        const FILTER_LOWER = "lower";
        const FILTER_UPPER = "upper";
        protected $_filters;
        /**
         * Adds a user-defined filter
         *
         * @param string $name 
         * @param mixed $handler 
         * @return Filter 
         */
        public function add($name, $handler) {}
        /**
         * Sanitizes a value with a specified single or set of filters
         *
         * @param mixed $value 
         * @param mixed $filters 
         * @param bool $noRecursive 
         * @return mixed 
         */
        public function sanitize($value, $filters, $noRecursive = false) {}
        /**
         * Internal sanitize wrapper to filter_var
         *
         * @param mixed $value 
         * @param string $filter 
         */
        protected function _sanitize($value, $filter) {}
        /**
         * Return the user-defined filters in the instance
         *
         * @return array 
         */
        public function getFilters() {}
    }

    /**
     * Phalcon\FilterInterface
     * Interface for Phalcon\Filter
     */
    interface FilterInterface
    {
        /**
         * Adds a user-defined filter
         *
         * @param string $name 
         * @param mixed $handler 
         * @return FilterInterface 
         */
        public function add($name, $handler);
        /**
         * Sanizites a value with a specified single or set of filters
         *
         * @param mixed $value 
         * @param mixed $filters 
         * @return mixed 
         */
        public function sanitize($value, $filters);
        /**
         * Return the user-defined filters in the instance
         *
         * @return array 
         */
        public function getFilters();
    }

    /**
     * Phalcon\Flash
     * Shows HTML notifications related to different circumstances. Classes can be stylized using CSS
     * <code>
     * $flash->success("The record was successfully deleted");
     * $flash->error("Cannot open the file");
     * </code>
     */
    abstract class Flash implements \Phalcon\Di\InjectionAwareInterface
    {
        protected $_cssClasses;
        protected $_implicitFlush = true;
        protected $_automaticHtml = true;
        protected $_escaperService = null;
        protected $_autoescape = true;
        protected $_dependencyInjector = null;
        protected $_messages;
        /**
         * Phalcon\Flash constructor
         *
         * @param mixed $cssClasses 
         */
        public function __construct($cssClasses = null) {}
        /**
         * Returns the autoescape mode in generated html
         *
         * @return bool 
         */
        public function getAutoescape() {}
        /**
         * Set the autoescape mode in generated html
         *
         * @param bool $autoescape 
         * @return Flash 
         */
        public function setAutoescape($autoescape) {}
        /**
         * Returns the Escaper Service
         *
         * @return EscaperInterface 
         */
        public function getEscaperService() {}
        /**
         * Sets the Escaper Service
         *
         * @param mixed $escaperService 
         * @return Flash 
         */
        public function setEscaperService(EscaperInterface $escaperService) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         * @return Flash 
         */
        public function setDI(DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return DiInterface 
         */
        public function getDI() {}
        /**
         * Set whether the output must be implicitly flushed to the output or returned as string
         *
         * @param bool $implicitFlush 
         * @return \Phalcon\FlashInterface 
         */
        public function setImplicitFlush($implicitFlush) {}
        /**
         * Set if the output must be implicitly formatted with HTML
         *
         * @param bool $automaticHtml 
         * @return \Phalcon\FlashInterface 
         */
        public function setAutomaticHtml($automaticHtml) {}
        /**
         * Set an array with CSS classes to format the messages
         *
         * @param array $cssClasses 
         * @return \Phalcon\FlashInterface 
         */
        public function setCssClasses(array $cssClasses) {}
        /**
         * Shows a HTML error message
         * <code>
         * $flash->error('This is an error');
         * </code>
         *
         * @param mixed $message 
         * @return string 
         */
        public function error($message) {}
        /**
         * Shows a HTML notice/information message
         * <code>
         * $flash->notice('This is an information');
         * </code>
         *
         * @param mixed $message 
         * @return string 
         */
        public function notice($message) {}
        /**
         * Shows a HTML success message
         * <code>
         * $flash->success('The process was finished successfully');
         * </code>
         *
         * @param mixed $message 
         * @return string 
         */
        public function success($message) {}
        /**
         * Shows a HTML warning message
         * <code>
         * $flash->warning('Hey, this is important');
         * </code>
         *
         * @param mixed $message 
         * @return string 
         */
        public function warning($message) {}
        /**
         * Outputs a message formatting it with HTML
         * <code>
         * $flash->outputMessage('error', message);
         * </code>
         *
         * @param string $type 
         * @param string|array $message 
         * @return string|void 
         */
        public function outputMessage($type, $message) {}
        /**
         * Clears accumulated messages when implicit flush is disabled
         */
        public function clear() {}
    }

    /**
     * Phalcon\FlashInterface
     * Interface for Phalcon\Flash
     */
    interface FlashInterface
    {
        /**
         * Shows a HTML error message
         *
         * @param mixed $message 
         */
        public function error($message);
        /**
         * Shows a HTML notice/information message
         *
         * @param mixed $message 
         */
        public function notice($message);
        /**
         * Shows a HTML success message
         *
         * @param mixed $message 
         */
        public function success($message);
        /**
         * Shows a HTML warning message
         *
         * @param mixed $message 
         */
        public function warning($message);
        /**
         * Outputs a message
         *
         * @param string $type 
         * @param mixed $message 
         */
        public function message($type, $message);
    }

    class Image
    {
        const NONE = 1;
        const WIDTH = 2;
        const HEIGHT = 3;
        const AUTO = 4;
        const INVERSE = 5;
        const PRECISE = 6;
        const TENSILE = 7;
        const HORIZONTAL = 11;
        const VERTICAL = 12;
    }

    /**
     * Phalcon\Kernel
     * This class allows to change the internal behavior of the framework in runtime
     */
    class Kernel
    {
        /**
         * Produces a pre-computed hash key based on a string. This function produces different numbers in 32bit/64bit processors
         *
         * @param string $key 
         * @return string 
         */
        public static function preComputeHashKey($key) {}
    }

    /**
     * Phalcon\Loader
     * This component helps to load your project classes automatically based on some conventions
     * <code>
     * //Creates the autoloader
     * $loader = new Loader();
     * //Register some namespaces
     * $loader->registerNamespaces(array(
     * 'Example\Base' => 'vendor/example/base/',
     * 'Example\Adapter' => 'vendor/example/adapter/',
     * 'Example' => 'vendor/example/'
     * ));
     * //register autoloader
     * $loader->register();
     * //Requiring this class will automatically include file vendor/example/adapter/Some.php
     * $adapter = Example\Adapter\Some();
     * </code>
     */
    class Loader implements \Phalcon\Events\EventsAwareInterface
    {
        protected $_eventsManager = null;
        protected $_foundPath = null;
        protected $_checkedPath = null;
        protected $_classes = null;
        protected $_extensions = array("php");
        protected $_namespaces = null;
        protected $_directories = null;
        protected $_files = null;
        protected $_registered = false;
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets an array of file extensions that the loader must try in each attempt to locate the file
         *
         * @param array $extensions 
         * @return Loader 
         */
        public function setExtensions(array $extensions) {}
        /**
         * Returns the file extensions registered in the loader
         *
         * @return array 
         */
        public function getExtensions() {}
        /**
         * Register namespaces and their related directories
         *
         * @param array $namespaces 
         * @param bool $merge 
         * @return Loader 
         */
        public function registerNamespaces(array $namespaces, $merge = false) {}
        /**
         * @param array $namespace 
         * @return array 
         */
        protected function prepareNamespace(array $namespace) {}
        /**
         * Returns the namespaces currently registered in the autoloader
         *
         * @return array 
         */
        public function getNamespaces() {}
        /**
         * Register directories in which "not found" classes could be found
         *
         * @param array $directories 
         * @param bool $merge 
         * @return Loader 
         */
        public function registerDirs(array $directories, $merge = false) {}
        /**
         * Returns the directories currently registered in the autoloader
         *
         * @return array 
         */
        public function getDirs() {}
        /**
         * Registers files that are "non-classes" hence need a "require". This is very useful for including files that only
         * have functions
         *
         * @param array $files 
         * @param bool $merge 
         * @return Loader 
         */
        public function registerFiles(array $files, $merge = false) {}
        /**
         * Returns the files currently registered in the autoloader
         *
         * @return array 
         */
        public function getFiles() {}
        /**
         * Register classes and their locations
         *
         * @param array $classes 
         * @param bool $merge 
         * @return Loader 
         */
        public function registerClasses(array $classes, $merge = false) {}
        /**
         * Returns the class-map currently registered in the autoloader
         *
         * @return array 
         */
        public function getClasses() {}
        /**
         * Register the autoload method
         *
         * @return Loader 
         */
        public function register() {}
        /**
         * Unregister the autoload method
         *
         * @return Loader 
         */
        public function unregister() {}
        /**
         * Checks if a file exists and then adds the file by doing virtual require
         */
        public function loadFiles() {}
        /**
         * Autoloads the registered classes
         *
         * @param string $className 
         * @return bool 
         */
        public function autoLoad($className) {}
        /**
         * Get the path when a class was found
         *
         * @return string 
         */
        public function getFoundPath() {}
        /**
         * Get the path the loader is checking for a path
         *
         * @return string 
         */
        public function getCheckedPath() {}
    }

    /**
     * Phalcon\Logger
     * Phalcon\Logger is a component whose purpose is create logs using
     * different backends via adapters, generating options, formats and filters
     * also implementing transactions.
     * <code>
     * $logger = new \Phalcon\Logger\Adapter\File("app/logs/test.log");
     * $logger->log("This is a message");
     * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
     * $logger->error("This is another error");
     * </code>
     */
    abstract class Logger
    {
        const SPECIAL = 9;
        const CUSTOM = 8;
        const DEBUG = 7;
        const INFO = 6;
        const NOTICE = 5;
        const WARNING = 4;
        const ERROR = 3;
        const ALERT = 2;
        const CRITICAL = 1;
        const EMERGENCE = 0;
        const EMERGENCY = 0;
    }

    /**
     * Phalcon\Registry
     * A registry is a container for storing objects and values in the application space.
     * By storing the value in a registry, the same object is always available throughout
     * your application.
     * <code>
     * $registry = new \Phalcon\Registry();
     * // Set value
     * $registry->something = 'something';
     * // or
     * $registry['something'] = 'something';
     * // Get value
     * $value = $registry->something;
     * // or
     * $value = $registry['something'];
     * // Check if the key exists
     * $exists = isset($registry->something);
     * // or
     * $exists = isset($registry['something']);
     * // Unset
     * unset($registry->something);
     * // or
     * unset($registry['something']);
     * </code>
     * In addition to ArrayAccess, Phalcon\Registry also implements Countable
     * (count($registry) will return the number of elements in the registry),
     * Serializable and Iterator (you can iterate over the registry
     * using a foreach loop) interfaces. For PHP 5.4 and higher, JsonSerializable
     * interface is implemented.
     * Phalcon\Registry is very fast (it is typically faster than any userspace
     * implementation of the registry); however, this comes at a price:
     * Phalcon\Registry is a final class and cannot be inherited from.
     * Though Phalcon\Registry exposes methods like __get(), offsetGet(), count() etc,
     * it is not recommended to invoke them manually (these methods exist mainly to
     * match the interfaces the registry implements): $registry->__get('property')
     * is several times slower than $registry->property.
     * Internally all the magic methods (and interfaces except JsonSerializable)
     * are implemented using object handlers or similar techniques: this allows
     * to bypass relatively slow method calls.
     */
    final class Registry implements \ArrayAccess, \Countable, \Iterator
    {
        protected $_data;
        /**
         * Registry constructor
         */
        public final function __construct() {}
        /**
         * Checks if the element is present in the registry
         *
         * @param string $offset 
         * @return bool 
         */
        public final function offsetExists($offset) {}
        /**
         * Returns an index in the registry
         *
         * @param string $offset 
         * @return mixed 
         */
        public final function offsetGet($offset) {}
        /**
         * Sets an element in the registry
         *
         * @param string $offset 
         * @param mixed $value 
         */
        public final function offsetSet($offset, $value) {}
        /**
         * Unsets an element in the registry
         *
         * @param string $offset 
         */
        public final function offsetUnset($offset) {}
        /**
         * Checks how many elements are in the register
         *
         * @return int 
         */
        public final function count() {}
        /**
         * Moves cursor to next row in the registry
         */
        public final function next() {}
        /**
         * Gets pointer number of active row in the registry
         *
         * @return int 
         */
        public final function key() {}
        /**
         * Rewinds the registry cursor to its beginning
         */
        public final function rewind() {}
        /**
         * Checks if the iterator is valid
         *
         * @return bool 
         */
        public function valid() {}
        /**
         * Obtains the current value in the internal iterator
         */
        public function current() {}
        /**
         * Sets an element in the registry
         *
         * @param string $key 
         * @param mixed $value 
         */
        public final function __set($key, $value) {}
        /**
         * Returns an index in the registry
         *
         * @param string $key 
         * @return mixed 
         */
        public final function __get($key) {}
        /**
         * @param string $key 
         * @return bool 
         */
        public final function __isset($key) {}
        /**
         * @param string $key 
         */
        public final function __unset($key) {}
    }

    /**
     * Phalcon\Security
     * This component provides a set of functions to improve the security in Phalcon applications
     * <code>
     * $login = $this->request->getPost('login');
     * $password = $this->request->getPost('password');
     * $user = Users::findFirstByLogin($login);
     * if ($user) {
     * if ($this->security->checkHash($password, $user->password)) {
     * //The password is valid
     * }
     * }
     * </code>
     */
    class Security implements \Phalcon\Di\InjectionAwareInterface
    {
        const CRYPT_DEFAULT = 0;
        const CRYPT_STD_DES = 1;
        const CRYPT_EXT_DES = 2;
        const CRYPT_MD5 = 3;
        const CRYPT_BLOWFISH = 4;
        const CRYPT_BLOWFISH_A = 5;
        const CRYPT_BLOWFISH_X = 6;
        const CRYPT_BLOWFISH_Y = 7;
        const CRYPT_SHA256 = 8;
        const CRYPT_SHA512 = 9;
        protected $_dependencyInjector;
        protected $_workFactor = 8;
        protected $_numberBytes = 16;
        protected $_tokenKeySessionID = "\$PHALCON/CSRF/KEY\$";
        protected $_tokenValueSessionID = "\$PHALCON/CSRF\$";
        protected $_token;
        protected $_tokenKey;
        protected $_random;
        protected $_defaultHash;
        /**
         * @param mixed $workFactor
         */
        public function setWorkFactor($workFactor) {}
        public function getWorkFactor() {}
        /**
         * Phalcon\Security constructor
         */
        public function __construct() {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface
         */
        public function getDI() {}
        /**
         * Sets a number of bytes to be generated by the openssl pseudo random generator
         *
         * @param long $randomBytes
         * @return Security
         */
        public function setRandomBytes($randomBytes) {}
        /**
         * Returns a number of bytes to be generated by the openssl pseudo random generator
         *
         * @return string
         */
        public function getRandomBytes() {}
        /**
         * Returns a secure random number generator instance
         *
         * @return \Phalcon\Security\Random
         */
        public function getRandom() {}
        /**
         * Generate a >22-length pseudo random string to be used as salt for passwords
         *
         * @param int $numberBytes
         * @return string
         */
        public function getSaltBytes($numberBytes = 0) {}
        /**
         * Creates a password hash using bcrypt with a pseudo random salt
         *
         * @param string $password
         * @param int $workFactor
         * @return string
         */
        public function hash($password, $workFactor = 0) {}
        /**
         * Checks a plain text password and its hash version to check if the password matches
         *
         * @param string $password
         * @param string $passwordHash
         * @param int $maxPassLength
         * @return bool
         */
        public function checkHash($password, $passwordHash, $maxPassLength = 0) {}
        /**
         * Checks if a password hash is a valid bcrypt's hash
         *
         * @param string $passwordHash
         * @return bool
         */
        public function isLegacyHash($passwordHash) {}
        /**
         * Generates a pseudo random token key to be used as input's name in a CSRF check
         *
         * @return string
         */
        public function getTokenKey() {}
        /**
         * Generates a pseudo random token value to be used as input's value in a CSRF check
         *
         * @return string
         */
        public function getToken() {}
        /**
         * Check if the CSRF token sent in the request is the same that the current in session
         *
         * @param mixed $tokenKey
         * @param mixed $tokenValue
         * @param bool $destroyIfValid
         * @return bool
         */
        public function checkToken($tokenKey = null, $tokenValue = null, $destroyIfValid = true) {}
        /**
         * Returns the value of the CSRF token in session
         *
         * @return string
         */
        public function getSessionToken() {}
        /**
         * Removes the value of the CSRF token and key from session
         *
         * @return Security
         */
        public function destroyToken() {}
        /**
         * Computes a HMAC
         *
         * @param string $data
         * @param string $key
         * @param string $algo
         * @param bool $raw
         * @return string
         */
        public function computeHmac($data, $key, $algo, $raw = false) {}
        /**
         * Sets the default hash
         *
         * @param int $defaultHash
         * @return Security
         */
        public function setDefaultHash($defaultHash) {}
        /**
         * Returns the default hash
         *
         * @return int|null
         */
        public function getDefaultHash() {}
        /**
         * Testing for LibreSSL
         *
         * @return bool
         */
        public function hasLibreSsl() {}
        /**
         * Getting OpenSSL or LibreSSL version
         * Parse OPENSSL_VERSION_TEXT because OPENSSL_VERSION_NUMBER is no use for LibreSSL.
         *
         * @link https://bugs.php.net/bug.php?id=71143
         * <code>
         * if ($security->getSslVersionNumber() >= 20105) {
         * // ...
         * }
         * </code>
         * @return int
         */
        public function getSslVersionNumber() {}
    }

    /**
     * Phalcon\Tag
     * Phalcon\Tag is designed to simplify building of HTML tags.
     * It provides a set of helpers to generate HTML in a dynamic way.
     * This component is an abstract class that you can extend to add more helpers.
     */
    class Tag
    {
        const HTML32 = 1;
        const HTML401_STRICT = 2;
        const HTML401_TRANSITIONAL = 3;
        const HTML401_FRAMESET = 4;
        const HTML5 = 5;
        const XHTML10_STRICT = 6;
        const XHTML10_TRANSITIONAL = 7;
        const XHTML10_FRAMESET = 8;
        const XHTML11 = 9;
        const XHTML20 = 10;
        const XHTML5 = 11;
        /**
         * Pre-assigned values for components
         */
        static protected $_displayValues;
        /**
         * HTML document title
         */
        static protected $_documentTitle = null;
        static protected $_documentAppendTitle = null;
        static protected $_documentPrependTitle = null;
        static protected $_documentTitleSeparator = null;
        static protected $_documentType = 11;
        /**
         * Framework Dispatcher
         */
        static protected $_dependencyInjector;
        static protected $_urlService = null;
        static protected $_dispatcherService = null;
        static protected $_escaperService = null;
        static protected $_autoEscape = true;
        /**
         * Obtains the 'escaper' service if required
         *
         * @param array $params 
         * @return EscaperInterface 
         */
        public static function getEscaper(array $params) {}
        /**
         * Renders parameters keeping order in their HTML attributes
         *
         * @param string $code 
         * @param array $attributes 
         * @return string 
         */
        public static function renderAttributes($code, array $attributes) {}
        /**
         * Sets the dependency injector container.
         *
         * @param mixed $dependencyInjector 
         */
        public static function setDI(DiInterface $dependencyInjector) {}
        /**
         * Internally gets the request dispatcher
         *
         * @return DiInterface 
         */
        public static function getDI() {}
        /**
         * Returns a URL service from the default DI
         *
         * @return \Phalcon\Mvc\UrlInterface 
         */
        public static function getUrlService() {}
        /**
         * Returns an Escaper service from the default DI
         *
         * @return EscaperInterface 
         */
        public static function getEscaperService() {}
        /**
         * Set autoescape mode in generated html
         *
         * @param bool $autoescape 
         */
        public static function setAutoescape($autoescape) {}
        /**
         * Assigns default values to generated tags by helpers
         * <code>
         * // Assigning "peter" to "name" component
         * Phalcon\Tag::setDefault("name", "peter");
         * // Later in the view
         * echo Phalcon\Tag::textField("name"); //Will have the value "peter" by default
         * </code>
         *
         * @param string $id 
         * @param string $value 
         */
        public static function setDefault($id, $value) {}
        /**
         * Assigns default values to generated tags by helpers
         * <code>
         * // Assigning "peter" to "name" component
         * Phalcon\Tag::setDefaults(array("name" => "peter"));
         * // Later in the view
         * echo Phalcon\Tag::textField("name"); //Will have the value "peter" by default
         * </code>
         *
         * @param array $values 
         * @param bool $merge 
         */
        public static function setDefaults(array $values, $merge = false) {}
        /**
         * Alias of Phalcon\Tag::setDefault
         *
         * @param string $id 
         * @param string $value 
         */
        public static function displayTo($id, $value) {}
        /**
         * Check if a helper has a default value set using Phalcon\Tag::setDefault or value from _POST
         *
         * @param string $name 
         * @return boolean 
         */
        public static function hasValue($name) {}
        /**
         * Every helper calls this function to check whether a component has a predefined
         * value using Phalcon\Tag::setDefault or value from _POST
         *
         * @param string $name 
         * @param array $params 
         * @return mixed 
         */
        public static function getValue($name, $params = null) {}
        /**
         * Resets the request and internal values to avoid those fields will have any default value
         */
        public static function resetInput() {}
        /**
         * Builds a HTML A tag using framework conventions
         * <code>
         * echo Phalcon\Tag::linkTo("signup/register", "Register Here!");
         * echo Phalcon\Tag::linkTo(array("signup/register", "Register Here!"));
         * echo Phalcon\Tag::linkTo(array("signup/register", "Register Here!", "class" => "btn-primary"));
         * echo Phalcon\Tag::linkTo("http://phalconphp.com/", "Phalcon", FALSE);
         * echo Phalcon\Tag::linkTo(array("http://phalconphp.com/", "Phalcon Home", FALSE));
         * echo Phalcon\Tag::linkTo(array("http://phalconphp.com/", "Phalcon Home", "local" =>FALSE));
         * </code>
         *
         * @param array|string $parameters 
         * @param string $text 
         * @param boolean $local 
         * @return string 
         */
        public static function linkTo($parameters, $text = null, $local = true) {}
        /**
         * Builds generic INPUT tags
         *
         * @param string $type 
         * @param array $parameters 
         * @param boolean $asValue 
         * @return string 
         */
        static protected final function _inputField($type, $parameters, $asValue = false) {}
        /**
         * Builds INPUT tags that implements the checked attribute
         *
         * @param string $type 
         * @param array $parameters 
         * @return string 
         */
        static protected final function _inputFieldChecked($type, $parameters) {}
        /**
         * Builds a HTML input[type="color"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function colorField($parameters) {}
        /**
         * Builds a HTML input[type="text"] tag
         * <code>
         * echo Phalcon\Tag::textField(array("name", "size" => 30));
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function textField($parameters) {}
        /**
         * Builds a HTML input[type="number"] tag
         * <code>
         * echo Phalcon\Tag::numericField(array("price", "min" => "1", "max" => "5"));
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function numericField($parameters) {}
        /**
         * Builds a HTML input[type="range"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function rangeField($parameters) {}
        /**
         * Builds a HTML input[type="email"] tag
         * <code>
         * echo Phalcon\Tag::emailField("email");
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function emailField($parameters) {}
        /**
         * Builds a HTML input[type="date"] tag
         * <code>
         * echo Phalcon\Tag::dateField(array("born", "value" => "14-12-1980"))
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function dateField($parameters) {}
        /**
         * Builds a HTML input[type="datetime"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function dateTimeField($parameters) {}
        /**
         * Builds a HTML input[type="datetime-local"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function dateTimeLocalField($parameters) {}
        /**
         * Builds a HTML input[type="month"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function monthField($parameters) {}
        /**
         * Builds a HTML input[type="time"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function timeField($parameters) {}
        /**
         * Builds a HTML input[type="week"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function weekField($parameters) {}
        /**
         * Builds a HTML input[type="password"] tag
         * <code>
         * echo Phalcon\Tag::passwordField(array("name", "size" => 30));
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function passwordField($parameters) {}
        /**
         * Builds a HTML input[type="hidden"] tag
         * <code>
         * echo Phalcon\Tag::hiddenField(array("name", "value" => "mike"));
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function hiddenField($parameters) {}
        /**
         * Builds a HTML input[type="file"] tag
         * <code>
         * echo Phalcon\Tag::fileField("file");
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function fileField($parameters) {}
        /**
         * Builds a HTML input[type="search"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function searchField($parameters) {}
        /**
         * Builds a HTML input[type="tel"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function telField($parameters) {}
        /**
         * Builds a HTML input[type="url"] tag
         *
         * @param array $parameters 
         * @return string 
         */
        public static function urlField($parameters) {}
        /**
         * Builds a HTML input[type="check"] tag
         * <code>
         * echo Phalcon\Tag::checkField(array("terms", "value" => "Y"));
         * </code>
         * Volt syntax:
         * <code>
         * {{ check_field("terms") }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function checkField($parameters) {}
        /**
         * Builds a HTML input[type="radio"] tag
         * <code>
         * echo Phalcon\Tag::radioField(array("weather", "value" => "hot"))
         * </code>
         * Volt syntax:
         * <code>
         * {{ radio_field("Save") }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function radioField($parameters) {}
        /**
         * Builds a HTML input[type="image"] tag
         * <code>
         * echo Phalcon\Tag::imageInput(array("src" => "/img/button.png"));
         * </code>
         * Volt syntax:
         * <code>
         * {{ image_input("src": "/img/button.png") }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function imageInput($parameters) {}
        /**
         * Builds a HTML input[type="submit"] tag
         * <code>
         * echo Phalcon\Tag::submitButton("Save")
         * </code>
         * Volt syntax:
         * <code>
         * {{ submit_button("Save") }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function submitButton($parameters) {}
        /**
         * Builds a HTML SELECT tag using a PHP array for options
         * <code>
         * echo Phalcon\Tag::selectStatic("status", array("A" => "Active", "I" => "Inactive"))
         * </code>
         *
         * @param array $parameters 
         * @param array $data 
         * @return string 
         */
        public static function selectStatic($parameters, $data = null) {}
        /**
         * Builds a HTML SELECT tag using a Phalcon\Mvc\Model resultset as options
         * <code>
         * echo Phalcon\Tag::select([
         * "robotId",
         * Robots::find("type = "mechanical""),
         * "using" => ["id", "name"]
         * ]);
         * </code>
         * Volt syntax:
         * <code>
         * {{ select("robotId", robots, "using": ["id", "name"]) }}
         * </code>
         *
         * @param array $parameters 
         * @param array $data 
         * @return string 
         */
        public static function select($parameters, $data = null) {}
        /**
         * Builds a HTML TEXTAREA tag
         * <code>
         * echo Phalcon\Tag::textArea(array("comments", "cols" => 10, "rows" => 4))
         * </code>
         * Volt syntax:
         * <code>
         * {{ text_area("comments", "cols": 10, "rows": 4) }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function textArea($parameters) {}
        /**
         * Builds a HTML FORM tag
         * <code>
         * echo Phalcon\Tag::form("posts/save");
         * echo Phalcon\Tag::form(array("posts/save", "method" => "post"));
         * </code>
         * Volt syntax:
         * <code>
         * {{ form("posts/save") }}
         * {{ form("posts/save", "method": "post") }}
         * </code>
         *
         * @param array $parameters 
         * @return string 
         */
        public static function form($parameters) {}
        /**
         * Builds a HTML close FORM tag
         *
         * @return string 
         */
        public static function endForm() {}
        /**
         * Set the title of view content
         * <code>
         * Phalcon\Tag::setTitle("Welcome to my Page");
         * </code>
         *
         * @param string $title 
         */
        public static function setTitle($title) {}
        /**
         * Set the title separator of view content
         * <code>
         * Phalcon\Tag::setTitleSeparator("-");
         * </code>
         *
         * @param string $titleSeparator 
         */
        public static function setTitleSeparator($titleSeparator) {}
        /**
         * Appends a text to current document title
         *
         * @param string $title 
         */
        public static function appendTitle($title) {}
        /**
         * Prepends a text to current document title
         *
         * @param string $title 
         */
        public static function prependTitle($title) {}
        /**
         * Gets the current document title.
         * The title will be automatically escaped.
         * <code>
         * echo Phalcon\Tag::getTitle();
         * </code>
         * <code>
         * {{ get_title() }}
         * </code>
         *
         * @param bool $tags 
         * @return string 
         */
        public static function getTitle($tags = true) {}
        /**
         * Gets the current document title separator
         * <code>
         * echo Phalcon\Tag::getTitleSeparator();
         * </code>
         * <code>
         * {{ get_title_separator() }}
         * </code>
         *
         * @return string 
         */
        public static function getTitleSeparator() {}
        /**
         * Builds a LINK[rel="stylesheet"] tag
         * <code>
         * echo Phalcon\Tag::stylesheetLink("http://fonts.googleapis.com/css?family=Rosario", false);
         * echo Phalcon\Tag::stylesheetLink("css/style.css");
         * </code>
         * Volt Syntax:
         * <code>
         * {{ stylesheet_link("http://fonts.googleapis.com/css?family=Rosario", false) }}
         * {{ stylesheet_link("css/style.css") }}
         * </code>
         *
         * @param array $parameters 
         * @param boolean $local 
         * @return string 
         */
        public static function stylesheetLink($parameters = null, $local = true) {}
        /**
         * Builds a SCRIPT[type="javascript"] tag
         * <code>
         * echo Phalcon\Tag::javascriptInclude("http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js", false);
         * echo Phalcon\Tag::javascriptInclude("javascript/jquery.js");
         * </code>
         * Volt syntax:
         * <code>
         * {{ javascript_include("http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js", false) }}
         * {{ javascript_include("javascript/jquery.js") }}
         * </code>
         *
         * @param array $parameters 
         * @param boolean $local 
         * @return string 
         */
        public static function javascriptInclude($parameters = null, $local = true) {}
        /**
         * Builds HTML IMG tags
         * <code>
         * echo Phalcon\Tag::image("img/bg.png");
         * echo Phalcon\Tag::image(array("img/photo.jpg", "alt" => "Some Photo"));
         * </code>
         * Volt Syntax:
         * <code>
         * {{ image("img/bg.png") }}
         * {{ image("img/photo.jpg", "alt": "Some Photo") }}
         * {{ image("http://static.mywebsite.com/img/bg.png", false) }}
         * </code>
         *
         * @param array $parameters 
         * @param boolean $local 
         * @return string 
         */
        public static function image($parameters = null, $local = true) {}
        /**
         * Converts texts into URL-friendly titles
         * <code>
         * echo Phalcon\Tag::friendlyTitle("These are big important news", "-")
         * </code>
         *
         * @param string $text 
         * @param string $separator 
         * @param bool $lowercase 
         * @param mixed $replace 
         * @return string 
         */
        public static function friendlyTitle($text, $separator = "-", $lowercase = true, $replace = null) {}
        /**
         * Set the document type of content
         *
         * @param int $doctype 
         */
        public static function setDocType($doctype) {}
        /**
         * Get the document type declaration of content
         *
         * @return string 
         */
        public static function getDocType() {}
        /**
         * Builds a HTML tag
         * <code>
         * echo Phalcon\Tag::tagHtml(name, parameters, selfClose, onlyStart, eol);
         * </code>
         *
         * @param string $tagName 
         * @param mixed $parameters 
         * @param bool $selfClose 
         * @param bool $onlyStart 
         * @param bool $useEol 
         * @return string 
         */
        public static function tagHtml($tagName, $parameters = null, $selfClose = false, $onlyStart = false, $useEol = false) {}
        /**
         * Builds a HTML tag closing tag
         * <code>
         * echo Phalcon\Tag::tagHtmlClose("script", true)
         * </code>
         *
         * @param string $tagName 
         * @param bool $useEol 
         * @return string 
         */
        public static function tagHtmlClose($tagName, $useEol = false) {}
    }

    /**
     * Phalcon\Text
     * Provides utilities to work with texts
     */
    abstract class Text
    {
        const RANDOM_ALNUM = 0;
        const RANDOM_ALPHA = 1;
        const RANDOM_HEXDEC = 2;
        const RANDOM_NUMERIC = 3;
        const RANDOM_NOZERO = 4;
        /**
         * Converts strings to camelize style
         * <code>
         * echo Phalcon\Text::camelize('coco_bongo'); // CocoBongo
         * echo Phalcon\Text::camelize('co_co-bon_go', '-'); // Co_coBon_go
         * echo Phalcon\Text::camelize('co_co-bon_go', '_-'); // CoCoBonGo
         * </code>
         *
         * @param string $str 
         * @param mixed $delimiter 
         * @return string 
         */
        public static function camelize($str, $delimiter = null) {}
        /**
         * Uncamelize strings which are camelized
         * <code>
         * echo Phalcon\Text::uncamelize('CocoBongo'); // coco_bongo
         * echo Phalcon\Text::uncamelize('CocoBongo', '-'); // coco-bongo
         * </code>
         *
         * @param string $str 
         * @param mixed $delimiter 
         * @return string 
         */
        public static function uncamelize($str, $delimiter = null) {}
        /**
         * Adds a number to a string or increment that number if it already is defined
         * <code>
         * echo Phalcon\Text::increment("a"); // "a_1"
         * echo Phalcon\Text::increment("a_1"); // "a_2"
         * </code>
         *
         * @param string $str 
         * @param string $separator 
         * @return string 
         */
        public static function increment($str, $separator = "_") {}
        /**
         * Generates a random string based on the given type. Type is one of the RANDOM_* constants
         * <code>
         * echo Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM); //"aloiwkqz"
         * </code>
         *
         * @param int $type 
         * @param long $length 
         * @return string 
         */
        public static function random($type = 0, $length = 8) {}
        /**
         * Check if a string starts with a given string
         * <code>
         * echo Phalcon\Text::startsWith("Hello", "He"); // true
         * echo Phalcon\Text::startsWith("Hello", "he", false); // false
         * echo Phalcon\Text::startsWith("Hello", "he"); // true
         * </code>
         *
         * @param string $str 
         * @param string $start 
         * @param bool $ignoreCase 
         * @return bool 
         */
        public static function startsWith($str, $start, $ignoreCase = true) {}
        /**
         * Check if a string ends with a given string
         * <code>
         * echo Phalcon\Text::endsWith("Hello", "llo"); // true
         * echo Phalcon\Text::endsWith("Hello", "LLO", false); // false
         * echo Phalcon\Text::endsWith("Hello", "LLO"); // true
         * </code>
         *
         * @param string $str 
         * @param string $end 
         * @param bool $ignoreCase 
         * @return bool 
         */
        public static function endsWith($str, $end, $ignoreCase = true) {}
        /**
         * Lowercases a string, this function makes use of the mbstring extension if available
         * <code>
         * echo Phalcon\Text::lower("HELLO"); // hello
         * </code>
         *
         * @param string $str 
         * @param string $encoding 
         * @return string 
         */
        public static function lower($str, $encoding = "UTF-8") {}
        /**
         * Uppercases a string, this function makes use of the mbstring extension if available
         * <code>
         * echo Phalcon\Text::upper("hello"); // HELLO
         * </code>
         *
         * @param string $str 
         * @param string $encoding 
         * @return string 
         */
        public static function upper($str, $encoding = "UTF-8") {}
        /**
         * Reduces multiple slashes in a string to single slashes
         * <code>
         * echo Phalcon\Text::reduceSlashes("foo//bar/baz"); // foo/bar/baz
         * echo Phalcon\Text::reduceSlashes("http://foo.bar///baz/buz"); // http://foo.bar/baz/buz
         * </code>
         *
         * @param string $str 
         * @return string 
         */
        public static function reduceSlashes($str) {}
        /**
         * Concatenates strings using the separator only once without duplication in places concatenation
         * <code>
         * $str = Phalcon\Text::concat("/", "/tmp/", "/folder_1/", "/folder_2", "folder_3/");
         * echo $str; // /tmp/folder_1/folder_2/folder_3/
         * </code>
         *
         * @param string $separator 
         * @param string $a 
         * @param string $b 
         * @param string $...N 
         * @return string 
         */
        public static function concat() {}
        /**
         * Generates random text in accordance with the template
         * <code>
         * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!"); // Hi my name is a Bob
         * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!"); // Hi my name is a Jon
         * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!"); // Hello my name is a Bob
         * echo Phalcon\Text::dynamic("[Hi/Hello], my name is a [Zyxep/Mark]!", '[', ']', '/'); // Hello my name is a Zyxep
         * </code>
         *
         * @param string $text 
         * @param string $leftDelimiter 
         * @param string $rightDelimiter 
         * @param string $separator 
         * @return string 
         */
        public static function dynamic($text, $leftDelimiter = "{", $rightDelimiter = "}", $separator = "|") {}
        /**
         * Makes a phrase underscored instead of spaced
         * <code>
         * echo Phalcon\Text::underscore('look behind'); // 'look_behind'
         * echo Phalcon\Text::underscore('Awesome Phalcon'); // 'Awesome_Phalcon'
         * </code>
         *
         * @param string $text 
         * @return string 
         */
        public static function underscore($text) {}
        /**
         * Makes an underscored or dashed phrase human-readable
         * <code>
         * echo Phalcon\Text::humanize('start-a-horse'); // 'start a horse'
         * echo Phalcon\Text::humanize('five_cats'); // 'five cats'
         * </code>
         *
         * @param string $text 
         * @return string 
         */
        public static function humanize($text) {}
    }

    /**
     * Phalcon\Translate
     * Translate component allows the creation of multi-language applications using
     * different adapters for translation lists.
     */
    abstract class Translate
    {
    }

    /**
     * Phalcon\Validation
     * Allows to validate data using custom or built-in validators
     */
    class Validation extends \Phalcon\Di\Injectable implements \Phalcon\ValidationInterface
    {
        protected $_data;
        protected $_entity;
        protected $_validators = array();
        protected $_combinedFieldsValidators;
        protected $_filters;
        protected $_messages;
        protected $_defaultMessages;
        protected $_labels;
        protected $_values;
        /**
         * @param mixed $validators 
         */
        public function setValidators($validators) {}
        /**
         * Phalcon\Validation constructor
         *
         * @param array $validators 
         */
        public function __construct(array $validators = null) {}
        /**
         * Validate a set of data according to a set of rules
         *
         * @param array|object $data 
         * @param object $entity 
         * @return \Phalcon\Validation\Message\Group 
         */
        public function validate($data = null, $entity = null) {}
        /**
         * Adds a validator to a field
         *
         * @param mixed $field 
         * @param mixed $validator 
         * @return Validation 
         */
        public function add($field, \Phalcon\Validation\ValidatorInterface $validator) {}
        /**
         * Alias of `add` method
         *
         * @param mixed $field 
         * @param mixed $validator 
         * @return Validation 
         */
        public function rule($field, \Phalcon\Validation\ValidatorInterface $validator) {}
        /**
         * Adds the validators to a field
         *
         * @param mixed $field 
         * @param array $validators 
         * @return Validation 
         */
        public function rules($field, array $validators) {}
        /**
         * Adds filters to the field
         *
         * @param string $field 
         * @param array|string $filters 
         * @return \Phalcon\Validation 
         */
        public function setFilters($field, $filters) {}
        /**
         * Returns all the filters or a specific one
         *
         * @param string $field 
         * @return mixed 
         */
        public function getFilters($field = null) {}
        /**
         * Returns the validators added to the validation
         *
         * @return array 
         */
        public function getValidators() {}
        /**
         * Sets the bound entity
         *
         * @param object $entity 
         */
        public function setEntity($entity) {}
        /**
         * Returns the bound entity
         *
         * @return object 
         */
        public function getEntity() {}
        /**
         * Adds default messages to validators
         *
         * @param array $messages 
         * @return array 
         */
        public function setDefaultMessages(array $messages = array()) {}
        /**
         * Get default message for validator type
         *
         * @param string $type 
         * @return string 
         */
        public function getDefaultMessage($type) {}
        /**
         * Returns the registered validators
         *
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessages() {}
        /**
         * Adds labels for fields
         *
         * @param array $labels 
         */
        public function setLabels(array $labels) {}
        /**
         * Get label for field
         *
         * @param string $field 
         * @return string 
         */
        public function getLabel($field) {}
        /**
         * Appends a message to the messages list
         *
         * @param mixed $message 
         * @return Validation 
         */
        public function appendMessage(\Phalcon\Validation\MessageInterface $message) {}
        /**
         * Assigns the data to an entity
         * The entity is used to obtain the validation values
         *
         * @param object $entity 
         * @param array|object $data 
         * @return \Phalcon\Validation 
         */
        public function bind($entity, $data) {}
        /**
         * Gets the a value to validate in the array/object data source
         *
         * @param string $field 
         * @return mixed 
         */
        public function getValue($field) {}
        /**
         * Internal validations, if it returns true, then skip the current validator
         *
         * @param mixed $field 
         * @param mixed $validator 
         * @return bool 
         */
        protected function preChecking($field, \Phalcon\Validation\ValidatorInterface $validator) {}
    }

    /**
     * Phalcon\ValidationInterface
     * Interface for the Phalcon\Validation component
     */
    interface ValidationInterface
    {
        /**
         * Validate a set of data according to a set of rules
         *
         * @param array|object $data 
         * @param object $entity 
         * @return \Phalcon\Validation\Message\Group 
         */
        public function validate($data = null, $entity = null);
        /**
         * Adds a validator to a field
         *
         * @param string $field 
         * @param mixed $validator 
         * @return Validation 
         */
        public function add($field, \Phalcon\Validation\ValidatorInterface $validator);
        /**
         * Alias of `add` method
         *
         * @param string $field 
         * @param mixed $validator 
         * @return Validation 
         */
        public function rule($field, \Phalcon\Validation\ValidatorInterface $validator);
        /**
         * Adds the validators to a field
         *
         * @param string $field 
         * @param array $validators 
         * @return Validation 
         */
        public function rules($field, array $validators);
        /**
         * Adds filters to the field
         *
         * @param string $field 
         * @param array|string $filters 
         * @return \Phalcon\Validation 
         */
        public function setFilters($field, $filters);
        /**
         * Returns all the filters or a specific one
         *
         * @param string $field 
         * @return mixed 
         */
        public function getFilters($field = null);
        /**
         * Returns the validators added to the validation
         */
        public function getValidators();
        /**
         * Returns the bound entity
         *
         * @return object 
         */
        public function getEntity();
        /**
         * Adds default messages to validators
         *
         * @param array $messages 
         */
        public function setDefaultMessages(array $messages = array());
        /**
         * Get default message for validator type
         *
         * @param string $type 
         */
        public function getDefaultMessage($type);
        /**
         * Returns the registered validators
         *
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessages();
        /**
         * Adds labels for fields
         *
         * @param array $labels 
         */
        public function setLabels(array $labels);
        /**
         * Get label for field
         *
         * @param string $field 
         * @return string 
         */
        public function getLabel($field);
        /**
         * Appends a message to the messages list
         *
         * @param mixed $message 
         */
        public function appendMessage(\Phalcon\Validation\MessageInterface $message);
        /**
         * Assigns the data to an entity
         * The entity is used to obtain the validation values
         *
         * @param object $entity 
         * @param array|object $data 
         * @return \Phalcon\Validation 
         */
        public function bind($entity, $data);
        /**
         * Gets the a value to validate in the array/object data source
         *
         * @param string $field 
         * @return mixed 
         */
        public function getValue($field);
    }

    /**
     * Phalcon\Version
     * This class allows to get the installed version of the framework
     */
    class Version
    {
        /**
         * The constant referencing the major version. Returns 0
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_MAJOR);
         * </code>
         */
        const VERSION_MAJOR = 0;
        /**
         * The constant referencing the major version. Returns 1
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_MEDIUM);
         * </code>
         */
        const VERSION_MEDIUM = 1;
        /**
         * The constant referencing the major version. Returns 2
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_MINOR);
         * </code>
         */
        const VERSION_MINOR = 2;
        /**
         * The constant referencing the major version. Returns 3
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_SPECIAL);
         * </code>
         */
        const VERSION_SPECIAL = 3;
        /**
         * The constant referencing the major version. Returns 4
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_SPECIAL_NUMBER);
         * </code>
         */
        const VERSION_SPECIAL_NUMBER = 4;
        /**
         * Area where the version number is set. The format is as follows:
         * ABBCCDE
         * A - Major version
         * B - Med version (two digits)
         * C - Min version (two digits)
         * D - Special release: 1 = Alpha, 2 = Beta, 3 = RC, 4 = Stable
         * E - Special release version i.e. RC1, Beta2 etc.
         *
         * @return array 
         */
        protected static function _getVersion() {}
        /**
         * Translates a number to a special release
         * If Special release = 1 this function will return ALPHA
         *
         * @param int $special 
         * @return string 
         */
        protected final static function _getSpecial($special) {}
        /**
         * Returns the active version (string)
         * <code>
         * echo Phalcon\Version::get();
         * </code>
         *
         * @return string 
         */
        public static function get() {}
        /**
         * Returns the numeric active version
         * <code>
         * echo Phalcon\Version::getId();
         * </code>
         *
         * @return string 
         */
        public static function getId() {}
        /**
         * Returns a specific part of the version. If the wrong parameter is passed
         * it will return the full version
         * <code>
         * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_MAJOR);
         * </code>
         *
         * @param int $part 
         * @return string 
         */
        public static function getPart($part) {}
    }
}

namespace \Phalcon\Acl {
    /**
     * Phalcon\Acl\Adapter
     * Adapter for Phalcon\Acl adapters
     */
    abstract class Adapter implements \Phalcon\Acl\AdapterInterface, \Phalcon\Events\EventsAwareInterface
    {
        /**
         * Events manager
         *
         * @var mixed
         */
        protected $_eventsManager;
        /**
         * Default access
         *
         * @var bool
         */
        protected $_defaultAccess = true;
        /**
         * Access Granted
         *
         * @var bool
         */
        protected $_accessGranted = false;
        /**
         * Role which the list is checking if it's allowed to certain resource/access
         *
         * @var mixed
         */
        protected $_activeRole;
        /**
         * Resource which the list is checking if some role can access it
         *
         * @var mixed
         */
        protected $_activeResource;
        /**
         * Active access which the list is checking if some role can access it
         *
         * @var mixed
         */
        protected $_activeAccess;
        /**
         * Role which the list is checking if it's allowed to certain resource/access
         *
         * @return mixed 
         */
        public function getActiveRole() {}
        /**
         * Resource which the list is checking if some role can access it
         *
         * @return mixed 
         */
        public function getActiveResource() {}
        /**
         * Active access which the list is checking if some role can access it
         *
         * @return mixed 
         */
        public function getActiveAccess() {}
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
         *
         * @param int $defaultAccess 
         */
        public function setDefaultAction($defaultAccess) {}
        /**
         * Returns the default ACL access level
         *
         * @return int 
         */
        public function getDefaultAction() {}
    }

    /**
     * Phalcon\Acl\AdapterInterface
     * Interface for Phalcon\Acl adapters
     */
    interface AdapterInterface
    {
        /**
         * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
         *
         * @param int $defaultAccess 
         */
        public function setDefaultAction($defaultAccess);
        /**
         * Returns the default ACL access level
         *
         * @return int 
         */
        public function getDefaultAction();
        /**
         * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY) for no arguments provided in isAllowed action if there exists func for accessKey
         *
         * @param int $defaultAccess 
         */
        public function setNoArgumentsDefaultAction($defaultAccess);
        /**
         * Returns the default ACL access level for no arguments provided in isAllowed action if there exists func for accessKey
         *
         * @return int 
         */
        public function getNoArgumentsDefaultAction();
        /**
         * Adds a role to the ACL list. Second parameter lets to inherit access data from other existing role
         *
         * @param mixed $role 
         * @param mixed $accessInherits 
         * @return bool 
         */
        public function addRole($role, $accessInherits = null);
        /**
         * Do a role inherit from another existing role
         *
         * @param string $roleName 
         * @param mixed $roleToInherit 
         * @return bool 
         */
        public function addInherit($roleName, $roleToInherit);
        /**
         * Check whether role exist in the roles list
         *
         * @param string $roleName 
         * @return bool 
         */
        public function isRole($roleName);
        /**
         * Check whether resource exist in the resources list
         *
         * @param string $resourceName 
         * @return bool 
         */
        public function isResource($resourceName);
        /**
         * Adds a resource to the ACL list
         * Access names can be a particular action, by example
         * search, update, delete, etc or a list of them
         *
         * @param mixed $resourceObject 
         * @param mixed $accessList 
         * @return bool 
         */
        public function addResource($resourceObject, $accessList);
        /**
         * Adds access to resources
         *
         * @param string $resourceName 
         * @param mixed $accessList 
         */
        public function addResourceAccess($resourceName, $accessList);
        /**
         * Removes an access from a resource
         *
         * @param string $resourceName 
         * @param mixed $accessList 
         */
        public function dropResourceAccess($resourceName, $accessList);
        /**
         * Allow access to a role on a resource
         *
         * @param string $roleName 
         * @param string $resourceName 
         * @param mixed $access 
         * @param mixed $func 
         */
        public function allow($roleName, $resourceName, $access, $func = null);
        /**
         * Deny access to a role on a resource
         *
         * @param string $roleName 
         * @param string $resourceName 
         * @param mixed $access 
         * @param mixed $func 
         */
        public function deny($roleName, $resourceName, $access, $func = null);
        /**
         * Check whether a role is allowed to access an action from a resource
         *
         * @param mixed $roleName 
         * @param mixed $resourceName 
         * @param mixed $access 
         * @param array $parameters 
         * @return bool 
         */
        public function isAllowed($roleName, $resourceName, $access, array $parameters = null);
        /**
         * Returns the role which the list is checking if it's allowed to certain resource/access
         *
         * @return string 
         */
        public function getActiveRole();
        /**
         * Returns the resource which the list is checking if some role can access it
         *
         * @return string 
         */
        public function getActiveResource();
        /**
         * Returns the access which the list is checking if some role can access it
         *
         * @return string 
         */
        public function getActiveAccess();
        /**
         * Return an array with every role registered in the list
         *
         * @return RoleInterface[] 
         */
        public function getRoles();
        /**
         * Return an array with every resource registered in the list
         *
         * @return ResourceInterface[] 
         */
        public function getResources();
    }

    /**
     * Phalcon\Acl\Exception
     * Class for exceptions thrown by Phalcon\Acl
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Acl\Resource
     * This class defines resource entity and its description
     */
    class Resource
    {
        /**
         * Resource name
         *
         * @var string
         */
        protected $_name;
        /**
         * Resource description
         *
         * @var string
         */
        protected $_description;
        /**
         * Resource name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Resource name
         *
         * @return string 
         */
        public function __toString() {}
        /**
         * Resource description
         *
         * @return string 
         */
        public function getDescription() {}
        /**
         * Phalcon\Acl\Resource constructor
         *
         * @param string $name 
         * @param string $description 
         */
        public function __construct($name, $description = null) {}
    }

    /**
     * Phalcon\Acl\ResourceAware
     * Interface for classes which could be used in allow method as RESOURCE
     */
    interface ResourceAware
    {
        /**
         * Returns resource name
         *
         * @return string 
         */
        public function getResourceName();
    }

    /**
     * Phalcon\Acl\ResourceInterface
     * Interface for Phalcon\Acl\Resource
     */
    interface ResourceInterface
    {
        /**
         * Returns the resource name
         *
         * @return string 
         */
        public function getName();
        /**
         * Returns resource description
         *
         * @return string 
         */
        public function getDescription();
        /**
         * Magic method __toString
         *
         * @return string 
         */
        public function __toString();
    }

    /**
     * Phalcon\Acl\Role
     * This class defines role entity and its description
     */
    class Role implements \Phalcon\Acl\RoleInterface
    {
        /**
         * Role name
         *
         * @var string
         */
        protected $_name;
        /**
         * Role description
         *
         * @var string
         */
        protected $_description;
        /**
         * Role name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Role name
         *
         * @return string 
         */
        public function __toString() {}
        /**
         * Role description
         *
         * @return string 
         */
        public function getDescription() {}
        /**
         * Phalcon\Acl\Role constructor
         *
         * @param string $name 
         * @param string $description 
         */
        public function __construct($name, $description = null) {}
    }

    /**
     * Phalcon\Acl\RoleAware
     * Interface for classes which could be used in allow method as ROLE
     */
    interface RoleAware
    {
        /**
         * Returns role name
         *
         * @return string 
         */
        public function getRoleName();
    }

    /**
     * Phalcon\Acl\RoleInterface
     * Interface for Phalcon\Acl\Role
     */
    interface RoleInterface
    {
        /**
         * Returns the role name
         *
         * @return string 
         */
        public function getName();
        /**
         * Returns role description
         *
         * @return string 
         */
        public function getDescription();
        /**
         * Magic method __toString
         *
         * @return string 
         */
        public function __toString();
    }
}

namespace \Phalcon\Acl\Adapter {
    /**
     * Phalcon\Acl\Adapter\Memory
     * Manages ACL lists in memory
     * <code>
     * $acl = new \Phalcon\Acl\Adapter\Memory();
     * $acl->setDefaultAction(Phalcon\Acl::DENY);
     * //Register roles
     * $roles = array(
     * 'users' => new \Phalcon\Acl\Role('Users'),
     * 'guests' => new \Phalcon\Acl\Role('Guests')
     * );
     * foreach ($roles as $role) {
     * $acl->addRole($role);
     * }
     * //Private area resources
     * $privateResources = array(
     * 'companies' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
     * 'products' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
     * 'invoices' => array('index', 'profile')
     * );
     * foreach ($privateResources as $resource => $actions) {
     * $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
     * }
     * //Public area resources
     * $publicResources = array(
     * 'index' => array('index'),
     * 'about' => array('index'),
     * 'session' => array('index', 'register', 'start', 'end'),
     * 'contact' => array('index', 'send')
     * );
     * foreach ($publicResources as $resource => $actions) {
     * $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
     * }
     * //Grant access to public areas to both users and guests
     * foreach ($roles as $role){
     * foreach ($publicResources as $resource => $actions) {
     * $acl->allow($role->getName(), $resource, '*');
     * }
     * }
     * //Grant access to private area to role Users
     * foreach ($privateResources as $resource => $actions) {
     * foreach ($actions as $action) {
     * $acl->allow('Users', $resource, $action);
     * }
     * }
     * </code>
     */
    class Memory extends \Phalcon\Acl\Adapter
    {
        /**
         * Roles Names
         *
         * @var mixed
         */
        protected $_rolesNames;
        /**
         * Roles
         *
         * @var mixed
         */
        protected $_roles;
        /**
         * Resource Names
         *
         * @var mixed
         */
        protected $_resourcesNames;
        /**
         * Resources
         *
         * @var mixed
         */
        protected $_resources;
        /**
         * Access
         *
         * @var mixed
         */
        protected $_access;
        /**
         * Role Inherits
         *
         * @var mixed
         */
        protected $_roleInherits;
        /**
         * Access List
         *
         * @var mixed
         */
        protected $_accessList;
        /**
         * Function List
         *
         * @var mixed
         */
        protected $_func;
        /**
         * Default action for no arguments is allow
         *
         * @var mixed
         */
        protected $_noArgumentsDefaultAction = Acl::ALLOW;
        /**
         * Phalcon\Acl\Adapter\Memory constructor
         */
        public function __construct() {}
        /**
         * Adds a role to the ACL list. Second parameter allows inheriting access data from other existing role
         * Example:
         * <code>
         * $acl->addRole(new Phalcon\Acl\Role('administrator'), 'consultant');
         * $acl->addRole('administrator', 'consultant');
         * </code>
         *
         * @param RoleInterface|string $role 
         * @param array|string $accessInherits 
         * @return bool 
         */
        public function addRole($role, $accessInherits = null) {}
        /**
         * Do a role inherit from another existing role
         *
         * @param string $roleName 
         * @param mixed $roleToInherit 
         * @return bool 
         */
        public function addInherit($roleName, $roleToInherit) {}
        /**
         * Check whether role exist in the roles list
         *
         * @param string $roleName 
         * @return bool 
         */
        public function isRole($roleName) {}
        /**
         * Check whether resource exist in the resources list
         *
         * @param string $resourceName 
         * @return bool 
         */
        public function isResource($resourceName) {}
        /**
         * Adds a resource to the ACL list
         * Access names can be a particular action, by example
         * search, update, delete, etc or a list of them
         * Example:
         * <code>
         * //Add a resource to the the list allowing access to an action
         * $acl->addResource(new Phalcon\Acl\Resource('customers'), 'search');
         * $acl->addResource('customers', 'search');
         * //Add a resource  with an access list
         * $acl->addResource(new Phalcon\Acl\Resource('customers'), array('create', 'search'));
         * $acl->addResource('customers', array('create', 'search'));
         * </code>
         *
         * @param \Phalcon\Acl\Resource|string $resourceValue 
         * @param array|string $accessList 
         * @return bool 
         */
        public function addResource($resourceValue, $accessList) {}
        /**
         * Adds access to resources
         *
         * @param string $resourceName 
         * @param array|string $accessList 
         * @return bool 
         */
        public function addResourceAccess($resourceName, $accessList) {}
        /**
         * Removes an access from a resource
         *
         * @param string $resourceName 
         * @param array|string $accessList 
         */
        public function dropResourceAccess($resourceName, $accessList) {}
        /**
         * Checks if a role has access to a resource
         *
         * @param string $roleName 
         * @param string $resourceName 
         * @param mixed $access 
         * @param mixed $action 
         * @param mixed $func 
         */
        protected function _allowOrDeny($roleName, $resourceName, $access, $action, $func = null) {}
        /**
         * Allow access to a role on a resource
         * You can use '*' as wildcard
         * Example:
         * <code>
         * //Allow access to guests to search on customers
         * $acl->allow('guests', 'customers', 'search');
         * //Allow access to guests to search or create on customers
         * $acl->allow('guests', 'customers', array('search', 'create'));
         * //Allow access to any role to browse on products
         * $acl->allow('*', 'products', 'browse');
         * //Allow access to any role to browse on any resource
         * $acl->allow('*', '*', 'browse');
         * </code>
         *
         * @param string $roleName 
         * @param string $resourceName 
         * @param mixed $access 
         * @param mixed $func 
         */
        public function allow($roleName, $resourceName, $access, $func = null) {}
        /**
         * Deny access to a role on a resource
         * You can use '*' as wildcard
         * Example:
         * <code>
         * //Deny access to guests to search on customers
         * $acl->deny('guests', 'customers', 'search');
         * //Deny access to guests to search or create on customers
         * $acl->deny('guests', 'customers', array('search', 'create'));
         * //Deny access to any role to browse on products
         * $acl->deny('*', 'products', 'browse');
         * //Deny access to any role to browse on any resource
         * $acl->deny('*', '*', 'browse');
         * </code>
         *
         * @param string $roleName 
         * @param string $resourceName 
         * @param mixed $access 
         * @param mixed $func 
         */
        public function deny($roleName, $resourceName, $access, $func = null) {}
        /**
         * Check whether a role is allowed to access an action from a resource
         * <code>
         * //Does andres have access to the customers resource to create?
         * $acl->isAllowed('andres', 'Products', 'create');
         * //Do guests have access to any resource to edit?
         * $acl->isAllowed('guests', '*', 'edit');
         * </code>
         *
         * @param mixed $roleName 
         * @param mixed $resourceName 
         * @param string $access 
         * @param array $parameters 
         * @return bool 
         */
        public function isAllowed($roleName, $resourceName, $access, array $parameters = null) {}
        /**
         * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY) for no arguments provided in isAllowed action if there exists func for accessKey
         *
         * @param int $defaultAccess 
         */
        public function setNoArgumentsDefaultAction($defaultAccess) {}
        /**
         * Returns the default ACL access level for no arguments provided in isAllowed action if there exists func for accessKey
         *
         * @return int 
         */
        public function getNoArgumentsDefaultAction() {}
        /**
         * Return an array with every role registered in the list
         *
         * @return Role[] 
         */
        public function getRoles() {}
        /**
         * Return an array with every resource registered in the list
         *
         * @return Resource[] 
         */
        public function getResources() {}
    }
}

namespace \Phalcon\Annotations {
    /**
     * Phalcon\Annotations\Adapter
     * This is the base class for Phalcon\Annotations adapters
     */
    abstract class Adapter implements \Phalcon\Annotations\AdapterInterface
    {
        protected $_reader;
        protected $_annotations;
        /**
         * Sets the annotations parser
         *
         * @param mixed $reader 
         */
        public function setReader(\Phalcon\Annotations\ReaderInterface $reader) {}
        /**
         * Returns the annotation reader
         *
         * @return \Phalcon\Annotations\ReaderInterface 
         */
        public function getReader() {}
        /**
         * Parses or retrieves all the annotations found in a class
         *
         * @param string|object $className 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function get($className) {}
        /**
         * Returns the annotations found in all the class' methods
         *
         * @param string $className 
         * @return array 
         */
        public function getMethods($className) {}
        /**
         * Returns the annotations found in a specific method
         *
         * @param string $className 
         * @param string $methodName 
         * @return \Phalcon\Annotations\Collection 
         */
        public function getMethod($className, $methodName) {}
        /**
         * Returns the annotations found in all the class' methods
         *
         * @param string $className 
         * @return array 
         */
        public function getProperties($className) {}
        /**
         * Returns the annotations found in a specific property
         *
         * @param string $className 
         * @param string $propertyName 
         * @return \Phalcon\Annotations\Collection 
         */
        public function getProperty($className, $propertyName) {}
    }

    /**
     * Phalcon\Annotations\AdapterInterface
     * This interface must be implemented by adapters in Phalcon\Annotations
     */
    interface AdapterInterface
    {
        /**
         * Sets the annotations parser
         *
         * @param mixed $reader 
         */
        public function setReader(\Phalcon\Annotations\ReaderInterface $reader);
        /**
         * Returns the annotation reader
         *
         * @return \Phalcon\Annotations\ReaderInterface 
         */
        public function getReader();
        /**
         * Parses or retrieves all the annotations found in a class
         *
         * @param string|object $className 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function get($className);
        /**
         * Returns the annotations found in all the class' methods
         *
         * @param string $className 
         * @return array 
         */
        public function getMethods($className);
        /**
         * Returns the annotations found in a specific method
         *
         * @param string $className 
         * @param string $methodName 
         * @return \Phalcon\Annotations\Collection 
         */
        public function getMethod($className, $methodName);
        /**
         * Returns the annotations found in all the class' methods
         *
         * @param string $className 
         * @return array 
         */
        public function getProperties($className);
        /**
         * Returns the annotations found in a specific property
         *
         * @param string $className 
         * @param string $propertyName 
         * @return \Phalcon\Annotations\Collection 
         */
        public function getProperty($className, $propertyName);
    }

    /**
     * Phalcon\Annotations\Annotation
     * Represents a single annotation in an annotations collection
     */
    class Annotation
    {
        /**
         * Annotation Name
         *
         * @var string
         */
        protected $_name;
        /**
         * Annotation Arguments
         *
         * @var string
         */
        protected $_arguments;
        /**
         * Annotation ExprArguments
         *
         * @var string
         */
        protected $_exprArguments;
        /**
         * Phalcon\Annotations\Annotation constructor
         *
         * @param array $reflectionData 
         */
        public function __construct(array $reflectionData) {}
        /**
         * Returns the annotation's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Resolves an annotation expression
         *
         * @param array $expr 
         * @return mixed 
         */
        public function getExpression(array $expr) {}
        /**
         * Returns the expression arguments without resolving
         *
         * @return array 
         */
        public function getExprArguments() {}
        /**
         * Returns the expression arguments
         *
         * @return array 
         */
        public function getArguments() {}
        /**
         * Returns the number of arguments that the annotation has
         *
         * @return int 
         */
        public function numberArguments() {}
        /**
         * Returns an argument in a specific position
         *
         * @param int|string $position 
         * @return mixed 
         */
        public function getArgument($position) {}
        /**
         * Returns an argument in a specific position
         *
         * @param int|string $position 
         * @return boolean 
         */
        public function hasArgument($position) {}
        /**
         * Returns a named argument
         *
         * @param string $name 
         * @return mixed 
         */
        public function getNamedArgument($name) {}
        /**
         * Returns a named parameter
         *
         * @param string $name 
         * @return mixed 
         */
        public function getNamedParameter($name) {}
    }

    /**
     * Phalcon\Annotations\Collection
     * Represents a collection of annotations. This class allows to traverse a group of annotations easily
     * <code>
     * //Traverse annotations
     * foreach ($classAnnotations as $annotation) {
     * echo 'Name=', $annotation->getName(), PHP_EOL;
     * }
     * //Check if the annotations has a specific
     * var_dump($classAnnotations->has('Cacheable'));
     * //Get an specific annotation in the collection
     * $annotation = $classAnnotations->get('Cacheable');
     * </code>
     */
    class Collection implements \Iterator, \Countable
    {
        protected $_position = 0;
        protected $_annotations;
        /**
         * Phalcon\Annotations\Collection constructor
         *
         * @param array $reflectionData 
         */
        public function __construct($reflectionData = null) {}
        /**
         * Returns the number of annotations in the collection
         *
         * @return int 
         */
        public function count() {}
        /**
         * Rewinds the internal iterator
         */
        public function rewind() {}
        /**
         * Returns the current annotation in the iterator
         *
         * @return \Phalcon\Annotations\Annotation 
         */
        public function current() {}
        /**
         * Returns the current position/key in the iterator
         *
         * @return int 
         */
        public function key() {}
        /**
         * Moves the internal iteration pointer to the next position
         */
        public function next() {}
        /**
         * Check if the current annotation in the iterator is valid
         *
         * @return bool 
         */
        public function valid() {}
        /**
         * Returns the internal annotations as an array
         *
         * @return Annotation[] 
         */
        public function getAnnotations() {}
        /**
         * Returns the first annotation that match a name
         *
         * @param string $name 
         * @return \Phalcon\Annotations\Annotation 
         */
        public function get($name) {}
        /**
         * Returns all the annotations that match a name
         *
         * @param string $name 
         * @return Annotation[] 
         */
        public function getAll($name) {}
        /**
         * Check if an annotation exists in a collection
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name) {}
    }

    class Exception extends \Exception
    {
    }

    /**
     * Phalcon\Annotations\Reader
     * Parses docblocks returning an array with the found annotations
     */
    class Reader implements \Phalcon\Annotations\ReaderInterface
    {
        /**
         * Reads annotations from the class dockblocks, its methods and/or properties
         *
         * @param string $className 
         * @return array 
         */
        public function parse($className) {}
        /**
         * Parses a raw doc block returning the annotations found
         *
         * @param string $docBlock 
         * @param mixed $file 
         * @param mixed $line 
         * @return array 
         */
        public static function parseDocBlock($docBlock, $file = null, $line = null) {}
    }

    /**
     * Phalcon\Annotations\Reader
     * Parses docblocks returning an array with the found annotations
     */
    interface ReaderInterface
    {
        /**
         * Reads annotations from the class dockblocks, its methods and/or properties
         *
         * @param string $className 
         * @return array 
         */
        public function parse($className);
        /**
         * Parses a raw doc block returning the annotations found
         *
         * @param string $docBlock 
         * @param mixed $file 
         * @param mixed $line 
         * @return array 
         */
        public static function parseDocBlock($docBlock, $file = null, $line = null);
    }

    /**
     * Phalcon\Annotations\Reflection
     * Allows to manipulate the annotations reflection in an OO manner
     * <code>
     * use Phalcon\Annotations\Reader;
     * use Phalcon\Annotations\Reflection;
     * // Parse the annotations in a class
     * $reader = new Reader();
     * $parsing = reader->parse('MyComponent');
     * // Create the reflection
     * $reflection = new Reflection($parsing);
     * // Get the annotations in the class docblock
     * $classAnnotations = reflection->getClassAnnotations();
     * </code>
     */
    class Reflection
    {
        protected $_reflectionData;
        protected $_classAnnotations;
        protected $_methodAnnotations;
        protected $_propertyAnnotations;
        /**
         * Phalcon\Annotations\Reflection constructor
         *
         * @param array $reflectionData 
         */
        public function __construct($reflectionData = null) {}
        /**
         * Returns the annotations found in the class docblock
         *
         * @return bool|\Phalcon\Annotations\Collection 
         */
        public function getClassAnnotations() {}
        /**
         * Returns the annotations found in the methods' docblocks
         *
         * @return bool|Collection[] 
         */
        public function getMethodsAnnotations() {}
        /**
         * Returns the annotations found in the properties' docblocks
         *
         * @return bool|Collection[] 
         */
        public function getPropertiesAnnotations() {}
        /**
         * Returns the raw parsing intermediate definitions used to construct the reflection
         *
         * @return array 
         */
        public function getReflectionData() {}
        /**
         * Restores the state of a Phalcon\Annotations\Reflection variable export
         *
         * @param mixed $data 
         * @return array 
         */
        public static function __set_state($data) {}
    }
}

namespace \Phalcon\Annotations\Adapter {
    /**
     * Phalcon\Annotations\Adapter\Apc
     * Stores the parsed annotations in APC. This adapter is suitable for production
     * <code>
     * $annotations = new \Phalcon\Annotations\Adapter\Apc();
     * </code>
     */
    class Apc extends \Phalcon\Annotations\Adapter
    {
        protected $_prefix = "";
        protected $_ttl = 172800;
        /**
         * Phalcon\Annotations\Adapter\Apc constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads parsed annotations from APC
         *
         * @param string $key 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function read($key) {}
        /**
         * Writes parsed annotations to APC
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, \Phalcon\Annotations\Reflection $data) {}
    }

    /**
     * Phalcon\Annotations\Adapter\Files
     * Stores the parsed annotations in files. This adapter is suitable for production
     * <code>
     * use Phalcon\Annotations\Adapter\Files;
     * $annotations = new Files(['annotationsDir' => 'app/cache/annotations/']);
     * </code>
     */
    class Files extends \Phalcon\Annotations\Adapter
    {
        protected $_annotationsDir = "./";
        /**
         * Phalcon\Annotations\Adapter\Files constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads parsed annotations from files
         *
         * @param string $key 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function read($key) {}
        /**
         * Writes parsed annotations to files
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, \Phalcon\Annotations\Reflection $data) {}
    }

    /**
     * Phalcon\Annotations\Adapter\Memory
     * Stores the parsed annotations in memory. This adapter is the suitable development/testing
     */
    class Memory extends \Phalcon\Annotations\Adapter
    {
        /**
         * Data
         *
         * @var mixed
         */
        protected $_data;
        /**
         * Reads parsed annotations from memory
         *
         * @param string $key 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function read($key) {}
        /**
         * Writes parsed annotations to memory
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, \Phalcon\Annotations\Reflection $data) {}
    }

    /**
     * Phalcon\Annotations\Adapter\Xcache
     * Stores the parsed annotations to XCache. This adapter is suitable for production
     * <code>
     * $annotations = new \Phalcon\Annotations\Adapter\Xcache();
     * </code>
     */
    class Xcache extends \Phalcon\Annotations\Adapter
    {
        /**
         * Reads parsed annotations from XCache
         *
         * @param string $key 
         * @return \Phalcon\Annotations\Reflection 
         */
        public function read($key) {}
        /**
         * Writes parsed annotations to XCache
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, \Phalcon\Annotations\Reflection $data) {}
    }
}

namespace \Phalcon\Application {
    /**
     * Phalcon\Application\Exception
     * Exceptions thrown in Phalcon\Application class will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Assets {
    /**
     * Phalcon\Assets\Collection
     * Represents a collection of resources
     */
    class Collection implements \Countable, \Iterator
    {
        protected $_prefix;
        protected $_local = true;
        protected $_resources = array();
        protected $_codes = array();
        protected $_position;
        protected $_filters = array();
        protected $_attributes = array();
        protected $_join = true;
        protected $_targetUri;
        protected $_targetPath;
        protected $_targetLocal = true;
        protected $_sourcePath;
        public function getPrefix() {}
        public function getLocal() {}
        public function getResources() {}
        public function getCodes() {}
        public function getPosition() {}
        public function getFilters() {}
        public function getAttributes() {}
        public function getJoin() {}
        public function getTargetUri() {}
        public function getTargetPath() {}
        public function getTargetLocal() {}
        public function getSourcePath() {}
        /**
         * Adds a resource to the collection
         *
         * @param mixed $resource 
         * @return Collection 
         */
        public function add(\Phalcon\Assets\Resource $resource) {}
        /**
         * Adds a inline code to the collection
         *
         * @param mixed $code 
         * @return Collection 
         */
        public function addInline(\Phalcon\Assets\Inline $code) {}
        /**
         * Adds a CSS resource to the collection
         *
         * @param string $path 
         * @param mixed $local 
         * @param bool $filter 
         * @param mixed $attributes 
         * @return Collection 
         */
        public function addCss($path, $local = null, $filter = true, $attributes = null) {}
        /**
         * Adds a inline CSS to the collection
         *
         * @param string $content 
         * @param bool $filter 
         * @param mixed $attributes 
         * @return Collection 
         */
        public function addInlineCss($content, $filter = true, $attributes = null) {}
        /**
         * Adds a javascript resource to the collection
         *
         * @param string $path 
         * @param boolean $local 
         * @param boolean $filter 
         * @param array $attributes 
         * @return \Phalcon\Assets\Collection 
         */
        public function addJs($path, $local = null, $filter = true, $attributes = null) {}
        /**
         * Adds a inline javascript to the collection
         *
         * @param string $content 
         * @param bool $filter 
         * @param mixed $attributes 
         * @return Collection 
         */
        public function addInlineJs($content, $filter = true, $attributes = null) {}
        /**
         * Returns the number of elements in the form
         *
         * @return int 
         */
        public function count() {}
        /**
         * Rewinds the internal iterator
         */
        public function rewind() {}
        /**
         * Returns the current resource in the iterator
         *
         * @return \Phalcon\Assets\Resource 
         */
        public function current() {}
        /**
         * Returns the current position/key in the iterator
         *
         * @return int 
         */
        public function key() {}
        /**
         * Moves the internal iteration pointer to the next position
         */
        public function next() {}
        /**
         * Check if the current element in the iterator is valid
         *
         * @return bool 
         */
        public function valid() {}
        /**
         * Sets the target path of the file for the filtered/join output
         *
         * @param string $targetPath 
         * @return Collection 
         */
        public function setTargetPath($targetPath) {}
        /**
         * Sets a base source path for all the resources in this collection
         *
         * @param string $sourcePath 
         * @return Collection 
         */
        public function setSourcePath($sourcePath) {}
        /**
         * Sets a target uri for the generated HTML
         *
         * @param string $targetUri 
         * @return Collection 
         */
        public function setTargetUri($targetUri) {}
        /**
         * Sets a common prefix for all the resources
         *
         * @param string $prefix 
         * @return Collection 
         */
        public function setPrefix($prefix) {}
        /**
         * Sets if the collection uses local resources by default
         *
         * @param bool $local 
         * @return Collection 
         */
        public function setLocal($local) {}
        /**
         * Sets extra HTML attributes
         *
         * @param array $attributes 
         * @return Collection 
         */
        public function setAttributes(array $attributes) {}
        /**
         * Sets an array of filters in the collection
         *
         * @param array $filters 
         * @return Collection 
         */
        public function setFilters(array $filters) {}
        /**
         * Sets the target local
         *
         * @param bool $targetLocal 
         * @return Collection 
         */
        public function setTargetLocal($targetLocal) {}
        /**
         * Sets if all filtered resources in the collection must be joined in a single result file
         *
         * @param bool $join 
         * @return Collection 
         */
        public function join($join) {}
        /**
         * Returns the complete location where the joined/filtered collection must be written
         *
         * @param string $basePath 
         * @return string 
         */
        public function getRealTargetPath($basePath) {}
        /**
         * Adds a filter to the collection
         *
         * @param mixed $filter 
         * @return Collection 
         */
        public function addFilter(\Phalcon\Assets\FilterInterface $filter) {}
    }

    /**
     * Phalcon\Assets\Exception
     * Exceptions thrown in Phalcon\Assets will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Assets\FilterInterface
     * Interface for custom Phalcon\Assets filters
     */
    interface FilterInterface
    {
        /**
         * Filters the content returning a string with the filtered content
         *
         * @param string $content 
         * @return string 
         */
        public function filter($content);
    }

    /**
     * Phalcon\Assets\Inline
     * Represents an inline asset
     * <code>
     * $inline = new \Phalcon\Assets\Inline('js', 'alert("hello world");');
     * </code>
     */
    class Inline
    {
        protected $_type;
        protected $_content;
        protected $_filter;
        protected $_attributes;
        public function getType() {}
        public function getContent() {}
        public function getFilter() {}
        public function getAttributes() {}
        /**
         * Phalcon\Assets\Inline constructor
         *
         * @param string $type 
         * @param string $content 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($type, $content, $filter = true, $attributes = null) {}
        /**
         * Sets the inline's type
         *
         * @param string $type 
         * @return Inline 
         */
        public function setType($type) {}
        /**
         * Sets if the resource must be filtered or not
         *
         * @param bool $filter 
         * @return Inline 
         */
        public function setFilter($filter) {}
        /**
         * Sets extra HTML attributes
         *
         * @param array $attributes 
         * @return Inline 
         */
        public function setAttributes(array $attributes) {}
    }

    /**
     * Phalcon\Assets\Manager
     * Manages collections of CSS/Javascript assets
     */
    class Manager
    {
        /**
         * Options configure
         *
         * @var array
         */
        protected $_options;
        protected $_collections;
        protected $_implicitOutput = true;
        /**
         * Phalcon\Assets\Manager
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Sets the manager options
         *
         * @param array $options 
         * @return Manager 
         */
        public function setOptions(array $options) {}
        /**
         * Returns the manager options
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * Sets if the HTML generated must be directly printed or returned
         *
         * @param bool $implicitOutput 
         * @return Manager 
         */
        public function useImplicitOutput($implicitOutput) {}
        /**
         * Adds a Css resource to the 'css' collection
         * <code>
         * $assets->addCss('css/bootstrap.css');
         * $assets->addCss('http://bootstrap.my-cdn.com/style.css', false);
         * </code>
         *
         * @param string $path 
         * @param mixed $local 
         * @param mixed $filter 
         * @param mixed $attributes 
         * @return Manager 
         */
        public function addCss($path, $local = true, $filter = true, $attributes = null) {}
        /**
         * Adds a inline Css to the 'css' collection
         *
         * @param string $content 
         * @param mixed $filter 
         * @param mixed $attributes 
         * @return Manager 
         */
        public function addInlineCss($content, $filter = true, $attributes = null) {}
        /**
         * Adds a javascript resource to the 'js' collection
         * <code>
         * $assets->addJs('scripts/jquery.js');
         * $assets->addJs('http://jquery.my-cdn.com/jquery.js', false);
         * </code>
         *
         * @param string $path 
         * @param mixed $local 
         * @param mixed $filter 
         * @param mixed $attributes 
         * @return Manager 
         */
        public function addJs($path, $local = true, $filter = true, $attributes = null) {}
        /**
         * Adds a inline javascript to the 'js' collection
         *
         * @param string $content 
         * @param mixed $filter 
         * @param mixed $attributes 
         * @return Manager 
         */
        public function addInlineJs($content, $filter = true, $attributes = null) {}
        /**
         * Adds a resource by its type
         * <code>
         * $assets->addResourceByType('css', new \Phalcon\Assets\Resource\Css('css/style.css'));
         * </code>
         *
         * @param string $type 
         * @param mixed $resource 
         * @return Manager 
         */
        public function addResourceByType($type, \Phalcon\Assets\Resource $resource) {}
        /**
         * Adds a inline code by its type
         *
         * @param string $type 
         * @param mixed $code 
         * @return Manager 
         */
        public function addInlineCodeByType($type, Inline $code) {}
        /**
         * Adds a raw resource to the manager
         * <code>
         * $assets->addResource(new Phalcon\Assets\Resource('css', 'css/style.css'));
         * </code>
         *
         * @param mixed $resource 
         * @return Manager 
         */
        public function addResource(\Phalcon\Assets\Resource $resource) {}
        /**
         * Adds a raw inline code to the manager
         *
         * @param mixed $code 
         * @return Manager 
         */
        public function addInlineCode(Inline $code) {}
        /**
         * Sets a collection in the Assets Manager
         * <code>
         * $assets->set('js', $collection);
         * </code>
         *
         * @param string $id 
         * @param mixed $collection 
         * @return Manager 
         */
        public function set($id, \Phalcon\Assets\Collection $collection) {}
        /**
         * Returns a collection by its id
         * <code>
         * $scripts = $assets->get('js');
         * </code>
         *
         * @param string $id 
         * @return \Phalcon\Assets\Collection 
         */
        public function get($id) {}
        /**
         * Returns the CSS collection of assets
         *
         * @return \Phalcon\Assets\Collection 
         */
        public function getCss() {}
        /**
         * Returns the CSS collection of assets
         *
         * @return \Phalcon\Assets\Collection 
         */
        public function getJs() {}
        /**
         * Creates/Returns a collection of resources
         *
         * @param string $name 
         * @return \Phalcon\Assets\Collection 
         */
        public function collection($name) {}
        /**
         * Traverses a collection calling the callback to generate its HTML
         *
         * @param \Phalcon\Assets\Collection $collection 
         * @param callback $callback 
         * @param string $type 
         * @return string|null 
         */
        public function output(\Phalcon\Assets\Collection $collection, $callback, $type) {}
        /**
         * Traverses a collection and generate its HTML
         *
         * @param \Phalcon\Assets\Collection $collection 
         * @param string $type 
         * @return string|null 
         */
        public function outputInline(\Phalcon\Assets\Collection $collection, $type) {}
        /**
         * Prints the HTML for CSS resources
         *
         * @param string $collectionName 
         * @return string|null 
         */
        public function outputCss($collectionName = null) {}
        /**
         * Prints the HTML for inline CSS
         *
         * @param string $collectionName 
         * @return string|null 
         */
        public function outputInlineCss($collectionName = null) {}
        /**
         * Prints the HTML for JS resources
         *
         * @param string $collectionName 
         * @return string|null 
         */
        public function outputJs($collectionName = null) {}
        /**
         * Prints the HTML for inline JS
         *
         * @param string $collectionName 
         * @return string|null 
         */
        public function outputInlineJs($collectionName = null) {}
        /**
         * Returns existing collections in the manager
         *
         * @return Collection[] 
         */
        public function getCollections() {}
        /**
         * Returns true or false if collection exists
         *
         * @param string $id 
         * @return bool 
         */
        public function exists($id) {}
    }

    /**
     * Phalcon\Assets\Resource
     * Represents an asset resource
     * <code>
     * $resource = new \Phalcon\Assets\Resource('js', 'javascripts/jquery.js');
     * </code>
     */
    class Resource
    {
        /**
         * @var string
         */
        protected $_type;
        /**
         * @var string
         */
        protected $_path;
        /**
         * @var boolean
         */
        protected $_local;
        /**
         * @var boolean
         */
        protected $_filter;
        /**
         * @var array | null
         */
        protected $_attributes;
        protected $_sourcePath;
        protected $_targetPath;
        protected $_targetUri;
        /**
         * @return string 
         */
        public function getType() {}
        /**
         * @return string 
         */
        public function getPath() {}
        /**
         * @return boolean 
         */
        public function getLocal() {}
        /**
         * @return boolean 
         */
        public function getFilter() {}
        /**
         * @return array|null 
         */
        public function getAttributes() {}
        public function getSourcePath() {}
        public function getTargetPath() {}
        public function getTargetUri() {}
        /**
         * Phalcon\Assets\Resource constructor
         *
         * @param string $type 
         * @param string $path 
         * @param boolean $local 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($type, $path, $local = true, $filter = true, $attributes = null) {}
        /**
         * Sets the resource's type
         *
         * @param string $type 
         * @return Resource 
         */
        public function setType($type) {}
        /**
         * Sets the resource's path
         *
         * @param string $path 
         * @return Resource 
         */
        public function setPath($path) {}
        /**
         * Sets if the resource is local or external
         *
         * @param bool $local 
         * @return Resource 
         */
        public function setLocal($local) {}
        /**
         * Sets if the resource must be filtered or not
         *
         * @param bool $filter 
         * @return Resource 
         */
        public function setFilter($filter) {}
        /**
         * Sets extra HTML attributes
         *
         * @param array $attributes 
         * @return Resource 
         */
        public function setAttributes(array $attributes) {}
        /**
         * Sets a target uri for the generated HTML
         *
         * @param string $targetUri 
         * @return Resource 
         */
        public function setTargetUri($targetUri) {}
        /**
         * Sets the resource's source path
         *
         * @param string $sourcePath 
         * @return Resource 
         */
        public function setSourcePath($sourcePath) {}
        /**
         * Sets the resource's target path
         *
         * @param string $targetPath 
         * @return Resource 
         */
        public function setTargetPath($targetPath) {}
        /**
         * Returns the content of the resource as an string
         * Optionally a base path where the resource is located can be set
         *
         * @param string $basePath 
         * @return string 
         */
        public function getContent($basePath = null) {}
        /**
         * Returns the real target uri for the generated HTML
         *
         * @return string 
         */
        public function getRealTargetUri() {}
        /**
         * Returns the complete location where the resource is located
         *
         * @param string $basePath 
         * @return string 
         */
        public function getRealSourcePath($basePath = null) {}
        /**
         * Returns the complete location where the resource must be written
         *
         * @param string $basePath 
         * @return string 
         */
        public function getRealTargetPath($basePath = null) {}
    }
}

namespace \Phalcon\Assets\Filters {
    /**
     * Phalcon\Assets\Filters\Cssmin
     * Minify the css - removes comments
     * removes newlines and line feeds keeping
     * removes last semicolon from last property
     */
    class Cssmin implements \Phalcon\Assets\FilterInterface
    {
        /**
         * Filters the content using CSSMIN
         *
         * @param string $content 
         * @return string 
         */
        public function filter($content) {}
    }

    /**
     * Phalcon\Assets\Filters\Jsmin
     * Deletes the characters which are insignificant to JavaScript. Comments will be removed. Tabs will be
     * replaced with spaces. Carriage returns will be replaced with linefeeds.
     * Most spaces and linefeeds will be removed.
     */
    class Jsmin implements \Phalcon\Assets\FilterInterface
    {
        /**
         * Filters the content using JSMIN
         *
         * @param string $content 
         * @return string 
         */
        public function filter($content) {}
    }

    /**
     * Phalcon\Assets\Filters\None
     * Returns the content without make any modification to the original source
     */
    class None implements \Phalcon\Assets\FilterInterface
    {
        /**
         * Returns the content without be touched
         *
         * @param string $content 
         * @return string 
         */
        public function filter($content) {}
    }
}

namespace \Phalcon\Assets\Inline {
    /**
     * Phalcon\Assets\Inline\Css
     * Represents an inlined CSS
     */
    class Css extends \Phalcon\Assets\Inline
    {
        /**
         * Phalcon\Assets\Inline\Css
         *
         * @param string $content 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($content, $filter = true, $attributes = null) {}
    }

    /**
     * Phalcon\Assets\Inline\Js
     * Represents an inline Javascript
     */
    class Js extends \Phalcon\Assets\Inline
    {
        /**
         * Phalcon\Assets\Inline\Js
         *
         * @param string $content 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($content, $filter = true, $attributes = null) {}
    }
}

namespace \Phalcon\Assets\Resource {
    /**
     * Phalcon\Assets\Resource\Css
     * Represents CSS resources
     */
    class Css extends \Phalcon\Assets\Resource
    {
        /**
         * Phalcon\Assets\Resource\Css
         *
         * @param string $path 
         * @param boolean $local 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($path, $local = true, $filter = true, $attributes = null) {}
    }

    /**
     * Phalcon\Assets\Resource\Js
     * Represents Javascript resources
     */
    class Js extends \Phalcon\Assets\Resource
    {
        /**
         * Phalcon\Assets\Resource\Js
         *
         * @param string $path 
         * @param boolean $local 
         * @param boolean $filter 
         * @param array $attributes 
         */
        public function __construct($path, $local = true, $filter = true, $attributes = null) {}
    }
}

namespace \Phalcon\Cache {
    /**
     * Phalcon\Cache\Backend
     * This class implements common functionality for backend adapters. A backend cache adapter may extend this class
     */
    abstract class Backend
    {
        protected $_frontend;
        protected $_options;
        protected $_prefix = "";
        protected $_lastKey = "";
        protected $_lastLifetime = null;
        protected $_fresh = false;
        protected $_started = false;
        public function getFrontend() {}
        /**
         * @param mixed $frontend 
         */
        public function setFrontend($frontend) {}
        public function getOptions() {}
        /**
         * @param mixed $options 
         */
        public function setOptions($options) {}
        public function getLastKey() {}
        /**
         * @param mixed $lastKey 
         */
        public function setLastKey($lastKey) {}
        /**
         * Phalcon\Cache\Backend constructor
         *
         * @param \Phalcon\Cache\FrontendInterface $frontend 
         * @param array $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Starts a cache. The keyname allows to identify the created fragment
         *
         * @param int|string $keyName 
         * @param int $lifetime 
         * @return mixed 
         */
        public function start($keyName, $lifetime = null) {}
        /**
         * Stops the frontend without store any cached content
         *
         * @param bool $stopBuffer 
         */
        public function stop($stopBuffer = true) {}
        /**
         * Checks whether the last cache is fresh or cached
         *
         * @return bool 
         */
        public function isFresh() {}
        /**
         * Checks whether the cache has starting buffering or not
         *
         * @return bool 
         */
        public function isStarted() {}
        /**
         * Gets the last lifetime set
         *
         * @return int 
         */
        public function getLifetime() {}
    }

    /**
     * Phalcon\Cache\BackendInterface
     * Interface for Phalcon\Cache\Backend adapters
     */
    interface BackendInterface
    {
        /**
         * Starts a cache. The keyname allows to identify the created fragment
         *
         * @param int|string $keyName 
         * @param int $lifetime 
         * @return mixed 
         */
        public function start($keyName, $lifetime = null);
        /**
         * Stops the frontend without store any cached content
         *
         * @param boolean $stopBuffer 
         */
        public function stop($stopBuffer = true);
        /**
         * Returns front-end instance adapter related to the back-end
         *
         * @return mixed 
         */
        public function getFrontend();
        /**
         * Returns the backend options
         *
         * @return array 
         */
        public function getOptions();
        /**
         * Checks whether the last cache is fresh or cached
         *
         * @return bool 
         */
        public function isFresh();
        /**
         * Checks whether the cache has starting buffering or not
         *
         * @return bool 
         */
        public function isStarted();
        /**
         * Sets the last key used in the cache
         *
         * @param string $lastKey 
         */
        public function setLastKey($lastKey);
        /**
         * Gets the last key stored by the cache
         *
         * @return string 
         */
        public function getLastKey();
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null);
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param int $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true);
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName);
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null);
        /**
         * Checks if cache exists and it hasn't expired
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null);
    }

    /**
     * Phalcon\Cache\Exception
     * Exceptions thrown in Phalcon\Cache will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Cache\FrontendInterface
     * Interface for Phalcon\Cache\Frontend adapters
     */
    interface FrontendInterface
    {
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime();
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering();
        /**
         * Starts the frontend
         */
        public function start();
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent();
        /**
         * Stops the frontend
         */
        public function stop();
        /**
         * Serializes data before storing it
         *
         * @param mixed $data 
         */
        public function beforeStore($data);
        /**
         * Unserializes data after retrieving it
         *
         * @param mixed $data 
         */
        public function afterRetrieve($data);
    }

    /**
     * Phalcon\Cache\Multiple
     * Allows to read to chained backend adapters writing to multiple backends
     * <code>
     * use Phalcon\Cache\Frontend\Data as DataFrontend,
     * Phalcon\Cache\Multiple,
     * Phalcon\Cache\Backend\Apc as ApcCache,
     * Phalcon\Cache\Backend\Memcache as MemcacheCache,
     * Phalcon\Cache\Backend\File as FileCache;
     * $ultraFastFrontend = new DataFrontend(array(
     * "lifetime" => 3600
     * ));
     * $fastFrontend = new DataFrontend(array(
     * "lifetime" => 86400
     * ));
     * $slowFrontend = new DataFrontend(array(
     * "lifetime" => 604800
     * ));
     * //Backends are registered from the fastest to the slower
     * $cache = new Multiple(array(
     * new ApcCache($ultraFastFrontend, array(
     * "prefix" => 'cache',
     * )),
     * new MemcacheCache($fastFrontend, array(
     * "prefix" => 'cache',
     * "host" => "localhost",
     * "port" => "11211"
     * )),
     * new FileCache($slowFrontend, array(
     * "prefix" => 'cache',
     * "cacheDir" => "../app/cache/"
     * ))
     * ));
     * //Save, saves in every backend
     * $cache->save('my-key', $data);
     * </code>
     */
    class Multiple
    {
        protected $_backends;
        /**
         * Phalcon\Cache\Multiple constructor
         *
         * @param	Phalcon\Cache\BackendInterface[] backends
         * @param mixed $backends 
         */
        public function __construct($backends = null) {}
        /**
         * Adds a backend
         *
         * @param mixed $backend 
         * @return Multiple 
         */
        public function push(\Phalcon\Cache\BackendInterface $backend) {}
        /**
         * Returns a cached content reading the internal backends
         *
         * @param mixed $keyName 
         * @param long $lifetime 
         * @param  $string|int keyName
         * @return mixed 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Starts every backend
         *
         * @param string|int $keyName 
         * @param long $lifetime 
         */
        public function start($keyName, $lifetime = null) {}
        /**
         * Stores cached content into all backends and stops the frontend
         *
         * @param string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = null) {}
        /**
         * Deletes a value from each backend
         *
         * @param string|int $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Checks if cache exists in at least one backend
         *
         * @param string|int $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Flush all backend(s)
         *
         * @return bool 
         */
        public function flush() {}
    }
}

namespace \Phalcon\Cache\Backend {
    /**
     * Phalcon\Cache\Backend\Apc
     * Allows to cache output fragments, PHP data and raw data using an APC backend
     * <code>
     * use Phalcon\Cache\Backend\Apc;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data for 2 days
     * $frontCache = new FrontData([
     * 'lifetime' => 172800
     * ]);
     * $cache = new Apc($frontCache, [
     * 'prefix' => 'app-data'
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Apc extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the APC backend and stops the frontend
         *
         * @param string|long $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Increment of a given key, by number $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return mixed 
         */
        public function increment($keyName = null, $value = 1) {}
        /**
         * Decrement of a given key, by number $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return mixed 
         */
        public function decrement($keyName = null, $value = 1) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param string $keyName 
         * @return bool 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it hasn't expired
         *
         * @param string|long $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
    }

    /**
     * Phalcon\Cache\Backend\File
     * Allows to cache output fragments using a file backend
     * <code>
     * use Phalcon\Cache\Backend\File;
     * use Phalcon\Cache\Frontend\Output as FrontOutput;
     * // Cache the file for 2 days
     * $frontendOptions = [
     * 'lifetime' => 172800
     * ];
     * // Create a output cache
     * $frontCache = FrontOutput($frontOptions);
     * // Set the cache directory
     * $backendOptions = [
     * 'cacheDir' => '../app/cache/'
     * ];
     * // Create the File backend
     * $cache = new File($frontCache, $backendOptions);
     * $content = $cache->start('my-cache');
     * if ($content === null) {
     * echo '<h1>', time(), '</h1>';
     * $cache->save();
     * } else {
     * echo $content;
     * }
     * </code>
     */
    class File extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        /**
         * Default to false for backwards compatibility
         *
         * @var boolean
         */
        private $_useSafeKey = false;
        /**
         * Phalcon\Cache\Backend\File constructor
         *
         * @param mixed $frontend 
         * @param array $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, array $options) {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param int $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string|int $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string|int $keyName 
         * @param int $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Increment of a given key, by number $value
         *
         * @param string|int $keyName 
         * @param int $value 
         * @return mixed 
         */
        public function increment($keyName = null, $value = 1) {}
        /**
         * Decrement of a given key, by number $value
         *
         * @param string|int $keyName 
         * @param int $value 
         * @return mixed 
         */
        public function decrement($keyName = null, $value = 1) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
        /**
         * Return a file-system safe identifier for a given key
         *
         * @param mixed $key 
         * @return string 
         */
        public function getKey($key) {}
        /**
         * Set whether to use the safekey or not
         *
         * @param bool $useSafeKey 
         * @return File 
         */
        public function useSafeKey($useSafeKey) {}
    }

    /**
     * Phalcon\Cache\Backend\Libmemcached
     * Allows to cache output fragments, PHP data or raw data to a libmemcached backend.
     * Per default persistent memcached connection pools are used.
     * <code>
     * use Phalcon\Cache\Backend\Libmemcached;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data for 2 days
     * $frontCache = new FrontData([
     * 'lifetime' => 172800
     * ]);
     * // Create the Cache setting memcached connection options
     * $cache = new Libmemcached($frontCache, [
     * 'servers' => [
     * [
     * 'host' => 'localhost',
     * 'port' => 11211,
     * 'weight' => 1
     * ],
     * ],
     * 'client' => [
     * \Memcached::OPT_HASH => Memcached::HASH_MD5,
     * \Memcached::OPT_PREFIX_KEY => 'prefix.',
     * ]
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Libmemcached extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        protected $_memcache = null;
        /**
         * Phalcon\Cache\Backend\Memcache constructor
         *
         * @param	Phalcon\Cache\FrontendInterface frontend
         * @param	array options
         * @param mixed $frontend 
         * @param mixed $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Create internal connection to memcached
         */
        public function _connect() {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Increment of given $keyName by $value
         *
         * @param string $keyName 
         * @param mixed $value 
         * @param long $lifetime 
         * @return long 
         */
        public function increment($keyName = null, $value = null) {}
        /**
         * Decrement of $keyName by given $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return long 
         */
        public function decrement($keyName = null, $value = null) {}
        /**
         * Immediately invalidates all existing items.
         * Memcached does not support flush() per default. If you require flush() support, set $config["statsKey"].
         * All modified keys are stored in "statsKey". Note: statsKey has a negative performance impact.
         * <code>
         * $cache = new \Phalcon\Cache\Backend\Libmemcached($frontCache, ["statsKey" => "_PHCM"]);
         * $cache->save('my-data', array(1, 2, 3, 4, 5));
         * //'my-data' and all other used keys are deleted
         * $cache->flush();
         * </code>
         *
         * @return bool 
         */
        public function flush() {}
    }

    /**
     * Phalcon\Cache\Backend\Memcache
     * Allows to cache output fragments, PHP data or raw data to a memcache backend
     * This adapter uses the special memcached key "_PHCM" to store all the keys internally used by the adapter
     * <code>
     * use Phalcon\Cache\Backend\Memcache;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data for 2 days
     * $frontCache = new FrontData([
     * 'lifetime' => 172800
     * ]);
     * // Create the Cache setting memcached connection options
     * $cache = new Memcache($frontCache, [
     * 'host' => 'localhost',
     * 'port' => 11211,
     * 'persistent' => false
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Memcache extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        protected $_memcache = null;
        /**
         * Phalcon\Cache\Backend\Memcache constructor
         *
         * @param	Phalcon\Cache\FrontendInterface frontend
         * @param	array options
         * @param mixed $frontend 
         * @param mixed $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Create internal connection to memcached
         */
        public function _connect() {}
        /**
         * Add servers to memcache pool
         *
         * @param string $host 
         * @param int $port 
         * @param bool $persistent 
         * @return bool 
         */
        public function addServers($host, $port, $persistent = false) {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Increment of given $keyName by $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return long 
         */
        public function increment($keyName = null, $value = null) {}
        /**
         * Decrement of $keyName by given $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return long 
         */
        public function decrement($keyName = null, $value = null) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
    }

    /**
     * Phalcon\Cache\Backend\Memory
     * Stores content in memory. Data is lost when the request is finished
     * <code>
     * use Phalcon\Cache\Backend\Memory;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data
     * $frontCache = new FrontData();
     * $cache = new Memory($frontCache);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Memory extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface, \Serializable
    {
        protected $_data;
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the backend and stops the frontend
         *
         * @param string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string|int $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it hasn't expired
         *
         * @param string|int $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Increment of given $keyName by $value
         *
         * @param string $keyName 
         * @param mixed $value 
         * @param long $lifetime 
         * @return long 
         */
        public function increment($keyName = null, $value = null) {}
        /**
         * Decrement of $keyName by given $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return long 
         */
        public function decrement($keyName = null, $value = null) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
        /**
         * Required for interface \Serializable
         *
         * @return string 
         */
        public function serialize() {}
        /**
         * Required for interface \Serializable
         *
         * @param mixed $data 
         */
        public function unserialize($data) {}
    }

    /**
     * Phalcon\Cache\Backend\Mongo
     * Allows to cache output fragments, PHP data or raw data to a MongoDb backend
     * <code>
     * use Phalcon\Cache\Backend\Mongo;
     * use Phalcon\Cache\Frontend\Base64;
     * // Cache data for 2 days
     * $frontCache = new Base64([
     * 'lifetime' => 172800
     * ]);
     * // Create a MongoDB cache
     * $cache = new Mongo($frontCache, [
     * 'server' => "mongodb://localhost",
     * 'db' => 'caches',
     * 'collection' => 'images'
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', file_get_contents('some-image.jpg'));
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Mongo extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        protected $_collection = null;
        /**
         * Phalcon\Cache\Backend\Mongo constructor
         *
         * @param \Phalcon\Cache\FrontendInterface $frontend 
         * @param array $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Returns a MongoDb collection based on the backend parameters
         *
         * @return MongoCollection 
         */
        protected final function _getCollection() {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * gc
         *
         * @return collection->remove(...) 
         */
        public function gc() {}
        /**
         * Increment of a given key by $value
         *
         * @param int|string $keyName 
         * @param long $value 
         * @return mixed 
         */
        public function increment($keyName, $value = 1) {}
        /**
         * Decrement of a given key by $value
         *
         * @param mixed $keyName 
         * @param mixed $value 
         * @param int|string $$keyName 
         * @param long $$value 
         * @return mixed 
         */
        public function decrement($keyName, $value = 1) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
    }

    /**
     * Phalcon\Cache\Backend\Redis
     * Allows to cache output fragments, PHP data or raw data to a redis backend
     * This adapter uses the special redis key "_PHCR" to store all the keys internally used by the adapter
     * <code>
     * use Phalcon\Cache\Backend\Redis;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data for 2 days
     * $frontCache = new FrontData([
     * 'lifetime' => 172800
     * ]);
     * // Create the Cache setting redis connection options
     * $cache = new Redis($frontCache, [
     * 'host' => 'localhost',
     * 'port' => 6379,
     * 'auth' => 'foobared',
     * 'persistent' => false
     * 'index' => 0,
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Redis extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        protected $_redis = null;
        /**
         * Phalcon\Cache\Backend\Redis constructor
         *
         * @param	Phalcon\Cache\FrontendInterface frontend
         * @param	array options
         * @param mixed $frontend 
         * @param mixed $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Create internal connection to redis
         */
        public function _connect() {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return bool 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Increment of given $keyName by $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return int 
         */
        public function increment($keyName = null, $value = null) {}
        /**
         * Decrement of $keyName by given $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return int 
         */
        public function decrement($keyName = null, $value = null) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
    }

    /**
     * Phalcon\Cache\Backend\Xcache
     * Allows to cache output fragments, PHP data and raw data using an XCache backend
     * <code>
     * use Phalcon\Cache\Backend\Xcache;
     * use Phalcon\Cache\Frontend\Data as FrontData;
     * // Cache data for 2 days
     * $frontCache = new FrontData([
     * 'lifetime' => 172800
     * ]);
     * $cache = new Xcache($frontCache, [
     * 'prefix' => 'app-data'
     * ]);
     * // Cache arbitrary data
     * $cache->save('my-data', [1, 2, 3, 4, 5]);
     * // Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Xcache extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
    {
        /**
         * Phalcon\Cache\Backend\Xcache constructor
         *
         * @param \Phalcon\Cache\FrontendInterface $frontend 
         * @param array $options 
         */
        public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}
        /**
         * Returns a cached content
         *
         * @param string $keyName 
         * @param int $lifetime 
         * @return mixed|null 
         */
        public function get($keyName, $lifetime = null) {}
        /**
         * Stores cached content into the file backend and stops the frontend
         *
         * @param int|string $keyName 
         * @param string $content 
         * @param long $lifetime 
         * @param boolean $stopBuffer 
         * @return bool 
         */
        public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}
        /**
         * Deletes a value from the cache by its key
         *
         * @param int|string $keyName 
         * @return boolean 
         */
        public function delete($keyName) {}
        /**
         * Query the existing cached keys
         *
         * @param string $prefix 
         * @return array 
         */
        public function queryKeys($prefix = null) {}
        /**
         * Checks if cache exists and it isn't expired
         *
         * @param string $keyName 
         * @param long $lifetime 
         * @return boolean 
         */
        public function exists($keyName = null, $lifetime = null) {}
        /**
         * Atomic increment of a given key, by number $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return mixed 
         */
        public function increment($keyName, $value = 1) {}
        /**
         * Atomic decrement of a given key, by number $value
         *
         * @param string $keyName 
         * @param long $value 
         * @return mixed 
         */
        public function decrement($keyName, $value = 1) {}
        /**
         * Immediately invalidates all existing items.
         *
         * @return bool 
         */
        public function flush() {}
    }
}

namespace \Phalcon\Cache\Frontend {
    /**
     * Phalcon\Cache\Frontend\Base64
     * Allows to cache data converting/deconverting them to base64.
     * This adapter uses the base64_encode/base64_decode PHP's functions
     * <code>
     * <?php
     * // Cache the files for 2 days using a Base64 frontend
     * $frontCache = new \Phalcon\Cache\Frontend\Base64(array(
     * "lifetime" => 172800
     * ));
     * //Create a MongoDB cache
     * $cache = new \Phalcon\Cache\Backend\Mongo($frontCache, array(
     * 'server' => "mongodb://localhost",
     * 'db' => 'caches',
     * 'collection' => 'images'
     * ));
     * // Try to get cached image
     * $cacheKey = 'some-image.jpg.cache';
     * $image    = $cache->get($cacheKey);
     * if ($image === null) {
     * // Store the image in the cache
     * $cache->save($cacheKey, file_get_contents('tmp-dir/some-image.jpg'));
     * }
     * header('Content-Type: image/jpeg');
     * echo $image;
     * </code>
     */
    class Base64 implements \Phalcon\Cache\FrontendInterface
    {
        protected $_frontendOptions;
        /**
         * Phalcon\Cache\Frontend\Base64 constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Actually, does nothing in this adapter
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         * @return string 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         * @return mixed 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\Data
     * Allows to cache native PHP data in a serialized form
     * <code>
     * <?php
     * // Cache the files for 2 days using a Data frontend
     * $frontCache = new \Phalcon\Cache\Frontend\Data(array(
     * "lifetime" => 172800
     * ));
     * // Create the component that will cache "Data" to a "File" backend
     * // Set the cache file directory - important to keep the "/" at the end of
     * // of the value for the folder
     * $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
     * "cacheDir" => "../app/cache/"
     * ));
     * // Try to get cached records
     * $cacheKey = 'robots_order_id.cache';
     * $robots    = $cache->get($cacheKey);
     * if ($robots === null) {
     * // $robots is null due to cache expiration or data does not exist
     * // Make the database call and populate the variable
     * $robots = Robots::find(array("order" => "id"));
     * // Store it in the cache
     * $cache->save($cacheKey, $robots);
     * }
     * // Use $robots :)
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     */
    class Data implements \Phalcon\Cache\FrontendInterface
    {
        protected $_frontendOptions;
        /**
         * Phalcon\Cache\Frontend\Data constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Actually, does nothing
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\Igbinary
     * Allows to cache native PHP data in a serialized form using igbinary extension
     * <code>
     * // Cache the files for 2 days using Igbinary frontend
     * $frontCache = new \Phalcon\Cache\Frontend\Igbinary(array(
     * "lifetime" => 172800
     * ));
     * // Create the component that will cache "Igbinary" to a "File" backend
     * // Set the cache file directory - important to keep the "/" at the end of
     * // of the value for the folder
     * $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
     * "cacheDir" => "../app/cache/"
     * ));
     * // Try to get cached records
     * $cacheKey  = 'robots_order_id.cache';
     * $robots    = $cache->get($cacheKey);
     * if ($robots === null) {
     * // $robots is null due to cache expiration or data do not exist
     * // Make the database call and populate the variable
     * $robots = Robots::find(array("order" => "id"));
     * // Store it in the cache
     * $cache->save($cacheKey, $robots);
     * }
     * // Use $robots :)
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     */
    class Igbinary extends \Phalcon\Cache\Frontend\Data implements \Phalcon\Cache\FrontendInterface
    {
        /**
         * Phalcon\Cache\Frontend\Data constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Actually, does nothing
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         * @return string 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         * @return mixed 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\Json
     * Allows to cache data converting/deconverting them to JSON.
     * This adapter uses the json_encode/json_decode PHP's functions
     * As the data is encoded in JSON other systems accessing the same backend could
     * process them
     * <code>
     * <?php
     * // Cache the data for 2 days
     * $frontCache = new \Phalcon\Cache\Frontend\Json(array(
     * "lifetime" => 172800
     * ));
     * //Create the Cache setting memcached connection options
     * $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
     * 'host' => 'localhost',
     * 'port' => 11211,
     * 'persistent' => false
     * ));
     * //Cache arbitrary data
     * $cache->save('my-data', array(1, 2, 3, 4, 5));
     * //Get data
     * $data = $cache->get('my-data');
     * </code>
     */
    class Json implements \Phalcon\Cache\FrontendInterface
    {
        protected $_frontendOptions;
        /**
         * Phalcon\Cache\Frontend\Base64 constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Actually, does nothing
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         * @return string 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         * @return mixed 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\Msgpack
     * Allows to cache native PHP data in a serialized form using msgpack extension
     * This adapter uses a Msgpack frontend to store the cached content and requires msgpack extension.
     *
     * @link https://github.com/msgpack/msgpack-php
     * <code>
     * use Phalcon\Cache\Backend\File;
     * use Phalcon\Cache\Frontend\Msgpack;
     * // Cache the files for 2 days using Msgpack frontend
     * $frontCache = new Msgpack([
     * 'lifetime' => 172800
     * ]);
     * // Create the component that will cache "Msgpack" to a "File" backend
     * // Set the cache file directory - important to keep the "/" at the end of
     * // of the value for the folder
     * $cache = new File($frontCache, [
     * 'cacheDir' => '../app/cache/'
     * ]);
     * // Try to get cached records
     * $cacheKey = 'robots_order_id.cache';
     * $robots   = $cache->get($cacheKey);
     * if ($robots === null) {
     * // $robots is null due to cache expiration or data do not exist
     * // Make the database call and populate the variable
     * $robots = Robots::find(['order' => 'id']);
     * // Store it in the cache
     * $cache->save($cacheKey, $robots);
     * }
     * // Use $robots
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     */
    class Msgpack extends \Phalcon\Cache\Frontend\Data implements \Phalcon\Cache\FrontendInterface
    {
        /**
         * Phalcon\Cache\Frontend\Msgpack constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Actually, does nothing
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return null 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         * @return string 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         * @return string 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\None
     * Discards any kind of frontend data input. This frontend does not have expiration time or any other options
     * <code>
     * <?php
     * //Create a None Cache
     * $frontCache = new \Phalcon\Cache\Frontend\None();
     * // Create the component that will cache "Data" to a "Memcached" backend
     * // Memcached connection settings
     * $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
     * "host" => "localhost",
     * "port" => "11211"
     * ));
     * // This Frontend always return the data as it's returned by the backend
     * $cacheKey = 'robots_order_id.cache';
     * $robots    = $cache->get($cacheKey);
     * if ($robots === null) {
     * // This cache doesn't perform any expiration checking, so the data is always expired
     * // Make the database call and populate the variable
     * $robots = Robots::find(array("order" => "id"));
     * $cache->save($cacheKey, $robots);
     * }
     * // Use $robots :)
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     */
    class None implements \Phalcon\Cache\FrontendInterface
    {
        /**
         * Returns cache lifetime, always one second expiring content
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output, always false
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Prepare data to be stored
         *
         * @param mixed $data 
         * @param mixed $$data 
         */
        public function beforeStore($data) {}
        /**
         * Prepares data to be retrieved to user
         *
         * @param mixed $data 
         * @param mixed $$data 
         */
        public function afterRetrieve($data) {}
    }

    /**
     * Phalcon\Cache\Frontend\Output
     * Allows to cache output fragments captured with ob_* functions
     * <code>
     * <?php
     * //Create an Output frontend. Cache the files for 2 days
     * $frontCache = new \Phalcon\Cache\Frontend\Output(array(
     * "lifetime" => 172800
     * ));
     * // Create the component that will cache from the "Output" to a "File" backend
     * // Set the cache file directory - it's important to keep the "/" at the end of
     * // the value for the folder
     * $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
     * "cacheDir" => "../app/cache/"
     * ));
     * // Get/Set the cache file to ../app/cache/my-cache.html
     * $content = $cache->start("my-cache.html");
     * // If $content is null then the content will be generated for the cache
     * if ($content === null) {
     * //Print date and time
     * echo date("r");
     * //Generate a link to the sign-up action
     * echo Phalcon\Tag::linkTo(
     * array(
     * "user/signup",
     * "Sign Up",
     * "class" => "signup-button"
     * )
     * );
     * // Store the output into the cache file
     * $cache->save();
     * } else {
     * // Echo the cached output
     * echo $content;
     * }
     * </code>
     */
    class Output implements \Phalcon\Cache\FrontendInterface
    {
        protected $_buffering = false;
        protected $_frontendOptions;
        /**
         * Phalcon\Cache\Frontend\Output constructor
         *
         * @param array $frontendOptions 
         */
        public function __construct($frontendOptions = null) {}
        /**
         * Returns the cache lifetime
         *
         * @return int 
         */
        public function getLifetime() {}
        /**
         * Check whether if frontend is buffering output
         *
         * @return bool 
         */
        public function isBuffering() {}
        /**
         * Starts output frontend. Currently, does nothing
         */
        public function start() {}
        /**
         * Returns output cached content
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Stops output frontend
         */
        public function stop() {}
        /**
         * Serializes data before storing them
         *
         * @param mixed $data 
         * @return string 
         */
        public function beforeStore($data) {}
        /**
         * Unserializes data after retrieval
         *
         * @param mixed $data 
         * @return mixed 
         */
        public function afterRetrieve($data) {}
    }
}

namespace \Phalcon\Cli {
    /**
     * Phalcon\Cli\Console
     * This component allows to create CLI applications using Phalcon
     */
    class Console extends \Phalcon\Application
    {
        protected $_arguments = array();
        protected $_options = array();
        /**
         * Merge modules with the existing ones
         * <code>
         * application->addModules(array(
         * 'admin' => array(
         * 'className' => 'Multiple\Admin\Module',
         * 'path' => '../apps/admin/Module.php'
         * )
         * ));
         * </code>
         *
         * @param array $modules
         */
        public function addModules(array $modules) {}
        /**
         * Handle the whole command-line tasks
         *
         * @param array $arguments
         */
        public function handle(array $arguments = null) {}
        /**
         * Set an specific argument
         *
         * @param array $arguments
         * @param bool $str
         * @param bool $shift
         * @return Console
         */
        public function setArgument(array $arguments = null, $str = true, $shift = true) {}
    }

    /**
     * Phalcon\Cli\Dispatcher
     * Dispatching is the process of taking the command-line arguments, extracting the module name,
     * task name, action name, and optional parameters contained in it, and then
     * instantiating a task and calling an action on it.
     * <code>
     * $di = new \Phalcon\Di();
     * $dispatcher = new \Phalcon\Cli\Dispatcher();
     * $dispatcher->setDi(di);
     * $dispatcher->setTaskName('posts');
     * $dispatcher->setActionName('index');
     * $dispatcher->setParams(array());
     * $handle = dispatcher->dispatch();
     * </code>
     */
    class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Cli\DispatcherInterface
    {
        protected $_handlerSuffix = "Task";
        protected $_defaultHandler = "main";
        protected $_defaultAction = "main";
        protected $_options = array();
        /**
         * Sets the default task suffix
         *
         * @param string $taskSuffix 
         */
        public function setTaskSuffix($taskSuffix) {}
        /**
         * Sets the default task name
         *
         * @param string $taskName 
         */
        public function setDefaultTask($taskName) {}
        /**
         * Sets the task name to be dispatched
         *
         * @param string $taskName 
         */
        public function setTaskName($taskName) {}
        /**
         * Gets last dispatched task name
         *
         * @return string 
         */
        public function getTaskName() {}
        /**
         * Throws an internal exception
         *
         * @param string $message 
         * @param int $exceptionCode 
         */
        protected function _throwDispatchException($message, $exceptionCode = 0) {}
        /**
         * Handles a user exception
         *
         * @param mixed $exception 
         */
        protected function _handleException(\Exception $exception) {}
        /**
         * Returns the lastest dispatched controller
         *
         * @return TaskInterface 
         */
        public function getLastTask() {}
        /**
         * Returns the active task in the dispatcher
         *
         * @return TaskInterface 
         */
        public function getActiveTask() {}
        /**
         * Set the options to be dispatched
         *
         * @param array $options 
         */
        public function setOptions(array $options) {}
        /**
         * Get dispatched options
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * @param mixed $handler 
         * @param string $actionMethod 
         * @param array $params 
         */
        public function callActionMethod($handler, $actionMethod, array $params = array()) {}
    }

    /**
     * Phalcon\Cli\DispatcherInterface
     * Interface for Phalcon\Cli\Dispatcher
     */
    interface DispatcherInterface extends \Phalcon\DispatcherInterface
    {
        /**
         * Sets the default task suffix
         *
         * @param string $taskSuffix 
         */
        public function setTaskSuffix($taskSuffix);
        /**
         * Sets the default task name
         *
         * @param string $taskName 
         */
        public function setDefaultTask($taskName);
        /**
         * Sets the task name to be dispatched
         *
         * @param string $taskName 
         */
        public function setTaskName($taskName);
        /**
         * Gets last dispatched task name
         *
         * @return string 
         */
        public function getTaskName();
        /**
         * Returns the latest dispatched controller
         *
         * @return TaskInterface 
         */
        public function getLastTask();
        /**
         * Returns the active task in the dispatcher
         *
         * @return TaskInterface 
         */
        public function getActiveTask();
    }

    /**
     * Phalcon\Cli\Router
     * <p>Phalcon\Cli\Router is the standard framework router. Routing is the
     * process of taking a command-line arguments and
     * decomposing it into parameters to determine which module, task, and
     * action of that task should receive the request</p>
     * <code>
     * $router = new \Phalcon\Cli\Router();
     * $router->handle(array(
     * 'module' => 'main',
     * 'task' => 'videos',
     * 'action' => 'process'
     * ));
     * echo $router->getTaskName();
     * </code>
     */
    class Router implements \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_module;
        protected $_task;
        protected $_action;
        protected $_params = array();
        protected $_defaultModule = null;
        protected $_defaultTask = null;
        protected $_defaultAction = null;
        protected $_defaultParams = array();
        protected $_routes;
        protected $_matchedRoute;
        protected $_matches;
        protected $_wasMatched = false;
        /**
         * Phalcon\Cli\Router constructor
         *
         * @param bool $defaultRoutes 
         */
        public function __construct($defaultRoutes = true) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the name of the default module
         *
         * @param string $moduleName 
         */
        public function setDefaultModule($moduleName) {}
        /**
         * Sets the default controller name
         *
         * @param string $taskName 
         */
        public function setDefaultTask($taskName) {}
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         */
        public function setDefaultAction($actionName) {}
        /**
         * Sets an array of default paths. If a route is missing a path the router will use the defined here
         * This method must not be used to set a 404 route
         * <code>
         * $router->setDefaults(array(
         * 'module' => 'common',
         * 'action' => 'index'
         * ));
         * </code>
         *
         * @param array $defaults 
         * @return Router 
         */
        public function setDefaults(array $defaults) {}
        /**
         * Handles routing information received from command-line arguments
         *
         * @param array $arguments 
         */
        public function handle($arguments = null) {}
        /**
         * Adds a route to the router
         * <code>
         * $router->add('/about', 'About::main');
         * </code>
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Cli\Router\Route 
         */
        public function add($pattern, $paths = null) {}
        /**
         * Returns proccesed module name
         *
         * @return string 
         */
        public function getModuleName() {}
        /**
         * Returns proccesed task name
         *
         * @return string 
         */
        public function getTaskName() {}
        /**
         * Returns processed action name
         *
         * @return string 
         */
        public function getActionName() {}
        /**
         * Returns processed extra params
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Returns the route that matches the handled URI
         *
         * @return RouteInterface 
         */
        public function getMatchedRoute() {}
        /**
         * Returns the sub expressions in the regular expression matched
         *
         * @return array 
         */
        public function getMatches() {}
        /**
         * Checks if the router matches any of the defined routes
         *
         * @return bool 
         */
        public function wasMatched() {}
        /**
         * Returns all the routes defined in the router
         *
         * @return Route[] 
         */
        public function getRoutes() {}
        /**
         * Returns a route object by its id
         *
         * @param int $id 
         * @return \Phalcon\Cli\Router\Route 
         */
        public function getRouteById($id) {}
        /**
         * Returns a route object by its name
         *
         * @param string $name 
         * @return bool|RouteInterface 
         */
        public function getRouteByName($name) {}
    }

    /**
     * Phalcon\Cli\RouterInterface
     * Interface for Phalcon\Cli\Router
     */
    interface RouterInterface
    {
        /**
         * Sets the name of the default module
         *
         * @param string $moduleName 
         */
        public function setDefaultModule($moduleName);
        /**
         * Sets the default task name
         *
         * @param string $taskName 
         */
        public function setDefaultTask($taskName);
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         */
        public function setDefaultAction($actionName);
        /**
         * Sets an array of default paths
         *
         * @param array $defaults 
         */
        public function setDefaults(array $defaults);
        /**
         * Handles routing information received from the rewrite engine
         *
         * @param array $arguments 
         */
        public function handle($arguments = null);
        /**
         * Adds a route to the router on any HTTP method
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Cli\Router\RouteInterface 
         */
        public function add($pattern, $paths = null);
        /**
         * Returns processed module name
         *
         * @return string 
         */
        public function getModuleName();
        /**
         * Returns processed task name
         *
         * @return string 
         */
        public function getTaskName();
        /**
         * Returns processed action name
         *
         * @return string 
         */
        public function getActionName();
        /**
         * Returns processed extra params
         *
         * @return array 
         */
        public function getParams();
        /**
         * Returns the route that matches the handled URI
         *
         * @return \Phalcon\Cli\Router\RouteInterface 
         */
        public function getMatchedRoute();
        /**
         * Return the sub expressions in the regular expression matched
         *
         * @return array 
         */
        public function getMatches();
        /**
         * Check if the router matches any of the defined routes
         *
         * @return bool 
         */
        public function wasMatched();
        /**
         * Return all the routes defined in the router
         *
         * @return RouteInterface[] 
         */
        public function getRoutes();
        /**
         * Returns a route object by its id
         *
         * @param mixed $id 
         * @return \Phalcon\Cli\Router\RouteInterface 
         */
        public function getRouteById($id);
        /**
         * Returns a route object by its name
         *
         * @param string $name 
         * @return \Phalcon\Cli\Router\RouteInterface 
         */
        public function getRouteByName($name);
    }

    /**
     * Phalcon\Cli\Task
     * Every command-line task should extend this class that encapsulates all the task functionality
     * A task can be used to run "tasks" such as migrations, cronjobs, unit-tests, or anything that you want.
     * The Task class should at least have a "mainAction" method
     * <code>
     * class HelloTask extends \Phalcon\Cli\Task
     * {
     * // This action will be executed by default
     * public function mainAction()
     * {
     * }
     * public function findAction()
     * {
     * }
     * }
     * </code>
     */
    class Task extends \Phalcon\Di\Injectable implements \Phalcon\Cli\TaskInterface
    {
        /**
         * Phalcon\Cli\Task constructor
         */
        public final function __construct() {}
    }

    /**
     * Phalcon\Cli\TaskInterface
     * Interface for task handlers
     */
    interface TaskInterface
    {
    }
}

namespace \Phalcon\Cli\Console {
    /**
     * Phalcon\Cli\Console\Exception
     * Exceptions thrown in Phalcon\Cli\Console will use this class
     */
    class Exception extends \Phalcon\Application\Exception
    {
    }
}

namespace \Phalcon\Cli\Dispatcher {
    /**
     * Phalcon\Cli\Dispatcher\Exception
     * Exceptions thrown in Phalcon\Cli\Dispatcher will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Cli\Router {
    /**
     * Phalcon\Cli\Router\Exception
     * Exceptions thrown in Phalcon\Cli\Router will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Cli\Router\Route
     * This class represents every route added to the router
     */
    class Route
    {
        const DEFAULT_DELIMITER = " ";
        protected $_pattern;
        protected $_compiledPattern;
        protected $_paths;
        protected $_converters;
        protected $_id;
        protected $_name;
        protected $_beforeMatch;
        protected $_delimiter;
        static protected $_uniqueId;
        static protected $_delimiterPath;
        /**
         * Phalcon\Cli\Router\Route constructor
         *
         * @param string $pattern 
         * @param array $paths 
         */
        public function __construct($pattern, $paths = null) {}
        /**
         * Replaces placeholders from pattern returning a valid PCRE regular expression
         *
         * @param string $pattern 
         * @return string 
         */
        public function compilePattern($pattern) {}
        /**
         * Extracts parameters from a string
         *
         * @param string $pattern 
         * @return array|boolean 
         */
        public function extractNamedParams($pattern) {}
        /**
         * Reconfigure the route adding a new pattern and a set of paths
         *
         * @param string $pattern 
         * @param array $paths 
         */
        public function reConfigure($pattern, $paths = null) {}
        /**
         * Returns the route's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Sets the route's name
         * <code>
         * $router->add('/about', array(
         * 'controller' => 'about'
         * ))->setName('about');
         * </code>
         *
         * @param string $name 
         * @return Route 
         */
        public function setName($name) {}
        /**
         * Sets a callback that is called if the route is matched.
         * The developer can implement any arbitrary conditions here
         * If the callback returns false the route is treated as not matched
         *
         * @param callback $callback 
         * @return \Phalcon\Cli\Router\Route 
         */
        public function beforeMatch($callback) {}
        /**
         * Returns the 'before match' callback if any
         *
         * @return mixed 
         */
        public function getBeforeMatch() {}
        /**
         * Returns the route's id
         *
         * @return string 
         */
        public function getRouteId() {}
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getPattern() {}
        /**
         * Returns the route's compiled pattern
         *
         * @return string 
         */
        public function getCompiledPattern() {}
        /**
         * Returns the paths
         *
         * @return array 
         */
        public function getPaths() {}
        /**
         * Returns the paths using positions as keys and names as values
         *
         * @return array 
         */
        public function getReversedPaths() {}
        /**
         * Adds a converter to perform an additional transformation for certain parameter
         *
         * @param string $name 
         * @param callable $converter 
         * @return \Phalcon\Cli\Router\Route 
         */
        public function convert($name, $converter) {}
        /**
         * Returns the router converter
         *
         * @return array 
         */
        public function getConverters() {}
        /**
         * Resets the internal route id generator
         */
        public static function reset() {}
        /**
         * Set the routing delimiter
         *
         * @param string $delimiter 
         */
        public static function delimiter($delimiter = null) {}
        /**
         * Get routing delimiter
         *
         * @return string 
         */
        public static function getDelimiter() {}
    }

    /**
     * Phalcon\Cli\Router\RouteInterface
     * Interface for Phalcon\Cli\Router\Route
     */
    interface RouteInterface
    {
        /**
         * Replaces placeholders from pattern returning a valid PCRE regular expression
         *
         * @param string $pattern 
         * @return string 
         */
        public function compilePattern($pattern);
        /**
         * Reconfigure the route adding a new pattern and a set of paths
         *
         * @param string $pattern 
         * @param mixed $paths 
         */
        public function reConfigure($pattern, $paths = null);
        /**
         * Returns the route's name
         *
         * @return string 
         */
        public function getName();
        /**
         * Sets the route's name
         *
         * @param string $name 
         */
        public function setName($name);
        /**
         * Returns the route's id
         *
         * @return string 
         */
        public function getRouteId();
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getPattern();
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getCompiledPattern();
        /**
         * Returns the paths
         *
         * @return array 
         */
        public function getPaths();
        /**
         * Returns the paths using positions as keys and names as values
         *
         * @return array 
         */
        public function getReversedPaths();
        /**
         * Resets the internal route id generator
         */
        public static function reset();
    }
}

namespace \Phalcon\Config {
    /**
     * Phalcon\Config\Exception
     * Exceptions thrown in Phalcon\Config will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Config\Adapter {
    /**
     * Phalcon\Config\Adapter\Ini
     * Reads ini files and converts them to Phalcon\Config objects.
     * Given the next configuration file:
     * <code>
     * [database]
     * adapter = Mysql
     * host = localhost
     * username = scott
     * password = cheetah
     * dbname = test_db
     * [phalcon]
     * controllersDir = "../app/controllers/"
     * modelsDir = "../app/models/"
     * viewsDir = "../app/views/"
     * </code>
     * You can read it as follows:
     * <code>
     * $config = new Phalcon\Config\Adapter\Ini("path/config.ini");
     * echo $config->phalcon->controllersDir;
     * echo $config->database->username;
     * </code>
     */
    class Ini extends \Phalcon\Config
    {
        /**
         * Phalcon\Config\Adapter\Ini constructor
         *
         * @param string $filePath 
         */
        public function __construct($filePath) {}
        /**
         * Build multidimensional array from string
         * <code>
         * $this->_parseIniString('path.hello.world', 'value for last key');
         * // result
         * [
         * 'path' => [
         * 'hello' => [
         * 'world' => 'value for last key',
         * ],
         * ],
         * ];
         * </code>
         *
         * @param string $path 
         * @param mixed $value 
         * @return array 
         */
        protected function _parseIniString($path, $value) {}
        /**
         * We have to cast values manually because parse_ini_file() has a poor implementation.
         *
         * @param mixed $ini The array casted by `parse_ini_file`
         * @return bool|null|double|int|string 
         */
        private function _cast($ini) {}
    }

    /**
     * Phalcon\Config\Adapter\Json
     * Reads JSON files and converts them to Phalcon\Config objects.
     * Given the following configuration file:
     * <code>
     * {"phalcon":{"baseuri":"\/phalcon\/"},"models":{"metadata":"memory"}}
     * </code>
     * You can read it as follows:
     * <code>
     * $config = new Phalcon\Config\Adapter\Json("path/config.json");
     * echo $config->phalcon->baseuri;
     * echo $config->models->metadata;
     * </code>
     */
    class Json extends \Phalcon\Config
    {
        /**
         * Phalcon\Config\Adapter\Json constructor
         *
         * @param string $filePath 
         */
        public function __construct($filePath) {}
    }

    /**
     * Phalcon\Config\Adapter\Php
     * Reads php files and converts them to Phalcon\Config objects.
     * Given the next configuration file:
     * <code>
     * <?php
     * return array(
     * 'database' => array(
     * 'adapter' => 'Mysql',
     * 'host' => 'localhost',
     * 'username' => 'scott',
     * 'password' => 'cheetah',
     * 'dbname' => 'test_db'
     * ),
     * 'phalcon' => array(
     * 'controllersDir' => '../app/controllers/',
     * 'modelsDir' => '../app/models/',
     * 'viewsDir' => '../app/views/'
     * ));
     * </code>
     * You can read it as follows:
     * <code>
     * $config = new Phalcon\Config\Adapter\Php("path/config.php");
     * echo $config->phalcon->controllersDir;
     * echo $config->database->username;
     * </code>
     */
    class Php extends \Phalcon\Config
    {
        /**
         * Phalcon\Config\Adapter\Php constructor
         *
         * @param string $filePath 
         */
        public function __construct($filePath) {}
    }

    /**
     * Phalcon\Config\Adapter\Yaml
     * Reads YAML files and converts them to Phalcon\Config objects.
     * Given the following configuration file:
     * <code>
     * phalcon:
     * baseuri:        /phalcon/
     * controllersDir: !approot  /app/controllers/
     * models:
     * metadata: memory
     * </code>
     * You can read it as follows:
     * <code>
     * define('APPROOT', dirname(__DIR__));
     * $config = new Phalcon\Config\Adapter\Yaml("path/config.yaml", [
     * '!approot' => function($value) {
     * return APPROOT . $value;
     * }
     * ]);
     * echo $config->phalcon->controllersDir;
     * echo $config->phalcon->baseuri;
     * echo $config->models->metadata;
     * </code>
     */
    class Yaml extends \Phalcon\Config
    {
        /**
         * Phalcon\Config\Adapter\Yaml constructor
         *
         * @throws \Phalcon\Config\Exception
         * @param string $filePath 
         * @param array $callbacks 
         */
        public function __construct($filePath, array $callbacks = null) {}
    }
}

namespace \Phalcon\Crypt {
    /**
     * Phalcon\Crypt\Exception
     * Exceptions thrown in Phalcon\Crypt use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Db {
    /**
     * Phalcon\Db\Adapter
     * Base class for Phalcon\Db adapters
     */
    abstract class Adapter implements \Phalcon\Events\EventsAwareInterface
    {
        /**
         * Event Manager
         *
         * @var Phalcon\Events\Manager
         */
        protected $_eventsManager;
        /**
         * Descriptor used to connect to a database
         */
        protected $_descriptor = array();
        /**
         * Name of the dialect used
         */
        protected $_dialectType;
        /**
         * Type of database system the adapter is used for
         */
        protected $_type;
        /**
         * Dialect instance
         */
        protected $_dialect;
        /**
         * Active connection ID
         *
         * @var long
         */
        protected $_connectionId;
        /**
         * Active SQL Statement
         *
         * @var string
         */
        protected $_sqlStatement;
        /**
         * Active SQL bound parameter variables
         *
         * @var string
         */
        protected $_sqlVariables;
        /**
         * Active SQL Bind Types
         *
         * @var string
         */
        protected $_sqlBindTypes;
        /**
         * Current transaction level
         */
        protected $_transactionLevel = 0;
        /**
         * Whether the database supports transactions with save points
         */
        protected $_transactionsWithSavepoints = false;
        /**
         * Connection ID
         */
        static protected $_connectionConsecutive = 0;
        /**
         * Name of the dialect used
         */
        public function getDialectType() {}
        /**
         * Type of database system the adapter is used for
         */
        public function getType() {}
        /**
         * Active SQL bound parameter variables
         *
         * @return string 
         */
        public function getSqlVariables() {}
        /**
         * Phalcon\Db\Adapter constructor
         *
         * @param array $descriptor 
         */
        public function __construct(array $descriptor) {}
        /**
         * Sets the event manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets the dialect used to produce the SQL
         *
         * @param mixed $dialect 
         */
        public function setDialect(DialectInterface $dialect) {}
        /**
         * Returns internal dialect instance
         *
         * @return DialectInterface 
         */
        public function getDialect() {}
        /**
         * Returns the first row in a SQL query result
         * <code>
         * //Getting first robot
         * $robot = $connection->fetchOne("SELECTFROM robots");
         * print_r($robot);
         * //Getting first robot with associative indexes only
         * $robot = $connection->fetchOne("SELECTFROM robots", Phalcon\Db::FETCH_ASSOC);
         * print_r($robot);
         * </code>
         *
         * @param string $sqlQuery 
         * @param mixed $fetchMode 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return array 
         */
        public function fetchOne($sqlQuery, $fetchMode = Db::FETCH_ASSOC, $bindParams = null, $bindTypes = null) {}
        /**
         * Dumps the complete result of a query into an array
         * <code>
         * //Getting all robots with associative indexes only
         * $robots = $connection->fetchAll("SELECTFROM robots", Phalcon\Db::FETCH_ASSOC);
         * foreach ($robots as $robot) {
         * print_r($robot);
         * }
         * //Getting all robots that contains word "robot" withing the name
         * $robots = $connection->fetchAll("SELECTFROM robots WHERE name LIKE :name",
         * Phalcon\Db::FETCH_ASSOC,
         * array('name' => '%robot%')
         * );
         * foreach($robots as $robot){
         * print_r($robot);
         * }
         * </code>
         *
         * @param string $sqlQuery 
         * @param int $fetchMode 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return array 
         */
        public function fetchAll($sqlQuery, $fetchMode = Db::FETCH_ASSOC, $bindParams = null, $bindTypes = null) {}
        /**
         * Returns the n'th field of first row in a SQL query result
         * <code>
         * //Getting count of robots
         * $robotsCount = $connection->fetchColumn("SELECT count(*) FROM robots");
         * print_r($robotsCount);
         * //Getting name of last edited robot
         * $robot = $connection->fetchColumn("SELECT id, name FROM robots order by modified desc", 1);
         * print_r($robot);
         * </code>
         *
         * @param string $sqlQuery 
         * @param array $placeholders 
         * @param int|string $column 
         * @return string| 
         */
        public function fetchColumn($sqlQuery, $placeholders = null, $column = 0) {}
        /**
         * Inserts data into a table using custom RDBMS SQL syntax
         * <code>
         * // Inserting a new robot
         * $success = $connection->insert(
         * "robots",
         * array("Astro Boy", 1952),
         * array("name", "year")
         * );
         * // Next SQL sentence is sent to the database system
         * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
         * </code>
         *
         * @param string|array $table 
         * @param array $values 
         * @param mixed $fields 
         * @param mixed $dataTypes 
         * @param  $array dataTypes
         * @return  
         */
        public function insert($table, array $values, $fields = null, $dataTypes = null) {}
        /**
         * Inserts data into a table using custom RBDM SQL syntax
         * <code>
         * //Inserting a new robot
         * $success = $connection->insertAsDict(
         * "robots",
         * array(
         * "name" => "Astro Boy",
         * "year" => 1952
         * )
         * );
         * //Next SQL sentence is sent to the database system
         * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
         * </code>
         *
         * @param mixed $table 
         * @param mixed $data 
         * @param mixed $dataTypes 
         * @param  $string table
         * @param  $array dataTypes
         * @return  
         */
        public function insertAsDict($table, $data, $dataTypes = null) {}
        /**
         * Updates data on a table using custom RBDM SQL syntax
         * <code>
         * //Updating existing robot
         * $success = $connection->update(
         * "robots",
         * array("name"),
         * array("New Astro Boy"),
         * "id = 101"
         * );
         * //Next SQL sentence is sent to the database system
         * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
         * //Updating existing robot with array condition and $dataTypes
         * $success = $connection->update(
         * "robots",
         * array("name"),
         * array("New Astro Boy"),
         * array(
         * 'conditions' => "id = ?",
         * 'bind' => array($some_unsafe_id),
         * 'bindTypes' => array(PDO::PARAM_INT) //use only if you use $dataTypes param
         * ),
         * array(PDO::PARAM_STR)
         * );
         * </code>
         * Warning! If $whereCondition is string it not escaped.
         *
         * @param string|array $table 
         * @param mixed $fields 
         * @param mixed $values 
         * @param mixed $whereCondition 
         * @param mixed $dataTypes 
         * @param  $array dataTypes
         * @param  $string|array whereCondition
         * @return  
         */
        public function update($table, $fields, $values, $whereCondition = null, $dataTypes = null) {}
        /**
         * Updates data on a table using custom RBDM SQL syntax
         * Another, more convenient syntax
         * <code>
         * //Updating existing robot
         * $success = $connection->updateAsDict(
         * "robots",
         * array(
         * "name" => "New Astro Boy"
         * ),
         * "id = 101"
         * );
         * //Next SQL sentence is sent to the database system
         * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
         * </code>
         *
         * @param mixed $table 
         * @param mixed $data 
         * @param mixed $whereCondition 
         * @param mixed $dataTypes 
         * @param  $string whereCondition
         * @param  $array dataTypes
         * @return  
         */
        public function updateAsDict($table, $data, $whereCondition = null, $dataTypes = null) {}
        /**
         * Deletes data from a table using custom RBDM SQL syntax
         * <code>
         * //Deleting existing robot
         * $success = $connection->delete(
         * "robots",
         * "id = 101"
         * );
         * //Next SQL sentence is generated
         * DELETE FROM `robots` WHERE `id` = 101
         * </code>
         *
         * @param string|array $table 
         * @param string $whereCondition 
         * @param array $placeholders 
         * @param array $dataTypes 
         * @return boolean 
         */
        public function delete($table, $whereCondition = null, $placeholders = null, $dataTypes = null) {}
        /**
         * Gets a list of columns
         *
         * @param	array columnList
         * @return	string
         * @param mixed $columnList 
         * @return string 
         */
        public function getColumnList($columnList) {}
        /**
         * Appends a LIMIT clause to $sqlQuery argument
         * <code>
         * echo $connection->limit("SELECTFROM robots", 5);
         * </code>
         *
         * @param string $sqlQuery 
         * @param int $number 
         * @return string 
         */
        public function limit($sqlQuery, $number) {}
        /**
         * Generates SQL checking for the existence of a schema.table
         * <code>
         * var_dump($connection->tableExists("blog", "posts"));
         * </code>
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return bool 
         */
        public function tableExists($tableName, $schemaName = null) {}
        /**
         * Generates SQL checking for the existence of a schema.view
         * <code>
         * var_dump($connection->viewExists("active_users", "posts"));
         * </code>
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return bool 
         */
        public function viewExists($viewName, $schemaName = null) {}
        /**
         * Returns a SQL modified with a FOR UPDATE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function forUpdate($sqlQuery) {}
        /**
         * Returns a SQL modified with a LOCK IN SHARE MODE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function sharedLock($sqlQuery) {}
        /**
         * Creates a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return bool 
         */
        public function createTable($tableName, $schemaName, array $definition) {}
        /**
         * Drops a table from a schema/database
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return bool 
         */
        public function dropTable($tableName, $schemaName = null, $ifExists = true) {}
        /**
         * Creates a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param mixed $schemaName 
         * @return bool 
         */
        public function createView($viewName, array $definition, $schemaName = null) {}
        /**
         * Drops a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return bool 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true) {}
        /**
         * Adds a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return bool 
         */
        public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}
        /**
         * Modifies a table column based on a definition
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return bool 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}
        /**
         * Drops a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return bool 
         */
        public function dropColumn($tableName, $schemaName, $columnName) {}
        /**
         * Adds an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return bool 
         */
        public function addIndex($tableName, $schemaName, IndexInterface $index) {}
        /**
         * Drop an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $indexName 
         * @return bool 
         */
        public function dropIndex($tableName, $schemaName, $indexName) {}
        /**
         * Adds a primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return bool 
         */
        public function addPrimaryKey($tableName, $schemaName, IndexInterface $index) {}
        /**
         * Drops a table's primary key
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return bool 
         */
        public function dropPrimaryKey($tableName, $schemaName) {}
        /**
         * Adds a foreign key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return bool 
         */
        public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference) {}
        /**
         * Drops a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return bool 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName) {}
        /**
         * Returns the SQL column definition from a column
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}
        /**
         * List all tables on a database
         * <code>
         * print_r($connection->listTables("blog"));
         * </code>
         *
         * @param string $schemaName 
         * @return array 
         */
        public function listTables($schemaName = null) {}
        /**
         * List all views on a database
         * <code>
         * print_r($connection->listViews("blog"));
         * </code>
         *
         * @param string $schemaName 
         * @return array 
         */
        public function listViews($schemaName = null) {}
        /**
         * Lists table indexes
         * <code>
         * print_r($connection->describeIndexes('robots_parts'));
         * </code>
         *
         * @param	string table
         * @param	string schema
         * @return	Phalcon\Db\Index[]
         * @param string $table 
         * @param mixed $schema 
         * @return Index[] 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Lists table references
         * <code>
         * print_r($connection->describeReferences('robots_parts'));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return Reference[] 
         */
        public function describeReferences($table, $schema = null) {}
        /**
         * Gets creation options from a table
         * <code>
         * print_r($connection->tableOptions('robots'));
         * </code>
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return array 
         */
        public function tableOptions($tableName, $schemaName = null) {}
        /**
         * Creates a new savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function createSavepoint($name) {}
        /**
         * Releases given savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function releaseSavepoint($name) {}
        /**
         * Rollbacks given savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function rollbackSavepoint($name) {}
        /**
         * Set if nested transactions should use savepoints
         *
         * @param bool $nestedTransactionsWithSavepoints 
         * @return AdapterInterface 
         */
        public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints) {}
        /**
         * Returns if nested transactions should use savepoints
         *
         * @return bool 
         */
        public function isNestedTransactionsWithSavepoints() {}
        /**
         * Returns the savepoint name to use for nested transactions
         *
         * @return string 
         */
        public function getNestedTransactionSavepointName() {}
        /**
         * Returns the default identity value to be inserted in an identity column
         * <code>
         * //Inserting a new robot with a valid default value for the column 'id'
         * $success = $connection->insert(
         * "robots",
         * array($connection->getDefaultIdValue(), "Astro Boy", 1952),
         * array("id", "name", "year")
         * );
         * </code>
         *
         * @return RawValue 
         */
        public function getDefaultIdValue() {}
        /**
         * Returns the default value to make the RBDM use the default value declared in the table definition
         * <code>
         * //Inserting a new robot with a valid default value for the column 'year'
         * $success = $connection->insert(
         * "robots",
         * array("Astro Boy", $connection->getDefaultValue()),
         * array("name", "year")
         * );
         * </code>
         *
         * @return RawValue 
         */
        public function getDefaultValue() {}
        /**
         * Check whether the database system requires a sequence to produce auto-numeric values
         *
         * @return bool 
         */
        public function supportSequences() {}
        /**
         * Check whether the database system requires an explicit value for identity columns
         *
         * @return bool 
         */
        public function useExplicitIdValue() {}
        /**
         * Return descriptor used to connect to the active database
         *
         * @return array 
         */
        public function getDescriptor() {}
        /**
         * Gets the active connection unique identifier
         *
         * @return string 
         */
        public function getConnectionId() {}
        /**
         * Active SQL statement in the object
         *
         * @return string 
         */
        public function getSQLStatement() {}
        /**
         * Active SQL statement in the object without replace bound paramters
         *
         * @return string 
         */
        public function getRealSQLStatement() {}
        /**
         * Active SQL statement in the object
         *
         * @return array 
         */
        public function getSQLBindTypes() {}
    }

    /**
     * Phalcon\Db\AdapterInterface
     * Interface for Phalcon\Db adapters
     */
    interface AdapterInterface
    {
        /**
         * Returns the first row in a SQL query result
         *
         * @param string $sqlQuery 
         * @param int $fetchMode 
         * @param int $placeholders 
         * @return array 
         */
        public function fetchOne($sqlQuery, $fetchMode = 2, $placeholders = null);
        /**
         * Dumps the complete result of a query into an array
         *
         * @param string $sqlQuery 
         * @param int $fetchMode 
         * @param int $placeholders 
         * @return array 
         */
        public function fetchAll($sqlQuery, $fetchMode = 2, $placeholders = null);
        /**
         * Inserts data into a table using custom RDBMS SQL syntax
         *
         * @param mixed $table 
         * @param array $values 
         * @param mixed $fields 
         * @param mixed $dataTypes 
         * @param  $string table
         * @param  $array dataTypes
         * @return  
         */
        public function insert($table, array $values, $fields = null, $dataTypes = null);
        /**
         * Updates data on a table using custom RDBMS SQL syntax
         *
         * @param mixed $table 
         * @param mixed $fields 
         * @param mixed $values 
         * @param mixed $whereCondition 
         * @param mixed $dataTypes 
         * @param  $string whereCondition
         * @param  $array dataTypes
         * @return  
         */
        public function update($table, $fields, $values, $whereCondition = null, $dataTypes = null);
        /**
         * Deletes data from a table using custom RDBMS SQL syntax
         *
         * @param string $table 
         * @param string $whereCondition 
         * @param array $placeholders 
         * @param array $dataTypes 
         * @return boolean 
         */
        public function delete($table, $whereCondition = null, $placeholders = null, $dataTypes = null);
        /**
         * Gets a list of columns
         *
         * @param	array columnList
         * @return	string
         * @param mixed $columnList 
         */
        public function getColumnList($columnList);
        /**
         * Appends a LIMIT clause to sqlQuery argument
         *
         * @param mixed $sqlQuery 
         * @param mixed $number 
         * @param  $string sqlQuery
         * @param  $int number
         * @return  
         */
        public function limit($sqlQuery, $number);
        /**
         * Generates SQL checking for the existence of a schema.table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return bool 
         */
        public function tableExists($tableName, $schemaName = null);
        /**
         * Generates SQL checking for the existence of a schema.view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return bool 
         */
        public function viewExists($viewName, $schemaName = null);
        /**
         * Returns a SQL modified with a FOR UPDATE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function forUpdate($sqlQuery);
        /**
         * Returns a SQL modified with a LOCK IN SHARE MODE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function sharedLock($sqlQuery);
        /**
         * Creates a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return bool 
         */
        public function createTable($tableName, $schemaName, array $definition);
        /**
         * Drops a table from a schema/database
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return bool 
         */
        public function dropTable($tableName, $schemaName = null, $ifExists = true);
        /**
         * Creates a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param string $schemaName 
         * @return bool 
         */
        public function createView($viewName, array $definition, $schemaName = null);
        /**
         * Drops a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return bool 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true);
        /**
         * Adds a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return bool 
         */
        public function addColumn($tableName, $schemaName, ColumnInterface $column);
        /**
         * Modifies a table column based on a definition
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return bool 
         */
        public function modifyColumn($tableName, $schemaName, ColumnInterface $column, ColumnInterface $currentColumn = null);
        /**
         * Drops a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return bool 
         */
        public function dropColumn($tableName, $schemaName, $columnName);
        /**
         * Adds an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return bool 
         */
        public function addIndex($tableName, $schemaName, IndexInterface $index);
        /**
         * Drop an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $indexName 
         * @return bool 
         */
        public function dropIndex($tableName, $schemaName, $indexName);
        /**
         * Adds a primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return bool 
         */
        public function addPrimaryKey($tableName, $schemaName, IndexInterface $index);
        /**
         * Drops primary key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return bool 
         */
        public function dropPrimaryKey($tableName, $schemaName);
        /**
         * Adds a foreign key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return bool 
         */
        public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference);
        /**
         * Drops a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return bool 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName);
        /**
         * Returns the SQL column definition from a column
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(ColumnInterface $column);
        /**
         * List all tables on a database
         *
         * @param string $schemaName 
         * @return array 
         */
        public function listTables($schemaName = null);
        /**
         * List all views on a database
         *
         * @param string $schemaName 
         * @return array 
         */
        public function listViews($schemaName = null);
        /**
         * Return descriptor used to connect to the active database
         *
         * @return array 
         */
        public function getDescriptor();
        /**
         * Gets the active connection unique identifier
         *
         * @return string 
         */
        public function getConnectionId();
        /**
         * Active SQL statement in the object
         *
         * @return string 
         */
        public function getSQLStatement();
        /**
         * Active SQL statement in the object without replace bound paramters
         *
         * @return string 
         */
        public function getRealSQLStatement();
        /**
         * Active SQL statement in the object
         *
         * @return array 
         */
        public function getSQLVariables();
        /**
         * Active SQL statement in the object
         *
         * @return array 
         */
        public function getSQLBindTypes();
        /**
         * Returns type of database system the adapter is used for
         *
         * @return string 
         */
        public function getType();
        /**
         * Returns the name of the dialect used
         *
         * @return string 
         */
        public function getDialectType();
        /**
         * Returns internal dialect instance
         *
         * @return DialectInterface 
         */
        public function getDialect();
        /**
         * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
         * Call it when you need to restore a database connection
         *
         * @param array $descriptor 
         * @return bool 
         */
        public function connect(array $descriptor = null);
        /**
         * Sends SQL statements to the database server returning the success state.
         * Use this method only when the SQL statement sent to the server return rows
         *
         * @param string $sqlStatement 
         * @param mixed $placeholders 
         * @param mixed $dataTypes 
         * @return bool|ResultInterface 
         */
        public function query($sqlStatement, $placeholders = null, $dataTypes = null);
        /**
         * Sends SQL statements to the database server returning the success state.
         * Use this method only when the SQL statement sent to the server doesn't return any rows
         *
         * @param string $sqlStatement 
         * @param mixed $placeholders 
         * @param mixed $dataTypes 
         * @return bool 
         */
        public function execute($sqlStatement, $placeholders = null, $dataTypes = null);
        /**
         * Returns the number of affected rows by the last INSERT/UPDATE/DELETE reported by the database system
         *
         * @return int 
         */
        public function affectedRows();
        /**
         * Closes active connection returning success. Phalcon automatically closes and destroys active connections within Phalcon\Db\Pool
         *
         * @return bool 
         */
        public function close();
        /**
         * Escapes a column/table/schema name
         *
         * @param string $identifier 
         * @return string 
         */
        public function escapeIdentifier($identifier);
        /**
         * Escapes a value to avoid SQL injections
         *
         * @param string $str 
         * @return string 
         */
        public function escapeString($str);
        /**
         * Returns insert id for the auto_increment column inserted in the last SQL statement
         *
         * @param string $sequenceName 
         * @return int 
         */
        public function lastInsertId($sequenceName = null);
        /**
         * Starts a transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function begin($nesting = true);
        /**
         * Rollbacks the active transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function rollback($nesting = true);
        /**
         * Commits the active transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function commit($nesting = true);
        /**
         * Checks whether connection is under database transaction
         *
         * @return bool 
         */
        public function isUnderTransaction();
        /**
         * Return internal PDO handler
         *
         * @return \Pdo 
         */
        public function getInternalHandler();
        /**
         * Lists table indexes
         *
         * @param string $table 
         * @param string $schema 
         * @return IndexInterface[] 
         */
        public function describeIndexes($table, $schema = null);
        /**
         * Lists table references
         *
         * @param string $table 
         * @param string $schema 
         * @return ReferenceInterface[] 
         */
        public function describeReferences($table, $schema = null);
        /**
         * Gets creation options from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return array 
         */
        public function tableOptions($tableName, $schemaName = null);
        /**
         * Check whether the database system requires an explicit value for identity columns
         *
         * @return bool 
         */
        public function useExplicitIdValue();
        /**
         * Return the default identity value to insert in an identity column
         *
         * @return RawValue 
         */
        public function getDefaultIdValue();
        /**
         * Check whether the database system requires a sequence to produce auto-numeric values
         *
         * @return bool 
         */
        public function supportSequences();
        /**
         * Creates a new savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function createSavepoint($name);
        /**
         * Releases given savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function releaseSavepoint($name);
        /**
         * Rollbacks given savepoint
         *
         * @param string $name 
         * @return bool 
         */
        public function rollbackSavepoint($name);
        /**
         * Set if nested transactions should use savepoints
         *
         * @param bool $nestedTransactionsWithSavepoints 
         * @return AdapterInterface 
         */
        public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints);
        /**
         * Returns if nested transactions should use savepoints
         *
         * @return bool 
         */
        public function isNestedTransactionsWithSavepoints();
        /**
         * Returns the savepoint name to use for nested transactions
         *
         * @return string 
         */
        public function getNestedTransactionSavepointName();
        /**
         * Returns an array of Phalcon\Db\Column objects describing a table
         *
         * @param string $table 
         * @param string $schema 
         * @return ColumnInterface[] 
         */
        public function describeColumns($table, $schema = null);
    }

    /**
     * Phalcon\Db\Column
     * Allows to define columns to be used on create or alter table operations
     * <code>
     * use Phalcon\Db\Column as Column;
     * //column definition
     * $column = new Column("id", array(
     * "type" => Column::TYPE_INTEGER,
     * "size" => 10,
     * "unsigned" => true,
     * "notNull" => true,
     * "autoIncrement" => true,
     * "first" => true
     * ));
     * //add column to existing table
     * $connection->addColumn("robots", null, $column);
     * </code>
     */
    class Column implements \Phalcon\Db\ColumnInterface
    {
        /**
         * Integer abstract type
         */
        const TYPE_INTEGER = 0;
        /**
         * Date abstract type
         */
        const TYPE_DATE = 1;
        /**
         * Varchar abstract type
         */
        const TYPE_VARCHAR = 2;
        /**
         * Decimal abstract type
         */
        const TYPE_DECIMAL = 3;
        /**
         * Datetime abstract type
         */
        const TYPE_DATETIME = 4;
        /**
         * Char abstract type
         */
        const TYPE_CHAR = 5;
        /**
         * Text abstract data type
         */
        const TYPE_TEXT = 6;
        /**
         * Float abstract data type
         */
        const TYPE_FLOAT = 7;
        /**
         * Boolean abstract data type
         */
        const TYPE_BOOLEAN = 8;
        /**
         * Double abstract data type
         */
        const TYPE_DOUBLE = 9;
        /**
         * Tinyblob abstract data type
         */
        const TYPE_TINYBLOB = 10;
        /**
         * Blob abstract data type
         */
        const TYPE_BLOB = 11;
        /**
         * Mediumblob abstract data type
         */
        const TYPE_MEDIUMBLOB = 12;
        /**
         * Longblob abstract data type
         */
        const TYPE_LONGBLOB = 13;
        /**
         * Big integer abstract type
         */
        const TYPE_BIGINTEGER = 14;
        /**
         * Json abstract type
         */
        const TYPE_JSON = 15;
        /**
         * Jsonb abstract type
         */
        const TYPE_JSONB = 16;
        /**
         * Datetime abstract type
         */
        const TYPE_TIMESTAMP = 17;
        /**
         * Bind Type Null
         */
        const BIND_PARAM_NULL = 0;
        /**
         * Bind Type Integer
         */
        const BIND_PARAM_INT = 1;
        /**
         * Bind Type String
         */
        const BIND_PARAM_STR = 2;
        /**
         * Bind Type Blob
         */
        const BIND_PARAM_BLOB = 3;
        /**
         * Bind Type Bool
         */
        const BIND_PARAM_BOOL = 5;
        /**
         * Bind Type Decimal
         */
        const BIND_PARAM_DECIMAL = 32;
        /**
         * Skip binding by type
         */
        const BIND_SKIP = 1024;
        /**
         * Column's name
         *
         * @var string
         */
        protected $_name;
        /**
         * Schema which table related is
         *
         * @var string
         */
        protected $_schemaName;
        /**
         * Column data type
         *
         * @var int|string
         */
        protected $_type;
        /**
         * Column data type reference
         *
         * @var int
         */
        protected $_typeReference = -1;
        /**
         * Column data type values
         *
         * @var array|string
         */
        protected $_typeValues;
        /**
         * The column have some numeric type?
         */
        protected $_isNumeric = false;
        /**
         * Integer column size
         *
         * @var int
         */
        protected $_size = 0;
        /**
         * Integer column number scale
         *
         * @var int
         */
        protected $_scale = 0;
        /**
         * Default column value
         */
        protected $_default = null;
        /**
         * Integer column unsigned?
         *
         * @var boolean
         */
        protected $_unsigned = false;
        /**
         * Column not nullable?
         *
         * @var boolean
         */
        protected $_notNull = false;
        /**
         * Column is part of the primary key?
         */
        protected $_primary = false;
        /**
         * Column is autoIncrement?
         *
         * @var boolean
         */
        protected $_autoIncrement = false;
        /**
         * Position is first
         *
         * @var boolean
         */
        protected $_first = false;
        /**
         * Column Position
         *
         * @var string
         */
        protected $_after;
        /**
         * Bind Type
         */
        protected $_bindType = 2;
        /**
         * Column's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Schema which table related is
         *
         * @return string 
         */
        public function getSchemaName() {}
        /**
         * Column data type
         *
         * @return int|string 
         */
        public function getType() {}
        /**
         * Column data type reference
         *
         * @return int 
         */
        public function getTypeReference() {}
        /**
         * Column data type values
         *
         * @return array|string 
         */
        public function getTypeValues() {}
        /**
         * Integer column size
         *
         * @return int 
         */
        public function getSize() {}
        /**
         * Integer column number scale
         *
         * @return int 
         */
        public function getScale() {}
        /**
         * Default column value
         */
        public function getDefault() {}
        /**
         * Phalcon\Db\Column constructor
         *
         * @param string $name 
         * @param array $definition 
         */
        public function __construct($name, array $definition) {}
        /**
         * Returns true if number column is unsigned
         *
         * @return bool 
         */
        public function isUnsigned() {}
        /**
         * Not null
         *
         * @return bool 
         */
        public function isNotNull() {}
        /**
         * Column is part of the primary key?
         *
         * @return bool 
         */
        public function isPrimary() {}
        /**
         * Auto-Increment
         *
         * @return bool 
         */
        public function isAutoIncrement() {}
        /**
         * Check whether column have an numeric type
         *
         * @return bool 
         */
        public function isNumeric() {}
        /**
         * Check whether column have first position in table
         *
         * @return bool 
         */
        public function isFirst() {}
        /**
         * Check whether field absolute to position in table
         *
         * @return string 
         */
        public function getAfterPosition() {}
        /**
         * Returns the type of bind handling
         *
         * @return int 
         */
        public function getBindType() {}
        /**
         * Restores the internal state of a Phalcon\Db\Column object
         *
         * @param array $data 
         * @return Column 
         */
        public static function __set_state(array $data) {}
        /**
         * Check whether column has default value
         *
         * @return bool 
         */
        public function hasDefault() {}
    }

    /**
     * Phalcon\Db\ColumnInterface
     * Interface for Phalcon\Db\Column
     */
    interface ColumnInterface
    {
        /**
         * Returns schema's table related to column
         *
         * @return string 
         */
        public function getSchemaName();
        /**
         * Returns column name
         *
         * @return string 
         */
        public function getName();
        /**
         * Returns column type
         *
         * @return int 
         */
        public function getType();
        /**
         * Returns column type reference
         *
         * @return int 
         */
        public function getTypeReference();
        /**
         * Returns column type values
         *
         * @return int 
         */
        public function getTypeValues();
        /**
         * Returns column size
         *
         * @return int 
         */
        public function getSize();
        /**
         * Returns column scale
         *
         * @return int 
         */
        public function getScale();
        /**
         * Returns true if number column is unsigned
         *
         * @return boolean 
         */
        public function isUnsigned();
        /**
         * Not null
         *
         * @return boolean 
         */
        public function isNotNull();
        /**
         * Column is part of the primary key?
         *
         * @return boolean 
         */
        public function isPrimary();
        /**
         * Auto-Increment
         *
         * @return boolean 
         */
        public function isAutoIncrement();
        /**
         * Check whether column have an numeric type
         *
         * @return boolean 
         */
        public function isNumeric();
        /**
         * Check whether column have first position in table
         *
         * @return boolean 
         */
        public function isFirst();
        /**
         * Check whether field absolute to position in table
         *
         * @return string 
         */
        public function getAfterPosition();
        /**
         * Returns the type of bind handling
         *
         * @return int 
         */
        public function getBindType();
        /**
         * Returns default value of column
         *
         * @return int 
         */
        public function getDefault();
        /**
         * Check whether column has default value
         *
         * @return bool 
         */
        public function hasDefault();
        /**
         * Restores the internal state of a Phalcon\Db\Column object
         *
         * @param array $data 
         * @return ColumnInterface 
         */
        public static function __set_state(array $data);
    }

    /**
     * Phalcon\Db\Dialect
     * This is the base class to each database dialect. This implements
     * common methods to transform intermediate code into its RDBMS related syntax
     */
    abstract class Dialect implements \Phalcon\Db\DialectInterface
    {
        protected $_escapeChar;
        protected $_customFunctions;
        /**
         * Registers custom SQL functions
         *
         * @param string $name 
         * @param callable $customFunction 
         * @return Dialect 
         */
        public function registerCustomFunction($name, $customFunction) {}
        /**
         * Returns registered functions
         *
         * @return array 
         */
        public function getCustomFunctions() {}
        /**
         * Escape Schema
         *
         * @param string $str 
         * @param string $escapeChar 
         * @return string 
         */
        public final function escapeSchema($str, $escapeChar = null) {}
        /**
         * Escape identifiers
         *
         * @param string $str 
         * @param string $escapeChar 
         * @return string 
         */
        public final function escape($str, $escapeChar = null) {}
        /**
         * Generates the SQL for LIMIT clause
         * <code>
         * $sql = $dialect->limit('SELECTFROM robots', 10);
         * echo $sql; // SELECTFROM robots LIMIT 10
         * $sql = $dialect->limit('SELECTFROM robots', [10, 50]);
         * echo $sql; // SELECTFROM robots LIMIT 10 OFFSET 50
         * </code>
         *
         * @param string $sqlQuery 
         * @param mixed $number 
         * @return string 
         */
        public function limit($sqlQuery, $number) {}
        /**
         * Returns a SQL modified with a FOR UPDATE clause
         * <code>
         * $sql = $dialect->forUpdate('SELECTFROM robots');
         * echo $sql; // SELECTFROM robots FOR UPDATE
         * </code>
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function forUpdate($sqlQuery) {}
        /**
         * Returns a SQL modified with a LOCK IN SHARE MODE clause
         * <code>
         * $sql = $dialect->sharedLock('SELECTFROM robots');
         * echo $sql; // SELECTFROM robots LOCK IN SHARE MODE
         * </code>
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function sharedLock($sqlQuery) {}
        /**
         * Gets a list of columns with escaped identifiers
         * <code>
         * echo $dialect->getColumnList(array('column1', 'column'));
         * </code>
         *
         * @param array $columnList 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        public final function getColumnList(array $columnList, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve Column expressions
         *
         * @param mixed $column 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        public final function getSqlColumn($column, $escapeChar = null, $bindCounts = null) {}
        /**
         * Transforms an intermediate representation for a expression into a database system valid expression
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        public function getSqlExpression(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Transform an intermediate representation of a schema/table into a database system valid expression
         *
         * @param mixed $table 
         * @param string $escapeChar 
         * @return string 
         */
        public final function getSqlTable($table, $escapeChar = null) {}
        /**
         * Builds a SELECT statement
         *
         * @param array $definition 
         * @return string 
         */
        public function select(array $definition) {}
        /**
         * Checks whether the platform supports savepoints
         *
         * @return bool 
         */
        public function supportsSavepoints() {}
        /**
         * Checks whether the platform supports releasing savepoints.
         *
         * @return bool 
         */
        public function supportsReleaseSavepoints() {}
        /**
         * Generate SQL to create a new savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function createSavepoint($name) {}
        /**
         * Generate SQL to release a savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function releaseSavepoint($name) {}
        /**
         * Generate SQL to rollback a savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function rollbackSavepoint($name) {}
        /**
         * Resolve Column expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionScalar(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve object expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionObject(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve qualified expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @return string 
         */
        protected final function getSqlExpressionQualified(array $expression, $escapeChar = null) {}
        /**
         * Resolve binary operations expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionBinaryOperations(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve unary operations expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionUnaryOperations(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve function calls
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionFunctionCall(array $expression, $escapeChar = null, $bindCounts) {}
        /**
         * Resolve Lists
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionList(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @return string 
         */
        protected final function getSqlExpressionAll(array $expression, $escapeChar = null) {}
        /**
         * Resolve CAST of values
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionCastValue(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve CONVERT of values encodings
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionConvertValue(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve CASE expressions
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionCase(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a FROM clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @return string 
         */
        protected final function getSqlExpressionFrom($expression, $escapeChar = null) {}
        /**
         * Resolve a JOINs clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionJoins($expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a WHERE clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionWhere($expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a GROUP BY clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionGroupBy($expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a HAVING clause
         *
         * @param array $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionHaving(array $expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a ORDER BY clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionOrderBy($expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Resolve a LIMIT clause
         *
         * @param mixed $expression 
         * @param string $escapeChar 
         * @param mixed $bindCounts 
         * @return string 
         */
        protected final function getSqlExpressionLimit($expression, $escapeChar = null, $bindCounts = null) {}
        /**
         * Prepares column for this RDBMS
         *
         * @param string $qualified 
         * @param string $alias 
         * @param string $escapeChar 
         * @return string 
         */
        protected function prepareColumnAlias($qualified, $alias = null, $escapeChar = null) {}
        /**
         * Prepares table for this RDBMS
         *
         * @param string $table 
         * @param string $schema 
         * @param string $alias 
         * @param string $escapeChar 
         * @return string 
         */
        protected function prepareTable($table, $schema = null, $alias = null, $escapeChar = null) {}
        /**
         * Prepares qualified for this RDBMS
         *
         * @param string $column 
         * @param string $domain 
         * @param string $escapeChar 
         * @return string 
         */
        protected function prepareQualified($column, $domain = null, $escapeChar = null) {}
    }

    /**
     * Phalcon\Db\DialectInterface
     * Interface for Phalcon\Db dialects
     */
    interface DialectInterface
    {
        /**
         * Generates the SQL for LIMIT clause
         *
         * @param string $sqlQuery 
         * @param mixed $number 
         * @return string 
         */
        public function limit($sqlQuery, $number);
        /**
         * Returns a SQL modified with a FOR UPDATE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function forUpdate($sqlQuery);
        /**
         * Returns a SQL modified with a LOCK IN SHARE MODE clause
         *
         * @param string $sqlQuery 
         * @return string 
         */
        public function sharedLock($sqlQuery);
        /**
         * Builds a SELECT statement
         *
         * @param array $definition 
         * @return string 
         */
        public function select(array $definition);
        /**
         * Gets a list of columns
         *
         * @param array $columnList 
         * @return string 
         */
        public function getColumnList(array $columnList);
        /**
         * Gets the column name in RDBMS
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column);
        /**
         * Generates SQL to add a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return string 
         */
        public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column);
        /**
         * Generates SQL to modify a column in a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return string 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null);
        /**
         * Generates SQL to delete a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return string 
         */
        public function dropColumn($tableName, $schemaName, $columnName);
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);
        /**
         * Generates SQL to delete an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $indexName 
         * @return string 
         */
        public function dropIndex($tableName, $schemaName, $indexName);
        /**
         * Generates SQL to add the primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);
        /**
         * Generates SQL to delete primary key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function dropPrimaryKey($tableName, $schemaName);
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return string 
         */
        public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference);
        /**
         * Generates SQL to delete a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return string 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName);
        /**
         * Generates SQL to create a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return string 
         */
        public function createTable($tableName, $schemaName, array $definition);
        /**
         * Generates SQL to create a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param string $schemaName 
         * @return string 
         */
        public function createView($viewName, array $definition, $schemaName = null);
        /**
         * Generates SQL to drop a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function dropTable($tableName, $schemaName);
        /**
         * Generates SQL to drop a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true);
        /**
         * Generates SQL checking for the existence of a schema.table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function tableExists($tableName, $schemaName = null);
        /**
         * Generates SQL checking for the existence of a schema.view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return string 
         */
        public function viewExists($viewName, $schemaName = null);
        /**
         * Generates SQL to describe a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeColumns($table, $schema = null);
        /**
         * List all tables in database
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listTables($schemaName = null);
        /**
         * Generates SQL to query indexes on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeIndexes($table, $schema = null);
        /**
         * Generates SQL to query foreign keys on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeReferences($table, $schema = null);
        /**
         * Generates the SQL to describe the table creation options
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function tableOptions($table, $schema = null);
        /**
         * Checks whether the platform supports savepoints
         *
         * @return bool 
         */
        public function supportsSavepoints();
        /**
         * Checks whether the platform supports releasing savepoints.
         *
         * @return bool 
         */
        public function supportsReleaseSavepoints();
        /**
         * Generate SQL to create a new savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function createSavepoint($name);
        /**
         * Generate SQL to release a savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function releaseSavepoint($name);
        /**
         * Generate SQL to rollback a savepoint
         *
         * @param string $name 
         * @return string 
         */
        public function rollbackSavepoint($name);
    }

    /**
     * Phalcon\Db\Exception
     * Exceptions thrown in Phalcon\Db will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Db\Index
     * Allows to define indexes to be used on tables. Indexes are a common way
     * to enhance database performance. An index allows the database server to find
     * and retrieve specific rows much faster than it could do without an index
     */
    class Index implements \Phalcon\Db\IndexInterface
    {
        /**
         * Index name
         *
         * @var string
         */
        protected $_name;
        /**
         * Index columns
         *
         * @var array
         */
        protected $_columns;
        /**
         * Index type
         *
         * @var string
         */
        protected $_type;
        /**
         * Index name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Index columns
         *
         * @return array 
         */
        public function getColumns() {}
        /**
         * Index type
         *
         * @return string 
         */
        public function getType() {}
        /**
         * Phalcon\Db\Index constructor
         *
         * @param string $name 
         * @param array $columns 
         * @param mixed $type 
         */
        public function __construct($name, array $columns, $type = null) {}
        /**
         * Restore a Phalcon\Db\Index object from export
         *
         * @param array $data 
         * @return Index 
         */
        public static function __set_state(array $data) {}
    }

    /**
     * Phalcon\Db\IndexInterface
     * Interface for Phalcon\Db\Index
     */
    interface IndexInterface
    {
        /**
         * Gets the index name
         *
         * @return string 
         */
        public function getName();
        /**
         * Gets the columns that comprends the index
         *
         * @return array 
         */
        public function getColumns();
        /**
         * Gets the index type
         *
         * @return string 
         */
        public function getType();
        /**
         * Restore a Phalcon\Db\Index object from export
         *
         * @param array $data 
         * @return IndexInterface 
         */
        public static function __set_state(array $data);
    }

    /**
     * Phalcon\Db\Profiler
     * Instances of Phalcon\Db can generate execution profiles
     * on SQL statements sent to the relational database. Profiled
     * information includes execution time in milliseconds.
     * This helps you to identify bottlenecks in your applications.
     * <code>
     * $profiler = new \Phalcon\Db\Profiler();
     * //Set the connection profiler
     * $connection->setProfiler($profiler);
     * $sql = "SELECT buyer_name, quantity, product_name
     * FROM buyers LEFT JOIN products ON
     * buyers.pid=products.id";
     * //Execute a SQL statement
     * $connection->query($sql);
     * //Get the last profile in the profiler
     * $profile = $profiler->getLastProfile();
     * echo "SQL Statement: ", $profile->getSQLStatement(), "\n";
     * echo "Start Time: ", $profile->getInitialTime(), "\n";
     * echo "Final Time: ", $profile->getFinalTime(), "\n";
     * echo "Total Elapsed Time: ", $profile->getTotalElapsedSeconds(), "\n";
     * </code>
     */
    class Profiler
    {
        /**
         * All the Phalcon\Db\Profiler\Item in the active profile
         *
         * @var \Phalcon\Db\Profiler\Item[]
         */
        protected $_allProfiles;
        /**
         * Active Phalcon\Db\Profiler\Item
         *
         * @var Phalcon\Db\Profiler\Item
         */
        protected $_activeProfile;
        /**
         * Total time spent by all profiles to complete
         *
         * @var float
         */
        protected $_totalSeconds = 0;
        /**
         * Starts the profile of a SQL sentence
         *
         * @param string $sqlStatement 
         * @param mixed $sqlVariables 
         * @param mixed $sqlBindTypes 
         * @return \Phalcon\Db\Profiler 
         */
        public function startProfile($sqlStatement, $sqlVariables = null, $sqlBindTypes = null) {}
        /**
         * Stops the active profile
         *
         * @return Profiler 
         */
        public function stopProfile() {}
        /**
         * Returns the total number of SQL statements processed
         *
         * @return int 
         */
        public function getNumberTotalStatements() {}
        /**
         * Returns the total time in seconds spent by the profiles
         *
         * @return double 
         */
        public function getTotalElapsedSeconds() {}
        /**
         * Returns all the processed profiles
         *
         * @return Item[] 
         */
        public function getProfiles() {}
        /**
         * Resets the profiler, cleaning up all the profiles
         *
         * @return Profiler 
         */
        public function reset() {}
        /**
         * Returns the last profile executed in the profiler
         *
         * @return \Phalcon\Db\Profiler\Item 
         */
        public function getLastProfile() {}
    }

    /**
     * Phalcon\Db\RawValue
     * This class allows to insert/update raw data without quoting or formatting.
     * The next example shows how to use the MySQL now() function as a field value.
     * <code>
     * $subscriber = new Subscribers();
     * $subscriber->email = 'andres@phalconphp.com';
     * $subscriber->createdAt = new \Phalcon\Db\RawValue('now()');
     * $subscriber->save();
     * </code>
     */
    class RawValue
    {
        /**
         * Raw value without quoting or formatting
         *
         * @var string
         */
        protected $_value;
        /**
         * Raw value without quoting or formatting
         *
         * @return string 
         */
        public function getValue() {}
        /**
         * Raw value without quoting or formatting
         *
         * @return string 
         */
        public function __toString() {}
        /**
         * Phalcon\Db\RawValue constructor
         *
         * @param mixed $value 
         */
        public function __construct($value) {}
    }

    /**
     * Phalcon\Db\Reference
     * Allows to define reference constraints on tables
     * <code>
     * $reference = new \Phalcon\Db\Reference("field_fk", array(
     * 'referencedSchema' => "invoicing",
     * 'referencedTable' => "products",
     * 'columns' => array("product_type", "product_code"),
     * 'referencedColumns' => array("type", "code")
     * ));
     * </code>
     */
    class Reference implements \Phalcon\Db\ReferenceInterface
    {
        /**
         * Constraint name
         *
         * @var string
         */
        protected $_name;
        protected $_schemaName;
        protected $_referencedSchema;
        /**
         * Referenced Table
         *
         * @var string
         */
        protected $_referencedTable;
        /**
         * Local reference columns
         *
         * @var array
         */
        protected $_columns;
        /**
         * Referenced Columns
         *
         * @var array
         */
        protected $_referencedColumns;
        /**
         * ON DELETE
         *
         * @var array
         */
        protected $_onDelete;
        /**
         * ON UPDATE
         *
         * @var array
         */
        protected $_onUpdate;
        /**
         * Constraint name
         *
         * @return string 
         */
        public function getName() {}
        public function getSchemaName() {}
        public function getReferencedSchema() {}
        /**
         * Referenced Table
         *
         * @return string 
         */
        public function getReferencedTable() {}
        /**
         * Local reference columns
         *
         * @return array 
         */
        public function getColumns() {}
        /**
         * Referenced Columns
         *
         * @return array 
         */
        public function getReferencedColumns() {}
        /**
         * ON DELETE
         *
         * @return array 
         */
        public function getOnDelete() {}
        /**
         * ON UPDATE
         *
         * @return array 
         */
        public function getOnUpdate() {}
        /**
         * Phalcon\Db\Reference constructor
         *
         * @param string $name 
         * @param array $definition 
         */
        public function __construct($name, array $definition) {}
        /**
         * Restore a Phalcon\Db\Reference object from export
         *
         * @param array $data 
         * @return Reference 
         */
        public static function __set_state(array $data) {}
    }

    /**
     * Phalcon\Db\Reference
     * Interface for Phalcon\Db\Reference
     */
    interface ReferenceInterface
    {
        /**
         * Gets the index name
         *
         * @return string 
         */
        public function getName();
        /**
         * Gets the schema where referenced table is
         *
         * @return string 
         */
        public function getSchemaName();
        /**
         * Gets the schema where referenced table is
         *
         * @return string 
         */
        public function getReferencedSchema();
        /**
         * Gets local columns which reference is based
         *
         * @return array 
         */
        public function getColumns();
        /**
         * Gets the referenced table
         *
         * @return string 
         */
        public function getReferencedTable();
        /**
         * Gets referenced columns
         *
         * @return array 
         */
        public function getReferencedColumns();
        /**
         * Gets the referenced on delete
         *
         * @return string 
         */
        public function getOnDelete();
        /**
         * Gets the referenced on update
         *
         * @return string 
         */
        public function getOnUpdate();
        /**
         * Restore a Phalcon\Db\Reference object from export
         *
         * @param array $data 
         * @return ReferenceInterface 
         */
        public static function __set_state(array $data);
    }

    /**
     * Phalcon\Db\ResultInterface
     * Interface for Phalcon\Db\Result objects
     */
    interface ResultInterface
    {
        /**
         * Allows to executes the statement again. Some database systems don't support scrollable cursors,
         * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
         *
         * @return boolean 
         */
        public function execute();
        /**
         * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         *
         * @return mixed 
         */
        public function fetch();
        /**
         * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         *
         * @return mixed 
         */
        public function fetchArray();
        /**
         * Returns an array of arrays containing all the records in the result
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         *
         * @return array 
         */
        public function fetchAll();
        /**
         * Gets number of rows returned by a resultset
         *
         * @return int 
         */
        public function numRows();
        /**
         * Moves internal resultset cursor to another position letting us to fetch a certain row
         *
         * @param int $number 
         */
        public function dataSeek($number);
        /**
         * Changes the fetching mode affecting Phalcon\Db\Result\Pdo::fetch()
         *
         * @param int $fetchMode 
         * @return bool 
         */
        public function setFetchMode($fetchMode);
        /**
         * Gets the internal PDO result object
         *
         * @return \PDOStatement 
         */
        public function getInternalResult();
    }
}

namespace \Phalcon\Db\Adapter {
    /**
     * Phalcon\Db\Adapter\Pdo
     * Phalcon\Db\Adapter\Pdo is the Phalcon\Db that internally uses PDO to connect to a database
     * <code>
     * use Phalcon\Db\Adapter\Pdo\Mysql;
     * $config = [
     * 'host'     => 'localhost',
     * 'dbname'   => 'blog',
     * 'port'     => 3306,
     * 'username' => 'sigma',
     * 'password' => 'secret'
     * ];
     * $connection = new Mysql($config);
     * </code>
     */
    abstract class Pdo extends \Phalcon\Db\Adapter
    {
        /**
         * PDO Handler
         *
         * @var \Pdo
         */
        protected $_pdo;
        /**
         * Last affected rows
         */
        protected $_affectedRows;
        /**
         * Constructor for Phalcon\Db\Adapter\Pdo
         *
         * @param array $descriptor 
         */
        public function __construct(array $descriptor) {}
        /**
         * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
         * Call it when you need to restore a database connection.
         * <code>
         * use Phalcon\Db\Adapter\Pdo\Mysql;
         * // Make a connection
         * $connection = new Mysql([
         * 'host'     => 'localhost',
         * 'username' => 'sigma',
         * 'password' => 'secret',
         * 'dbname'   => 'blog',
         * 'port'     => 3306,
         * ]);
         * // Reconnect
         * $connection->connect();
         * </code>
         *
         * @param array $descriptor 
         * @return bool 
         */
        public function connect(array $descriptor = null) {}
        /**
         * Returns a PDO prepared statement to be executed with 'executePrepared'
         * <code>
         * use Phalcon\Db\Column;
         * $statement = $db->prepare('SELECTFROM robots WHERE name = :name');
         * $result = $connection->executePrepared($statement, ['name' => 'Voltron'], ['name' => Column::BIND_PARAM_INT]);
         * </code>
         *
         * @param string $sqlStatement 
         * @return \PDOStatement 
         */
        public function prepare($sqlStatement) {}
        /**
         * Executes a prepared statement binding. This function uses integer indexes starting from zero
         * <code>
         * use Phalcon\Db\Column;
         * $statement = $db->prepare('SELECTFROM robots WHERE name = :name');
         * $result = $connection->executePrepared($statement, ['name' => 'Voltron'], ['name' => Column::BIND_PARAM_INT]);
         * </code>
         *
         * @param \PDOStatement $statement 
         * @param array $placeholders 
         * @param array $dataTypes 
         * @return \PDOStatement 
         */
        public function executePrepared(\PDOStatement $statement, array $placeholders, $dataTypes) {}
        /**
         * Sends SQL statements to the database server returning the success state.
         * Use this method only when the SQL statement sent to the server is returning rows
         * <code>
         * //Querying data
         * $resultset = $connection->query("SELECTFROM robots WHERE type='mechanical'");
         * $resultset = $connection->query("SELECTFROM robots WHERE type=?", array("mechanical"));
         * </code>
         *
         * @param string $sqlStatement 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return bool|\Phalcon\Db\ResultInterface 
         */
        public function query($sqlStatement, $bindParams = null, $bindTypes = null) {}
        /**
         * Sends SQL statements to the database server returning the success state.
         * Use this method only when the SQL statement sent to the server doesn't return any rows
         * <code>
         * //Inserting data
         * $success = $connection->execute("INSERT INTO robots VALUES (1, 'Astro Boy')");
         * $success = $connection->execute("INSERT INTO robots VALUES (?, ?)", array(1, 'Astro Boy'));
         * </code>
         *
         * @param string $sqlStatement 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return bool 
         */
        public function execute($sqlStatement, $bindParams = null, $bindTypes = null) {}
        /**
         * Returns the number of affected rows by the lastest INSERT/UPDATE/DELETE executed in the database system
         * <code>
         * $connection->execute("DELETE FROM robots");
         * echo $connection->affectedRows(), ' were deleted';
         * </code>
         *
         * @return int 
         */
        public function affectedRows() {}
        /**
         * Closes the active connection returning success. Phalcon automatically closes and destroys
         * active connections when the request ends
         *
         * @return bool 
         */
        public function close() {}
        /**
         * Escapes a column/table/schema name
         * <code>
         * $escapedTable = $connection->escapeIdentifier('robots');
         * $escapedTable = $connection->escapeIdentifier(['store', 'robots']);
         * </code>
         *
         * @param string $identifier 
         * @return string 
         */
        public function escapeIdentifier($identifier) {}
        /**
         * Escapes a value to avoid SQL injections according to the active charset in the connection
         * <code>
         * $escapedStr = $connection->escapeString('some dangerous value');
         * </code>
         *
         * @param string $str 
         * @return string 
         */
        public function escapeString($str) {}
        /**
         * Converts bound parameters such as :name: or ?1 into PDO bind params ?
         * <code>
         * print_r($connection->convertBoundParams('SELECTFROM robots WHERE name = :name:', array('Bender')));
         * </code>
         *
         * @param string $sql 
         * @param array $params 
         * @return array 
         */
        public function convertBoundParams($sql, array $params = array()) {}
        /**
         * Returns the insert id for the auto_increment/serial column inserted in the lastest executed SQL statement
         * <code>
         * //Inserting a new robot
         * $success = $connection->insert(
         * "robots",
         * array("Astro Boy", 1952),
         * array("name", "year")
         * );
         * //Getting the generated id
         * $id = $connection->lastInsertId();
         * </code>
         *
         * @param string $sequenceName 
         * @return int|boolean 
         */
        public function lastInsertId($sequenceName = null) {}
        /**
         * Starts a transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function begin($nesting = true) {}
        /**
         * Rollbacks the active transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function rollback($nesting = true) {}
        /**
         * Commits the active transaction in the connection
         *
         * @param bool $nesting 
         * @return bool 
         */
        public function commit($nesting = true) {}
        /**
         * Returns the current transaction nesting level
         *
         * @return int 
         */
        public function getTransactionLevel() {}
        /**
         * Checks whether the connection is under a transaction
         * <code>
         * $connection->begin();
         * var_dump($connection->isUnderTransaction()); //true
         * </code>
         *
         * @return bool 
         */
        public function isUnderTransaction() {}
        /**
         * Return internal PDO handler
         *
         * @return \Pdo 
         */
        public function getInternalHandler() {}
        /**
         * Return the error info, if any
         *
         * @return array 
         */
        public function getErrorInfo() {}
    }
}

namespace \Phalcon\Db\Adapter\Pdo {
    /**
     * Phalcon\Db\Adapter\Pdo\Mysql
     * Specific functions for the Mysql database system
     * <code>
     * use Phalcon\Db\Adapter\Pdo\Mysql;
     * $config = [
     * 'host'     => 'localhost',
     * 'dbname'   => 'blog',
     * 'port'     => 3306,
     * 'username' => 'sigma',
     * 'password' => 'secret'
     * ];
     * $connection = new Mysql($config);
     * </code>
     */
    class Mysql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
    {
        protected $_type = "mysql";
        protected $_dialectType = "mysql";
        /**
         * Escapes a column/table/schema name
         * <code>
         * echo $connection->escapeIdentifier('my_table'); // `my_table`
         * echo $connection->escapeIdentifier(['companies', 'name']); // `companies`.`name`
         * <code>
         *
         * @param string|array $identifier 
         * @return string 
         */
        public function escapeIdentifier($identifier) {}
        /**
         * Returns an array of Phalcon\Db\Column objects describing a table
         * <code>
         * print_r($connection->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return Column[] 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * Lists table indexes
         * <code>
         * print_r($connection->describeIndexes('robots_parts'));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return \Phalcon\Db\IndexInterface[] 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Lists table references
         * <code>
         * print_r($connection->describeReferences('robots_parts'));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return Reference[] 
         */
        public function describeReferences($table, $schema = null) {}
    }

    /**
     * Phalcon\Db\Adapter\Pdo\Postgresql
     * Specific functions for the Postgresql database system
     * <code>
     * use Phalcon\Db\Adapter\Pdo\Postgresql;
     * $config = [
     * 'host'     => 'localhost',
     * 'dbname'   => 'blog',
     * 'port'     => 5432,
     * 'username' => 'postgres',
     * 'password' => 'secret'
     * ];
     * $connection = new Postgresql($config);
     * </code>
     */
    class Postgresql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
    {
        protected $_type = "pgsql";
        protected $_dialectType = "postgresql";
        /**
         * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
         * Call it when you need to restore a database connection.
         *
         * @param array $descriptor 
         * @return bool 
         */
        public function connect(array $descriptor = null) {}
        /**
         * Returns an array of Phalcon\Db\Column objects describing a table
         * <code>
         * print_r($connection->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return Column[] 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * Creates a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return bool 
         */
        public function createTable($tableName, $schemaName, array $definition) {}
        /**
         * Modifies a table column based on a definition
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return bool 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}
        /**
         * Check whether the database system requires an explicit value for identity columns
         *
         * @return bool 
         */
        public function useExplicitIdValue() {}
        /**
         * Returns the default identity value to be inserted in an identity column
         * <code>
         * //Inserting a new robot with a valid default value for the column 'id'
         * $success = $connection->insert(
         * "robots",
         * array($connection->getDefaultIdValue(), "Astro Boy", 1952),
         * array("id", "name", "year")
         * );
         * </code>
         *
         * @return \Phalcon\Db\RawValue 
         */
        public function getDefaultIdValue() {}
        /**
         * Check whether the database system requires a sequence to produce auto-numeric values
         *
         * @return bool 
         */
        public function supportSequences() {}
    }

    /**
     * Phalcon\Db\Adapter\Pdo\Sqlite
     * Specific functions for the Sqlite database system
     * <code>
     * use Phalcon\Db\Adapter\Pdo\Sqlite;
     * $connection = new Sqlite(['dbname' => '/tmp/test.sqlite']);
     * </code>
     */
    class Sqlite extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
    {
        protected $_type = "sqlite";
        protected $_dialectType = "sqlite";
        /**
         * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
         * Call it when you need to restore a database connection.
         *
         * @param array $descriptor 
         * @return bool 
         */
        public function connect(array $descriptor = null) {}
        /**
         * Returns an array of Phalcon\Db\Column objects describing a table
         * <code>
         * print_r($connection->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return Column[] 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * Lists table indexes
         * <code>
         * print_r($connection->describeIndexes('robots_parts'));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return \Phalcon\Db\IndexInterface[] 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Lists table references
         *
         * @param	string table
         * @param	string schema
         * @return	Phalcon\Db\ReferenceInterface[]
         * @param mixed $table 
         * @param mixed $schema 
         * @return ReferenceInterface[] 
         */
        public function describeReferences($table, $schema = null) {}
        /**
         * Check whether the database system requires an explicit value for identity columns
         *
         * @return bool 
         */
        public function useExplicitIdValue() {}
        /**
         * Returns the default value to make the RBDM use the default value declared in the table definition
         * <code>
         * //Inserting a new robot with a valid default value for the column 'year'
         * $success = $connection->insert(
         * "robots",
         * array("Astro Boy", $connection->getDefaultValue()),
         * array("name", "year")
         * );
         * </code>
         *
         * @return \Phalcon\Db\RawValue 
         */
        public function getDefaultValue() {}
    }
}

namespace \Phalcon\Db\Dialect {
    /**
     * Phalcon\Db\Dialect\Mysql
     * Generates database specific SQL for the MySQL RDBMS
     */
    class Mysql extends \Phalcon\Db\Dialect
    {
        protected $_escapeChar = "`";
        /**
         * Gets the column name in MySQL
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to add a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return string 
         */
        public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to modify a column in a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return string 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}
        /**
         * Generates SQL to delete a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return string 
         */
        public function dropColumn($tableName, $schemaName, $columnName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $indexName 
         * @return string 
         */
        public function dropIndex($tableName, $schemaName, $indexName) {}
        /**
         * Generates SQL to add the primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete primary key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function dropPrimaryKey($tableName, $schemaName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return string 
         */
        public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference) {}
        /**
         * Generates SQL to delete a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return string 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName) {}
        /**
         * Generates SQL to create a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return string 
         */
        public function createTable($tableName, $schemaName, array $definition) {}
        /**
         * Generates SQL to drop a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropTable($tableName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL to create a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param string $schemaName 
         * @return string 
         */
        public function createView($viewName, array $definition, $schemaName = null) {}
        /**
         * Generates SQL to drop a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL checking for the existence of a schema.table
         * <code>
         * echo $dialect->tableExists("posts", "blog");
         * echo $dialect->tableExists("posts");
         * </code>
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function tableExists($tableName, $schemaName = null) {}
        /**
         * Generates SQL checking for the existence of a schema.view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return string 
         */
        public function viewExists($viewName, $schemaName = null) {}
        /**
         * Generates SQL describing a table
         * <code>
         * print_r($dialect->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * List all tables in database
         * <code>
         * print_r($dialect->listTables("blog"))
         * </code>
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listTables($schemaName = null) {}
        /**
         * Generates the SQL to list all views of a schema or user
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listViews($schemaName = null) {}
        /**
         * Generates SQL to query indexes on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Generates SQL to query foreign keys on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeReferences($table, $schema = null) {}
        /**
         * Generates the SQL to describe the table creation options
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function tableOptions($table, $schema = null) {}
        /**
         * Generates SQL to add the table creation options
         *
         * @param array $definition 
         * @return string 
         */
        protected function _getTableOptions(array $definition) {}
    }

    /**
     * Phalcon\Db\Dialect\Postgresql
     * Generates database specific SQL for the PostgreSQL RDBMS
     */
    class Postgresql extends \Phalcon\Db\Dialect
    {
        protected $_escapeChar = "\\\"";
        /**
         * Gets the column name in PostgreSQL
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to add a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return string 
         */
        public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to modify a column in a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return string 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}
        /**
         * Generates SQL to delete a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return string 
         */
        public function dropColumn($tableName, $schemaName, $columnName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $indexName 
         * @return string 
         */
        public function dropIndex($tableName, $schemaName, $indexName) {}
        /**
         * Generates SQL to add the primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete primary key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function dropPrimaryKey($tableName, $schemaName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return string 
         */
        public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference) {}
        /**
         * Generates SQL to delete a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return string 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName) {}
        /**
         * Generates SQL to create a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return string|array 
         */
        public function createTable($tableName, $schemaName, array $definition) {}
        /**
         * Generates SQL to drop a view
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropTable($tableName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL to create a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param string $schemaName 
         * @return string 
         */
        public function createView($viewName, array $definition, $schemaName = null) {}
        /**
         * Generates SQL to drop a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL checking for the existence of a schema.table
         * <code>
         * echo $dialect->tableExists("posts", "blog");
         * echo $dialect->tableExists("posts");
         * </code>
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function tableExists($tableName, $schemaName = null) {}
        /**
         * Generates SQL checking for the existence of a schema.view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return string 
         */
        public function viewExists($viewName, $schemaName = null) {}
        /**
         * Generates SQL describing a table
         * <code>
         * print_r($dialect->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * List all tables in database
         * <code>
         * print_r($dialect->listTables("blog"))
         * </code>
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listTables($schemaName = null) {}
        /**
         * Generates the SQL to list all views of a schema or user
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listViews($schemaName = null) {}
        /**
         * Generates SQL to query indexes on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Generates SQL to query foreign keys on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeReferences($table, $schema = null) {}
        /**
         * Generates the SQL to describe the table creation options
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function tableOptions($table, $schema = null) {}
        /**
         * @param array $definition 
         * @return string 
         */
        protected function _getTableOptions(array $definition) {}
    }

    /**
     * Phalcon\Db\Dialect\Sqlite
     * Generates database specific SQL for the Sqlite RDBMS
     */
    class Sqlite extends \Phalcon\Db\Dialect
    {
        protected $_escapeChar = "\\\"";
        /**
         * Gets the column name in SQLite
         *
         * @param mixed $column 
         * @return string 
         */
        public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to add a column to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @return string 
         */
        public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}
        /**
         * Generates SQL to modify a column in a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $column 
         * @param mixed $currentColumn 
         * @return string 
         */
        public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}
        /**
         * Generates SQL to delete a column from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $columnName 
         * @return string 
         */
        public function dropColumn($tableName, $schemaName, $columnName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete an index from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $indexName 
         * @return string 
         */
        public function dropIndex($tableName, $schemaName, $indexName) {}
        /**
         * Generates SQL to add the primary key to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $index 
         * @return string 
         */
        public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}
        /**
         * Generates SQL to delete primary key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function dropPrimaryKey($tableName, $schemaName) {}
        /**
         * Generates SQL to add an index to a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param mixed $reference 
         * @return string 
         */
        public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference) {}
        /**
         * Generates SQL to delete a foreign key from a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param string $referenceName 
         * @return string 
         */
        public function dropForeignKey($tableName, $schemaName, $referenceName) {}
        /**
         * Generates SQL to create a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param array $definition 
         * @return string 
         */
        public function createTable($tableName, $schemaName, array $definition) {}
        /**
         * Generates SQL to drop a table
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropTable($tableName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL to create a view
         *
         * @param string $viewName 
         * @param array $definition 
         * @param string $schemaName 
         * @return string 
         */
        public function createView($viewName, array $definition, $schemaName = null) {}
        /**
         * Generates SQL to drop a view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @param bool $ifExists 
         * @return string 
         */
        public function dropView($viewName, $schemaName = null, $ifExists = true) {}
        /**
         * Generates SQL checking for the existence of a schema.table
         * <code>
         * echo $dialect->tableExists("posts", "blog");
         * echo $dialect->tableExists("posts");
         * </code>
         *
         * @param string $tableName 
         * @param string $schemaName 
         * @return string 
         */
        public function tableExists($tableName, $schemaName = null) {}
        /**
         * Generates SQL checking for the existence of a schema.view
         *
         * @param string $viewName 
         * @param string $schemaName 
         * @return string 
         */
        public function viewExists($viewName, $schemaName = null) {}
        /**
         * Generates SQL describing a table
         * <code>
         * print_r($dialect->describeColumns("posts"));
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeColumns($table, $schema = null) {}
        /**
         * List all tables in database
         * <code>
         * print_r($dialect->listTables("blog"))
         * </code>
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listTables($schemaName = null) {}
        /**
         * Generates the SQL to list all views of a schema or user
         *
         * @param string $schemaName 
         * @return string 
         */
        public function listViews($schemaName = null) {}
        /**
         * Generates the SQL to get query list of indexes
         * <code>
         * print_r($dialect->listIndexesSql("blog"))
         * </code>
         *
         * @param string $table 
         * @param string $schema 
         * @param string $keyName 
         * @return string 
         */
        public function listIndexesSql($table, $schema = null, $keyName = null) {}
        /**
         * Generates SQL to query indexes on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeIndexes($table, $schema = null) {}
        /**
         * Generates SQL to query indexes detail on a table
         *
         * @param string $index 
         * @return string 
         */
        public function describeIndex($index) {}
        /**
         * Generates SQL to query foreign keys on a table
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function describeReferences($table, $schema = null) {}
        /**
         * Generates the SQL to describe the table creation options
         *
         * @param string $table 
         * @param string $schema 
         * @return string 
         */
        public function tableOptions($table, $schema = null) {}
    }
}

namespace \Phalcon\Db\Profiler {
    /**
     * Phalcon\Db\Profiler\Item
     * This class identifies each profile in a Phalcon\Db\Profiler
     */
    class Item
    {
        /**
         * SQL statement related to the profile
         *
         * @var string
         */
        protected $_sqlStatement;
        /**
         * SQL variables related to the profile
         *
         * @var array
         */
        protected $_sqlVariables;
        /**
         * SQL bind types related to the profile
         *
         * @var array
         */
        protected $_sqlBindTypes;
        /**
         * Timestamp when the profile started
         *
         * @var double
         */
        protected $_initialTime;
        /**
         * Timestamp when the profile ended
         *
         * @var double
         */
        protected $_finalTime;
        /**
         * SQL statement related to the profile
         *
         * @param string $sqlStatement 
         */
        public function setSqlStatement($sqlStatement) {}
        /**
         * SQL statement related to the profile
         *
         * @return string 
         */
        public function getSqlStatement() {}
        /**
         * SQL variables related to the profile
         *
         * @param array $sqlVariables 
         */
        public function setSqlVariables(array $sqlVariables) {}
        /**
         * SQL variables related to the profile
         *
         * @return array 
         */
        public function getSqlVariables() {}
        /**
         * SQL bind types related to the profile
         *
         * @param array $sqlBindTypes 
         */
        public function setSqlBindTypes(array $sqlBindTypes) {}
        /**
         * SQL bind types related to the profile
         *
         * @return array 
         */
        public function getSqlBindTypes() {}
        /**
         * Timestamp when the profile started
         *
         * @param double $initialTime 
         */
        public function setInitialTime($initialTime) {}
        /**
         * Timestamp when the profile started
         *
         * @return double 
         */
        public function getInitialTime() {}
        /**
         * Timestamp when the profile ended
         *
         * @param double $finalTime 
         */
        public function setFinalTime($finalTime) {}
        /**
         * Timestamp when the profile ended
         *
         * @return double 
         */
        public function getFinalTime() {}
        /**
         * Returns the total time in seconds spent by the profile
         *
         * @return double 
         */
        public function getTotalElapsedSeconds() {}
    }
}

namespace \Phalcon\Db\Result {
    /**
     * Phalcon\Db\Result\Pdo
     * Encapsulates the resultset internals
     * <code>
     * $result = $connection->query("SELECTFROM robots ORDER BY name");
     * $result->setFetchMode(Phalcon\Db::FETCH_NUM);
     * while ($robot = $result->fetchArray()) {
     * print_r($robot);
     * }
     * </code>
     */
    class Pdo implements \Phalcon\Db\ResultInterface
    {
        protected $_connection;
        protected $_result;
        /**
         * Active fetch mode
         */
        protected $_fetchMode = Db::FETCH_OBJ;
        /**
         * Internal resultset
         *
         * @var \PDOStatement
         */
        protected $_pdoStatement;
        protected $_sqlStatement;
        protected $_bindParams;
        protected $_bindTypes;
        protected $_rowCount = false;
        /**
         * Phalcon\Db\Result\Pdo constructor
         *
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param \PDOStatement $result 
         * @param string $sqlStatement 
         * @param array $bindParams 
         * @param array $bindTypes 
         */
        public function __construct(Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement = null, $bindParams = null, $bindTypes = null) {}
        /**
         * Allows to execute the statement again. Some database systems don't support scrollable cursors,
         * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
         *
         * @return bool 
         */
        public function execute() {}
        /**
         * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         * <code>
         * $result = $connection->query("SELECTFROM robots ORDER BY name");
         * $result->setFetchMode(Phalcon\Db::FETCH_OBJ);
         * while ($robot = $result->fetch()) {
         * echo $robot->name;
         * }
         * </code>
         *
         * @param mixed $fetchStyle 
         * @param mixed $cursorOrientation 
         * @param mixed $cursorOffset 
         */
        public function fetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null) {}
        /**
         * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         * <code>
         * $result = $connection->query("SELECTFROM robots ORDER BY name");
         * $result->setFetchMode(Phalcon\Db::FETCH_NUM);
         * while ($robot = result->fetchArray()) {
         * print_r($robot);
         * }
         * </code>
         */
        public function fetchArray() {}
        /**
         * Returns an array of arrays containing all the records in the result
         * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
         * <code>
         * $result = $connection->query("SELECTFROM robots ORDER BY name");
         * $robots = $result->fetchAll();
         * </code>
         *
         * @param mixed $fetchStyle 
         * @param mixed $fetchArgument 
         * @param mixed $ctorArgs 
         * @return array 
         */
        public function fetchAll($fetchStyle = null, $fetchArgument = null, $ctorArgs = null) {}
        /**
         * Gets number of rows returned by a resultset
         * <code>
         * $result = $connection->query("SELECTFROM robots ORDER BY name");
         * echo 'There are ', $result->numRows(), ' rows in the resultset';
         * </code>
         *
         * @return int 
         */
        public function numRows() {}
        /**
         * Moves internal resultset cursor to another position letting us to fetch a certain row
         * <code>
         * $result = $connection->query("SELECTFROM robots ORDER BY name");
         * $result->dataSeek(2); // Move to third row on result
         * $row = $result->fetch(); // Fetch third row
         * </code>
         *
         * @param long $number 
         */
        public function dataSeek($number) {}
        /**
         * Changes the fetching mode affecting Phalcon\Db\Result\Pdo::fetch()
         * <code>
         * //Return array with integer indexes
         * $result->setFetchMode(\Phalcon\Db::FETCH_NUM);
         * //Return associative array without integer indexes
         * $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
         * //Return associative array together with integer indexes
         * $result->setFetchMode(\Phalcon\Db::FETCH_BOTH);
         * //Return an object
         * $result->setFetchMode(\Phalcon\Db::FETCH_OBJ);
         * </code>
         *
         * @param int $fetchMode 
         * @param mixed $colNoOrClassNameOrObject 
         * @param mixed $ctorargs 
         * @return bool 
         */
        public function setFetchMode($fetchMode, $colNoOrClassNameOrObject = null, $ctorargs = null) {}
        /**
         * Gets the internal PDO result object
         *
         * @return \PDOStatement 
         */
        public function getInternalResult() {}
    }
}

namespace \Phalcon\Debug {
    /**
     * Phalcon\Debug\Dump
     * Dumps information about a variable(s)
     * <code>
     * $foo = 123;
     * echo (new \Phalcon\Debug\Dump())->variable($foo, "foo");
     * </code>
     * <code>
     * $foo = "string";
     * $bar = ["key" => "value"];
     * $baz = new stdClass();
     * echo (new \Phalcon\Debug\Dump())->variables($foo, $bar, $baz);
     * </code>
     */
    class Dump
    {
        protected $_detailed = false;
        protected $_methods = array();
        protected $_styles;
        public function getDetailed() {}
        /**
         * @param mixed $detailed 
         */
        public function setDetailed($detailed) {}
        /**
         * Phalcon\Debug\Dump constructor
         *
         * @param array $styles 
         * @param boolean $detailed debug object's private and protected properties
         */
        public function __construct(array $styles = null, $detailed = false) {}
        /**
         * Alias of variables() method
         *
         * @param mixed $variable 
         * @param ...  
         * @return string 
         */
        public function all() {}
        /**
         * Get style for type
         *
         * @param string $type 
         * @return string 
         */
        protected function getStyle($type) {}
        /**
         * Set styles for vars type
         *
         * @param mixed $styles 
         * @return array 
         */
        public function setStyles($styles = null) {}
        /**
         * Alias of variable() method
         *
         * @param mixed $variable 
         * @param string $name 
         * @return string 
         */
        public function one($variable, $name = null) {}
        /**
         * Prepare an HTML string of information about a single variable.
         *
         * @param mixed $variable 
         * @param string $name 
         * @param int $tab 
         * @return string 
         */
        protected function output($variable, $name = null, $tab = 1) {}
        /**
         * Returns an HTML string of information about a single variable.
         * <code>
         * echo (new \Phalcon\Debug\Dump())->variable($foo, "foo");
         * </code>
         *
         * @param mixed $variable 
         * @param string $name 
         * @return string 
         */
        public function variable($variable, $name = null) {}
        /**
         * Returns an HTML string of debugging information about any number of
         * variables, each wrapped in a "pre" tag.
         * <code>
         * $foo = "string";
         * $bar = ["key" => "value"];
         * $baz = new stdClass();
         * echo (new \Phalcon\Debug\Dump())->variables($foo, $bar, $baz);
         * </code>
         *
         * @param mixed $variable 
         * @param ...  
         * @return string 
         */
        public function variables() {}
        /**
         * Returns an JSON string of information about a single variable.
         * <code>
         * $foo = ["key" => "value"];
         * echo (new \Phalcon\Debug\Dump())->toJson($foo);
         * $foo = new stdClass();
         * $foo->bar = 'buz';
         * echo (new \Phalcon\Debug\Dump())->toJson($foo);
         * </code>
         *
         * @param mixed $variable 
         * @return string 
         */
        public function toJson($variable) {}
    }

    /**
     * Phalcon\Debug\Exception
     * Exceptions thrown in Phalcon\Debug will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Di {
    /**
     * Phalcon\Di\Exception
     * Exceptions thrown in Phalcon\Di will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Di\FactoryDefault
     * This is a variant of the standard Phalcon\Di. By default it automatically
     * registers all the services provided by the framework. Thanks to this, the developer does not need
     * to register each service individually providing a full stack framework
     */
    class FactoryDefault extends \Phalcon\Di
    {
        /**
         * Phalcon\Di\FactoryDefault constructor
         */
        public function __construct() {}
    }

    /**
     * Phalcon\Di\Injectable
     * This class allows to access services in the services container by just only accessing a public property
     * with the same name of a registered service
     *
     * @property \Phalcon\Mvc\Dispatcher|\Phalcon\Mvc\DispatcherInterface $dispatcher
     * @property \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface $router
     * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
     * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
     * @property \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface $response
     * @property \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface $cookies
     * @property \Phalcon\Filter|\Phalcon\FilterInterface $filter
     * @property \Phalcon\Flash\Direct $flash
     * @property \Phalcon\Flash\Session $flashSession
     * @property \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface $session
     * @property \Phalcon\Events\Manager|\Phalcon\Events\ManagerInterface $eventsManager
     * @property \Phalcon\Db\AdapterInterface $db
     * @property \Phalcon\Security $security
     * @property \Phalcon\Crypt|\Phalcon\CryptInterface $crypt
     * @property \Phalcon\Tag $tag
     * @property \Phalcon\Escaper|\Phalcon\EscaperInterface $escaper
     * @property \Phalcon\Annotations\Adapter\Memory|\Phalcon\Annotations\Adapter $annotations
     * @property \Phalcon\Mvc\Model\Manager|\Phalcon\Mvc\Model\ManagerInterface $modelsManager
     * @property \Phalcon\Mvc\Model\MetaData\Memory|\Phalcon\Mvc\Model\MetadataInterface $modelsMetadata
     * @property \Phalcon\Mvc\Model\Transaction\Manager|\Phalcon\Mvc\Model\Transaction\ManagerInterface $transactionManager
     * @property \Phalcon\Assets\Manager $assets
     * @property \Phalcon\Di|\Phalcon\DiInterface $di
     * @property \Phalcon\Session\Bag|\Phalcon\Session\BagInterface $persistent
     * @property \Phalcon\Mvc\View|\Phalcon\Mvc\ViewInterface $view
     */
    abstract class Injectable implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
    {
        /**
         * Dependency Injector
         *
         * @var \Phalcon\DiInterface
         */
        protected $_dependencyInjector;
        /**
         * Events Manager
         *
         * @var \Phalcon\Events\ManagerInterface
         */
        protected $_eventsManager;
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the event manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Magic method __get
         *
         * @param string $propertyName 
         */
        public function __get($propertyName) {}
    }

    /**
     * Phalcon\Di\InjectionAwareInterface
     * This interface must be implemented in those classes that uses internally the Phalcon\Di that creates them
     */
    interface InjectionAwareInterface
    {
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector);
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI();
    }

    /**
     * Phalcon\Di\Service
     * Represents individually a service in the services container
     * <code>
     * $service = new \Phalcon\Di\Service('request', 'Phalcon\Http\Request');
     * $request = service->resolve();
     * <code>
     */
    class Service implements \Phalcon\Di\ServiceInterface
    {
        protected $_name;
        protected $_definition;
        protected $_shared = false;
        protected $_resolved = false;
        protected $_sharedInstance;
        /**
         * Phalcon\Di\Service
         *
         * @param string $name 
         * @param mixed $definition 
         * @param boolean $shared 
         */
        public final function __construct($name, $definition, $shared = false) {}
        /**
         * Returns the service's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Sets if the service is shared or not
         *
         * @param bool $shared 
         */
        public function setShared($shared) {}
        /**
         * Check whether the service is shared or not
         *
         * @return bool 
         */
        public function isShared() {}
        /**
         * Sets/Resets the shared instance related to the service
         *
         * @param mixed $sharedInstance 
         */
        public function setSharedInstance($sharedInstance) {}
        /**
         * Set the service definition
         *
         * @param mixed $definition 
         */
        public function setDefinition($definition) {}
        /**
         * Returns the service definition
         *
         * @return mixed 
         */
        public function getDefinition() {}
        /**
         * Resolves the service
         *
         * @param array $parameters 
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @return mixed 
         */
        public function resolve($parameters = null, \Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Changes a parameter in the definition without resolve the service
         *
         * @param int $position 
         * @param array $parameter 
         * @return Service 
         */
        public function setParameter($position, array $parameter) {}
        /**
         * Returns a parameter in a specific position
         *
         * @param int $position 
         * @return array 
         */
        public function getParameter($position) {}
        /**
         * Returns true if the service was resolved
         *
         * @return bool 
         */
        public function isResolved() {}
        /**
         * Restore the internal state of a service
         *
         * @param array $attributes 
         * @return Service 
         */
        public static function __set_state(array $attributes) {}
    }

    /**
     * Phalcon\Di\ServiceInterface
     * Represents a service in the services container
     */
    interface ServiceInterface
    {
        /**
         * Returns the service's name
         *
         * @param string  
         */
        public function getName();
        /**
         * Sets if the service is shared or not
         *
         * @param bool $shared 
         */
        public function setShared($shared);
        /**
         * Check whether the service is shared or not
         *
         * @return bool 
         */
        public function isShared();
        /**
         * Set the service definition
         *
         * @param mixed $definition 
         */
        public function setDefinition($definition);
        /**
         * Returns the service definition
         *
         * @return mixed 
         */
        public function getDefinition();
        /**
         * Resolves the service
         *
         * @param array $parameters 
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @return mixed 
         */
        public function resolve($parameters = null, \Phalcon\DiInterface $dependencyInjector = null);
        /**
         * Changes a parameter in the definition without resolve the service
         *
         * @param int $position 
         * @param array $parameter 
         * @return ServiceInterface 
         */
        public function setParameter($position, array $parameter);
        /**
         * Restore the interal state of a service
         *
         * @param array $attributes 
         * @return ServiceInterface 
         */
        public static function __set_state(array $attributes);
    }
}

namespace \Phalcon\Di\Factorydefault {
    /**
     * Phalcon\Di\FactoryDefault\Cli
     * This is a variant of the standard Phalcon\Di. By default it automatically
     * registers all the services provided by the framework.
     * Thanks to this, the developer does not need to register each service individually.
     * This class is specially suitable for CLI applications
     */
    class Cli extends \Phalcon\Di\FactoryDefault
    {
        /**
         * Phalcon\Di\FactoryDefault\Cli constructor
         */
        public function __construct() {}
    }
}

namespace \Phalcon\Di\Service {
    /**
     * Phalcon\Di\Service\Builder
     * This class builds instances based on complex definitions
     */
    class Builder
    {
        /**
         * Resolves a constructor/call parameter
         *
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @param int $position 
         * @param array $argument 
         * @return mixed 
         */
        private function _buildParameter(\Phalcon\DiInterface $dependencyInjector, $position, array $argument) {}
        /**
         * Resolves an array of parameters
         *
         * @param mixed $dependencyInjector 
         * @param array $arguments 
         * @return array 
         */
        private function _buildParameters(\Phalcon\DiInterface $dependencyInjector, array $arguments) {}
        /**
         * Builds a service using a complex service definition
         *
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @param array $definition 
         * @param array $parameters 
         * @return mixed 
         */
        public function build(\Phalcon\DiInterface $dependencyInjector, array $definition, $parameters = null) {}
    }
}

namespace \Phalcon\Escaper {
    /**
     * Phalcon\Escaper\Exception
     * Exceptions thrown in Phalcon\Escaper will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Events {
    /**
     * Phalcon\Events\Event
     * This class offers contextual information of a fired event in the EventsManager
     */
    class Event implements \Phalcon\Events\EventInterface
    {
        /**
         * Event type
         *
         * @var string
         */
        protected $_type;
        /**
         * Event source
         *
         * @var object
         */
        protected $_source;
        /**
         * Event data
         *
         * @var mixed
         */
        protected $_data;
        /**
         * Is event propagation stopped?
         *
         * @var boolean
         */
        protected $_stopped = false;
        /**
         * Is event cancelable?
         *
         * @var boolean
         */
        protected $_cancelable = true;
        /**
         * Event type
         *
         * @return string 
         */
        public function getType() {}
        /**
         * Event source
         *
         * @return object 
         */
        public function getSource() {}
        /**
         * Event data
         *
         * @return mixed 
         */
        public function getData() {}
        /**
         * Phalcon\Events\Event constructor
         *
         * @param string $type 
         * @param object $source 
         * @param mixed $data 
         * @param boolean $cancelable 
         */
        public function __construct($type, $source, $data = null, $cancelable = true) {}
        /**
         * Sets event data
         *
         * @param mixed $data 
         * @return EventInterface 
         */
        public function setData($data = null) {}
        /**
         * Sets event type
         *
         * @param string $type 
         * @return EventInterface 
         */
        public function setType($type) {}
        /**
         * Stops the event preventing propagation
         *
         * @return EventInterface 
         */
        public function stop() {}
        /**
         * Check whether the event is currently stopped
         *
         * @return bool 
         */
        public function isStopped() {}
        /**
         * Check whether the event is cancelable
         *
         * @return bool 
         */
        public function isCancelable() {}
    }

    /**
     * Phalcon\Events\EventInterface
     * Interface for Phalcon\Events\Event class
     */
    interface EventInterface
    {
        /**
         * Gets event data
         *
         * @return mixed 
         */
        public function getData();
        /**
         * Sets event data
         *
         * @param mixed $data 
         * @return EventInterface 
         */
        public function setData($data = null);
        /**
         * Gets event type
         *
         * @return mixed 
         */
        public function getType();
        /**
         * Sets event type
         *
         * @param string $type 
         * @return EventInterface 
         */
        public function setType($type);
        /**
         * Stops the event preventing propagation
         *
         * @return EventInterface 
         */
        public function stop();
        /**
         * Check whether the event is currently stopped
         *
         * @return bool 
         */
        public function isStopped();
        /**
         * Check whether the event is cancelable
         *
         * @return bool 
         */
        public function isCancelable();
    }

    /**
     * Phalcon\Events\EventsAwareInterface
     * This interface must for those classes that accept an EventsManager and dispatch events
     */
    interface EventsAwareInterface
    {
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(ManagerInterface $eventsManager);
        /**
         * Returns the internal event manager
         *
         * @return ManagerInterface 
         */
        public function getEventsManager();
    }

    /**
     * Phalcon\Events\Exception
     * Exceptions thrown in Phalcon\Events will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Events\Manager
     * Phalcon Events Manager, offers an easy way to intercept and manipulate, if needed,
     * the normal flow of operation. With the EventsManager the developer can create hooks or
     * plugins that will offer monitoring of data, manipulation, conditional execution and much more.
     */
    class Manager implements \Phalcon\Events\ManagerInterface
    {
        protected $_events = null;
        protected $_collect = false;
        protected $_enablePriorities = false;
        protected $_responses;
        /**
         * Attach a listener to the events manager
         *
         * @param string $eventType 
         * @param object|callable $handler 
         * @param int $priority 
         */
        public function attach($eventType, $handler, $priority = 100) {}
        /**
         * Detach the listener from the events manager
         *
         * @param string $eventType 
         * @param object $handler 
         */
        public function detach($eventType, $handler) {}
        /**
         * Set if priorities are enabled in the EventsManager
         *
         * @param bool $enablePriorities 
         */
        public function enablePriorities($enablePriorities) {}
        /**
         * Returns if priorities are enabled
         *
         * @return bool 
         */
        public function arePrioritiesEnabled() {}
        /**
         * Tells the event manager if it needs to collect all the responses returned by every
         * registered listener in a single fire
         *
         * @param bool $collect 
         */
        public function collectResponses($collect) {}
        /**
         * Check if the events manager is collecting all all the responses returned by every
         * registered listener in a single fire
         *
         * @return bool 
         */
        public function isCollecting() {}
        /**
         * Returns all the responses returned by every handler executed by the last 'fire' executed
         *
         * @return array 
         */
        public function getResponses() {}
        /**
         * Removes all events from the EventsManager
         *
         * @param string $type 
         */
        public function detachAll($type = null) {}
        /**
         * Internal handler to call a queue of events
         *
         * @param \SplPriorityQueue|array $queue 
         * @param \Phalcon\Events\Event $event 
         * @return mixed 
         */
        public final function fireQueue($queue, EventInterface $event) {}
        /**
         * Fires an event in the events manager causing the active listeners to be notified about it
         * <code>
         * $eventsManager->fire('db', $connection);
         * </code>
         *
         * @param string $eventType 
         * @param object $source 
         * @param mixed $data 
         * @param boolean $cancelable 
         * @return mixed 
         */
        public function fire($eventType, $source, $data = null, $cancelable = true) {}
        /**
         * Check whether certain type of event has listeners
         *
         * @param string $type 
         * @return bool 
         */
        public function hasListeners($type) {}
        /**
         * Returns all the attached listeners of a certain type
         *
         * @param string $type 
         * @return array 
         */
        public function getListeners($type) {}
    }

    /**
     * Phalcon\Events\Manager
     * Phalcon Events Manager, offers an easy way to intercept and manipulate, if needed,
     * the normal flow of operation. With the EventsManager the developer can create hooks or
     * plugins that will offer monitoring of data, manipulation, conditional execution and much more.
     */
    interface ManagerInterface
    {
        /**
         * Attach a listener to the events manager
         *
         * @param string $eventType 
         * @param object|callable $handler 
         */
        public function attach($eventType, $handler);
        /**
         * Detach the listener from the events manager
         *
         * @param string $eventType 
         * @param object $handler 
         */
        public function detach($eventType, $handler);
        /**
         * Removes all events from the EventsManager
         *
         * @param string $type 
         */
        public function detachAll($type = null);
        /**
         * Fires an event in the events manager causing the active listeners to be notified about it
         *
         * @param string $eventType 
         * @param object $source 
         * @param mixed $data 
         * @return mixed 
         */
        public function fire($eventType, $source, $data = null);
        /**
         * Returns all the attached listeners of a certain type
         *
         * @param string $type 
         * @return array 
         */
        public function getListeners($type);
    }
}

namespace \Phalcon\Filter {
    /**
     * Phalcon\Filter\Exception
     * Exceptions thrown in Phalcon\Filter will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Filter\UserFilterInterface
     * Interface for Phalcon\Filter user-filters
     */
    interface UserFilterInterface
    {
        /**
         * Filters a value
         *
         * @param mixed $value 
         */
        public function filter($value);
    }
}

namespace \Phalcon\Flash {
    /**
     * Phalcon\Flash\Direct
     * This is a variant of the Phalcon\Flash that immediately outputs any message passed to it
     */
    class Direct extends \Phalcon\Flash implements \Phalcon\FlashInterface
    {
        /**
         * Outputs a message
         *
         * @param string $type 
         * @param mixed $message 
         * @return string 
         */
        public function message($type, $message) {}
        /**
         * Prints the messages accumulated in the flasher
         *
         * @param bool $remove 
         */
        public function output($remove = true) {}
    }

    /**
     * Phalcon\Flash\Exception
     * Exceptions thrown in Phalcon\Flash will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Flash\Session
     * Temporarily stores the messages in session, then messages can be printed in the next request
     */
    class Session extends \Phalcon\Flash implements \Phalcon\FlashInterface
    {
        /**
         * Returns the messages stored in session
         *
         * @param bool $remove 
         * @param mixed $type 
         * @return array 
         */
        protected function _getSessionMessages($remove, $type = null) {}
        /**
         * Stores the messages in session
         *
         * @param array $messages 
         * @return array 
         */
        protected function _setSessionMessages(array $messages) {}
        /**
         * Adds a message to the session flasher
         *
         * @param string $type 
         * @param string $message 
         */
        public function message($type, $message) {}
        /**
         * Checks whether there are messages
         *
         * @param mixed $type 
         * @return bool 
         */
        public function has($type = null) {}
        /**
         * Returns the messages in the session flasher
         *
         * @param mixed $type 
         * @param bool $remove 
         * @return array 
         */
        public function getMessages($type = null, $remove = true) {}
        /**
         * Prints the messages in the session flasher
         *
         * @param bool $remove 
         */
        public function output($remove = true) {}
        /**
         * Clear messages in the session messenger
         */
        public function clear() {}
    }
}

namespace \Phalcon\Forms {
    /**
     * Phalcon\Forms\Element
     * This is a base class for form elements
     */
    abstract class Element implements \Phalcon\Forms\ElementInterface
    {
        protected $_form;
        protected $_name;
        protected $_value;
        protected $_label;
        protected $_attributes;
        protected $_validators = array();
        protected $_filters;
        protected $_options;
        protected $_messages;
        /**
         * Phalcon\Forms\Element constructor
         *
         * @param string $name 
         * @param array $attributes 
         */
        public function __construct($name, $attributes = null) {}
        /**
         * Sets the parent form to the element
         *
         * @param mixed $form 
         * @return ElementInterface 
         */
        public function setForm(Form $form) {}
        /**
         * Returns the parent form to the element
         *
         * @return Form 
         */
        public function getForm() {}
        /**
         * Sets the element name
         *
         * @param string $name 
         * @return ElementInterface 
         */
        public function setName($name) {}
        /**
         * Returns the element name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Sets the element filters
         *
         * @param array|string $filters 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setFilters($filters) {}
        /**
         * Adds a filter to current list of filters
         *
         * @param string $filter 
         * @return ElementInterface 
         */
        public function addFilter($filter) {}
        /**
         * Returns the element filters
         *
         * @return mixed 
         */
        public function getFilters() {}
        /**
         * Adds a group of validators
         *
         * @param array $validators 
         * @param bool $merge 
         * @param \Phalcon\Validation\ValidatorInterface[]  
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function addValidators(array $validators, $merge = true) {}
        /**
         * Adds a validator to the element
         *
         * @param mixed $validator 
         * @return ElementInterface 
         */
        public function addValidator(\Phalcon\Validation\ValidatorInterface $validator) {}
        /**
         * Returns the validators registered for the element
         *
         * @return ValidatorInterface[] 
         */
        public function getValidators() {}
        /**
         * Returns an array of prepared attributes for Phalcon\Tag helpers
         * according to the element parameters
         *
         * @param array $attributes 
         * @param bool $useChecked 
         * @return array 
         */
        public function prepareAttributes(array $attributes = null, $useChecked = false) {}
        /**
         * Sets a default attribute for the element
         *
         * @param string $attribute 
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setAttribute($attribute, $value) {}
        /**
         * Returns the value of an attribute if present
         *
         * @param string $attribute 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getAttribute($attribute, $defaultValue = null) {}
        /**
         * Sets default attributes for the element
         *
         * @param array $attributes 
         * @return ElementInterface 
         */
        public function setAttributes(array $attributes) {}
        /**
         * Returns the default attributes for the element
         *
         * @return array 
         */
        public function getAttributes() {}
        /**
         * Sets an option for the element
         *
         * @param string $option 
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setUserOption($option, $value) {}
        /**
         * Returns the value of an option if present
         *
         * @param string $option 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getUserOption($option, $defaultValue = null) {}
        /**
         * Sets options for the element
         *
         * @param array $options 
         * @return ElementInterface 
         */
        public function setUserOptions(array $options) {}
        /**
         * Returns the options for the element
         *
         * @return array 
         */
        public function getUserOptions() {}
        /**
         * Sets the element label
         *
         * @param string $label 
         * @return ElementInterface 
         */
        public function setLabel($label) {}
        /**
         * Returns the element label
         *
         * @return string 
         */
        public function getLabel() {}
        /**
         * Generate the HTML to label the element
         *
         * @param array $attributes 
         * @return string 
         */
        public function label($attributes = null) {}
        /**
         * Sets a default value in case the form does not use an entity
         * or there is no value available for the element in _POST
         *
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setDefault($value) {}
        /**
         * Returns the default value assigned to the element
         *
         * @return mixed 
         */
        public function getDefault() {}
        /**
         * Returns the element value
         *
         * @return mixed 
         */
        public function getValue() {}
        /**
         * Returns the messages that belongs to the element
         * The element needs to be attached to a form
         *
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessages() {}
        /**
         * Checks whether there are messages attached to the element
         *
         * @return bool 
         */
        public function hasMessages() {}
        /**
         * Sets the validation messages related to the element
         *
         * @param mixed $group 
         * @return ElementInterface 
         */
        public function setMessages(\Phalcon\Validation\Message\Group $group) {}
        /**
         * Appends a message to the internal message list
         *
         * @param mixed $message 
         * @return ElementInterface 
         */
        public function appendMessage(\Phalcon\Validation\MessageInterface $message) {}
        /**
         * Clears every element in the form to its default value
         *
         * @return Element 
         */
        public function clear() {}
        /**
         * Magic method __toString renders the widget without attributes
         *
         * @return string 
         */
        public function __toString() {}
    }

    /**
     * Phalcon\Forms\Element
     * Interface for Phalcon\Forms\Element classes
     */
    interface ElementInterface
    {
        /**
         * Sets the parent form to the element
         *
         * @param mixed $form 
         * @return ElementInterface 
         */
        public function setForm(\Phalcon\Forms\Form $form);
        /**
         * Returns the parent form to the element
         *
         * @return \Phalcon\Forms\Form 
         */
        public function getForm();
        /**
         * Sets the element's name
         *
         * @param string $name 
         * @return ElementInterface 
         */
        public function setName($name);
        /**
         * Returns the element's name
         *
         * @return string 
         */
        public function getName();
        /**
         * Sets the element's filters
         *
         * @param array|string $filters 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setFilters($filters);
        /**
         * Adds a filter to current list of filters
         *
         * @param string $filter 
         * @return ElementInterface 
         */
        public function addFilter($filter);
        /**
         * Returns the element's filters
         *
         * @return mixed 
         */
        public function getFilters();
        /**
         * Adds a group of validators
         *
         * @param array $validators 
         * @param boolean $merge 
         * @param \Phalcon\Validation\ValidatorInterface[]  
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function addValidators(array $validators, $merge = true);
        /**
         * Adds a validator to the element
         *
         * @param mixed $validator 
         * @return ElementInterface 
         */
        public function addValidator(\Phalcon\Validation\ValidatorInterface $validator);
        /**
         * Returns the validators registered for the element
         *
         * @return ValidatorInterface[] 
         */
        public function getValidators();
        /**
         * Returns an array of prepared attributes for Phalcon\Tag helpers
         * according to the element's parameters
         *
         * @param array $attributes 
         * @param bool $useChecked 
         * @return array 
         */
        public function prepareAttributes(array $attributes = null, $useChecked = false);
        /**
         * Sets a default attribute for the element
         *
         * @param string $attribute 
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setAttribute($attribute, $value);
        /**
         * Returns the value of an attribute if present
         *
         * @param string $attribute 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getAttribute($attribute, $defaultValue = null);
        /**
         * Sets default attributes for the element
         *
         * @param array $attributes 
         * @return ElementInterface 
         */
        public function setAttributes(array $attributes);
        /**
         * Returns the default attributes for the element
         *
         * @return array 
         */
        public function getAttributes();
        /**
         * Sets an option for the element
         *
         * @param string $option 
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setUserOption($option, $value);
        /**
         * Returns the value of an option if present
         *
         * @param string $option 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getUserOption($option, $defaultValue = null);
        /**
         * Sets options for the element
         *
         * @param array $options 
         * @return ElementInterface 
         */
        public function setUserOptions(array $options);
        /**
         * Returns the options for the element
         *
         * @return array 
         */
        public function getUserOptions();
        /**
         * Sets the element label
         *
         * @param string $label 
         * @return ElementInterface 
         */
        public function setLabel($label);
        /**
         * Returns the element's label
         *
         * @return string 
         */
        public function getLabel();
        /**
         * Generate the HTML to label the element
         *
         * @return string 
         */
        public function label();
        /**
         * Sets a default value in case the form does not use an entity
         * or there is no value available for the element in _POST
         *
         * @param mixed $value 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function setDefault($value);
        /**
         * Returns the default value assigned to the element
         *
         * @return mixed 
         */
        public function getDefault();
        /**
         * Returns the element's value
         *
         * @return mixed 
         */
        public function getValue();
        /**
         * Returns the messages that belongs to the element
         * The element needs to be attached to a form
         *
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessages();
        /**
         * Checks whether there are messages attached to the element
         *
         * @return bool 
         */
        public function hasMessages();
        /**
         * Sets the validation messages related to the element
         *
         * @param mixed $group 
         * @return ElementInterface 
         */
        public function setMessages(\Phalcon\Validation\Message\Group $group);
        /**
         * Appends a message to the internal message list
         *
         * @param mixed $message 
         * @return ElementInterface 
         */
        public function appendMessage(\Phalcon\Validation\MessageInterface $message);
        /**
         * Clears every element in the form to its default value
         *
         * @return ElementInterface 
         */
        public function clear();
        /**
         * Renders the element widget
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null);
    }

    /**
     * Phalcon\Forms\Exception
     * Exceptions thrown in Phalcon\Forms will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Forms\Form
     * This component allows to build forms using an object-oriented interface
     */
    class Form extends \Phalcon\Di\Injectable implements \Countable, \Iterator
    {
        protected $_position;
        protected $_entity;
        protected $_options = array();
        protected $_data;
        protected $_elements;
        protected $_elementsIndexed;
        protected $_messages;
        protected $_action;
        protected $_validation;
        /**
         * @param mixed $validation 
         */
        public function setValidation($validation) {}
        public function getValidation() {}
        /**
         * Phalcon\Forms\Form constructor
         *
         * @param object $entity 
         * @param array $userOptions 
         */
        public function __construct($entity = null, $userOptions = null) {}
        /**
         * Sets the form's action
         *
         * @param string $action 
         * @return Form 
         */
        public function setAction($action) {}
        /**
         * Returns the form's action
         *
         * @return string 
         */
        public function getAction() {}
        /**
         * Sets an option for the form
         *
         * @param string $option 
         * @param mixed $value 
         * @return Form 
         */
        public function setUserOption($option, $value) {}
        /**
         * Returns the value of an option if present
         *
         * @param string $option 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getUserOption($option, $defaultValue = null) {}
        /**
         * Sets options for the element
         *
         * @param array $options 
         * @return Form 
         */
        public function setUserOptions(array $options) {}
        /**
         * Returns the options for the element
         *
         * @return array 
         */
        public function getUserOptions() {}
        /**
         * Sets the entity related to the model
         *
         * @param object $entity 
         * @return Form 
         */
        public function setEntity($entity) {}
        /**
         * Returns the entity related to the model
         *
         * @return object 
         */
        public function getEntity() {}
        /**
         * Returns the form elements added to the form
         *
         * @return ElementInterface[] 
         */
        public function getElements() {}
        /**
         * Binds data to the entity
         *
         * @param array $data 
         * @param object $entity 
         * @param array $whitelist 
         * @return Form 
         */
        public function bind(array $data, $entity, $whitelist = null) {}
        /**
         * Validates the form
         *
         * @param array $data 
         * @param object $entity 
         * @return bool 
         */
        public function isValid($data = null, $entity = null) {}
        /**
         * Returns the messages generated in the validation
         *
         * @param bool $byItemName 
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessages($byItemName = false) {}
        /**
         * Returns the messages generated for a specific element
         *
         * @param string $name 
         * @return \Phalcon\Validation\Message\Group 
         */
        public function getMessagesFor($name) {}
        /**
         * Check if messages were generated for a specific element
         *
         * @param string $name 
         * @return bool 
         */
        public function hasMessagesFor($name) {}
        /**
         * Adds an element to the form
         *
         * @param mixed $element 
         * @param string $position 
         * @param bool $type 
         * @return Form 
         */
        public function add(\Phalcon\Forms\ElementInterface $element, $position = null, $type = null) {}
        /**
         * Renders a specific item in the form
         *
         * @param string $name 
         * @param array $attributes 
         * @return string 
         */
        public function render($name, $attributes = null) {}
        /**
         * Returns an element added to the form by its name
         *
         * @param string $name 
         * @return \Phalcon\Forms\ElementInterface 
         */
        public function get($name) {}
        /**
         * Generate the label of a element added to the form including HTML
         *
         * @param string $name 
         * @param array $attributes 
         * @return string 
         */
        public function label($name, array $attributes = null) {}
        /**
         * Returns a label for an element
         *
         * @param string $name 
         * @return string 
         */
        public function getLabel($name) {}
        /**
         * Gets a value from the internal related entity or from the default value
         *
         * @param string $name 
         * @return mixed|null 
         */
        public function getValue($name) {}
        /**
         * Check if the form contains an element
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name) {}
        /**
         * Removes an element from the form
         *
         * @param string $name 
         * @return bool 
         */
        public function remove($name) {}
        /**
         * Clears every element in the form to its default value
         *
         * @param array $fields 
         * @return Form 
         */
        public function clear($fields = null) {}
        /**
         * Returns the number of elements in the form
         *
         * @return int 
         */
        public function count() {}
        /**
         * Rewinds the internal iterator
         */
        public function rewind() {}
        /**
         * Returns the current element in the iterator
         *
         * @return bool|\Phalcon\Forms\ElementInterface 
         */
        public function current() {}
        /**
         * Returns the current position/key in the iterator
         *
         * @return int 
         */
        public function key() {}
        /**
         * Moves the internal iteration pointer to the next position
         */
        public function next() {}
        /**
         * Check if the current element in the iterator is valid
         *
         * @return bool 
         */
        public function valid() {}
    }

    /**
     * Phalcon\Forms\Manager
     */
    class Manager
    {
        protected $_forms;
        /**
         * Creates a form registering it in the forms manager
         *
         * @param string $name 
         * @param object $entity 
         * @return \Phalcon\Forms\Form 
         */
        public function create($name = null, $entity = null) {}
        /**
         * Returns a form by its name
         *
         * @param string $name 
         * @return Form 
         */
        public function get($name) {}
        /**
         * Checks if a form is registered in the forms manager
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name) {}
        /**
         * Registers a form in the Forms Manager
         *
         * @param string $name 
         * @param mixed $form 
         * @return FormManager 
         */
        public function set($name, Form $form) {}
    }
}

namespace \Phalcon\Forms\Element {
    /**
     * Phalcon\Forms\Element\Check
     * Component INPUT[type=check] for forms
     */
    class Check extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Date
     * Component INPUT[type=date] for forms
     */
    class Date extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Email
     * Component INPUT[type=email] for forms
     */
    class Email extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\File
     * Component INPUT[type=file] for forms
     */
    class File extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Hidden
     * Component INPUT[type=hidden] for forms
     */
    class Hidden extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Numeric
     * Component INPUT[type=number] for forms
     */
    class Numeric extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param mixed $attributes 
         * @param array $$attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Password
     * Component INPUT[type=password] for forms
     */
    class Password extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param mixed $attributes 
         * @param array $$attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Radio
     * Component INPUT[type=radio] for forms
     */
    class Radio extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Select
     * Component SELECT (choice) for forms
     */
    class Select extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        protected $_optionsValues;
        /**
         * Phalcon\Forms\Element constructor
         *
         * @param string $name 
         * @param object|array $options 
         * @param array $attributes 
         */
        public function __construct($name, $options = null, $attributes = null) {}
        /**
         * Set the choice's options
         *
         * @param array|object $options 
         * @return \Phalcon\Forms\Element 
         */
        public function setOptions($options) {}
        /**
         * Returns the choices' options
         *
         * @return array|object 
         */
        public function getOptions() {}
        /**
         * Adds an option to the current options
         *
         * @param array $option 
         * @return this 
         */
        public function addOption($option) {}
        /**
         * Renders the element widget returning html
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Submit
     * Component INPUT[type=submit] for forms
     */
    class Submit extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\Text
     * Component INPUT[type=text] for forms
     */
    class Text extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }

    /**
     * Phalcon\Forms\Element\TextArea
     * Component TEXTAREA for forms
     */
    class TextArea extends \Phalcon\Forms\Element implements \Phalcon\Forms\ElementInterface
    {
        /**
         * Renders the element widget
         *
         * @param array $attributes 
         * @return string 
         */
        public function render($attributes = null) {}
    }
}

namespace \Phalcon\Http {
    /**
     * Phalcon\Http\Cookie
     * Provide OO wrappers to manage a HTTP cookie
     */
    class Cookie implements \Phalcon\Http\CookieInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_readed = false;
        protected $_restored = false;
        protected $_useEncryption = false;
        protected $_dependencyInjector;
        protected $_filter;
        protected $_name;
        protected $_value;
        protected $_expire;
        protected $_path = "/";
        protected $_domain;
        protected $_secure;
        protected $_httpOnly = true;
        /**
         * Phalcon\Http\Cookie constructor
         *
         * @param string $name 
         * @param mixed $value 
         * @param int $expire 
         * @param string $path 
         * @param boolean $secure 
         * @param string $domain 
         * @param boolean $httpOnly 
         */
        public function __construct($name, $value = null, $expire = 0, $path = "/", $secure = null, $domain = null, $httpOnly = null) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the cookie's value
         *
         * @param string $value 
         * @return \Phalcon\Http\Cookie 
         */
        public function setValue($value) {}
        /**
         * Returns the cookie's value
         *
         * @param string|array $filters 
         * @param string $defaultValue 
         * @return mixed 
         */
        public function getValue($filters = null, $defaultValue = null) {}
        /**
         * Sends the cookie to the HTTP client
         * Stores the cookie definition in session
         *
         * @return CookieInterface 
         */
        public function send() {}
        /**
         * Reads the cookie-related info from the SESSION to restore the cookie as it was set
         * This method is automatically called internally so normally you don't need to call it
         *
         * @return CookieInterface 
         */
        public function restore() {}
        /**
         * Deletes the cookie by setting an expire time in the past
         */
        public function delete() {}
        /**
         * Sets if the cookie must be encrypted/decrypted automatically
         *
         * @param bool $useEncryption 
         * @return CookieInterface 
         */
        public function useEncryption($useEncryption) {}
        /**
         * Check if the cookie is using implicit encryption
         *
         * @return bool 
         */
        public function isUsingEncryption() {}
        /**
         * Sets the cookie's expiration time
         *
         * @param int $expire 
         * @return CookieInterface 
         */
        public function setExpiration($expire) {}
        /**
         * Returns the current expiration time
         *
         * @return string 
         */
        public function getExpiration() {}
        /**
         * Sets the cookie's expiration time
         *
         * @param string $path 
         * @return CookieInterface 
         */
        public function setPath($path) {}
        /**
         * Returns the current cookie's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Returns the current cookie's path
         *
         * @return string 
         */
        public function getPath() {}
        /**
         * Sets the domain that the cookie is available to
         *
         * @param string $domain 
         * @return CookieInterface 
         */
        public function setDomain($domain) {}
        /**
         * Returns the domain that the cookie is available to
         *
         * @return string 
         */
        public function getDomain() {}
        /**
         * Sets if the cookie must only be sent when the connection is secure (HTTPS)
         *
         * @param bool $secure 
         * @return CookieInterface 
         */
        public function setSecure($secure) {}
        /**
         * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
         *
         * @return bool 
         */
        public function getSecure() {}
        /**
         * Sets if the cookie is accessible only through the HTTP protocol
         *
         * @param bool $httpOnly 
         * @return CookieInterface 
         */
        public function setHttpOnly($httpOnly) {}
        /**
         * Returns if the cookie is accessible only through the HTTP protocol
         *
         * @return bool 
         */
        public function getHttpOnly() {}
        /**
         * Magic __toString method converts the cookie's value to string
         *
         * @return string 
         */
        public function __toString() {}
    }

    /**
     * Phalcon\Http\CookieInterface
     * Interface for Phalcon\Http\Cookie
     */
    interface CookieInterface
    {
        /**
         * Sets the cookie's value
         *
         * @param string $value 
         * @return \Phalcon\Http\CookieInterface 
         */
        public function setValue($value);
        /**
         * Returns the cookie's value
         *
         * @param string|array $filters 
         * @param string $defaultValue 
         * @return mixed 
         */
        public function getValue($filters = null, $defaultValue = null);
        /**
         * Sends the cookie to the HTTP client
         *
         * @return CookieInterface 
         */
        public function send();
        /**
         * Deletes the cookie
         */
        public function delete();
        /**
         * Sets if the cookie must be encrypted/decrypted automatically
         *
         * @param bool $useEncryption 
         * @return CookieInterface 
         */
        public function useEncryption($useEncryption);
        /**
         * Check if the cookie is using implicit encryption
         *
         * @return bool 
         */
        public function isUsingEncryption();
        /**
         * Sets the cookie's expiration time
         *
         * @param int $expire 
         * @return CookieInterface 
         */
        public function setExpiration($expire);
        /**
         * Returns the current expiration time
         *
         * @return string 
         */
        public function getExpiration();
        /**
         * Sets the cookie's expiration time
         *
         * @param string $path 
         * @return CookieInterface 
         */
        public function setPath($path);
        /**
         * Returns the current cookie's name
         *
         * @return string 
         */
        public function getName();
        /**
         * Returns the current cookie's path
         *
         * @return string 
         */
        public function getPath();
        /**
         * Sets the domain that the cookie is available to
         *
         * @param string $domain 
         * @return CookieInterface 
         */
        public function setDomain($domain);
        /**
         * Returns the domain that the cookie is available to
         *
         * @return string 
         */
        public function getDomain();
        /**
         * Sets if the cookie must only be sent when the connection is secure (HTTPS)
         *
         * @param bool $secure 
         * @return CookieInterface 
         */
        public function setSecure($secure);
        /**
         * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
         *
         * @return bool 
         */
        public function getSecure();
        /**
         * Sets if the cookie is accessible only through the HTTP protocol
         *
         * @param bool $httpOnly 
         * @return CookieInterface 
         */
        public function setHttpOnly($httpOnly);
        /**
         * Returns if the cookie is accessible only through the HTTP protocol
         *
         * @return bool 
         */
        public function getHttpOnly();
    }

    /**
     * Phalcon\Http\Request
     * Encapsulates request information for easy and secure access from application controllers.
     * The request object is a simple value object that is passed between the dispatcher and controller classes.
     * It packages the HTTP request environment.
     * <code>
     * use Phalcon\Http\Request;
     * $request = new Request();
     * if ($request->isPost()) {
     * if ($request->isAjax()) {
     * echo 'Request was made using POST and AJAX';
     * }
     * }
     * $request->getServer('HTTP_HOST'); // retrieve SERVER variables
     * $request->getMethod();            // GET, POST, PUT, DELETE, HEAD, OPTIONS, PATCH, PURGE, TRACE, CONNECT
     * $request->getLanguages();         // an array of languages the client accepts
     * </code>
     */
    class Request implements \Phalcon\Http\RequestInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_rawBody;
        protected $_filter;
        protected $_putCache;
        protected $_httpMethodParameterOverride = false;
        protected $_strictHostCheck = false;
        public function getHttpMethodParameterOverride() {}
        /**
         * @param mixed $httpMethodParameterOverride
         */
        public function setHttpMethodParameterOverride($httpMethodParameterOverride) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface
         */
        public function getDI() {}
        /**
         * Gets a variable from the $_REQUEST superglobal applying filters if needed.
         * If no parameters are given the $_REQUEST superglobal is returned
         * <code>
         * //Returns value from $_REQUEST["user_email"] without sanitizing
         * $userEmail = $request->get("user_email");
         * //Returns value from $_REQUEST["user_email"] with sanitizing
         * $userEmail = $request->get("user_email", "email");
         * </code>
         *
         * @param string $name
         * @param mixed $filters
         * @param mixed $defaultValue
         * @param bool $notAllowEmpty
         * @param bool $noRecursive
         * @return mixed
         */
        public function get($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}
        /**
         * Gets a variable from the $_POST superglobal applying filters if needed
         * If no parameters are given the $_POST superglobal is returned
         * <code>
         * //Returns value from $_POST["user_email"] without sanitizing
         * $userEmail = $request->getPost("user_email");
         * //Returns value from $_POST["user_email"] with sanitizing
         * $userEmail = $request->getPost("user_email", "email");
         * </code>
         *
         * @param string $name
         * @param mixed $filters
         * @param mixed $defaultValue
         * @param bool $notAllowEmpty
         * @param bool $noRecursive
         * @return mixed
         */
        public function getPost($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}
        /**
         * Gets a variable from put request
         * <code>
         * //Returns value from $_PUT["user_email"] without sanitizing
         * $userEmail = $request->getPut("user_email");
         * //Returns value from $_PUT["user_email"] with sanitizing
         * $userEmail = $request->getPut("user_email", "email");
         * </code>
         *
         * @param string $name
         * @param mixed $filters
         * @param mixed $defaultValue
         * @param bool $notAllowEmpty
         * @param bool $noRecursive
         * @return mixed
         */
        public function getPut($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}
        /**
         * Gets variable from $_GET superglobal applying filters if needed
         * If no parameters are given the $_GET superglobal is returned
         * <code>
         * // Returns value from $_GET['id'] without sanitizing
         * $id = $request->getQuery('id');
         * // Returns value from $_GET['id'] with sanitizing
         * $id = $request->getQuery('id', 'int');
         * // Returns value from $_GET['id'] with a default value
         * $id = $request->getQuery('id', null, 150);
         * </code>
         *
         * @param string $name
         * @param mixed $filters
         * @param mixed $defaultValue
         * @param bool $notAllowEmpty
         * @param bool $noRecursive
         * @return mixed
         */
        public function getQuery($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}
        /**
         * Helper to get data from superglobals, applying filters if needed.
         * If no parameters are given the superglobal is returned.
         *
         * @param array $source
         * @param string $name
         * @param mixed $filters
         * @param mixed $defaultValue
         * @param bool $notAllowEmpty
         * @param bool $noRecursive
         * @return mixed
         */
        protected final function getHelper(array $source, $name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}
        /**
         * Gets variable from $_SERVER superglobal
         *
         * @param string $name
         * @return string|null
         */
        public function getServer($name) {}
        /**
         * Checks whether $_REQUEST superglobal has certain index
         *
         * @param string $name
         * @return bool
         */
        public function has($name) {}
        /**
         * Checks whether $_POST superglobal has certain index
         *
         * @param string $name
         * @return bool
         */
        public function hasPost($name) {}
        /**
         * Checks whether the PUT data has certain index
         *
         * @param string $name
         * @return bool
         */
        public function hasPut($name) {}
        /**
         * Checks whether $_GET superglobal has certain index
         *
         * @param string $name
         * @return bool
         */
        public function hasQuery($name) {}
        /**
         * Checks whether $_SERVER superglobal has certain index
         *
         * @param string $name
         * @return bool
         */
        public final function hasServer($name) {}
        /**
         * Gets HTTP header from request data
         *
         * @param string $header
         * @return string
         */
        public final function getHeader($header) {}
        /**
         * Gets HTTP schema (http/https)
         *
         * @return string
         */
        public function getScheme() {}
        /**
         * Checks whether request has been made using ajax
         *
         * @return bool
         */
        public function isAjax() {}
        /**
         * Checks whether request has been made using SOAP
         *
         * @return bool
         */
        public function isSoap() {}
        /**
         * Alias of isSoap(). It will be deprecated in future versions
         *
         * @return bool
         */
        public function isSoapRequested() {}
        /**
         * Checks whether request has been made using any secure layer
         *
         * @return bool
         */
        public function isSecure() {}
        /**
         * Alias of isSecure(). It will be deprecated in future versions
         *
         * @return bool
         */
        public function isSecureRequest() {}
        /**
         * Gets HTTP raw request body
         *
         * @return string
         */
        public function getRawBody() {}
        /**
         * Gets decoded JSON HTTP raw request body
         *
         * @param bool $associative
         * @return array|bool|\stdClass
         */
        public function getJsonRawBody($associative = false) {}
        /**
         * Gets active server address IP
         *
         * @return string
         */
        public function getServerAddress() {}
        /**
         * Gets active server name
         *
         * @return string
         */
        public function getServerName() {}
        /**
         * Gets host name used by the request.
         * `Request::getHttpHost` trying to find host name in following order:
         * - `$_SERVER['HTTP_HOST']`
         * - `$_SERVER['SERVER_NAME']`
         * - `$_SERVER['SERVER_ADDR']`
         * Optionally `Request::getHttpHost` validates and clean host name.
         * The `Request::$_strictHostCheck` can be used to validate host name.
         * Note: validation and cleaning have a negative performance impact because they use regular expressions.
         * <code>
         * use Phalcon\Http\Request;
         * $request = new Request;
         * $_SERVER['HTTP_HOST'] = 'example.com';
         * $request->getHttpHost(); // example.com
         * $_SERVER['HTTP_HOST'] = 'example.com:8080';
         * $request->getHttpHost(); // example.com:8080
         * $request->setStrictHostCheck(true);
         * $_SERVER['HTTP_HOST'] = 'ex=am~ple.com';
         * $request->getHttpHost(); // UnexpectedValueException
         * $_SERVER['HTTP_HOST'] = 'ExAmPlE.com';
         * $request->getHttpHost(); // example.com
         * </code>
         *
         * @return string
         */
        public function getHttpHost() {}
        /**
         * Sets if the `Request::getHttpHost` method must be use strict validation of host name or not
         *
         * @param bool $flag
         * @return Request
         */
        public function setStrictHostCheck($flag = true) {}
        /**
         * Checks if the `Request::getHttpHost` method will be use strict validation of host name or not
         *
         * @return bool
         */
        public function isStrictHostCheck() {}
        /**
         * Gets information about the port on which the request is made.
         *
         * @return int
         */
        public function getPort() {}
        /**
         * Gets HTTP URI which request has been made
         *
         * @return string
         */
        public final function getURI() {}
        /**
         * Gets most possible client IPv4 Address. This method search in _SERVER['REMOTE_ADDR'] and optionally in _SERVER['HTTP_X_FORWARDED_FOR']
         *
         * @param bool $trustForwardedHeader
         * @return string|bool
         */
        public function getClientAddress($trustForwardedHeader = false) {}
        /**
         * Gets HTTP method which request has been made
         * If the X-HTTP-Method-Override header is set, and if the method is a POST,
         * then it is used to determine the "real" intended HTTP method.
         * The _method request parameter can also be used to determine the HTTP method,
         * but only if setHttpMethodParameterOverride(true) has been called.
         * The method is always an uppercased string.
         *
         * @return string
         */
        public final function getMethod() {}
        /**
         * Gets HTTP user agent used to made the request
         *
         * @return string
         */
        public function getUserAgent() {}
        /**
         * Checks if a method is a valid HTTP method
         *
         * @param string $method
         * @return bool
         */
        public function isValidHttpMethod($method) {}
        /**
         * Check if HTTP method match any of the passed methods
         * When strict is true it checks if validated methods are real HTTP methods
         *
         * @param mixed $methods
         * @param bool $strict
         * @return bool
         */
        public function isMethod($methods, $strict = false) {}
        /**
         * Checks whether HTTP method is POST. if _SERVER["REQUEST_METHOD"]==="POST"
         *
         * @return bool
         */
        public function isPost() {}
        /**
         * Checks whether HTTP method is GET. if _SERVER["REQUEST_METHOD"]==="GET"
         *
         * @return bool
         */
        public function isGet() {}
        /**
         * Checks whether HTTP method is PUT. if _SERVER["REQUEST_METHOD"]==="PUT"
         *
         * @return bool
         */
        public function isPut() {}
        /**
         * Checks whether HTTP method is PATCH. if _SERVER["REQUEST_METHOD"]==="PATCH"
         *
         * @return bool
         */
        public function isPatch() {}
        /**
         * Checks whether HTTP method is HEAD. if _SERVER["REQUEST_METHOD"]==="HEAD"
         *
         * @return bool
         */
        public function isHead() {}
        /**
         * Checks whether HTTP method is DELETE. if _SERVER["REQUEST_METHOD"]==="DELETE"
         *
         * @return bool
         */
        public function isDelete() {}
        /**
         * Checks whether HTTP method is OPTIONS. if _SERVER["REQUEST_METHOD"]==="OPTIONS"
         *
         * @return bool
         */
        public function isOptions() {}
        /**
         * Checks whether HTTP method is PURGE (Squid and Varnish support). if _SERVER["REQUEST_METHOD"]==="PURGE"
         *
         * @return bool
         */
        public function isPurge() {}
        /**
         * Checks whether HTTP method is TRACE. if _SERVER["REQUEST_METHOD"]==="TRACE"
         *
         * @return bool
         */
        public function isTrace() {}
        /**
         * Checks whether HTTP method is CONNECT. if _SERVER["REQUEST_METHOD"]==="CONNECT"
         *
         * @return bool
         */
        public function isConnect() {}
        /**
         * Checks whether request include attached files
         *
         * @param bool $onlySuccessful
         * @return long
         */
        public function hasFiles($onlySuccessful = false) {}
        /**
         * Recursively counts file in an array of files
         *
         * @param mixed $data
         * @param bool $onlySuccessful
         * @return long
         */
        protected final function hasFileHelper($data, $onlySuccessful) {}
        /**
         * Gets attached files as Phalcon\Http\Request\File instances
         *
         * @param bool $onlySuccessful
         * @return File[]
         */
        public function getUploadedFiles($onlySuccessful = false) {}
        /**
         * Smooth out $_FILES to have plain array with all files uploaded
         *
         * @param array $names
         * @param array $types
         * @param array $tmp_names
         * @param array $sizes
         * @param array $errors
         * @param string $prefix
         * @return array
         */
        protected final function smoothFiles(array $names, array $types, array $tmp_names, array $sizes, array $errors, $prefix) {}
        /**
         * Returns the available headers in the request
         *
         * @return array
         */
        public function getHeaders() {}
        /**
         * Gets web page that refers active request. ie: http://www.google.com
         *
         * @return string
         */
        public function getHTTPReferer() {}
        /**
         * Process a request header and return an array of values with their qualities
         *
         * @param string $serverIndex
         * @param string $name
         * @return array
         */
        protected final function _getQualityHeader($serverIndex, $name) {}
        /**
         * Process a request header and return the one with best quality
         *
         * @param array $qualityParts
         * @param string $name
         * @return string
         */
        protected final function _getBestQuality(array $qualityParts, $name) {}
        /**
         * Gets content type which request has been made
         *
         * @return string|null
         */
        public function getContentType() {}
        /**
         * Gets an array with mime/types and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
         *
         * @return array
         */
        public function getAcceptableContent() {}
        /**
         * Gets best mime/type accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
         *
         * @return string
         */
        public function getBestAccept() {}
        /**
         * Gets a charsets array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
         *
         * @return mixed
         */
        public function getClientCharsets() {}
        /**
         * Gets best charset accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
         *
         * @return string
         */
        public function getBestCharset() {}
        /**
         * Gets languages array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
         *
         * @return array
         */
        public function getLanguages() {}
        /**
         * Gets best language accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
         *
         * @return string
         */
        public function getBestLanguage() {}
        /**
         * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_USER']
         *
         * @return array|null
         */
        public function getBasicAuth() {}
        /**
         * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_DIGEST']
         *
         * @return array
         */
        public function getDigestAuth() {}
    }

    /**
     * Phalcon\Http\RequestInterface
     * Interface for Phalcon\Http\Request
     */
    interface RequestInterface
    {
        /**
         * Gets a variable from the $_REQUEST superglobal applying filters if needed
         *
         * @param string $name 
         * @param string|array $filters 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function get($name = null, $filters = null, $defaultValue = null);
        /**
         * Gets a variable from the $_POST superglobal applying filters if needed
         *
         * @param string $name 
         * @param string|array $filters 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getPost($name = null, $filters = null, $defaultValue = null);
        /**
         * Gets variable from $_GET superglobal applying filters if needed
         *
         * @param string $name 
         * @param string|array $filters 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getQuery($name = null, $filters = null, $defaultValue = null);
        /**
         * Gets variable from $_SERVER superglobal
         *
         * @param string $name 
         * @return mixed 
         */
        public function getServer($name);
        /**
         * Checks whether $_REQUEST superglobal has certain index
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name);
        /**
         * Checks whether $_POST superglobal has certain index
         *
         * @param string $name 
         * @return bool 
         */
        public function hasPost($name);
        /**
         * Checks whether the PUT data has certain index
         *
         * @param string $name 
         * @return bool 
         */
        public function hasPut($name);
        /**
         * Checks whether $_GET superglobal has certain index
         *
         * @param string $name 
         * @return bool 
         */
        public function hasQuery($name);
        /**
         * Checks whether $_SERVER superglobal has certain index
         *
         * @param string $name 
         * @return bool 
         */
        public function hasServer($name);
        /**
         * Gets HTTP header from request data
         *
         * @param string $header 
         * @return string 
         */
        public function getHeader($header);
        /**
         * Gets HTTP schema (http/https)
         *
         * @return string 
         */
        public function getScheme();
        /**
         * Checks whether request has been made using ajax. Checks if $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
         *
         * @return bool 
         */
        public function isAjax();
        /**
         * Checks whether request has been made using SOAP
         *
         * @return bool 
         */
        public function isSoapRequested();
        /**
         * Checks whether request has been made using any secure layer
         *
         * @return bool 
         */
        public function isSecureRequest();
        /**
         * Gets HTTP raws request body
         *
         * @return string 
         */
        public function getRawBody();
        /**
         * Gets active server address IP
         *
         * @return string 
         */
        public function getServerAddress();
        /**
         * Gets active server name
         *
         * @return string 
         */
        public function getServerName();
        /**
         * Gets host name used by the request
         *
         * @return string 
         */
        public function getHttpHost();
        /**
         * Gets information about the port on which the request is made
         *
         * @return int 
         */
        public function getPort();
        /**
         * Gets most possibly client IPv4 Address. This methods search in $_SERVER['REMOTE_ADDR'] and optionally in $_SERVER['HTTP_X_FORWARDED_FOR']
         *
         * @param bool $trustForwardedHeader 
         * @return string 
         */
        public function getClientAddress($trustForwardedHeader = false);
        /**
         * Gets HTTP method which request has been made
         *
         * @return string 
         */
        public function getMethod();
        /**
         * Gets HTTP user agent used to made the request
         *
         * @return string 
         */
        public function getUserAgent();
        /**
         * Check if HTTP method match any of the passed methods
         *
         * @param string|array $methods 
         * @param bool $strict 
         * @return boolean 
         */
        public function isMethod($methods, $strict = false);
        /**
         * Checks whether HTTP method is POST. if $_SERVER['REQUEST_METHOD']=='POST'
         *
         * @return bool 
         */
        public function isPost();
        /**
         * Checks whether HTTP method is GET. if $_SERVER['REQUEST_METHOD']=='GET'
         *
         * @return bool 
         */
        public function isGet();
        /**
         * Checks whether HTTP method is PUT. if $_SERVER['REQUEST_METHOD']=='PUT'
         *
         * @return bool 
         */
        public function isPut();
        /**
         * Checks whether HTTP method is HEAD. if $_SERVER['REQUEST_METHOD']=='HEAD'
         *
         * @return bool 
         */
        public function isHead();
        /**
         * Checks whether HTTP method is DELETE. if $_SERVER['REQUEST_METHOD']=='DELETE'
         *
         * @return bool 
         */
        public function isDelete();
        /**
         * Checks whether HTTP method is OPTIONS. if $_SERVER['REQUEST_METHOD']=='OPTIONS'
         *
         * @return bool 
         */
        public function isOptions();
        /**
         * Checks whether HTTP method is PURGE (Squid and Varnish support). if _SERVER["REQUEST_METHOD"]==="PURGE"
         *
         * @return bool 
         */
        public function isPurge();
        /**
         * Checks whether HTTP method is TRACE. if _SERVER["REQUEST_METHOD"]==="TRACE"
         *
         * @return bool 
         */
        public function isTrace();
        /**
         * Checks whether HTTP method is CONNECT. if _SERVER["REQUEST_METHOD"]==="CONNECT"
         *
         * @return bool 
         */
        public function isConnect();
        /**
         * Checks whether request include attached files
         *
         * @param boolean $onlySuccessful 
         * @return boolean 
         */
        public function hasFiles($onlySuccessful = false);
        /**
         * Gets attached files as Phalcon\Http\Request\FileInterface compatible instances
         *
         * @param bool $onlySuccessful 
         * @return \Phalcon\Http\Request\FileInterface[] 
         */
        public function getUploadedFiles($onlySuccessful = false);
        /**
         * Gets web page that refers active request. ie: http://www.google.com
         *
         * @return string 
         */
        public function getHTTPReferer();
        /**
         * Gets array with mime/types and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
         *
         * @return array 
         */
        public function getAcceptableContent();
        /**
         * Gets best mime/type accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
         *
         * @return string 
         */
        public function getBestAccept();
        /**
         * Gets charsets array and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
         *
         * @return array 
         */
        public function getClientCharsets();
        /**
         * Gets best charset accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
         *
         * @return string 
         */
        public function getBestCharset();
        /**
         * Gets languages array and their quality accepted by the browser/client from _SERVER['HTTP_ACCEPT_LANGUAGE']
         *
         * @return array 
         */
        public function getLanguages();
        /**
         * Gets best language accepted by the browser/client from $_SERVER['HTTP_ACCEPT_LANGUAGE']
         *
         * @return string 
         */
        public function getBestLanguage();
        /**
         * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_USER']
         *
         * @return array 
         */
        public function getBasicAuth();
        /**
         * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_DIGEST']
         *
         * @return array 
         */
        public function getDigestAuth();
    }

    /**
     * Phalcon\Http\Response
     * Part of the HTTP cycle is return responses to the clients.
     * Phalcon\HTTP\Response is the Phalcon component responsible to achieve this task.
     * HTTP responses are usually composed by headers and body.
     * <code>
     * $response = new \Phalcon\Http\Response();
     * $response->setStatusCode(200, "OK");
     * $response->setContent("<html><body>Hello</body></html>");
     * $response->send();
     * </code>
     */
    class Response implements \Phalcon\Http\ResponseInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_sent = false;
        protected $_content;
        protected $_headers;
        protected $_cookies;
        protected $_file;
        protected $_dependencyInjector;
        /**
         * Phalcon\Http\Response constructor
         *
         * @param mixed $content 
         * @param mixed $code 
         * @param mixed $status 
         */
        public function __construct($content = null, $code = null, $status = null) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the HTTP response code
         * <code>
         * $response->setStatusCode(404, "Not Found");
         * </code>
         *
         * @param int $code 
         * @param string $message 
         * @return Response 
         */
        public function setStatusCode($code, $message = null) {}
        /**
         * Returns the status code
         * <code>
         * print_r($response->getStatusCode());
         * </code>
         *
         * @return array 
         */
        public function getStatusCode() {}
        /**
         * Sets a headers bag for the response externally
         *
         * @param mixed $headers 
         * @return Response 
         */
        public function setHeaders(\Phalcon\Http\Response\HeadersInterface $headers) {}
        /**
         * Returns headers set by the user
         *
         * @return \Phalcon\Http\Response\HeadersInterface 
         */
        public function getHeaders() {}
        /**
         * Sets a cookies bag for the response externally
         *
         * @param mixed $cookies 
         * @return Response 
         */
        public function setCookies(\Phalcon\Http\Response\CookiesInterface $cookies) {}
        /**
         * Returns coookies set by the user
         *
         * @return \Phalcon\Http\Response\CookiesInterface 
         */
        public function getCookies() {}
        /**
         * Overwrites a header in the response
         * <code>
         * $response->setHeader("Content-Type", "text/plain");
         * </code>
         *
         * @param string $name 
         * @param mixed $value 
         * @return Response 
         */
        public function setHeader($name, $value) {}
        /**
         * Send a raw header to the response
         * <code>
         * $response->setRawHeader("HTTP/1.1 404 Not Found");
         * </code>
         *
         * @param string $header 
         * @return Response 
         */
        public function setRawHeader($header) {}
        /**
         * Resets all the stablished headers
         *
         * @return Response 
         */
        public function resetHeaders() {}
        /**
         * Sets a Expires header to use HTTP cache
         * <code>
         * $this->response->setExpires(new DateTime());
         * </code>
         *
         * @param mixed $datetime 
         * @return Response 
         */
        public function setExpires(\DateTime $datetime) {}
        /**
         * Sets Last-Modified header
         * <code>
         * $this->response->setLastModified(new DateTime());
         * </code>
         *
         * @param mixed $datetime 
         * @return Response 
         */
        public function setLastModified(\DateTime $datetime) {}
        /**
         * Sets Cache headers to use HTTP cache
         * <code>
         * $this->response->setCache(60);
         * </code>
         *
         * @param int $minutes 
         * @return Response 
         */
        public function setCache($minutes) {}
        /**
         * Sends a Not-Modified response
         *
         * @return Response 
         */
        public function setNotModified() {}
        /**
         * Sets the response content-type mime, optionally the charset
         * <code>
         * $response->setContentType('application/pdf');
         * $response->setContentType('text/plain', 'UTF-8');
         * </code>
         *
         * @param string $contentType 
         * @param mixed $charset 
         * @return Response 
         */
        public function setContentType($contentType, $charset = null) {}
        /**
         * Sets the response content-length
         * <code>
         * $response->setContentLength(2048);
         * </code>
         *
         * @param int $contentLength 
         * @return Response 
         */
        public function setContentLength($contentLength) {}
        /**
         * Set a custom ETag
         * <code>
         * $response->setEtag(md5(time()));
         * </code>
         *
         * @param string $etag 
         * @return Response 
         */
        public function setEtag($etag) {}
        /**
         * Redirect by HTTP to another action or URL
         * <code>
         * //Using a string redirect (internal/external)
         * $response->redirect("posts/index");
         * $response->redirect("http://en.wikipedia.org", true);
         * $response->redirect("http://www.example.com/new-location", true, 301);
         * //Making a redirection based on a named route
         * $response->redirect(array(
         * "for" => "index-lang",
         * "lang" => "jp",
         * "controller" => "index"
         * ));
         * </code>
         *
         * @param mixed $location 
         * @param bool $externalRedirect 
         * @param int $statusCode 
         * @return Response 
         */
        public function redirect($location = null, $externalRedirect = false, $statusCode = 302) {}
        /**
         * Sets HTTP response body
         * <code>
         * response->setContent("<h1>Hello!</h1>");
         * </code>
         *
         * @param string $content 
         * @return Response 
         */
        public function setContent($content) {}
        /**
         * Sets HTTP response body. The parameter is automatically converted to JSON
         * and also sets default header: Content-Type: "application/json; charset=UTF-8"
         * <code>
         * $response->setJsonContent(array("status" => "OK"));
         * </code>
         *
         * @param mixed $content 
         * @param int $jsonOptions 
         * @param int $depth 
         * @return Response 
         */
        public function setJsonContent($content, $jsonOptions = 0, $depth = 512) {}
        /**
         * Appends a string to the HTTP response body
         *
         * @param mixed $content 
         * @return Response 
         */
        public function appendContent($content) {}
        /**
         * Gets the HTTP response body
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Check if the response is already sent
         *
         * @return bool 
         */
        public function isSent() {}
        /**
         * Sends headers to the client
         *
         * @return Response 
         */
        public function sendHeaders() {}
        /**
         * Sends cookies to the client
         *
         * @return Response 
         */
        public function sendCookies() {}
        /**
         * Prints out HTTP response to the client
         *
         * @return Response 
         */
        public function send() {}
        /**
         * Sets an attached file to be sent at the end of the request
         *
         * @param string $filePath 
         * @param mixed $attachmentName 
         * @param mixed $attachment 
         * @return Response 
         */
        public function setFileToSend($filePath, $attachmentName = null, $attachment = true) {}
    }

    /**
     * Phalcon\Http\Response
     * Interface for Phalcon\Http\Response
     */
    interface ResponseInterface
    {
        /**
         * Sets the HTTP response code
         *
         * @param int $code 
         * @param string $message 
         * @return ResponseInterface 
         */
        public function setStatusCode($code, $message = null);
        /**
         * Returns headers set by the user
         *
         * @return \Phalcon\Http\Response\HeadersInterface 
         */
        public function getHeaders();
        /**
         * Overwrites a header in the response
         *
         * @param string $name 
         * @param mixed $value 
         * @return ResponseInterface 
         */
        public function setHeader($name, $value);
        /**
         * Send a raw header to the response
         *
         * @param string $header 
         * @return ResponseInterface 
         */
        public function setRawHeader($header);
        /**
         * Resets all the stablished headers
         *
         * @return ResponseInterface 
         */
        public function resetHeaders();
        /**
         * Sets output expire time header
         *
         * @param mixed $datetime 
         * @return ResponseInterface 
         */
        public function setExpires(\DateTime $datetime);
        /**
         * Sends a Not-Modified response
         *
         * @return ResponseInterface 
         */
        public function setNotModified();
        /**
         * Sets the response content-type mime, optionally the charset
         *
         * @param string $contentType 
         * @param string $charset 
         * @return \Phalcon\Http\ResponseInterface 
         */
        public function setContentType($contentType, $charset = null);
        /**
         * Sets the response content-length
         *
         * @param int $contentLength 
         * @return ResponseInterface 
         */
        public function setContentLength($contentLength);
        /**
         * Redirect by HTTP to another action or URL
         *
         * @param mixed $location 
         * @param bool $externalRedirect 
         * @param int $statusCode 
         * @return ResponseInterface 
         */
        public function redirect($location = null, $externalRedirect = false, $statusCode = 302);
        /**
         * Sets HTTP response body
         *
         * @param string $content 
         * @return ResponseInterface 
         */
        public function setContent($content);
        /**
         * Sets HTTP response body. The parameter is automatically converted to JSON
         * <code>
         * response->setJsonContent(array("status" => "OK"));
         * </code>
         *
         * @param mixed $content 
         * @return ResponseInterface 
         */
        public function setJsonContent($content);
        /**
         * Appends a string to the HTTP response body
         *
         * @param mixed $content 
         * @return ResponseInterface 
         */
        public function appendContent($content);
        /**
         * Gets the HTTP response body
         *
         * @return string 
         */
        public function getContent();
        /**
         * Sends headers to the client
         *
         * @return ResponseInterface 
         */
        public function sendHeaders();
        /**
         * Sends cookies to the client
         *
         * @return ResponseInterface 
         */
        public function sendCookies();
        /**
         * Prints out HTTP response to the client
         *
         * @return ResponseInterface 
         */
        public function send();
        /**
         * Sets an attached file to be sent at the end of the request
         *
         * @param string $filePath 
         * @param mixed $attachmentName 
         * @return ResponseInterface 
         */
        public function setFileToSend($filePath, $attachmentName = null);
    }
}

namespace \Phalcon\Http\Cookie {
    /**
     * Phalcon\Http\Cookie\Exception
     * Exceptions thrown in Phalcon\Http\Cookie will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Http\Request {
    /**
     * Phalcon\Http\Request\Exception
     * Exceptions thrown in Phalcon\Http\Request will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Http\Request\File
     * Provides OO wrappers to the $_FILES superglobal
     * <code>
     * use Phalcon\Mvc\Controller;
     * class PostsController extends Controller
     * {
     * public function uploadAction()
     * {
     * // Check if the user has uploaded files
     * if ($this->request->hasFiles() == true) {
     * // Print the real file names and their sizes
     * foreach ($this->request->getUploadedFiles() as $file) {
     * echo $file->getName(), " ", $file->getSize(), "\n";
     * }
     * }
     * }
     * }
     * </code>
     */
    class File implements \Phalcon\Http\Request\FileInterface
    {
        protected $_name;
        protected $_tmp;
        protected $_size;
        protected $_type;
        protected $_realType;
        /**
         * @var string|null
         */
        protected $_error;
        /**
         * @var string|null
         */
        protected $_key;
        /**
         * @var string
         */
        protected $_extension;
        /**
         * @return string|null 
         */
        public function getError() {}
        /**
         * @return string|null 
         */
        public function getKey() {}
        /**
         * @return string 
         */
        public function getExtension() {}
        /**
         * Phalcon\Http\Request\File constructor
         *
         * @param array $file 
         * @param mixed $key 
         */
        public function __construct(array $file, $key = null) {}
        /**
         * Returns the file size of the uploaded file
         *
         * @return int 
         */
        public function getSize() {}
        /**
         * Returns the real name of the uploaded file
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Returns the temporary name of the uploaded file
         *
         * @return string 
         */
        public function getTempName() {}
        /**
         * Returns the mime type reported by the browser
         * This mime type is not completely secure, use getRealType() instead
         *
         * @return string 
         */
        public function getType() {}
        /**
         * Gets the real mime type of the upload file using finfo
         *
         * @return string 
         */
        public function getRealType() {}
        /**
         * Checks whether the file has been uploaded via Post.
         *
         * @return bool 
         */
        public function isUploadedFile() {}
        /**
         * Moves the temporary file to a destination within the application
         *
         * @param string $destination 
         * @return bool 
         */
        public function moveTo($destination) {}
    }

    /**
     * Phalcon\Http\Request\FileInterface
     * Interface for Phalcon\Http\Request\File
     */
    interface FileInterface
    {
        /**
         * Returns the file size of the uploaded file
         *
         * @return int 
         */
        public function getSize();
        /**
         * Returns the real name of the uploaded file
         *
         * @return string 
         */
        public function getName();
        /**
         * Returns the temporal name of the uploaded file
         *
         * @return string 
         */
        public function getTempName();
        /**
         * Returns the mime type reported by the browser
         * This mime type is not completely secure, use getRealType() instead
         *
         * @return string 
         */
        public function getType();
        /**
         * Gets the real mime type of the upload file using finfo
         *
         * @return string 
         */
        public function getRealType();
        /**
         * Move the temporary file to a destination
         *
         * @param string $destination 
         * @return bool 
         */
        public function moveTo($destination);
    }
}

namespace \Phalcon\Http\Response {
    /**
     * Phalcon\Http\Response\Cookies
     * This class is a bag to manage the cookies
     * A cookies bag is automatically registered as part of the 'response' service in the DI
     */
    class Cookies implements \Phalcon\Http\Response\CookiesInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_registered = false;
        protected $_useEncryption = true;
        protected $_cookies;
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Set if cookies in the bag must be automatically encrypted/decrypted
         *
         * @param bool $useEncryption 
         * @return Cookies 
         */
        public function useEncryption($useEncryption) {}
        /**
         * Returns if the bag is automatically encrypting/decrypting cookies
         *
         * @return bool 
         */
        public function isUsingEncryption() {}
        /**
         * Sets a cookie to be sent at the end of the request
         * This method overrides any cookie set before with the same name
         *
         * @param string $name 
         * @param mixed $value 
         * @param int $expire 
         * @param string $path 
         * @param bool $secure 
         * @param string $domain 
         * @param bool $httpOnly 
         * @return Cookies 
         */
        public function set($name, $value = null, $expire = 0, $path = "/", $secure = null, $domain = null, $httpOnly = null) {}
        /**
         * Gets a cookie from the bag
         *
         * @param string $name 
         * @return \Phalcon\Http\CookieInterface 
         */
        public function get($name) {}
        /**
         * Check if a cookie is defined in the bag or exists in the _COOKIE superglobal
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name) {}
        /**
         * Deletes a cookie by its name
         * This method does not removes cookies from the _COOKIE superglobal
         *
         * @param string $name 
         * @return bool 
         */
        public function delete($name) {}
        /**
         * Sends the cookies to the client
         * Cookies aren't sent if headers are sent in the current request
         *
         * @return bool 
         */
        public function send() {}
        /**
         * Reset set cookies
         *
         * @return Cookies 
         */
        public function reset() {}
    }

    /**
     * Phalcon\Http\Response\CookiesInterface
     * Interface for Phalcon\Http\Response\Cookies
     */
    interface CookiesInterface
    {
        /**
         * Set if cookies in the bag must be automatically encrypted/decrypted
         *
         * @param bool $useEncryption 
         * @return CookiesInterface 
         */
        public function useEncryption($useEncryption);
        /**
         * Returns if the bag is automatically encrypting/decrypting cookies
         *
         * @return bool 
         */
        public function isUsingEncryption();
        /**
         * Sets a cookie to be sent at the end of the request
         *
         * @param string $name 
         * @param mixed $value 
         * @param int $expire 
         * @param string $path 
         * @param bool $secure 
         * @param string $domain 
         * @param bool $httpOnly 
         * @return CookiesInterface 
         */
        public function set($name, $value = null, $expire = 0, $path = "/", $secure = null, $domain = null, $httpOnly = null);
        /**
         * Gets a cookie from the bag
         *
         * @param string $name 
         * @return \Phalcon\Http\Cookie 
         */
        public function get($name);
        /**
         * Check if a cookie is defined in the bag or exists in the _COOKIE superglobal
         *
         * @param string $name 
         * @return bool 
         */
        public function has($name);
        /**
         * Deletes a cookie by its name
         * This method does not removes cookies from the _COOKIE superglobal
         *
         * @param string $name 
         * @return bool 
         */
        public function delete($name);
        /**
         * Sends the cookies to the client
         *
         * @return bool 
         */
        public function send();
        /**
         * Reset set cookies
         *
         * @return CookiesInterface 
         */
        public function reset();
    }

    /**
     * Phalcon\Http\Response\Exception
     * Exceptions thrown in Phalcon\Http\Response will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Http\Response\Headers
     * This class is a bag to manage the response headers
     */
    class Headers implements \Phalcon\Http\Response\HeadersInterface
    {
        protected $_headers = array();
        /**
         * Sets a header to be sent at the end of the request
         *
         * @param string $name 
         * @param string $value 
         */
        public function set($name, $value) {}
        /**
         * Gets a header value from the internal bag
         *
         * @param string $name 
         * @return string|bool 
         */
        public function get($name) {}
        /**
         * Sets a raw header to be sent at the end of the request
         *
         * @param string $header 
         */
        public function setRaw($header) {}
        /**
         * Removes a header to be sent at the end of the request
         *
         * @param string $header 
         */
        public function remove($header) {}
        /**
         * Sends the headers to the client
         *
         * @return bool 
         */
        public function send() {}
        /**
         * Reset set headers
         */
        public function reset() {}
        /**
         * Returns the current headers as an array
         *
         * @return array 
         */
        public function toArray() {}
        /**
         * Restore a \Phalcon\Http\Response\Headers object
         *
         * @param array $data 
         * @return Headers 
         */
        public static function __set_state(array $data) {}
    }

    /**
     * Phalcon\Http\Response\HeadersInterface
     * Interface for Phalcon\Http\Response\Headers compatible bags
     */
    interface HeadersInterface
    {
        /**
         * Sets a header to be sent at the end of the request
         *
         * @param string $name 
         * @param string $value 
         */
        public function set($name, $value);
        /**
         * Gets a header value from the internal bag
         *
         * @param string $name 
         * @return string|bool 
         */
        public function get($name);
        /**
         * Sets a raw header to be sent at the end of the request
         *
         * @param string $header 
         */
        public function setRaw($header);
        /**
         * Sends the headers to the client
         *
         * @return bool 
         */
        public function send();
        /**
         * Reset set headers
         */
        public function reset();
        /**
         * Restore a \Phalcon\Http\Response\Headers object
         *
         * @param array $data 
         * @return HeadersInterface 
         */
        public static function __set_state(array $data);
    }
}

namespace \Phalcon\Image {
    /**
     * Phalcon\Image\Adapter
     * All image adapters must use this class
     */
    abstract class Adapter
    {
        protected $_image;
        protected $_file;
        protected $_realpath;
        /**
         * Image width
         *
         * @var int
         */
        protected $_width;
        /**
         * Image height
         *
         * @var int
         */
        protected $_height;
        /**
         * Image type
         * Driver dependent
         *
         * @var int
         */
        protected $_type;
        /**
         * Image mime type
         *
         * @var string
         */
        protected $_mime;
        static protected $_checked = false;
        public function getImage() {}
        public function getRealpath() {}
        /**
         * Image width
         *
         * @return int 
         */
        public function getWidth() {}
        /**
         * Image height
         *
         * @return int 
         */
        public function getHeight() {}
        /**
         * Image type
         * Driver dependent
         *
         * @return int 
         */
        public function getType() {}
        /**
         * Image mime type
         *
         * @return string 
         */
        public function getMime() {}
        /**
         * Resize the image to the given size
         *
         * @param int $width 
         * @param int $height 
         * @param int $master 
         * @return Adapter 
         */
        public function resize($width = null, $height = null, $master = Image::AUTO) {}
        /**
         * This method scales the images using liquid rescaling method. Only support Imagick
         *
         * @param int $width 
         * @param int $height 
         * @param int $deltaX 
         * @param int $rigidity 
         * @param int $$width new width
         * @param int $$height new height
         * @param int $$deltaX How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
         * @param int $$rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
         * @return Adapter 
         */
        public function liquidRescale($width, $height, $deltaX = 0, $rigidity = 0) {}
        /**
         * Crop an image to the given size
         *
         * @param int $width 
         * @param int $height 
         * @param int $offsetX 
         * @param int $offsetY 
         * @return Adapter 
         */
        public function crop($width, $height, $offsetX = null, $offsetY = null) {}
        /**
         * Rotate the image by a given amount
         *
         * @param int $degrees 
         * @return Adapter 
         */
        public function rotate($degrees) {}
        /**
         * Flip the image along the horizontal or vertical axis
         *
         * @param int $direction 
         * @return Adapter 
         */
        public function flip($direction) {}
        /**
         * Sharpen the image by a given amount
         *
         * @param int $amount 
         * @return Adapter 
         */
        public function sharpen($amount) {}
        /**
         * Add a reflection to an image
         *
         * @param int $height 
         * @param int $opacity 
         * @param bool $fadeIn 
         * @return Adapter 
         */
        public function reflection($height, $opacity = 100, $fadeIn = false) {}
        /**
         * Add a watermark to an image with the specified opacity
         *
         * @param mixed $watermark 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         * @return Adapter 
         */
        public function watermark(Adapter $watermark, $offsetX = 0, $offsetY = 0, $opacity = 100) {}
        /**
         * Add a text to an image with a specified opacity
         *
         * @param string $text 
         * @param mixed $offsetX 
         * @param mixed $offsetY 
         * @param int $opacity 
         * @param string $color 
         * @param int $size 
         * @param string $fontfile 
         * @return Adapter 
         */
        public function text($text, $offsetX = false, $offsetY = false, $opacity = 100, $color = "000000", $size = 12, $fontfile = null) {}
        /**
         * Composite one image onto another
         *
         * @param mixed $watermark 
         * @return Adapter 
         */
        public function mask(Adapter $watermark) {}
        /**
         * Set the background color of an image
         *
         * @param string $color 
         * @param int $opacity 
         * @return Adapter 
         */
        public function background($color, $opacity = 100) {}
        /**
         * Blur image
         *
         * @param int $radius 
         * @return Adapter 
         */
        public function blur($radius) {}
        /**
         * Pixelate image
         *
         * @param int $amount 
         * @return Adapter 
         */
        public function pixelate($amount) {}
        /**
         * Save the image
         *
         * @param string $file 
         * @param int $quality 
         * @return Adapter 
         */
        public function save($file = null, $quality = -1) {}
        /**
         * Render the image and return the binary string
         *
         * @param string $ext 
         * @param int $quality 
         * @return string 
         */
        public function render($ext = null, $quality = 100) {}
    }

    interface AdapterInterface
    {
        /**
         * @param int $width 
         * @param int $height 
         * @param int $master 
         */
        public function resize($width = null, $height = null, $master = Image::AUTO);
        /**
         * @param int $width 
         * @param int $height 
         * @param int $offsetX 
         * @param int $offsetY 
         */
        public function crop($width, $height, $offsetX = null, $offsetY = null);
        /**
         * @param int $degrees 
         */
        public function rotate($degrees);
        /**
         * @param int $direction 
         */
        public function flip($direction);
        /**
         * @param int $amount 
         */
        public function sharpen($amount);
        /**
         * @param int $height 
         * @param int $opacity 
         * @param bool $fadeIn 
         */
        public function reflection($height, $opacity = 100, $fadeIn = false);
        /**
         * @param mixed $watermark 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         */
        public function watermark(Adapter $watermark, $offsetX = 0, $offsetY = 0, $opacity = 100);
        /**
         * @param string $text 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         * @param string $color 
         * @param int $size 
         * @param string $fontfile 
         */
        public function text($text, $offsetX = 0, $offsetY = 0, $opacity = 100, $color = "000000", $size = 12, $fontfile = null);
        /**
         * @param mixed $watermark 
         */
        public function mask(Adapter $watermark);
        /**
         * @param string $color 
         * @param int $opacity 
         */
        public function background($color, $opacity = 100);
        /**
         * @param int $radius 
         */
        public function blur($radius);
        /**
         * @param int $amount 
         */
        public function pixelate($amount);
        /**
         * @param string $file 
         * @param int $quality 
         */
        public function save($file = null, $quality = 100);
        /**
         * @param string $ext 
         * @param int $quality 
         */
        public function render($ext = null, $quality = 100);
    }

    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Image\Adapter {
    class Gd extends \Phalcon\Image\Adapter implements \Phalcon\Image\AdapterInterface
    {
        static protected $_checked = false;
        /**
         * @return bool 
         */
        public static function check() {}
        /**
         * @param string $file 
         * @param int $width 
         * @param int $height 
         */
        public function __construct($file, $width = null, $height = null) {}
        /**
         * @param int $width 
         * @param int $height 
         */
        protected function _resize($width, $height) {}
        /**
         * @param int $width 
         * @param int $height 
         * @param int $offsetX 
         * @param int $offsetY 
         */
        protected function _crop($width, $height, $offsetX, $offsetY) {}
        /**
         * @param int $degrees 
         */
        protected function _rotate($degrees) {}
        /**
         * @param int $direction 
         */
        protected function _flip($direction) {}
        /**
         * @param int $amount 
         */
        protected function _sharpen($amount) {}
        /**
         * @param int $height 
         * @param int $opacity 
         * @param bool $fadeIn 
         */
        protected function _reflection($height, $opacity, $fadeIn) {}
        /**
         * @param mixed $watermark 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         */
        protected function _watermark(\Phalcon\Image\Adapter $watermark, $offsetX, $offsetY, $opacity) {}
        /**
         * @param string $text 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         * @param int $r 
         * @param int $g 
         * @param int $b 
         * @param int $size 
         * @param string $fontfile 
         */
        protected function _text($text, $offsetX, $offsetY, $opacity, $r, $g, $b, $size, $fontfile) {}
        /**
         * @param mixed $mask 
         */
        protected function _mask(\Phalcon\Image\Adapter $mask) {}
        /**
         * @param int $r 
         * @param int $g 
         * @param int $b 
         * @param int $opacity 
         */
        protected function _background($r, $g, $b, $opacity) {}
        /**
         * @param int $radius 
         */
        protected function _blur($radius) {}
        /**
         * @param int $amount 
         */
        protected function _pixelate($amount) {}
        /**
         * @param string $file 
         * @param int $quality 
         */
        protected function _save($file, $quality) {}
        /**
         * @param string $ext 
         * @param int $quality 
         */
        protected function _render($ext, $quality) {}
        /**
         * @param int $width 
         * @param int $height 
         */
        protected function _create($width, $height) {}
        public function __destruct() {}
    }

    /**
     * Phalcon\Image\Adapter\Imagick
     * Image manipulation support. Allows images to be resized, cropped, etc.
     * <code>
     * $image = new Phalcon\Image\Adapter\Imagick("upload/test.jpg");
     * $image->resize(200, 200)->rotate(90)->crop(100, 100);
     * if ($image->save()) {
     * echo 'success';
     * }
     * </code>
     */
    class Imagick extends \Phalcon\Image\Adapter implements \Phalcon\Image\AdapterInterface
    {
        static protected $_version = 0;
        static protected $_checked = false;
        /**
         * Checks if Imagick is enabled
         *
         * @return bool 
         */
        public static function check() {}
        /**
         * \Phalcon\Image\Adapter\Imagick constructor
         *
         * @param string $file 
         * @param int $width 
         * @param int $height 
         */
        public function __construct($file, $width = null, $height = null) {}
        /**
         * Execute a resize.
         *
         * @param int $width 
         * @param int $height 
         */
        protected function _resize($width, $height) {}
        /**
         * This method scales the images using liquid rescaling method. Only support Imagick
         *
         * @param int $width 
         * @param int $height 
         * @param int $deltaX 
         * @param int $rigidity 
         * @param int $$width new width
         * @param int $$height new height
         * @param int $$deltaX How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
         * @param int $$rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
         */
        protected function _liquidRescale($width, $height, $deltaX, $rigidity) {}
        /**
         * Execute a crop.
         *
         * @param int $width 
         * @param int $height 
         * @param int $offsetX 
         * @param int $offsetY 
         */
        protected function _crop($width, $height, $offsetX, $offsetY) {}
        /**
         * Execute a rotation.
         *
         * @param int $degrees 
         */
        protected function _rotate($degrees) {}
        /**
         * Execute a flip.
         *
         * @param int $direction 
         */
        protected function _flip($direction) {}
        /**
         * Execute a sharpen.
         *
         * @param int $amount 
         */
        protected function _sharpen($amount) {}
        /**
         * Execute a reflection.
         *
         * @param int $height 
         * @param int $opacity 
         * @param bool $fadeIn 
         */
        protected function _reflection($height, $opacity, $fadeIn) {}
        /**
         * Execute a watermarking.
         *
         * @param mixed $image 
         * @param int $offsetX 
         * @param int $offsetY 
         * @param int $opacity 
         */
        protected function _watermark(\Phalcon\Image\Adapter $image, $offsetX, $offsetY, $opacity) {}
        /**
         * Execute a text
         *
         * @param string $text 
         * @param mixed $offsetX 
         * @param mixed $offsetY 
         * @param int $opacity 
         * @param int $r 
         * @param int $g 
         * @param int $b 
         * @param int $size 
         * @param string $fontfile 
         */
        protected function _text($text, $offsetX, $offsetY, $opacity, $r, $g, $b, $size, $fontfile) {}
        /**
         * Composite one image onto another
         *
         * @param mixed $image 
         */
        protected function _mask(\Phalcon\Image\Adapter $image) {}
        /**
         * Execute a background.
         *
         * @param int $r 
         * @param int $g 
         * @param int $b 
         * @param int $opacity 
         */
        protected function _background($r, $g, $b, $opacity) {}
        /**
         * Blur image
         *
         * @param int $radius 
         * @param int $$radius Blur radius
         */
        protected function _blur($radius) {}
        /**
         * Pixelate image
         *
         * @param int $amount 
         * @param int $$amount amount to pixelate
         */
        protected function _pixelate($amount) {}
        /**
         * Execute a save.
         *
         * @param string $file 
         * @param int $quality 
         */
        protected function _save($file, $quality) {}
        /**
         * Execute a render.
         *
         * @param string $extension 
         * @param int $quality 
         * @return string 
         */
        protected function _render($extension, $quality) {}
        /**
         * Destroys the loaded image to free up resources.
         */
        public function __destruct() {}
        /**
         * Get instance
         *
         * @return \Imagick 
         */
        public function getInternalImInstance() {}
        /**
         * Sets the limit for a particular resource in megabytes
         *
         * @link http://php.net/manual/ru/imagick.constants.php#imagick.constants.resourcetypes
         * @param int $type 
         * @param int $limit 
         */
        public function setResourceLimit($type, $limit) {}
    }
}

namespace \Phalcon\Loader {
    /**
     * Phalcon\Loader\Exception
     * Exceptions thrown in Phalcon\Loader will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Logger {
    /**
     * Phalcon\Logger\Adapter
     * Base class for Phalcon\Logger adapters
     */
    abstract class Adapter
    {
        /**
         * Tells if there is an active transaction or not
         *
         * @var boolean
         */
        protected $_transaction = false;
        /**
         * Array with messages queued in the transaction
         *
         * @var array
         */
        protected $_queue = array();
        /**
         * Formatter
         *
         * @var object
         */
        protected $_formatter;
        /**
         * Log level
         *
         * @var int
         */
        protected $_logLevel = 9;
        /**
         * Filters the logs sent to the handlers that are less or equal than a specific level
         *
         * @param int $level 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function setLogLevel($level) {}
        /**
         * Returns the current log level
         *
         * @return int 
         */
        public function getLogLevel() {}
        /**
         * Sets the message formatter
         *
         * @param mixed $formatter 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter) {}
        /**
         * Starts a transaction
         *
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function begin() {}
        /**
         * Commits the internal transaction
         *
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function commit() {}
        /**
         * Rollbacks the internal transaction
         *
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function rollback() {}
        /**
         * Returns the whether the logger is currently in an active transaction or not
         *
         * @return bool 
         */
        public function isTransaction() {}
        /**
         * Sends/Writes a critical message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function critical($message, array $context = null) {}
        /**
         * Sends/Writes an emergency message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function emergency($message, array $context = null) {}
        /**
         * Sends/Writes a debug message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function debug($message, array $context = null) {}
        /**
         * Sends/Writes an error message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function error($message, array $context = null) {}
        /**
         * Sends/Writes an info message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function info($message, array $context = null) {}
        /**
         * Sends/Writes a notice message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function notice($message, array $context = null) {}
        /**
         * Sends/Writes a warning message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function warning($message, array $context = null) {}
        /**
         * Sends/Writes an alert message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function alert($message, array $context = null) {}
        /**
         * Logs messages to the internal logger. Appends logs to the logger
         *
         * @param mixed $type 
         * @param mixed $message 
         * @param array $context 
         * @return \Phalcon\Logger\AdapterInterface 
         */
        public function log($type, $message = null, array $context = null) {}
    }

    /**
     * Phalcon\Logger\AdapterInterface
     * Interface for Phalcon\Logger adapters
     */
    interface AdapterInterface
    {
        /**
         * Sets the message formatter
         *
         * @param mixed $formatter 
         * @return AdapterInterface 
         */
        public function setFormatter(FormatterInterface $formatter);
        /**
         * Returns the internal formatter
         *
         * @return FormatterInterface 
         */
        public function getFormatter();
        /**
         * Filters the logs sent to the handlers to be greater or equals than a specific level
         *
         * @param int $level 
         * @return AdapterInterface 
         */
        public function setLogLevel($level);
        /**
         * Returns the current log level
         *
         * @return int 
         */
        public function getLogLevel();
        /**
         * Sends/Writes messages to the file log
         *
         * @param mixed $type 
         * @param mixed $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function log($type, $message = null, array $context = null);
        /**
         * Starts a transaction
         *
         * @return AdapterInterface 
         */
        public function begin();
        /**
         * Commits the internal transaction
         *
         * @return AdapterInterface 
         */
        public function commit();
        /**
         * Rollbacks the internal transaction
         *
         * @return AdapterInterface 
         */
        public function rollback();
        /**
         * Closes the logger
         *
         * @return bool 
         */
        public function close();
        /**
         * Sends/Writes a debug message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function debug($message, array $context = null);
        /**
         * Sends/Writes an error message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function error($message, array $context = null);
        /**
         * Sends/Writes an info message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function info($message, array $context = null);
        /**
         * Sends/Writes a notice message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function notice($message, array $context = null);
        /**
         * Sends/Writes a warning message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function warning($message, array $context = null);
        /**
         * Sends/Writes an alert message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function alert($message, array $context = null);
        /**
         * Sends/Writes an emergency message to the log
         *
         * @param string $message 
         * @param array $context 
         * @return AdapterInterface 
         */
        public function emergency($message, array $context = null);
    }

    /**
     * Phalcon\Logger\Exception
     * Exceptions thrown in Phalcon\Logger will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Logger\Formatter
     * This is a base class for logger formatters
     */
    abstract class Formatter implements \Phalcon\Logger\FormatterInterface
    {
        /**
         * Returns the string meaning of a logger constant
         *
         * @param int $type 
         * @return string 
         */
        public function getTypeString($type) {}
        /**
         * Interpolates context values into the message placeholders
         *
         * @see http://www.php-fig.org/psr/psr-3/ Section 1.2 Message
         * @param string $message 
         * @param mixed $context 
         * @param string $$message 
         * @param array $$context 
         */
        public function interpolate($message, $context = null) {}
    }

    /**
     * Phalcon\Logger\FormatterInterface
     * This interface must be implemented by formatters in Phalcon\Logger
     */
    interface FormatterInterface
    {
        /**
         * Applies a format to a message before sent it to the internal log
         *
         * @param string $message 
         * @param int $type 
         * @param int $timestamp 
         * @param mixed $context 
         * @param array $$context 
         * @return string|array 
         */
        public function format($message, $type, $timestamp, $context = null);
    }

    /**
     * Phalcon\Logger\Item
     * Represents each item in a logging transaction
     */
    class Item
    {
        /**
         * Log type
         *
         * @var integer
         */
        protected $_type;
        /**
         * Log message
         *
         * @var string
         */
        protected $_message;
        /**
         * Log timestamp
         *
         * @var integer
         */
        protected $_time;
        protected $_context;
        /**
         * Log type
         *
         * @return integer 
         */
        public function getType() {}
        /**
         * Log message
         *
         * @return string 
         */
        public function getMessage() {}
        /**
         * Log timestamp
         *
         * @return integer 
         */
        public function getTime() {}
        public function getContext() {}
        /**
         * Phalcon\Logger\Item constructor
         *
         * @param string $message 
         * @param int $type 
         * @param int $time 
         * @param mixed $context 
         * @param string $$message 
         * @param integer $$type 
         * @param integer $$time 
         * @param array $$context 
         */
        public function __construct($message, $type, $time = 0, $context = null) {}
    }

    /**
     * Phalcon\Logger\Multiple
     * Handles multiples logger handlers
     */
    class Multiple
    {
        protected $_loggers;
        protected $_formatter;
        protected $_logLevel;
        public function getLoggers() {}
        public function getFormatter() {}
        public function getLogLevel() {}
        /**
         * Pushes a logger to the logger tail
         *
         * @param mixed $logger 
         */
        public function push(\Phalcon\Logger\AdapterInterface $logger) {}
        /**
         * Sets a global formatter
         *
         * @param mixed $formatter 
         */
        public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter) {}
        /**
         * Sets a global level
         *
         * @param int $level 
         */
        public function setLogLevel($level) {}
        /**
         * Sends a message to each registered logger
         *
         * @param mixed $type 
         * @param mixed $message 
         * @param array $context 
         */
        public function log($type, $message = null, array $context = null) {}
        /**
         * Sends/Writes an critical message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function critical($message, array $context = null) {}
        /**
         * Sends/Writes an emergency message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function emergency($message, array $context = null) {}
        /**
         * Sends/Writes a debug message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function debug($message, array $context = null) {}
        /**
         * Sends/Writes an error message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function error($message, array $context = null) {}
        /**
         * Sends/Writes an info message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function info($message, array $context = null) {}
        /**
         * Sends/Writes a notice message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function notice($message, array $context = null) {}
        /**
         * Sends/Writes a warning message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function warning($message, array $context = null) {}
        /**
         * Sends/Writes an alert message to the log
         *
         * @param string $message 
         * @param array $context 
         */
        public function alert($message, array $context = null) {}
    }
}

namespace \Phalcon\Logger\Adapter {
    /**
     * Phalcon\Logger\Adapter\File
     * Adapter to store logs in plain text files
     * <code>
     * $logger = new \Phalcon\Logger\Adapter\File("app/logs/test.log");
     * $logger->log("This is a message");
     * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
     * $logger->error("This is another error");
     * $logger->close();
     * </code>
     */
    class File extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
    {
        /**
         * File handler resource
         *
         * @var resource
         */
        protected $_fileHandler;
        /**
         * File Path
         */
        protected $_path;
        /**
         * Path options
         */
        protected $_options;
        /**
         * File Path
         */
        public function getPath() {}
        /**
         * Phalcon\Logger\Adapter\File constructor
         *
         * @param string $name 
         * @param array $options 
         */
        public function __construct($name, $options = null) {}
        /**
         * Returns the internal formatter
         *
         * @return \Phalcon\Logger\FormatterInterface 
         */
        public function getFormatter() {}
        /**
         * Writes the log to the file itself
         *
         * @param string $message 
         * @param int $type 
         * @param int $time 
         * @param array $context 
         */
        public function logInternal($message, $type, $time, array $context) {}
        /**
         * Closes the logger
         *
         * @return bool 
         */
        public function close() {}
        /**
         * Opens the internal file handler after unserialization
         */
        public function __wakeup() {}
    }

    /**
     * Phalcon\Logger\Adapter\Firephp
     * Sends logs to FirePHP
     * <code>
     * use Phalcon\Logger\Adapter\Firephp;
     * use Phalcon\Logger;
     * $logger = new Firephp();
     * $logger->log(Logger::ERROR, 'This is an error');
     * $logger->error('This is another error');
     * </code>
     */
    class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
    {
        private $_initialized = false;
        private $_index = 1;
        /**
         * Returns the internal formatter
         *
         * @return \Phalcon\Logger\FormatterInterface 
         */
        public function getFormatter() {}
        /**
         * Writes the log to the stream itself
         *
         * @param string $message 
         * @param int $type 
         * @param int $time 
         * @param array $context 
         */
        public function logInternal($message, $type, $time, array $context) {}
        /**
         * Closes the logger
         *
         * @return bool 
         */
        public function close() {}
    }

    /**
     * Phalcon\Logger\Adapter\Stream
     * Sends logs to a valid PHP stream
     * <code>
     * $logger = new \Phalcon\Logger\Adapter\Stream("php://stderr");
     * $logger->log("This is a message");
     * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
     * $logger->error("This is another error");
     * </code>
     */
    class Stream extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
    {
        /**
         * File handler resource
         *
         * @var resource
         */
        protected $_stream;
        /**
         * Phalcon\Logger\Adapter\Stream constructor
         *
         * @param string $name 
         * @param array $options 
         */
        public function __construct($name, $options = null) {}
        /**
         * Returns the internal formatter
         *
         * @return \Phalcon\Logger\FormatterInterface 
         */
        public function getFormatter() {}
        /**
         * Writes the log to the stream itself
         *
         * @param string $message 
         * @param int $type 
         * @param int $time 
         * @param array $context 
         */
        public function logInternal($message, $type, $time, array $context) {}
        /**
         * Closes the logger
         *
         * @return bool 
         */
        public function close() {}
    }

    /**
     * Phalcon\Logger\Adapter\Syslog
     * Sends logs to the system logger
     * <code>
     * $logger = new \Phalcon\Logger\Adapter\Syslog("ident", array(
     * 'option' => LOG_NDELAY,
     * 'facility' => LOG_MAIL
     * ));
     * $logger->log("This is a message");
     * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
     * $logger->error("This is another error");
     * </code>
     */
    class Syslog extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
    {
        protected $_opened = false;
        /**
         * Phalcon\Logger\Adapter\Syslog constructor
         *
         * @param string $name 
         * @param array $options 
         */
        public function __construct($name, $options = null) {}
        /**
         * Returns the internal formatter
         *
         * @return \Phalcon\Logger\Formatter\Syslog 
         */
        public function getFormatter() {}
        /**
         * Writes the log to the stream itself
         *
         * @param string $message 
         * @param int $type 
         * @param int $time 
         * @param array $context 
         * @param array $$context 
         */
        public function logInternal($message, $type, $time, array $context) {}
        /**
         * Closes the logger
         *
         * @return bool 
         */
        public function close() {}
    }
}

namespace \Phalcon\Logger\Formatter {
    /**
     * Phalcon\Logger\Formatter\Firephp
     * Formats messages so that they can be sent to FirePHP
     */
    class Firephp extends \Phalcon\Logger\Formatter
    {
        protected $_showBacktrace = true;
        protected $_enableLabels = true;
        /**
         * Returns the string meaning of a logger constant
         *
         * @param int $type 
         * @return string 
         */
        public function getTypeString($type) {}
        /**
         * Returns the string meaning of a logger constant
         *
         * @param bool $isShow 
         * @return Firephp 
         */
        public function setShowBacktrace($isShow = null) {}
        /**
         * Returns the string meaning of a logger constant
         *
         * @return bool 
         */
        public function getShowBacktrace() {}
        /**
         * Returns the string meaning of a logger constant
         *
         * @param bool $isEnable 
         * @return Firephp 
         */
        public function enableLabels($isEnable = null) {}
        /**
         * Returns the labels enabled
         *
         * @return bool 
         */
        public function labelsEnabled() {}
        /**
         * Applies a format to a message before sending it to the log
         *
         * @param string $message 
         * @param int $type 
         * @param int $timestamp 
         * @param mixed $context 
         * @param string $$message 
         * @param int $$type 
         * @param int $$timestamp 
         * @param array $$context 
         * @return string 
         */
        public function format($message, $type, $timestamp, $context = null) {}
    }

    /**
     * Phalcon\Logger\Formatter\Json
     * Formats messages using JSON encoding
     */
    class Json extends \Phalcon\Logger\Formatter
    {
        /**
         * Applies a format to a message before sent it to the internal log
         *
         * @param string $message 
         * @param int $type 
         * @param int $timestamp 
         * @param mixed $context 
         * @param array $$context 
         * @return string 
         */
        public function format($message, $type, $timestamp, $context = null) {}
    }

    /**
     * Phalcon\Logger\Formatter\Line
     * Formats messages using an one-line string
     */
    class Line extends \Phalcon\Logger\Formatter
    {
        /**
         * Default date format
         *
         * @var string
         */
        protected $_dateFormat = "D, d M y H:i:s O";
        /**
         * Format applied to each message
         *
         * @var string
         */
        protected $_format = "[%date%][%type%] %message%";
        /**
         * Default date format
         *
         * @return string 
         */
        public function getDateFormat() {}
        /**
         * Default date format
         *
         * @param string $dateFormat 
         */
        public function setDateFormat($dateFormat) {}
        /**
         * Format applied to each message
         *
         * @return string 
         */
        public function getFormat() {}
        /**
         * Format applied to each message
         *
         * @param string $format 
         */
        public function setFormat($format) {}
        /**
         * Phalcon\Logger\Formatter\Line construct
         *
         * @param string $format 
         * @param string $dateFormat 
         */
        public function __construct($format = null, $dateFormat = null) {}
        /**
         * Applies a format to a message before sent it to the internal log
         *
         * @param string $message 
         * @param int $type 
         * @param int $timestamp 
         * @param mixed $context 
         * @param array $$context 
         * @return string 
         */
        public function format($message, $type, $timestamp, $context = null) {}
    }

    /**
     * Phalcon\Logger\Formatter\Syslog
     * Prepares a message to be used in a Syslog backend
     */
    class Syslog extends \Phalcon\Logger\Formatter
    {
        /**
         * Applies a format to a message before sent it to the internal log
         *
         * @param string $message 
         * @param int $type 
         * @param int $timestamp 
         * @param mixed $context 
         * @param array $$context 
         * @return array 
         */
        public function format($message, $type, $timestamp, $context = null) {}
    }
}

namespace \Phalcon\Mvc {
    /**
     * Phalcon\Mvc\Application
     * This component encapsulates all the complex operations behind instantiating every component
     * needed and integrating it with the rest to allow the MVC pattern to operate as desired.
     * <code>
     * use Phalcon\Mvc\Application;
     * class MyApp extends Application
     * {
     * /
     * Register the services here to make them general or register
     * in the ModuleDefinition to make them module-specific
     * \/
     * protected function registerServices()
     * {
     * }
     * /
     * This method registers all the modules in the application
     * \/
     * public function main()
     * {
     * $this->registerModules(array(
     * 'frontend' => array(
     * 'className' => 'Multiple\Frontend\Module',
     * 'path' => '../apps/frontend/Module.php'
     * ),
     * 'backend' => array(
     * 'className' => 'Multiple\Backend\Module',
     * 'path' => '../apps/backend/Module.php'
     * )
     * ));
     * }
     * }
     * $application = new MyApp();
     * $application->main();
     * </code>
     */
    class Application extends \Phalcon\Application
    {
        protected $_implicitView = true;
        /**
         * By default. The view is implicitly buffering all the output
         * You can full disable the view component using this method
         *
         * @param bool $implicitView 
         * @return Application 
         */
        public function useImplicitView($implicitView) {}
        /**
         * Handles a MVC request
         *
         * @param string $uri 
         * @return bool|\Phalcon\Http\ResponseInterface 
         */
        public function handle($uri = null) {}
    }

    /**
     * Phalcon\Mvc\Collection
     * This component implements a high level abstraction for NoSQL databases which
     * works with documents
     */
    abstract class Collection implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\CollectionInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable
    {
        const OP_NONE = 0;
        const OP_CREATE = 1;
        const OP_UPDATE = 2;
        const OP_DELETE = 3;
        protected $_id;
        protected $_dependencyInjector;
        protected $_modelsManager;
        protected $_source;
        protected $_operationMade = 0;
        protected $_connection;
        protected $_errorMessages = array();
        static protected $_reserved;
        static protected $_disableEvents;
        protected $_skipped = false;
        /**
         * Phalcon\Mvc\Collection constructor
         *
         * @param mixed $dependencyInjector 
         * @param mixed $modelsManager 
         */
        public final function __construct(\Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Mvc\Collection\ManagerInterface $modelsManager = null) {}
        /**
         * Sets a value for the _id property, creates a MongoId object if needed
         *
         * @param mixed $id 
         */
        public function setId($id) {}
        /**
         * Returns the value of the _id property
         *
         * @return \MongoId 
         */
        public function getId() {}
        /**
         * Sets the dependency injection container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the dependency injection container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets a custom events manager
         *
         * @param mixed $eventsManager 
         */
        protected function setEventsManager(\Phalcon\Mvc\Collection\ManagerInterface $eventsManager) {}
        /**
         * Returns the custom events manager
         *
         * @return \Phalcon\Mvc\Collection\ManagerInterface 
         */
        protected function getEventsManager() {}
        /**
         * Returns the models manager related to the entity instance
         *
         * @return \Phalcon\Mvc\Collection\ManagerInterface 
         */
        public function getCollectionManager() {}
        /**
         * Returns an array with reserved properties that cannot be part of the insert/update
         *
         * @return array 
         */
        public function getReservedAttributes() {}
        /**
         * Sets if a model must use implicit objects ids
         *
         * @param bool $useImplicitObjectIds 
         */
        protected function useImplicitObjectIds($useImplicitObjectIds) {}
        /**
         * Sets collection name which model should be mapped
         *
         * @param string $source 
         * @return Collection 
         */
        protected function setSource($source) {}
        /**
         * Returns collection name mapped in the model
         *
         * @return string 
         */
        public function getSource() {}
        /**
         * Sets the DependencyInjection connection service name
         *
         * @param string $connectionService 
         * @return Collection 
         */
        public function setConnectionService($connectionService) {}
        /**
         * Returns DependencyInjection connection service
         *
         * @return string 
         */
        public function getConnectionService() {}
        /**
         * Retrieves a database connection
         *
         * @return \MongoDb 
         */
        public function getConnection() {}
        /**
         * Reads an attribute value by its name
         * <code>
         * echo $robot->readAttribute('name');
         * </code>
         *
         * @param string $attribute 
         * @return mixed 
         */
        public function readAttribute($attribute) {}
        /**
         * Writes an attribute value by its name
         * <code>
         * $robot->writeAttribute('name', 'Rosey');
         * </code>
         *
         * @param string $attribute 
         * @param mixed $value 
         */
        public function writeAttribute($attribute, $value) {}
        /**
         * Returns a cloned collection
         *
         * @param mixed $collection 
         * @param array $document 
         * @return CollectionInterface 
         */
        public static function cloneResult(CollectionInterface $collection, array $document) {}
        /**
         * Returns a collection resultset
         *
         * @param array $params 
         * @param \Phalcon\Mvc\Collection $collection 
         * @param \MongoDb $connection 
         * @param boolean $unique 
         * @return array 
         */
        protected static function _getResultset($params, CollectionInterface $collection, $connection, $unique) {}
        /**
         * Perform a count over a resultset
         *
         * @param array $params 
         * @param \Phalcon\Mvc\Collection $collection 
         * @param \MongoDb $connection 
         * @return int 
         */
        protected static function _getGroupResultset($params, Collection $collection, $connection) {}
        /**
         * Executes internal hooks before save a document
         *
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @param boolean $disableEvents 
         * @param boolean $exists 
         * @return boolean 
         */
        protected final function _preSave($dependencyInjector, $disableEvents, $exists) {}
        /**
         * Executes internal events after save a document
         *
         * @param bool $disableEvents 
         * @param bool $success 
         * @param bool $exists 
         * @return bool 
         */
        protected final function _postSave($disableEvents, $success, $exists) {}
        /**
         * Executes validators on every validation call
         * <code>
         * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
         * class Subscriptors extends \Phalcon\Mvc\Collection
         * {
         * public function validation()
         * {
         * this->validate(new ExclusionIn(array(
         * 'field' => 'status',
         * 'domain' => array('A', 'I')
         * )));
         * if (this->validationHasFailed() == true) {
         * return false;
         * }
         * }
         * }
         * </code>
         *
         * @param mixed $validator 
         */
        protected function validate(Model\ValidatorInterface $validator) {}
        /**
         * Check whether validation process has generated any messages
         * <code>
         * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
         * class Subscriptors extends \Phalcon\Mvc\Collection
         * {
         * public function validation()
         * {
         * this->validate(new ExclusionIn(array(
         * 'field' => 'status',
         * 'domain' => array('A', 'I')
         * )));
         * if (this->validationHasFailed() == true) {
         * return false;
         * }
         * }
         * }
         * </code>
         *
         * @return bool 
         */
        public function validationHasFailed() {}
        /**
         * Fires an internal event
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEvent($eventName) {}
        /**
         * Fires an internal event that cancels the operation
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEventCancel($eventName) {}
        /**
         * Cancel the current operation
         *
         * @param bool $disableEvents 
         * @return bool 
         */
        protected function _cancelOperation($disableEvents) {}
        /**
         * Checks if the document exists in the collection
         *
         * @param \MongoCollection $collection 
         * @return boolean 
         */
        protected function _exists($collection) {}
        /**
         * Returns all the validation messages
         * <code>
         * $robot = new Robots();
         * $robot->type = 'mechanical';
         * $robot->name = 'Astro Boy';
         * $robot->year = 1952;
         * if ($robot->save() == false) {
         * echo "Umh, We can't store robots right now ";
         * foreach ($robot->getMessages() as message) {
         * echo message;
         * }
         * } else {
         * echo "Great, a new robot was saved successfully!";
         * }
         * </code>
         *
         * @return MessageInterface[] 
         */
        public function getMessages() {}
        /**
         * Appends a customized message on the validation process
         * <code>
         * use \Phalcon\Mvc\Model\Message as Message;
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function beforeSave()
         * {
         * if ($this->name == 'Peter') {
         * message = new Message("Sorry, but a robot cannot be named Peter");
         * $this->appendMessage(message);
         * }
         * }
         * }
         * </code>
         *
         * @param mixed $message 
         */
        public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message) {}
        /**
         * Shared Code for CU Operations
         * Prepares Collection
         */
        protected function prepareCU() {}
        /**
         * Creates/Updates a collection based on the values in the attributes
         *
         * @return bool 
         */
        public function save() {}
        /**
         * Creates a collection based on the values in the attributes
         *
         * @return bool 
         */
        public function create() {}
        /**
         * Creates a document based on the values in the attributes, if not found by criteria
         * Preferred way to avoid duplication is to create index on attribute
         * $robot = new Robot();
         * $robot->name = "MyRobot";
         * $robot->type = "Droid";
         * //create only if robot with same name and type does not exist
         * $robot->createIfNotExist( array( "name", "type" ) );
         *
         * @param array $criteria 
         * @return bool 
         */
        public function createIfNotExist(array $criteria) {}
        /**
         * Creates/Updates a collection based on the values in the attributes
         *
         * @return bool 
         */
        public function update() {}
        /**
         * Find a document by its id (_id)
         * <code>
         * // Find user by using \MongoId object
         * $user = Users::findById(new \MongoId('545eb081631d16153a293a66'));
         * // Find user by using id as sting
         * $user = Users::findById('45cbc4a0e4123f6920000002');
         * // Validate input
         * if ($user = Users::findById($_POST['id'])) {
         * // ...
         * }
         * </code>
         *
         * @param mixed $id 
         * @return null|Collection 
         */
        public static function findById($id) {}
        /**
         * Allows to query the first record that match the specified conditions
         * <code>
         * // What's the first robot in the robots table?
         * $robot = Robots::findFirst();
         * echo 'The robot name is ', $robot->name, "\n";
         * // What's the first mechanical robot in robots table?
         * $robot = Robots::findFirst([
         * ['type' => 'mechanical']
         * ]);
         * echo 'The first mechanical robot name is ', $robot->name, "\n";
         * // Get first virtual robot ordered by name
         * $robot = Robots::findFirst([
         * ['type' => 'mechanical'],
         * 'order' => ['name' => 1]
         * ]);
         * echo 'The first virtual robot name is ', $robot->name, "\n";
         * // Get first robot by id (_id)
         * $robot = Robots::findFirst([
         * ['_id' => new \MongoId('45cbc4a0e4123f6920000002')]
         * ]);
         * echo 'The robot id is ', $robot->_id, "\n";
         * </code>
         *
         * @param array $parameters 
         * @return array 
         */
        public static function findFirst(array $parameters = null) {}
        /**
         * Allows to query a set of records that match the specified conditions
         * <code>
         * //How many robots are there?
         * $robots = Robots::find();
         * echo "There are ", count($robots), "\n";
         * //How many mechanical robots are there?
         * $robots = Robots::find(array(
         * array("type" => "mechanical")
         * ));
         * echo "There are ", count(robots), "\n";
         * //Get and print virtual robots ordered by name
         * $robots = Robots::findFirst(array(
         * array("type" => "virtual"),
         * "order" => array("name" => 1)
         * ));
         * foreach ($robots as $robot) {
         * echo $robot->name, "\n";
         * }
         * //Get first 100 virtual robots ordered by name
         * $robots = Robots::find(array(
         * array("type" => "virtual"),
         * "order" => array("name" => 1),
         * "limit" => 100
         * ));
         * foreach ($robots as $robot) {
         * echo $robot->name, "\n";
         * }
         * </code>
         *
         * @param array $parameters 
         * @return array 
         */
        public static function find(array $parameters = null) {}
        /**
         * Perform a count over a collection
         * <code>
         * echo 'There are ', Robots::count(), ' robots';
         * </code>
         *
         * @param array $parameters 
         * @return array 
         */
        public static function count(array $parameters = null) {}
        /**
         * Perform an aggregation using the Mongo aggregation framework
         *
         * @param array $parameters 
         * @return array 
         */
        public static function aggregate(array $parameters = null) {}
        /**
         * Allows to perform a summatory group for a column in the collection
         *
         * @param string $field 
         * @param mixed $conditions 
         * @param mixed $finalize 
         * @return array 
         */
        public static function summatory($field, $conditions = null, $finalize = null) {}
        /**
         * Deletes a model instance. Returning true on success or false otherwise.
         * <code>
         * $robot = Robots::findFirst();
         * $robot->delete();
         * foreach (Robots::find() as $robot) {
         * $robot->delete();
         * }
         * </code>
         *
         * @return bool 
         */
        public function delete() {}
        /**
         * Sets up a behavior in a collection
         *
         * @param mixed $behavior 
         */
        protected function addBehavior(\Phalcon\Mvc\Collection\BehaviorInterface $behavior) {}
        /**
         * Skips the current operation forcing a success state
         *
         * @param bool $skip 
         */
        public function skipOperation($skip) {}
        /**
         * Returns the instance as an array representation
         * <code>
         * print_r($robot->toArray());
         * </code>
         *
         * @return array 
         */
        public function toArray() {}
        /**
         * Serializes the object ignoring connections or protected properties
         *
         * @return string 
         */
        public function serialize() {}
        /**
         * Unserializes the object from a serialized string
         *
         * @param string $data 
         */
        public function unserialize($data) {}
    }

    /**
     * Phalcon\Mvc\CollectionInterface
     * Interface for Phalcon\Mvc\Collection
     */
    interface CollectionInterface
    {
        /**
         * Sets a value for the _id property, creates a MongoId object if needed
         *
         * @param mixed $id 
         */
        public function setId($id);
        /**
         * Returns the value of the _id property
         *
         * @return MongoId 
         */
        public function getId();
        /**
         * Returns an array with reserved properties that cannot be part of the insert/update
         *
         * @return array 
         */
        public function getReservedAttributes();
        /**
         * Returns collection name mapped in the model
         *
         * @return string 
         */
        public function getSource();
        /**
         * Sets a service in the services container that returns the Mongo database
         *
         * @param string $connectionService 
         */
        public function setConnectionService($connectionService);
        /**
         * Retrieves a database connection
         *
         * @return MongoDb 
         */
        public function getConnection();
        /**
         * Returns a cloned collection
         *
         * @param mixed $collection 
         * @param array $document 
         * @return CollectionInterface 
         */
        public static function cloneResult(CollectionInterface $collection, array $document);
        /**
         * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEvent($eventName);
        /**
         * Fires an event, implicitly listeners in the events manager are notified
         * This method stops if one of the callbacks/listeners returns boolean false
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEventCancel($eventName);
        /**
         * Check whether validation process has generated any messages
         *
         * @return bool 
         */
        public function validationHasFailed();
        /**
         * Returns all the validation messages
         *
         * @return MessageInterface[] 
         */
        public function getMessages();
        /**
         * Appends a customized message on the validation process
         *
         * @param mixed $message 
         */
        public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message);
        /**
         * Creates/Updates a collection based on the values in the attributes
         *
         * @return bool 
         */
        public function save();
        /**
         * Find a document by its id
         *
         * @param string $id 
         * @return \Phalcon\Mvc\Collection 
         */
        public static function findById($id);
        /**
         * Allows to query the first record that match the specified conditions
         *
         * @param array $parameters 
         * @return array 
         */
        public static function findFirst(array $parameters = null);
        /**
         * Allows to query a set of records that match the specified conditions
         *
         * @param array $parameters 
         * @param  $array parameters
         * @return array 
         */
        public static function find(array $parameters = null);
        /**
         * Perform a count over a collection
         *
         * @param array $parameters 
         * @return array 
         */
        public static function count(array $parameters = null);
        /**
         * Deletes a model instance. Returning true on success or false otherwise
         *
         * @return bool 
         */
        public function delete();
    }

    /**
     * Phalcon\Mvc\Controller
     * Every application controller should extend this class that encapsulates all the controller functionality
     * The controllers provide the “flow” between models and views. Controllers are responsible
     * for processing the incoming requests from the web browser, interrogating the models for data,
     * and passing that data on to the views for presentation.
     * <code>
     * <?php
     * class PeopleController extends \Phalcon\Mvc\Controller
     * {
     * //This action will be executed by default
     * public function indexAction()
     * {
     * }
     * public function findAction()
     * {
     * }
     * public function saveAction()
     * {
     * //Forwards flow to the index action
     * return $this->dispatcher->forward(array('controller' => 'people', 'action' => 'index'));
     * }
     * }
     * </code>
     */
    abstract class Controller extends \Phalcon\Di\Injectable implements \Phalcon\Mvc\ControllerInterface
    {
        /**
         * Phalcon\Mvc\Controller constructor
         */
        public final function __construct() {}
    }

    /**
     * Phalcon\Mvc\ControllerInterface
     * Interface for controller handlers
     */
    interface ControllerInterface
    {
    }

    /**
     * Phalcon\Mvc\Dispatcher
     * Dispatching is the process of taking the request object, extracting the module name,
     * controller name, action name, and optional parameters contained in it, and then
     * instantiating a controller and calling an action of that controller.
     * <code>
     * $di = new \Phalcon\Di();
     * $dispatcher = new \Phalcon\Mvc\Dispatcher();
     * $dispatcher->setDI($di);
     * $dispatcher->setControllerName('posts');
     * $dispatcher->setActionName('index');
     * $dispatcher->setParams(array());
     * $controller = $dispatcher->dispatch();
     * </code>
     */
    class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Mvc\DispatcherInterface
    {
        protected $_handlerSuffix = "Controller";
        protected $_defaultHandler = "index";
        protected $_defaultAction = "index";
        /**
         * Sets the default controller suffix
         *
         * @param string $controllerSuffix 
         */
        public function setControllerSuffix($controllerSuffix) {}
        /**
         * Sets the default controller name
         *
         * @param string $controllerName 
         */
        public function setDefaultController($controllerName) {}
        /**
         * Sets the controller name to be dispatched
         *
         * @param string $controllerName 
         */
        public function setControllerName($controllerName) {}
        /**
         * Gets last dispatched controller name
         *
         * @return string 
         */
        public function getControllerName() {}
        /**
         * Gets previous dispatched namespace name
         *
         * @return string 
         */
        public function getPreviousNamespaceName() {}
        /**
         * Gets previous dispatched controller name
         *
         * @return string 
         */
        public function getPreviousControllerName() {}
        /**
         * Gets previous dispatched action name
         *
         * @return string 
         */
        public function getPreviousActionName() {}
        /**
         * Throws an internal exception
         *
         * @param string $message 
         * @param int $exceptionCode 
         */
        protected function _throwDispatchException($message, $exceptionCode = 0) {}
        /**
         * Handles a user exception
         *
         * @param mixed $exception 
         */
        protected function _handleException(\Exception $exception) {}
        /**
         * Possible controller class name that will be located to dispatch the request
         *
         * @return string 
         */
        public function getControllerClass() {}
        /**
         * Returns the latest dispatched controller
         *
         * @return \Phalcon\Mvc\ControllerInterface 
         */
        public function getLastController() {}
        /**
         * Returns the active controller in the dispatcher
         *
         * @return \Phalcon\Mvc\ControllerInterface 
         */
        public function getActiveController() {}
    }

    /**
     * Phalcon\Mvc\DispatcherInterface
     * Interface for Phalcon\Mvc\Dispatcher
     */
    interface DispatcherInterface extends \Phalcon\DispatcherInterface
    {
        /**
         * Sets the default controller suffix
         *
         * @param string $controllerSuffix 
         */
        public function setControllerSuffix($controllerSuffix);
        /**
         * Sets the default controller name
         *
         * @param string $controllerName 
         */
        public function setDefaultController($controllerName);
        /**
         * Sets the controller name to be dispatched
         *
         * @param string $controllerName 
         */
        public function setControllerName($controllerName);
        /**
         * Gets last dispatched controller name
         *
         * @return string 
         */
        public function getControllerName();
        /**
         * Returns the latest dispatched controller
         *
         * @return \Phalcon\Mvc\ControllerInterface 
         */
        public function getLastController();
        /**
         * Returns the active controller in the dispatcher
         *
         * @return \Phalcon\Mvc\ControllerInterface 
         */
        public function getActiveController();
    }

    /**
     * Phalcon\Mvc\EntityInterface
     * Interface for Phalcon\Mvc\Collection and Phalcon\Mvc\Model
     */
    interface EntityInterface
    {
        /**
         * Reads an attribute value by its name
         *
         * @param string $attribute 
         * @return mixed 
         */
        public function readAttribute($attribute);
        /**
         * Writes an attribute value by its name
         *
         * @param string $attribute 
         * @param mixed $value 
         */
        public function writeAttribute($attribute, $value);
    }

    /**
     * Phalcon\Mvc\Micro
     * With Phalcon you can create "Micro-Framework like" applications. By doing this, you only need to
     * write a minimal amount of code to create a PHP application. Micro applications are suitable
     * to small applications, APIs and prototypes in a practical way.
     * <code>
     * $app = new \Phalcon\Mvc\Micro();
     * $app->get('/say/welcome/{name}', function ($name) {
     * echo "<h1>Welcome $name!</h1>";
     * });
     * $app->handle();
     * </code>
     */
    class Micro extends \Phalcon\Di\Injectable implements \ArrayAccess
    {
        protected $_dependencyInjector;
        protected $_handlers;
        protected $_router;
        protected $_stopped;
        protected $_notFoundHandler;
        protected $_errorHandler;
        protected $_activeHandler;
        protected $_beforeHandlers;
        protected $_afterHandlers;
        protected $_finishHandlers;
        protected $_returnedValue;
        /**
         * Phalcon\Mvc\Micro constructor
         *
         * @param mixed $dependencyInjector 
         */
        public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Maps a route to a handler without any HTTP method constraint
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function map($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is GET
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function get($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is POST
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function post($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is PUT
         *
         * @param string $routePattern 
         * @param mixed $handler 
         * @param string $$routePattern 
         * @param callable $$handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function put($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is PATCH
         *
         * @param string $routePattern 
         * @param mixed $handler 
         * @param string $$routePattern 
         * @param callable $$handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function patch($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is HEAD
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function head($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is DELETE
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function delete($routePattern, $handler) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is OPTIONS
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function options($routePattern, $handler) {}
        /**
         * Mounts a collection of handlers
         *
         * @param mixed $collection 
         * @return Micro 
         */
        public function mount(\Phalcon\Mvc\Micro\CollectionInterface $collection) {}
        /**
         * Sets a handler that will be called when the router doesn't match any of the defined routes
         *
         * @param callable $handler 
         * @return \Phalcon\Mvc\Micro 
         */
        public function notFound($handler) {}
        /**
         * Sets a handler that will be called when an exception is thrown handling the route
         *
         * @param callable $handler 
         * @return \Phalcon\Mvc\Micro 
         */
        public function error($handler) {}
        /**
         * Returns the internal router used by the application
         *
         * @return RouterInterface 
         */
        public function getRouter() {}
        /**
         * Sets a service from the DI
         *
         * @param string $serviceName 
         * @param mixed $definition 
         * @param boolean $shared 
         * @return \Phalcon\Di\ServiceInterface 
         */
        public function setService($serviceName, $definition, $shared = false) {}
        /**
         * Checks if a service is registered in the DI
         *
         * @param string $serviceName 
         * @return bool 
         */
        public function hasService($serviceName) {}
        /**
         * Obtains a service from the DI
         *
         * @param string $serviceName 
         * @return object 
         */
        public function getService($serviceName) {}
        /**
         * Obtains a shared service from the DI
         *
         * @param string $serviceName 
         * @return mixed 
         */
        public function getSharedService($serviceName) {}
        /**
         * Handle the whole request
         *
         * @param string $uri 
         * @return mixed 
         */
        public function handle($uri = null) {}
        /**
         * Stops the middleware execution avoiding than other middlewares be executed
         */
        public function stop() {}
        /**
         * Sets externally the handler that must be called by the matched route
         *
         * @param callable $activeHandler 
         */
        public function setActiveHandler($activeHandler) {}
        /**
         * Return the handler that will be called for the matched route
         *
         * @return callable 
         */
        public function getActiveHandler() {}
        /**
         * Returns the value returned by the executed handler
         *
         * @return mixed 
         */
        public function getReturnedValue() {}
        /**
         * Check if a service is registered in the internal services container using the array syntax
         *
         * @param string $alias 
         * @return boolean 
         */
        public function offsetExists($alias) {}
        /**
         * Allows to register a shared service in the internal services container using the array syntax
         * <code>
         * $app['request'] = new \Phalcon\Http\Request();
         * </code>
         *
         * @param string $alias 
         * @param mixed $definition 
         */
        public function offsetSet($alias, $definition) {}
        /**
         * Allows to obtain a shared service in the internal services container using the array syntax
         * <code>
         * var_dump($di['request']);
         * </code>
         *
         * @param string $alias 
         * @return mixed 
         */
        public function offsetGet($alias) {}
        /**
         * Removes a service from the internal services container using the array syntax
         *
         * @param string $alias 
         */
        public function offsetUnset($alias) {}
        /**
         * Appends a before middleware to be called before execute the route
         *
         * @param callable $handler 
         * @return \Phalcon\Mvc\Micro 
         */
        public function before($handler) {}
        /**
         * Appends an 'after' middleware to be called after execute the route
         *
         * @param callable $handler 
         * @return \Phalcon\Mvc\Micro 
         */
        public function after($handler) {}
        /**
         * Appends a 'finish' middleware to be called when the request is finished
         *
         * @param callable $handler 
         * @return \Phalcon\Mvc\Micro 
         */
        public function finish($handler) {}
        /**
         * Returns the internal handlers attached to the application
         *
         * @return array 
         */
        public function getHandlers() {}
    }

    /**
     * Phalcon\Mvc\Model
     * Phalcon\Mvc\Model connects business objects and database tables to create
     * a persistable domain model where logic and data are presented in one wrapping.
     * It‘s an implementation of the object-relational mapping (ORM).
     * A model represents the information (data) of the application and the rules to manipulate that data.
     * Models are primarily used for managing the rules of interaction with a corresponding database table.
     * In most cases, each table in your database will correspond to one model in your application.
     * The bulk of your application's business logic will be concentrated in the models.
     * Phalcon\Mvc\Model is the first ORM written in Zephir/C languages for PHP, giving to developers high performance
     * when interacting with databases while is also easy to use.
     * <code>
     * $robot = new Robots();
     * $robot->type = 'mechanical';
     * $robot->name = 'Astro Boy';
     * $robot->year = 1952;
     * if ($robot->save() == false) {
     * echo "Umh, We can store robots: ";
     * foreach ($robot->getMessages() as $message) {
     * echo message;
     * }
     * } else {
     * echo "Great, a new robot was saved successfully!";
     * }
     * </code>
     */
    abstract class Model implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\ModelInterface, \Phalcon\Mvc\Model\ResultInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable, \JsonSerializable
    {
        const OP_NONE = 0;
        const OP_CREATE = 1;
        const OP_UPDATE = 2;
        const OP_DELETE = 3;
        const DIRTY_STATE_PERSISTENT = 0;
        const DIRTY_STATE_TRANSIENT = 1;
        const DIRTY_STATE_DETACHED = 2;
        protected $_dependencyInjector;
        protected $_modelsManager;
        protected $_modelsMetaData;
        protected $_errorMessages;
        protected $_operationMade = 0;
        protected $_dirtyState = 1;
        protected $_transaction;
        protected $_uniqueKey;
        protected $_uniqueParams;
        protected $_uniqueTypes;
        protected $_skipped;
        protected $_related;
        protected $_snapshot;
        /**
         * Phalcon\Mvc\Model constructor
         *
         * @param mixed $data 
         * @param mixed $dependencyInjector 
         * @param mixed $modelsManager 
         */
        public final function __construct($data = null, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Mvc\Model\ManagerInterface $modelsManager = null) {}
        /**
         * Sets the dependency injection container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the dependency injection container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets a custom events manager
         *
         * @param mixed $eventsManager 
         */
        protected function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the custom events manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        protected function getEventsManager() {}
        /**
         * Returns the models meta-data service related to the entity instance
         *
         * @return \Phalcon\Mvc\Model\MetaDataInterface 
         */
        public function getModelsMetaData() {}
        /**
         * Returns the models manager related to the entity instance
         *
         * @return \Phalcon\Mvc\Model\ManagerInterface 
         */
        public function getModelsManager() {}
        /**
         * Sets a transaction related to the Model instance
         * <code>
         * use Phalcon\Mvc\Model\Transaction\Manager as TxManager;
         * use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
         * try {
         * $txManager = new TxManager();
         * $transaction = $txManager->get();
         * $robot = new Robots();
         * $robot->setTransaction($transaction);
         * $robot->name = 'WALL·E';
         * $robot->created_at = date('Y-m-d');
         * if ($robot->save() == false) {
         * $transaction->rollback("Can't save robot");
         * }
         * $robotPart = new RobotParts();
         * $robotPart->setTransaction($transaction);
         * $robotPart->type = 'head';
         * if ($robotPart->save() == false) {
         * $transaction->rollback("Robot part cannot be saved");
         * }
         * $transaction->commit();
         * } catch (TxFailed $e) {
         * echo 'Failed, reason: ', $e->getMessage();
         * }
         * </code>
         *
         * @param mixed $transaction 
         * @return Model 
         */
        public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}
        /**
         * Sets table name which model should be mapped
         *
         * @param string $source 
         * @return Model 
         */
        protected function setSource($source) {}
        /**
         * Returns table name mapped in the model
         *
         * @return string 
         */
        public function getSource() {}
        /**
         * Sets schema name where table mapped is located
         *
         * @param string $schema 
         * @return Model 
         */
        protected function setSchema($schema) {}
        /**
         * Returns schema name where table mapped is located
         *
         * @return string 
         */
        public function getSchema() {}
        /**
         * Sets the DependencyInjection connection service name
         *
         * @param string $connectionService 
         * @return Model 
         */
        public function setConnectionService($connectionService) {}
        /**
         * Sets the DependencyInjection connection service name used to read data
         *
         * @param string $connectionService 
         * @return Model 
         */
        public function setReadConnectionService($connectionService) {}
        /**
         * Sets the DependencyInjection connection service name used to write data
         *
         * @param string $connectionService 
         * @return Model 
         */
        public function setWriteConnectionService($connectionService) {}
        /**
         * Returns the DependencyInjection connection service name used to read data related the model
         *
         * @return string 
         */
        public function getReadConnectionService() {}
        /**
         * Returns the DependencyInjection connection service name used to write data related to the model
         *
         * @return string 
         */
        public function getWriteConnectionService() {}
        /**
         * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
         *
         * @param int $dirtyState 
         * @return ModelInterface 
         */
        public function setDirtyState($dirtyState) {}
        /**
         * Returns one of the DIRTY_STATE_* constants telling if the record exists in the database or not
         *
         * @return int 
         */
        public function getDirtyState() {}
        /**
         * Gets the connection used to read data for the model
         *
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getReadConnection() {}
        /**
         * Gets the connection used to write data to the model
         *
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getWriteConnection() {}
        /**
         * Assigns values to a model from an array
         * <code>
         * $robot->assign(array(
         * 'type' => 'mechanical',
         * 'name' => 'Astro Boy',
         * 'year' => 1952
         * ));
         * //assign by db row, column map needed
         * $robot->assign($dbRow, array(
         * 'db_type' => 'type',
         * 'db_name' => 'name',
         * 'db_year' => 'year'
         * ));
         * //allow assign only name and year
         * $robot->assign($_POST, null, array('name', 'year');
         * </code>
         *
         * @param array $data 
         * @param array $dataColumnMap array to transform keys of data to another
         * @param array $whiteList 
         * @return \Phalcon\Mvc\Model 
         */
        public function assign(array $data, $dataColumnMap = null, $whiteList = null) {}
        /**
         * Assigns values to a model from an array returning a new model.
         * <code>
         * $robot = \Phalcon\Mvc\Model::cloneResultMap(new Robots(), array(
         * 'type' => 'mechanical',
         * 'name' => 'Astro Boy',
         * 'year' => 1952
         * ));
         * </code>
         *
         * @param \Phalcon\Mvc\ModelInterface|\Phalcon\Mvc\Model\Row $base 
         * @param array $data 
         * @param array $columnMap 
         * @param int $dirtyState 
         * @param boolean $keepSnapshots 
         * @return Model 
         */
        public static function cloneResultMap($base, array $data, $columnMap, $dirtyState = 0, $keepSnapshots = null) {}
        /**
         * Returns an hydrated result based on the data and the column map
         *
         * @param array $data 
         * @param array $columnMap 
         * @param int $hydrationMode 
         * @return mixed 
         */
        public static function cloneResultMapHydrate(array $data, $columnMap, $hydrationMode) {}
        /**
         * Assigns values to a model from an array returning a new model
         * <code>
         * $robot = Phalcon\Mvc\Model::cloneResult(new Robots(), array(
         * 'type' => 'mechanical',
         * 'name' => 'Astro Boy',
         * 'year' => 1952
         * ));
         * </code>
         *
         * @param mixed $base 
         * @param array $data 
         * @param int $dirtyState 
         * @param \Phalcon\Mvc\ModelInterface $$base 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public static function cloneResult(ModelInterface $base, array $data, $dirtyState = 0) {}
        /**
         * Allows to query a set of records that match the specified conditions
         * <code>
         * //How many robots are there?
         * $robots = Robots::find();
         * echo "There are ", count($robots), "\n";
         * //How many mechanical robots are there?
         * $robots = Robots::find("type='mechanical'");
         * echo "There are ", count($robots), "\n";
         * //Get and print virtual robots ordered by name
         * $robots = Robots::find(array("type='virtual'", "order" => "name"));
         * foreach ($robots as $robot) {
         * echo $robot->name, "\n";
         * }
         * //Get first 100 virtual robots ordered by name
         * $robots = Robots::find(array("type='virtual'", "order" => "name", "limit" => 100));
         * foreach ($robots as $robot) {
         * echo $robot->name, "\n";
         * }
         * </code>
         *
         * @param mixed $parameters 
         * @param  $array parameters
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public static function find($parameters = null) {}
        /**
         * Allows to query the first record that match the specified conditions
         * <code>
         * //What's the first robot in robots table?
         * $robot = Robots::findFirst();
         * echo "The robot name is ", $robot->name;
         * //What's the first mechanical robot in robots table?
         * $robot = Robots::findFirst("type='mechanical'");
         * echo "The first mechanical robot name is ", $robot->name;
         * //Get first virtual robot ordered by name
         * $robot = Robots::findFirst(array("type='virtual'", "order" => "name"));
         * echo "The first virtual robot name is ", $robot->name;
         * </code>
         *
         * @param string|array $parameters 
         * @return static 
         */
        public static function findFirst($parameters = null) {}
        /**
         * Create a criteria for a specific model
         *
         * @param mixed $dependencyInjector 
         * @return \Phalcon\Mvc\Model\Criteria 
         */
        public static function query(\Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Checks if the current record already exists or not
         *
         * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param string|array $table 
         * @return boolean 
         */
        protected function _exists(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table = null) {}
        /**
         * Generate a PHQL SELECT statement for an aggregate
         *
         * @param string $functionName 
         * @param string $alias 
         * @param array $parameters 
         * @param string $function 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        protected static function _groupResult($functionName, $alias, $parameters) {}
        /**
         * Allows to count how many records match the specified conditions
         * <code>
         * //How many robots are there?
         * $number = Robots::count();
         * echo "There are ", $number, "\n";
         * //How many mechanical robots are there?
         * $number = Robots::count("type = 'mechanical'");
         * echo "There are ", $number, " mechanical robots\n";
         * </code>
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function count($parameters = null) {}
        /**
         * Allows to calculate a summatory on a column that match the specified conditions
         * <code>
         * //How much are all robots?
         * $sum = Robots::sum(array('column' => 'price'));
         * echo "The total price of robots is ", $sum, "\n";
         * //How much are mechanical robots?
         * $sum = Robots::sum(array("type = 'mechanical'", 'column' => 'price'));
         * echo "The total price of mechanical robots is  ", $sum, "\n";
         * </code>
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function sum($parameters = null) {}
        /**
         * Allows to get the maximum value of a column that match the specified conditions
         * <code>
         * //What is the maximum robot id?
         * $id = Robots::maximum(array('column' => 'id'));
         * echo "The maximum robot id is: ", $id, "\n";
         * //What is the maximum id of mechanical robots?
         * $sum = Robots::maximum(array("type='mechanical'", 'column' => 'id'));
         * echo "The maximum robot id of mechanical robots is ", $id, "\n";
         * </code>
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function maximum($parameters = null) {}
        /**
         * Allows to get the minimum value of a column that match the specified conditions
         * <code>
         * //What is the minimum robot id?
         * $id = Robots::minimum(array('column' => 'id'));
         * echo "The minimum robot id is: ", $id;
         * //What is the minimum id of mechanical robots?
         * $sum = Robots::minimum(array("type='mechanical'", 'column' => 'id'));
         * echo "The minimum robot id of mechanical robots is ", $id;
         * </code>
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function minimum($parameters = null) {}
        /**
         * Allows to calculate the average value on a column matching the specified conditions
         * <code>
         * //What's the average price of robots?
         * $average = Robots::average(array('column' => 'price'));
         * echo "The average price is ", $average, "\n";
         * //What's the average price of mechanical robots?
         * $average = Robots::average(array("type='mechanical'", 'column' => 'price'));
         * echo "The average price of mechanical robots is ", $average, "\n";
         * </code>
         *
         * @param array $parameters 
         * @return double 
         */
        public static function average($parameters = null) {}
        /**
         * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEvent($eventName) {}
        /**
         * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
         * This method stops if one of the callbacks/listeners returns boolean false
         *
         * @param string $eventName 
         * @return bool 
         */
        public function fireEventCancel($eventName) {}
        /**
         * Cancel the current operation
         */
        protected function _cancelOperation() {}
        /**
         * Appends a customized message on the validation process
         * <code>
         * use Phalcon\Mvc\Model;
         * use Phalcon\Mvc\Model\Message as Message;
         * class Robots extends Model
         * {
         * public function beforeSave()
         * {
         * if ($this->name == 'Peter') {
         * $message = new Message("Sorry, but a robot cannot be named Peter");
         * $this->appendMessage($message);
         * }
         * }
         * }
         * </code>
         *
         * @param mixed $message 
         * @return Model 
         */
        public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message) {}
        /**
         * Executes validators on every validation call
         * <code>
         * use Phalcon\Mvc\Model;
         * use Phalcon\Validation;
         * use Phalcon\Validation\Validator\ExclusionIn;
         * class Subscriptors extends Model
         * {
         * public function validation()
         * {
         * $validator = new Validation();
         * $validator->add('status', new ExclusionIn(array(
         * 'domain' => array('A', 'I')
         * )));
         * return $this->validate($validator);
         * }
         * }
         * </code>
         *
         * @param mixed $validator 
         * @return bool 
         */
        protected function validate(\Phalcon\ValidationInterface $validator) {}
        /**
         * Check whether validation process has generated any messages
         * <code>
         * use Phalcon\Mvc\Model;
         * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
         * class Subscriptors extends Model
         * {
         * public function validation()
         * {
         * $validator = new Validation();
         * $validator->validate('status', new ExclusionIn(array(
         * 'domain' => array('A', 'I')
         * ));
         * return $this->validate($validator);
         * }
         * }
         * </code>
         *
         * @return bool 
         */
        public function validationHasFailed() {}
        /**
         * Returns array of validation messages
         * <code>
         * $robot = new Robots();
         * $robot->type = 'mechanical';
         * $robot->name = 'Astro Boy';
         * $robot->year = 1952;
         * if ($robot->save() == false) {
         * echo "Umh, We can't store robots right now ";
         * foreach ($robot->getMessages() as $message) {
         * echo $message;
         * }
         * } else {
         * echo "Great, a new robot was saved successfully!";
         * }
         * </code>
         *
         * @param mixed $filter 
         * @return MessageInterface[] 
         */
        public function getMessages($filter = null) {}
        /**
         * Reads "belongs to" relations and check the virtual foreign keys when inserting or updating records
         * to verify that inserted/updated values are present in the related entity
         *
         * @return bool 
         */
        protected final function _checkForeignKeysRestrict() {}
        /**
         * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (cascade) when deleting records
         *
         * @return bool 
         */
        protected final function _checkForeignKeysReverseCascade() {}
        /**
         * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (restrict) when deleting records
         *
         * @return bool 
         */
        protected final function _checkForeignKeysReverseRestrict() {}
        /**
         * Executes internal hooks before save a record
         *
         * @param mixed $metaData 
         * @param bool $exists 
         * @param mixed $identityField 
         * @return bool 
         */
        protected function _preSave(\Phalcon\Mvc\Model\MetaDataInterface $metaData, $exists, $identityField) {}
        /**
         * Executes internal events after save a record
         *
         * @param bool $success 
         * @param bool $exists 
         * @return bool 
         */
        protected function _postSave($success, $exists) {}
        /**
         * Sends a pre-build INSERT SQL statement to the relational database system
         *
         * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param string|array $table 
         * @param boolean|string $identityField 
         * @return boolean 
         */
        protected function _doLowInsert(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table, $identityField) {}
        /**
         * Sends a pre-build UPDATE SQL statement to the relational database system
         *
         * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param string|array $table 
         * @return boolean 
         */
        protected function _doLowUpdate(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table) {}
        /**
         * Saves related records that must be stored prior to save the master record
         *
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param \Phalcon\Mvc\ModelInterface[] $related 
         * @return boolean 
         */
        protected function _preSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related) {}
        /**
         * Save the related records assigned in the has-one/has-many relations
         *
         * @param \Phalcon\Db\AdapterInterface $connection 
         * @param \Phalcon\Mvc\ModelInterface[] $related 
         * @return boolean 
         */
        protected function _postSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related) {}
        /**
         * Inserts or updates a model instance. Returning true on success or false otherwise.
         * <code>
         * //Creating a new robot
         * $robot = new Robots();
         * $robot->type = 'mechanical';
         * $robot->name = 'Astro Boy';
         * $robot->year = 1952;
         * $robot->save();
         * //Updating a robot name
         * $robot = Robots::findFirst("id=100");
         * $robot->name = "Biomass";
         * $robot->save();
         * </code>
         *
         * @param array $data 
         * @param array $whiteList 
         * @return boolean 
         */
        public function save($data = null, $whiteList = null) {}
        /**
         * Inserts a model instance. If the instance already exists in the persistance it will throw an exception
         * Returning true on success or false otherwise.
         * <code>
         * //Creating a new robot
         * $robot = new Robots();
         * $robot->type = 'mechanical';
         * $robot->name = 'Astro Boy';
         * $robot->year = 1952;
         * $robot->create();
         * //Passing an array to create
         * $robot = new Robots();
         * $robot->create(array(
         * 'type' => 'mechanical',
         * 'name' => 'Astro Boy',
         * 'year' => 1952
         * ));
         * </code>
         *
         * @param mixed $data 
         * @param mixed $whiteList 
         * @return bool 
         */
        public function create($data = null, $whiteList = null) {}
        /**
         * Updates a model instance. If the instance doesn't exist in the persistance it will throw an exception
         * Returning true on success or false otherwise.
         * <code>
         * //Updating a robot name
         * $robot = Robots::findFirst("id=100");
         * $robot->name = "Biomass";
         * $robot->update();
         * </code>
         *
         * @param mixed $data 
         * @param mixed $whiteList 
         * @return bool 
         */
        public function update($data = null, $whiteList = null) {}
        /**
         * Deletes a model instance. Returning true on success or false otherwise.
         * <code>
         * $robot = Robots::findFirst("id=100");
         * $robot->delete();
         * foreach (Robots::find("type = 'mechanical'") as $robot) {
         * $robot->delete();
         * }
         * </code>
         *
         * @return bool 
         */
        public function delete() {}
        /**
         * Returns the type of the latest operation performed by the ORM
         * Returns one of the OP_* class constants
         *
         * @return int 
         */
        public function getOperationMade() {}
        /**
         * Refreshes the model attributes re-querying the record from the database
         *
         * @return Model 
         */
        public function refresh() {}
        /**
         * Skips the current operation forcing a success state
         *
         * @param bool $skip 
         */
        public function skipOperation($skip) {}
        /**
         * Reads an attribute value by its name
         * <code>
         * echo $robot->readAttribute('name');
         * </code>
         *
         * @param string $attribute 
         */
        public function readAttribute($attribute) {}
        /**
         * Writes an attribute value by its name
         * <code>
         * $robot->writeAttribute('name', 'Rosey');
         * </code>
         *
         * @param string $attribute 
         * @param mixed $value 
         */
        public function writeAttribute($attribute, $value) {}
        /**
         * Sets a list of attributes that must be skipped from the
         * generated INSERT/UPDATE statement
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->skipAttributes(array('price'));
         * }
         * }
         * </code>
         *
         * @param array $attributes 
         */
        protected function skipAttributes(array $attributes) {}
        /**
         * Sets a list of attributes that must be skipped from the
         * generated INSERT statement
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->skipAttributesOnCreate(array('created_at'));
         * }
         * }
         * </code>
         *
         * @param array $attributes 
         */
        protected function skipAttributesOnCreate(array $attributes) {}
        /**
         * Sets a list of attributes that must be skipped from the
         * generated UPDATE statement
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->skipAttributesOnUpdate(array('modified_in'));
         * }
         * }
         * </code>
         *
         * @param array $attributes 
         */
        protected function skipAttributesOnUpdate(array $attributes) {}
        /**
         * Sets a list of attributes that must be skipped from the
         * generated UPDATE statement
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->allowEmptyStringValues(array('name'));
         * }
         * }
         * </code>
         *
         * @param array $attributes 
         */
        protected function allowEmptyStringValues(array $attributes) {}
        /**
         * Setup a 1-1 relation between two models
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->hasOne('id', 'RobotsDescription', 'robots_id');
         * }
         * }
         * </code>
         *
         * @param mixed $fields 
         * @param string $referenceModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        protected function hasOne($fields, $referenceModel, $referencedFields, $options = null) {}
        /**
         * Setup a relation reverse 1-1  between two models
         * <code>
         * <?php
         * class RobotsParts extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->belongsTo('robots_id', 'Robots', 'id');
         * }
         * }
         * </code>
         *
         * @param mixed $fields 
         * @param string $referenceModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        protected function belongsTo($fields, $referenceModel, $referencedFields, $options = null) {}
        /**
         * Setup a relation 1-n between two models
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * $this->hasMany('id', 'RobotsParts', 'robots_id');
         * }
         * }
         * </code>
         *
         * @param mixed $fields 
         * @param string $referenceModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        protected function hasMany($fields, $referenceModel, $referencedFields, $options = null) {}
        /**
         * Setup a relation n-n between two models through an intermediate relation
         * <code>
         * <?php
         * class Robots extends \Phalcon\Mvc\Model
         * {
         * public function initialize()
         * {
         * //Setup a many-to-many relation to Parts through RobotsParts
         * $this->hasManyToMany(
         * 'id',
         * 'RobotsParts',
         * 'robots_id',
         * 'parts_id',
         * 'Parts',
         * 'id'
         * );
         * }
         * }
         * </code>
         *
         * @param	string|array fields
         * @param	string intermediateModel
         * @param	string|array intermediateFields
         * @param	string|array intermediateReferencedFields
         * @param	string referencedModel
         * @param mixed $fields 
         * @param string $intermediateModel 
         * @param mixed $intermediateFields 
         * @param mixed $intermediateReferencedFields 
         * @param string $referenceModel 
         * @param string|array $referencedFields 
         * @param array $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        protected function hasManyToMany($fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referenceModel, $referencedFields, $options = null) {}
        /**
         * Setups a behavior in a model
         * <code>
         * <?php
         * use Phalcon\Mvc\Model;
         * use Phalcon\Mvc\Model\Behavior\Timestampable;
         * class Robots extends Model
         * {
         * public function initialize()
         * {
         * $this->addBehavior(new Timestampable(array(
         * 'onCreate' => array(
         * 'field' => 'created_at',
         * 'format' => 'Y-m-d'
         * )
         * )));
         * }
         * }
         * </code>
         *
         * @param mixed $behavior 
         */
        public function addBehavior(\Phalcon\Mvc\Model\BehaviorInterface $behavior) {}
        /**
         * Sets if the model must keep the original record snapshot in memory
         * <code>
         * <?php
         * use Phalcon\Mvc\Model;
         * class Robots extends Model
         * {
         * public function initialize()
         * {
         * $this->keepSnapshots(true);
         * }
         * }
         * </code>
         *
         * @param bool $keepSnapshot 
         */
        protected function keepSnapshots($keepSnapshot) {}
        /**
         * Sets the record's snapshot data.
         * This method is used internally to set snapshot data when the model was set up to keep snapshot data
         *
         * @param array $data 
         * @param array $columnMap 
         */
        public function setSnapshotData(array $data, $columnMap = null) {}
        /**
         * Checks if the object has internal snapshot data
         *
         * @return bool 
         */
        public function hasSnapshotData() {}
        /**
         * Returns the internal snapshot data
         *
         * @return array 
         */
        public function getSnapshotData() {}
        /**
         * Check if a specific attribute has changed
         * This only works if the model is keeping data snapshots
         *
         * @param string|array $fieldName 
         * @return bool 
         */
        public function hasChanged($fieldName = null) {}
        /**
         * Returns a list of changed values
         *
         * @return array 
         */
        public function getChangedFields() {}
        /**
         * Sets if a model must use dynamic update instead of the all-field update
         * <code>
         * <?php
         * use Phalcon\Mvc\Model;
         * class Robots extends Model
         * {
         * public function initialize()
         * {
         * $this->useDynamicUpdate(true);
         * }
         * }
         * </code>
         *
         * @param bool $dynamicUpdate 
         */
        protected function useDynamicUpdate($dynamicUpdate) {}
        /**
         * Returns related records based on defined relations
         *
         * @param string $alias 
         * @param array $arguments 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getRelated($alias, $arguments = null) {}
        /**
         * Returns related records defined relations depending on the method name
         *
         * @param string $modelName 
         * @param string $method 
         * @param array $arguments 
         * @return mixed 
         */
        protected function _getRelatedRecords($modelName, $method, $arguments) {}
        /**
         * Try to check if the query must invoke a finder
         *
         * @param string $method 
         * @param array $arguments 
         * @return \Phalcon\Mvc\ModelInterface[]|\Phalcon\Mvc\ModelInterface|boolean 
         */
        protected final static function _invokeFinder($method, $arguments) {}
        /**
         * Handles method calls when a method is not implemented
         *
         * @param	string method
         * @param	array arguments
         * @return	mixed
         * @param string $method 
         * @param mixed $arguments 
         */
        public function __call($method, $arguments) {}
        /**
         * Handles method calls when a static method is not implemented
         *
         * @param	string method
         * @param	array arguments
         * @return	mixed
         * @param string $method 
         * @param mixed $arguments 
         */
        public static function __callStatic($method, $arguments) {}
        /**
         * Magic method to assign values to the the model
         *
         * @param string $property 
         * @param mixed $value 
         */
        public function __set($property, $value) {}
        /**
         * Check for, and attempt to use, possible setter.
         *
         * @param string $property 
         * @param mixed $value 
         * @return string 
         */
        protected final function _possibleSetter($property, $value) {}
        /**
         * Check whether a property is declared private or protected.
         * This is a stop-gap because we do not want to have to declare all properties.
         *
         * @param string $property 
         * @return boolean 
         */
        protected final function _isVisible($property) {}
        /**
         * Magic method to get related records using the relation alias as a property
         *
         * @param string $property 
         * @return \Phalcon\Mvc\Model\Resultset|Phalcon\Mvc\Model 
         */
        public function __get($property) {}
        /**
         * Magic method to check if a property is a valid relation
         *
         * @param string $property 
         * @return bool 
         */
        public function __isset($property) {}
        /**
         * Serializes the object ignoring connections, services, related objects or static properties
         *
         * @return string 
         */
        public function serialize() {}
        /**
         * Unserializes the object from a serialized string
         *
         * @param string $data 
         */
        public function unserialize($data) {}
        /**
         * Returns a simple representation of the object that can be used with var_dump
         * <code>
         * var_dump($robot->dump());
         * </code>
         *
         * @return array 
         */
        public function dump() {}
        /**
         * Returns the instance as an array representation
         * <code>
         * print_r($robot->toArray());
         * </code>
         *
         * @param mixed $columns 
         * @param array $$columns 
         * @return array 
         */
        public function toArray($columns = null) {}
        /**
         * Serializes the object for json_encode
         * <code>
         * echo json_encode($robot);
         * </code>
         *
         * @return array 
         */
        public function jsonSerialize() {}
        /**
         * Enables/disables options in the ORM
         *
         * @param array $options 
         */
        public static function setup(array $options) {}
        /**
         * Reset a model instance data
         */
        public function reset() {}
    }

    /**
     * Phalcon\Mvc\ModelInterface
     * Interface for Phalcon\Mvc\Model
     */
    interface ModelInterface
    {
        /**
         * Sets a transaction related to the Model instance
         *
         * @param mixed $transaction 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction);
        /**
         * Returns table name mapped in the model
         *
         * @return string 
         */
        public function getSource();
        /**
         * Returns schema name where table mapped is located
         *
         * @return string 
         */
        public function getSchema();
        /**
         * Sets both read/write connection services
         *
         * @param string $connectionService 
         */
        public function setConnectionService($connectionService);
        /**
         * Sets the DependencyInjection connection service used to write data
         *
         * @param string $connectionService 
         */
        public function setWriteConnectionService($connectionService);
        /**
         * Sets the DependencyInjection connection service used to read data
         *
         * @param string $connectionService 
         */
        public function setReadConnectionService($connectionService);
        /**
         * Returns DependencyInjection connection service used to read data
         *
         * @return string 
         */
        public function getReadConnectionService();
        /**
         * Returns DependencyInjection connection service used to write data
         *
         * @return string 
         */
        public function getWriteConnectionService();
        /**
         * Gets internal database connection
         *
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getReadConnection();
        /**
         * Gets internal database connection
         *
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getWriteConnection();
        /**
         * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
         *
         * @param int $dirtyState 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function setDirtyState($dirtyState);
        /**
         * Returns one of the DIRTY_STATE_* constants telling if the record exists in the database or not
         *
         * @return int 
         */
        public function getDirtyState();
        /**
         * Assigns values to a model from an array
         *
         * @param array $data 
         * @param mixed $dataColumnMap 
         * @param mixed $whiteList 
         * @param \Phalcon\Mvc\Model $object 
         * @param array $columnMap 
         * @return \Phalcon\Mvc\Model 
         */
        public function assign(array $data, $dataColumnMap = null, $whiteList = null);
        /**
         * Assigns values to a model from an array returning a new model
         *
         * @param \Phalcon\Mvc\Model $base 
         * @param array $data 
         * @param array $columnMap 
         * @param int $dirtyState 
         * @param boolean $keepSnapshots 
         * @return \Phalcon\Mvc\Model 
         */
        public static function cloneResultMap($base, array $data, $columnMap, $dirtyState = 0, $keepSnapshots = null);
        /**
         * Assigns values to a model from an array returning a new model
         *
         * @param \Phalcon\Mvc\ModelInterface $base 
         * @param array $data 
         * @param int $dirtyState 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public static function cloneResult(\Phalcon\Mvc\ModelInterface $base, array $data, $dirtyState = 0);
        /**
         * Returns an hydrated result based on the data and the column map
         *
         * @param array $data 
         * @param array $columnMap 
         * @param int $hydrationMode 
         */
        public static function cloneResultMapHydrate(array $data, $columnMap, $hydrationMode);
        /**
         * Allows to query a set of records that match the specified conditions
         *
         * @param mixed $parameters 
         * @param  $array parameters
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public static function find($parameters = null);
        /**
         * Allows to query the first record that match the specified conditions
         *
         * @param array $parameters 
         * @return static 
         */
        public static function findFirst($parameters = null);
        /**
         * Create a criteria for a especific model
         *
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public static function query(\Phalcon\DiInterface $dependencyInjector = null);
        /**
         * Allows to count how many records match the specified conditions
         *
         * @param array $parameters 
         * @return int 
         */
        public static function count($parameters = null);
        /**
         * Allows to calculate a summatory on a column that match the specified conditions
         *
         * @param array $parameters 
         * @return double 
         */
        public static function sum($parameters = null);
        /**
         * Allows to get the maximum value of a column that match the specified conditions
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function maximum($parameters = null);
        /**
         * Allows to get the minimum value of a column that match the specified conditions
         *
         * @param array $parameters 
         * @return mixed 
         */
        public static function minimum($parameters = null);
        /**
         * Allows to calculate the average value on a column matching the specified conditions
         *
         * @param array $parameters 
         * @return double 
         */
        public static function average($parameters = null);
        /**
         * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
         *
         * @param string $eventName 
         * @return boolean 
         */
        public function fireEvent($eventName);
        /**
         * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
         * This method stops if one of the callbacks/listeners returns boolean false
         *
         * @param string $eventName 
         * @return boolean 
         */
        public function fireEventCancel($eventName);
        /**
         * Appends a customized message on the validation process
         *
         * @param mixed $message 
         */
        public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message);
        /**
         * Check whether validation process has generated any messages
         *
         * @return boolean 
         */
        public function validationHasFailed();
        /**
         * Returns array of validation messages
         *
         * @return \Phalcon\Mvc\Model\MessageInterface[] 
         */
        public function getMessages();
        /**
         * Inserts or updates a model instance. Returning true on success or false otherwise.
         *
         * @param array $data 
         * @param array $whiteList 
         * @return boolean 
         */
        public function save($data = null, $whiteList = null);
        /**
         * Inserts a model instance. If the instance already exists in the persistance it will throw an exception
         * Returning true on success or false otherwise.
         *
         * @param array $data 
         * @param array $whiteList 
         * @return boolean 
         */
        public function create($data = null, $whiteList = null);
        /**
         * Updates a model instance. If the instance doesn't exist in the persistance it will throw an exception
         * Returning true on success or false otherwise.
         *
         * @param array $data 
         * @param array $whiteList 
         * @return boolean 
         */
        public function update($data = null, $whiteList = null);
        /**
         * Deletes a model instance. Returning true on success or false otherwise.
         *
         * @return boolean 
         */
        public function delete();
        /**
         * Returns the type of the latest operation performed by the ORM
         * Returns one of the OP_* class constants
         *
         * @return int 
         */
        public function getOperationMade();
        /**
         * Refreshes the model attributes re-querying the record from the database
         */
        public function refresh();
        /**
         * Skips the current operation forcing a success state
         *
         * @param bool $skip 
         */
        public function skipOperation($skip);
        /**
         * Returns related records based on defined relations
         *
         * @param string $alias 
         * @param array $arguments 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getRelated($alias, $arguments = null);
        /**
         * Sets the record's snapshot data.
         * This method is used internally to set snapshot data when the model was set up to keep snapshot data
         *
         * @param array $data 
         * @param array $columnMap 
         */
        public function setSnapshotData(array $data, $columnMap = null);
        /**
         * Reset a model instance data
         */
        public function reset();
    }

    /**
     * Phalcon\Mvc\ModuleDefinitionInterface
     * This interface must be implemented by class module definitions
     */
    interface ModuleDefinitionInterface
    {
        /**
         * Registers an autoloader related to the module
         *
         * @param mixed $dependencyInjector 
         */
        public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null);
        /**
         * Registers services related to the module
         *
         * @param mixed $dependencyInjector 
         */
        public function registerServices(\Phalcon\DiInterface $dependencyInjector);
    }

    /**
     * Phalcon\Mvc\Router
     * Phalcon\Mvc\Router is the standard framework router. Routing is the
     * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
     * decomposing it into parameters to determine which module, controller, and
     * action of that controller should receive the request
     * <code>
     * use Phalcon\Mvc\Router;
     * $router = new Router();
     * $router->add(
     * '/documentation/{chapter}/{name}\.{type:[a-z]+}',
     * [
     * 'controller' => 'documentation',
     * 'action'     => 'show'
     * )
     * );
     * $router->handle();
     * echo $router->getControllerName();
     * </code>
     */
    class Router implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Events\EventsAwareInterface
    {
        const URI_SOURCE_GET_URL = 0;
        const URI_SOURCE_SERVER_REQUEST_URI = 1;
        const POSITION_FIRST = 0;
        const POSITION_LAST = 1;
        protected $_dependencyInjector;
        protected $_eventsManager;
        protected $_uriSource;
        protected $_namespace = null;
        protected $_module = null;
        protected $_controller = null;
        protected $_action = null;
        protected $_params = array();
        protected $_routes;
        protected $_matchedRoute;
        protected $_matches;
        protected $_wasMatched = false;
        protected $_defaultNamespace;
        protected $_defaultModule;
        protected $_defaultController;
        protected $_defaultAction;
        protected $_defaultParams = array();
        protected $_removeExtraSlashes;
        protected $_notFoundPaths;
        /**
         * Phalcon\Mvc\Router constructor
         *
         * @param bool $defaultRoutes 
         */
        public function __construct($defaultRoutes = true) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the events manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Get rewrite info. This info is read from $_GET['_url']. This returns '/' if the rewrite information cannot be read
         *
         * @return string 
         */
        public function getRewriteUri() {}
        /**
         * Sets the URI source. One of the URI_SOURCE_* constants
         * <code>
         * $router->setUriSource(Router::URI_SOURCE_SERVER_REQUEST_URI);
         * </code>
         *
         * @param mixed $uriSource 
         * @return RouterInterface 
         */
        public function setUriSource($uriSource) {}
        /**
         * Set whether router must remove the extra slashes in the handled routes
         *
         * @param bool $remove 
         * @return RouterInterface 
         */
        public function removeExtraSlashes($remove) {}
        /**
         * Sets the name of the default namespace
         *
         * @param string $namespaceName 
         * @return RouterInterface 
         */
        public function setDefaultNamespace($namespaceName) {}
        /**
         * Sets the name of the default module
         *
         * @param string $moduleName 
         * @return RouterInterface 
         */
        public function setDefaultModule($moduleName) {}
        /**
         * Sets the default controller name
         *
         * @param string $controllerName 
         * @return RouterInterface 
         */
        public function setDefaultController($controllerName) {}
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         * @return RouterInterface 
         */
        public function setDefaultAction($actionName) {}
        /**
         * Sets an array of default paths. If a route is missing a path the router will use the defined here
         * This method must not be used to set a 404 route
         * <code>
         * $router->setDefaults([
         * 'module' => 'common',
         * 'action' => 'index'
         * ]);
         * </code>
         *
         * @param array $defaults 
         * @return RouterInterface 
         */
        public function setDefaults(array $defaults) {}
        /**
         * Returns an array of default parameters
         *
         * @return array 
         */
        public function getDefaults() {}
        /**
         * Handles routing information received from the rewrite engine
         * <code>
         * // Read the info from the rewrite engine
         * $router->handle();
         * // Manually passing an URL
         * $router->handle('/posts/edit/1');
         * </code>
         *
         * @param string $uri 
         */
        public function handle($uri = null) {}
        /**
         * Adds a route to the router without any HTTP constraint
         * <code>
         * use Phalcon\Mvc\Router;
         * $router->add('/about', 'About::index');
         * $router->add('/about', 'About::index', ['GET', 'POST']);
         * $router->add('/about', 'About::index', ['GET', 'POST'], Router::POSITION_FIRST);
         * </code>
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function add($pattern, $paths = null, $httpMethods = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is GET
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addGet($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is POST
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPost($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is PUT
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPut($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is PATCH
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPatch($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is DELETE
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addDelete($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Add a route to the router that only match if the HTTP method is OPTIONS
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addOptions($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is HEAD
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addHead($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is PURGE (Squid and Varnish support)
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPurge($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is TRACE
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addTrace($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Adds a route to the router that only match if the HTTP method is CONNECT
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $position 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addConnect($pattern, $paths = null, $position = Router::POSITION_LAST) {}
        /**
         * Mounts a group of routes in the router
         *
         * @param mixed $group 
         * @return RouterInterface 
         */
        public function mount(\Phalcon\Mvc\Router\GroupInterface $group) {}
        /**
         * Set a group of paths to be returned when none of the defined routes are matched
         *
         * @param mixed $paths 
         * @return RouterInterface 
         */
        public function notFound($paths) {}
        /**
         * Removes all the pre-defined routes
         */
        public function clear() {}
        /**
         * Returns the processed namespace name
         *
         * @return string 
         */
        public function getNamespaceName() {}
        /**
         * Returns the processed module name
         *
         * @return string 
         */
        public function getModuleName() {}
        /**
         * Returns the processed controller name
         *
         * @return string 
         */
        public function getControllerName() {}
        /**
         * Returns the processed action name
         *
         * @return string 
         */
        public function getActionName() {}
        /**
         * Returns the processed parameters
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Returns the route that matches the handled URI
         *
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function getMatchedRoute() {}
        /**
         * Returns the sub expressions in the regular expression matched
         *
         * @return array 
         */
        public function getMatches() {}
        /**
         * Checks if the router matches any of the defined routes
         *
         * @return bool 
         */
        public function wasMatched() {}
        /**
         * Returns all the routes defined in the router
         *
         * @return RouteInterface[] 
         */
        public function getRoutes() {}
        /**
         * Returns a route object by its id
         *
         * @param mixed $id 
         * @return bool|\Phalcon\Mvc\Router\RouteInterface 
         */
        public function getRouteById($id) {}
        /**
         * Returns a route object by its name
         *
         * @param string $name 
         * @return bool|\Phalcon\Mvc\Router\RouteInterface 
         */
        public function getRouteByName($name) {}
        /**
         * Returns whether controller name should not be mangled
         *
         * @return bool 
         */
        public function isExactControllerName() {}
    }

    /**
     * Phalcon\Mvc\RouterInterface
     * Interface for Phalcon\Mvc\Router
     */
    interface RouterInterface
    {
        /**
         * Sets the name of the default module
         *
         * @param string $moduleName 
         */
        public function setDefaultModule($moduleName);
        /**
         * Sets the default controller name
         *
         * @param string $controllerName 
         */
        public function setDefaultController($controllerName);
        /**
         * Sets the default action name
         *
         * @param string $actionName 
         */
        public function setDefaultAction($actionName);
        /**
         * Sets an array of default paths
         *
         * @param array $defaults 
         */
        public function setDefaults(array $defaults);
        /**
         * Handles routing information received from the rewrite engine
         *
         * @param string $uri 
         */
        public function handle($uri = null);
        /**
         * Adds a route to the router on any HTTP method
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function add($pattern, $paths = null, $httpMethods = null);
        /**
         * Adds a route to the router that only match if the HTTP method is GET
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addGet($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is POST
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPost($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is PUT
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPut($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is PATCH
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPatch($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is DELETE
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addDelete($pattern, $paths = null);
        /**
         * Add a route to the router that only match if the HTTP method is OPTIONS
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addOptions($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is HEAD
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addHead($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is PURGE (Squid and Varnish support)
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPurge($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is TRACE
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addTrace($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is CONNECT
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addConnect($pattern, $paths = null);
        /**
         * Mounts a group of routes in the router
         *
         * @param mixed $group 
         * @return RouterInterface 
         */
        public function mount(\Phalcon\Mvc\Router\GroupInterface $group);
        /**
         * Removes all the defined routes
         */
        public function clear();
        /**
         * Returns processed module name
         *
         * @return string 
         */
        public function getModuleName();
        /**
         * Returns processed namespace name
         *
         * @return string 
         */
        public function getNamespaceName();
        /**
         * Returns processed controller name
         *
         * @return string 
         */
        public function getControllerName();
        /**
         * Returns processed action name
         *
         * @return string 
         */
        public function getActionName();
        /**
         * Returns processed extra params
         *
         * @return array 
         */
        public function getParams();
        /**
         * Returns the route that matches the handled URI
         *
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function getMatchedRoute();
        /**
         * Return the sub expressions in the regular expression matched
         *
         * @return array 
         */
        public function getMatches();
        /**
         * Check if the router matches any of the defined routes
         *
         * @return bool 
         */
        public function wasMatched();
        /**
         * Return all the routes defined in the router
         *
         * @return RouteInterface[] 
         */
        public function getRoutes();
        /**
         * Returns a route object by its id
         *
         * @param mixed $id 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function getRouteById($id);
        /**
         * Returns a route object by its name
         *
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function getRouteByName($name);
    }

    /**
     * Phalcon\Mvc\Url
     * This components helps in the generation of: URIs, URLs and Paths
     * <code>
     * //Generate a URL appending the URI to the base URI
     * echo $url->get('products/edit/1');
     * //Generate a URL for a predefined route
     * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2012'));
     * </code>
     */
    class Url implements \Phalcon\Mvc\UrlInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_baseUri = null;
        protected $_staticBaseUri = null;
        protected $_basePath = null;
        protected $_router;
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets a prefix for all the URIs to be generated
         * <code>
         * $url->setBaseUri('/invo/');
         * $url->setBaseUri('/invo/index.php/');
         * </code>
         *
         * @param string $baseUri 
         * @return Url 
         */
        public function setBaseUri($baseUri) {}
        /**
         * Sets a prefix for all static URLs generated
         * <code>
         * $url->setStaticBaseUri('/invo/');
         * </code>
         *
         * @param string $staticBaseUri 
         * @return Url 
         */
        public function setStaticBaseUri($staticBaseUri) {}
        /**
         * Returns the prefix for all the generated urls. By default /
         *
         * @return string 
         */
        public function getBaseUri() {}
        /**
         * Returns the prefix for all the generated static urls. By default /
         *
         * @return string 
         */
        public function getStaticBaseUri() {}
        /**
         * Sets a base path for all the generated paths
         * <code>
         * $url->setBasePath('/var/www/htdocs/');
         * </code>
         *
         * @param string $basePath 
         * @return Url 
         */
        public function setBasePath($basePath) {}
        /**
         * Returns the base path
         *
         * @return string 
         */
        public function getBasePath() {}
        /**
         * Generates a URL
         * <code>
         * //Generate a URL appending the URI to the base URI
         * echo $url->get('products/edit/1');
         * //Generate a URL for a predefined route
         * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2015'));
         * // Generate a URL with GET arguments (/show/products?id=1&name=Carrots)
         * echo $url->get('show/products', array('id' => 1, 'name' => 'Carrots'));
         * // Generate an absolute URL by setting the third parameter as false.
         * echo $url->get('https://phalconphp.com/', null, false);
         * </code>
         *
         * @param mixed $uri 
         * @param mixed $args 
         * @param mixed $local 
         * @param mixed $baseUri 
         * @return string 
         */
        public function get($uri = null, $args = null, $local = null, $baseUri = null) {}
        /**
         * Generates a URL for a static resource
         * <code>
         * // Generate a URL for a static resource
         * echo $url->getStatic("img/logo.png");
         * // Generate a URL for a static predefined route
         * echo $url->getStatic(array('for' => 'logo-cdn'));
         * </code>
         *
         * @param mixed $uri 
         * @return string 
         */
        public function getStatic($uri = null) {}
        /**
         * Generates a local path
         *
         * @param string $path 
         * @return string 
         */
        public function path($path = null) {}
    }

    /**
     * Phalcon\Mvc\UrlInterface
     * Interface for Phalcon\Mvc\UrlInterface
     */
    interface UrlInterface
    {
        /**
         * Sets a prefix to all the urls generated
         *
         * @param string $baseUri 
         */
        public function setBaseUri($baseUri);
        /**
         * Returns the prefix for all the generated urls. By default /
         *
         * @return string 
         */
        public function getBaseUri();
        /**
         * Sets a base paths for all the generated paths
         *
         * @param string $basePath 
         */
        public function setBasePath($basePath);
        /**
         * Returns a base path
         *
         * @return string 
         */
        public function getBasePath();
        /**
         * Generates a URL
         *
         * @param string|array $uri 
         * @param array|object $args Optional arguments to be appended to the query string
         * @param bool $local 
         * @param bool $$local 
         * @return string 
         */
        public function get($uri = null, $args = null, $local = null);
        /**
         * Generates a local path
         *
         * @param string $path 
         * @return string 
         */
        public function path($path = null);
    }

    /**
     * Phalcon\Mvc\View
     * Phalcon\Mvc\View is a class for working with the "view" portion of the model-view-controller pattern.
     * That is, it exists to help keep the view script separate from the model and controller scripts.
     * It provides a system of helpers, output filters, and variable escaping.
     * <code>
     * use Phalcon\Mvc\View;
     * $view = new View();
     * // Setting views directory
     * $view->setViewsDir('app/views/');
     * $view->start();
     * // Shows recent posts view (app/views/posts/recent.phtml)
     * $view->render('posts', 'recent');
     * $view->finish();
     * // Printing views output
     * echo $view->getContent();
     * </code>
     */
    class View extends \Phalcon\Di\Injectable implements \Phalcon\Mvc\ViewInterface
    {
        /**
         * Render Level: To the main layout
         */
        const LEVEL_MAIN_LAYOUT = 5;
        /**
         * Render Level: Render to the templates "after"
         */
        const LEVEL_AFTER_TEMPLATE = 4;
        /**
         * Render Level: To the controller layout
         */
        const LEVEL_LAYOUT = 3;
        /**
         * Render Level: To the templates "before"
         */
        const LEVEL_BEFORE_TEMPLATE = 2;
        /**
         * Render Level: To the action view
         */
        const LEVEL_ACTION_VIEW = 1;
        /**
         * Render Level: No render any view
         */
        const LEVEL_NO_RENDER = 0;
        /**
         * Cache Mode
         */
        const CACHE_MODE_NONE = 0;
        const CACHE_MODE_INVERSE = 1;
        protected $_options;
        protected $_basePath = "";
        protected $_content = "";
        protected $_renderLevel = 5;
        protected $_currentRenderLevel = 0;
        protected $_disabledLevels;
        protected $_viewParams;
        protected $_layout;
        protected $_layoutsDir = "";
        protected $_partialsDir = "";
        protected $_viewsDirs;
        protected $_templatesBefore;
        protected $_templatesAfter;
        protected $_engines = false;
        /**
         * @var array
         */
        protected $_registeredEngines;
        protected $_mainView = "index";
        protected $_controllerName;
        protected $_actionName;
        protected $_params;
        protected $_pickView;
        protected $_cache;
        protected $_cacheLevel = 0;
        protected $_activeRenderPaths;
        protected $_disabled = false;
        public function getRenderLevel() {}
        public function getCurrentRenderLevel() {}
        /**
         * @return array 
         */
        public function getRegisteredEngines() {}
        /**
         * Phalcon\Mvc\View constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Checks if a path is absolute or not
         *
         * @param string $path 
         */
        protected final function _isAbsolutePath($path) {}
        /**
         * Sets the views directory. Depending of your platform,
         * always add a trailing slash or backslash
         *
         * @param mixed $viewsDir 
         * @return View 
         */
        public function setViewsDir($viewsDir) {}
        /**
         * Gets views directory
         *
         * @return string|array 
         */
        public function getViewsDir() {}
        /**
         * Sets the layouts sub-directory. Must be a directory under the views directory.
         * Depending of your platform, always add a trailing slash or backslash
         * <code>
         * $view->setLayoutsDir('../common/layouts/');
         * </code>
         *
         * @param string $layoutsDir 
         * @return View 
         */
        public function setLayoutsDir($layoutsDir) {}
        /**
         * Gets the current layouts sub-directory
         *
         * @return string 
         */
        public function getLayoutsDir() {}
        /**
         * Sets a partials sub-directory. Must be a directory under the views directory.
         * Depending of your platform, always add a trailing slash or backslash
         * <code>
         * $view->setPartialsDir('../common/partials/');
         * </code>
         *
         * @param string $partialsDir 
         * @return View 
         */
        public function setPartialsDir($partialsDir) {}
        /**
         * Gets the current partials sub-directory
         *
         * @return string 
         */
        public function getPartialsDir() {}
        /**
         * Sets base path. Depending of your platform, always add a trailing slash or backslash
         * <code>
         * $view->setBasePath(__DIR__ . '/');
         * </code>
         *
         * @param string $basePath 
         * @return View 
         */
        public function setBasePath($basePath) {}
        /**
         * Gets base path
         *
         * @return string 
         */
        public function getBasePath() {}
        /**
         * Sets the render level for the view
         * <code>
         * //Render the view related to the controller only
         * $this->view->setRenderLevel(View::LEVEL_LAYOUT);
         * </code>
         *
         * @param int $level 
         * @return View 
         */
        public function setRenderLevel($level) {}
        /**
         * Disables a specific level of rendering
         * <code>
         * // Render all levels except ACTION level
         * $this->view->disableLevel(View::LEVEL_ACTION_VIEW);
         * </code>
         *
         * @param mixed $level 
         * @return View 
         */
        public function disableLevel($level) {}
        /**
         * Sets default view name. Must be a file without extension in the views directory
         * <code>
         * //Renders as main view views-dir/base.phtml
         * $this->view->setMainView('base');
         * </code>
         *
         * @param string $viewPath 
         * @return View 
         */
        public function setMainView($viewPath) {}
        /**
         * Returns the name of the main view
         *
         * @return string 
         */
        public function getMainView() {}
        /**
         * Change the layout to be used instead of using the name of the latest controller name
         * <code>
         * $this->view->setLayout('main');
         * </code>
         *
         * @param string $layout 
         * @return View 
         */
        public function setLayout($layout) {}
        /**
         * Returns the name of the main view
         *
         * @return string 
         */
        public function getLayout() {}
        /**
         * Sets a template before the controller layout
         *
         * @param mixed $templateBefore 
         * @return View 
         */
        public function setTemplateBefore($templateBefore) {}
        /**
         * Resets any "template before" layouts
         *
         * @return View 
         */
        public function cleanTemplateBefore() {}
        /**
         * Sets a "template after" controller layout
         *
         * @param mixed $templateAfter 
         * @return View 
         */
        public function setTemplateAfter($templateAfter) {}
        /**
         * Resets any template before layouts
         *
         * @return View 
         */
        public function cleanTemplateAfter() {}
        /**
         * Adds parameters to views (alias of setVar)
         * <code>
         * $this->view->setParamToView('products', $products);
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         * @return View 
         */
        public function setParamToView($key, $value) {}
        /**
         * Set all the render params
         * <code>
         * $this->view->setVars(['products' => $products]);
         * </code>
         *
         * @param array $params 
         * @param bool $merge 
         * @return View 
         */
        public function setVars(array $params, $merge = true) {}
        /**
         * Set a single view parameter
         * <code>
         * $this->view->setVar('products', $products);
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         * @return View 
         */
        public function setVar($key, $value) {}
        /**
         * Returns a parameter previously set in the view
         *
         * @param string $key 
         */
        public function getVar($key) {}
        /**
         * Returns parameters to views
         *
         * @return array 
         */
        public function getParamsToView() {}
        /**
         * Gets the name of the controller rendered
         *
         * @return string 
         */
        public function getControllerName() {}
        /**
         * Gets the name of the action rendered
         *
         * @return string 
         */
        public function getActionName() {}
        /**
         * Gets extra parameters of the action rendered
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Starts rendering process enabling the output buffering
         *
         * @return View 
         */
        public function start() {}
        /**
         * Loads registered template engines, if none is registered it will use Phalcon\Mvc\View\Engine\Php
         *
         * @return array 
         */
        protected function _loadTemplateEngines() {}
        /**
         * Checks whether view exists on registered extensions and render it
         *
         * @param array $engines 
         * @param string $viewPath 
         * @param boolean $silence 
         * @param boolean $mustClean 
         * @param mixed $cache 
         * @param \Phalcon\Cache\BackendInterface $$cache 
         */
        protected function _engineRender($engines, $viewPath, $silence, $mustClean, \Phalcon\Cache\BackendInterface $cache = null) {}
        /**
         * Register templating engines
         * <code>
         * $this->view->registerEngines([
         * '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
         * '.volt'  => 'Phalcon\Mvc\View\Engine\Volt',
         * '.mhtml' => 'MyCustomEngine'
         * ]);
         * </code>
         *
         * @param array $engines 
         * @return View 
         */
        public function registerEngines(array $engines) {}
        /**
         * Checks whether view exists
         *
         * @param string $view 
         * @return bool 
         */
        public function exists($view) {}
        /**
         * Executes render process from dispatching data
         * <code>
         * // Shows recent posts view (app/views/posts/recent.phtml)
         * $view->start()->render('posts', 'recent')->finish();
         * </code>
         *
         * @param string $controllerName 
         * @param string $actionName 
         * @param array $params 
         * @return bool|View 
         */
        public function render($controllerName, $actionName, $params = null) {}
        /**
         * Choose a different view to render instead of last-controller/last-action
         * <code>
         * use Phalcon\Mvc\Controller;
         * class ProductsController extends Controller
         * {
         * public function saveAction()
         * {
         * // Do some save stuff...
         * // Then show the list view
         * $this->view->pick("products/list");
         * }
         * }
         * </code>
         *
         * @param mixed $renderView 
         * @return View 
         */
        public function pick($renderView) {}
        /**
         * Renders a partial view
         * <code>
         * // Retrieve the contents of a partial
         * echo $this->getPartial('shared/footer');
         * </code>
         * <code>
         * // Retrieve the contents of a partial with arguments
         * echo $this->getPartial('shared/footer', ['content' => $html]);
         * </code>
         *
         * @param string $partialPath 
         * @param mixed $params 
         * @return string 
         */
        public function getPartial($partialPath, $params = null) {}
        /**
         * Renders a partial view
         * <code>
         * // Show a partial inside another view
         * $this->partial('shared/footer');
         * </code>
         * <code>
         * // Show a partial inside another view with parameters
         * $this->partial('shared/footer', ['content' => $html]);
         * </code>
         *
         * @param string $partialPath 
         * @param mixed $params 
         */
        public function partial($partialPath, $params = null) {}
        /**
         * Perform the automatic rendering returning the output as a string
         * <code>
         * $template = $this->view->getRender('products', 'show', ['products' => $products]);
         * </code>
         *
         * @param string $controllerName 
         * @param string $actionName 
         * @param array $params 
         * @param mixed $configCallback 
         * @return string 
         */
        public function getRender($controllerName, $actionName, $params = null, $configCallback = null) {}
        /**
         * Finishes the render process by stopping the output buffering
         *
         * @return View 
         */
        public function finish() {}
        /**
         * Create a Phalcon\Cache based on the internal cache options
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        protected function _createCache() {}
        /**
         * Check if the component is currently caching the output content
         *
         * @return bool 
         */
        public function isCaching() {}
        /**
         * Returns the cache instance used to cache
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache() {}
        /**
         * Cache the actual view render to certain level
         * <code>
         * $this->view->cache(['key' => 'my-key', 'lifetime' => 86400]);
         * </code>
         *
         * @param mixed $options 
         * @return View 
         */
        public function cache($options = true) {}
        /**
         * Externally sets the view content
         * <code>
         * $this->view->setContent("<h1>hello</h1>");
         * </code>
         *
         * @param string $content 
         * @return View 
         */
        public function setContent($content) {}
        /**
         * Returns cached output from another view stage
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Returns the path (or paths) of the views that are currently rendered
         *
         * @return string|array 
         */
        public function getActiveRenderPath() {}
        /**
         * Disables the auto-rendering process
         *
         * @return View 
         */
        public function disable() {}
        /**
         * Enables the auto-rendering process
         *
         * @return View 
         */
        public function enable() {}
        /**
         * Resets the view component to its factory default values
         *
         * @return View 
         */
        public function reset() {}
        /**
         * Magic method to pass variables to the views
         * <code>
         * $this->view->products = $products;
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         */
        public function __set($key, $value) {}
        /**
         * Magic method to retrieve a variable passed to the view
         * <code>
         * echo $this->view->products;
         * </code>
         *
         * @param string $key 
         * @return mixed|null 
         */
        public function __get($key) {}
        /**
         * Whether automatic rendering is enabled
         *
         * @return bool 
         */
        public function isDisabled() {}
        /**
         * Magic method to retrieve if a variable is set in the view
         * <code>
         * echo isset($this->view->products);
         * </code>
         *
         * @param string $key 
         * @return bool 
         */
        public function __isset($key) {}
        /**
         * Gets views directories
         *
         * @return array 
         */
        protected function getViewsDirs() {}
    }

    /**
     * Phalcon\Mvc\ViewInterface
     * Interface for Phalcon\Mvc\View and Phalcon\Mvc\View\Simple
     */
    interface ViewBaseInterface
    {
        /**
         * Sets views directory. Depending of your platform, always add a trailing slash or backslash
         *
         * @param string $viewsDir 
         */
        public function setViewsDir($viewsDir);
        /**
         * Gets views directory
         *
         * @return string 
         */
        public function getViewsDir();
        /**
         * Adds parameters to views (alias of setVar)
         *
         * @param string $key 
         * @param mixed $value 
         */
        public function setParamToView($key, $value);
        /**
         * Adds parameters to views
         *
         * @param string $key 
         * @param mixed $value 
         */
        public function setVar($key, $value);
        /**
         * Returns parameters to views
         *
         * @return array 
         */
        public function getParamsToView();
        /**
         * Returns the cache instance used to cache
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache();
        /**
         * Cache the actual view render to certain level
         *
         * @param mixed $options 
         */
        public function cache($options = true);
        /**
         * Externally sets the view content
         *
         * @param string $content 
         */
        public function setContent($content);
        /**
         * Returns cached output from another view stage
         *
         * @return string 
         */
        public function getContent();
        /**
         * Renders a partial view
         *
         * @param string $partialPath 
         * @param mixed $params 
         * @return string 
         */
        public function partial($partialPath, $params = null);
    }

    /**
     * Phalcon\Mvc\ViewInterface
     * Interface for Phalcon\Mvc\View
     */
    interface ViewInterface extends \Phalcon\Mvc\ViewBaseInterface
    {
        /**
         * Sets the layouts sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
         *
         * @param string $layoutsDir 
         */
        public function setLayoutsDir($layoutsDir);
        /**
         * Gets the current layouts sub-directory
         *
         * @return string 
         */
        public function getLayoutsDir();
        /**
         * Sets a partials sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
         *
         * @param string $partialsDir 
         */
        public function setPartialsDir($partialsDir);
        /**
         * Gets the current partials sub-directory
         *
         * @return string 
         */
        public function getPartialsDir();
        /**
         * Sets base path. Depending of your platform, always add a trailing slash or backslash
         *
         * @param string $basePath 
         */
        public function setBasePath($basePath);
        /**
         * Gets base path
         *
         * @return string 
         */
        public function getBasePath();
        /**
         * Sets the render level for the view
         *
         * @param string $level 
         */
        public function setRenderLevel($level);
        /**
         * Sets default view name. Must be a file without extension in the views directory
         *
         * @param string $viewPath 
         */
        public function setMainView($viewPath);
        /**
         * Returns the name of the main view
         *
         * @return string 
         */
        public function getMainView();
        /**
         * Change the layout to be used instead of using the name of the latest controller name
         *
         * @param string $layout 
         */
        public function setLayout($layout);
        /**
         * Returns the name of the main view
         *
         * @return string 
         */
        public function getLayout();
        /**
         * Appends template before controller layout
         *
         * @param string|array $templateBefore 
         */
        public function setTemplateBefore($templateBefore);
        /**
         * Resets any template before layouts
         */
        public function cleanTemplateBefore();
        /**
         * Appends template after controller layout
         *
         * @param string|array $templateAfter 
         */
        public function setTemplateAfter($templateAfter);
        /**
         * Resets any template before layouts
         */
        public function cleanTemplateAfter();
        /**
         * Gets the name of the controller rendered
         *
         * @return string 
         */
        public function getControllerName();
        /**
         * Gets the name of the action rendered
         *
         * @return string 
         */
        public function getActionName();
        /**
         * Gets extra parameters of the action rendered
         *
         * @return array 
         */
        public function getParams();
        /**
         * Starts rendering process enabling the output buffering
         */
        public function start();
        /**
         * Register templating engines
         *
         * @param array $engines 
         */
        public function registerEngines(array $engines);
        /**
         * Executes render process from dispatching data
         *
         * @param string $controllerName 
         * @param string $actionName 
         * @param array $params 
         */
        public function render($controllerName, $actionName, $params = null);
        /**
         * Choose a view different to render than last-controller/last-action
         *
         * @param string $renderView 
         */
        public function pick($renderView);
        /**
         * Finishes the render process by stopping the output buffering
         */
        public function finish();
        /**
         * Returns the path of the view that is currently rendered
         *
         * @return string 
         */
        public function getActiveRenderPath();
        /**
         * Disables the auto-rendering process
         */
        public function disable();
        /**
         * Enables the auto-rendering process
         */
        public function enable();
        /**
         * Resets the view component to its factory default values
         */
        public function reset();
        /**
         * Whether the automatic rendering is disabled
         *
         * @return bool 
         */
        public function isDisabled();
    }
}

namespace \Phalcon\Mvc\Application {
    /**
     * Phalcon\Mvc\Application\Exception
     * Exceptions thrown in Phalcon\Mvc\Application class will use this class
     */
    class Exception extends \Phalcon\Application\Exception
    {
    }
}

namespace \Phalcon\Mvc\Collection {
    /**
     * Phalcon\Mvc\Collection\Behavior
     * This is an optional base class for ORM behaviors
     */
    abstract class Behavior
    {
        protected $_options;
        /**
         * Phalcon\Mvc\Collection\Behavior
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Checks whether the behavior must take action on certain event
         *
         * @param string $eventName 
         * @return bool 
         */
        protected function mustTakeAction($eventName) {}
        /**
         * Returns the behavior options related to an event
         *
         * @param string $eventName 
         * @return array 
         */
        protected function getOptions($eventName = null) {}
        /**
         * This method receives the notifications from the EventsManager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Acts as fallbacks when a missing method is called on the collection
         *
         * @param mixed $model 
         * @param string $method 
         * @param mixed $arguments 
         */
        public function missingMethod(\Phalcon\Mvc\CollectionInterface $model, $method, $arguments = null) {}
    }

    /**
     * Phalcon\Mvc\Collection\BehaviorInterface
     * Interface for Phalcon\Mvc\Collection\Behavior
     */
    interface BehaviorInterface
    {
        /**
         * This method receives the notifications from the EventsManager
         *
         * @param string $type 
         * @param mixed $collection 
         */
        public function notify($type, \Phalcon\Mvc\CollectionInterface $collection);
        /**
         * Calls a method when it's missing in the collection
         *
         * @param mixed $collection 
         * @param string $method 
         * @param mixed $arguments 
         */
        public function missingMethod(\Phalcon\Mvc\CollectionInterface $collection, $method, $arguments = null);
    }

    /**
     * Phalcon\Mvc\Collection\Document
     * This component allows Phalcon\Mvc\Collection to return rows without an associated entity.
     * This objects implements the ArrayAccess interface to allow access the object as object->x or array[x].
     */
    class Document implements \Phalcon\Mvc\EntityInterface, \ArrayAccess
    {
        /**
         * Checks whether an offset exists in the document
         *
         * @param int $index 
         * @return boolean 
         */
        public function offsetExists($index) {}
        /**
         * Returns the value of a field using the ArrayAccess interfase
         *
         * @param string $index 
         */
        public function offsetGet($index) {}
        /**
         * Change a value using the ArrayAccess interface
         *
         * @param string $index 
         * @param mixed $value 
         */
        public function offsetSet($index, $value) {}
        /**
         * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
         *
         * @param string $offset 
         */
        public function offsetUnset($offset) {}
        /**
         * Reads an attribute value by its name
         * <code>
         * echo $robot->readAttribute('name');
         * </code>
         *
         * @param string $attribute 
         * @return mixed 
         */
        public function readAttribute($attribute) {}
        /**
         * Writes an attribute value by its name
         * <code>
         * $robot->writeAttribute('name', 'Rosey');
         * </code>
         *
         * @param string $attribute 
         * @param mixed $value 
         */
        public function writeAttribute($attribute, $value) {}
        /**
         * Returns the instance as an array representation
         *
         * @return array 
         */
        public function toArray() {}
    }

    /**
     * Phalcon\Mvc\Collection\Exception
     * Exceptions thrown in Phalcon\Mvc\Collection\* classes will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Mvc\Collection\Manager
     * This components controls the initialization of models, keeping record of relations
     * between the different models of the application.
     * A CollectionManager is injected to a model via a Dependency Injector Container such as Phalcon\Di.
     * <code>
     * $di = new \Phalcon\Di();
     * $di->set('collectionManager', function(){
     * return new \Phalcon\Mvc\Collection\Manager();
     * });
     * $robot = new Robots($di);
     * </code>
     */
    class Manager implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
    {
        protected $_dependencyInjector;
        protected $_initialized;
        protected $_lastInitialized;
        protected $_eventsManager;
        protected $_customEventsManager;
        protected $_connectionServices;
        protected $_implicitObjectsIds;
        protected $_behaviors;
        protected $_serviceName = "mongo";
        public function getServiceName() {}
        /**
         * @param mixed $serviceName 
         */
        public function setServiceName($serviceName) {}
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the event manager
         *
         * @param mixed $eventsManager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets a custom events manager for a specific model
         *
         * @param mixed $model 
         * @param mixed $eventsManager 
         */
        public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns a custom events manager related to a model
         *
         * @param mixed $model 
         * @return mixed|null 
         */
        public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Initializes a model in the models manager
         *
         * @param mixed $model 
         */
        public function initialize(\Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Check whether a model is already initialized
         *
         * @param string $modelName 
         * @return bool 
         */
        public function isInitialized($modelName) {}
        /**
         * Get the latest initialized model
         *
         * @return \Phalcon\Mvc\CollectionInterface 
         */
        public function getLastInitialized() {}
        /**
         * Sets a connection service for a specific model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService) {}
        /**
         * Gets a connection service for a specific model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getConnectionService(\Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Sets whether a model must use implicit objects ids
         *
         * @param mixed $model 
         * @param bool $useImplicitObjectIds 
         */
        public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds) {}
        /**
         * Checks if a model is using implicit object ids
         *
         * @param mixed $model 
         * @return bool 
         */
        public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Returns the connection related to a model
         *
         * @param mixed $model 
         * @param \Phalcon\Mvc\CollectionInterface $$model 
         * @return \Mongo 
         */
        public function getConnection(\Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Receives events generated in the models and dispatches them to a events-manager if available
         * Notify the behaviors that are listening in the model
         *
         * @param string $eventName 
         * @param mixed $model 
         */
        public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model) {}
        /**
         * Dispatch a event to the listeners and behaviors
         * This method expects that the endpoint listeners/behaviors returns true
         * meaning that a least one was implemented
         *
         * @param mixed $model 
         * @param string $eventName 
         * @param mixed $data 
         * @return bool 
         */
        public function missingMethod(\Phalcon\Mvc\CollectionInterface $model, $eventName, $data) {}
        /**
         * Binds a behavior to a model
         *
         * @param mixed $model 
         * @param mixed $behavior 
         */
        public function addBehavior(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Mvc\Collection\BehaviorInterface $behavior) {}
    }

    /**
     * Phalcon\Mvc\Collection\Manager
     * This components controls the initialization of models, keeping record of relations
     * between the different models of the application.
     * A CollectionManager is injected to a model via a Dependency Injector Container such as Phalcon\Di.
     * <code>
     * $di = new \Phalcon\Di();
     * $di->set('collectionManager', function() {
     * return new \Phalcon\Mvc\Collection\Manager();
     * });
     * $robot = new Robots(di);
     * </code>
     */
    interface ManagerInterface
    {
        /**
         * Sets a custom events manager for a specific model
         *
         * @param mixed $model 
         * @param mixed $eventsManager 
         */
        public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager);
        /**
         * Returns a custom events manager related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model);
        /**
         * Initializes a model in the models manager
         *
         * @param mixed $model 
         */
        public function initialize(\Phalcon\Mvc\CollectionInterface $model);
        /**
         * Check whether a model is already initialized
         *
         * @param string $modelName 
         * @return bool 
         */
        public function isInitialized($modelName);
        /**
         * Get the latest initialized model
         *
         * @return \Phalcon\Mvc\CollectionInterface 
         */
        public function getLastInitialized();
        /**
         * Sets a connection service for a specific model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService);
        /**
         * Sets if a model must use implicit objects ids
         *
         * @param mixed $model 
         * @param bool $useImplicitObjectIds 
         */
        public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds);
        /**
         * Checks if a model is using implicit object ids
         *
         * @param mixed $model 
         * @return bool 
         */
        public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model);
        /**
         * Returns the connection related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getConnection(\Phalcon\Mvc\CollectionInterface $model);
        /**
         * Receives events generated in the models and dispatches them to a events-manager if available
         * Notify the behaviors that are listening in the model
         *
         * @param string $eventName 
         * @param mixed $model 
         */
        public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model);
        /**
         * Binds a behavior to a collection
         *
         * @param mixed $model 
         * @param mixed $behavior 
         */
        public function addBehavior(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Mvc\Collection\BehaviorInterface $behavior);
    }
}

namespace \Phalcon\Mvc\Collection\Behavior {
    /**
     * Phalcon\Mvc\Collection\Behavior\SoftDelete
     * Instead of permanently delete a record it marks the record as
     * deleted changing the value of a flag column
     */
    class SoftDelete extends \Phalcon\Mvc\Collection\Behavior implements \Phalcon\Mvc\Collection\BehaviorInterface
    {
        /**
         * Listens for notifications from the models manager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}
    }

    /**
     * Phalcon\Mvc\Collection\Behavior\Timestampable
     * Allows to automatically update a model’s attribute saving the
     * datetime when a record is created or updated
     */
    class Timestampable extends \Phalcon\Mvc\Collection\Behavior implements \Phalcon\Mvc\Collection\BehaviorInterface
    {
        /**
         * Listens for notifications from the models manager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}
    }
}

namespace \Phalcon\Mvc\Controller {
    /**
     * Phalcon\Mvc\Controller\BindModelInterface
     * Interface for Phalcon\Mvc\Controller
     */
    interface BindModelInterface
    {
        /**
         * Return the model name associated with this controller
         *
         * @return string 
         */
        abstract static function getModelName();
    }
}

namespace \Phalcon\Mvc\Dispatcher {
    /**
     * Phalcon\Mvc\Dispatcher\Exception
     * Exceptions thrown in Phalcon\Mvc\Dispatcher will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Mvc\Micro {
    /**
     * Phalcon\Mvc\Micro\Collection
     * Groups Micro-Mvc handlers as controllers
     * <code>
     * $app = new \Phalcon\Mvc\Micro();
     * $collection = new Collection();
     * $collection->setHandler(new PostsController());
     * $collection->get('/posts/edit/{id}', 'edit');
     * $app->mount($collection);
     * </code>
     */
    class Collection implements \Phalcon\Mvc\Micro\CollectionInterface
    {
        protected $_prefix;
        protected $_lazy;
        protected $_handler;
        protected $_handlers;
        /**
         * Internal function to add a handler to the group
         *
         * @param string|array $method 
         * @param string $routePattern 
         * @param mixed $handler 
         * @param string $name 
         */
        protected function _addMap($method, $routePattern, $handler, $name) {}
        /**
         * Sets a prefix for all routes added to the collection
         *
         * @param string $prefix 
         * @return Collection 
         */
        public function setPrefix($prefix) {}
        /**
         * Returns the collection prefix if any
         *
         * @return string 
         */
        public function getPrefix() {}
        /**
         * Returns the registered handlers
         *
         * @return array 
         */
        public function getHandlers() {}
        /**
         * Sets the main handler
         *
         * @param mixed $handler 
         * @param boolean $lazy 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function setHandler($handler, $lazy = false) {}
        /**
         * Sets if the main handler must be lazy loaded
         *
         * @param bool $lazy 
         * @return Collection 
         */
        public function setLazy($lazy) {}
        /**
         * Returns if the main handler must be lazy loaded
         *
         * @return bool 
         */
        public function isLazy() {}
        /**
         * Returns the main handler
         *
         * @return mixed 
         */
        public function getHandler() {}
        /**
         * Maps a route to a handler
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function map($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is GET
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function get($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is POST
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function post($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is PUT
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function put($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is PATCH
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function patch($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is HEAD
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function head($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is DELETE
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function delete($routePattern, $handler, $name = null) {}
        /**
         * Maps a route to a handler that only matches if the HTTP method is OPTIONS
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param mixed $name 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function options($routePattern, $handler, $name = null) {}
    }

    /**
     * Phalcon\Mvc\Micro\CollectionInterface
     * Interface for Phalcon\Mvc\Micro\Collection
     */
    interface CollectionInterface
    {
        /**
         * Sets a prefix for all routes added to the collection
         *
         * @param string $prefix 
         * @return CollectionInterface 
         */
        public function setPrefix($prefix);
        /**
         * Returns the collection prefix if any
         *
         * @return string 
         */
        public function getPrefix();
        /**
         * Returns the registered handlers
         *
         * @return array 
         */
        public function getHandlers();
        /**
         * Sets the main handler
         *
         * @param mixed $handler 
         * @param boolean $lazy 
         * @return \Phalcon\Mvc\Micro\Collection 
         */
        public function setHandler($handler, $lazy = false);
        /**
         * Sets if the main handler must be lazy loaded
         *
         * @param bool $lazy 
         * @return CollectionInterface 
         */
        public function setLazy($lazy);
        /**
         * Returns if the main handler must be lazy loaded
         *
         * @return bool 
         */
        public function isLazy();
        /**
         * Returns the main handler
         *
         * @return mixed 
         */
        public function getHandler();
        /**
         * Maps a route to a handler
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function map($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is GET
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function get($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is POST
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function post($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is PUT
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function put($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is PATCH
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function patch($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is HEAD
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function head($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is DELETE
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function delete($routePattern, $handler, $name = null);
        /**
         * Maps a route to a handler that only matches if the HTTP method is OPTIONS
         *
         * @param string $routePattern 
         * @param callable $handler 
         * @param string $name 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function options($routePattern, $handler, $name = null);
    }

    /**
     * Phalcon\Mvc\Micro\Exception
     * Exceptions thrown in Phalcon\Mvc\Micro will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Mvc\Micro\LazyLoader
     * Lazy-Load of handlers for Mvc\Micro using auto-loading
     */
    class LazyLoader
    {
        protected $_handler;
        protected $_definition;
        public function getDefinition() {}
        /**
         * Phalcon\Mvc\Micro\LazyLoader constructor
         *
         * @param string $definition 
         */
        public function __construct($definition) {}
        /**
         * Initializes the internal handler, calling functions on it
         *
         * @param string $method 
         * @param array $arguments 
         * @return mixed 
         */
        public function __call($method, $arguments) {}
    }

    /**
     * Phalcon\Mvc\Micro\MiddlewareInterface
     * Allows to implement Phalcon\Mvc\Micro middleware in classes
     */
    interface MiddlewareInterface
    {
        /**
         * Calls the middleware
         *
         * @param mixed $application 
         */
        public function call(\Phalcon\Mvc\Micro $application);
    }
}

namespace \Phalcon\Mvc\Model {
    /**
     * Phalcon\Mvc\Model\Behavior
     * This is an optional base class for ORM behaviors
     */
    abstract class Behavior implements \Phalcon\Mvc\Model\BehaviorInterface
    {
        protected $_options;
        /**
         * Phalcon\Mvc\Model\Behavior
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Checks whether the behavior must take action on certain event
         *
         * @param string $eventName 
         * @return bool 
         */
        protected function mustTakeAction($eventName) {}
        /**
         * Returns the behavior options related to an event
         *
         * @param string $eventName 
         * @return array 
         */
        protected function getOptions($eventName = null) {}
        /**
         * This method receives the notifications from the EventsManager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Acts as fallbacks when a missing method is called on the model
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param string $method 
         * @param array $arguments 
         */
        public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $method, $arguments = null) {}
    }

    /**
     * Phalcon\Mvc\Model\BehaviorInterface
     * Interface for Phalcon\Mvc\Model\Behavior
     */
    interface BehaviorInterface
    {
        /**
         * This method receives the notifications from the EventsManager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\ModelInterface $model);
        /**
         * Calls a method when it's missing in the model
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param string $method 
         * @param array $arguments 
         */
        public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $method, $arguments = null);
    }

    /**
     * Phalcon\Mvc\Model\Criteria
     * This class is used to build the array parameter required by
     * Phalcon\Mvc\Model::find() and Phalcon\Mvc\Model::findFirst()
     * using an object-oriented interface.
     * <code>
     * $robots = Robots::query()
     * ->where("type = :type:")
     * ->andWhere("year < 2000")
     * ->bind(array("type" => "mechanical"))
     * ->limit(5, 10)
     * ->orderBy("name")
     * ->execute();
     * </code>
     */
    class Criteria implements \Phalcon\Mvc\Model\CriteriaInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_model;
        protected $_params;
        protected $_bindParams;
        protected $_bindTypes;
        protected $_hiddenParamNumber = 0;
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return null|\Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Set a model on which the query will be executed
         *
         * @param string $modelName 
         * @return Criteria 
         */
        public function setModelName($modelName) {}
        /**
         * Returns an internal model name on which the criteria will be applied
         *
         * @return string 
         */
        public function getModelName() {}
        /**
         * Sets the bound parameters in the criteria
         * This method replaces all previously set bound parameters
         *
         * @param array $bindParams 
         * @param bool $merge 
         * @return Criteria 
         */
        public function bind(array $bindParams, $merge = false) {}
        /**
         * Sets the bind types in the criteria
         * This method replaces all previously set bound parameters
         *
         * @param array $bindTypes 
         * @return Criteria 
         */
        public function bindTypes(array $bindTypes) {}
        /**
         * Sets SELECT DISTINCT / SELECT ALL flag
         *
         * @param mixed $distinct 
         * @return Criteria 
         */
        public function distinct($distinct) {}
        /**
         * Sets the columns to be queried
         * <code>
         * $criteria->columns(array('id', 'name'));
         * </code>
         *
         * @param string|array $columns 
         * @return \Phalcon\Mvc\Model\Criteria 
         */
        public function columns($columns) {}
        /**
         * Adds a INNER join to the query
         * <code>
         * $criteria->join('Robots');
         * $criteria->join('Robots', 'r.id = RobotsParts.robots_id');
         * $criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * $criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
         * </code>
         *
         * @param string $model 
         * @param mixed $conditions 
         * @param mixed $alias 
         * @param mixed $type 
         * @return Criteria 
         */
        public function join($model, $conditions = null, $alias = null, $type = null) {}
        /**
         * Adds a INNER join to the query
         * <code>
         * $criteria->innerJoin('Robots');
         * $criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id');
         * $criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param mixed $conditions 
         * @param mixed $alias 
         * @return Criteria 
         */
        public function innerJoin($model, $conditions = null, $alias = null) {}
        /**
         * Adds a LEFT join to the query
         * <code>
         * $criteria->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param mixed $conditions 
         * @param mixed $alias 
         * @return Criteria 
         */
        public function leftJoin($model, $conditions = null, $alias = null) {}
        /**
         * Adds a RIGHT join to the query
         * <code>
         * $criteria->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param mixed $conditions 
         * @param mixed $alias 
         * @return Criteria 
         */
        public function rightJoin($model, $conditions = null, $alias = null) {}
        /**
         * Sets the conditions parameter in the criteria
         *
         * @param string $conditions 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return Criteria 
         */
        public function where($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a condition to the current conditions using an AND operator (deprecated)
         *
         * @deprecated 1.0.0
         * @see \Phalcon\Mvc\Model\Criteria::andWhere()
         * @param string $conditions 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return Criteria 
         */
        public function addWhere($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a condition to the current conditions using an AND operator
         *
         * @param string $conditions 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return Criteria 
         */
        public function andWhere($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a condition to the current conditions using an OR operator
         *
         * @param string $conditions 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @return Criteria 
         */
        public function orWhere($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a BETWEEN condition to the current conditions
         * <code>
         * $criteria->betweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @return Criteria 
         */
        public function betweenWhere($expr, $minimum, $maximum) {}
        /**
         * Appends a NOT BETWEEN condition to the current conditions
         * <code>
         * $criteria->notBetweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @return Criteria 
         */
        public function notBetweenWhere($expr, $minimum, $maximum) {}
        /**
         * Appends an IN condition to the current conditions
         * <code>
         * $criteria->inWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @return Criteria 
         */
        public function inWhere($expr, array $values) {}
        /**
         * Appends a NOT IN condition to the current conditions
         * <code>
         * $criteria->notInWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @return Criteria 
         */
        public function notInWhere($expr, array $values) {}
        /**
         * Adds the conditions parameter to the criteria
         *
         * @param string $conditions 
         * @return Criteria 
         */
        public function conditions($conditions) {}
        /**
         * Adds the order-by parameter to the criteria (deprecated)
         *
         * @deprecated 1.2.1
         * @see \Phalcon\Mvc\Model\Criteria::orderBy()
         * @param string $orderColumns 
         * @return Criteria 
         */
        public function order($orderColumns) {}
        /**
         * Adds the order-by clause to the criteria
         *
         * @param string $orderColumns 
         * @return Criteria 
         */
        public function orderBy($orderColumns) {}
        /**
         * Adds the group-by clause to the criteria
         *
         * @param mixed $group 
         * @return Criteria 
         */
        public function groupBy($group) {}
        /**
         * Adds the having clause to the criteria
         *
         * @param mixed $having 
         * @return Criteria 
         */
        public function having($having) {}
        /**
         * Adds the limit parameter to the criteria
         *
         * @param mixed $limit 
         * @param mixed $offset 
         * @return Criteria 
         */
        public function limit($limit, $offset = null) {}
        /**
         * Adds the "for_update" parameter to the criteria
         *
         * @param bool $forUpdate 
         * @return Criteria 
         */
        public function forUpdate($forUpdate = true) {}
        /**
         * Adds the "shared_lock" parameter to the criteria
         *
         * @param bool $sharedLock 
         * @return Criteria 
         */
        public function sharedLock($sharedLock = true) {}
        /**
         * Sets the cache options in the criteria
         * This method replaces all previously set cache options
         *
         * @param array $cache 
         * @return Criteria 
         */
        public function cache(array $cache) {}
        /**
         * Returns the conditions parameter in the criteria
         *
         * @return string|null 
         */
        public function getWhere() {}
        /**
         * Returns the columns to be queried
         *
         * @return string|array|null 
         */
        public function getColumns() {}
        /**
         * Returns the conditions parameter in the criteria
         *
         * @return string|null 
         */
        public function getConditions() {}
        /**
         * Returns the limit parameter in the criteria, which will be
         * an integer if limit was set without an offset,
         * an array with 'number' and 'offset' keys if an offset was set with the limit,
         * or null if limit has not been set.
         *
         * @return int|array|null 
         */
        public function getLimit() {}
        /**
         * Returns the order clause in the criteria
         *
         * @return string|null 
         */
        public function getOrderBy() {}
        /**
         * Returns the group clause in the criteria
         */
        public function getGroupBy() {}
        /**
         * Returns the having clause in the criteria
         */
        public function getHaving() {}
        /**
         * Returns all the parameters defined in the criteria
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Builds a Phalcon\Mvc\Model\Criteria based on an input array like _POST
         *
         * @param mixed $dependencyInjector 
         * @param string $modelName 
         * @param array $data 
         * @param string $operator 
         * @return Criteria 
         */
        public static function fromInput(\Phalcon\DiInterface $dependencyInjector, $modelName, array $data, $operator = "AND") {}
        /**
         * Executes a find using the parameters built with the criteria
         *
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function execute() {}
    }

    /**
     * Phalcon\Mvc\Model\CriteriaInterface
     * Interface for Phalcon\Mvc\Model\Criteria
     */
    interface CriteriaInterface
    {
        /**
         * Set a model on which the query will be executed
         *
         * @param string $modelName 
         * @return CriteriaInterface 
         */
        public function setModelName($modelName);
        /**
         * Returns an internal model name on which the criteria will be applied
         *
         * @return string 
         */
        public function getModelName();
        /**
         * Sets the bound parameters in the criteria
         * This method replaces all previously set bound parameters
         *
         * @param array $bindParams 
         * @return CriteriaInterface 
         */
        public function bind(array $bindParams);
        /**
         * Sets the bind types in the criteria
         * This method replaces all previously set bound parameters
         *
         * @param array $bindTypes 
         * @return CriteriaInterface 
         */
        public function bindTypes(array $bindTypes);
        /**
         * Sets the conditions parameter in the criteria
         *
         * @param string $conditions 
         * @return CriteriaInterface 
         */
        public function where($conditions);
        /**
         * Adds the conditions parameter to the criteria
         *
         * @param string $conditions 
         * @return CriteriaInterface 
         */
        public function conditions($conditions);
        /**
         * Adds the order-by parameter to the criteria
         *
         * @param string $orderColumns 
         * @return CriteriaInterface 
         */
        public function orderBy($orderColumns);
        /**
         * Sets the limit parameter to the criteria
         *
         * @param int $limit 
         * @param int $offset 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public function limit($limit, $offset = null);
        /**
         * Sets the "for_update" parameter to the criteria
         *
         * @param bool $forUpdate 
         * @return CriteriaInterface 
         */
        public function forUpdate($forUpdate = true);
        /**
         * Sets the "shared_lock" parameter to the criteria
         *
         * @param bool $sharedLock 
         * @return CriteriaInterface 
         */
        public function sharedLock($sharedLock = true);
        /**
         * Appends a condition to the current conditions using an AND operator
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public function andWhere($conditions, $bindParams = null, $bindTypes = null);
        /**
         * Appends a condition to the current conditions using an OR operator
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public function orWhere($conditions, $bindParams = null, $bindTypes = null);
        /**
         * Appends a BETWEEN condition to the current conditions
         * <code>
         * $criteria->betweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public function betweenWhere($expr, $minimum, $maximum);
        /**
         * Appends a NOT BETWEEN condition to the current conditions
         * <code>
         * $criteria->notBetweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @return \Phalcon\Mvc\Model\CriteriaInterface 
         */
        public function notBetweenWhere($expr, $minimum, $maximum);
        /**
         * Appends an IN condition to the current conditions
         * <code>
         * $criteria->inWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @return CriteriaInterface 
         */
        public function inWhere($expr, array $values);
        /**
         * Appends a NOT IN condition to the current conditions
         * <code>
         * $criteria->notInWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @return CriteriaInterface 
         */
        public function notInWhere($expr, array $values);
        /**
         * Returns the conditions parameter in the criteria
         *
         * @return string|null 
         */
        public function getWhere();
        /**
         * Returns the conditions parameter in the criteria
         *
         * @return string|null 
         */
        public function getConditions();
        /**
         * Returns the limit parameter in the criteria, which will be
         * an integer if limit was set without an offset,
         * an array with 'number' and 'offset' keys if an offset was set with the limit,
         * or null if limit has not been set.
         *
         * @return int|array|null 
         */
        public function getLimit();
        /**
         * Returns the order parameter in the criteria
         *
         * @return string|null 
         */
        public function getOrderBy();
        /**
         * Returns all the parameters defined in the criteria
         *
         * @return array 
         */
        public function getParams();
        /**
         * Executes a find using the parameters built with the criteria
         *
         * @return ResultsetInterface 
         */
        public function execute();
    }

    /**
     * Phalcon\Mvc\Model\Exception
     * Exceptions thrown in Phalcon\Mvc\Model\* classes will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Mvc\Model\Manager
     * This components controls the initialization of models, keeping record of relations
     * between the different models of the application.
     * A ModelsManager is injected to a model via a Dependency Injector/Services Container such as Phalcon\Di.
     * <code>
     * use Phalcon\Di;
     * use Phalcon\Mvc\Model\Manager as ModelsManager;
     * $di = new Di();
     * $di->set('modelsManager', function() {
     * return new ModelsManager();
     * });
     * $robot = new Robots($di);
     * </code>
     */
    class Manager implements \Phalcon\Mvc\Model\ManagerInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
    {
        protected $_dependencyInjector;
        protected $_eventsManager;
        protected $_customEventsManager;
        protected $_readConnectionServices;
        protected $_writeConnectionServices;
        protected $_aliases;
        /**
         * Has many relations
         */
        protected $_hasMany;
        /**
         * Has many relations by model
         */
        protected $_hasManySingle;
        /**
         * Has one relations
         */
        protected $_hasOne;
        /**
         * Has one relations by model
         */
        protected $_hasOneSingle;
        /**
         * Belongs to relations
         */
        protected $_belongsTo;
        /**
         * All the relationships by model
         */
        protected $_belongsToSingle;
        /**
         * Has many-Through relations
         */
        protected $_hasManyToMany;
        /**
         * Has many-Through relations by model
         */
        protected $_hasManyToManySingle;
        /**
         * Mark initialized models
         */
        protected $_initialized;
        protected $_sources;
        protected $_schemas;
        /**
         * Models' behaviors
         */
        protected $_behaviors;
        /**
         * Last model initialized
         */
        protected $_lastInitialized;
        /**
         * Last query created/executed
         */
        protected $_lastQuery;
        /**
         * Stores a list of reusable instances
         */
        protected $_reusable;
        protected $_keepSnapshots;
        /**
         * Does the model use dynamic update, instead of updating all rows?
         */
        protected $_dynamicUpdate;
        protected $_namespaceAliases;
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets a global events manager
         *
         * @param mixed $eventsManager 
         * @return Manager 
         */
        public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface 
         */
        public function getEventsManager() {}
        /**
         * Sets a custom events manager for a specific model
         *
         * @param mixed $model 
         * @param mixed $eventsManager 
         */
        public function setCustomEventsManager(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Events\ManagerInterface $eventsManager) {}
        /**
         * Returns a custom events manager related to a model
         *
         * @param mixed $model 
         * @return bool|\Phalcon\Events\ManagerInterface 
         */
        public function getCustomEventsManager(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Initializes a model in the model manager
         *
         * @param mixed $model 
         * @return bool 
         */
        public function initialize(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Check whether a model is already initialized
         *
         * @param string $modelName 
         * @return bool 
         */
        public function isInitialized($modelName) {}
        /**
         * Get last initialized model
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getLastInitialized() {}
        /**
         * Loads a model throwing an exception if it doesn't exist
         *
         * @param string $modelName 
         * @param bool $newInstance 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function load($modelName, $newInstance = false) {}
        /**
         * Sets the mapped source for a model
         *
         * @param mixed $model 
         * @param string $source 
         */
        public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source) {}
        /**
         * Returns the mapped source for a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getModelSource(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Sets the mapped schema for a model
         *
         * @param mixed $model 
         * @param string $schema 
         */
        public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema) {}
        /**
         * Returns the mapped schema for a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getModelSchema(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Sets both write and read connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService) {}
        /**
         * Sets write connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService) {}
        /**
         * Sets read connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService) {}
        /**
         * Returns the connection to read data related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getReadConnection(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the connection to write data related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the connection to read or write data related to a model depending on the connection services.
         *
         * @param mixed $model 
         * @param mixed $connectionServices 
         * @return \Phalcon\Db\AdapterInterface 
         */
        protected function _getConnection(\Phalcon\Mvc\ModelInterface $model, $connectionServices) {}
        /**
         * Returns the connection service name used to read data related to a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the connection service name used to write data related to a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the connection service name used to read or write data related to a model depending on the connection services
         *
         * @param mixed $model 
         * @param mixed $connectionServices 
         * @return string 
         */
        public function _getConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionServices) {}
        /**
         * Receives events generated in the models and dispatches them to a events-manager if available
         * Notify the behaviors that are listening in the model
         *
         * @param string $eventName 
         * @param mixed $model 
         */
        public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Dispatch a event to the listeners and behaviors
         * This method expects that the endpoint listeners/behaviors returns true
         * meaning that a least one was implemented
         *
         * @param mixed $model 
         * @param string $eventName 
         * @param mixed $data 
         */
        public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data) {}
        /**
         * Binds a behavior to a model
         *
         * @param mixed $model 
         * @param mixed $behavior 
         */
        public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior) {}
        /**
         * Sets if a model must keep snapshots
         *
         * @param mixed $model 
         * @param bool $keepSnapshots 
         */
        public function keepSnapshots(\Phalcon\Mvc\ModelInterface $model, $keepSnapshots) {}
        /**
         * Checks if a model is keeping snapshots for the queried records
         *
         * @param mixed $model 
         * @return bool 
         */
        public function isKeepingSnapshots(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Sets if a model must use dynamic update instead of the all-field update
         *
         * @param mixed $model 
         * @param bool $dynamicUpdate 
         */
        public function useDynamicUpdate(\Phalcon\Mvc\ModelInterface $model, $dynamicUpdate) {}
        /**
         * Checks if a model is using dynamic update instead of all-field update
         *
         * @param mixed $model 
         * @return bool 
         */
        public function isUsingDynamicUpdate(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Setup a 1-1 relation between two models
         *
         * @param	mixed fields
         * @param	string referencedModel
         * @param	mixed referencedFields
         * @param	array options
         * @param \Phalcon\Mvc\Model $model 
         * @param mixed $fields 
         * @param string $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null) {}
        /**
         * Setup a relation reverse many to one between two models
         *
         * @param	mixed fields
         * @param	string referencedModel
         * @param	mixed referencedFields
         * @param	array options
         * @param \Phalcon\Mvc\Model $model 
         * @param mixed $fields 
         * @param string $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null) {}
        /**
         * Setup a relation 1-n between two models
         *
         * @param	mixed fields
         * @param	string referencedModel
         * @param	mixed referencedFields
         * @param	array options
         * @param mixed $model 
         * @param mixed $fields 
         * @param string $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @param  $Phalcon\Mvc\ModelInterface model
         * @return \Phalcon\Mvc\Model\Relation 
         */
        public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null) {}
        /**
         * Setups a relation n-m between two models
         *
         * @param	string fields
         * @param	string intermediateModel
         * @param	string intermediateFields
         * @param	string intermediateReferencedFields
         * @param	string referencedModel
         * @param	string referencedFields
         * @param mixed $model 
         * @param mixed $fields 
         * @param string $intermediateModel 
         * @param mixed $intermediateFields 
         * @param mixed $intermediateReferencedFields 
         * @param string $referencedModel 
         * @param mixed $referencedFields 
         * @param array $options 
         * @param  $Phalcon\Mvc\ModelInterface model
         * @return \Phalcon\Mvc\Model\Relation 
         */
        public function addHasManyToMany(\Phalcon\Mvc\ModelInterface $model, $fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referencedModel, $referencedFields, $options = null) {}
        /**
         * Checks whether a model has a belongsTo relation with another model
         *
         * @param string $modelName 
         * @param string $modelRelation 
         * @return bool 
         */
        public function existsBelongsTo($modelName, $modelRelation) {}
        /**
         * Checks whether a model has a hasMany relation with another model
         *
         * @param string $modelName 
         * @param string $modelRelation 
         * @return bool 
         */
        public function existsHasMany($modelName, $modelRelation) {}
        /**
         * Checks whether a model has a hasOne relation with another model
         *
         * @param string $modelName 
         * @param string $modelRelation 
         * @return bool 
         */
        public function existsHasOne($modelName, $modelRelation) {}
        /**
         * Checks whether a model has a hasManyToMany relation with another model
         *
         * @param string $modelName 
         * @param string $modelRelation 
         * @return bool 
         */
        public function existsHasManyToMany($modelName, $modelRelation) {}
        /**
         * Returns a relation by its alias
         *
         * @param string $modelName 
         * @param string $alias 
         * @return bool|\Phalcon\Mvc\Model\Relation 
         */
        public function getRelationByAlias($modelName, $alias) {}
        /**
         * Merge two arrays of find parameters
         *
         * @param mixed $findParamsOne 
         * @param mixed $findParamsTwo 
         * @return array 
         */
        protected final function _mergeFindParameters($findParamsOne, $findParamsTwo) {}
        /**
         * Helper method to query records based on a relation definition
         *
         * @param mixed $relation 
         * @param string $method 
         * @param mixed $record 
         * @param mixed $parameters 
         * @return \Phalcon\Mvc\Model\Resultset\Simple|Phalcon\Mvc\Model\Resultset\Simple|int|false 
         */
        public function getRelationRecords(\Phalcon\Mvc\Model\RelationInterface $relation, $method, \Phalcon\Mvc\ModelInterface $record, $parameters = null) {}
        /**
         * Returns a reusable object from the internal list
         *
         * @param string $modelName 
         * @param string $key 
         */
        public function getReusableRecords($modelName, $key) {}
        /**
         * Stores a reusable record in the internal list
         *
         * @param string $modelName 
         * @param string $key 
         * @param mixed $records 
         */
        public function setReusableRecords($modelName, $key, $records) {}
        /**
         * Clears the internal reusable list
         */
        public function clearReusableObjects() {}
        /**
         * Gets belongsTo related records from a model
         *
         * @param string $method 
         * @param string $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @return bool|\Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null) {}
        /**
         * Gets hasMany related records from a model
         *
         * @param string $method 
         * @param string $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @return bool|\Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null) {}
        /**
         * Gets belongsTo related records from a model
         *
         * @param string $method 
         * @param string $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @return bool|\Phalcon\Mvc\ModelInterface 
         */
        public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null) {}
        /**
         * Gets all the belongsTo relations defined in a model
         * <code>
         * $relations = $modelsManager->getBelongsTo(new Robots());
         * </code>
         *
         * @param mixed $model 
         * @return array|RelationInterface[] 
         */
        public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Gets hasMany relations defined on a model
         *
         * @param mixed $model 
         * @return array|RelationInterface[] 
         */
        public function getHasMany(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Gets hasOne relations defined on a model
         *
         * @param mixed $model 
         * @return array 
         */
        public function getHasOne(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Gets hasManyToMany relations defined on a model
         *
         * @param mixed $model 
         * @return array|RelationInterface[] 
         */
        public function getHasManyToMany(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Gets hasOne relations defined on a model
         *
         * @param mixed $model 
         * @return RelationInterface[] 
         */
        public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Query all the relationships defined on a model
         *
         * @param string $modelName 
         * @return RelationInterface[] 
         */
        public function getRelations($modelName) {}
        /**
         * Query the first relationship defined between two models
         *
         * @param string $first 
         * @param string $second 
         * @return bool|RelationInterface[] 
         */
        public function getRelationsBetween($first, $second) {}
        /**
         * Creates a Phalcon\Mvc\Model\Query without execute it
         *
         * @param string $phql 
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function createQuery($phql) {}
        /**
         * Creates a Phalcon\Mvc\Model\Query and execute it
         *
         * @param string $phql 
         * @param mixed $placeholders 
         * @param mixed $types 
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function executeQuery($phql, $placeholders = null, $types = null) {}
        /**
         * Creates a Phalcon\Mvc\Model\Query\Builder
         *
         * @param mixed $params 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function createBuilder($params = null) {}
        /**
         * Returns the last query created or executed in the models manager
         *
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function getLastQuery() {}
        /**
         * Registers shorter aliases for namespaces in PHQL statements
         *
         * @param string $alias 
         * @param string $namespaceName 
         */
        public function registerNamespaceAlias($alias, $namespaceName) {}
        /**
         * Returns a real namespace from its alias
         *
         * @param string $alias 
         * @return string 
         */
        public function getNamespaceAlias($alias) {}
        /**
         * Returns all the registered namespace aliases
         *
         * @return array 
         */
        public function getNamespaceAliases() {}
        /**
         * Destroys the current PHQL cache
         */
        public function __destruct() {}
    }

    /**
     * Phalcon\Mvc\Model\ManagerInterface
     * Interface for Phalcon\Mvc\Model\Manager
     */
    interface ManagerInterface
    {
        /**
         * Initializes a model in the model manager
         *
         * @param mixed $model 
         */
        public function initialize(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Sets the mapped source for a model
         *
         * @param mixed $model 
         * @param string $source 
         */
        public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source);
        /**
         * Returns the mapped source for a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getModelSource(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Sets the mapped schema for a model
         *
         * @param mixed $model 
         * @param string $schema 
         */
        public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema);
        /**
         * Returns the mapped schema for a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getModelSchema(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Sets both write and read connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);
        /**
         * Sets read connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);
        /**
         * Returns the connection service name used to read data related to a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Sets write connection service for a model
         *
         * @param mixed $model 
         * @param string $connectionService 
         */
        public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);
        /**
         * Returns the connection service name used to write data related to a model
         *
         * @param mixed $model 
         * @return string 
         */
        public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns the connection to read data related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getReadConnection(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns the connection to write data related to a model
         *
         * @param mixed $model 
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Check of a model is already initialized
         *
         * @param string $modelName 
         * @return bool 
         */
        public function isInitialized($modelName);
        /**
         * Get last initialized model
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getLastInitialized();
        /**
         * Loads a model throwing an exception if it doesn't exist
         *
         * @param string $modelName 
         * @param bool $newInstance 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function load($modelName, $newInstance = false);
        /**
         * Setup a 1-1 relation between two models
         *
         * @param	mixed $fields
         * @param	string $referencedModel
         * @param	mixed $referencedFields
         * @param	array $options
         * @param mixed $model 
         * @param mixed $fields 
         * @param mixed $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @param \Phalcon\Mvc\ModelInterface $$model 
         * @return \Phalcon\Mvc\Model\RelationInterface 
         */
        public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);
        /**
         * Setup a relation reverse 1-1  between two models
         *
         * @param	mixed $fields
         * @param	string $referencedModel
         * @param	mixed $referencedFields
         * @param	array $options
         * @param mixed $model 
         * @param mixed $fields 
         * @param mixed $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @param  $\Phalcon\Mvc\ModelInterface $model
         * @return  
         */
        public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);
        /**
         * Setup a relation 1-n between two models
         *
         * @param	mixed $fields
         * @param	string $referencedModel
         * @param	mixed $referencedFields
         * @param	array $options
         * @param mixed $model 
         * @param mixed $fields 
         * @param mixed $referencedModel 
         * @param mixed $referencedFields 
         * @param mixed $options 
         * @param  $\Phalcon\Mvc\ModelInterface $model
         * @return  
         */
        public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);
        /**
         * Checks whether a model has a belongsTo relation with another model
         *
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param  $string $modelRelation
         * @return  
         */
        public function existsBelongsTo($modelName, $modelRelation);
        /**
         * Checks whether a model has a hasMany relation with another model
         *
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param  $string $modelRelation
         * @return  
         */
        public function existsHasMany($modelName, $modelRelation);
        /**
         * Checks whether a model has a hasOne relation with another model
         *
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param  $string $modelRelation
         * @return  
         */
        public function existsHasOne($modelName, $modelRelation);
        /**
         * Gets belongsTo related records from a model
         *
         * @param mixed $method 
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @param string $$method 
         * @param string $$modelName 
         * @param string $$modelRelation 
         * @param \Phalcon\Mvc\Model $$record 
         * @param array $$parameters 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);
        /**
         * Gets hasMany related records from a model
         *
         * @param mixed $method 
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @param string $$method 
         * @param string $$modelName 
         * @param string $$modelRelation 
         * @param \Phalcon\Mvc\Model $$record 
         * @param array $$parameters 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);
        /**
         * Gets belongsTo related records from a model
         *
         * @param mixed $method 
         * @param mixed $modelName 
         * @param mixed $modelRelation 
         * @param mixed $record 
         * @param mixed $parameters 
         * @param string $$method 
         * @param string $$modelName 
         * @param string $$modelRelation 
         * @param \Phalcon\Mvc\Model $$record 
         * @param array $$parameters 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);
        /**
         * Gets belongsTo relations defined on a model
         *
         * @param mixed $model 
         * @param \Phalcon\Mvc\ModelInterface $$model 
         * @return array 
         */
        public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Gets hasMany relations defined on a model
         *
         * @param mixed $model 
         * @param \Phalcon\Mvc\ModelInterface $$model 
         * @return array 
         */
        public function getHasMany(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Gets hasOne relations defined on a model
         *
         * @param mixed $model 
         * @param \Phalcon\Mvc\ModelInterface $$model 
         * @return array 
         */
        public function getHasOne(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Gets hasOne relations defined on a model
         *
         * @param mixed $model 
         * @param \Phalcon\Mvc\ModelInterface $$model 
         * @return array 
         */
        public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Query all the relationships defined on a model
         *
         * @param mixed $modelName 
         * @param string $$modelName 
         * @return \Phalcon\Mvc\Model\RelationInterface[] 
         */
        public function getRelations($modelName);
        /**
         * Query the relations between two models
         *
         * @param mixed $first 
         * @param mixed $second 
         * @param string $$first 
         * @param string $$second 
         * @return array 
         */
        public function getRelationsBetween($first, $second);
        /**
         * Creates a Phalcon\Mvc\Model\Query without execute it
         *
         * @param mixed $phql 
         * @param string $$phql 
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function createQuery($phql);
        /**
         * Creates a Phalcon\Mvc\Model\Query and execute it
         *
         * @param mixed $phql 
         * @param mixed $placeholders 
         * @param string $$phql 
         * @param array $$placeholders 
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function executeQuery($phql, $placeholders = null);
        /**
         * Creates a Phalcon\Mvc\Model\Query\Builder
         *
         * @param mixed $params 
         * @param string $$params 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function createBuilder($params = null);
        /**
         * Binds a behavior to a model
         *
         * @param mixed $model 
         * @param mixed $behavior 
         */
        public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior);
        /**
         * Receives events generated in the models and dispatches them to a events-manager if available
         * Notify the behaviors that are listening in the model
         *
         * @param mixed $eventName 
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param string $$eventName 
         */
        public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model);
        /**
         * Dispatch a event to the listeners and behaviors
         * This method expects that the endpoint listeners/behaviors returns true
         * meaning that a least one is implemented
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param mixed $eventName 
         * @param mixed $data 
         * @param string $$eventName 
         * @param array $$data 
         * @return boolean 
         */
        public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data);
        /**
         * Returns the last query created or executed in the models manager
         *
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function getLastQuery();
        /**
         * Returns a relation by its alias
         *
         * @param string $modelName 
         * @param string $alias 
         * @param string $$modelName 
         * @param string $$alias 
         * @return \Phalcon\Mvc\Model\Relation 
         */
        public function getRelationByAlias($modelName, $alias);
    }

    /**
     * Phalcon\Mvc\Model\Message
     * Encapsulates validation info generated before save/delete records fails
     * <code>
     * use Phalcon\Mvc\Model\Message as Message;
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function beforeSave()
     * {
     * if ($this->name == 'Peter') {
     * $text = "A robot cannot be named Peter";
     * $field = "name";
     * $type = "InvalidValue";
     * $message = new Message($text, $field, $type);
     * $this->appendMessage($message);
     * }
     * }
     * }
     * </code>
     */
    class Message implements \Phalcon\Mvc\Model\MessageInterface
    {
        protected $_type;
        protected $_message;
        protected $_field;
        protected $_model;
        protected $_code;
        /**
         * Phalcon\Mvc\Model\Message constructor
         *
         * @param string $message 
         * @param string|array $field 
         * @param string $type 
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param int|null $code 
         */
        public function __construct($message, $field = null, $type = null, $model = null, $code = null) {}
        /**
         * Sets message type
         *
         * @param string $type 
         * @return Message 
         */
        public function setType($type) {}
        /**
         * Returns message type
         *
         * @return string 
         */
        public function getType() {}
        /**
         * Sets verbose message
         *
         * @param string $message 
         * @return Message 
         */
        public function setMessage($message) {}
        /**
         * Returns verbose message
         *
         * @return string 
         */
        public function getMessage() {}
        /**
         * Sets field name related to message
         *
         * @param mixed $field 
         * @return Message 
         */
        public function setField($field) {}
        /**
         * Returns field name related to message
         */
        public function getField() {}
        /**
         * Set the model who generates the message
         *
         * @param mixed $model 
         * @return Message 
         */
        public function setModel(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Sets code for the message
         *
         * @param int $code 
         * @return Message 
         */
        public function setCode($code) {}
        /**
         * Returns the model that produced the message
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getModel() {}
        /**
         * Returns the message code
         *
         * @return int 
         */
        public function getCode() {}
        /**
         * Magic __toString method returns verbose message
         *
         * @return string 
         */
        public function __toString() {}
        /**
         * Magic __set_state helps to re-build messages variable exporting
         *
         * @param array $message 
         * @return Message 
         */
        public static function __set_state(array $message) {}
    }

    /**
     * Phalcon\Mvc\Model\Message
     * Interface for Phalcon\Mvc\Model\Message
     */
    interface MessageInterface
    {
        /**
         * Sets message type
         *
         * @param string $type 
         */
        public function setType($type);
        /**
         * Returns message type
         *
         * @return string 
         */
        public function getType();
        /**
         * Sets verbose message
         *
         * @param string $message 
         */
        public function setMessage($message);
        /**
         * Returns verbose message
         *
         * @return string 
         */
        public function getMessage();
        /**
         * Sets field name related to message
         *
         * @param string $field 
         */
        public function setField($field);
        /**
         * Returns field name related to message
         *
         * @return string 
         */
        public function getField();
        /**
         * Magic __toString method returns verbose message
         *
         * @return string 
         */
        public function __toString();
        /**
         * Magic __set_state helps to recover messages from serialization
         *
         * @param array $message 
         * @return MessageInterface 
         */
        public static function __set_state(array $message);
    }

    /**
     * Phalcon\Mvc\Model\MetaData
     * <p>Because Phalcon\Mvc\Model requires meta-data like field names, data types, primary keys, etc.
     * this component collect them and store for further querying by Phalcon\Mvc\Model.
     * Phalcon\Mvc\Model\MetaData can also use adapters to store temporarily or permanently the meta-data.</p>
     * <p>A standard Phalcon\Mvc\Model\MetaData can be used to query model attributes:</p>
     * <code>
     * $metaData = new \Phalcon\Mvc\Model\MetaData\Memory();
     * $attributes = $metaData->getAttributes(new Robots());
     * print_r($attributes);
     * </code>
     */
    abstract class MetaData implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\Model\MetaDataInterface
    {
        const MODELS_ATTRIBUTES = 0;
        const MODELS_PRIMARY_KEY = 1;
        const MODELS_NON_PRIMARY_KEY = 2;
        const MODELS_NOT_NULL = 3;
        const MODELS_DATA_TYPES = 4;
        const MODELS_DATA_TYPES_NUMERIC = 5;
        const MODELS_DATE_AT = 6;
        const MODELS_DATE_IN = 7;
        const MODELS_IDENTITY_COLUMN = 8;
        const MODELS_DATA_TYPES_BIND = 9;
        const MODELS_AUTOMATIC_DEFAULT_INSERT = 10;
        const MODELS_AUTOMATIC_DEFAULT_UPDATE = 11;
        const MODELS_DEFAULT_VALUES = 12;
        const MODELS_EMPTY_STRING_VALUES = 13;
        const MODELS_COLUMN_MAP = 0;
        const MODELS_REVERSE_COLUMN_MAP = 1;
        protected $_dependencyInjector;
        protected $_strategy;
        protected $_metaData;
        protected $_columnMap;
        /**
         * Initialize the metadata for certain table
         *
         * @param mixed $model 
         * @param mixed $key 
         * @param mixed $table 
         * @param mixed $schema 
         */
        protected final function _initialize(\Phalcon\Mvc\ModelInterface $model, $key, $table, $schema) {}
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Set the meta-data extraction strategy
         *
         * @param mixed $strategy 
         */
        public function setStrategy(\Phalcon\Mvc\Model\MetaData\StrategyInterface $strategy) {}
        /**
         * Return the strategy to obtain the meta-data
         *
         * @return \Phalcon\Mvc\Model\MetaData\StrategyInterface 
         */
        public function getStrategy() {}
        /**
         * Reads the complete meta-data for certain model
         * <code>
         * print_r($metaData->readMetaData(new Robots());
         * </code>
         *
         * @param mixed $model 
         */
        public final function readMetaData(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Reads meta-data for certain model
         * <code>
         * print_r($metaData->readMetaDataIndex(new Robots(), 0);
         * </code>
         *
         * @param mixed $model 
         * @param int $index 
         */
        public final function readMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index) {}
        /**
         * Writes meta-data for certain model using a MODEL_* constant
         * <code>
         * print_r($metaData->writeColumnMapIndex(new Robots(), MetaData::MODELS_REVERSE_COLUMN_MAP, array('leName' => 'name')));
         * </code>
         *
         * @param mixed $model 
         * @param int $index 
         * @param mixed $data 
         */
        public final function writeMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index, $data) {}
        /**
         * Reads the ordered/reversed column map for certain model
         * <code>
         * print_r($metaData->readColumnMap(new Robots()));
         * </code>
         *
         * @param mixed $model 
         */
        public final function readColumnMap(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Reads column-map information for certain model using a MODEL_* constant
         * <code>
         * print_r($metaData->readColumnMapIndex(new Robots(), MetaData::MODELS_REVERSE_COLUMN_MAP));
         * </code>
         *
         * @param mixed $model 
         * @param int $index 
         */
        public final function readColumnMapIndex(\Phalcon\Mvc\ModelInterface $model, $index) {}
        /**
         * Returns table attributes names (fields)
         * <code>
         * print_r($metaData->getAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns an array of fields which are part of the primary key
         * <code>
         * print_r($metaData->getPrimaryKeyAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns an array of fields which are not part of the primary key
         * <code>
         * print_r($metaData->getNonPrimaryKeyAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getNonPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns an array of not null attributes
         * <code>
         * print_r($metaData->getNotNullAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getNotNullAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes and their data types
         * <code>
         * print_r($metaData->getDataTypes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getDataTypes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes which types are numerical
         * <code>
         * print_r($metaData->getDataTypesNumeric(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getDataTypesNumeric(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the name of identity field (if one is present)
         * <code>
         * print_r($metaData->getIdentityField(new Robots()));
         * </code>
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return string 
         */
        public function getIdentityField(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes and their bind data types
         * <code>
         * print_r($metaData->getBindTypes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getBindTypes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes that must be ignored from the INSERT SQL generation
         * <code>
         * print_r($metaData->getAutomaticCreateAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes that must be ignored from the UPDATE SQL generation
         * <code>
         * print_r($metaData->getAutomaticUpdateAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Set the attributes that must be ignored from the INSERT SQL generation
         * <code>
         * $metaData->setAutomaticCreateAttributes(new Robots(), array('created_at' => true));
         * </code>
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes) {}
        /**
         * Set the attributes that must be ignored from the UPDATE SQL generation
         * <code>
         * $metaData->setAutomaticUpdateAttributes(new Robots(), array('modified_at' => true));
         * </code>
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes) {}
        /**
         * Set the attributes that allow empty string values
         * <code>
         * $metaData->setEmptyStringAttributes(new Robots(), array('name' => true));
         * </code>
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes) {}
        /**
         * Returns attributes allow empty strings
         * <code>
         * print_r($metaData->getEmptyStringAttributes(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns attributes (which have default values) and their default values
         * <code>
         * print_r($metaData->getDefaultValues(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getDefaultValues(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the column map if any
         * <code>
         * print_r($metaData->getColumnMap(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getColumnMap(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Returns the reverse column map if any
         * <code>
         * print_r($metaData->getReverseColumnMap(new Robots()));
         * </code>
         *
         * @param mixed $model 
         * @return array 
         */
        public function getReverseColumnMap(\Phalcon\Mvc\ModelInterface $model) {}
        /**
         * Check if a model has certain attribute
         * <code>
         * var_dump($metaData->hasAttribute(new Robots(), 'name'));
         * </code>
         *
         * @param mixed $model 
         * @param string $attribute 
         * @return bool 
         */
        public function hasAttribute(\Phalcon\Mvc\ModelInterface $model, $attribute) {}
        /**
         * Checks if the internal meta-data container is empty
         * <code>
         * var_dump($metaData->isEmpty());
         * </code>
         *
         * @return bool 
         */
        public function isEmpty() {}
        /**
         * Resets internal meta-data in order to regenerate it
         * <code>
         * $metaData->reset();
         * </code>
         */
        public function reset() {}
    }

    /**
     * Phalcon\Mvc\Model\MetaDataInterface
     * Interface for Phalcon\Mvc\Model\MetaData
     */
    interface MetaDataInterface
    {
        /**
         * Set the meta-data extraction strategy
         *
         * @param mixed $strategy 
         */
        public function setStrategy(\Phalcon\Mvc\Model\MetaData\StrategyInterface $strategy);
        /**
         * Return the strategy to obtain the meta-data
         *
         * @return \Phalcon\Mvc\Model\MetaData\StrategyInterface 
         */
        public function getStrategy();
        /**
         * Reads meta-data for certain model
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function readMetaData(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Reads meta-data for certain model using a MODEL_* constant
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param int $index 
         * @return mixed 
         */
        public function readMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index);
        /**
         * Writes meta-data for certain model using a MODEL_* constant
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param int $index 
         * @param mixed $data 
         */
        public function writeMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index, $data);
        /**
         * Reads the ordered/reversed column map for certain model
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function readColumnMap(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Reads column-map information for certain model using a MODEL_* constant
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param int $index 
         */
        public function readColumnMapIndex(\Phalcon\Mvc\ModelInterface $model, $index);
        /**
         * Returns table attributes names (fields)
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns an array of fields which are part of the primary key
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns an array of fields which are not part of the primary key
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getNonPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns an array of not null attributes
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getNotNullAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes and their data types
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getDataTypes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes which types are numerical
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getDataTypesNumeric(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns the name of identity field (if one is present)
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return string 
         */
        public function getIdentityField(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes and their bind data types
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getBindTypes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes that must be ignored from the INSERT SQL generation
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes that must be ignored from the UPDATE SQL generation
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @return array 
         */
        public function getAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Set the attributes that must be ignored from the INSERT SQL generation
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);
        /**
         * Set the attributes that must be ignored from the UPDATE SQL generation
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);
        /**
         * Set the attributes that allow empty string values
         *
         * @param mixed $model 
         * @param array $attributes 
         */
        public function setEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);
        /**
         * Returns attributes allow empty strings
         *
         * @param mixed $model 
         * @return array 
         */
        public function getEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns attributes (which have default values) and their default values
         *
         * @param mixed $model 
         * @return array 
         */
        public function getDefaultValues(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns the column map if any
         *
         * @param mixed $model 
         * @return array 
         */
        public function getColumnMap(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Returns the reverse column map if any
         *
         * @param mixed $model 
         * @return array 
         */
        public function getReverseColumnMap(\Phalcon\Mvc\ModelInterface $model);
        /**
         * Check if a model has certain attribute
         *
         * @param mixed $model 
         * @param string $attribute 
         * @return bool 
         */
        public function hasAttribute(\Phalcon\Mvc\ModelInterface $model, $attribute);
        /**
         * Checks if the internal meta-data container is empty
         *
         * @return boolean 
         */
        public function isEmpty();
        /**
         * Resets internal meta-data in order to regenerate it
         */
        public function reset();
        /**
         * Reads meta-data from the adapter
         *
         * @param string $key 
         * @return array 
         */
        public function read($key);
        /**
         * Writes meta-data to the adapter
         *
         * @param string $key 
         * @param array $data 
         */
        public function write($key, $data);
    }

    /**
     * Phalcon\Mvc\Model\Query
     * This class takes a PHQL intermediate representation and executes it.
     * <code>
     * $phql = "SELECT c.price*0.16 AS taxes, c.* FROM Cars AS c JOIN Brands AS b
     * WHERE b.name = :name: ORDER BY c.name";
     * $result = $manager->executeQuery($phql, array(
     * "name" => "Lamborghini"
     * ));
     * foreach ($result as $row) {
     * echo "Name: ",  $row->cars->name, "\n";
     * echo "Price: ", $row->cars->price, "\n";
     * echo "Taxes: ", $row->taxes, "\n";
     * }
     * </code>
     */
    class Query implements \Phalcon\Mvc\Model\QueryInterface, \Phalcon\Di\InjectionAwareInterface
    {
        const TYPE_SELECT = 309;
        const TYPE_INSERT = 306;
        const TYPE_UPDATE = 300;
        const TYPE_DELETE = 303;
        protected $_dependencyInjector;
        protected $_manager;
        protected $_metaData;
        protected $_type;
        protected $_phql;
        protected $_ast;
        protected $_intermediate;
        protected $_models;
        protected $_sqlAliases;
        protected $_sqlAliasesModels;
        protected $_sqlModelsAliases;
        protected $_sqlAliasesModelsInstances;
        protected $_sqlColumnAliases;
        protected $_modelsInstances;
        protected $_cache;
        protected $_cacheOptions;
        protected $_uniqueRow;
        protected $_bindParams;
        protected $_bindTypes;
        protected $_enableImplicitJoins;
        protected $_sharedLock;
        static protected $_irPhqlCache;
        /**
         * Phalcon\Mvc\Model\Query constructor
         *
         * @param string $phql 
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @param mixed $options 
         */
        public function __construct($phql = null, \Phalcon\DiInterface $dependencyInjector = null, $options = null) {}
        /**
         * Sets the dependency injection container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the dependency injection container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Tells to the query if only the first row in the resultset must be returned
         *
         * @param bool $uniqueRow 
         * @return Query 
         */
        public function setUniqueRow($uniqueRow) {}
        /**
         * Check if the query is programmed to get only the first row in the resultset
         *
         * @return bool 
         */
        public function getUniqueRow() {}
        /**
         * Replaces the model's name to its source name in a qualified-name expression
         *
         * @param array $expr 
         * @return array 
         */
        protected final function _getQualified(array $expr) {}
        /**
         * Resolves a expression in a single call argument
         *
         * @param array $argument 
         * @return array 
         */
        protected final function _getCallArgument(array $argument) {}
        /**
         * Resolves a expression in a single call argument
         *
         * @param array $expr 
         * @return array 
         */
        protected final function _getCaseExpression(array $expr) {}
        /**
         * Resolves a expression in a single call argument
         *
         * @param array $expr 
         * @return array 
         */
        protected final function _getFunctionCall(array $expr) {}
        /**
         * Resolves an expression from its intermediate code into a string
         *
         * @param array $expr 
         * @param boolean $quoting 
         * @return string 
         */
        protected final function _getExpression($expr, $quoting = true) {}
        /**
         * Resolves a column from its intermediate representation into an array used to determine
         * if the resultset produced is simple or complex
         *
         * @param array $column 
         * @return array 
         */
        protected final function _getSelectColumn(array $column) {}
        /**
         * Resolves a table in a SELECT statement checking if the model exists
         *
         * @param \Phalcon\Mvc\Model\ManagerInterface $manager 
         * @param array $qualifiedName 
         * @return string 
         */
        protected final function _getTable(\Phalcon\Mvc\Model\ManagerInterface $manager, $qualifiedName) {}
        /**
         * Resolves a JOIN clause checking if the associated models exist
         *
         * @param mixed $manager 
         * @param mixed $join 
         * @return array 
         */
        protected final function _getJoin(\Phalcon\Mvc\Model\ManagerInterface $manager, $join) {}
        /**
         * Resolves a JOIN type
         *
         * @param array $join 
         * @return string 
         */
        protected final function _getJoinType($join) {}
        /**
         * Resolves joins involving has-one/belongs-to/has-many relations
         *
         * @param string $joinType 
         * @param string $joinSource 
         * @param string $modelAlias 
         * @param string $joinAlias 
         * @param \Phalcon\Mvc\Model\RelationInterface $relation 
         * @return array 
         */
        protected final function _getSingleJoin($joinType, $joinSource, $modelAlias, $joinAlias, \Phalcon\Mvc\Model\RelationInterface $relation) {}
        /**
         * Resolves joins involving many-to-many relations
         *
         * @param string $joinType 
         * @param string $joinSource 
         * @param string $modelAlias 
         * @param string $joinAlias 
         * @param \Phalcon\Mvc\Model\RelationInterface $relation 
         * @return array 
         */
        protected final function _getMultiJoin($joinType, $joinSource, $modelAlias, $joinAlias, \Phalcon\Mvc\Model\RelationInterface $relation) {}
        /**
         * Processes the JOINs in the query returning an internal representation for the database dialect
         *
         * @param array $select 
         * @return array 
         */
        protected final function _getJoins($select) {}
        /**
         * Returns a processed order clause for a SELECT statement
         *
         * @param mixed $order 
         * @param array|string $$order 
         * @return array 
         */
        protected final function _getOrderClause($order) {}
        /**
         * Returns a processed group clause for a SELECT statement
         *
         * @param array $group 
         * @return array 
         */
        protected final function _getGroupClause(array $group) {}
        /**
         * Returns a processed limit clause for a SELECT statement
         *
         * @param array $limitClause 
         * @return array 
         */
        protected final function _getLimitClause(array $limitClause) {}
        /**
         * Analyzes a SELECT intermediate code and produces an array to be executed later
         *
         * @param mixed $ast 
         * @param mixed $merge 
         * @return array 
         */
        protected final function _prepareSelect($ast = null, $merge = null) {}
        /**
         * Analyzes an INSERT intermediate code and produces an array to be executed later
         *
         * @return array 
         */
        protected final function _prepareInsert() {}
        /**
         * Analyzes an UPDATE intermediate code and produces an array to be executed later
         *
         * @return array 
         */
        protected final function _prepareUpdate() {}
        /**
         * Analyzes a DELETE intermediate code and produces an array to be executed later
         *
         * @return array 
         */
        protected final function _prepareDelete() {}
        /**
         * Parses the intermediate code produced by Phalcon\Mvc\Model\Query\Lang generating another
         * intermediate representation that could be executed by Phalcon\Mvc\Model\Query
         *
         * @return array 
         */
        public function parse() {}
        /**
         * Returns the current cache backend instance
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache() {}
        /**
         * Executes the SELECT intermediate representation producing a Phalcon\Mvc\Model\Resultset
         *
         * @param mixed $intermediate 
         * @param mixed $bindParams 
         * @param mixed $bindTypes 
         * @param bool $simulate 
         * @return array|\Phalcon\Mvc\Model\ResultsetInterface 
         */
        protected final function _executeSelect($intermediate, $bindParams, $bindTypes, $simulate = false) {}
        /**
         * Executes the INSERT intermediate representation producing a Phalcon\Mvc\Model\Query\Status
         *
         * @param array $intermediate 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\StatusInterface 
         */
        protected final function _executeInsert($intermediate, $bindParams, $bindTypes) {}
        /**
         * Executes the UPDATE intermediate representation producing a Phalcon\Mvc\Model\Query\Status
         *
         * @param array $intermediate 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\StatusInterface 
         */
        protected final function _executeUpdate($intermediate, $bindParams, $bindTypes) {}
        /**
         * Executes the DELETE intermediate representation producing a Phalcon\Mvc\Model\Query\Status
         *
         * @param array $intermediate 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\StatusInterface 
         */
        protected final function _executeDelete($intermediate, $bindParams, $bindTypes) {}
        /**
         * Query the records on which the UPDATE/DELETE operation well be done
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param array $intermediate 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\ResultsetInterface 
         */
        protected final function _getRelatedRecords(\Phalcon\Mvc\ModelInterface $model, $intermediate, $bindParams, $bindTypes) {}
        /**
         * Executes a parsed PHQL statement
         *
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return mixed 
         */
        public function execute($bindParams = null, $bindTypes = null) {}
        /**
         * Executes the query returning the first result
         *
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getSingleResult($bindParams = null, $bindTypes = null) {}
        /**
         * Sets the type of PHQL statement to be executed
         *
         * @param int $type 
         * @return Query 
         */
        public function setType($type) {}
        /**
         * Gets the type of PHQL statement executed
         *
         * @return int 
         */
        public function getType() {}
        /**
         * Set default bind parameters
         *
         * @param array $bindParams 
         * @param bool $merge 
         * @return Query 
         */
        public function setBindParams(array $bindParams, $merge = false) {}
        /**
         * Returns default bind params
         *
         * @return array 
         */
        public function getBindParams() {}
        /**
         * Set default bind parameters
         *
         * @param array $bindTypes 
         * @param bool $merge 
         * @return Query 
         */
        public function setBindTypes(array $bindTypes, $merge = false) {}
        /**
         * Set SHARED LOCK clause
         *
         * @param bool $sharedLock 
         * @return Query 
         */
        public function setSharedLock($sharedLock = false) {}
        /**
         * Returns default bind types
         *
         * @return array 
         */
        public function getBindTypes() {}
        /**
         * Allows to set the IR to be executed
         *
         * @param array $intermediate 
         * @return Query 
         */
        public function setIntermediate(array $intermediate) {}
        /**
         * Returns the intermediate representation of the PHQL statement
         *
         * @return array 
         */
        public function getIntermediate() {}
        /**
         * Sets the cache parameters of the query
         *
         * @param mixed $cacheOptions 
         * @return Query 
         */
        public function cache($cacheOptions) {}
        /**
         * Returns the current cache options
         *
         * @param array  
         */
        public function getCacheOptions() {}
        /**
         * Returns the SQL to be generated by the internal PHQL (only works in SELECT statements)
         *
         * @return array 
         */
        public function getSql() {}
        /**
         * Destroys the internal PHQL cache
         */
        public static function clean() {}
    }

    /**
     * Phalcon\Mvc\Model\QueryInterface
     * Interface for Phalcon\Mvc\Model\Query
     */
    interface QueryInterface
    {
        /**
         * Parses the intermediate code produced by Phalcon\Mvc\Model\Query\Lang generating another
         * intermediate representation that could be executed by Phalcon\Mvc\Model\Query
         *
         * @return array 
         */
        public function parse();
        /**
         * Sets the cache parameters of the query
         *
         * @param array $cacheOptions 
         * @return \Phalcon\Mvc\Model\Query 
         */
        public function cache($cacheOptions);
        /**
         * Returns the current cache options
         *
         * @param array  
         */
        public function getCacheOptions();
        /**
         * Tells to the query if only the first row in the resultset must be returned
         *
         * @param boolean $uniqueRow 
         * @return \Phalcon\Mvc\Model\Query 
         */
        public function setUniqueRow($uniqueRow);
        /**
         * Check if the query is programmed to get only the first row in the resultset
         *
         * @return boolean 
         */
        public function getUniqueRow();
        /**
         * Executes a parsed PHQL statement
         *
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return mixed 
         */
        public function execute($bindParams = null, $bindTypes = null);
    }

    /**
     * Phalcon\Mvc\Model\Relation
     * This class represents a relationship between two models
     */
    class Relation implements \Phalcon\Mvc\Model\RelationInterface
    {
        const BELONGS_TO = 0;
        const HAS_ONE = 1;
        const HAS_MANY = 2;
        const HAS_ONE_THROUGH = 3;
        const HAS_MANY_THROUGH = 4;
        const NO_ACTION = 0;
        const ACTION_RESTRICT = 1;
        const ACTION_CASCADE = 2;
        protected $_type;
        protected $_referencedModel;
        protected $_fields;
        protected $_referencedFields;
        protected $_intermediateModel;
        protected $_intermediateFields;
        protected $_intermediateReferencedFields;
        protected $_options;
        /**
         * Phalcon\Mvc\Model\Relation constructor
         *
         * @param int $type 
         * @param string $referencedModel 
         * @param string|array $fields 
         * @param string|array $referencedFields 
         * @param array $options 
         */
        public function __construct($type, $referencedModel, $fields, $referencedFields, $options = null) {}
        /**
         * Sets the intermediate model data for has-*-through relations
         *
         * @param string|array $intermediateFields 
         * @param string $intermediateModel 
         * @param string $intermediateReferencedFields 
         */
        public function setIntermediateRelation($intermediateFields, $intermediateModel, $intermediateReferencedFields) {}
        /**
         * Returns the relation type
         *
         * @return int 
         */
        public function getType() {}
        /**
         * Returns the referenced model
         *
         * @return string 
         */
        public function getReferencedModel() {}
        /**
         * Returns the fields
         *
         * @return string|array 
         */
        public function getFields() {}
        /**
         * Returns the referenced fields
         *
         * @return string|array 
         */
        public function getReferencedFields() {}
        /**
         * Returns the options
         *
         * @return string|array 
         */
        public function getOptions() {}
        /**
         * Returns an option by the specified name
         * If the option doesn't exist null is returned
         *
         * @param string $name 
         */
        public function getOption($name) {}
        /**
         * Check whether the relation act as a foreign key
         *
         * @return bool 
         */
        public function isForeignKey() {}
        /**
         * Returns the foreign key configuration
         *
         * @return string|array 
         */
        public function getForeignKey() {}
        /**
         * Returns parameters that must be always used when the related records are obtained
         *
         * @return array 
         */
        public function getParams() {}
        /**
         * Check whether the relation is a 'many-to-many' relation or not
         *
         * @return bool 
         */
        public function isThrough() {}
        /**
         * Check if records returned by getting belongs-to/has-many are implicitly cached during the current request
         *
         * @return bool 
         */
        public function isReusable() {}
        /**
         * Gets the intermediate fields for has-*-through relations
         *
         * @return string|array 
         */
        public function getIntermediateFields() {}
        /**
         * Gets the intermediate model for has-*-through relations
         *
         * @return string 
         */
        public function getIntermediateModel() {}
        /**
         * Gets the intermediate referenced fields for has-*-through relations
         *
         * @return string|array 
         */
        public function getIntermediateReferencedFields() {}
    }

    /**
     * Phalcon\Mvc\Model\RelationInterface
     * Interface for Phalcon\Mvc\Model\Relation
     */
    interface RelationInterface
    {
        /**
         * Sets the intermediate model dat for has-*-through relations
         *
         * @param string|array $intermediateFields 
         * @param string $intermediateModel 
         * @param string|array $intermediateReferencedFields 
         */
        public function setIntermediateRelation($intermediateFields, $intermediateModel, $intermediateReferencedFields);
        /**
         * Check if records returned by getting belongs-to/has-many are implicitly cached during the current request
         *
         * @return bool 
         */
        public function isReusable();
        /**
         * Returns the relations type
         *
         * @return int 
         */
        public function getType();
        /**
         * Returns the referenced model
         *
         * @return string 
         */
        public function getReferencedModel();
        /**
         * Returns the fields
         *
         * @return string|array 
         */
        public function getFields();
        /**
         * Returns the referenced fields
         *
         * @return string|array 
         */
        public function getReferencedFields();
        /**
         * Returns the options
         *
         * @return string|array 
         */
        public function getOptions();
        /**
         * Returns an option by the specified name
         * If the option doesn't exist null is returned
         *
         * @param string $name 
         */
        public function getOption($name);
        /**
         * Check whether the relation act as a foreign key
         *
         * @return bool 
         */
        public function isForeignKey();
        /**
         * Returns the foreign key configuration
         *
         * @return string|array 
         */
        public function getForeignKey();
        /**
         * Check whether the relation is a 'many-to-many' relation or not
         *
         * @return bool 
         */
        public function isThrough();
        /**
         * Gets the intermediate fields for has-*-through relations
         *
         * @return string|array 
         */
        public function getIntermediateFields();
        /**
         * Gets the intermediate model for has-*-through relations
         *
         * @return string 
         */
        public function getIntermediateModel();
        /**
         * Gets the intermediate referenced fields for has-*-through relations
         *
         * @return string|array 
         */
        public function getIntermediateReferencedFields();
    }

    /**
     * Phalcon\Mvc\Model\ResultInterface
     * All single objects passed as base objects to Resultsets must implement this interface
     */
    interface ResultInterface
    {
        /**
         * Sets the object's state
         *
         * @param boolean $dirtyState 
         */
        public function setDirtyState($dirtyState);
    }

    /**
     * Phalcon\Mvc\Model\Resultset
     * This component allows to Phalcon\Mvc\Model returns large resultsets with the minimum memory consumption
     * Resultsets can be traversed using a standard foreach or a while statement. If a resultset is serialized
     * it will dump all the rows into a big array. Then unserialize will retrieve the rows as they were before
     * serializing.
     * <code>
     * //Using a standard foreach
     * $robots = Robots::find(array("type='virtual'", "order" => "name"));
     * foreach ($robots as robot) {
     * echo robot->name, "\n";
     * }
     * //Using a while
     * $robots = Robots::find(array("type='virtual'", "order" => "name"));
     * $robots->rewind();
     * while ($robots->valid()) {
     * $robot = $robots->current();
     * echo $robot->name, "\n";
     * $robots->next();
     * }
     * </code>
     */
    abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable, \JsonSerializable
    {
        const TYPE_RESULT_FULL = 0;
        const TYPE_RESULT_PARTIAL = 1;
        const HYDRATE_RECORDS = 0;
        const HYDRATE_OBJECTS = 2;
        const HYDRATE_ARRAYS = 1;
        /**
         * Phalcon\Db\ResultInterface or false for empty resultset
         */
        protected $_result = false;
        protected $_cache;
        protected $_isFresh = true;
        protected $_pointer = 0;
        protected $_count;
        protected $_activeRow = null;
        protected $_rows = null;
        protected $_row = null;
        protected $_errorMessages;
        protected $_hydrateMode = 0;
        /**
         * Phalcon\Mvc\Model\Resultset constructor
         *
         * @param \Phalcon\Db\ResultInterface|false $result 
         * @param \Phalcon\Cache\BackendInterface $cache 
         * @param array $columnTypes 
         */
        public function __construct($result, \Phalcon\Cache\BackendInterface $cache = null) {}
        /**
         * Moves cursor to next row in the resultset
         */
        public function next() {}
        /**
         * Check whether internal resource has rows to fetch
         *
         * @return bool 
         */
        public function valid() {}
        /**
         * Gets pointer number of active row in the resultset
         *
         * @return int|null 
         */
        public function key() {}
        /**
         * Rewinds resultset to its beginning
         */
        public final function rewind() {}
        /**
         * Changes internal pointer to a specific position in the resultset
         * Set new position if required and set this->_row
         *
         * @param int $position 
         */
        public final function seek($position) {}
        /**
         * Counts how many rows are in the resultset
         *
         * @return int 
         */
        public final function count() {}
        /**
         * Checks whether offset exists in the resultset
         *
         * @param int $index 
         * @return bool 
         */
        public function offsetExists($index) {}
        /**
         * Gets row in a specific position of the resultset
         *
         * @param int $index 
         * @return bool|\Phalcon\Mvc\ModelInterface 
         */
        public function offsetGet($index) {}
        /**
         * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
         *
         * @param int $index 
         * @param \Phalcon\Mvc\ModelInterface $value 
         */
        public function offsetSet($index, $value) {}
        /**
         * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
         *
         * @param int $offset 
         */
        public function offsetUnset($offset) {}
        /**
         * Returns the internal type of data retrieval that the resultset is using
         *
         * @return int 
         */
        public function getType() {}
        /**
         * Get first row in the resultset
         *
         * @return bool|\Phalcon\Mvc\ModelInterface 
         */
        public function getFirst() {}
        /**
         * Get last row in the resultset
         *
         * @return bool|\Phalcon\Mvc\ModelInterface 
         */
        public function getLast() {}
        /**
         * Set if the resultset is fresh or an old one cached
         *
         * @param bool $isFresh 
         * @return Resultset 
         */
        public function setIsFresh($isFresh) {}
        /**
         * Tell if the resultset if fresh or an old one cached
         *
         * @return bool 
         */
        public function isFresh() {}
        /**
         * Sets the hydration mode in the resultset
         *
         * @param int $hydrateMode 
         * @return Resultset 
         */
        public function setHydrateMode($hydrateMode) {}
        /**
         * Returns the current hydration mode
         *
         * @return int 
         */
        public function getHydrateMode() {}
        /**
         * Returns the associated cache for the resultset
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache() {}
        /**
         * Returns the error messages produced by a batch operation
         *
         * @return MessageInterface[] 
         */
        public function getMessages() {}
        /**
         * Updates every record in the resultset
         *
         * @param array $data 
         * @param \Closure $conditionCallback 
         * @return boolean 
         */
        public function update($data, \Closure $conditionCallback = null) {}
        /**
         * Deletes every record in the resultset
         *
         * @param mixed $conditionCallback 
         * @return bool 
         */
        public function delete(\Closure $conditionCallback = null) {}
        /**
         * Filters a resultset returning only those the developer requires
         * <code>
         * $filtered = $robots->filter(function($robot){
         * if ($robot->id < 3) {
         * return $robot;
         * }
         * });
         * </code>
         *
         * @param callback $filter 
         * @return \Phalcon\Mvc\Model[] 
         */
        public function filter($filter) {}
        /**
         * Returns serialised model objects as array for json_encode.
         * Calls jsonSerialize on each object if present
         * <code>
         * $robots = Robots::find();
         * echo json_encode($robots);
         * </code>
         *
         * @return array 
         */
        public function jsonSerialize() {}
    }

    /**
     * Phalcon\Mvc\Model\ResultsetInterface
     * Interface for Phalcon\Mvc\Model\Resultset
     */
    interface ResultsetInterface
    {
        /**
         * Returns the internal type of data retrieval that the resultset is using
         *
         * @return int 
         */
        public function getType();
        /**
         * Get first row in the resultset
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getFirst();
        /**
         * Get last row in the resultset
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getLast();
        /**
         * Set if the resultset is fresh or an old one cached
         *
         * @param bool $isFresh 
         */
        public function setIsFresh($isFresh);
        /**
         * Tell if the resultset if fresh or an old one cached
         *
         * @return bool 
         */
        public function isFresh();
        /**
         * Returns the associated cache for the resultset
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache();
        /**
         * Returns a complete resultset as an array, if the resultset has a big number of rows
         * it could consume more memory than currently it does.
         *
         * @return array 
         */
        public function toArray();
    }

    /**
     * Phalcon\Mvc\Model\Row
     * This component allows Phalcon\Mvc\Model to return rows without an associated entity.
     * This objects implements the ArrayAccess interface to allow access the object as object->x or array[x].
     */
    class Row implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\Model\ResultInterface, \ArrayAccess, \JsonSerializable
    {
        /**
         * Set the current object's state
         *
         * @param int $dirtyState 
         * @return bool 
         */
        public function setDirtyState($dirtyState) {}
        /**
         * Checks whether offset exists in the row
         *
         * @param mixed $index 
         * @param string|int $$index 
         * @return boolean 
         */
        public function offsetExists($index) {}
        /**
         * Gets a record in a specific position of the row
         *
         * @param string|int $index 
         * @return string|Phalcon\Mvc\ModelInterface 
         */
        public function offsetGet($index) {}
        /**
         * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
         *
         * @param string|int $index 
         * @param \Phalcon\Mvc\ModelInterface $value 
         */
        public function offsetSet($index, $value) {}
        /**
         * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
         *
         * @param string|int $offset 
         */
        public function offsetUnset($offset) {}
        /**
         * Reads an attribute value by its name
         * <code>
         * echo $robot->readAttribute('name');
         * </code>
         *
         * @param string $attribute 
         * @return mixed 
         */
        public function readAttribute($attribute) {}
        /**
         * Writes an attribute value by its name
         * <code>
         * $robot->writeAttribute('name', 'Rosey');
         * </code>
         *
         * @param string $attribute 
         * @param mixed $value 
         */
        public function writeAttribute($attribute, $value) {}
        /**
         * Returns the instance as an array representation
         *
         * @return array 
         */
        public function toArray() {}
        /**
         * Serializes the object for json_encode
         *
         * @return array 
         */
        public function jsonSerialize() {}
    }

    /**
     * Phalcon\Mvc\Model\Transaction
     * Transactions are protective blocks where SQL statements are only permanent if they can
     * all succeed as one atomic action. Phalcon\Transaction is intended to be used with Phalcon_Model_Base.
     * Phalcon Transactions should be created using Phalcon\Transaction\Manager.
     * <code>
     * try {
     * $manager = new \Phalcon\Mvc\Model\Transaction\Manager();
     * $transaction = $manager->get();
     * $robot = new Robots();
     * $robot->setTransaction($transaction);
     * $robot->name = 'WALL·E';
     * $robot->created_at = date('Y-m-d');
     * if ($robot->save() == false) {
     * $transaction->rollback("Can't save robot");
     * }
     * $robotPart = new RobotParts();
     * $robotPart->setTransaction($transaction);
     * $robotPart->type = 'head';
     * if ($robotPart->save() == false) {
     * $transaction->rollback("Can't save robot part");
     * }
     * $transaction->commit();
     * } catch(Phalcon\Mvc\Model\Transaction\Failed $e) {
     * echo 'Failed, reason: ', $e->getMessage();
     * }
     * </code>
     */
    class Transaction implements \Phalcon\Mvc\Model\TransactionInterface
    {
        protected $_connection;
        protected $_activeTransaction = false;
        protected $_isNewTransaction = true;
        protected $_rollbackOnAbort = false;
        protected $_manager;
        protected $_messages;
        protected $_rollbackRecord;
        /**
         * Phalcon\Mvc\Model\Transaction constructor
         *
         * @param mixed $dependencyInjector 
         * @param boolean $autoBegin 
         * @param string $service 
         * @param \Phalcon\DiInterface $$ependencyInjector 
         */
        public function __construct(\Phalcon\DiInterface $dependencyInjector, $autoBegin = false, $service = null) {}
        /**
         * Sets transaction manager related to the transaction
         *
         * @param mixed $manager 
         */
        public function setTransactionManager(\Phalcon\Mvc\Model\Transaction\ManagerInterface $manager) {}
        /**
         * Starts the transaction
         *
         * @return bool 
         */
        public function begin() {}
        /**
         * Commits the transaction
         *
         * @return bool 
         */
        public function commit() {}
        /**
         * Rollbacks the transaction
         *
         * @param string $rollbackMessage 
         * @param \Phalcon\Mvc\ModelInterface $rollbackRecord 
         * @return boolean 
         */
        public function rollback($rollbackMessage = null, $rollbackRecord = null) {}
        /**
         * Returns the connection related to transaction
         *
         * @return \Phalcon\Db\AdapterInterface 
         */
        public function getConnection() {}
        /**
         * Sets if is a reused transaction or new once
         *
         * @param bool $isNew 
         */
        public function setIsNewTransaction($isNew) {}
        /**
         * Sets flag to rollback on abort the HTTP connection
         *
         * @param bool $rollbackOnAbort 
         */
        public function setRollbackOnAbort($rollbackOnAbort) {}
        /**
         * Checks whether transaction is managed by a transaction manager
         *
         * @return bool 
         */
        public function isManaged() {}
        /**
         * Returns validations messages from last save try
         *
         * @return array 
         */
        public function getMessages() {}
        /**
         * Checks whether internal connection is under an active transaction
         *
         * @return bool 
         */
        public function isValid() {}
        /**
         * Sets object which generates rollback action
         *
         * @param mixed $record 
         */
        public function setRollbackedRecord(\Phalcon\Mvc\ModelInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\TransactionInterface
     * Interface for Phalcon\Mvc\Model\Transaction
     */
    interface TransactionInterface
    {
        /**
         * Sets transaction manager related to the transaction
         *
         * @param mixed $manager 
         */
        public function setTransactionManager(\Phalcon\Mvc\Model\Transaction\ManagerInterface $manager);
        /**
         * Starts the transaction
         *
         * @return boolean 
         */
        public function begin();
        /**
         * Commits the transaction
         *
         * @return boolean 
         */
        public function commit();
        /**
         * Rollbacks the transaction
         *
         * @param string $rollbackMessage 
         * @param \Phalcon\Mvc\ModelInterface $rollbackRecord 
         * @return boolean 
         */
        public function rollback($rollbackMessage = null, $rollbackRecord = null);
        /**
         * Returns connection related to transaction
         *
         * @return string 
         */
        public function getConnection();
        /**
         * Sets if is a reused transaction or new once
         *
         * @param boolean $isNew 
         */
        public function setIsNewTransaction($isNew);
        /**
         * Sets flag to rollback on abort the HTTP connection
         *
         * @param boolean $rollbackOnAbort 
         */
        public function setRollbackOnAbort($rollbackOnAbort);
        /**
         * Checks whether transaction is managed by a transaction manager
         *
         * @return boolean 
         */
        public function isManaged();
        /**
         * Returns validations messages from last save try
         *
         * @return array 
         */
        public function getMessages();
        /**
         * Checks whether internal connection is under an active transaction
         *
         * @return boolean 
         */
        public function isValid();
        /**
         * Sets object which generates rollback action
         *
         * @param mixed $record 
         */
        public function setRollbackedRecord(\Phalcon\Mvc\ModelInterface $record);
    }

    /**
     * Phalcon\Mvc\Model\ValidationFailed
     * This exception is generated when a model fails to save a record
     * Phalcon\Mvc\Model must be set up to have this behavior
     */
    class ValidationFailed extends \Phalcon\Mvc\Model\Exception
    {
        protected $_model;
        protected $_messages;
        /**
         * Phalcon\Mvc\Model\ValidationFailed constructor
         *
         * @param Model $model 
         * @param Message[] $validationMessages 
         */
        public function __construct(\Phalcon\Mvc\Model $model, array $validationMessages) {}
        /**
         * Returns the model that generated the messages
         *
         * @return \Phalcon\Mvc\Model 
         */
        public function getModel() {}
        /**
         * Returns the complete group of messages produced in the validation
         *
         * @return Message[] 
         */
        public function getMessages() {}
    }

    /**
     * Phalcon\Mvc\Model\Validator
     * This is a base class for Phalcon\Mvc\Model validators
     */
    abstract class Validator
    {
        protected $_options;
        protected $_messages = array();
        /**
         * Phalcon\Mvc\Model\Validator constructor
         *
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * Appends a message to the validator
         *
         * @param string $message 
         * @param string|array $field 
         * @param string $type 
         */
        protected function appendMessage($message, $field = null, $type = null) {}
        /**
         * Returns messages generated by the validator
         *
         * @return array 
         */
        public function getMessages() {}
        /**
         * Returns all the options from the validator
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * Returns an option
         *
         * @param string $option 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getOption($option, $defaultValue = "") {}
        /**
         * Check whether a option has been defined in the validator options
         *
         * @param string $option 
         * @return bool 
         */
        public function isSetOption($option) {}
    }

    /**
     * Phalcon\Mvc\Model\ValidatorInterface
     * Interface for Phalcon\Mvc\Model validators
     */
    interface ValidatorInterface
    {
        /**
         * Returns messages generated by the validator
         *
         * @return array 
         */
        public function getMessages();
        /**
         * Executes the validator
         *
         * @param \Phalcon\Mvc\ModelInterface $record 
         * @return boolean 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record);
    }
}

namespace \Phalcon\Mvc\Model\Behavior {
    /**
     * Phalcon\Mvc\Model\Behavior\SoftDelete
     * Instead of permanently delete a record it marks the record as
     * deleted changing the value of a flag column
     */
    class SoftDelete extends \Phalcon\Mvc\Model\Behavior
    {
        /**
         * Listens for notifications from the models manager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\ModelInterface $model) {}
    }

    /**
     * Phalcon\Mvc\Model\Behavior\Timestampable
     * Allows to automatically update a model’s attribute saving the
     * datetime when a record is created or updated
     */
    class Timestampable extends \Phalcon\Mvc\Model\Behavior
    {
        /**
         * Listens for notifications from the models manager
         *
         * @param string $type 
         * @param mixed $model 
         */
        public function notify($type, \Phalcon\Mvc\ModelInterface $model) {}
    }
}

namespace \Phalcon\Mvc\Model\Metadata {
    /**
     * Phalcon\Mvc\Model\MetaData\Apc
     * Stores model meta-data in the APC cache. Data will erased if the web server is restarted
     * By default meta-data is stored for 48 hours (172800 seconds)
     * You can query the meta-data by printing apc_fetch('$PMM$') or apc_fetch('$PMM$my-app-id')
     * <code>
     * $metaData = new \Phalcon\Mvc\Model\Metadata\Apc(array(
     * 'prefix' => 'my-app-id',
     * 'lifetime' => 86400
     * ));
     * </code>
     */
    class Apc extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_prefix = "";
        protected $_ttl = 172800;
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Apc constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads meta-data from APC
         *
         * @param string $key 
         * @return array|null 
         */
        public function read($key) {}
        /**
         * Writes the meta-data to APC
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, $data) {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Files
     * Stores model meta-data in PHP files.
     * <code>
     * $metaData = new \Phalcon\Mvc\Model\Metadata\Files(array(
     * 'metaDataDir' => 'app/cache/metadata/'
     * ));
     * </code>
     */
    class Files extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_metaDataDir = "./";
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Files constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads meta-data from files
         *
         * @param string $key 
         * @return mixed 
         */
        public function read($key) {}
        /**
         * Writes the meta-data to files
         *
         * @param string $key 
         * @param array $data 
         */
        public function write($key, $data) {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Libmemcached
     * Stores model meta-data in the Memcache.
     * By default meta-data is stored for 48 hours (172800 seconds)
     * <code>
     * $metaData = new Phalcon\Mvc\Model\Metadata\Libmemcached(array(
     * 'servers' => array(
     * array('host' => 'localhost', 'port' => 11211, 'weight' => 1),
     * ),
     * 'client' => array(
     * Memcached::OPT_HASH => Memcached::HASH_MD5,
     * Memcached::OPT_PREFIX_KEY => 'prefix.',
     * ),
     * 'lifetime' => 3600,
     * 'prefix' => 'my_'
     * ));
     * </code>
     */
    class Libmemcached extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_ttl = 172800;
        protected $_memcache = null;
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Libmemcached constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads metadata from Memcache
         *
         * @param string $key 
         * @return array|null 
         */
        public function read($key) {}
        /**
         * Writes the metadata to Memcache
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, $data) {}
        /**
         * Flush Memcache data and resets internal meta-data in order to regenerate it
         */
        public function reset() {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Memcache
     * Stores model meta-data in the Memcache.
     * By default meta-data is stored for 48 hours (172800 seconds)
     * <code>
     * $metaData = new Phalcon\Mvc\Model\Metadata\Memcache(array(
     * 'prefix' => 'my-app-id',
     * 'lifetime' => 86400,
     * 'host' => 'localhost',
     * 'port' => 11211,
     * 'persistent' => false
     * ));
     * </code>
     */
    class Memcache extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_ttl = 172800;
        protected $_memcache = null;
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Memcache constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads metadata from Memcache
         *
         * @param string $key 
         * @return array|null 
         */
        public function read($key) {}
        /**
         * Writes the metadata to Memcache
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, $data) {}
        /**
         * Flush Memcache data and resets internal meta-data in order to regenerate it
         */
        public function reset() {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Memory
     * Stores model meta-data in memory. Data will be erased when the request finishes
     */
    class Memory extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Memory constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads the meta-data from temporal memory
         *
         * @param string $key 
         * @return array 
         */
        public function read($key) {}
        /**
         * Writes the meta-data to temporal memory
         *
         * @param string $key 
         * @param array $data 
         */
        public function write($key, $data) {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Redis
     * Stores model meta-data in the Redis.
     * By default meta-data is stored for 48 hours (172800 seconds)
     * <code>
     * use Phalcon\Mvc\Model\Metadata\Redis;
     * $metaData = new Redis([
     * 'host'       => '127.0.0.1',
     * 'port'       => 6379,
     * 'persistent' => 0,
     * 'statsKey'   => '_PHCM_MM',
     * 'lifetime'   => 172800,
     * 'index'      => 2,
     * ]);
     * </code>
     */
    class Redis extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_ttl = 172800;
        protected $_redis = null;
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Redis constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads metadata from Redis
         *
         * @param string $key 
         * @return array|null 
         */
        public function read($key) {}
        /**
         * Writes the metadata to Redis
         *
         * @param string $key 
         * @param mixed $data 
         */
        public function write($key, $data) {}
        /**
         * Flush Redis data and resets internal meta-data in order to regenerate it
         */
        public function reset() {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Session
     * Stores model meta-data in session. Data will erased when the session finishes.
     * Meta-data are permanent while the session is active.
     * You can query the meta-data by printing $_SESSION['$PMM$']
     * <code>
     * $metaData = new \Phalcon\Mvc\Model\Metadata\Session(array(
     * 'prefix' => 'my-app-id'
     * ));
     * </code>
     */
    class Session extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_prefix = "";
        /**
         * Phalcon\Mvc\Model\MetaData\Session constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads meta-data from $_SESSION
         *
         * @param string $key 
         * @return array 
         */
        public function read($key) {}
        /**
         * Writes the meta-data to $_SESSION
         *
         * @param string $key 
         * @param array $data 
         */
        public function write($key, $data) {}
    }

    interface StrategyInterface
    {
        /**
         * The meta-data is obtained by reading the column descriptions from the database information schema
         *
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @return array 
         */
        public function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);
        /**
         * Read the model's column map, this can't be inferred
         *
         * @todo Not implemented
         * @param \Phalcon\Mvc\ModelInterface $model 
         * @param \Phalcon\DiInterface $dependencyInjector 
         * @return array 
         */
        public function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Xcache
     * Stores model meta-data in the XCache cache. Data will erased if the web server is restarted
     * By default meta-data is stored for 48 hours (172800 seconds)
     * You can query the meta-data by printing xcache_get('$PMM$') or xcache_get('$PMM$my-app-id')
     * <code>
     * $metaData = new Phalcon\Mvc\Model\Metadata\Xcache(array(
     * 'prefix' => 'my-app-id',
     * 'lifetime' => 86400
     * ));
     * </code>
     */
    class Xcache extends \Phalcon\Mvc\Model\MetaData
    {
        protected $_prefix = "";
        protected $_ttl = 172800;
        protected $_metaData = array();
        /**
         * Phalcon\Mvc\Model\MetaData\Xcache constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Reads metadata from XCache
         *
         * @param string $key 
         * @return array 
         */
        public function read($key) {}
        /**
         * Writes the metadata to XCache
         *
         * @param string $key 
         * @param array $data 
         */
        public function write($key, $data) {}
    }
}

namespace \Phalcon\Mvc\Model\Metadata\Strategy {
    class Annotations implements \Phalcon\Mvc\Model\MetaData\StrategyInterface
    {
        /**
         * The meta-data is obtained by reading the column descriptions from the database information schema
         *
         * @param mixed $model 
         * @param mixed $dependencyInjector 
         * @return array 
         */
        public final function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Read the model's column map, this can't be inferred
         *
         * @param mixed $model 
         * @param mixed $dependencyInjector 
         * @return array 
         */
        public final function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}
    }

    /**
     * Phalcon\Mvc\Model\MetaData\Strategy\Introspection
     * Queries the table meta-data in order to introspect the model's metadata
     */
    class Introspection implements \Phalcon\Mvc\Model\MetaData\StrategyInterface
    {
        /**
         * The meta-data is obtained by reading the column descriptions from the database information schema
         *
         * @param mixed $model 
         * @param mixed $dependencyInjector 
         * @return array 
         */
        public final function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Read the model's column map, this can't be inferred
         *
         * @param mixed $model 
         * @param mixed $dependencyInjector 
         * @return array 
         */
        public final function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}
    }
}

namespace \Phalcon\Mvc\Model\Query {
    /**
     * Phalcon\Mvc\Model\Query\Builder
     * Helps to create PHQL queries using an OO interface
     * <code>
     * $params = array(
     * 'models'     => array('Users'),
     * 'columns'    => array('id', 'name', 'status'),
     * 'conditions' => array(
     * array(
     * "created > :min: AND created < :max:",
     * array("min" => '2013-01-01',   'max' => '2014-01-01'),
     * array("min" => PDO::PARAM_STR, 'max' => PDO::PARAM_STR),
     * ),
     * ),
     * // or 'conditions' => "created > '2013-01-01' AND created < '2014-01-01'",
     * 'group'      => array('id', 'name'),
     * 'having'     => "name = 'Kamil'",
     * 'order'      => array('name', 'id'),
     * 'limit'      => 20,
     * 'offset'     => 20,
     * // or 'limit' => array(20, 20),
     * );
     * $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($params);
     * </code>
     */
    class Builder implements \Phalcon\Mvc\Model\Query\BuilderInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_columns;
        protected $_models;
        protected $_joins;
        protected $_with;
        protected $_conditions;
        protected $_group;
        protected $_having;
        protected $_order;
        protected $_limit;
        protected $_offset;
        protected $_forUpdate;
        protected $_sharedLock;
        protected $_bindParams;
        protected $_bindTypes;
        protected $_distinct;
        protected $_hiddenParamNumber = 0;
        /**
         * Phalcon\Mvc\Model\Query\Builder constructor
         *
         * @param mixed $params 
         * @param mixed $dependencyInjector 
         */
        public function __construct($params = null, \Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         * @return Builder 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets SELECT DISTINCT / SELECT ALL flag
         * <code>
         * $builder->distinct("status");
         * $builder->distinct(null);
         * </code>
         *
         * @param mixed $distinct 
         * @return Builder 
         */
        public function distinct($distinct) {}
        /**
         * Returns SELECT DISTINCT / SELECT ALL flag
         *
         * @return bool 
         */
        public function getDistinct() {}
        /**
         * Sets the columns to be queried
         * <code>
         * $builder->columns("id, name");
         * $builder->columns(array('id', 'name'));
         * $builder->columns(array('name', 'number' => 'COUNT(*)'));
         * </code>
         *
         * @param mixed $columns 
         * @return Builder 
         */
        public function columns($columns) {}
        /**
         * Return the columns to be queried
         *
         * @return string|array 
         */
        public function getColumns() {}
        /**
         * Sets the models who makes part of the query
         * <code>
         * $builder->from('Robots');
         * $builder->from(array('Robots', 'RobotsParts'));
         * $builder->from(array('r' => 'Robots', 'rp' => 'RobotsParts'));
         * </code>
         *
         * @param mixed $models 
         * @return Builder 
         */
        public function from($models) {}
        /**
         * Add a model to take part of the query
         * <code>
         * // Load data from models Robots
         * $builder->addFrom('Robots');
         * // Load data from model 'Robots' using 'r' as alias in PHQL
         * $builder->addFrom('Robots', 'r');
         * // Load data from model 'Robots' using 'r' as alias in PHQL
         * // and eager load model 'RobotsParts'
         * $builder->addFrom('Robots', 'r', 'RobotsParts');
         * // Load data from model 'Robots' using 'r' as alias in PHQL
         * // and eager load models 'RobotsParts' and 'Parts'
         * $builder->addFrom('Robots', 'r', ['RobotsParts', 'Parts']);
         * </code>
         *
         * @param mixed $model 
         * @param mixed $alias 
         * @param mixed $with 
         * @return Builder 
         */
        public function addFrom($model, $alias = null, $with = null) {}
        /**
         * Return the models who makes part of the query
         *
         * @return string|array 
         */
        public function getFrom() {}
        /**
         * Adds a INNER join to the query
         * <code>
         * // Inner Join model 'Robots' with automatic conditions and alias
         * $builder->join('Robots');
         * // Inner Join model 'Robots' specifing conditions
         * $builder->join('Robots', 'Robots.id = RobotsParts.robots_id');
         * // Inner Join model 'Robots' specifing conditions and alias
         * $builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * // Left Join model 'Robots' specifing conditions, alias and type of join
         * $builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
         * </code>
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @param string $type 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function join($model, $conditions = null, $alias = null, $type = null) {}
        /**
         * Adds a INNER join to the query
         * <code>
         * // Inner Join model 'Robots' with automatic conditions and alias
         * $builder->innerJoin('Robots');
         * // Inner Join model 'Robots' specifing conditions
         * $builder->innerJoin('Robots', 'Robots.id = RobotsParts.robots_id');
         * // Inner Join model 'Robots' specifing conditions and alias
         * $builder->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @param string $type 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function innerJoin($model, $conditions = null, $alias = null) {}
        /**
         * Adds a LEFT join to the query
         * <code>
         * $builder->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function leftJoin($model, $conditions = null, $alias = null) {}
        /**
         * Adds a RIGHT join to the query
         * <code>
         * $builder->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
         * </code>
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function rightJoin($model, $conditions = null, $alias = null) {}
        /**
         * Return join parts of the query
         *
         * @return array 
         */
        public function getJoins() {}
        /**
         * Sets the query conditions
         * <code>
         * $builder->where(100);
         * $builder->where('name = "Peter"');
         * $builder->where('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
         * </code>
         *
         * @param mixed $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function where($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a condition to the current conditions using a AND operator
         * <code>
         * $builder->andWhere('name = "Peter"');
         * $builder->andWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
         * </code>
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function andWhere($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a condition to the current conditions using a OR operator
         * <code>
         * $builder->orWhere('name = "Peter"');
         * $builder->orWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
         * </code>
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function orWhere($conditions, $bindParams = null, $bindTypes = null) {}
        /**
         * Appends a BETWEEN condition to the current conditions
         * <code>
         * $builder->betweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @param string $operator 
         * @return Builder 
         */
        public function betweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND) {}
        /**
         * Appends a NOT BETWEEN condition to the current conditions
         * <code>
         * $builder->notBetweenWhere('price', 100.25, 200.50);
         * </code>
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @param string $operator 
         * @return Builder 
         */
        public function notBetweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND) {}
        /**
         * Appends an IN condition to the current conditions
         * <code>
         * $builder->inWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @param string $operator 
         * @return Builder 
         */
        public function inWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND) {}
        /**
         * Appends a NOT IN condition to the current conditions
         * <code>
         * $builder->notInWhere('id', [1, 2, 3]);
         * </code>
         *
         * @param string $expr 
         * @param array $values 
         * @param string $operator 
         * @return Builder 
         */
        public function notInWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND) {}
        /**
         * Return the conditions for the query
         *
         * @return string|array 
         */
        public function getWhere() {}
        /**
         * Sets a ORDER BY condition clause
         * <code>
         * $builder->orderBy('Robots.name');
         * $builder->orderBy(array('1', 'Robots.name'));
         * </code>
         *
         * @param string|array $orderBy 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function orderBy($orderBy) {}
        /**
         * Returns the set ORDER BY clause
         *
         * @return string|array 
         */
        public function getOrderBy() {}
        /**
         * Sets a HAVING condition clause. You need to escape PHQL reserved words using [ and ] delimiters
         * <code>
         * $builder->having('SUM(Robots.price) > 0');
         * </code>
         *
         * @param string $having 
         * @return Builder 
         */
        public function having($having) {}
        /**
         * Sets a FOR UPDATE clause
         * <code>
         * $builder->forUpdate(true);
         * </code>
         *
         * @param bool $forUpdate 
         * @return Builder 
         */
        public function forUpdate($forUpdate) {}
        /**
         * Return the current having clause
         *
         * @return string|array 
         */
        public function getHaving() {}
        /**
         * Sets a LIMIT clause, optionally a offset clause
         * <code>
         * $builder->limit(100);
         * $builder->limit(100, 20);
         * </code>
         *
         * @param mixed $limit 
         * @param mixed $offset 
         * @return Builder 
         */
        public function limit($limit = null, $offset = null) {}
        /**
         * Returns the current LIMIT clause
         *
         * @return string|array 
         */
        public function getLimit() {}
        /**
         * Sets an OFFSET clause
         * <code>
         * $builder->offset(30);
         * </code>
         *
         * @param int $offset 
         * @return Builder 
         */
        public function offset($offset) {}
        /**
         * Returns the current OFFSET clause
         *
         * @return string|array 
         */
        public function getOffset() {}
        /**
         * Sets a GROUP BY clause
         * <code>
         * $builder->groupBy(array('Robots.name'));
         * </code>
         *
         * @param string|array $group 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function groupBy($group) {}
        /**
         * Returns the GROUP BY clause
         *
         * @return string 
         */
        public function getGroupBy() {}
        /**
         * Returns a PHQL statement built based on the builder parameters
         *
         * @return string 
         */
        public final function getPhql() {}
        /**
         * Returns the query built
         *
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function getQuery() {}
        /**
         * Automatically escapes identifiers but only if they need to be escaped.
         *
         * @param string $identifier 
         * @return string 
         */
        final public function autoescape($identifier) {}
    }

    /**
     * Phalcon\Mvc\Model\Query\BuilderInterface
     * Interface for Phalcon\Mvc\Model\Query\Builder
     */
    interface BuilderInterface
    {
        const OPERATOR_OR = "or";
        const OPERATOR_AND = "and";
        /**
         * Sets the columns to be queried
         *
         * @param string|array $columns 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function columns($columns);
        /**
         * Return the columns to be queried
         *
         * @return string|array 
         */
        public function getColumns();
        /**
         * Sets the models who makes part of the query
         *
         * @param string|array $models 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function from($models);
        /**
         * Add a model to take part of the query
         *
         * @param string $model 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function addFrom($model, $alias = null);
        /**
         * Return the models who makes part of the query
         *
         * @return string|array 
         */
        public function getFrom();
        /**
         * Adds a INNER join to the query
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function join($model, $conditions = null, $alias = null);
        /**
         * Adds a INNER join to the query
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @param string $type 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function innerJoin($model, $conditions = null, $alias = null);
        /**
         * Adds a LEFT join to the query
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function leftJoin($model, $conditions = null, $alias = null);
        /**
         * Adds a RIGHT join to the query
         *
         * @param string $model 
         * @param string $conditions 
         * @param string $alias 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function rightJoin($model, $conditions = null, $alias = null);
        /**
         * Return join parts of the query
         *
         * @return array 
         */
        public function getJoins();
        /**
         * Sets conditions for the query
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function where($conditions, $bindParams = null, $bindTypes = null);
        /**
         * Appends a condition to the current conditions using a AND operator
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function andWhere($conditions, $bindParams = null, $bindTypes = null);
        /**
         * Appends a condition to the current conditions using a OR operator
         *
         * @param string $conditions 
         * @param array $bindParams 
         * @param array $bindTypes 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function orWhere($conditions, $bindParams = null, $bindTypes = null);
        /**
         * Appends a BETWEEN condition to the current conditions
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @param string $operator 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function betweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND);
        /**
         * Appends a NOT BETWEEN condition to the current conditions
         *
         * @param string $expr 
         * @param mixed $minimum 
         * @param mixed $maximum 
         * @param string $operator 
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function notBetweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND);
        /**
         * Appends an IN condition to the current conditions
         *
         * @param string $expr 
         * @param array $values 
         * @param string $operator 
         * @return BuilderInterface 
         */
        public function inWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND);
        /**
         * Appends a NOT IN condition to the current conditions
         *
         * @param string $expr 
         * @param array $values 
         * @param string $operator 
         * @return BuilderInterface 
         */
        public function notInWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND);
        /**
         * Return the conditions for the query
         *
         * @return string|array 
         */
        public function getWhere();
        /**
         * Sets a ORDER BY condition clause
         *
         * @param string $orderBy 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function orderBy($orderBy);
        /**
         * Return the set ORDER BY clause
         *
         * @return string|array 
         */
        public function getOrderBy();
        /**
         * Sets a HAVING condition clause
         *
         * @param string $having 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function having($having);
        /**
         * Returns the HAVING condition clause
         *
         * @return string|array 
         */
        public function getHaving();
        /**
         * Sets a LIMIT clause
         *
         * @param int $limit 
         * @param int $offset 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function limit($limit, $offset = null);
        /**
         * Returns the current LIMIT clause
         *
         * @return string|array 
         */
        public function getLimit();
        /**
         * Sets a LIMIT clause
         *
         * @param string $group 
         * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
         */
        public function groupBy($group);
        /**
         * Returns the GROUP BY clause
         *
         * @return string 
         */
        public function getGroupBy();
        /**
         * Returns a PHQL statement built based on the builder parameters
         *
         * @return string 
         */
        public function getPhql();
        /**
         * Returns the query built
         *
         * @return \Phalcon\Mvc\Model\QueryInterface 
         */
        public function getQuery();
    }

    /**
     * Phalcon\Mvc\Model\Query\Lang
     * PHQL is implemented as a parser (written in C) that translates syntax in
     * that of the target RDBMS. It allows Phalcon to offer a unified SQL language to
     * the developer, while internally doing all the work of translating PHQL
     * instructions to the most optimal SQL instructions depending on the
     * RDBMS type associated with a model.
     * To achieve the highest performance possible, we wrote a parser that uses
     * the same technology as SQLite. This technology provides a small in-memory
     * parser with a very low memory footprint that is also thread-safe.
     * <code>
     * $intermediate = Phalcon\Mvc\Model\Query\Lang::parsePHQL("SELECT r.* FROM Robots r LIMIT 10");
     * </code>
     */
    abstract class Lang
    {
        /**
         * Parses a PHQL statement returning an intermediate representation (IR)
         *
         * @param string $phql 
         * @return string 
         */
        public static function parsePHQL($phql) {}
    }

    /**
     * Phalcon\Mvc\Model\Query\Status
     * This class represents the status returned by a PHQL
     * statement like INSERT, UPDATE or DELETE. It offers context
     * information and the related messages produced by the
     * model which finally executes the operations when it fails
     * <code>
     * $phql = "UPDATE Robots SET name = :name:, type = :type:, year = :year: WHERE id = :id:";
     * $status = $app->modelsManager->executeQuery($phql, array(
     * 'id' => 100,
     * 'name' => 'Astroy Boy',
     * 'type' => 'mechanical',
     * 'year' => 1959
     * ));
     * \//Check if the update was successful
     * if ($status->success() == true) {
     * echo 'OK';
     * }
     * </code>
     */
    class Status implements \Phalcon\Mvc\Model\Query\StatusInterface
    {
        protected $_success;
        protected $_model;
        /**
         * Phalcon\Mvc\Model\Query\Status
         *
         * @param bool $success 
         * @param mixed $model 
         */
        public function __construct($success, \Phalcon\Mvc\ModelInterface $model = null) {}
        /**
         * Returns the model that executed the action
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getModel() {}
        /**
         * Returns the messages produced because of a failed operation
         *
         * @return \Phalcon\Mvc\Model\MessageInterface[] 
         */
        public function getMessages() {}
        /**
         * Allows to check if the executed operation was successful
         *
         * @return bool 
         */
        public function success() {}
    }

    /**
     * Phalcon\Mvc\Model\Query\StatusInterface
     * Interface for Phalcon\Mvc\Model\Query\Status
     */
    interface StatusInterface
    {
        /**
         * Returns the model which executed the action
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getModel();
        /**
         * Returns the messages produced by a operation failed
         *
         * @return \Phalcon\Mvc\Model\MessageInterface[] 
         */
        public function getMessages();
        /**
         * Allows to check if the executed operation was successful
         *
         * @return bool 
         */
        public function success();
    }
}

namespace \Phalcon\Mvc\Model\Resultset {
    /**
     * Phalcon\Mvc\Model\Resultset\Complex
     * Complex resultsets may include complete objects and scalar values.
     * This class builds every complex row as it is required
     */
    class Complex extends \Phalcon\Mvc\Model\Resultset implements \Phalcon\Mvc\Model\ResultsetInterface
    {
        protected $_columnTypes;
        /**
         * Unserialised result-set hydrated all rows already. unserialise() sets _disableHydration to true
         */
        protected $_disableHydration = false;
        /**
         * Phalcon\Mvc\Model\Resultset\Complex constructor
         *
         * @param array $columnTypes 
         * @param \Phalcon\Db\ResultInterface $result 
         * @param \Phalcon\Cache\BackendInterface $cache 
         */
        public function __construct($columnTypes, \Phalcon\Db\ResultInterface $result = null, \Phalcon\Cache\BackendInterface $cache = null) {}
        /**
         * Returns current row in the resultset
         *
         * @return bool|ModelInterface 
         */
        public final function current() {}
        /**
         * Returns a complete resultset as an array, if the resultset has a big number of rows
         * it could consume more memory than currently it does.
         *
         * @return array 
         */
        public function toArray() {}
        /**
         * Serializing a resultset will dump all related rows into a big array
         *
         * @return string 
         */
        public function serialize() {}
        /**
         * Unserializing a resultset will allow to only works on the rows present in the saved state
         *
         * @param string $data 
         */
        public function unserialize($data) {}
    }

    /**
     * Phalcon\Mvc\Model\Resultset\Simple
     * Simple resultsets only contains a complete objects
     * This class builds every complete object as it is required
     */
    class Simple extends \Phalcon\Mvc\Model\Resultset implements \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable
    {
        protected $_model;
        protected $_columnMap;
        protected $_keepSnapshots = false;
        /**
         * Phalcon\Mvc\Model\Resultset\Simple constructor
         *
         * @param array $columnMap 
         * @param \Phalcon\Mvc\ModelInterface|Phalcon\Mvc\Model\Row $model 
         * @param \Phalcon\Db\Result\Pdo|null $result 
         * @param \Phalcon\Cache\BackendInterface $cache 
         * @param boolean $keepSnapshots 
         */
        public function __construct($columnMap, $model, $result, \Phalcon\Cache\BackendInterface $cache = null, $keepSnapshots = null) {}
        /**
         * Returns current row in the resultset
         *
         * @return bool|ModelInterface 
         */
        public final function current() {}
        /**
         * Returns a complete resultset as an array, if the resultset has a big number of rows
         * it could consume more memory than currently it does. Export the resultset to an array
         * couldn't be faster with a large number of records
         *
         * @param bool $renameColumns 
         * @return array 
         */
        public function toArray($renameColumns = true) {}
        /**
         * Serializing a resultset will dump all related rows into a big array
         *
         * @return string 
         */
        public function serialize() {}
        /**
         * Unserializing a resultset will allow to only works on the rows present in the saved state
         *
         * @param string $data 
         */
        public function unserialize($data) {}
    }
}

namespace \Phalcon\Mvc\Model\Transaction {
    /**
     * Phalcon\Mvc\Model\Transaction\Exception
     * Exceptions thrown in Phalcon\Mvc\Model\Transaction will use this class
     */
    class Exception extends \Phalcon\Mvc\Model\Exception
    {
    }

    /**
     * Phalcon\Mvc\Model\Transaction\Failed
     * This class will be thrown to exit a try/catch block for isolated transactions
     */
    class Failed extends \Phalcon\Mvc\Model\Transaction\Exception
    {
        protected $_record = null;
        /**
         * Phalcon\Mvc\Model\Transaction\Failed constructor
         *
         * @param string $message 
         * @param mixed $record 
         */
        public function __construct($message, \Phalcon\Mvc\ModelInterface $record = null) {}
        /**
         * Returns validation record messages which stop the transaction
         *
         * @return MessageInterface[] 
         */
        public function getRecordMessages() {}
        /**
         * Returns validation record messages which stop the transaction
         *
         * @return \Phalcon\Mvc\ModelInterface 
         */
        public function getRecord() {}
    }

    /**
     * Phalcon\Mvc\Model\Transaction\Manager
     * A transaction acts on a single database connection. If you have multiple class-specific
     * databases, the transaction will not protect interaction among them.
     * This class manages the objects that compose a transaction.
     * A transaction produces a unique connection that is passed to every
     * object part of the transaction.
     * <code>
     * try {
     * use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
     * $transactionManager = new TransactionManager();
     * $transaction = $transactionManager->get();
     * $robot = new Robots();
     * $robot->setTransaction($transaction);
     * $robot->name = 'WALL·E';
     * $robot->created_at = date('Y-m-d');
     * if($robot->save()==false){
     * $transaction->rollback("Can't save robot");
     * }
     * $robotPart = new RobotParts();
     * $robotPart->setTransaction($transaction);
     * $robotPart->type = 'head';
     * if($robotPart->save()==false){
     * $transaction->rollback("Can't save robot part");
     * }
     * $transaction->commit();
     * } catch (Phalcon\Mvc\Model\Transaction\Failed $e) {
     * echo 'Failed, reason: ', $e->getMessage();
     * }
     * </code>
     */
    class Manager implements \Phalcon\Mvc\Model\Transaction\ManagerInterface, \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_initialized = false;
        protected $_rollbackPendent = true;
        protected $_number = 0;
        protected $_service = "db";
        protected $_transactions;
        /**
         * Phalcon\Mvc\Model\Transaction\Manager constructor
         *
         * @param mixed $dependencyInjector 
         */
        public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Sets the dependency injection container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the dependency injection container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the database service used to run the isolated transactions
         *
         * @param string $service 
         * @return Manager 
         */
        public function setDbService($service) {}
        /**
         * Returns the database service used to isolate the transaction
         *
         * @return string 
         */
        public function getDbService() {}
        /**
         * Set if the transaction manager must register a shutdown function to clean up pendent transactions
         *
         * @param bool $rollbackPendent 
         * @return Manager 
         */
        public function setRollbackPendent($rollbackPendent) {}
        /**
         * Check if the transaction manager is registering a shutdown function to clean up pendent transactions
         *
         * @return bool 
         */
        public function getRollbackPendent() {}
        /**
         * Checks whether the manager has an active transaction
         *
         * @return bool 
         */
        public function has() {}
        /**
         * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
         * This method registers a shutdown function to rollback active connections
         *
         * @param bool $autoBegin 
         * @return \Phalcon\Mvc\Model\TransactionInterface 
         */
        public function get($autoBegin = true) {}
        /**
         * Create/Returns a new transaction or an existing one
         *
         * @param bool $autoBegin 
         * @return \Phalcon\Mvc\Model\TransactionInterface 
         */
        public function getOrCreateTransaction($autoBegin = true) {}
        /**
         * Rollbacks active transactions within the manager
         */
        public function rollbackPendent() {}
        /**
         * Commits active transactions within the manager
         */
        public function commit() {}
        /**
         * Rollbacks active transactions within the manager
         * Collect will remove the transaction from the manager
         *
         * @param boolean $collect 
         */
        public function rollback($collect = true) {}
        /**
         * Notifies the manager about a rollbacked transaction
         *
         * @param mixed $transaction 
         */
        public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}
        /**
         * Notifies the manager about a committed transaction
         *
         * @param mixed $transaction 
         */
        public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}
        /**
         * Removes transactions from the TransactionManager
         *
         * @param mixed $transaction 
         */
        protected function _collectTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}
        /**
         * Remove all the transactions from the manager
         */
        public function collectTransactions() {}
    }

    /**
     * Phalcon\Mvc\Model\Transaction\ManagerInterface
     * Interface for Phalcon\Mvc\Model\Transaction\Manager
     */
    interface ManagerInterface
    {
        /**
         * Checks whether manager has an active transaction
         *
         * @return bool 
         */
        public function has();
        /**
         * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
         *
         * @param bool $autoBegin 
         * @return \Phalcon\Mvc\Model\TransactionInterface 
         */
        public function get($autoBegin = true);
        /**
         * Rollbacks active transactions within the manager
         */
        public function rollbackPendent();
        /**
         * Commits active transactions within the manager
         */
        public function commit();
        /**
         * Rollbacks active transactions within the manager
         * Collect will remove transaction from the manager
         *
         * @param boolean $collect 
         */
        public function rollback($collect = false);
        /**
         * Notifies the manager about a rollbacked transaction
         *
         * @param mixed $transaction 
         */
        public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction);
        /**
         * Notifies the manager about a committed transaction
         *
         * @param mixed $transaction 
         */
        public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction);
        /**
         * Remove all the transactions from the manager
         */
        public function collectTransactions();
    }
}

namespace \Phalcon\Mvc\Model\Validator {
    /**
     * Phalcon\Mvc\Model\Validator\Email
     * Allows to validate if email fields has correct values
     * <code>
     * use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new EmailValidator(array(
     * 'field' => 'electronic_mail'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Email extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\ExclusionIn
     * Check if a value is not included into a list of values
     * <code>
     * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionInValidator;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new ExclusionInValidator(array(
     * 'field' => 'status',
     * 'domain' => array('A', 'I')
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Exclusionin extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\InclusionIn
     * Check if a value is included into a list of values
     * <code>
     * use Phalcon\Mvc\Model\Validator\InclusionIn as InclusionInValidator;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new InclusionInValidator(array(
     * "field" => 'status',
     * 'domain' => array('A', 'I')
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Inclusionin extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\IP
     * Validates that a value is ipv4 address in valid range
     * <code>
     * use Phalcon\Mvc\Model\Validator\Ip;
     * class Data extends Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * // Any pubic IP
     * $this->validate(new IP(array(
     * 'field'             => 'server_ip',
     * 'version'           => IP::VERSION_4 | IP::VERSION_6, // v6 and v4. The same if not specified
     * 'allowReserved'     => false,   // False if not specified. Ignored for v6
     * 'allowPrivate'      => false,   // False if not specified
     * 'message'           => 'IP address has to be correct'
     * )));
     * // Any public v4 address
     * $this->validate(new IP(array(
     * 'field'             => 'ip_4',
     * 'version'           => IP::VERSION_4,
     * 'message'           => 'IP address has to be correct'
     * )));
     * // Any v6 address
     * $this->validate(new IP(array(
     * 'field'             => 'ip6',
     * 'version'           => IP::VERSION_6,
     * 'allowPrivate'      => true,
     * 'message'           => 'IP address has to be correct'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Ip extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        const VERSION_4 = 1048576;
        const VERSION_6 = 2097152;
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\Numericality
     * Allows to validate if a field has a valid numeric format
     * <code>
     * use Phalcon\Mvc\Model\Validator\Numericality as NumericalityValidator;
     * class Products extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new NumericalityValidator(array(
     * "field" => 'price'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Numericality extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\PresenceOf
     * Allows to validate if a filed have a value different of null and empty string ("")
     * <code>
     * use Phalcon\Mvc\Model\Validator\PresenceOf;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new PresenceOf(array(
     * "field" => 'name',
     * "message" => 'The name is required'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class PresenceOf extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\Regex
     * Allows validate if the value of a field matches a regular expression
     * <code>
     * use Phalcon\Mvc\Model\Validator\Regex as RegexValidator;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new RegexValidator(array(
     * "field" => 'created_at',
     * 'pattern' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])/'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Regex extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\StringLength
     * Simply validates specified string length constraints
     * <code>
     * use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
     * class Subscriptors extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new StringLengthValidator(array(
     * "field" => 'name_last',
     * 'max' => 50,
     * 'min' => 2,
     * 'messageMaximum' => 'We don\'t like really long names',
     * 'messageMinimum' => 'We want more than just their initials'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class StringLength extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\Uniqueness
     * Validates that a field or a combination of a set of fields are not
     * present more than once in the existing records of the related table
     * <code>
     * use Phalcon\Mvc\Model;
     * use Phalcon\Mvc\Model\Validator\Uniqueness;
     * class Subscriptors extends Model
     * {
     * public function validation()
     * {
     * $this->validate(new Uniqueness(array(
     * "field"   => "email",
     * "message" => "Value of field 'email' is already present in another record"
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Uniqueness extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }

    /**
     * Phalcon\Mvc\Model\Validator\Url
     * Allows to validate if a field has a url format
     * <code>
     * use Phalcon\Mvc\Model\Validator\Url as UrlValidator;
     * class Posts extends \Phalcon\Mvc\Model
     * {
     * public function validation()
     * {
     * $this->validate(new UrlValidator(array(
     * 'field' => 'source_url'
     * )));
     * if ($this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     */
    class Url extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
    {
        /**
         * Executes the validator
         *
         * @param mixed $record 
         * @return bool 
         */
        public function validate(\Phalcon\Mvc\EntityInterface $record) {}
    }
}

namespace \Phalcon\Mvc\Router {
    /**
     * Phalcon\Mvc\Router\Annotations
     * A router that reads routes annotations from classes/resources
     * <code>
     * $di['router'] = function() {
     * //Use the annotations router
     * $router = new Annotations(false);
     * //This will do the same as above but only if the handled uri starts with /robots
     * $router->addResource('Robots', '/robots');
     * return $router;
     * };
     * </code>
     */
    class Annotations extends \Phalcon\Mvc\Router
    {
        protected $_handlers = array();
        protected $_controllerSuffix = "Controller";
        protected $_actionSuffix = "Action";
        protected $_routePrefix;
        /**
         * Adds a resource to the annotations handler
         * A resource is a class that contains routing annotations
         *
         * @param string $handler 
         * @param string $prefix 
         * @return Annotations 
         */
        public function addResource($handler, $prefix = null) {}
        /**
         * Adds a resource to the annotations handler
         * A resource is a class that contains routing annotations
         * The class is located in a module
         *
         * @param string $module 
         * @param string $handler 
         * @param string $prefix 
         * @return Annotations 
         */
        public function addModuleResource($module, $handler, $prefix = null) {}
        /**
         * Produce the routing parameters from the rewrite information
         *
         * @param string $uri 
         */
        public function handle($uri = null) {}
        /**
         * Checks for annotations in the controller docblock
         *
         * @param string $handler 
         * @param mixed $annotation 
         */
        public function processControllerAnnotation($handler, \Phalcon\Annotations\Annotation $annotation) {}
        /**
         * Checks for annotations in the public methods of the controller
         *
         * @param string $module 
         * @param string $namespaceName 
         * @param string $controller 
         * @param string $action 
         * @param mixed $annotation 
         */
        public function processActionAnnotation($module, $namespaceName, $controller, $action, \Phalcon\Annotations\Annotation $annotation) {}
        /**
         * Changes the controller class suffix
         *
         * @param string $controllerSuffix 
         */
        public function setControllerSuffix($controllerSuffix) {}
        /**
         * Changes the action method suffix
         *
         * @param string $actionSuffix 
         */
        public function setActionSuffix($actionSuffix) {}
        /**
         * Return the registered resources
         *
         * @return array 
         */
        public function getResources() {}
    }

    /**
     * Phalcon\Mvc\Router\Exception
     * Exceptions thrown in Phalcon\Mvc\Router will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Mvc\Router\Group
     * Helper class to create a group of routes with common attributes
     * <code>
     * $router = new \Phalcon\Mvc\Router();
     * //Create a group with a common module and controller
     * $blog = new Group(array(
     * 'module' => 'blog',
     * 'controller' => 'index'
     * ));
     * //All the routes start with /blog
     * $blog->setPrefix('/blog');
     * //Add a route to the group
     * $blog->add('/save', array(
     * 'action' => 'save'
     * ));
     * //Add another route to the group
     * $blog->add('/edit/{id}', array(
     * 'action' => 'edit'
     * ));
     * //This route maps to a controller different than the default
     * $blog->add('/blog', array(
     * 'controller' => 'about',
     * 'action' => 'index'
     * ));
     * //Add the group to the router
     * $router->mount($blog);
     * </code>
     */
    class Group implements \Phalcon\Mvc\Router\GroupInterface
    {
        protected $_prefix;
        protected $_hostname;
        protected $_paths;
        protected $_routes;
        protected $_beforeMatch;
        /**
         * Phalcon\Mvc\Router\Group constructor
         *
         * @param mixed $paths 
         */
        public function __construct($paths = null) {}
        /**
         * Set a hostname restriction for all the routes in the group
         *
         * @param string $hostname 
         * @return GroupInterface 
         */
        public function setHostname($hostname) {}
        /**
         * Returns the hostname restriction
         *
         * @return string 
         */
        public function getHostname() {}
        /**
         * Set a common uri prefix for all the routes in this group
         *
         * @param string $prefix 
         * @return GroupInterface 
         */
        public function setPrefix($prefix) {}
        /**
         * Returns the common prefix for all the routes
         *
         * @return string 
         */
        public function getPrefix() {}
        /**
         * Sets a callback that is called if the route is matched.
         * The developer can implement any arbitrary conditions here
         * If the callback returns false the route is treated as not matched
         *
         * @param callable $beforeMatch 
         * @return GroupInterface 
         */
        public function beforeMatch($beforeMatch) {}
        /**
         * Returns the 'before match' callback if any
         *
         * @return callable 
         */
        public function getBeforeMatch() {}
        /**
         * Set common paths for all the routes in the group
         *
         * @param mixed $paths 
         * @return GroupInterface 
         */
        public function setPaths($paths) {}
        /**
         * Returns the common paths defined for this group
         *
         * @return array|string 
         */
        public function getPaths() {}
        /**
         * Returns the routes added to the group
         *
         * @return RouteInterface[] 
         */
        public function getRoutes() {}
        /**
         * Adds a route to the router on any HTTP method
         * <code>
         * router->add('/about', 'About::index');
         * </code>
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         * @return RouteInterface 
         */
        public function add($pattern, $paths = null, $httpMethods = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is GET
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addGet($pattern, $paths = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is POST
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addPost($pattern, $paths = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is PUT
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addPut($pattern, $paths = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is PATCH
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addPatch($pattern, $paths = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is DELETE
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addDelete($pattern, $paths = null) {}
        /**
         * Add a route to the router that only match if the HTTP method is OPTIONS
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addOptions($pattern, $paths = null) {}
        /**
         * Adds a route to the router that only match if the HTTP method is HEAD
         *
         * @param string $pattern 
         * @param string/array $paths 
         * @return \Phalcon\Mvc\Router\Route 
         */
        public function addHead($pattern, $paths = null) {}
        /**
         * Removes all the pre-defined routes
         */
        public function clear() {}
        /**
         * Adds a route applying the common attributes
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         * @return RouteInterface 
         */
        protected function _addRoute($pattern, $paths = null, $httpMethods = null) {}
    }

    /**
     * Phalcon\Mvc\Router\GroupInterface
     * <code>
     * $router = new \Phalcon\Mvc\Router();
     * //Create a group with a common module and controller
     * $blog = new Group(array(
     * 'module' => 'blog',
     * 'controller' => 'index'
     * ));
     * //All the routes start with /blog
     * $blog->setPrefix('/blog');
     * //Add a route to the group
     * $blog->add('/save', array(
     * 'action' => 'save'
     * ));
     * //Add another route to the group
     * $blog->add('/edit/{id}', array(
     * 'action' => 'edit'
     * ));
     * //This route maps to a controller different than the default
     * $blog->add('/blog', array(
     * 'controller' => 'about',
     * 'action' => 'index'
     * ));
     * //Add the group to the router
     * $router->mount($blog);
     * </code>
     */
    interface GroupInterface
    {
        /**
         * Set a hostname restriction for all the routes in the group
         *
         * @param string $hostname 
         * @return GroupInterface 
         */
        public function setHostname($hostname);
        /**
         * Returns the hostname restriction
         *
         * @return string 
         */
        public function getHostname();
        /**
         * Set a common uri prefix for all the routes in this group
         *
         * @param string $prefix 
         * @return GroupInterface 
         */
        public function setPrefix($prefix);
        /**
         * Returns the common prefix for all the routes
         *
         * @return string 
         */
        public function getPrefix();
        /**
         * Sets a callback that is called if the route is matched.
         * The developer can implement any arbitrary conditions here
         * If the callback returns false the route is treated as not matched
         *
         * @param callable $beforeMatch 
         * @return GroupInterface 
         */
        public function beforeMatch($beforeMatch);
        /**
         * Returns the 'before match' callback if any
         *
         * @return callable 
         */
        public function getBeforeMatch();
        /**
         * Set common paths for all the routes in the group
         *
         * @param array $paths 
         * @return \Phalcon\Mvc\Router\Group 
         */
        public function setPaths($paths);
        /**
         * Returns the common paths defined for this group
         *
         * @return array|string 
         */
        public function getPaths();
        /**
         * Returns the routes added to the group
         *
         * @return RouteInterface[] 
         */
        public function getRoutes();
        /**
         * Adds a route to the router on any HTTP method
         * <code>
         * router->add('/about', 'About::index');
         * </code>
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function add($pattern, $paths = null, $httpMethods = null);
        /**
         * Adds a route to the router that only match if the HTTP method is GET
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addGet($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is POST
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPost($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is PUT
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPut($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is PATCH
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addPatch($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is DELETE
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addDelete($pattern, $paths = null);
        /**
         * Add a route to the router that only match if the HTTP method is OPTIONS
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addOptions($pattern, $paths = null);
        /**
         * Adds a route to the router that only match if the HTTP method is HEAD
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @return \Phalcon\Mvc\Router\RouteInterface 
         */
        public function addHead($pattern, $paths = null);
        /**
         * Removes all the pre-defined routes
         */
        public function clear();
    }

    /**
     * Phalcon\Mvc\Router\Route
     * This class represents every route added to the router
     */
    class Route implements \Phalcon\Mvc\Router\RouteInterface
    {
        protected $_pattern;
        protected $_compiledPattern;
        protected $_paths;
        protected $_methods;
        protected $_hostname;
        protected $_converters;
        protected $_id;
        protected $_name;
        protected $_beforeMatch;
        protected $_match;
        protected $_group;
        static protected $_uniqueId;
        /**
         * Phalcon\Mvc\Router\Route constructor
         *
         * @param string $pattern 
         * @param mixed $paths 
         * @param mixed $httpMethods 
         */
        public function __construct($pattern, $paths = null, $httpMethods = null) {}
        /**
         * Replaces placeholders from pattern returning a valid PCRE regular expression
         *
         * @param string $pattern 
         * @return string 
         */
        public function compilePattern($pattern) {}
        /**
         * Set one or more HTTP methods that constraint the matching of the route
         * <code>
         * $route->via('GET');
         * $route->via(array('GET', 'POST'));
         * </code>
         *
         * @param mixed $httpMethods 
         * @return Route 
         */
        public function via($httpMethods) {}
        /**
         * Extracts parameters from a string
         *
         * @param string $pattern 
         * @return array|bool 
         */
        public function extractNamedParams($pattern) {}
        /**
         * Reconfigure the route adding a new pattern and a set of paths
         *
         * @param string $pattern 
         * @param mixed $paths 
         */
        public function reConfigure($pattern, $paths = null) {}
        /**
         * Returns routePaths
         *
         * @param mixed $paths 
         * @return array 
         */
        public static function getRoutePaths($paths = null) {}
        /**
         * Returns the route's name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * Sets the route's name
         * <code>
         * $router->add('/about', array(
         * 'controller' => 'about'
         * ))->setName('about');
         * </code>
         *
         * @param string $name 
         * @return Route 
         */
        public function setName($name) {}
        /**
         * Sets a callback that is called if the route is matched.
         * The developer can implement any arbitrary conditions here
         * If the callback returns false the route is treated as not matched
         * <code>
         * $router->add('/login', array(
         * 'module'     => 'admin',
         * 'controller' => 'session'
         * ))->beforeMatch(function ($uri, $route) {
         * // Check if the request was made with Ajax
         * if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest') {
         * return false;
         * }
         * return true;
         * });
         * </code>
         *
         * @param mixed $callback 
         * @return Route 
         */
        public function beforeMatch($callback) {}
        /**
         * Returns the 'before match' callback if any
         *
         * @return callable 
         */
        public function getBeforeMatch() {}
        /**
         * Allows to set a callback to handle the request directly in the route
         * <code>
         * $router->add("/help", array())->match(function () {
         * return $this->getResponse()->redirect('https://support.google.com/', true);
         * });
         * </code>
         *
         * @param mixed $callback 
         * @return Route 
         */
        public function match($callback) {}
        /**
         * Returns the 'match' callback if any
         *
         * @return callable 
         */
        public function getMatch() {}
        /**
         * Returns the route's id
         *
         * @return string 
         */
        public function getRouteId() {}
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getPattern() {}
        /**
         * Returns the route's compiled pattern
         *
         * @return string 
         */
        public function getCompiledPattern() {}
        /**
         * Returns the paths
         *
         * @return array 
         */
        public function getPaths() {}
        /**
         * Returns the paths using positions as keys and names as values
         *
         * @return array 
         */
        public function getReversedPaths() {}
        /**
         * Sets a set of HTTP methods that constraint the matching of the route (alias of via)
         * <code>
         * $route->setHttpMethods('GET');
         * $route->setHttpMethods(array('GET', 'POST'));
         * </code>
         *
         * @param mixed $httpMethods 
         * @return Route 
         */
        public function setHttpMethods($httpMethods) {}
        /**
         * Returns the HTTP methods that constraint matching the route
         *
         * @return array|string 
         */
        public function getHttpMethods() {}
        /**
         * Sets a hostname restriction to the route
         * <code>
         * $route->setHostname('localhost');
         * </code>
         *
         * @param string $hostname 
         * @return Route 
         */
        public function setHostname($hostname) {}
        /**
         * Returns the hostname restriction if any
         *
         * @return string 
         */
        public function getHostname() {}
        /**
         * Sets the group associated with the route
         *
         * @param mixed $group 
         * @return Route 
         */
        public function setGroup(GroupInterface $group) {}
        /**
         * Returns the group associated with the route
         *
         * @return null|GroupInterface 
         */
        public function getGroup() {}
        /**
         * Adds a converter to perform an additional transformation for certain parameter
         *
         * @param string $name 
         * @param mixed $converter 
         * @return Route 
         */
        public function convert($name, $converter) {}
        /**
         * Returns the router converter
         *
         * @return array 
         */
        public function getConverters() {}
        /**
         * Resets the internal route id generator
         */
        public static function reset() {}
    }

    /**
     * Phalcon\Mvc\Router\RouteInterface
     * Interface for Phalcon\Mvc\Router\Route
     */
    interface RouteInterface
    {
        /**
         * Sets a hostname restriction to the route
         *
         * @param string $hostname 
         * @return RouteInterface 
         */
        public function setHostname($hostname);
        /**
         * Returns the hostname restriction if any
         *
         * @return string 
         */
        public function getHostname();
        /**
         * Replaces placeholders from pattern returning a valid PCRE regular expression
         *
         * @param string $pattern 
         * @return string 
         */
        public function compilePattern($pattern);
        /**
         * Set one or more HTTP methods that constraint the matching of the route
         *
         * @param mixed $httpMethods 
         */
        public function via($httpMethods);
        /**
         * Reconfigure the route adding a new pattern and a set of paths
         *
         * @param string $pattern 
         * @param mixed $paths 
         */
        public function reConfigure($pattern, $paths = null);
        /**
         * Returns the route's name
         *
         * @return string 
         */
        public function getName();
        /**
         * Sets the route's name
         *
         * @param string $name 
         */
        public function setName($name);
        /**
         * Sets a set of HTTP methods that constraint the matching of the route
         *
         * @param mixed $httpMethods 
         * @return RouteInterface 
         */
        public function setHttpMethods($httpMethods);
        /**
         * Returns the route's id
         *
         * @return string 
         */
        public function getRouteId();
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getPattern();
        /**
         * Returns the route's pattern
         *
         * @return string 
         */
        public function getCompiledPattern();
        /**
         * Returns the paths
         *
         * @return array 
         */
        public function getPaths();
        /**
         * Returns the paths using positions as keys and names as values
         *
         * @return array 
         */
        public function getReversedPaths();
        /**
         * Returns the HTTP methods that constraint matching the route
         *
         * @return string|array 
         */
        public function getHttpMethods();
        /**
         * Resets the internal route id generator
         */
        public static function reset();
    }
}

namespace \Phalcon\Mvc\Url {
    /**
     * Phalcon\Mvc\Url\Exception
     * Exceptions thrown in Phalcon\Mvc\Url will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Mvc\User {
    /**
     * Phalcon\Mvc\User\Component
     * This class can be used to provide user components easy access to services
     * in the application
     */
    class Component extends \Phalcon\Di\Injectable
    {
    }

    /**
     * Phalcon\Mvc\User\Module
     * This class can be used to provide user modules easy access to services
     * in the application
     */
    class Module extends \Phalcon\Di\Injectable
    {
    }

    /**
     * Phalcon\Mvc\User\Plugin
     * This class can be used to provide user plugins an easy access to services
     * in the application
     */
    class Plugin extends \Phalcon\Di\Injectable
    {
    }
}

namespace \Phalcon\Mvc\View {
    /**
     * Phalcon\Mvc\View\Engine
     * All the template engine adapters must inherit this class. This provides
     * basic interfacing between the engine and the Phalcon\Mvc\View component.
     */
    abstract class Engine extends \Phalcon\Di\Injectable
    {
        protected $_view;
        /**
         * Phalcon\Mvc\View\Engine constructor
         *
         * @param mixed $view 
         * @param mixed $dependencyInjector 
         */
        public function __construct(\Phalcon\Mvc\ViewBaseInterface $view, \Phalcon\DiInterface $dependencyInjector = null) {}
        /**
         * Returns cached output on another view stage
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Renders a partial inside another view
         *
         * @param string $partialPath 
         * @param array $params 
         * @return string 
         */
        public function partial($partialPath, $params = null) {}
        /**
         * Returns the view component related to the adapter
         *
         * @return \Phalcon\Mvc\ViewBaseInterface 
         */
        public function getView() {}
    }

    /**
     * Phalcon\Mvc\View\EngineInterface
     * Interface for Phalcon\Mvc\View engine adapters
     */
    interface EngineInterface
    {
        /**
         * Returns cached output on another view stage
         *
         * @return array 
         */
        public function getContent();
        /**
         * Renders a partial inside another view
         *
         * @param string $partialPath 
         * @param mixed $params 
         * @return string 
         */
        public function partial($partialPath, $params = null);
        /**
         * Renders a view using the template engine
         *
         * @param string $path 
         * @param mixed $params 
         * @param bool $mustClean 
         */
        public function render($path, $params, $mustClean = false);
    }

    /**
     * Phalcon\Mvc\View\Exception
     * Class for exceptions thrown by Phalcon\Mvc\View
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Mvc\View\Simple
     * This component allows to render views without hierarchical levels
     * <code>
     * use Phalcon\Mvc\View\Simple as View;
     * $view = new View();
     * // Render a view
     * echo $view->render('templates/my-view', ['some' => $param]);
     * // Or with filename with extension
     * echo $view->render('templates/my-view.volt', ['parameter' => $here]);
     * </code>
     */
    class Simple extends \Phalcon\Di\Injectable implements \Phalcon\Mvc\ViewBaseInterface
    {
        protected $_options;
        protected $_viewsDir;
        protected $_partialsDir;
        protected $_viewParams;
        /**
         * @var \Phalcon\Mvc\View\EngineInterface[]|false
         */
        protected $_engines = false;
        /**
         * @var array|null
         */
        protected $_registeredEngines;
        protected $_activeRenderPath;
        protected $_content;
        protected $_cache = false;
        protected $_cacheOptions;
        /**
         * @return array|null 
         */
        public function getRegisteredEngines() {}
        /**
         * Phalcon\Mvc\View\Simple constructor
         *
         * @param array $options 
         */
        public function __construct(array $options = array()) {}
        /**
         * Sets views directory. Depending of your platform, always add a trailing slash or backslash
         *
         * @param string $viewsDir 
         */
        public function setViewsDir($viewsDir) {}
        /**
         * Gets views directory
         *
         * @return string 
         */
        public function getViewsDir() {}
        /**
         * Register templating engines
         * <code>
         * $this->view->registerEngines([
         * '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
         * '.volt'  => 'Phalcon\Mvc\View\Engine\Volt',
         * '.mhtml' => 'MyCustomEngine'
         * ]);
         * </code>
         *
         * @param array $engines 
         */
        public function registerEngines(array $engines) {}
        /**
         * Loads registered template engines, if none is registered it will use Phalcon\Mvc\View\Engine\Php
         *
         * @return array 
         */
        protected function _loadTemplateEngines() {}
        /**
         * Tries to render the view with every engine registered in the component
         *
         * @param string $path 
         * @param array $params 
         */
        protected final function _internalRender($path, $params) {}
        /**
         * Renders a view
         *
         * @param string $path 
         * @param array $params 
         * @return string 
         */
        public function render($path, $params = null) {}
        /**
         * Renders a partial view
         * <code>
         * // Show a partial inside another view
         * $this->partial('shared/footer');
         * </code>
         * <code>
         * // Show a partial inside another view with parameters
         * $this->partial('shared/footer', ['content' => $html]);
         * </code>
         *
         * @param string $partialPath 
         * @param mixed $params 
         */
        public function partial($partialPath, $params = null) {}
        /**
         * Sets the cache options
         *
         * @param array $options 
         * @return Simple 
         */
        public function setCacheOptions(array $options) {}
        /**
         * Returns the cache options
         *
         * @return array 
         */
        public function getCacheOptions() {}
        /**
         * Create a Phalcon\Cache based on the internal cache options
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        protected function _createCache() {}
        /**
         * Returns the cache instance used to cache
         *
         * @return \Phalcon\Cache\BackendInterface 
         */
        public function getCache() {}
        /**
         * Cache the actual view render to certain level
         * <code>
         * $this->view->cache(['key' => 'my-key', 'lifetime' => 86400]);
         * </code>
         *
         * @param mixed $options 
         * @return Simple 
         */
        public function cache($options = true) {}
        /**
         * Adds parameters to views (alias of setVar)
         * <code>
         * $this->view->setParamToView('products', $products);
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         * @return Simple 
         */
        public function setParamToView($key, $value) {}
        /**
         * Set all the render params
         * <code>
         * $this->view->setVars(['products' => $products]);
         * </code>
         *
         * @param array $params 
         * @param bool $merge 
         * @return Simple 
         */
        public function setVars(array $params, $merge = true) {}
        /**
         * Set a single view parameter
         * <code>
         * $this->view->setVar('products', $products);
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         * @return Simple 
         */
        public function setVar($key, $value) {}
        /**
         * Returns a parameter previously set in the view
         *
         * @param string $key 
         * @return mixed|null 
         */
        public function getVar($key) {}
        /**
         * Returns parameters to views
         *
         * @return array 
         */
        public function getParamsToView() {}
        /**
         * Externally sets the view content
         * <code>
         * $this->view->setContent("<h1>hello</h1>");
         * </code>
         *
         * @param string $content 
         * @return Simple 
         */
        public function setContent($content) {}
        /**
         * Returns cached output from another view stage
         *
         * @return string 
         */
        public function getContent() {}
        /**
         * Returns the path of the view that is currently rendered
         *
         * @return string 
         */
        public function getActiveRenderPath() {}
        /**
         * Magic method to pass variables to the views
         * <code>
         * $this->view->products = $products;
         * </code>
         *
         * @param string $key 
         * @param mixed $value 
         */
        public function __set($key, $value) {}
        /**
         * Magic method to retrieve a variable passed to the view
         * <code>
         * echo $this->view->products;
         * </code>
         *
         * @param string $key 
         * @return mixed|null 
         */
        public function __get($key) {}
    }
}

namespace \Phalcon\Mvc\View\Engine {
    /**
     * Phalcon\Mvc\View\Engine\Php
     * Adapter to use PHP itself as templating engine
     */
    class Php extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface
    {
        /**
         * Renders a view using the template engine
         *
         * @param string $path 
         * @param mixed $params 
         * @param bool $mustClean 
         */
        public function render($path, $params, $mustClean = false) {}
    }

    /**
     * Phalcon\Mvc\View\Engine\Volt
     * Designer friendly and fast template engine for PHP written in Zephir/C
     */
    class Volt extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface
    {
        protected $_options;
        protected $_compiler;
        protected $_macros;
        /**
         * Set Volt's options
         *
         * @param array $options 
         */
        public function setOptions(array $options) {}
        /**
         * Return Volt's options
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * Returns the Volt's compiler
         *
         * @return \Phalcon\Mvc\View\Engine\Volt\Compiler 
         */
        public function getCompiler() {}
        /**
         * Renders a view using the template engine
         *
         * @param string $templatePath 
         * @param mixed $params 
         * @param bool $mustClean 
         */
        public function render($templatePath, $params, $mustClean = false) {}
        /**
         * Length filter. If an array/object is passed a count is performed otherwise a strlen/mb_strlen
         *
         * @param mixed $item 
         * @return int 
         */
        public function length($item) {}
        /**
         * Checks if the needle is included in the haystack
         *
         * @param mixed $needle 
         * @param mixed $haystack 
         * @return bool 
         */
        public function isIncluded($needle, $haystack) {}
        /**
         * Performs a string conversion
         *
         * @param string $text 
         * @param string $from 
         * @param string $to 
         * @return string 
         */
        public function convertEncoding($text, $from, $to) {}
        /**
         * Extracts a slice from a string/array/traversable object value
         *
         * @param mixed $value 
         * @param int $start 
         * @param mixed $end 
         */
        public function slice($value, $start = 0, $end = null) {}
        /**
         * Sorts an array
         *
         * @param array $value 
         * @return array 
         */
        public function sort(array $value) {}
        /**
         * Checks if a macro is defined and calls it
         *
         * @param string $name 
         * @param array $arguments 
         * @return mixed 
         */
        public function callMacro($name, array $arguments = array()) {}
    }
}

namespace \Phalcon\Mvc\View\Engine\Volt {
    /**
     * Phalcon\Mvc\View\Engine\Volt\Compiler
     * This class reads and compiles Volt templates into PHP plain code
     * <code>
     * $compiler = new \Phalcon\Mvc\View\Engine\Volt\Compiler();
     * $compiler->compile('views/partials/header.volt');
     * require $compiler->getCompiledTemplatePath();
     * </code>
     */
    class Compiler implements \Phalcon\Di\InjectionAwareInterface
    {
        protected $_dependencyInjector;
        protected $_view;
        protected $_options;
        protected $_arrayHelpers;
        protected $_level = 0;
        protected $_foreachLevel = 0;
        protected $_blockLevel = 0;
        protected $_exprLevel = 0;
        protected $_extended = false;
        protected $_autoescape = false;
        protected $_extendedBlocks;
        protected $_currentBlock;
        protected $_blocks;
        protected $_forElsePointers;
        protected $_loopPointers;
        protected $_extensions;
        protected $_functions;
        protected $_filters;
        protected $_macros;
        protected $_prefix;
        protected $_currentPath;
        protected $_compiledTemplatePath;
        /**
         * Phalcon\Mvc\View\Engine\Volt\Compiler
         *
         * @param mixed $view 
         */
        public function __construct(\Phalcon\Mvc\ViewBaseInterface $view = null) {}
        /**
         * Sets the dependency injector
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Sets the compiler options
         *
         * @param array $options 
         */
        public function setOptions(array $options) {}
        /**
         * Sets a single compiler option
         *
         * @param string $option 
         * @param mixed $value 
         */
        public function setOption($option, $value) {}
        /**
         * Returns a compiler's option
         *
         * @param string $option 
         * @return string 
         */
        public function getOption($option) {}
        /**
         * Returns the compiler options
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * Fires an event to registered extensions
         *
         * @param string $name 
         * @param array $arguments 
         * @return mixed 
         */
        public final function fireExtensionEvent($name, $arguments = null) {}
        /**
         * Registers a Volt's extension
         *
         * @param mixed $extension 
         * @return Compiler 
         */
        public function addExtension($extension) {}
        /**
         * Returns the list of extensions registered in Volt
         *
         * @return array 
         */
        public function getExtensions() {}
        /**
         * Register a new function in the compiler
         *
         * @param string $name 
         * @param mixed $definition 
         * @return Compiler 
         */
        public function addFunction($name, $definition) {}
        /**
         * Register the user registered functions
         *
         * @return array 
         */
        public function getFunctions() {}
        /**
         * Register a new filter in the compiler
         *
         * @param string $name 
         * @param mixed $definition 
         * @return Compiler 
         */
        public function addFilter($name, $definition) {}
        /**
         * Register the user registered filters
         *
         * @return array 
         */
        public function getFilters() {}
        /**
         * Set a unique prefix to be used as prefix for compiled variables
         *
         * @param string $prefix 
         * @return Compiler 
         */
        public function setUniquePrefix($prefix) {}
        /**
         * Return a unique prefix to be used as prefix for compiled variables and contexts
         *
         * @return string 
         */
        public function getUniquePrefix() {}
        /**
         * Resolves attribute reading
         *
         * @param array $expr 
         * @return string 
         */
        public function attributeReader(array $expr) {}
        /**
         * Resolves function intermediate code into PHP function calls
         *
         * @param array $expr 
         * @return string 
         */
        public function functionCall(array $expr) {}
        /**
         * Resolves filter intermediate code into a valid PHP expression
         *
         * @param array $test 
         * @param string $left 
         * @return string 
         */
        public function resolveTest(array $test, $left) {}
        /**
         * Resolves filter intermediate code into PHP function calls
         *
         * @param array $filter 
         * @param string $left 
         * @return string 
         */
        final protected function resolveFilter(array $filter, $left) {}
        /**
         * Resolves an expression node in an AST volt tree
         *
         * @param array $expr 
         * @return string 
         */
        final public function expression(array $expr) {}
        /**
         * Compiles a block of statements
         *
         * @param array $statements 
         * @return string|array 
         */
        final protected function _statementListOrExtends($statements) {}
        /**
         * Compiles a "foreach" intermediate code representation into plain PHP code
         *
         * @param array $statement 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileForeach(array $statement, $extendsMode = false) {}
        /**
         * Generates a 'forelse' PHP code
         *
         * @return string 
         */
        public function compileForElse() {}
        /**
         * Compiles a 'if' statement returning PHP code
         *
         * @param array $statement 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileIf(array $statement, $extendsMode = false) {}
        /**
         * Compiles a "elseif" statement returning PHP code
         *
         * @param array $statement 
         * @return string 
         */
        public function compileElseIf(array $statement) {}
        /**
         * Compiles a "cache" statement returning PHP code
         *
         * @param array $statement 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileCache(array $statement, $extendsMode = false) {}
        /**
         * Compiles a "set" statement returning PHP code
         *
         * @param array $statement 
         * @return string 
         */
        public function compileSet(array $statement) {}
        /**
         * Compiles a "do" statement returning PHP code
         *
         * @param array $statement 
         * @return string 
         */
        public function compileDo(array $statement) {}
        /**
         * Compiles a "return" statement returning PHP code
         *
         * @param array $statement 
         * @return string 
         */
        public function compileReturn(array $statement) {}
        /**
         * Compiles a "autoescape" statement returning PHP code
         *
         * @param array $statement 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileAutoEscape(array $statement, $extendsMode) {}
        /**
         * Compiles a '{{' '}}' statement returning PHP code
         *
         * @param array $statement 
         * @param boolean $extendsMode 
         * @return string 
         */
        public function compileEcho(array $statement) {}
        /**
         * Compiles a 'include' statement returning PHP code
         *
         * @param array $statement 
         * @return string 
         */
        public function compileInclude(array $statement) {}
        /**
         * Compiles macros
         *
         * @param array $statement 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileMacro(array $statement, $extendsMode) {}
        /**
         * Compiles calls to macros
         *
         * @param array $statement 
         * @param boolean $extendsMode 
         * @return string 
         */
        public function compileCall(array $statement, $extendsMode) {}
        /**
         * Traverses a statement list compiling each of its nodes
         *
         * @param array $statements 
         * @param bool $extendsMode 
         * @return string 
         */
        final protected function _statementList(array $statements, $extendsMode = false) {}
        /**
         * Compiles a Volt source code returning a PHP plain version
         *
         * @param string $viewCode 
         * @param bool $extendsMode 
         * @return string 
         */
        protected function _compileSource($viewCode, $extendsMode = false) {}
        /**
         * Compiles a template into a string
         * <code>
         * echo $compiler->compileString('{{ "hello world" }}');
         * </code>
         *
         * @param string $viewCode 
         * @param bool $extendsMode 
         * @return string 
         */
        public function compileString($viewCode, $extendsMode = false) {}
        /**
         * Compiles a template into a file forcing the destination path
         * <code>
         * $compiler->compile('views/layouts/main.volt', 'views/layouts/main.volt.php');
         * </code>
         *
         * @param string $path 
         * @param string $compiledPath 
         * @param boolean $extendsMode 
         * @return string|array 
         */
        public function compileFile($path, $compiledPath, $extendsMode = false) {}
        /**
         * Compiles a template into a file applying the compiler options
         * This method does not return the compiled path if the template was not compiled
         * <code>
         * $compiler->compile('views/layouts/main.volt');
         * require $compiler->getCompiledTemplatePath();
         * </code>
         *
         * @param string $templatePath 
         * @param bool $extendsMode 
         */
        public function compile($templatePath, $extendsMode = false) {}
        /**
         * Returns the path that is currently being compiled
         *
         * @return string 
         */
        public function getTemplatePath() {}
        /**
         * Returns the path to the last compiled template
         *
         * @return string 
         */
        public function getCompiledTemplatePath() {}
        /**
         * Parses a Volt template returning its intermediate representation
         * <code>
         * print_r($compiler->parse('{{ 3 + 2 }}'));
         * </code>
         *
         * @param string $viewCode 
         * @return array 
         */
        public function parse($viewCode) {}
        /**
         * Gets the final path with VIEW
         *
         * @param string $path 
         */
        protected function getFinalPath($path) {}
    }

    /**
     * Phalcon\Mvc\View\Exception
     * Class for exceptions thrown by Phalcon\Mvc\View
     */
    class Exception extends \Phalcon\Mvc\View\Exception
    {
    }
}

namespace \Phalcon\Paginator {
    /**
     * Phalcon\Paginator\Adapter
     */
    abstract class Adapter
    {
        /**
         * Number of rows to show in the paginator. By default is null
         */
        protected $_limitRows = null;
        /**
         * Current page in paginate
         */
        protected $_page = null;
        /**
         * Set the current page number
         *
         * @param int $page 
         * @return Adapter 
         */
        public function setCurrentPage($page) {}
        /**
         * Set current rows limit
         *
         * @param int $limitRows 
         * @return Adapter 
         */
        public function setLimit($limitRows) {}
        /**
         * Get current rows limit
         *
         * @return int 
         */
        public function getLimit() {}
    }

    /**
     * Phalcon\Paginator\AdapterInterface
     * Interface for Phalcon\Paginator adapters
     */
    interface AdapterInterface
    {
        /**
         * Set the current page number
         *
         * @param int $page 
         */
        public function setCurrentPage($page);
        /**
         * Returns a slice of the resultset to show in the pagination
         *
         * @return \stdClass 
         */
        public function getPaginate();
        /**
         * Set current rows limit
         *
         * @param int $limit 
         */
        public function setLimit($limit);
        /**
         * Get current rows limit
         *
         * @return int 
         */
        public function getLimit();
    }

    /**
     * Phalcon\Paginator\Exception
     * Exceptions thrown in Phalcon\Paginator will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Paginator\Adapter {
    /**
     * Phalcon\Paginator\Adapter\Model
     * This adapter allows to paginate data using a Phalcon\Mvc\Model resultset as a base
     * <code>
     * $paginator = new \Phalcon\Paginator\Adapter\Model(
     * array(
     * "data"  => Robots::find(),
     * "limit" => 25,
     * "page"  => $currentPage
     * )
     * );
     * $paginate = $paginator->getPaginate();
     * </code>
     */
    class Model extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
    {
        /**
         * Configuration of paginator by model
         */
        protected $_config = null;
        /**
         * Phalcon\Paginator\Adapter\Model constructor
         *
         * @param array $config 
         */
        public function __construct(array $config) {}
        /**
         * Returns a slice of the resultset to show in the pagination
         *
         * @return \stdclass 
         */
        public function getPaginate() {}
    }

    /**
     * Phalcon\Paginator\Adapter\NativeArray
     * Pagination using a PHP array as source of data
     * <code>
     * $paginator = new \Phalcon\Paginator\Adapter\NativeArray(
     * array(
     * "data"  => array(
     * array('id' => 1, 'name' => 'Artichoke'),
     * array('id' => 2, 'name' => 'Carrots'),
     * array('id' => 3, 'name' => 'Beet'),
     * array('id' => 4, 'name' => 'Lettuce'),
     * array('id' => 5, 'name' => '')
     * ),
     * "limit" => 2,
     * "page"  => $currentPage
     * )
     * );
     * </code>
     */
    class NativeArray extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
    {
        /**
         * Configuration of the paginator
         */
        protected $_config = null;
        /**
         * Phalcon\Paginator\Adapter\NativeArray constructor
         *
         * @param array $config 
         */
        public function __construct(array $config) {}
        /**
         * Returns a slice of the resultset to show in the pagination
         *
         * @return \stdClass 
         */
        public function getPaginate() {}
    }

    /**
     * Phalcon\Paginator\Adapter\QueryBuilder
     * Pagination using a PHQL query builder as source of data
     * <code>
     * $builder = $this->modelsManager->createBuilder()
     * ->columns('id, name')
     * ->from('Robots')
     * ->orderBy('name');
     * $paginator = new Phalcon\Paginator\Adapter\QueryBuilder(array(
     * "builder" => $builder,
     * "limit"=> 20,
     * "page" => 1
     * ));
     * </code>
     */
    class QueryBuilder extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
    {
        /**
         * Configuration of paginator by model
         */
        protected $_config;
        /**
         * Paginator's data
         */
        protected $_builder;
        /**
         * Phalcon\Paginator\Adapter\QueryBuilder
         *
         * @param array $config 
         */
        public function __construct(array $config) {}
        /**
         * Get the current page number
         *
         * @return int 
         */
        public function getCurrentPage() {}
        /**
         * Set query builder object
         *
         * @param mixed $builder 
         * @return QueryBuilder 
         */
        public function setQueryBuilder(\Phalcon\Mvc\Model\Query\Builder $builder) {}
        /**
         * Get query builder object
         *
         * @return \Phalcon\Mvc\Model\Query\Builder 
         */
        public function getQueryBuilder() {}
        /**
         * Returns a slice of the resultset to show in the pagination
         *
         * @return \stdClass 
         */
        public function getPaginate() {}
    }
}

namespace \Phalcon\Queue {
    /**
     * Phalcon\Queue\Beanstalk
     * Class to access the beanstalk queue service.
     * Partially implements the protocol version 1.2
     * <code>
     * use Phalcon\Queue\Beanstalk;
     * $queue = new Beanstalk([
     * 'host'       => '127.0.0.1',
     * 'port'       => 11300,
     * 'persistent' => true,
     * ]);
     * </code>
     *
     * @link http://www.igvita.com/2010/05/20/scalable-work-queues-with-beanstalk/
     */
    class Beanstalk
    {
        /**
         * Seconds to wait before putting the job in the ready queue.
         * The job will be in the "delayed" state during this time.
         *
         * @const integer
         */
        const DEFAULT_DELAY = 0;
        /**
         * Jobs with smaller priority values will be scheduled before jobs with larger priorities.
         * The most urgent priority is 0, the least urgent priority is 4294967295.
         *
         * @const integer
         */
        const DEFAULT_PRIORITY = 100;
        /**
         * Time to run - number of seconds to allow a worker to run this job.
         * The minimum ttr is 1.
         *
         * @const integer
         */
        const DEFAULT_TTR = 86400;
        /**
         * Default tube name
         *
         * @const string
         */
        const DEFAULT_TUBE = "default";
        /**
         * Default connected host
         *
         * @const string
         */
        const DEFAULT_HOST = "127.0.0.1";
        /**
         * Default connected port
         *
         * @const integer
         */
        const DEFAULT_PORT = 11300;
        /**
         * Connection resource
         *
         * @var resource
         */
        protected $_connection;
        /**
         * Connection options
         *
         * @var array
         */
        protected $_parameters;
        /**
         * Phalcon\Queue\Beanstalk
         *
         * @param array $options 
         */
        public function __construct(array $options = null) {}
        /**
         * Makes a connection to the Beanstalkd server
         *
         * @return resource 
         */
        public function connect() {}
        /**
         * Puts a job on the queue using specified tube.
         *
         * @param mixed $data 
         * @param array $options 
         * @return int|bool 
         */
        public function put($data, array $options = null) {}
        /**
         * Reserves/locks a ready job from the specified tube.
         *
         * @param mixed $timeout 
         * @return bool|\Phalcon\Queue\Beanstalk\Job 
         */
        public function reserve($timeout = null) {}
        /**
         * Change the active tube. By default the tube is "default".
         *
         * @param string $tube 
         * @return bool|string 
         */
        public function choose($tube) {}
        /**
         * The watch command adds the named tube to the watch list for the current connection.
         *
         * @param string $tube 
         * @return bool|int 
         */
        public function watch($tube) {}
        /**
         * It removes the named tube from the watch list for the current connection.
         *
         * @param string $tube 
         * @return bool|int 
         */
        public function ignore($tube) {}
        /**
         * Can delay any new job being reserved for a given time.
         *
         * @param string $tube 
         * @param int $delay 
         * @return bool 
         */
        public function pauseTube($tube, $delay) {}
        /**
         * The kick command applies only to the currently used tube.
         *
         * @param int $bound 
         * @return bool|int 
         */
        public function kick($bound) {}
        /**
         * Gives statistical information about the system as a whole.
         *
         * @return bool|array 
         */
        public function stats() {}
        /**
         * Gives statistical information about the specified tube if it exists.
         *
         * @param string $tube 
         * @return bool|array 
         */
        public function statsTube($tube) {}
        /**
         * Returns a list of all existing tubes.
         *
         * @return bool|array 
         */
        public function listTubes() {}
        /**
         * Returns the tube currently being used by the client.
         *
         * @return bool|string 
         */
        public function listTubeUsed() {}
        /**
         * Returns a list tubes currently being watched by the client.
         *
         * @return bool|array 
         */
        public function listTubesWatched() {}
        /**
         * Inspect the next ready job.
         *
         * @return bool|\Phalcon\Queue\Beanstalk\Job 
         */
        public function peekReady() {}
        /**
         * Return the next job in the list of buried jobs.
         *
         * @return bool|\Phalcon\Queue\Beanstalk\Job 
         */
        public function peekBuried() {}
        /**
         * Return the next job in the list of buried jobs.
         *
         * @return bool|\Phalcon\Queue\Beanstalk\Job 
         */
        public function peekDelayed() {}
        /**
         * The peek commands let the client inspect a job in the system.
         *
         * @param int $id 
         * @return bool|\Phalcon\Queue\Beanstalk\Job 
         */
        public function jobPeek($id) {}
        /**
         * Reads the latest status from the Beanstalkd server
         *
         * @return array 
         */
        final public function readStatus() {}
        /**
         * Fetch a YAML payload from the Beanstalkd server
         *
         * @return array 
         */
        final public function readYaml() {}
        /**
         * Reads a packet from the socket. Prior to reading from the socket will
         * check for availability of the connection.
         *
         * @param int $length 
         * @return bool|string 
         */
        public function read($length = 0) {}
        /**
         * Writes data to the socket. Performs a connection if none is available
         *
         * @param string $data 
         * @return bool|int 
         */
        protected function write($data) {}
        /**
         * Closes the connection to the beanstalk server.
         *
         * @return bool 
         */
        public function disconnect() {}
        /**
         * Simply closes the connection.
         *
         * @return bool 
         */
        public function quit() {}
    }
}

namespace \Phalcon\Queue\Beanstalk {
    /**
     * Phalcon\Queue\Beanstalk\Exception
     * Exceptions thrown in Phalcon\Queue\Beanstalk will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Queue\Beanstalk\Job
     * Represents a job in a beanstalk queue
     */
    class Job
    {
        /**
         * @var string
         */
        protected $_id;
        /**
         * @var mixed
         */
        protected $_body;
        protected $_queue;
        /**
         * @return string 
         */
        public function getId() {}
        /**
         * @return mixed 
         */
        public function getBody() {}
        /**
         * Phalcon\Queue\Beanstalk\Job
         *
         * @param mixed $queue 
         * @param string $id 
         * @param mixed $body 
         */
        public function __construct(\Phalcon\Queue\Beanstalk $queue, $id, $body) {}
        /**
         * Removes a job from the server entirely
         *
         * @return bool 
         */
        public function delete() {}
        /**
         * The release command puts a reserved job back into the ready queue (and marks
         * its state as "ready") to be run by any client. It is normally used when the job
         * fails because of a transitory error.
         *
         * @param int $priority 
         * @param int $delay 
         * @return bool 
         */
        public function release($priority = 100, $delay = 0) {}
        /**
         * The bury command puts a job into the "buried" state. Buried jobs are put into
         * a FIFO linked list and will not be touched by the server again until a client
         * kicks them with the "kick" command.
         *
         * @param int $priority 
         * @return bool 
         */
        public function bury($priority = 100) {}
        /**
         * The `touch` command allows a worker to request more time to work on a job.
         * This is useful for jobs that potentially take a long time, but you still
         * want the benefits of a TTR pulling a job away from an unresponsive worker.
         * A worker may periodically tell the server that it's still alive and processing
         * a job (e.g. it may do this on `DEADLINE_SOON`). The command postpones the auto
         * release of a reserved job until TTR seconds from when the command is issued.
         *
         * @return bool 
         */
        public function touch() {}
        /**
         * Move the job to the ready queue if it is delayed or buried.
         *
         * @return bool 
         */
        public function kick() {}
        /**
         * Gives statistical information about the specified job if it exists.
         *
         * @return bool|array 
         */
        public function stats() {}
        /**
         * Checks if the job has been modified after unserializing the object
         */
        public function __wakeup() {}
    }
}

namespace \Phalcon\Security {
    /**
     * Phalcon\Security\Exception
     * Exceptions thrown in Phalcon\Security will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Security\Random
     * Secure random number generator class.
     * Provides secure random number generator which is suitable for generating
     * session key in HTTP cookies, etc.
     * It supports following secure random number generators:
     * - random_bytes (PHP 7)
     * - libsodium
     * - openssl, libressl
     * - /dev/urandom
     * `Phalcon\Security\Random` could be mainly useful for:
     * - Key generation (e.g. generation of complicated keys)
     * - Generating random passwords for new user accounts
     * - Encryption systems
     * <code>
     * $random = new \Phalcon\Security\Random();
     * // Random binary string
     * $bytes = $random->bytes();
     * // Random hex string
     * echo $random->hex(10); // a29f470508d5ccb8e289
     * echo $random->hex(10); // 533c2f08d5eee750e64a
     * echo $random->hex(11); // f362ef96cb9ffef150c9cd
     * echo $random->hex(12); // 95469d667475125208be45c4
     * echo $random->hex(13); // 05475e8af4a34f8f743ab48761
     * // Random base64 string
     * echo $random->base64(12); // XfIN81jGGuKkcE1E
     * echo $random->base64(12); // 3rcq39QzGK9fUqh8
     * echo $random->base64();   // DRcfbngL/iOo9hGGvy1TcQ==
     * echo $random->base64(16); // SvdhPcIHDZFad838Bb0Swg==
     * // Random URL-safe base64 string
     * echo $random->base64Safe();           // PcV6jGbJ6vfVw7hfKIFDGA
     * echo $random->base64Safe();           // GD8JojhzSTrqX7Q8J6uug
     * echo $random->base64Safe(8);          // mGyy0evy3ok
     * echo $random->base64Safe(null, true); // DRrAgOFkS4rvRiVHFefcQ==
     * // Random UUID
     * echo $random->uuid(); // db082997-2572-4e2c-a046-5eefe97b1235
     * echo $random->uuid(); // da2aa0e2-b4d0-4e3c-99f5-f5ef62c57fe2
     * echo $random->uuid(); // 75e6b628-c562-4117-bb76-61c4153455a9
     * echo $random->uuid(); // dc446df1-0848-4d05-b501-4af3c220c13d
     * // Random number between 0 and $len
     * echo $random->number(256); // 84
     * echo $random->number(256); // 79
     * echo $random->number(100); // 29
     * echo $random->number(300); // 40
     * // Random base58 string
     * echo $random->base58();   // 4kUgL2pdQMSCQtjE
     * echo $random->base58();   // Umjxqf7ZPwh765yR
     * echo $random->base58(24); // qoXcgmw4A9dys26HaNEdCRj9
     * echo $random->base58(7);  // 774SJD3vgP
     * </code>
     * This class partially borrows SecureRandom library from Ruby
     *
     * @link http://ruby-doc.org/stdlib-2.2.2/libdoc/securerandom/rdoc/SecureRandom.html
     */
    class Random
    {
        /**
         * Generates a random binary string
         * The `Random::bytes` method returns a string and accepts as input an int
         * representing the length in bytes to be returned.
         * If $len is not specified, 16 is assumed. It may be larger in future.
         * The result may contain any byte: "x00" - "xFF".
         * <code>
         * $random = new \Phalcon\Security\Random();
         * $bytes = $random->bytes();
         * var_dump(bin2hex($bytes));
         * // possible output: string(32) "00f6c04b144b41fad6a59111c126e1ee"
         * </code>
         *
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @param int $len 
         * @return string 
         */
        public function bytes($len = 16) {}
        /**
         * Generates a random hex string
         * If $len is not specified, 16 is assumed. It may be larger in future.
         * The length of the result string is usually greater of $len.
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->hex(10); // a29f470508d5ccb8e289
         * </code>
         *
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @param int $len 
         * @return string 
         */
        public function hex($len = null) {}
        /**
         * Generates a random base58 string
         * If $len is not specified, 16 is assumed. It may be larger in future.
         * The result may contain alphanumeric characters except 0, O, I and l.
         * It is similar to Base64 but has been modified to avoid both non-alphanumeric
         * characters and letters which might look ambiguous when printed.
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->base58(); // 4kUgL2pdQMSCQtjE
         * </code>
         *
         * @link https://en.wikipedia.org/wiki/Base58
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @param mixed $n 
         * @return string 
         */
        public function base58($n = null) {}
        /**
         * Generates a random base64 string
         * If $len is not specified, 16 is assumed. It may be larger in future.
         * The length of the result string is usually greater of $len.
         * Size formula: 4 *( $len / 3) and this need to be rounded up to a multiple of 4.
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->base64(12); // 3rcq39QzGK9fUqh8
         * </code>
         *
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @param int $len 
         * @return string 
         */
        public function base64($len = null) {}
        /**
         * Generates a random URL-safe base64 string
         * If $len is not specified, 16 is assumed. It may be larger in future.
         * The length of the result string is usually greater of $len.
         * By default, padding is not generated because "=" may be used as a URL delimiter.
         * The result may contain A-Z, a-z, 0-9, "-" and "_". "=" is also used if $padding is true.
         * See RFC 3548 for the definition of URL-safe base64.
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->base64Safe(); // GD8JojhzSTrqX7Q8J6uug
         * </code>
         *
         * @link https://www.ietf.org/rfc/rfc3548.txt
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @param int $len 
         * @param bool $padding 
         * @return string 
         */
        public function base64Safe($len = null, $padding = false) {}
        /**
         * Generates a v4 random UUID (Universally Unique IDentifier)
         * The version 4 UUID is purely random (except the version). It doesn't contain meaningful
         * information such as MAC address, time, etc. See RFC 4122 for details of UUID.
         * This algorithm sets the version number (4 bits) as well as two reserved bits.
         * All other bits (the remaining 122 bits) are set using a random or pseudorandom data source.
         * Version 4 UUIDs have the form xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx where x is any hexadecimal
         * digit and y is one of 8, 9, A, or B (e.g., f47ac10b-58cc-4372-a567-0e02b2c3d479).
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->uuid(); // 1378c906-64bb-4f81-a8d6-4ae1bfcdec22
         * </code>
         *
         * @link https://www.ietf.org/rfc/rfc4122.txt
         * @throws Exception If secure random number generator is not available or unexpected partial read
         * @return string 
         */
        public function uuid() {}
        /**
         * Generates a random number between 0 and $len
         * Returns an integer: 0 <= result <= $len.
         * <code>
         * $random = new \Phalcon\Security\Random();
         * echo $random->number(16); // 8
         * </code>
         *
         * @throws Exception If secure random number generator is not available, unexpected partial read or $len <= 0
         * @param int $len 
         * @return int 
         */
        public function number($len) {}
    }
}

namespace \Phalcon\Session {
    /**
     * Phalcon\Session\Adapter
     * Base class for Phalcon\Session adapters
     */
    abstract class Adapter implements \Phalcon\Session\AdapterInterface
    {
        const SESSION_ACTIVE = 2;
        const SESSION_NONE = 1;
        const SESSION_DISABLED = 0;
        protected $_uniqueId;
        protected $_started = false;
        protected $_options;
        /**
         * Phalcon\Session\Adapter constructor
         *
         * @param array $options 
         */
        public function __construct($options = null) {}
        /**
         * Starts the session (if headers are already sent the session will not be started)
         *
         * @return bool 
         */
        public function start() {}
        /**
         * Sets session's options
         * <code>
         * $session->setOptions(['uniqueId' => 'my-private-app']);
         * </code>
         *
         * @param array $options 
         */
        public function setOptions(array $options) {}
        /**
         * Get internal options
         *
         * @return array 
         */
        public function getOptions() {}
        /**
         * Set session name
         *
         * @param string $name 
         */
        public function setName($name) {}
        /**
         * Get session name
         *
         * @return string 
         */
        public function getName() {}
        /**
         * {@inheritdoc}
         *
         * @param bool $deleteOldSession 
         * @return Adapter 
         */
        public function regenerateId($deleteOldSession = true) {}
        /**
         * Gets a session variable from an application context
         * <code>
         * $session->get('auth', 'yes');
         * </code>
         *
         * @param string $index 
         * @param mixed $defaultValue 
         * @param bool $remove 
         * @return mixed 
         */
        public function get($index, $defaultValue = null, $remove = false) {}
        /**
         * Sets a session variable in an application context
         * <code>
         * $session->set('auth', 'yes');
         * </code>
         *
         * @param string $index 
         * @param mixed $value 
         */
        public function set($index, $value) {}
        /**
         * Check whether a session variable is set in an application context
         * <code>
         * var_dump($session->has('auth'));
         * </code>
         *
         * @param string $index 
         * @return bool 
         */
        public function has($index) {}
        /**
         * Removes a session variable from an application context
         * <code>
         * $session->remove('auth');
         * </code>
         *
         * @param string $index 
         */
        public function remove($index) {}
        /**
         * Returns active session id
         * <code>
         * echo $session->getId();
         * </code>
         *
         * @return string 
         */
        public function getId() {}
        /**
         * Set the current session id
         * <code>
         * $session->setId($id);
         * </code>
         *
         * @param string $id 
         */
        public function setId($id) {}
        /**
         * Check whether the session has been started
         * <code>
         * var_dump($session->isStarted());
         * </code>
         *
         * @return bool 
         */
        public function isStarted() {}
        /**
         * Destroys the active session
         * <code>
         * var_dump($session->destroy());
         * var_dump($session->destroy(true));
         * </code>
         *
         * @param bool $removeData 
         * @return bool 
         */
        public function destroy($removeData = false) {}
        /**
         * Returns the status of the current session.
         * <code>
         * var_dump($session->status());
         * if ($session->status() !== $session::SESSION_ACTIVE) {
         * $session->start();
         * }
         * </code>
         *
         * @return int 
         */
        public function status() {}
        /**
         * Alias: Gets a session variable from an application context
         *
         * @param string $index 
         * @return mixed 
         */
        public function __get($index) {}
        /**
         * Alias: Sets a session variable in an application context
         *
         * @param string $index 
         * @param mixed $value 
         */
        public function __set($index, $value) {}
        /**
         * Alias: Check whether a session variable is set in an application context
         *
         * @param string $index 
         * @return bool 
         */
        public function __isset($index) {}
        /**
         * Alias: Removes a session variable from an application context
         *
         * @param string $index 
         */
        public function __unset($index) {}
        public function __destruct() {}
    }

    /**
     * Phalcon\Session\AdapterInterface
     * Interface for Phalcon\Session adapters
     */
    interface AdapterInterface
    {
        /**
         * Starts session, optionally using an adapter
         */
        public function start();
        /**
         * Sets session options
         *
         * @param array $options 
         */
        public function setOptions(array $options);
        /**
         * Get internal options
         *
         * @return array 
         */
        public function getOptions();
        /**
         * Gets a session variable from an application context
         *
         * @param string $index 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function get($index, $defaultValue = null);
        /**
         * Sets a session variable in an application context
         *
         * @param string $index 
         * @param mixed $value 
         */
        public function set($index, $value);
        /**
         * Check whether a session variable is set in an application context
         *
         * @param string $index 
         * @return bool 
         */
        public function has($index);
        /**
         * Removes a session variable from an application context
         *
         * @param string $index 
         */
        public function remove($index);
        /**
         * Returns active session id
         *
         * @return string 
         */
        public function getId();
        /**
         * Check whether the session has been started
         *
         * @return bool 
         */
        public function isStarted();
        /**
         * Destroys the active session
         *
         * @param bool $removeData 
         * @return bool 
         */
        public function destroy($removeData = false);
        /**
         * Regenerate session's id
         *
         * @param bool $deleteOldSession 
         * @return AdapterInterface 
         */
        public function regenerateId($deleteOldSession = true);
        /**
         * Set session name
         *
         * @param string $name 
         */
        public function setName($name);
        /**
         * Get session name
         *
         * @return string 
         */
        public function getName();
    }

    /**
     * Phalcon\Session\Bag
     * This component helps to separate session data into "namespaces". Working by this way
     * you can easily create groups of session variables into the application
     * <code>
     * $user = new \Phalcon\Session\Bag('user');
     * $user->name = "Kimbra Johnson";
     * $user->age  = 22;
     * </code>
     */
    class Bag implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Session\BagInterface, \IteratorAggregate, \ArrayAccess, \Countable
    {
        protected $_dependencyInjector;
        protected $_name = null;
        protected $_data;
        protected $_initialized = false;
        protected $_session;
        /**
         * Phalcon\Session\Bag constructor
         *
         * @param string $name 
         */
        public function __construct($name) {}
        /**
         * Sets the DependencyInjector container
         *
         * @param mixed $dependencyInjector 
         */
        public function setDI(\Phalcon\DiInterface $dependencyInjector) {}
        /**
         * Returns the DependencyInjector container
         *
         * @return \Phalcon\DiInterface 
         */
        public function getDI() {}
        /**
         * Initializes the session bag. This method must not be called directly, the class calls it when its internal data is accessed
         */
        public function initialize() {}
        /**
         * Destroys the session bag
         * <code>
         * $user->destroy();
         * </code>
         */
        public function destroy() {}
        /**
         * Sets a value in the session bag
         * <code>
         * $user->set('name', 'Kimbra');
         * </code>
         *
         * @param string $property 
         * @param mixed $value 
         */
        public function set($property, $value) {}
        /**
         * Magic setter to assign values to the session bag
         * <code>
         * $user->name = "Kimbra";
         * </code>
         *
         * @param string $property 
         * @param mixed $value 
         */
        public function __set($property, $value) {}
        /**
         * Obtains a value from the session bag optionally setting a default value
         * <code>
         * echo $user->get('name', 'Kimbra');
         * </code>
         *
         * @param string $property 
         * @param mixed $defaultValue 
         */
        public function get($property, $defaultValue = null) {}
        /**
         * Magic getter to obtain values from the session bag
         * <code>
         * echo $user->name;
         * </code>
         *
         * @param string $property 
         * @return mixed 
         */
        public function __get($property) {}
        /**
         * Check whether a property is defined in the internal bag
         * <code>
         * var_dump($user->has('name'));
         * </code>
         *
         * @param string $property 
         * @return bool 
         */
        public function has($property) {}
        /**
         * Magic isset to check whether a property is defined in the bag
         * <code>
         * var_dump(isset($user['name']));
         * </code>
         *
         * @param string $property 
         * @return bool 
         */
        public function __isset($property) {}
        /**
         * Removes a property from the internal bag
         * <code>
         * $user->remove('name');
         * </code>
         *
         * @param string $property 
         * @return bool 
         */
        public function remove($property) {}
        /**
         * Magic unset to remove items using the array syntax
         * <code>
         * unset($user['name']);
         * </code>
         *
         * @param string $property 
         * @return bool 
         */
        public function __unset($property) {}
        /**
         * Return length of bag
         * <code>
         * echo $user->count();
         * </code>
         *
         * @return int 
         */
        public final function count() {}
        /**
         *  Returns the bag iterator
         *
         * @return \ArrayIterator 
         */
        public final function getIterator() {}
        /**
         * @param string $property 
         * @param mixed $value 
         */
        public final function offsetSet($property, $value) {}
        /**
         * @param string $property 
         * @return bool 
         */
        public final function offsetExists($property) {}
        /**
         * @param string $property 
         */
        public final function offsetUnset($property) {}
        /**
         * @param string $property 
         * @return mixed 
         */
        public final function offsetGet($property) {}
    }

    /**
     * Phalcon\Session\BagInterface
     * Interface for Phalcon\Session\Bag
     */
    interface BagInterface
    {
        /**
         * Initializes the session bag. This method must not be called directly, the class calls it when its internal data is accessed
         */
        public function initialize();
        /**
         * Destroys the session bag
         */
        public function destroy();
        /**
         * Setter of values
         *
         * @param string $property 
         * @param mixed $value 
         */
        public function set($property, $value);
        /**
         * Getter of values
         *
         * @param string $property 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function get($property, $defaultValue = null);
        /**
         * Isset property
         *
         * @param string $property 
         * @return bool 
         */
        public function has($property);
        /**
         * Setter of values
         *
         * @param string $property 
         * @param mixed $value 
         */
        public function __set($property, $value);
        /**
         * Getter of values
         *
         * @param string $property 
         * @return mixed 
         */
        public function __get($property);
        /**
         * Isset property
         *
         * @param string $property 
         * @return bool 
         */
        public function __isset($property);
    }

    /**
     * Phalcon\Session\Exception
     * Exceptions thrown in Phalcon\Session will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }
}

namespace \Phalcon\Session\Adapter {
    /**
     * Phalcon\Session\Adapter\Files
     * This adapter store sessions in plain files
     * <code>
     * use Phalcon\Session\Adapter\Files;
     * $session = new Files(['uniqueId' => 'my-private-app']);
     * $session->start();
     * $session->set('var', 'some-value');
     * echo $session->get('var');
     * </code>
     */
    class Files extends \Phalcon\Session\Adapter
    {
    }

    /**
     * Phalcon\Session\Adapter\Libmemcached
     * This adapter store sessions in libmemcached
     * <code>
     * use Phalcon\Session\Adapter\Libmemcached;
     * $session = new Libmemcached([
     * 'servers' => [
     * ['host' => 'localhost', 'port' => 11211, 'weight' => 1],
     * ],
     * 'client' => [
     * \Memcached::OPT_HASH       => \Memcached::HASH_MD5,
     * \Memcached::OPT_PREFIX_KEY => 'prefix.',
     * ],
     * 'lifetime' => 3600,
     * 'prefix'   => 'my_'
     * ]);
     * $session->start();
     * $session->set('var', 'some-value');
     * echo $session->get('var');
     * </code>
     */
    class Libmemcached extends \Phalcon\Session\Adapter
    {
        protected $_libmemcached = null;
        protected $_lifetime = 8600;
        public function getLibmemcached() {}
        public function getLifetime() {}
        /**
         * Phalcon\Session\Adapter\Libmemcached constructor
         *
         * @throws \Phalcon\Session\Exception
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * @return bool 
         */
        public function open() {}
        /**
         * @return bool 
         */
        public function close() {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @return mixed 
         */
        public function read($sessionId) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @param string $data 
         * @return bool 
         */
        public function write($sessionId, $data) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @return bool 
         */
        public function destroy($sessionId = null) {}
        /**
         * {@inheritdoc}
         *
         * @return bool 
         */
        public function gc() {}
    }

    /**
     * Phalcon\Session\Adapter\Memcache
     * This adapter store sessions in memcache
     * <code>
     * use Phalcon\Session\Adapter\Memcache;
     * $session = new Memcache([
     * 'uniqueId'   => 'my-private-app',
     * 'host'       => '127.0.0.1',
     * 'port'       => 11211,
     * 'persistent' => true,
     * 'lifetime'   => 3600,
     * 'prefix'     => 'my_'
     * ]);
     * $session->start();
     * $session->set('var', 'some-value');
     * echo $session->get('var');
     * </code>
     */
    class Memcache extends \Phalcon\Session\Adapter
    {
        protected $_memcache = null;
        protected $_lifetime = 8600;
        public function getMemcache() {}
        public function getLifetime() {}
        /**
         * Phalcon\Session\Adapter\Memcache constructor
         *
         * @param array $options 
         */
        public function __construct(array $options = array()) {}
        /**
         * @return bool 
         */
        public function open() {}
        /**
         * @return bool 
         */
        public function close() {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @return mixed 
         */
        public function read($sessionId) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @param string $data 
         * @return bool 
         */
        public function write($sessionId, $data) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @return bool 
         */
        public function destroy($sessionId = null) {}
        /**
         * {@inheritdoc}
         *
         * @return bool 
         */
        public function gc() {}
    }

    /**
     * Phalcon\Session\Adapter\Redis
     * This adapter store sessions in Redis
     * <code>
     * use Phalcon\Session\Adapter\Redis;
     * $session = new Redis([
     * 'uniqueId'   => 'my-private-app',
     * 'host'       => 'localhost',
     * 'port'       => 6379,
     * 'auth'       => 'foobared',
     * 'persistent' => false,
     * 'lifetime'   => 3600,
     * 'prefix'     => 'my_'
     * 'index'      => 1,
     * ]);
     * $session->start();
     * $session->set('var', 'some-value');
     * echo $session->get('var');
     * </code>
     */
    class Redis extends \Phalcon\Session\Adapter
    {
        protected $_redis = null;
        protected $_lifetime = 8600;
        public function getRedis() {}
        public function getLifetime() {}
        /**
         * Phalcon\Session\Adapter\Redis constructor
         *
         * @param array $options 
         */
        public function __construct(array $options = array()) {}
        /**
         * {@inheritdoc}
         *
         * @return bool 
         */
        public function open() {}
        /**
         * {@inheritdoc}
         *
         * @return bool 
         */
        public function close() {}
        /**
         * {@inheritdoc}
         *
         * @param mixed $sessionId 
         * @return mixed 
         */
        public function read($sessionId) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @param string $data 
         * @return bool 
         */
        public function write($sessionId, $data) {}
        /**
         * {@inheritdoc}
         *
         * @param string $sessionId 
         * @return bool 
         */
        public function destroy($sessionId = null) {}
        /**
         * {@inheritdoc}
         *
         * @return bool 
         */
        public function gc() {}
    }
}

namespace \Phalcon\Tag {
    /**
     * Phalcon\Tag\Exception
     * Exceptions thrown in Phalcon\Tag will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Tag\Select
     * Generates a SELECT html tag using a static array of values or a Phalcon\Mvc\Model resultset
     */
    abstract class Select
    {
        /**
         * Generates a SELECT tag
         *
         * @param array $parameters 
         * @param array $data 
         */
        public static function selectField($parameters, $data = null) {}
        /**
         * Generate the OPTION tags based on a resultset
         *
         * @param \Phalcon\Mvc\Model\Resultset $resultset 
         * @param array $using 
         * @param mixed $value 
         * @param string $closeOption 
         */
        private static function _optionsFromResultset($resultset, $using, $value, $closeOption) {}
        /**
         * Generate the OPTION tags based on an array
         *
         * @param array $data 
         * @param mixed $value 
         * @param string $closeOption 
         */
        private static function _optionsFromArray($data, $value, $closeOption) {}
    }
}

namespace \Phalcon\Translate {
    /**
     * Phalcon\Translate\Adapter
     * Base class for Phalcon\Translate adapters
     */
    abstract class Adapter
    {
        /**
         * @var Phalcon\Translate\InterpolatorInterface
         */
        protected $_interpolator;
        /**
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * @param mixed $interpolator 
         * @return Adapter 
         */
        public function setInterpolator(\Phalcon\Translate\InterpolatorInterface $interpolator) {}
        /**
         * Returns the translation string of the given key
         *
         * @param string $translateKey 
         * @param array $placeholders 
         * @return string 
         */
        public function t($translateKey, $placeholders = null) {}
        /**
         * Returns the translation string of the given key (alias of method 't')
         *
         * @param string $translateKey 
         * @param array $placeholders 
         * @return string 
         */
        public function _($translateKey, $placeholders = null) {}
        /**
         * Sets a translation value
         *
         * @param string $offset 
         * @param string $value 
         */
        public function offsetSet($offset, $value) {}
        /**
         * Check whether a translation key exists
         *
         * @param string $translateKey 
         * @return bool 
         */
        public function offsetExists($translateKey) {}
        /**
         * Unsets a translation from the dictionary
         *
         * @param string $offset 
         */
        public function offsetUnset($offset) {}
        /**
         * Returns the translation related to the given key
         *
         * @param string $translateKey 
         * @return string 
         */
        public function offsetGet($translateKey) {}
        /**
         * Replaces placeholders by the values passed
         *
         * @param string $translation 
         * @param mixed $placeholders 
         * @return string 
         */
        protected function replacePlaceholders($translation, $placeholders = null) {}
    }

    /**
     * Phalcon\Translate\AdapterInterface
     * Interface for Phalcon\Translate adapters
     */
    interface AdapterInterface
    {
        /**
         * Returns the translation string of the given key
         *
         * @param	string translateKey
         * @param	array placeholders
         * @return	string
         * @param string $translateKey 
         * @param mixed $placeholders 
         * @return string 
         */
        public function t($translateKey, $placeholders = null);
        /**
         * Returns the translation related to the given key
         *
         * @param	string index
         * @param	array placeholders
         * @return	string
         * @param string $index 
         * @param mixed $placeholders 
         * @return string 
         */
        public function query($index, $placeholders = null);
        /**
         * Check whether is defined a translation key in the internal array
         *
         * @param string $index 
         * @return bool 
         */
        public function exists($index);
    }

    /**
     * Phalcon\Translate\Exception
     * Class for exceptions thrown by Phalcon\Translate
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Translate\AdapterInterface
     * Interface for Phalcon\Translate adapters
     */
    interface InterpolatorInterface
    {
        /**
         * Replaces placeholders by the values passed
         *
         * @param string $translation 
         * @param mixed $placeholders 
         * @return string 
         */
        public function replacePlaceholders($translation, $placeholders = null);
    }
}

namespace \Phalcon\Translate\Adapter {
    /**
     * Phalcon\Translate\Adapter\Csv
     * Allows to define translation lists using CSV file
     */
    class Csv extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
    {
        protected $_translate = array();
        /**
         * Phalcon\Translate\Adapter\Csv constructor
         *
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * Load translates from file
         *
         * @param string $file 
         * @param int $length 
         * @param string $delimiter 
         * @param string $enclosure 
         */
        private function _load($file, $length, $delimiter, $enclosure) {}
        /**
         * Returns the translation related to the given key
         *
         * @param string $index 
         * @param mixed $placeholders 
         * @return string 
         */
        public function query($index, $placeholders = null) {}
        /**
         * Check whether is defined a translation key in the internal array
         *
         * @param string $index 
         * @return bool 
         */
        public function exists($index) {}
    }

    /**
     * Phalcon\Translate\Adapter\Gettext
     * Allows translate using gettext
     */
    class Gettext extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
    {
        /**
         * @var string|array
         */
        protected $_directory;
        /**
         * @var string
         */
        protected $_defaultDomain;
        /**
         * @var string
         */
        protected $_locale;
        /**
         * @var int
         */
        protected $_category;
        /**
         * @return string|array 
         */
        public function getDirectory() {}
        /**
         * @return string 
         */
        public function getDefaultDomain() {}
        /**
         * @return string 
         */
        public function getLocale() {}
        /**
         * @return int 
         */
        public function getCategory() {}
        /**
         * Phalcon\Translate\Adapter\Gettext constructor
         *
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * Returns the translation related to the given key
         *
         * @param string $index 
         * @param array $placeholders 
         * @param string $domain 
         * @return string 
         */
        public function query($index, $placeholders = null) {}
        /**
         * Check whether is defined a translation key in the internal array
         *
         * @param string $index 
         * @return bool 
         */
        public function exists($index) {}
        /**
         * The plural version of gettext().
         * Some languages have more than one form for plural messages dependent on the count.
         *
         * @param string $msgid1 
         * @param string $msgid2 
         * @param int $count 
         * @param array $placeholders 
         * @param string $domain 
         * @return string 
         */
        public function nquery($msgid1, $msgid2, $count, $placeholders = null, $domain = null) {}
        /**
         * Changes the current domain (i.e. the translation file)
         *
         * @param mixed $domain 
         * @return string 
         */
        public function setDomain($domain) {}
        /**
         * Sets the default domain
         *
         * @return string 
         */
        public function resetDomain() {}
        /**
         * Sets the domain default to search within when calls are made to gettext()
         *
         * @param string $domain 
         */
        public function setDefaultDomain($domain) {}
        /**
         * Sets the path for a domain
         * <code>
         * // Set the directory path
         * $gettext->setDirectory("/path/to/the/messages");
         * // Set the domains and directories path
         * $gettext->setDirectory([
         * "messages" => "/path/to/the/messages",
         * "another" => "/path/to/the/another"
         * ]);
         * </code>
         *
         * @param string|array $directory The directory path or an array of directories and domains
         */
        public function setDirectory($directory) {}
        /**
         * Sets locale information
         * <code>
         * // Set locale to Dutch
         * $gettext->setLocale(LC_ALL, 'nl_NL');
         * // Try different possible locale names for german
         * $gettext->setLocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
         * </code>
         *
         * @param int $category 
         * @param string $locale 
         * @return string|bool 
         */
        public function setLocale($category, $locale) {}
        /**
         * Validator for constructor
         *
         * @param array $options 
         */
        protected function prepareOptions(array $options) {}
        /**
         * Gets default options
         *
         * @return array 
         */
        private function getOptionsDefault() {}
    }

    /**
     * Phalcon\Translate\Adapter\NativeArray
     * Allows to define translation lists using PHP arrays
     */
    class NativeArray extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
    {
        protected $_translate;
        /**
         * Phalcon\Translate\Adapter\NativeArray constructor
         *
         * @param array $options 
         */
        public function __construct(array $options) {}
        /**
         * Returns the translation related to the given key
         *
         * @param string $index 
         * @param mixed $placeholders 
         * @return string 
         */
        public function query($index, $placeholders = null) {}
        /**
         * Check whether is defined a translation key in the internal array
         *
         * @param string $index 
         * @return bool 
         */
        public function exists($index) {}
    }
}

namespace \Phalcon\Translate\Interpolator {
    class AssociativeArray implements \Phalcon\Translate\InterpolatorInterface
    {
        /**
         * Replaces placeholders by the values passed
         *
         * @param string $translation 
         * @param mixed $placeholders 
         * @return string 
         */
        public function replacePlaceholders($translation, $placeholders = null) {}
    }

    class IndexedArray implements \Phalcon\Translate\InterpolatorInterface
    {
        /**
         * Replaces placeholders by the values passed
         *
         * @param string $translation 
         * @param mixed $placeholders 
         * @return string 
         */
        public function replacePlaceholders($translation, $placeholders = null) {}
    }
}

namespace \Phalcon\Validation {
    /**
     * Phalcon\Validation\CombinedFieldsValidator
     * This is a base class for combined fields validators
     */
    abstract class CombinedFieldsValidator extends \Phalcon\Validation\Validator
    {
    }

    /**
     * Phalcon\Validation\Exception
     * Exceptions thrown in Phalcon\Validation\* classes will use this class
     */
    class Exception extends \Phalcon\Exception
    {
    }

    /**
     * Phalcon\Validation\Message
     * Encapsulates validation info generated in the validation process
     */
    class Message implements \Phalcon\Validation\MessageInterface
    {
        protected $_type;
        protected $_message;
        protected $_field;
        protected $_code;
        /**
         * Phalcon\Validation\Message constructor
         *
         * @param string $message 
         * @param mixed $field 
         * @param string $type 
         * @param int $code 
         */
        public function __construct($message, $field = null, $type = null, $code = null) {}
        /**
         * Sets message type
         *
         * @param string $type 
         * @return Message 
         */
        public function setType($type) {}
        /**
         * Returns message type
         *
         * @return string 
         */
        public function getType() {}
        /**
         * Sets verbose message
         *
         * @param string $message 
         * @return Message 
         */
        public function setMessage($message) {}
        /**
         * Returns verbose message
         *
         * @return string 
         */
        public function getMessage() {}
        /**
         * Sets field name related to message
         *
         * @param mixed $field 
         * @return Message 
         */
        public function setField($field) {}
        /**
         * Returns field name related to message
         *
         * @return mixed 
         */
        public function getField() {}
        /**
         * Sets code for the message
         *
         * @param int $code 
         * @return Message 
         */
        public function setCode($code) {}
        /**
         * Returns the message code
         *
         * @return int 
         */
        public function getCode() {}
        /**
         * Magic __toString method returns verbose message
         *
         * @return string 
         */
        public function __toString() {}
        /**
         * Magic __set_state helps to recover messsages from serialization
         *
         * @param array $message 
         * @return Message 
         */
        public static function __set_state(array $message) {}
    }

    /**
     * Phalcon\Validation\Message
     * Interface for Phalcon\Validation\Message
     */
    interface MessageInterface
    {
        /**
         * Sets message type
         *
         * @param string $type 
         * @return \Phalcon\Validation\Message 
         */
        public function setType($type);
        /**
         * Returns message type
         *
         * @return string 
         */
        public function getType();
        /**
         * Sets verbose message
         *
         * @param string $message 
         * @return \Phalcon\Validation\Message 
         */
        public function setMessage($message);
        /**
         * Returns verbose message
         *
         * @return string 
         */
        public function getMessage();
        /**
         * Sets field name related to message
         *
         * @param string $field 
         * @return \Phalcon\Validation\Message 
         */
        public function setField($field);
        /**
         * Returns field name related to message
         *
         * @return string 
         */
        public function getField();
        /**
         * Magic __toString method returns verbose message
         *
         * @return string 
         */
        public function __toString();
        /**
         * Magic __set_state helps to recover messages from serialization
         *
         * @param array $message 
         * @return MessageInterface 
         */
        public static function __set_state(array $message);
    }

    /**
     * Phalcon\Validation\Validator
     * This is a base class for validators
     */
    abstract class Validator implements \Phalcon\Validation\ValidatorInterface
    {
        protected $_options;
        /**
         * Phalcon\Validation\Validator constructor
         *
         * @param array $options
         */
        public function __construct(array $options = null) {}
        /**
         * Checks if an option has been defined
         *
         * @deprecated since 2.1.0
         * @see \Phalcon\Validation\Validator::hasOption()
         * @param string $key
         * @return bool
         */
        public function isSetOption($key) {}
        /**
         * Checks if an option is defined
         *
         * @param string $key
         * @return bool
         */
        public function hasOption($key) {}
        /**
         * Returns an option in the validator's options
         * Returns null if the option hasn't set
         *
         * @param string $key
         * @param mixed $defaultValue
         * @return mixed
         */
        public function getOption($key, $defaultValue = null) {}
        /**
         * Sets an option in the validator
         *
         * @param string $key
         * @param mixed $value
         */
        public function setOption($key, $value) {}
        /**
         * Executes the validation
         *
         * @param mixed $validation
         * @param string $attribute
         * @return bool
         */
        abstract public function validate(\Phalcon\Validation $validation, $attribute);
    }

    /**
     * Phalcon\Validation\ValidatorInterface
     * Interface for Phalcon\Validation\Validator
     */
    interface ValidatorInterface
    {
        /**
         * Checks if an option is defined
         *
         * @param string $key 
         * @return bool 
         */
        public function hasOption($key);
        /**
         * Returns an option in the validator's options
         * Returns null if the option hasn't set
         *
         * @param string $key 
         * @param mixed $defaultValue 
         * @return mixed 
         */
        public function getOption($key, $defaultValue = null);
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $attribute 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $attribute);
    }
}

namespace \Phalcon\Validation\Message {
    /**
     * Phalcon\Validation\Message\Group
     * Represents a group of validation messages
     */
    class Group implements \Countable, \ArrayAccess, \Iterator
    {
        protected $_position = 0;
        protected $_messages = array();
        /**
         * Phalcon\Validation\Message\Group constructor
         *
         * @param array $messages 
         */
        public function __construct($messages = null) {}
        /**
         * Gets an attribute a message using the array syntax
         * <code>
         * print_r($messages[0]);
         * </code>
         *
         * @param int $index 
         * @return \Phalcon\Validation\Message 
         */
        public function offsetGet($index) {}
        /**
         * Sets an attribute using the array-syntax
         * <code>
         * $messages[0] = new \Phalcon\Validation\Message('This is a message');
         * </code>
         *
         * @param int $index 
         * @param \Phalcon\Validation\Message $message 
         */
        public function offsetSet($index, $message) {}
        /**
         * Checks if an index exists
         * <code>
         * var_dump(isset($message['database']));
         * </code>
         *
         * @param int $index 
         * @return boolean 
         */
        public function offsetExists($index) {}
        /**
         * Removes a message from the list
         * <code>
         * unset($message['database']);
         * </code>
         *
         * @param string $index 
         */
        public function offsetUnset($index) {}
        /**
         * Appends a message to the group
         * <code>
         * $messages->appendMessage(new \Phalcon\Validation\Message('This is a message'));
         * </code>
         *
         * @param mixed $message 
         */
        public function appendMessage(\Phalcon\Validation\MessageInterface $message) {}
        /**
         * Appends an array of messages to the group
         * <code>
         * $messages->appendMessages($messagesArray);
         * </code>
         *
         * @param \Phalcon\Validation\MessageInterface[] $messages 
         */
        public function appendMessages($messages) {}
        /**
         * Filters the message group by field name
         *
         * @param string $fieldName 
         * @return array 
         */
        public function filter($fieldName) {}
        /**
         * Returns the number of messages in the list
         *
         * @return int 
         */
        public function count() {}
        /**
         * Rewinds the internal iterator
         */
        public function rewind() {}
        /**
         * Returns the current message in the iterator
         *
         * @return \Phalcon\Validation\Message 
         */
        public function current() {}
        /**
         * Returns the current position/key in the iterator
         *
         * @return int 
         */
        public function key() {}
        /**
         * Moves the internal iteration pointer to the next position
         */
        public function next() {}
        /**
         * Check if the current message in the iterator is valid
         *
         * @return bool 
         */
        public function valid() {}
        /**
         * Magic __set_state helps to re-build messages variable when exporting
         *
         * @param array $group 
         * @return \Phalcon\Validation\Message\Group 
         */
        public static function __set_state($group) {}
    }
}

namespace \Phalcon\Validation\Validator {
    /**
     * Phalcon\Validation\Validator\Alnum
     * Check for alphanumeric character(s)
     * <code>
     * use Phalcon\Validation\Validator\Alnum as AlnumValidator;
     * $validator->add('username', new AlnumValidator([
     * 'message' => ':field must contain only alphanumeric characters'
     * ]));
     * $validator->add(['username', 'name'], new AlnumValidator([
     * 'message' => [
     * 'username' => 'username must contain only alphanumeric characters',
     * 'name' => 'name must contain only alphanumeric characters'
     * ]
     * ]));
     * </code>
     */
    class Alnum extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Alpha
     * Check for alphabetic character(s)
     * <code>
     * use Phalcon\Validation\Validator\Alpha as AlphaValidator;
     * $validator->add('username', new AlphaValidator([
     * 'message' => ':field must contain only letters'
     * ]));
     * $validator->add(['username', 'name'], new AlphaValidator([
     * 'message' => [
     * 'username' => 'username must contain only letters',
     * 'name' => 'name must contain only letters'
     * ]
     * ]));
     * </code>
     */
    class Alpha extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Between
     * Validates that a value is between an inclusive range of two values.
     * For a value x, the test is passed if minimum<=x<=maximum.
     * <code>
     * use Phalcon\Validation\Validator\Between;
     * $validator->add('price', new Between([
     * 'minimum' => 0,
     * 'maximum' => 100,
     * 'message' => 'The price must be between 0 and 100'
     * ]));
     * $validator->add(['price', 'amount'], new Between([
     * 'minimum' => [
     * 'price' => 0,
     * 'amount' => 0
     * ],
     * 'maximum' => [
     * 'price' => 100,
     * 'amount' => 50
     * ],
     * 'message' => [
     * 'price' => 'The price must be between 0 and 100',
     * 'amount' => 'The amount must be between 0 and 50'
     * ]
     * ]));
     * </code>
     */
    class Between extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Confirmation
     * Checks that two values have the same value
     * <code>
     * use Phalcon\Validation\Validator\Confirmation;
     * $validator->add('password', new Confirmation([
     * 'message' => 'Password doesn\'t match confirmation',
     * 'with' => 'confirmPassword'
     * ]));
     * $validator->add(['password', 'email'], new Confirmation([
     * 'message' => [
     * 'password' => 'Password doesn\'t match confirmation',
     * 'email' => 'Email  doesn\'t match confirmation'
     * ],
     * 'with' => [
     * 'password => 'confirmPassword',
     * 'email' => 'confirmEmail'
     * ]
     * ]));
     * </code>
     */
    class Confirmation extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
        /**
         * Compare strings
         *
         * @param string $a 
         * @param string $b 
         * @return bool 
         */
        protected final function compare($a, $b) {}
    }

    /**
     * Phalcon\Validation\Validator\CreditCard
     * Checks if a value has a valid credit card number
     * <code>
     * use Phalcon\Validation\Validator\CreditCard as CreditCardValidator;
     * $validator->add('creditcard', new CreditCardValidator([
     * 'message' => 'The credit card number is not valid'
     * ]));
     * $validator->add(['creditcard', 'secondCreditCard'], new CreditCardValidator([
     * 'message' => [
     * 'creditcard' => 'The credit card number is not valid',
     * 'secondCreditCard' => 'The second credit card number is not valid'
     * ]
     * ]));
     * </code>
     */
    class CreditCard extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
        /**
         * is a simple checksum formula used to validate a variety of identification numbers
         *
         * @param string $number 
         * @return boolean 
         */
        private function verifyByLuhnAlgorithm($number) {}
    }

    /**
     * Phalcon\Validation\Validator\Date
     * Checks if a value is a valid date
     * <code>
     * use Phalcon\Validation\Validator\Date as DateValidator;
     * $validator->add('date', new DateValidator([
     * 'format' => 'd-m-Y',
     * 'message' => 'The date is invalid'
     * ]));
     * $validator->add(['date','anotherDate'], new DateValidator([
     * 'format' => [
     * 'date' => 'd-m-Y',
     * 'anotherDate' => 'Y-m-d'
     * ],
     * 'message' => [
     * 'date' => 'The date is invalid',
     * 'anotherDate' => 'The another date is invalid'
     * ]
     * ]));
     * </code>
     */
    class Date extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
        /**
         * @param mixed $value 
         * @param mixed $format 
         * @return bool 
         */
        private function checkDate($value, $format) {}
    }

    /**
     * Phalcon\Validation\Validator\Digit
     * Check for numeric character(s)
     * <code>
     * use Phalcon\Validation\Validator\Digit as DigitValidator;
     * $validator->add('height', new DigitValidator([
     * 'message' => ':field must be numeric'
     * ]));
     * $validator->add(['height', 'width'], new DigitValidator([
     * 'message' => [
     * 'height' => 'height must be numeric',
     * 'width' => 'width must be numeric'
     * ]
     * ]));
     * </code>
     */
    class Digit extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Email
     * Checks if a value has a correct e-mail format
     * <code>
     * use Phalcon\Validation\Validator\Email as EmailValidator;
     * $validator->add('email', new EmailValidator([
     * 'message' => 'The e-mail is not valid'
     * ]));
     * $validator->add(['email', 'anotherEmail'], new EmailValidator([
     * 'message' => [
     * 'email' => 'The e-mail is not valid',
     * 'anotherEmail' => 'The another e-mail is not valid'
     * ]
     * ]));
     * </code>
     */
    class Email extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\ExclusionIn
     * Check if a value is not included into a list of values
     * <code>
     * use Phalcon\Validation\Validator\ExclusionIn;
     * $validator->add('status', new ExclusionIn([
     * 'message' => 'The status must not be A or B',
     * 'domain' => ['A', 'B']
     * ]));
     * $validator->add(['status', 'type'], new ExclusionIn([
     * 'message' => [
     * 'status' => 'The status must not be A or B',
     * 'type' => 'The type must not be 1 or 2'
     * ],
     * 'domain' => [
     * 'status' => ['A', 'B'],
     * 'type' => [1, 2]
     * ]
     * ]));
     * </code>
     */
    class ExclusionIn extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\File
     * Checks if a value has a correct file
     * <code>
     * use Phalcon\Validation\Validator\File as FileValidator;
     * $validator->add('file', new FileValidator([
     * 'maxSize' => '2M',
     * 'messageSize' => ':field exceeds the max filesize (:max)',
     * 'allowedTypes' => array('image/jpeg', 'image/png'),
     * 'messageType' => 'Allowed file types are :types',
     * 'maxResolution' => '800x600',
     * 'messageMaxResolution' => 'Max resolution of :field is :max'
     * ]));
     * $validator->add(['file', 'anotherFile'], new FileValidator([
     * 'maxSize' => [
     * 'file' => '2M',
     * 'anotherFile' => '4M'
     * ],
     * 'messageSize' => [
     * 'file' => 'file exceeds the max filesize 2M',
     * 'anotherFile' => 'anotherFile exceeds the max filesize 4M',
     * 'allowedTypes' => [
     * 'file' => ['image/jpeg', 'image/png'],
     * 'anotherFile' => ['image/gif', 'image/bmp']
     * ],
     * 'messageType' => [
     * 'file' => 'Allowed file types are image/jpeg and image/png',
     * 'anotherFile' => 'Allowed file types are image/gif and image/bmp'
     * ],
     * 'maxResolution' => [
     * 'file' => '800x600',
     * 'anotherFile' => '1024x768'
     * ],
     * 'messageMaxResolution' => [
     * 'file' => 'Max resolution of file is 800x600',
     * 'anotherFile' => 'Max resolution of file is 1024x768'
     * ]
     * ]));
     * </code>
     */
    class File extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
        /**
         * Check on empty
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function isAllowEmpty(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Identical
     * Checks if a value is identical to other
     * <code>
     * use Phalcon\Validation\Validator\Identical;
     * $validator->add('terms', new Identical([
     * 'accepted' => 'yes',
     * 'message' => 'Terms and conditions must be accepted'
     * ]));
     * $validator->add(['terms', 'anotherTerms'], new Identical([
     * 'accepted' => [
     * 'terms' => 'yes',
     * 'anotherTerms' => 'yes'
     * ],
     * 'message' => [
     * 'terms' => 'Terms and conditions must be accepted',
     * 'anotherTerms' => 'Another terms  must be accepted'
     * ]
     * ]));
     * </code>
     */
    class Identical extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\InclusionIn
     * Check if a value is included into a list of values
     * <code>
     * use Phalcon\Validation\Validator\InclusionIn;
     * $validator->add('status', new InclusionIn([
     * 'message' => 'The status must be A or B',
     * 'domain' => array('A', 'B')
     * ]));
     * $validator->add(['status', 'type'], new InclusionIn([
     * 'message' => [
     * 'status' => 'The status must be A or B',
     * 'type' => 'The status must be 1 or 2'
     * ],
     * 'domain' => [
     * 'status' => ['A', 'B'],
     * 'type' => [1, 2]
     * ]
     * ]));
     * </code>
     */
    class InclusionIn extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Numericality
     * Check for a valid numeric value
     * <code>
     * use Phalcon\Validation\Validator\Numericality;
     * $validator->add('price', new Numericality([
     * 'message' => ':field is not numeric'
     * ]));
     * $validator->add(['price', 'amount'], new Numericality([
     * 'message' => [
     * 'price' => 'price is not numeric',
     * 'amount' => 'amount is not numeric'
     * ]
     * ]));
     * </code>
     */
    class Numericality extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\PresenceOf
     * Validates that a value is not null or empty string
     * <code>
     * use Phalcon\Validation\Validator\PresenceOf;
     * $validator->add('name', new PresenceOf([
     * 'message' => 'The name is required'
     * ]));
     * $validator->add(['name', 'email'], new PresenceOf([
     * 'message' => [
     * 'name' => 'The name is required',
     * 'email' => 'The email is required'
     * ]
     * ]));
     * </code>
     */
    class PresenceOf extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Regex
     * Allows validate if the value of a field matches a regular expression
     * <code>
     * use Phalcon\Validation\Validator\Regex as RegexValidator;
     * $validator->add('created_at', new RegexValidator([
     * 'pattern' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/',
     * 'message' => 'The creation date is invalid'
     * ]));
     * $validator->add(['created_at', 'name'], new RegexValidator([
     * 'pattern' => [
     * 'created_at' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/',
     * 'name' => '/^[a-z]$/'
     * ],
     * 'message' => [
     * 'created_at' => 'The creation date is invalid',
     * 'name' => ' 'The name is invalid'
     * ]
     * ]));
     * </code>
     */
    class Regex extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\StringLength
     * Validates that a string has the specified maximum and minimum constraints
     * The test is passed if for a string's length L, min<=L<=max, i.e. L must
     * be at least min, and at most max.
     * <code>
     * use Phalcon\Validation\Validator\StringLength as StringLength;
     * $validation->add('name_last', new StringLength([
     * 'max' => 50,
     * 'min' => 2,
     * 'messageMaximum' => 'We don\'t like really long names',
     * 'messageMinimum' => 'We want more than just their initials'
     * ]));
     * $validation->add(['name_last', 'name_first'], new StringLength([
     * 'max' => [
     * 'name_last' => 50,
     * 'name_first' => 40
     * ],
     * 'min' => [
     * 'name_last' => 2,
     * 'name_first' => 4
     * ],
     * 'messageMaximum' => [
     * 'name_last' => 'We don\'t like really long last names',
     * 'name_first' => 'We don\'t like really long first names'
     * ],
     * 'messageMinimum' => [
     * 'name_last' => 'We don\'t like too short last names',
     * 'name_first' => 'We don\'t like too short first names',
     * ]
     * ]));
     * </code>
     */
    class StringLength extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Uniqueness
     * Check that a field is unique in the related table
     * <code>
     * use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
     * $validator->add('username', new UniquenessValidator([
     * 'model' => new Users(),
     * 'message' => ':field must be unique'
     * ]));
     * </code>
     * Different attribute from the field:
     * <code>
     * $validator->add('username', new UniquenessValidator([
     * 'model' => new Users(),
     * 'attribute' => 'nick'
     * ]));
     * </code>
     * In model:
     * <code>
     * $validator->add('username', new UniquenessValidator());
     * </code>
     * Combination of fields in model:
     * <code>
     * $validator->add(['firstName', 'lastName'], new UniquenessValidator());
     * </code>
     * It is possible to convert values before validation. This is useful in
     * situations where values need to be converted to do the database lookup:
     * <code>
     * $validator->add('username', new UniquenessValidator([
     * 'convert' => function (array $values) {
     * $values['username'] = strtolower($values['username']);
     * return $values;
     * }
     * ]));
     * </code>
     */
    class Uniqueness extends \Phalcon\Validation\CombinedFieldsValidator
    {
        private $columnMap = null;
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param mixed $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
        /**
         * @param mixed $validation 
         * @param mixed $field 
         * @return bool 
         */
        protected function isUniqueness(\Phalcon\Validation $validation, $field) {}
        /**
         * The column map is used in the case to get real column name
         *
         * @param mixed $record 
         * @param string $field 
         * @return string 
         */
        protected function getColumnNameReal($record, $field) {}
    }

    /**
     * Phalcon\Validation\Validator\Url
     * Checks if a value has a url format
     * <code>
     * use Phalcon\Validation\Validator\Url as UrlValidator;
     * $validator->add('url', new UrlValidator([
     * 'message' => ':field must be a url'
     * ]));
     * $validator->add(['url', 'homepage'], new UrlValidator([
     * 'message' => [
     * 'url' => 'url must be a url',
     * 'homepage' => 'homepage must be a url'
     * ]
     * ]));
     * </code>
     */
    class Url extends \Phalcon\Validation\Validator
    {
        /**
         * Executes the validation
         *
         * @param mixed $validation 
         * @param string $field 
         * @return bool 
         */
        public function validate(\Phalcon\Validation $validation, $field) {}
    }
}