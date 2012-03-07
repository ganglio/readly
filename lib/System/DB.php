<?php

require_once("lib/config.php");

class DB {
	private $mongo;
	private $db;
	private $collection;
	
	public function __construct() {
		global $config;
		try {
			$this->mongo = new Mongo($config["db"]["host"]);
			$this->db = $this->mongo->selectDB($config["db"]["database"]);
			$this->collection = $this->db->selectCollection($config["db"]["collection"]);
		} catch ( Exception $e ) {
			throw new Exception("Unable to connect to DB",500);
		}
	}
	
	public function find($query=array(),$fields=array()) {
		return $this->collection->find($query,$fields);
	}
	
	public function findOne($query=array(),$fields=array()) {
		return $this->collection->findOne($query,$fields);
	}
	
	public function update($criteria, $newobj, $options=array()) {
		return $this->collection->update($criteria,$newobj,$options);
	}
}
