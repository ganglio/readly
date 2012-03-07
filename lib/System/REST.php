<?php

class REST {
	
	public function __construct($q) {
		$q=explode("/",$q);
		$pars=array(
			"args"=>$q,
			"get"=>$_GET,
			"post"=>$_POST,
		);
		unset($pars["q"]);
		
		try {
			$out=self::invoke($q[0],$q[1],$pars);
			IO::out($out);
		} catch (Exception $e) {
			header("HTTP/1.1 ".$e->getCode()." ".$e->getMessage());
			IO::out(array("status"=>-1,"result"=>array("error"=>$e->getCode(),"message"=>$e->getMessage())));
		}
	}
	
	private static function invoke($name=NULL,$method=NULL,$params=NULL) {
		if ($name) {
			if ($method) {
				$API=new $name ();
				return $API->$method ($params);
			} else
				throw new Exception("Invalid Method",400);
		} else
			throw new Exception("Invalid API",400);
	}
}
