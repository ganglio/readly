<?php

class Twitter extends API {

	private $twitter;
	
	public function __construct() {
		$this->twitter=new Twitter_oAuth("2mhp9jm3Xmv69dMSIdjxVw","gB2BAXnQkRNr56roJkah8KjREIsIM4MvreiHQyFar4");
	}
	
	public function login() {
		$callback="http://".$_SERVER["HTTP_HOST"]."/twitter/check";
		$token=$this->twitter->oAuthRequestToken($callback);
		$this->twitter->oAuthAuthorize($token["oauth_token"]);
	}
	
	public function check() {
		global $db;
		$response = $this->twitter->oAuthAccessToken($_GET['oauth_token'], $_GET['oauth_verifier']);
		$db->users->update(array("user_id"=>"top10visitedcontents","account"=>"twitter"),$response,array("upsert"=>TRUE));
		// setcookie("user", TODO
	}
	
	public function test() {
		global $crypt;
		
		$message="pippo";
		$encrypted=$crypt->crypt64($message);
		$decrypted=$crypt->decrypt64($encrypted);
		
		print_r($encrypted);
		echo "\n";
		print_r($decrypted);
	}
}
