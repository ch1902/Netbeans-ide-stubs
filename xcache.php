<?php

// php_xcache PECL

/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $op_type <p>
 * 
 * </p>
 * @return string
 */
function xcache_coredump ($op_type) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $filename <p>
 * 
 * </p>
 * @return string
 */
function xcache_asm ($filename) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $filename <p>
 * 
 * </p>
 * @return string
 */
function xcache_encode ($filename) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $filename <p>
 * 
 * </p>
 * @return bool
 */
function xcache_decode_file ($filename) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $data <p>
 * 
 * </p>
 * @return bool
 */
function xcache_decode_string ($data) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param zval $value <p>
 * 
 * </p>
 * @return mixed
 */
function xcache_get_special_value ($value) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param zval $type <p>
 * 
 * </p>
 * @return int
 */
function xcache_get_type ($type) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param int $op_type <p>
 * 
 * </p>
 * @return string
 */
function xcache_get_op_type ($op_type) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param int $type <p>
 * 
 * </p>
 * @return string
 */
function xcache_get_data_type ($type) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param int $opcode <p>
 * 
 * </p>
 * @return string
 */
function xcache_get_opcode ($opcode) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param int $opcode <p>
 * 
 * </p>
 * @return string
 */
function xcache_get_opcode_spec ($opcode) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $name <p>
 * 
 * </p>
 * @return 
 */
function xcache_is_autoglobal ($name) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param mixed $variable <p>
 * 
 * </p>
 * @return int
 */
function xcache_get_refcount ($variable) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param mixed variable <p>
 * 
 * </p>
 * @return bool
 */
function xcache_get_isref ($variable) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $type <p>
 * 
 * </p>
 * @return int
 */
function xcache_count ($type) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $type <p>
 * 
 * </p>
 * @param int $id <p>
 * 
 * </p>
 * @return array
 */
function xcache_info ($type, $id) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $type <p>
 * 
 * </p>
 * @param int $id <p>
 * 
 * </p>
 * @return array
 */
function xcache_list ($type, $id) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $type <p>
 * 
 * </p>
 * @param int $id <p>
 * 
 * </p>
 * @return void
 */
function xcache_clear_cache ($type, $id = -1) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param int $type <p>
 * 
 * </p>
 * @param int $id <p>
 * 
 * </p>
 * @param bool $enable <p>
 * 
 * </p>
 * @return array
 */
function xcache_enable_cache ($type, $id = -1, $enable = true) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param <p>
 * 
 * </p>
 * @return array
 */
function xcache_admin_namespace () { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#AdministratorFunctions
 * @param string $namespace <p>
 * 
 * </p>
 * @return bool
 */
function xcache_set_namespace ($namespace) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @return mixed
 */
function xcache_get ($name) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @param mixed $value <p>
 * 
 * </p>
 * @param int $ttl <p>
 * 
 * </p>
 * @return bool
 */
function xcache_set ($name, $value, $ttl = 0) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @return bool
 */
function xcache_isset ($name) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @return bool
 */
function xcache_unset ($name) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $prefix <p>
 * 
 * </p>
 * @return bool
 */
function xcache_unset_by_prefix ($prefix) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @param int $value <p>
 * 
 * </p>
 * @param int $ttl <p>
 * 
 * </p>
 * @return int
 */
function xcache_inc ($name, $value = 0, $ttl = 0) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CommonUsedFunctions
 * @param string $name <p>
 * 
 * </p>
 * @param int $value <p>
 * 
 * </p>
 * @param int $ttl <p>
 * 
 * </p>
 * @return int
 */
function xcache_dec ($name, $value = 0, $ttl = 0) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CoveragerFunctions
 * @param string $data <p>
 * 
 * </p>
 * @return array
 */
function xcache_coverager_decode ($data) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CoveragerFunctions
 * @param bool $clean <p>
 * 
 * </p>
 * @return void
 */
function xcache_coverager_start ($clean = true) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CoveragerFunctions
 * @param bool $clean <p>
 * 
 * </p>
 * @return void
 */
function xcache_coverager_stop ($clean = false) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#CoveragerFunctions
 * @param bool $clean <p>
 * 
 * </p>
 * @return array 
 */
function xcache_coverager_get ($clean = false) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $filename <p>
 * 
 * </p>
 * @return string
 */
function xcache_dasm_file ($filename) { }
/**
 * 
 * @link http://xcache.lighttpd.net/wiki/XcacheApi#DisAssemblerOpcodeFunctions
 * @param string $code <p>
 * 
 * </p>
 * @return string
 */
function xcache_dasm_string ($code) { }

/**
 * @var int
 */
define('XC_NULL?', 0);
/**
 * @var int
 */
define('XC_IS_CONST', 1);
/**
 * @var int
 */
define('XC_IS_TMP_VAR', 2);
/**
 * @var int
 */
define('XC_IS_VAR', 4);
/**
 * @var int
 */
define('XC_IS_UNUSED', 8);
/**
 * @var int
 */
define('XC_IS_CV', 16);
/**
 * @var int
 */
define('XC_IS_NULL', 0);
/**
 * @var int
 */
define('XC_IS_LONG', 1);
/**
 * @var int
 */
define('XC_IS_DOUBLE', 2);
/**
 * @var int
 */
define('XC_IS_BOOL', 3);
/**
 * @var int
 */
define('XC_IS_ARRAY', 4);
/**
 * @var int
 */
define('XC_IS_OBJECT', 5);
/**
 * @var int
 */
define('XC_IS_STRING', 6);
/**
 * @var int
 */
define('XC_IS_RESOURCE', 7);
/**
 * @var int
 */
define('XC_IS_CONSTANT', 8);
/**
 * @var int
 */
define('XC_IS_CONSTANT_ARRAY', 9);
/**
 * @var int
 */
define('XC_IS_UNICODE', 10);
/**
 * @var int
 */
define('XC_NOP', 0);
/**
 * @var int
 */
define('XC_ADD', 1);
/**
 * @var int
 */
define('XC_SUB', 2);
/**
 * @var int
 */
define('XC_MUL', 3);
/**
 * @var int
 */
define('XC_DIV', 4);
/**
 * @var int
 */
define('XC_MOD', 5);
/**
 * @var int
 */
define('XC_SL', 6);
/**
 * @var int
 */
define('XC_SR', 7);
/**
 * @var int
 */
define('XC_CONCAT', 8);
/**
 * @var int
 */
define('XC_BW_OR', 9);
/**
 * @var int
 */
define('XC_BW_AND', 10);
/**
 * @var int
 */
define('XC_BW_XOR', 11);
/**
 * @var int
 */
define('XC_BW_NOT', 12);
/**
 * @var int
 */
define('XC_BOOL_NOT', 13);
/**
 * @var int
 */
define('XC_BOOL_XOR', 14);
/**
 * @var int
 */
define('XC_IS_IDENTICAL', 15);
/**
 * @var int
 */
define('XC_IS_NOT_IDENTICAL', 16);
/**
 * @var int
 */
define('XC_IS_EQUAL', 17);
/**
 * @var int
 */
define('XC_IS_NOT_EQUAL', 18);
/**
 * @var int
 */
define('XC_IS_SMALLER', 19);
/**
 * @var int
 */
define('XC_IS_SMALLER_OR_EQUAL', 20);
/**
 * @var int
 */
define('XC_CAST', 21);
/**
 * @var int
 */
define('XC_QM_ASSIGN', 22);
/**
 * @var int
 */
define('XC_ASSIGN_ADD', 23);
/**
 * @var int
 */
define('XC_ASSIGN_SUB', 24);
/**
 * @var int
 */
define('XC_ASSIGN_MUL', 25);
/**
 * @var int
 */
define('XC_ASSIGN_DIV', 26);
/**
 * @var int
 */
define('XC_ASSIGN_MOD', 27);
/**
 * @var int
 */
define('XC_ASSIGN_SL', 28);
/**
 * @var int
 */
define('XC_ASSIGN_SR', 29);
/**
 * @var int
 */
define('XC_ASSIGN_CONCAT', 30);
/**
 * @var int
 */
define('XC_ASSIGN_BW_OR', 31);
/**
 * @var int
 */
define('XC_ASSIGN_BW_AND', 32);
/**
 * @var int
 */
define('XC_ASSIGN_BW_XOR', 33);
/**
 * @var int
 */
define('XC_PRE_INC', 34);
/**
 * @var int
 */
define('XC_PRE_DEC', 35);
/**
 * @var int
 */
define('XC_POST_INC', 36);
/**
 * @var int
 */
define('XC_POST_DEC', 37);
/**
 * @var int
 */
define('XC_ASSIGN', 38);
/**
 * @var int
 */
define('XC_ASSIGN_REF', 39);
/**
 * @var int
 */
define('XC_ECHO', 40);
/**
 * @var int
 */
define('XC_PRINT', 41);
/**
 * @var int
 */
define('XC_JMP', 42);
/**
 * @var int
 */
define('XC_JMPZ', 43);
/**
 * @var int
 */
define('XC_JMPNZ', 44);
/**
 * @var int
 */
define('XC_JMPZNZ', 45);
/**
 * @var int
 */
define('XC_JMPZ_EX', 46);
/**
 * @var int
 */
define('XC_JMPNZ_EX', 47);
/**
 * @var int
 */
define('XC_CASE', 48);
/**
 * @var int
 */
define('XC_SWITCH_FREE', 49);
/**
 * @var int
 */
define('XC_BRK', 50);
/**
 * @var int
 */
define('XC_CONT', 51);
/**
 * @var int
 */
define('XC_BOOL', 52);
/**
 * @var int
 */
define('XC_INIT_STRING', 53);
/**
 * @var int
 */
define('XC_ADD_CHAR', 54);
/**
 * @var int
 */
define('XC_ADD_STRING', 55);
/**
 * @var int
 */
define('XC_ADD_VAR', 56);
/**
 * @var int
 */
define('XC_BEGIN_SILENCE', 57);
/**
 * @var int
 */
define('XC_END_SILENCE', 58);
/**
 * @var int
 */
define('XC_INIT_FCALL_BY_NAME', 59);
/**
 * @var int
 */
define('XC_DO_FCALL', 60);
/**
 * @var int
 */
define('XC_DO_FCALL_BY_NAME', 61);
/**
 * @var int
 */
define('XC_RETURN', 62);
/**
 * @var int
 */
define('XC_RECV', 63);
/**
 * @var int
 */
define('XC_RECV_INIT', 64);
/**
 * @var int
 */
define('XC_SEND_VAL', 65);
/**
 * @var int
 */
define('XC_SEND_VAR', 66);
/**
 * @var int
 */
define('XC_SEND_REF', 67);
/**
 * @var int
 */
define('XC_NEW', 68);
/**
 * @var int
 */
define('XC_INIT_NS_FCALL_BY_NAME', 69);
/**
 * @var int
 */
define('XC_FREE', 70);
/**
 * @var int
 */
define('XC_INIT_ARRAY', 71);
/**
 * @var int
 */
define('XC_ADD_ARRAY_ELEMENT', 72);
/**
 * @var int
 */
define('XC_INCLUDE_OR_EVAL', 73);
/**
 * @var int
 */
define('XC_UNSET_VAR', 74);
/**
 * @var int
 */
define('XC_UNSET_DIM', 75);
/**
 * @var int
 */
define('XC_UNSET_OBJ', 76);
/**
 * @var int
 */
define('XC_FE_RESET', 77);
/**
 * @var int
 */
define('XC_FE_FETCH', 78);
/**
 * @var int
 */
define('XC_EXIT', 79);
/**
 * @var int
 */
define('XC_FETCH_R', 80);
/**
 * @var int
 */
define('XC_FETCH_DIM_R', 81);
/**
 * @var int
 */
define('XC_FETCH_OBJ_R', 82);
/**
 * @var int
 */
define('XC_FETCH_W', 83);
/**
 * @var int
 */
define('XC_FETCH_DIM_W', 84);
/**
 * @var int
 */
define('XC_FETCH_OBJ_W', 85);
/**
 * @var int
 */
define('XC_FETCH_RW', 86);
/**
 * @var int
 */
define('XC_FETCH_DIM_RW', 87);
/**
 * @var int
 */
define('XC_FETCH_OBJ_RW', 88);
/**
 * @var int
 */
define('XC_FETCH_IS', 89);
/**
 * @var int
 */
define('XC_FETCH_DIM_IS', 90);
/**
 * @var int
 */
define('XC_FETCH_OBJ_IS', 91);
/**
 * @var int
 */
define('XC_FETCH_FUNC_ARG', 92);
/**
 * @var int
 */
define('XC_FETCH_DIM_FUNC_ARG', 93);
/**
 * @var int
 */
define('XC_FETCH_OBJ_FUNC_ARG', 94);
/**
 * @var int
 */
define('XC_FETCH_UNSET', 95);
/**
 * @var int
 */
define('XC_FETCH_DIM_UNSET', 96);
/**
 * @var int
 */
define('XC_FETCH_OBJ_UNSET', 97);
/**
 * @var int
 */
define('XC_FETCH_DIM_TMP_VAR', 98);
/**
 * @var int
 */
define('XC_FETCH_CONSTANT', 99);
/**
 * @var int
 */
define('XC_GOTO', 100);
/**
 * @var int
 */
define('XC_EXT_STMT', 101);
/**
 * @var int
 */
define('XC_EXT_FCALL_BEGIN', 102);
/**
 * @var int
 */
define('XC_EXT_FCALL_END', 103);
/**
 * @var int
 */
define('XC_EXT_NOP', 104);
/**
 * @var int
 */
define('XC_TICKS', 105);
/**
 * @var int
 */
define('XC_SEND_VAR_NO_REF', 106);
/**
 * @var int
 */
define('XC_CATCH', 107);
/**
 * @var int
 */
define('XC_THROW', 108);
/**
 * @var int
 */
define('XC_FETCH_CLASS', 109);
/**
 * @var int
 */
define('XC_CLONE', 110);
/**
 * @var int
 */
define('XC_RETURN_BY_REF', 111);
/**
 * @var int
 */
define('XC_INIT_METHOD_CALL', 112);
/**
 * @var int
 */
define('XC_INIT_STATIC_METHOD_CALL', 113);
/**
 * @var int
 */
define('XC_ISSET_ISEMPTY_VAR', 114);
/**
 * @var int
 */
define('XC_ISSET_ISEMPTY_DIM_OBJ', 115);
/**
 * @var int
 */
define('XC_UNDEF', 116);
/**
 * @var int
 */
define('XC_PRE_INC_OBJ', 132);
/**
 * @var int
 */
define('XC_PRE_DEC_OBJ', 133);
/**
 * @var int
 */
define('XC_POST_INC_OBJ', 134);
/**
 * @var int
 */
define('XC_POST_DEC_OBJ', 135);
/**
 * @var int
 */
define('XC_ASSIGN_OBJ', 136);
/**
 * @var int
 */
define('XC_OP_DATA', 137);
/**
 * @var int
 */
define('XC_INSTANCEOF', 138);
/**
 * @var int
 */
define('XC_DECLARE_CLASS', 139);
/**
 * @var int
 */
define('XC_DECLARE_INHERITED_CLASS', 140);
/**
 * @var int
 */
define('XC_DECLARE_FUNCTION', 141);
/**
 * @var int
 */
define('XC_RAISE_ABSTRACT_ERROR', 142);
/**
 * @var int
 */
define('XC_DECLARE_CONST', 143);
/**
 * @var int
 */
define('XC_ADD_INTERFACE', 144);
/**
 * @var int
 */
define('XC_DECLARE_INHERITED_CLASS_DELAYED', 145);
/**
 * @var int
 */
define('XC_VERIFY_ABSTRACT_CLASS', 146);
/**
 * @var int
 */
define('XC_ASSIGN_DIM', 147);
/**
 * @var int
 */
define('XC_ISSET_ISEMPTY_PROP_OBJ', 148);
/**
 * @var int
 */
define('XC_HANDLE_EXCEPTION', 149);
/**
 * @var int
 */
define('XC_USER_OPCODE', 150);
/**
 * @var int
 */
define('XC_JMP_SET', 152);
/**
 * @var int
 */
define('XC_DECLARE_LAMBDA_FUNCTION', 153);
/**
 * @var int
 */
define('XC_ADD_TRAIT', 154);
/**
 * @var int
 */
define('XC_BIND_TRAITS', 155);
/**
 * @var int
 */
define('XC_SEPARATE', 156);
/**
 * @var int
 */
define('XC_QM_ASSIGN_VAR', 157);
/**
 * @var int
 */
define('XC_JMP_SET_VAR', 158);
/**
 * @var int
 */
define('XC_OPSPEC_STD', 0);
/**
 * @var int
 */
define('XC_OPSPEC_UNUSED', 1);
/**
 * @var int
 */
define('XC_OPSPEC_OPLINE', 2);
/**
 * @var int
 */
define('XC_OPSPEC_FCALL', 3);
/**
 * @var int
 */
define('XC_OPSPEC_INIT_FCALL', 4);
/**
 * @var int
 */
define('XC_OPSPEC_ARG', 5);
/**
 * @var int
 */
define('XC_OPSPEC_CAST', 6);
/**
 * @var int
 */
define('XC_OPSPEC_FETCH', 7);
/**
 * @var int
 */
define('XC_OPSPEC_DECLARE', 8);
/**
 * @var int
 */
define('XC_OPSPEC_SEND', 9);
/**
 * @var int
 */
define('XC_OPSPEC_SEND_NOREF', 10);
/**
 * @var int
 */
define('XC_OPSPEC_FCLASS', 11);
/**
 * @var int
 */
define('XC_OPSPEC_UCLASS', 12);
/**
 * @var int
 */
define('XC_OPSPEC_CLASS', 13);
/**
 * @var int
 */
define('XC_OPSPEC_FE', 14);
/**
 * @var int
 */
define('XC_OPSPEC_IFACE', 15);
/**
 * @var int
 */
define('XC_OPSPEC_ISSET', 16);
/**
 * @var int
 */
define('XC_OPSPEC_BIT', 17);
/**
 * @var int
 */
define('XC_OPSPEC_VAR', 18);
/**
 * @var int
 */
define('XC_OPSPEC_TMP', 19);
/**
 * @var int
 */
define('XC_OPSPEC_JMPADDR', 20);
/**
 * @var int
 */
define('XC_OPSPEC_BRK', 21);
/**
 * @var int
 */
define('XC_OPSPEC_CONT', 22);
/**
 * @var int
 */
define('XC_OPSPEC_INCLUDE', 23);
/**
 * @var int
 */
define('XC_OPSPEC_ASSIGN', 24);
/**
 * @var int
 */
define('XC_SIZEOF_TEMP_VARIABLE', 16);
/**
 * @var string
 */
define('XCACHE_VERSION', '3.0.3');
/**
 * @var string
 */
define('XCACHE_MODULES', 'cacher optimizer coverager assembler disassembler encoder decoder');
/**
 * @var int
 */
define('XC_TYPE_PHP', 0);
/**
 * @var int
 */
define('XC_TYPE_VAR', 1);

// end php_xcache PECL

?>
