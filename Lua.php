<?php

// php_lua PECL

/**
 * Class implemented by the php_lua PECL extension.
 * Lua is a powerful, fast, light-weight, embeddable scripting language. 
 * This extension embeds the lua interpreter and offers an OO-API to lua variables and functions. 
 */
class Lua 
{
   /**
    * Lua version number
    */
   const string LUA_VERSION = 'Lua 5.1.4';

   /**
    * Assign a PHP variable to Lua
    * 
    * @link http://php.net/manual/en/lua.assign.php
    * @param string $name Lua variable name
    * @param string $value PHP variable value
    * @return mixed Returns $this or NULL on failure.
    */
   public function assign ($name, $value) { }

   /**
    * Call Lua functions
    * 
    * @link http://php.net/manual/en/lua.call.php
    * @param callable $lua_func Function name in lua
    * @param array $args Arguments passed to the Lua function
    * @param int $use_self Whether to use self
    * @return mixed Returns result of the called function, NULL for wrong arguments or FALSE on other failure.
    */
   public function call ($lua_func, $args, $use_self = 0) { }

   /**
    * Call Lua functions
    * 
    * @link http://php.net/manual/en/lua.call.php
    * @param callable $lua_func Function name in lua
    * @param array $args Arguments passed to the Lua function
    * @param int $use_self Whether to use self
    * @return mixed Returns result of the called function, NULL for wrong arguments or FALSE on other failure.
    */
   public function mixed __call ($lua_func, $args, $use_self = 0) { }

   /**
    * Lua constructor
    * 
    * @link http://php.net/manual/en/lua.construct.php
    * @param string $lua_script_file
    * @return mixed
    */
   public function __construct ($lua_script_file = NULL) { }

   /**
    * Evaluate a string as Lua code
    * 
    * @link http://php.net/manual/en/lua.eval.php
    * @param string $statements Lua code
    * @return mixed Returns result of evaled code, NULL for wrong arguments or FALSE on other failure.
    */
   public function eval ($statements) { }

   /**
    * Get the Lua version
    * 
    * @link http://php.net/manual/en/lua.getversion.php
    * @return string Returns Lua::LUA_VERSION. 
    */
   public function getVersion () { }

   /**
    * Parse a Lua script file
    * 
    * @link http://php.net/manual/en/lua.include.php
    * @param string $file Lua script file
    * @return mixed  Returns result of included code, NULL for wrong arguments or FALSE on other failure. 
    */
   public function include ($file) { }

   /**
    *  Register a PHP function to Lua as a function named "$name" 
    * 
    * @link http://php.net/manual/en/lua.registercallback.php
    * @param string $name The Lua function name
    * @param callable $function A valid PHP function callback 
    * @return mixed Returns $this, NULL for wrong arguments or FALSE on other failure.
    */
   public function registerCallback ($name, $function) { }
}

// end php_lua PECL

?>
