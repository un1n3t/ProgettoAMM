<?php
	class immagine 
	{
		//variabili di classe
		
		private $IDimmagine;
		private $autore;
		private $titolo;
		private $descrizione;
		
		private $visibile; //booleano che regola la visibilità dell'immagine nella sezione espositiva
		
		private $preview250; //anteprima formato ridotto
		private $preview850; //anteprima formato esteso
		
		private $formatiImmagine; //array di formati
		
		private $ultimaModifica;
		
		private $prezzo;
		
		//costruttore
		public function __construct($immagine, $autore, $titolo, $descrizione, $visibile, $preview250, $preview850, $formatiImmagine, $ultimaModifica, $prezzo)
		{	
			$this ->  IDimmagine = $immagine;
			$this ->  autore = $autore;
			$this ->  titolo = $titolo;
			$this ->  descrizione = $descrizione;
			$this ->  visibile = $visibile;
			$this ->  preview250 = $preview250;
			$this ->  preview850 = $preview850;
			
			$this -> formatiImmagine = array();
			$this -> formatiImmagine = $formatiImmagine;
			
			
			$this ->  ultimaModifica = $ultimaModifica;
			
			$this -> prezzo = $prezzo;
			
		}
		
		
		//metodi getter
		
		public function getID()	
		{	
			return $this->IDimmagine;	
		}
		
		public function getAutore()	
		{	
			return $this->autore;	
		}
		
		public function getTitolo()	
		{	
			return $this->titolo;	
		}
		
		public function getDescrizione()	
		{	
			return $this->descrizione;	
		}
		
		public function getVisibility()	
		{	
			return $this->visibile;	
		}
		
		public function getPreview250()	
		{	
			return $this-> preview250;	
		}
		
		public function getPreview850()	
		{	
			return $this-> preview850;	
		}
		
		public function getFormati()	
		{	
			return $this->formatiImmagine; //ritorna tutto l'array	
		}
		
		public function getUltimaModifica()	
		{	
			return $this-> ultimaModifica;	
		}
		
		public function getPrice()	
		{	
			return $this-> prezzo;	
		}
		
		
		//metodi setter
		//L'uso di questi metodi è previsto solamente da parte del WebAdmin
		public function setID($IDimmagine)	
		{	
			$this->IDimmagine = $IDimmagine;	
		}
		
		public function setAutore($autore)	
		{	
			$this->autore = $autore;	
		}
		
		public function setTitolo($titolo)	
		{	
			$this->titolo = $titolo;	
		}
		
		public function setDescrizione($descrizione)	
		{	
			$this->descrizione = $descrizione;	
		}
		
		public function setVisibilità($visibile)	
		{	
			$this->visibile = $visibile;	
		}
		
		public function setPreview250($link)	
		{	
			$this-> preview250 = $link;	
		}
		
		public function setPreview850($link)	
		{	
			$this-> preview850 = $link;	
		}
		
		public function setFormats($formatiImmagine)	
		{	
			$this -> formatiImmagine = $formatiImmagine;	//l'array viene sovrascritto perchè in ogni caso sono massimo 3 formati diversi per ogni fotografia
		}
		
		public function setUltimaModifica($ultimaModifica)	
		{	
			$this-> ultimaModifica = $ultimaModifica;	
		}
		
		public function setPrice($nuovoPrezzo)
		{
			$this-> prezzo = $nuovoPrezzo;	
		}
	}
?>