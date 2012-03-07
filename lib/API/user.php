<?php

class User extends API {
	
	public function __construct() {
		session_start();
	}
	
	public function isIn() {
		return isset($_SESSION["user"]);
	}
}
