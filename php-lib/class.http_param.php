<?php 

class HttpParam {

	public static function asString($key) {
		if(array_key_exists($key, $_GET)) {
			return $_GET[$key];
		}
		if(array_key_exists($key, $_POST)) {
			return $_POST[$key];
		}
		return NULL;
	}

	public static function asInt($key) {
		return (int) HttpParam::asString($key);
	}

}

?>
