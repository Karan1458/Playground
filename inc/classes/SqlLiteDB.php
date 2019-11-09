<?php 
	class Db extends SQLite3 {
		function __construct() {
			$this->open('../playground.db');
		}
	}
	class SqlLiteDB  {
		
		private $db = null;

		public static $instance = null;

		function __construct() {
        	$this->db = new Db();
        	if(!$db) {
			  throw new Exception($db->lastErrorMsg());
			} 
      	}

      	public static function getInstance() {
      		if(self::$instance === null) {
      			self::$instance = new SqlLiteDB();
      		} 
      		return self::$instance;
      	}

      	public function insertSnippet($title, $content) {
      		$sql = sprintf("INSERT INTO playground (title,content) VALUES ('%s', '%s')", $title, $content);
      		return $db->exec($sql);
      	}

      	public function ifTableCreated() {

      		$ret = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='snippets';");
      		
      		if(!$ret->numRows()) {
      			$sql ="CREATE TABLE snippets(
		   			ID 				INT 		PRIMARY KEY  AUTOINCREMENT   NOT NULL,
		      		title           TEXT    	NOT NULL,
		      		content         TEXT     	NOT NULL
			    );";	
			    $db->exec($sql);
      		}
      	}

      	public function closeConnection() {
   			$this->db->close();
      	}

      	public function lastErrorMessage() {
      		return $this->db->lastErrorMsg();
      	}
	}