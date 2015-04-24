<?php
	include_once("PHP/Model/User.php"); 
	
	class AuthenticatedUser extends User
	{
		private $dataNascita;
		private	$città;
		private $CAP;
		private $indirizzo;
		private $cellulare;
		private $cartaDiCredito; //memorizza un oggetto di tipo carta di credito
		private $bonifico; //memorizza un oggetto per la transazione con bonifico
		private $ordini; //memorizza un array di oggetti di tipo Ordine;
		
		
		public function __construct($idUtente, $password, $email, $nome, $cognome, $dataNascita, $città, $CAP, $indirizzo, $cellulare, $creditCard, $bonifico, $ordini, $ruolo)
		{
			parent:: __construct($idUtente, $password, $email, $nome, $cognome, $ruolo);	
			$this -> dataNascita = $dataNascita;
			$this -> città = $città;
			$this -> CAP = $CAP;
			$this -> indirizzo = $indirizzo;
			$this -> cellulare = $cellulare;
			$this -> cartaDiCredito = $creditCard;
			$this -> bonifico = $bonifico;
			
			$this -> ordini = array();
			$this -> ordini[] = $ordini;
		}
		
		// -- metodi getter --
		
		public function getDataNascita()	
		{	
			return $this-> dataNascita;	
		}
		
		public function getCittà()	
		{	
			return $this-> città;	
		}

		public function getCAP()	
		{	
			return $this-> CAP;	
		}
		
		public function getIndirizzo()	
		{	
			return $this-> indirizzo;	
		}
		
		public function getCellulare()	
		{	
			return $this-> cellulare;
		}

		public function getCarta()	
		{	
			return $this-> cartaDiCredito;
		}
		
		public function getIBAN()	
		{	
			return $this-> bonifico;
		}
		
		public function getOrders()
		{
			return $this -> ordini;
		}

		// -- metodi Setter --
		
		public function setNascita($dataNascita)	
		{	
			$this-> dataNascita = $dataNascita;	
		}

		public function setCittà($città)	
		{	
			$this-> città = $città;	
		}
		
		public function setCAP($CAP)	
		{	
			$this-> CAP = $CAP;	
		}
		
		public function setIndirizzo($indirizzo)
		{
			$this -> indirizzo = $indirizzo;
		}
		
		public function setCellulare($cellulare)
		{
			$this -> cellulare = $cellulare;
		}
				
		public function setCarta($carta)	
		{	
			$this-> cartaDiCredito = $carta;	
		}
		
		public function setIBAN($ibanOBJ)	
		{	
			$this-> bonifico = $ibanOBJ;	
		}
		
		public function setNewOrder($newOrder)
		{
			$this -> ordini[] = $newOrder;
		}
	}
?>