<?php

/* 
 * check-key.php - function to check an API key
 */

require_once('utils.php');

function check_api_key($key) {
	$key_valid = false;
	$file = file_get_contents(API_FILENAME);
	$lines = explode("\n", $file);
	$newfile = "";
	
	// only validate api keys that are less than 30 minutes old
	// and delete anything out of the file that's older than that
	foreach ($lines as $line) {
		$arr = explode(";", $line);
		$this_key = $arr[0];
		$stamp = $arr[1];
		if ((time() - $stamp) < 1800) {
			if ($this_key == $key) {
				$key_valid = true;
			}
			$newfile .= $line . "\n";
		}
	}
	file_put_contents(API_FILENAME, $newfile);
	return $key_valid;
}