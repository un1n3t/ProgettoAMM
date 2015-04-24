<?php
	class User
	{	
		//variabili di classe
		private $userID;	
		private $password;
		private $email;	
		private $nome;
		private $cognome;	
		private $ruolo;
		
		//costruttore
		public function __construct($idUtente, $password, $email, $nome, $cognome, $ruolo)
		{	
			$this -> userID = $idUtente;	
			$this -> password = $password;
			$this -> email = $email;
			$this -> nome = $nome;
			$this -> cognome = $cognome;
			$this -> ruolo = $ruolo;
		}
		
		//metodi getter
		public function	getRuolo()	
		{	
			return $this-> $ruolo;	
		}
		
		public function getID()	
		{	
			return $this-> userID;	
		}
		
		public function getPassword()	
		{	
			return $this-> password;	
		}
		
		public function getEmail()	
		{	
			return $this-> email;	
		}

		public function getNome()	
		{	
			return $this-> nome;	
		}
		
		public function getCognome()	
		{	
			return $this-> cognome;	
		}
		
		
		//metodi setter
		
		public function setPassword($password)	
		{	
			$this->password = $password;	
		}
		
		public function setEmail($email)	
		{	
			$this->email = $email;	
		}

		public function setNome($nome)	
		{	
			$this-> nome = $nome;	
		}
		
		public function setCognome($cognome)	
		{	
			$this-> cognome = $cognome;	
		}
	}
?>