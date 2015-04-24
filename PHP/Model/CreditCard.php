<?php
	
	/** Rappresenta un oggetto carta di credito utilizzato/utilizzabile dall'utente per poter gestire i pagamenti
		Per semplicità d'implementazione, i nomi delle relative variaibili d'istanza fanno riferimento ai nomi con cui l'entità esiste all'interno del DB     **/
	
	class CreditCard
	{	
		private $numeroCarta;
		private $CVV2;
		private $dataScadenza;
		private $nomeIntestatario;
		private $cognomeIntestatario ;

		
		//costruttore
		public function __construct($numero, $CVV2, $scadenza, $nome, $cognome)
		{	
			$this -> numeroCarta = $numero;	
			$this -> CVV2 = $CVV2;
			$this -> dataScadenza = $scadenza;
			$this -> nomeIntestatario = $nome;
			$this -> cognomeIntestatario = $cognome;
	
		}
		
		//metodi getter
		public function	getNumero()	
		{	
			return $this-> numeroCarta;	
		}
		
		public function getCVV()	
		{	
			return $this-> CVV2;	
		}
		
		public function getScadenzaCC()	
		{	
			return $this-> dataScadenza;	
		}
		
		public function getNomeI()	
		{	
			return $this-> nomeIntestatario;	
		}

		public function getCognomeI()	
		{	
			return $this-> cognomeIntestatario;	
		}

	}
?>