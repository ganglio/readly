<?php

class Crypt {
	private $cipher;
	private $key, $iv;
	
	public function __construct($key, $iv) {
		$this->key=$key;
		$this->iv=$iv;
		$this->cipher=mcrypt_module_open(MCRYPT_BLOWFISH,'','cbc','');
	}
	
	public function crypt64($message) {
	
		mcrypt_generic_init($this->cipher, $this->key, $this->iv);
		$encrypted = mcrypt_generic($this->cipher,$message);
		mcrypt_generic_deinit($this->cipher);
		
		return base64_encode($encrypted)."|".strlen($message);
	}
	
	public function decrypt64($message) {
		$bits=explode("|",$message);
		$encrypted=base64_decode($bits[0]);
		
		mcrypt_generic_init($this->cipher, $this->key, $this->iv);
		$decrypted = mdecrypt_generic($this->cipher,$encrypted);
		mcrypt_generic_deinit($this->cipher);
		
		return substr($decrypted,0,$bits[1]);
	}
}
