<?php

// php_runkit PECL

/**
 * Convert a base class to an inherited class, add ancestral methods when appropriate
 * @link http://php.net/manual/en/function.runkit-class-adopt.php
 * @param string $classname <p>
 * Name of class to be adopted
 * </p>
 * @param string $parentname <p>
 * Parent class which child class is extending
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_class_adopt ($classname, $parentname) { }

/**
 * Convert an inherited class to a base class, removes any method whose scope is ancestral 
 * @link http://php.net/manual/en/function.runkit-class-emancipate.php
 * @param string $classname <p>
 * Name of class to emancipate
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_class_emancipate ($classname) { }

/**
 * Similar to define(), but allows defining in class definitions as well 
 * @link http://php.net/manual/en/function.runkit-constant-add.php
 * @param string $constname <p>
 * Name of constant to declare. Either a string to indicate a global constant, or classname::constname 
 * to indicate a class constant.
 * </p>
 * @param mixed $value <p>
 * NULL, Bool, Long, Double, String, or Resource value to store in the new constant.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_constant_add ($constname, $value) { }

/**
 *  Redefine an already defined constant 
 * @link http://php.net/manual/en/function.runkit-constant-redefine.php
 * @param string $constname <p>
 * Constant to redefine. Either string indicating global constant, or classname::constname indicating 
 * class constant.
 * </p>
 * @param mixed $newvalue <p>
 * New value to assign to constant.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_constant_redefine ($constname, $newvalue) { }

/**
 * Remove/Delete an already defined constant
 * @link http://php.net/manual/en/function.runkit-constant-remove.php
 * @param string $constname <p>
 * Name of constant to remove. Either a string indicating a global constant, or classname::constname 
 * indicating a class constant.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_constant_remove ($constname) { }

/**
 * Add a new function, similar to create_function()
 * @link http://php.net/manual/en/function.runkit-function-add.php
 * @param string $funcname <p>
 * Name of function to be created
 * </p>
 * @param string $arglist <p>
 * Comma separated argument list
 * </p>
 * @param string $code <p>
 * Code making up the function
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_function_add ($funcname, $arglist, $code) { }

/**
 * Copy a function to a new function name
 * @link http://php.net/manual/en/function.runkit-function-copy.php
 * @param string $funcname <p>
 * Name of existing function
 * </p>
 * @param string $targetname <p>
 * Name of new function to copy definition to
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_function_copy ($funcname, $targetname) { }

/**
 * Replace a function definition with a new implementation
 * @link http://php.net/manual/en/function.runkit-function-redefine.php
 * @param string $funcname <p>
 * Name of function to redefine
 * </p>
 * @param string $arglist <p>
 * New list of arguments to be accepted by function
 * </p>
 * @param string $code <p>
 * New code implementation
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_function_redefine ($funcname, $arglist, $code) { }

/**
 * Remove a function definition
 * @link http://php.net/manual/en/function.runkit-function-remove.php
 * @param string $funcname <p>
 * Name of function to be deleted
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_function_remove ($funcname) { }

/**
 * Change a function's name
 * @link http://php.net/manual/en/function.runkit-function-rename.php
 * @param string $funcname <p>
 * Current function name
 * </p>
 * @param string $newname <p>
 * New function name
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_function_rename ($funcname, $newname) { }

/**
 * Similar to include however any code residing outside of a function or class is simply ignored. 
 * Additionally, depending on the value of flags, any functions or classes which already exist in the 
 * currently running environment will be automatically overwritten by their new definitions.
 * @link http://php.net/manual/en/function.runkit-import.php
 * @param string $filename <p>
 * Filename to import function and class definitions from
 * </p>
 * @param int $flags <p>
 * Bitwise OR of the RUNKIT_IMPORT_* family of constants.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_import ($filename, $flags = RUNKIT_IMPORT_CLASS_METHODS) { }

/**
 * The runkit_lint_file() function performs a syntax (lint) check on the specified filename testing for 
 * scripting errors. This is similar to using php -l from the commandline.
 * @link http://php.net/manual/en/function.runkit-lint-file.php
 * @param string $filename <p>
 * File containing PHP Code to be lint checked
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_lint_file ($filename) { }

/**
 * The runkit_lint() function performs a syntax (lint) check on the specified php code testing for 
 * scripting errors. This is similar to using php -l from the command line except runkit_lint() accepts 
 * actual code rather than a filename.
 * @link http://php.net/manual/en/function.runkit-lint.php
 * @param string $code <p>
 * PHP Code to be lint checked
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_lint ($code) { }

/**
 * Dynamically adds a new method to a given class
 * @link http://php.net/manual/en/function.runkit-method-add.php
 * @param string $classname <p>
 * The class to which this method will be added
 * </p>
 * @param string $methodname <p>
 * The name of the method to add
 * </p>
 * @param string $args <p>
 * Comma-delimited list of arguments for the newly-created method
 * </p>
 * @param string $code <p>
 * The code to be evaluated when methodname is called
 * </p>
 * @param int $flags <p>
 * The type of method to create, can be RUNKIT_ACC_PUBLIC, RUNKIT_ACC_PROTECTED or RUNKIT_ACC_PRIVATE 
 * Note: This parameter is only used as of PHP 5, because, prior to this, all methods were public.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_method_add ($classname, $methodname, $args, $code, $flags = RUNKIT_ACC_PUBLIC) { }

/**
 * Copies a method from class to another
 * @link http://php.net/manual/en/function.runkit-method-copy.php
 * @param string $dClass <p>
 * Destination class for copied method
 * </p>
 * @param string $dMethod <p>
 * Destination method name
 * </p>
 * @param string $sClass <p>
 * Source class of the method to copy
 * </p>
 * @param string $sMethod <p>
 * Name of the method to copy from the source class. If this parameter is omitted, the value of dMethod 
 * is assumed.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_method_copy ($dClass, $dMethod, $sClass, $sMethod) { }

/**
 * Dynamically changes the code of the given method
 * @link http://php.net/manual/en/function.runkit-method-redefine.php
 * @param string $classname <p>
 * The class in which to redefine the method
 * </p>
 * @param string $methodname <p>
 * The name of the method to redefine
 * </p>
 * @param string $args <p>
 * Comma-delimited list of arguments for the redefined method
 * </p>
 * @param string $code <p>
 * The new code to be evaluated when methodname is called
 * </p>
 * @param int $flags <p>
 * The redefined method can be RUNKIT_ACC_PUBLIC, RUNKIT_ACC_PROTECTED or RUNKIT_ACC_PRIVATE Note: This 
 * parameter is only used as of PHP 5, because, prior to this, all methods were public.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_method_redefine ($classname, $methodname, $args, $code, $flags = RUNKIT_ACC_PUBLIC) { }

/**
 * Dynamically removes the given method
 * @link http://php.net/manual/en/function.runkit-method-remove.php
 * @param string $classname <p>
 * The class in which to remove the method
 * </p>
 * @param string $methodname <p>
 * The name of the method to remove
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_method_remove ($classname, $methodname) { }

/**
 * Dynamically changes the name of the given method
 * @link http://php.net/manual/en/function.runkit-method-rename.php
 * @param string $classname <p>
 * The class in which to rename the method
 * </p>
 * @param string $methodname <p>
 * The name of the method to rename
 * </p>
 * @param string $newname <p>
 * The new name to give to the renamed method
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function runkit_method_rename ($classname, $methodname, $newname) { }

/**
 * Determines if the current functions return value will be used
 * @link http://php.net/manual/en/function.runkit-return-value-used.php
 * @return bool Returns TRUE if the function's return value is used by the calling scope, otherwise FALSE
 */
function runkit_return_value_used () { }

/**
 * <p>Ordinarily, anything output (such as with echo or print) will be output as though it were printed 
 * from the parent's scope. Using runkit_sandbox_output_handler() however, output generated by the 
 * sandbox (including errors), can be captured by a function outside of the sandbox.</p>
 * <p>As of runkit version 0.5, this function is deprecated and is scheduled to be removed from the 
 * package prior to a 1.0 release. The output handler for a given Runkit_Sandbox instance may be 
 * read/set using the array offset syntax shown on the Runkit_Sandbox class definition page.</p>
 * @link http://php.net/manual/en/function.runkit-sandbox-output-handler.php
 * @param object $sandbox <p>
 * Object instance of Runkit_Sandbox class on which to set output handling.
 * </p>
 * @param mixed $callback <p>
 * Name of a function which expects one parameter. Output generated by sandbox will be passed to this 
 * callback. Anything returned by the callback will be displayed normally. If this parameter is not 
 * passed then output handling will not be changed. If a non-truth value is passed, output handling 
 * will be disabled and will revert to direct display.
 * </p>
 * @return mixed Returns the name of the previously defined output handler callback, or FALSE if no handler was 
 * previously defined.
 */
function runkit_sandbox_output_handler ($sandbox, $callback) { }

/**
 * Return numerically indexed array of registered superglobals
 * @link http://php.net/manual/en/function.runkit-superglobals.php
 * @return array Returns a numerically indexed array of the currently registered superglobals. i.e. _GET, _POST, 
 * _REQUEST, _COOKIE, _SESSION, _SERVER, _ENV, _FILES
 */
function runkit_superglobals () { }

/**
 *
 */
function runkit_zval_inspect () { }

/**
 *
 */
function runkit_return_value_used () { }

/**
 *
 */
function runkit_default_property_add () { }

/**
 * Runkit Sandbox Class -- PHP Virtual Machine
 * <p>Instantiating the Runkit_Sandbox class creates a new thread with its own scope and program stack. 
 * Using a set of options passed to the constructor, this environment may be restricted to a subset of 
 * what the primary interpreter can do and provide a safer environment for executing user supplied code.</p>
 * <p>
 * options is an associative array containing any combination of the special ini options listed below. 
 * </p>
 * <p>
 * <b>safe_mode</b> - If the outer script which is instantiating the Runkit_Sandbox class is configured 
 * with safe_mode = off, then safe_mode may be turned on for the sandbox environment. This setting can not 
 * be used to disable safe_mode when it's already enabled in the outer script.
 * </p>
 * <p>
 * <b>safe_mode_gid</b> - If the outer script which is instantiating the Runkit_Sandbox class is configured 
 * with safe_mode_gid = on, then safe_mode_gid may be turned off for the sandbox environment. This setting 
 * can not be used to enable safe_mode_gid when it's already disabled in the outer script. 
 * </p>
 * <p>
 * <b>safe_mode_include_dir</b> - If the outer script which is instantiating the Runkit_Sandbox class is 
 * configured with a safe_mode_include_dir, then a new safe_mode_include_dir may be set for sandbox environments 
 * below the currently defined value. safe_mode_include_dir may also be cleared to indicate that the bypass 
 * feature is disabled. If safe_mode_include_dir was blank in the outer script, but safe_mode was not enabled, 
 * then any arbitrary safe_mode_include_dir may be set while turning safe_mode on. 
 * </p>
 * <p>
 * <b>open_basedir</b> - open_basedir may be set to any path below the current setting of open_basedir. If  
 * open_basedir is not set within the global scope, then it is assumed to be the root directory and may be set  
 * to any location. 
 * </p>
 * <p>
 * <b>allow_url_fopen</b> - Like safe_mode, this setting can only be made more restrictive, in this case by  
 * setting it to FALSE when it is previously set to TRUE
 * </p>
 * <p>
 * <b>disable_functions</b> - Comma separated list of functions to disable within the sandbox sub-interpreter. 
 * This list need not contain the names of the currently disabled functions, they will remain disabled whether 
 * listed here or not.
 * </p>
 * <p>
 * <b>disable_classes</b> - Comma separated list of classes to disable within the sandbox sub-interpreter. 
 * This list need not contain the names of the currently disabled classes, they will remain disabled whether 
 * listed here or not. 
 * </p>
 * <p>
 * <b>runkit.superglobal</b> - Comma separated list of variables to be treated as superglobals within the 
 * sandbox sub-interpreter. These variables will be used in addition to any variables defined internally 
 * or through the global runkit.superglobal setting. 
 * </p>
 * <p>
 * <b>runkit.internal_override</b> - Ini option runkit.internal_override may be disabled (but not 
 * re-enabled) within sandboxes. 
 * </p>
 * @link http://php.net/manual/en/runkit.sandbox.php
 */
class Runkit_Sandbox 
{
   /**
    * Instantiate the Runkit_Sandbox class 
    * 
    * @param array $options <p>
    * options is an associative array containing any combination of the special ini options listed below. 
    * </p>
    * @return Runkit_Sandbox
    */
   public function __construct ($options = array()) { }
}

/**
 * Instantiating the Runkit_Sandbox_Parent class from within a sandbox environment created from the 
 * Runkit_Sandbox class provides some (controlled) means for a sandbox child to access its parent. 
 * @link http://php.net/manual/en/runkit.sandbox-parent.php
 */
class Runkit_Sandbox_Parent
{
   /**
    * Instantiate the Runkit_Sandbox_Parent class 
    * 
    * @return Runkit_Sandbox_Parent
    */
   public function __construct () { }
}



/**
 * runkit_import() flag indicating that normal functions should be imported from the specified file.
 */
define('RUNKIT_IMPORT_FUNCTIONS', 1);

/**
 * runkit_import() flag indicating that class methods should be imported from the specified file.
 */
define('RUNKIT_IMPORT_CLASS_METHODS', 2);

/**
 * runkit_import() flag indicating that class constants should be imported from the specified file. 
 * Note that this flag is only meaningful in PHP versions 5.1.0 and above.
 */
define('RUNKIT_IMPORT_CLASS_CONSTS', 4);

/**
 * runkit_import() flag indicating that class standard properties should be imported from the specified 
 * file.
 */
define('RUNKIT_IMPORT_CLASS_PROPS', 8);

/**
 * runkit_import() flag indicating that class static properties should be imported from the specified
 * file
 */
define('RUNKIT_IMPORT_CLASS_STATIC_PROPS', 16);

/**
 * runkit_import() flag representing a bitwise OR of the RUNKIT_IMPORT_CLASS_* constants.
 */
define('RUNKIT_IMPORT_CLASSES', 30);

/**
 * runkit_import() flag indicating that if any of the imported functions, methods, constants, or 
 * properties already exist, they should be replaced with the new definitions. If this flag is not set, 
 * then any imported definitions which already exist will be discarded.
 */
define('RUNKIT_IMPORT_OVERRIDE', 32);

/**
 * PHP 5 specific flag to runkit_method_add()
 */
define('RUNKIT_ACC_RETURN_REFERENCE', 67108864);

/**
 * PHP 5 specific flag to runkit_method_add()
 */
define('RUNKIT_ACC_PUBLIC', 256);

/**
 * PHP 5 specific flag to runkit_method_add()
 */
define('RUNKIT_ACC_PROTECTED', 512);

/**
 * PHP 5 specific flag to runkit_method_add()
 */
define('RUNKIT_ACC_PRIVATE', 1024);

/**
 * PHP 5 specific flag to runkit_method_add()
 */
define('RUNKIT_ACC_STATIC', 1);

/**
 * Defined to the current version of the runkit package.
 */
define('RUNKIT_VERSION', "1.0.4-dev");

/**
 * 
 */
define('RUNKIT_OVERRIDE_OBJECTS', 32768);

/**
 * runkit feature manipulation enabled
 */
define('RUNKIT_FEATURE_MANIPULATION', 1);

/**
 * runkit custom superglobals enabled
 */
define('RUNKIT_FEATURE_SUPERGLOBALS', 1);

/**
 * runkit sandbox enabled
 */
define('RUNKIT_FEATURE_SANDBOX', 1);

// end php_runkit PECL

?>
