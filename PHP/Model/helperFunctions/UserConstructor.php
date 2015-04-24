<?php
	include_once("PHP/Model/DB.php");
	include_once("PHP/Model/WebAdmin.php");
	include_once("PHP/Model/CreditCard.php");
	include_once("PHP/Model/Bonifico.php");
	include_once("PHP/Model/Ordine.php");
	
	class UserConstructor
	{
            public static function deleteUser($userID)
            {
                //-si connette al database
                //--controlla che non ci siano errori di connessione
                //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
                //--se non ci sono errori esegue una query in scrittura ed elimina l'utente WHERE userid = $inputID
                
                $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
                $mysqli = new mysqli();

                //tentativo di connessione col database
                $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                //Controllo errori
                if($mysqli->connect_errno != 0) //errori nella connessione
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [UserConstructor::deleteUser] - $message - [#001]";
                }
                 else //Controllo errori (connessione) superato
                {
                    $DML = "DELETE FROM loggeduser WHERE userID='$userID'";
                    $result = $mysqli->query($DML);
                    
                    //Controllo errori nell'esecuzione della query
                    if($mysqli->errno > 0) 
                    {
                            error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                            $message = $mysqli->error;
                            $mysqli -> close();
                            return "Funzione [UserConstructor::deleteUser] - $message - [#002]";
                    }
                    else //Query eseguita correttamente
                    {
                        $mysqli -> close();
                        return "success";
                    }
                }
                
            }
            
            
            public static function makeNewUser()
            {
                //-si connette al database
                //--controlla che non ci siano errori diconnessione
                //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
                //--se non ci sono errori esegue una query in scrittura per inserire il nuovo utente all'interno del DB
                
                $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
                $mysqli = new mysqli();

                //tentativo di connessione col database
                $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                //Controllo errori
                if($mysqli->connect_errno != 0) //errori nella connessione
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    return "Funzione [UserConstructor::makeNewUser] - $message - [#001]";
                }
                else //Controllo errori (connessione) superato
                {
                    
                    // - Ottenimento dei dati
                    // - Le variabili sono richieste per il binding dei parametri
                    $userid = $_REQUEST['userID'];
                    $password = $_REQUEST['pswd2'];
                    $email = $_REQUEST['email'];
                    
                    $nome = $_REQUEST['nome'];
                    $cognome = $_REQUEST['cognome'];
                    
                    //memorizza la data di nascita
                    $date = $_REQUEST['dataNascita'];
                    $dataNascita = date('Ymd', strtotime($date));
                    
                    $città = $_REQUEST["città"];
                    $cap = $_REQUEST["CAP"];
                    $indirizzo = $_REQUEST["indirizzo"];
                    $cellulare = $_REQUEST["cellulare"];
                    $ruolo = "user";
                    //se l'utente ha specificato una carta di credito il valore viene memorizzato
                    //altrimenti viene impostato al valore di default (0000 0000 0000 0000)
                    if(isset($_REQUEST["numeroCC"]) && ( strlen($_REQUEST["numeroCC"]) > 1))
                    {
                        $numeroCC = $_REQUEST["numeroCC"];
                    }
                    
                    //se l'utente ha specificato delle coordinate bancarie il valore viene memorizzato
                    //altrimenti viene impostato al valore di default 
                    if(isset($_REQUEST["IBAN"]) && ( strlen($_REQUEST["IBAN"]) > 1))
                    {
                        $IBAN = $_REQUEST["IBAN"];
                    }
                  
                    
                   
                    // - Inizializzazione del prepared statement
                    $stmt = $mysqli->stmt_init();
                                    
                    // - - patten per la query
                    $DML = "INSERT INTO loggeduser (userID, passwd, email, nome, cognome, dataDiNascita, città, cap, indirizzo, cellulare, ruolo, cartaDiCredito, IBAN)
                        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        
                    // - - preparazione dello statement secondo il pattern
                    if(!$stmt->prepare($DML))
                    {
                        error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                        $message = $mysqli->error;
                        return "Funzione [UserConstructor::makeNewUser] - $message - [#002]";
                        
                    }
                
                    // - - collego i parametri della query con il loro tipo
                    if(!$stmt->bind_param("sssssssssssss", $userid, $password, $email, $nome, $cognome, $dataNascita, $città, $cap, $indirizzo, $cellulare, $ruolo, $numeroCC, $IBAN))
                    {
                        error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                        $message = $mysqli->error;
                        return "Funzione [UserConstructor::makeNewUser] - $message - [#003]";
                    }
                            
                     // esecuzione della query
                    if(!$stmt->execute())
                    {
                        error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                        $message = $mysqli->error;
                        return "Funzione [UserConstructor::makeNewUser] - $message - [#004]";
                    }
                    
                    //deallocazione dello statement
                    $stmt->close();
                    
                    if($mysqli->errno > 0) 
                    {
                            error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                            $message = $mysqli->error;
                            return "Funzione [UserConstructor::makeNewUser] - $message - [#005]";
                    }
                    else //Query eseguita correttamente
                    {
                        
            
                           return true;
                    }
                }
                
            }
            
            
            
            public static function buildUser($userID, $passwd)
            {
                    //-si connette al database
                    //--controlla che non ci siano errori
                    //---se ci sono errori ritorna il messaggio d'errore relativo all'errore
                    //---se non ci sono errori ritorna un oggetto di tipo utente, popolato correttamente coi risultati della query associata ai campi dell'oggetto 

                    $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
                    $mysqli = new mysqli();

                    //tentativo di connessione col database
                    $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                    // --- Controllo errori nella connessione col DB --- //
                    if($mysqli->connect_errno != 0) 
                    {
                            // gestione errore
                            $idErrore = $mysqli->connect_errno;
                            $message = $mysqli->connect_error;
                            error_log("Errore nella connessione al server $idErrore: $message", 0);
                            return "Funzione [UserConstructor::buildUser] - $message - [#001]";
                    }
                    else //Controllo errori (connessione) superato
                    {
                            //esegue la query col DB e ne memorizza il risultato

                            $query = "SELECT * FROM loggeduser WHERE (userID = '$userID') AND (passwd = '$passwd');";
                            $result = $mysqli->query($query);

                            //Controllo errori nell'esecuzione della query
                            if($mysqli->errno > 0) 
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                return "Funzione [UserConstructor::buildUser] - $message - [#002]";
                            }
                            else //Query eseguita correttamente
                            {
                                //elabora i dati della query, inizializzando un nuovo oggetto utente, che verrà poi restituito
                                while($userOBJ = $result->fetch_object()) 
                                {
                                    //Verifica il ruolo dell'utente (amministratore o utente autenticato standard) e popola l'oggetto User(superclasse) appropriato
                                    if($userOBJ -> ruolo == "user")
                                    {
                                        //inizializzo un oggetto di tipo AuthenticatedUser coi dati ricavati dalla query precedentemente
                                        $utenteSTD = new AuthenticatedUser($userOBJ -> userID, $userOBJ -> passwd, $userOBJ -> email, $userOBJ -> nome, $userOBJ -> cognome, $userOBJ -> dataDiNascita, $userOBJ -> città, $userOBJ -> cap, $userOBJ -> indirizzo, $userOBJ -> cellulare, null, null, null, $userOBJ -> ruolo);

                                        // -----  controlla se è necessario istanziare un oggetto CartaDICredito ----- //
                                        if(!is_null($userOBJ -> cartaDiCredito)) 
                                        {
                                            $mysqli->close();
                                            
                                            $mysqli = new mysqli();

                                            //tentativo di connessione col database
                                            $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                                            // --- Controllo errori nella connessione col DB --- //
                                            if($mysqli->connect_errno != 0) 
                                            {
                                                    // gestione errore
                                                    $idErrore = $mysqli->connect_errno;
                                                    $message = $mysqli->connect_error;
                                                    error_log("Errore nella connessione al server $idErrore: $message", 0);
                                                    return "Funzione [UserConstructor::buildUser] - $message - [#003]";
                                            }
                                            else
                                            {
                                                $numeroCarta = $userOBJ -> cartaDiCredito;

                                                //esegue la query col DB e ne memorizza il risultato
                                                $query = "SELECT numeroCarta, CVV2, dataScadenza, nomeIntestatario, cognomeIntestatario
                                                                FROM creditcard 
                                                                    WHERE numeroCarta='".$numeroCarta."'";
                                                $result = $mysqli->query($query); 

                                                if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
                                                {
                                                    error_log("Errore nella esecuzione della query $mysqli->errno : $mysqli->error", 0);
                                                    $message = $mysqli->error;

                                                    return "Funzione [UserConstructor::buildUser] - $message - [#004]";
                                                }
                                                else
                                                {
                                                    //Crea un nuovo oggetto Carta di credito
                                                    $creditCard = null;

                                                    while($CC = $result->fetch_object()) //elaboro i dati della query
                                                    {
                                                            $creditCard = new CreditCard($CC -> numeroCarta, $CC -> CVV2, $CC -> dataScadenza, $CC -> nomeIntestatario, $CC -> cognomeIntestatario);
                                                    }

                                                    //Assegna la carta all'utente
                                                    $utenteSTD -> setCarta($creditCard);

                                                }
                                                
                                            }
                                            
                                        }


                                        // -----  controlla se è necessario istanziare un oggetto IBAN per il pagamento tramite bonifico ----- //
                                        if(!is_null($userOBJ -> IBAN))
                                        {
                                            $mysqli->close();
                                            $mysqli = new mysqli();

                                            //tentativo di connessione col database
                                            $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                                            // --- Controllo errori nella connessione col DB --- //
                                            if($mysqli->connect_errno != 0) 
                                            {
                                                    // gestione errore
                                                    $idErrore = $mysqli->connect_errno;
                                                    $message = $mysqli->connect_error;
                                                    error_log("Errore nella connessione al server $idErrore: $message", 0);
                                                    return "Funzione [UserConstructor::buildUser] - $message - [#005]";
                                            }
                                            else
                                            {
                                                $codiceIBAN = $userOBJ -> IBAN;

                                                //esegue la query col DB e ne memorizza il risultato
                                                $query = "SELECT IBAN_Ordinante, nomeOrdinante, cognomeOrdinante, IBAN_Beneficiario, nomeBeneficiario, causale
                                                                                FROM bonifico, loggeduser 
                                                                                        WHERE (IBAN_Ordinante = IBAN) AND IBAN_Ordinante = '$codiceIBAN';";
                                                $result = $mysqli->query($query); 


                                                if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
                                                {
                                                    error_log("Errore nella esecuzione della query $mysqli->errno : $mysqli->error", 0);
                                                    $message = $mysqli->error;

                                                    return "Funzione [UserConstructor::buildUser] - $message - [#006]";
                                                }
                                                else
                                                {
                                                        //Crea un nuovo oggetto Carta di credito
                                                        while($BB = $result->fetch_object()) //elaboro i dati della query
                                                        {
                                                                $ibanOBJ = new Bonifico($BB -> IBAN_Ordinante, $BB -> nomeOrdinante, $BB -> cognomeOrdinante, $BB -> IBAN_Beneficiario, $BB -> nomeBeneficiario, $BB -> causale);
                                                        }

                                                        //Assegna la carta all'utente
                                                        $utenteSTD -> setIBAN($ibanOBJ);


                                                }
                                            }


                                        }
                                        
                                        
                                        // -----  Verifica tramite Query se l'utente ha effettuato degli ordini; in caso affermativo popola uno o più oggetti della classe Ordine ----- //
                                        $mysqli->close();
                                        
                                        $userID = $userOBJ -> userID;
                                        
                                        $mysqli = new mysqli();

                                        //tentativo di connessione col database
                                        $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

                                        // --- Controllo errori nella connessione col DB --- //
                                        if($mysqli->connect_errno != 0) 
                                        {
                                                // gestione errore
                                                $idErrore = $mysqli->connect_errno;
                                                $message = $mysqli->connect_error;
                                                error_log("Errore nella connessione al server $idErrore: $message", 0);
                                                return "Funzione [UserConstructor::buildUser] - $message - [#007]";
                                        }
                                        else
                                        {
                                            //esegue la query col DB e ne memorizza il risultato
                                            $query = "SELECT * FROM ordine
                                                                    WHERE IDutente = '$userID';";
                                            $result = $mysqli->query($query); 


                                            //--- Controllo errori nell'esecuzione della query ---//
                                            if($mysqli->errno > 0) 
                                            {
                                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                                $message = $mysqli->error;
                                                $mysqli->rollback();
                                                return "Funzione [UserConstructor::buildUser] - $message - [#008]";
                                            }
                                            else //query eseguita correttamente
                                            {

                                                if ( !is_null($orders = $result->fetch_object()) ) //se il risultato della query non è nullo
                                                {
                                                    //Crea un nuovo ordine e lo aggiunge all'array di oggetti Ordine associato all'utente

                                                    $ordine = new Ordine($orders -> IDordine, $orders -> IDarticolo, $orders -> IDutente, $orders -> numeroCarta, $orders -> IBAN, $orders -> dataPagamento, floatval($orders -> importo), $orders -> statoOrdine, false );


                                                    //Aggiunge l'ordine all'array degli ordini relativo all'utente
                                                    $utenteSTD -> setNewOrder($ordine);

                                                }

                                            }

                                        }

                                        return $utenteSTD;

                                    }
                                    else if($userOBJ -> ruolo == "admin")
                                    {
                                            $admin = new WebAdmin($userOBJ -> userID, $userOBJ -> passwd, $userOBJ -> email, $userOBJ -> nome, $userOBJ -> cognome, $userOBJ -> ruolo);
                                            return $admin;
                                    }
                                }
                            }

                    }
                    return null;
            }
		
	}
		
?>