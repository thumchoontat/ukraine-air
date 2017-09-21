<?php 
	require_once('dbconnector.php');
	class User{
		private $displayName = null;
		private $username = null;
		private $password = null;
		private $valPassword = null;
		
		private $db = null;
		
		public function __construct($request = null){
			$this->db = DBConnector::getInstance();
			if ($request != null){
				if (array_key_exists('display-name', $request)){
					$this->displayName = trim($request['display-name']);
				}
				if (array_key_exists('username', $request)){
					$this->username = trim($request['username']);
				}
				if (array_key_exists('password', $request)){
					$this->password = trim($request['password']);
				}
				if (array_key_exists('val-password', $request)){
					$this->valPassword = trim($request['val-password']);
				}
			}// END if request is null
		}// END constructor
		
		public function isEmpty(){
			return 
				$this->displayName === null 
				&& $this->username === null 
				&& $this->password === null 
				&& $this->valPassword === null;
		}
		
		public function validDisplayName(){
			return preg_match("/^[a-zA-Z. ]{3,100}$/",$this->displayName);
		}
		
		public function validUsername(){
			return preg_match('/^[a-zA-Z0-9._]{5,50}$/',$this->username);
		}
		
		public function validPassword(){
			return preg_match('/^.{8,50}$/',$this->password);
		}
		
		public function passwordsMatch(){
			return $this->validPassword() && $this->password == $this->valPassword;
		}
		
		public function getDisplayName(){
			return $this->displayName;
		}
		
		public function getUsername(){
			return $this->username;
		}
		
		public function getHashedPassword(){
			// if ($this->passwordsMatch()){
				return password_hash($this->password, PASSWORD_BCRYPT);
			// }
		}
		
		public function valid(){
			return $this->validDisplayName() && $this->validUsername() && $this->validPassword() && $this->passwordsMatch();
		}
		
		public function registerUser(){
			try{
			if ($this->valid()){
				$conn = $this->db->getConn();
				$stmt = $conn->prepare("INSERT INTO `user` (`username`,`hashpass`, `displayName`) VALUES (?,?,?)");
				$stmt->bind_param("sss", $this->username, $this->getHashedPassword(), $this->displayName);
				return $stmt->execute();
			}
			return false;
			}
			catch (Exception $ex){
				var_dump($ex);
				return false;
			}
		}
		
		public function login(&$message = null){
			$conn = $this->db->getConn();
			if (!$conn->ping() && $message !== null){
				$message->set('Service unavailable. Please try again later','danger');
				$this->db->reconnect();
			}
			$stmt = $conn->prepare('SELECT `hashpass` FROM `user` WHERE `username` = ?');
			$stmt->bind_param("s", $this->username);
			$stmt->execute();
			$result = $stmt->get_result();
			if(password_verify($this->password, $result->fetch_assoc()['hashpass'])){
				$sessionStmt = $conn->prepare('UPDATE `user` SET `sessionID` = ? WHERE `username` = ?');
				$sessID = session_id();
				$sessionStmt->bind_param("ss", $sessID, $this->username);
				if ($sessionStmt->execute()){
					$conn->commit();
					if ($message !== null){
						$message->set('Valid account','success');
					}
					$_SESSION['username'] = $this->username;
				}
				return true;
			}
			unset($_SESSION['username']);
			if ($message !== null){
				$message->set('Invalid username / password','danger');
			}
			return false;
		}
		
		public function clear(){
			$this->displayName = null;
			$this->username = null;
			$this->password = null;
			$this->valPassword = null;
		}
	}
?>
