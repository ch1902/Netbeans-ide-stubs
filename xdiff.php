<?php

// php_xdiff PECL

/**
 * This flag indicated that xdiff_string_patch() and xdiff_file_patch() functions should create result
 * by reversing patch changed from newer content thus creating original version.
 * @var int
 */
define('XDIFF_PATCH_REVERSE', 0);

/**
 * This flag indicates that xdiff_string_patch() and xdiff_file_patch() functions should create result
 * by applying patch to original content thus creating newer version of file. This is the default mode
 * of operation.
 * @var int
 */
define('XDIFF_PATCH_NORMAL', 0);

/**
 * Returns a size of a result file that would be created after applying binary patch from file file to
 * the original file.
 * @link http://php.net/manual/en/function.xdiff-file-bdiff-size.php
 * @param string $file <p>
 * The path to the binary patch created by xdiff_string_bdiff() or xdiff_string_rabdiff() function.
 * </p>
 * @return int Returns the size of file that would be created.
 */
function xdiff_file_bdiff_size ($file) { }

/**
 * Makes a binary diff of two files and stores the result in a patch file. This function works with
 * both text and binary files. Resulting patch file can be later applied using
 * xdiff_file_bpatch()/xdiff_string_bpatch().
 * @link http://php.net/manual/en/function.xdiff-file-bdiff.php
 * @param string $old_file <p>
 * Path to the first file. This file acts as "old" file.
 * </p>
 * @param string $new_file <p>
 * Path to the second file. This file acts as "new" file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting patch file. Resulting file contains differences between "old" and "new" files.
 * It is in binary format and is human-unreadable.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_bdiff ($old_file, $new_file, $dest) { }

/**
 * Patches a file with a binary patch and stores the result in a file dest. This function accepts
 * patches created both via xdiff_file_bdiff() and xdiff_file_rabdiff() functions or their string
 * counterparts.
 * @link http://php.net/manual/en/function.xdiff-file-bpatch.php
 * @param string $file <p>
 * The original file.
 * </p>
 * @param string $patch <p>
 * The binary patch file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting file.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_bpatch ($file, $patch, $dest) { }

/**
 * <p>Makes a binary diff of two files and stores the result in a patch file. This function works with
 * both text and binary files. Resulting patch file can be later applied using xdiff_file_bpatch().</p>
 * <p>Starting with version 1.5.0 this function is an alias of xdiff_file_bdiff().</p>
 * @link http://php.net/manual/en/function.xdiff-file-diff-binary.php
 * @param string $old_file <p>
 * Path to the first file. This file acts as "old" file.
 * </p>
 * @param string $new_file <p>
 * Path to the second file. This file acts as "new" file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting patch file. Resulting file contains differences between "old" and "new" files.
 * It is in binary format and is human-unreadable.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_diff_binary ($old_file, $new_file, $dest) { }

/**
 * Makes an unified diff containing differences between old_file and new_file and stores it in dest
 * file. The resulting file is human-readable. An optional context parameter specifies how many lines
 * of context should be added around each change. Setting minimal parameter to true will result in
 * outputting the shortest patch file possible (can take a long time).
 * @link http://php.net/manual/en/function.xdiff-file-diff.php
 * @param string $old_file <p>
 * Path to the first file. This file acts as "old" file.
 * </p>
 * @param string $new_file <p>
 * Path to the second file. This file acts as "new" file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting patch file.
 * </p>
 * @param int $context <p>
 * Indicates how many lines of context you want to include in diff result.
 * </p>
 * @param bool $minimal <p>
 * Set this parameter to TRUE if you want to minimalize size of the result (can take a long time).
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_diff ($old_file, $new_file, $dest, $context = 3, $minimal = false) { }

/**
 * Merges three files into one and stores the result in a file dest. The old_file is an original
 * version while new_file1 and new_file2 are modified versions of an original.
 * @link http://php.net/manual/en/function.xdiff-file-merge3.php
 * @param string $old_file <p>
 * Path to the first file. It acts as "old" file.
 * </p>
 * @param string $new_file1 <p>
 * Path to the second file. It acts as modified version of old_file.
 * </p>
 * @param string $new_file2 <p>
 * Path to the third file. It acts as modified version of old_file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting file, containing merged changed from both new_file1 and new_file2.
 * </p>
 * @return mixed Returns TRUE if merge was successful, string with rejected chunks if it was not or FALSE if an
 * internal error happened.
 */
function xdiff_file_merge3 ($old_file, $new_file1, $new_file2, $dest) { }

/**
 * <p>Patches a file with a binary patch and stores the result in a file dest. This function accepts
 * patches created both via xdiff_file_bdiff() or xdiff_file_rabdiff() functions or their string
 * counterparts.</p>
 * <p>Starting with version 1.5.0 this function is an alias of xdiff_file_bpatch().</p>
 * @link http://php.net/manual/en/function.xdiff-file-patch-binary.php
 * @param string $file <p>
 * The original file.
 * </p>
 * @param string $patch <p>
 * The binary patch file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting file.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_patch_binary ($file, $patch, $dest) { }

/**
 * Patches a file with a patch and stores the result in a file. patch has to be an unified diff created
 * by xdiff_file_diff()/xdiff_string_diff() function. An optional flags parameter specifies mode of
 * operation.
 * @link http://php.net/manual/en/function.xdiff-file-patch.php
 * @param string $file <p>
 * The original file.
 * </p>
 * @param string $patch <p>
 * The unified patch file. It has to be created using xdiff_string_diff(), xdiff_file_diff() functions
 * or compatible tools.
 * </p>
 * @param string $dest <p>
 * Path of the resulting file.
 * </p>
 * @param int $flags <p>
 * Can be either XDIFF_PATCH_NORMAL (default mode, normal patch) or XDIFF_PATCH_REVERSE (reversed
 * patch). Starting from version 1.5.0, you can also use binary OR to enable XDIFF_PATCH_IGNORESPACE
 * flag.
 * </p>
 * @return mixed Returns FALSE if an internal error happened, string with rejected chunks if patch couldn't be
 * applied or TRUE if patch has been successfully applied.
 */
function xdiff_file_patch ($file, $patch, $dest, $flags = DIFF_PATCH_NORMAL) { }

/**
 * <p>Makes a binary diff of two files and stores the result in a patch file. The difference between this
 * function and xdiff_file_bdiff() is different algorithm used which should result in faster execution
 * and smaller diff produced. This function works with both text and binary files. Resulting patch file
 * can be later applied using xdiff_file_bpatch()/xdiff_string_bpatch().</p>
 * <p>For more details about differences between algorithm used please check » libxdiff website.</p>
 * @link http://php.net/manual/en/function.xdiff-file-rabdiff.php
 * @param string $old_file <p>
 * Path to the first file. This file acts as "old" file.
 * </p>
 * @param string $new_file <p>
 * Path to the second file. This file acts as "new" file.
 * </p>
 * @param string $dest <p>
 * Path of the resulting patch file. Resulting file contains differences between "old" and "new" files.
 * It is in binary format and is human-unreadable.
 * </p>
 * @return bool Returns TRUE on success or FALSE on failure.
 */
function xdiff_file_rabdiff ($old_file, $new_file, $dest) { }

/**
 * Returns a size of a result file that would be created after applying binary patch to the original
 * file.
 * @link http://php.net/manual/en/function.xdiff-string-bdiff-size.php
 * @param string $patch <p>
 * The binary patch created by xdiff_string_bdiff() or xdiff_string_rabdiff() function.
 * </p>
 * @return int Returns the size of file that would be created.
 */
function xdiff_string_bdiff_size ($patch) { }

/**
 * Makes a binary diff of two strings and returns the result. This function works with both text and
 * binary data. Resulting patch can be later applied using xdiff_string_bpatch()/xdiff_file_bpatch().
 * @link http://php.net/manual/en/function.xdiff-string-bdiff.php
 * @param string $old_data <p>
 * First string with binary data. It acts as "old" data.
 * </p>
 * @param string $new_data <p>
 * Second string with binary data. It acts as "new" data.
 * </p>
 * @return string Returns string with binary diff containing differences between "old" and "new" data or FALSE if an
 * internal error occurred.
 */
function xdiff_string_bdiff ($old_data, $new_data) { }

/**
 * Patches a string str with a binary patch. This function accepts patches created both via
 * xdiff_string_bdiff() and xdiff_string_rabdiff() functions or their file counterparts.
 * @link http://php.net/manual/en/function.xdiff-string-bpatch.php
 * @param string $str <p>
 * The original binary string.
 * </p>
 * @param string $patch <p>
 * The binary patch string.
 * </p>
 * @return string Returns the patched string, or FALSE on error.
 */
function xdiff_string_bpatch ($str, $patch) { }

/**
 * <p>Makes a binary diff of two strings and returns the result. This function works with both text and
 * binary data. Resulting patch can be later applied using xdiff_string_bpatch()/xdiff_file_bpatch().</p>
 * <p>Starting with version 1.5.0 this function is an alias of xdiff_string_bdiff().</p>
 * @link http://php.net/manual/en/function.xdiff-string-diff-binary.php
 * @param string $old_data <p>
 * First string with binary data. It acts as "old" data.
 * </p>
 * @param string $new_data <p>
 * Second string with binary data. It acts as "new" data.
 * </p>
 * @return string Returns string with result or FALSE if an internal error happened.
 */
function xdiff_string_diff_binary ($old_data, $new_data) { }

/**
 * Makes an unified diff containing differences between old_data string and new_data string and returns
 * it. The resulting diff is human-readable. An optional context parameter specifies how many lines of
 * context should be added around each change. Setting minimal parameter to true will result in
 * outputting the shortest patch file possible (can take a long time).
 * @link http://php.net/manual/en/function.xdiff-string-diff.php
 * @param string $old_data <p>
 * First string with data. It acts as "old" data.
 * </p>
 * @param string $new_data <p>
 * Second string with data. It acts as "new" data.
 * </p>
 * @param int $context <p>
 * Indicates how many lines of context you want to include in the diff result.
 * </p>
 * @param bool $minimal <p>
 * Set this parameter to TRUE if you want to minimalize the size of the result (can take a long time).
 * </p>
 * @return string Returns string with resulting diff or FALSE if an internal error happened.
 */
function xdiff_string_diff ($old_data, $new_data, $context = 3, $minimal = false) { }

/**
 * Merges three strings into one and returns the result. The old_data is an original version of data
 * while new_data1 and new_data2 are modified versions of an original. An optional error is used to
 * pass any rejected parts during merging process.
 * @link http://php.net/manual/en/function.xdiff-string-merge3.php
 * @param string $old_data <p>
 * First string with data. It acts as "old" data.
 * </p>
 * @param string $new_data1 <p>
 * Second string with data. It acts as modified version of old_data.
 * </p>
 * @param string $new_data2 <p>
 * Third string with data. It acts as modified version of old_data.
 * </p>
 * @param string &$error <p>
 * If provided then rejected parts are stored inside this variable.
 * </p>
 * @return mixed Returns the merged string, FALSE if an internal error happened, or TRUE if merged string is empty.
 */
function xdiff_string_merge3 ($old_data, $new_data1, $new_data2, &$error) { }

/**
 * <p>Patches a string str with a binary patch. This function accepts patches created both via
 * xdiff_string_bdiff() and xdiff_string_rabdiff() functions or their file counterparts.</p>
 * <p>Starting with version 1.5.0 this function is an alias of xdiff_string_bpatch().</p>
 * @link http://php.net/manual/en/function.xdiff-string-patch-binary.php
 * @param string $str <p>
 * The original binary string.
 * </p>
 * @param string $patch <p>
 * The binary patch string.
 * </p>
 * @return string Returns the patched string, or FALSE on error.
 */
function xdiff_string_patch_binary ($str, $patch) { }

/**
 * Patches a str string with an unified patch in patch parameter and returns the result. patch has to
 * be an unified diff created by xdiff_file_diff()/xdiff_string_diff() function. An optional flags
 * parameter specifies mode of operation. Any rejected parts of the patch will be stored inside error
 * variable if it is provided.
 * @link http://php.net/manual/en/function.xdiff-string-patch.php
 * @param string $str <p>
 * The original string.
 * </p>
 * @param string $patch <p>
 * The unified patch string. It has to be created using xdiff_string_diff(), xdiff_file_diff()
 * functions or compatible tools.
 * </p>
 * @param int $flags <p>
 * flags can be either XDIFF_PATCH_NORMAL (default mode, normal patch) or XDIFF_PATCH_REVERSE (reversed
 * patch). Starting from version 1.5.0, you can also use binary OR to enable XDIFF_PATCH_IGNORESPACE
 * flag.
 * </p>
 * @param string &$error <p>
 * If provided then rejected parts are stored inside this variable.
 * </p>
 * @return string Returns the patched string, or FALSE on error.
 */
function xdiff_string_patch ($str, $patch, $flags, &$error) { }

/**
 * <p>Makes a binary diff of two strings and returns the result. The difference between this function and
 * xdiff_string_bdiff() is different algorithm used which should result in faster execution and smaller
 * diff produced. This function works with both text and binary data. Resulting patch can be later
 * applied using xdiff_string_bpatch()/xdiff_file_bpatch().</p>
 * <p>For more details about differences between algorithm used please check » libxdiff website.</p>
 * @link http://php.net/manual/en/function.xdiff-string-rabdiff.php
 * @param string $old_data <p>
 * First string with binary data. It acts as "old" data.
 * </p>
 * @param string $new_data <p>
 * Second string with binary data. It acts as "new" data.
 * </p>
 * @return string Returns string with binary diff containing differences between "old" and "new" data or FALSE if an
 * internal error occurred.
 */
function xdiff_string_rabdiff ($old_data, $new_data) { }

// end php_xdiff PECL

?>