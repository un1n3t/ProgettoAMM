<?php
	
	/** L'oggetto rappresenta la tabella referenziante Ordini presente all'interno del database e svolge una funzione analoga:
		tramite i dettagli conservati permette di ottenere informazioni sommarie sul pagamento sui metodi e sugli oggetti istanziati al relativo utente **/
	
	class Ordine
	{	
		private $IDordine;
		private $IDarticolo; 
		private $IDutente; 
		private $creditCard; //memorizza solo il numero (primary key) della carta di credito
		private $IBAN; //memorizza il codice iban
		private $dataPagamento; 
		private $importo; 
		private $status;
		
		//3 booleani per memorizzare i formati desiderati dall'utente
		private $fOnline;  
		private $fGalleria1; 
		private $fGalleria2;

		
		//costruttore
		public function __construct($IDordine, $IDarticolo, $IDutente, $creditCard, $IBAN, $dataPagamento, $importo, $status, $notStillReserved)
		{	
			$this -> IDordine = $IDordine;	
			$this -> IDarticolo = $IDarticolo;
			$this -> IDutente = $IDutente;
			$this -> creditCard = $creditCard;
			$this -> IBAN = $IBAN;
			$this -> dataPagamento = $dataPagamento;
			$this -> importo = floatval($importo);
			$this -> status = $status;
			
			$this -> fOnline = $notStillReserved;
			$this -> fGalleria1 = $notStillReserved;
			$this -> fGalleria2 = $notStillReserved;
		}
		
		//metodi getter
		public function	getOrderID()	
		{	
			return $this-> IDordine;	
		}
		
		public function getArticleID()	
		{	
			return $this-> IDarticolo;	
		}
		
		public function getUserID()	
		{	
			return $this-> IDutente;	
		}
		
		public function getCreditCard()	
		{	
			return $this-> creditCard;	
		}

		public function getIBAN()	
		{	
			return $this-> IBAN;	
		}
		
		public function getDataPagamento()	
		{	
			return $this-> dataPagamento;	
		}
		
		public function getTotalImport()	
		{	
			return $this-> importo;	
		}
		
		public function getStatus()	
		{	
			return $this-> status;	
		}
		
		public function getAllReservedFormats()	
		{	
			$reservedFormats = array();
			
			if($this-> fOnline)
			{
				$reservedFormats["online"]	= $this-> fOnline;	
			}
			
			if($this-> fGalleria1)
			{
				$reservedFormats["gallery1"]	= $this-> fGalleria1;	
			}
			
			if($this-> fGalleria2)
			{
				$reservedFormats["gallery2"]	= $this-> fGalleria2;	
			}
		
			
			return $reservedFormats; 	
		}
		
		public function getOnlineFormat()	
		{	
			return $this-> fOnline; 	
		}
		
		public function getGallery1Format()	
		{	
			return $this-> fGalleria1; 	
		}
		
		public function getGallery2Format()	
		{	
			return $this-> fGalleria2; 	
		}
		
		
		//metodi Setter
		
		public function	setOrderID($ID)	
		{	
			$this-> IDordine = $ID;	
		}
		
		public function	setArticleID($ID)	
		{	
			$this-> IDarticolo = $ID;	
		}
		
			public function setUserID($ID)	
		{	
			$this-> IDutente = $ID;	
		}
		
		public function	setCreditCard($newCC)
		{	
			$this-> creditCard = $newCC;
		}
		
		public function	setIBAN($newIBAN)
		{	
			$this-> IBAN = $newIBAN;
		}
				
		public function setDataPagamento($date)	
		{	
			$this-> dataPagamento = $date;	
		}
		
		public function setTotalImport($importo)	
		{	
			$this-> importo = $importo;	
		}
		
		public function setStatus($descrizione)	
		{	
			$this-> status = $descrizione;	
		}
		
		//prenotato sarà settato a true se il formato è stato richiesto per la relativa immagine
		public function setOnlineFormat($prenotato)	
		{	
			if($prenotato)
			{
				$this-> fOnline = True;
			}
				
		}
		
		public function setGallery1Format($prenotato)	
		{	
			$this-> fGalleria1 = $prenotato; 	
		}
		
		public function setGallery2Format($prenotato)	
		{	
			$this-> fGalleria2 = $prenotato; 	
		}


	}
?>