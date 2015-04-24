<?php
    include_once("PHP/Model/DB.php");
	
	
	/** Parte del controller dedicata unicamente all'autenticazione dell'utente **/
	class LoginController
	{
		// Costruttore
		public function __construct(&$request, &$session)
		{			
			$this -> handle_input($request, $session);
		}
		
		
		//metodi interni
		
		private function login($userid, $password)	 //verifica che userid e password siano corretti
		{
                    $DBcoordinates = new DB(); //DB memorizza le coordinate per la connessione col database
                    $mysqli = new mysqli();

                    $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                    // --- Controllo errori nella connessione col DB --- //
                    if($mysqli->connect_errno != 0) 
                    {
                        // gestione errore
                        $idErrore = $mysqli->connect_errno;
                        $message = $mysqli->connect_error;
                        error_log("Errore nella connessione al server $idErrore: $message", 0);
                        return "LoginController - $message - [#001]";
                    }
                    else
                    {
                        $query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password');";
                        
                        // --- Controllo errori nell'esecuzione della query  --- //
                        if($mysqli->errno > 0) 
                        {
                            error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                            $message = $mysqli->error;
                            $mysqli->rollback();
                            return "LoginController - $message - [#002]";
                        }
                        else
                        {
                            $result = $mysqli->query($query);

                            while($AuthData = $result->fetch_object())
                            {
                                    if( ($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //verifica dei dati di login
                                    {
                                            $mysqli->close(); //chiusura connessione col DB
                                            return true;	
                                    }
                            }
                            $mysqli->close();//chiusura connessione col DB
                            return false;
                        }    
                        
                    }
                    
		}	
	
		//chiude ed elimina i dati della sessione
		public static function logout()
		{	
			$_SESSION = array(); //reset dell'array _SESSION	
			if(session_id()	!= "" || isset($_COOKIE[session_name()]))
			{	
				setcookie(session_name(),	 '' ,	time()	-	2592000,	 '/' );	
			}	
			session_destroy();	
		}
		
		
		// gestisce l'input derivato dal form di login
		private function handle_input(&$request, &$session)
		{
			$mysqli = new mysqli();	
			
			if( isset($request["userid"]) && isset($request["password"]))
			{	
				if($this->login($request["userid"], $request["password"]))
				{	
					$session["loggedIn"] = true;	//CONVALIDA LA SESSIONE
					$session["username"]= $request["userid"];
					$session["password"]= $request["password"];
					
                                        //interfacciamento con JQUERY e ajax: 
                                        
                                        //poichè il menù per gli utenti loggati presenta nome e cognome dell'utente loggato
                                        //e poichè il caricamento del menù avviene in php solo dopo il primo login, mentre avviene negli altri casi in ajax e jquery
                                        //si memorizzano nome e cognome dell'utente all'interno dell'array session , per permette l'interfacciamento delle due tecnologie
                                        $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]);
                                        $session["nome"] = $userOBJ ->getNome(); 
                                        $session["cognome"] = $userOBJ ->getCognome();
                                        
                                        switch($request["subpage"])
					{
						default: header('HTTP/1.1 200 OK');
								 break;
						
						case "transaction":  $imgID = $request["imageID"];
								header("Location: index.php?page=works&subpage=payment&imageID=$imgID");
								break;
					}
					
					
				}
                                else //utente non riconosciuto dal sistema
                                {
                                    header('HTTP/1.1 401 Unauthorized Access');
                                }
			
			}
			else if(isset($request["logout"]))
			{	
				self::logout();
				header("Location: index.php?page=index");
			}
		}

		
	}

?>