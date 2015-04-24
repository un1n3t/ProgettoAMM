<?php
	include_once("PHP/Model/DB.php");
	include_once("PHP/Model/RaccoltaImmagini.php");
	include_once("PHP/Model/Immagine.php");
	include_once("PHP/Model/Formati.php");
	
	class PicturesCollectionConstructor
	{
		public static $counter = 0;
		
		public static function buildNewCollection($nomeRaccolta)
		{
			self::$counter++;
			//-si connette al database
			//--controlla che non ci siano errori
			//---se ci sono errori ritorna il messaggio d'errore relativo all'errore
			//---se non ci sono errori ritorna un oggetto di tipo RaccoltaImmagini, che contiene a sua volta un array di immagini
			
			$DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
			$mysqli = new mysqli();
		
			$mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database
			
			// --- Controllo errori nella connessione col DB --- //
                        if($mysqli->connect_errno != 0) 
                        {
                            // gestione errore
                            $idErrore = $mysqli->connect_errno;
                            $message = $mysqli->connect_error;
                            error_log("Errore nella connessione al server $idErrore: $message", 0);
                            return "Funzione [PicturesCollectionConstructor::buildNewCollection] - $message - [#001]";
                        }
			else //Controllo errori connessione superato
			{
				//esegue la query col DB e ne memorizza il risultato
				$query = "SELECT * FROM immagine;";
				$result = $mysqli->query($query);
				
				// --- Controllo errori nell'esecuzione della query --- //
                                if($mysqli->errno > 0) 
                                {
                                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                    $message = $mysqli->error;
                                    $mysqli->rollback();
                                    return "Funzione [PicturesCollectionConstructor::buildNewCollection] - $message - [#002]";
                                }
				else //Query eseguita correttamente
				{
					$arrayOfPictures = array();
					while($pic = $result->fetch_object())
					{	
						$formatiDisponibili = new Formati($pic -> fOnline, $pic -> fGalleria1, $pic -> fGalleria2);
						
						$immagine = new Immagine ($pic -> IDimg, $pic -> autore, $pic -> titolo, $pic -> descrizione, $pic -> visibile, $pic -> preview250, $pic -> preview850, $formatiDisponibili, $pic -> ultimaModifica, $pic -> prezzo); 
						
						$arrayOfPictures[] = $immagine; 
					}
					$raccolta = new RaccoltaImmagini($arrayOfPictures, $nomeRaccolta);
					
					return $raccolta;
				}
			}
		}
	}
?>			
	