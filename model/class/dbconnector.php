<?php 
	class DBConnector{
		private static $instance = null;
		private $serverName = 'ap-cdbr-azure-southeast-b.cloudapp.net:3306';
		private $username = 'b09993b1df234b';
		private $password = '338cffee';
		private $dbName = 'uia';
		private $conn = null;
		
		private function __construct(){
			$this->reconnect();
		}
		
		public function reconnect(){
			$this->conn = new mysqli($this->serverName, $this->username, $this->password, $this->dbName);
		}
		
		public static function getInstance(){
			if (self::$instance == null){
				self::$instance = new DBConnector();
			}
			return self::$instance;
		}
		
		public function getConn(){
			return $this->conn;
		}
		
		public function getStatement($queryStr = ''){
			return $this->conn->prepare($queryStr);
		}
	}
?>