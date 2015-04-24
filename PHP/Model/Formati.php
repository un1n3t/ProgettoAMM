<?php
	/** Questa classe elenca, per ogni oggetto Immagine, i formati in cui essa è disponibile. I dati sono correlati tramite query al DB **/
	class Formati 
	{
		//variabili di classe
		private $formatiDisponibili; //è un array associativo che associa il formato alla quantità disponibile dello stesso, ottenuta tramite query
		
		//costruttore
		public function __construct($qtaFormatoOnline, $qtaFormatoGalleria1, $qtaFormatoGalleria2)
		{	
			//l'utilizzo corretto del costruttore fa si che tutti i formati disponibili siano rappresentati da un array associativo
			$this -> formatiDisponibili = array (
											"1920x1080" => $qtaFormatoOnline,
											"90x160" => $qtaFormatoGalleria1,
											"100x200" => $qtaFormatoGalleria2); 
		}
		
		
		//metodi getter
		public function getAllFormats()	
		{	
			return $this-> formatiDisponibili;	
		}
		
		public function getOnlineFormat()	
		{	
			return $this-> formatiDisponibili["1920x1080"];	
		}
		
		public function getGalleryFormat1()	
		{	
			return $this-> formatiDisponibili["90x160"];	
		}
		
		public function getGalleryFormat2()	
		{	
			return $this-> formatiDisponibili["100x200"];	
		}
		
		//metodi Setter
		public function setOnlineFormat($quantita)	
		{	
			$this-> formatiDisponibili["1920x1080"] = $quantita;	
		}
		
		public function setGalleryFormat1($quantita)	
		{	
			$this-> formatiDisponibili["90x160"] = $quantita;	
		}
		
		public function setGalleryFormat2($quantita)	
		{	
			$this-> formatiDisponibili["100x200"] = $quantita;	
		}
	}
?>