<?php

namespace App\Library;

class Encryption {
	
	private $key = "";
	private $iv_size = null;

	function __construct() {
	    $this->key = "IBMApplica10n";
	    $this->iv_size = null;//mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	}

	public function encrypt($value) {
	    $iv = null;//mcrypt_create_iv($this->iv_size, MCRYPT_DEV_URANDOM);
	    $crypt = base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $value, MCRYPT_MODE_CBC, $iv));
	    return $crypt;
	}

	public function decrypt($value) {
	    $crypt = base64_decode($value);
	    $iv = substr($crypt, 0, $this->iv_size);
	    $crypt = substr($crypt, $this->iv_size, strlen($crypt));
	    return str_replace('\x00', '', mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $crypt, MCRYPT_MODE_CBC, $iv));
	}

	public function uid() {
		return md5(uniqid(rand(), true));
	}

}

?>