<?php

/* 
 * get-key.php - function to get an API key
 */

require_once('utils.php');

function get_api_key() {
	$key = bin2hex(openssl_random_pseudo_bytes(4));
	$max_file_size = 10240;
	
	// if file > $max_file_size, wipe the file and start a new one
	$flags = filesize(API_FILENAME) > $max_file_size ? 0 : FILE_APPEND;
	
	file_put_contents(
		API_FILENAME,
		$key . ";" . time() . "\n",
		$flags
	);
	
	return $key;
}
