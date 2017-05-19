<?php

@session_start();

class utility {

	static function pr($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}

	static function vd($a) {
		echo '<pre>';
		var_dump($a);
		echo '</pre>';
	}

	static function is_post() {
		return (
				isset($_SERVER['REQUEST_METHOD']) &&
				trim($_SERVER['REQUEST_METHOD']) != '' &&
				trim($_SERVER['REQUEST_METHOD']) == 'POST'
				) ? true : false;
	}	

}

