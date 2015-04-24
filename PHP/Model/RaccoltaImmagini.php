<?php
	
	/** L'oggetto contiene tutti i dettagli relativi ad un eventuale pagamento tramite bonifico, includendo l'iban del beneficiario e quello del pagante (l'utente);
		I dati del beneficiario (il sito) sono preimpostati all'interno del DB e visibili solo in caso di pagamento **/
	
	class RaccoltaImmagini
	{	
		private $IMG_Container; //memorizza un array di oggetti Immagine
		private $nomeRaccolta; //ogni raccolta ha un nome che raggrupa l'insieme d'immagini inserite
		
		
		//costruttore
		public function __construct($IMG_Array, $nome)
		{	
			$this -> IMG_Container = array();
			$this -> IMG_Container = $IMG_Array;
			
			$this -> nomeRaccolta = $nome;
		}
		
		//metodi Getter
		
		//fornisce un array con tutte le immagini della raccolta
		public function getAllImages()	
		{	
			return $this-> IMG_Container;	
		}
		
		//fornisce la singola immagine, identificata dall'id relativo
		public function getImagesByID($IDimmagine)	
		{
			$arrayIMG = array();
			$arrayIMG = $this-> IMG_Container;
			
			for ($i=0; $i <= count($arrayIMG)-1; $i++)
			{
				if($arrayIMG[$i]->getID() == $IDimmagine)
				{
					return $arrayIMG[$i];
				}
			}
			return "#cod".$IDimmagine;
				
		}
		
		//metodi Setter
		
		//aggiunge un secondo array d'immagini alla raccolta
		public function	addNewCollection($imagesArray)	
		{	
			if(is_array($imagesArray))
			{
				array_merge($this -> IMG_Container, $imagesArray);
			}
		}
		
		//aggiunge un oggetto Immagine singolo
		public function	addNewImage($image)	
		{	
			$this-> IMG_Container[] = $image;
		}

	}
?>