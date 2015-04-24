<?php
	
	/** L'oggetto contiene tutti i dettagli relativi ad un eventuale pagamento tramite bonifico, includendo l'iban del beneficiario e quello del pagante (l'utente);
		I dati del beneficiario (il sito) sono preimpostati all'interno del DB e visibili solo in caso di pagamento **/
	
	class Bonifico
	{	
		private $IBAN_Ordinante;
		private $nomeOrdinante; 
		private $cognomeOrdinante; 
		private $IBAN_Beneficiario; 
		private $nomeBeneficiario; 
		private $causale;

		
		//costruttore
		public function __construct($IBAN_Ordinante, $nomeOrdinante, $cognomeOrdinante, $IBAN_Beneficiario, $nomeBeneficiario, $causale)
		{	
			$this -> IBAN_Ordinante = $IBAN_Ordinante;	
			$this -> nomeOrdinante = $nomeOrdinante;
			$this -> cognomeOrdinante = $cognomeOrdinante;
			$this -> IBAN_Beneficiario = $IBAN_Beneficiario;
			$this -> nomeBeneficiario = $nomeBeneficiario;
			$this -> causale = $causale;
		}
		
		//metodi getter
		public function	getIBANutente()	
		{	
			return $this-> IBAN_Ordinante;	
		}
		
		public function getNomeI()	
		{	
			return $this-> nomeOrdinante;	
		}
		
		public function getCognomeI()	
		{	
			return $this-> cognomeOrdinante;	
		}
		
		public function getIBANBeneficiario()	
		{	
			return $this-> IBAN_Beneficiario;	
		}

		public function getNomeBeneficiario()	
		{	
			return $this-> nomeBeneficiario;	
		}
		
		public function getCausale()	
		{	
			return $this-> causale;	
		}
		
		//metodi Setter
		public function	setIBANutente($codiceIBAN)	
		{	
			$this-> IBAN_Ordinante = $codiceIBAN;
		}
		
		public function setNomeI($nomeIntestatario)	
		{	
			$this-> nomeOrdinante = $nomeIntestatario;	
		}
		
		public function setCognomeI($cognomeIntestatario)	
		{	
			$this-> cognomeOrdinante = $cognomeIntestatario;
		}

	}
?>