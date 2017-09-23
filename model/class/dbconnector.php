<?php 
	class DBConnector{
		private static $instance = null;
		/* SEA database
		private $serverName = 'ap-cdbr-azure-southeast-b.cloudapp.net:3306';
		private $username = 'b09993b1df234b';
		private $password = '338cffee';
		private $dbName = 'uia';
		*/
		
		private $serverName = 'eu-cdbr-azure-west-b.cloudapp.net:3306';
		private $username = 'bd2a2c14ef1eb4';
		private $password = 'd225c350';
		private $dbName = 'acsm_5271a3959550625';
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