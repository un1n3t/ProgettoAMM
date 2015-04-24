<?php
	class DB
	{	
		private $ServerAddress;
		private $userID;
		private $pswd;
		private $DBname;
		
		public function __construct()
		{
			$this -> ServerAddress = "localhost";
			$this -> userID = "ikstudios";
			$this -> pswd = "";
			$this -> DBname = "my_ikstudios";
		}
		
		//metodi getter
		
		public function getAddress()	
		{	
			return $this->ServerAddress;	
		}
		
		public function getUserId()	
		{	
			return $this->userID;	
		}
		
		public function getPass()	
		{	
			return $this->pswd;	
		}
		
		public function getDBName()	
		{	
			return $this->DBname;	
		}
	}
?>