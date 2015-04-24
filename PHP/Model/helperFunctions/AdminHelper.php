<?php
    include_once("PHP/Model/DB.php");
    

    class AdminHelper
    {
        //Prende un oggetto di tipo WebAdmin, verifica che l'oggetto rappresenti un amministratore autorizzato;
        //se $userID non è stato settato, esegue una query per ottenere l'elenco di TUTTI gli utenti presenti del DB, sotto forma di array
        //altrimenti restituisce l'unico utente che è stato richiesto
        public static function retrieveUsers($adminObj, $userID)
        {
            
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
                return "Funzione [AdminHelper::retrieveUsers] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                
                //verifica le credenziali dell'admin
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::retrieveUsers] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        //se non è stato richiesto uno specifico utente (in base all'id) restituisce TUTTI gli utenti del DB
                        if(is_null($userID))
                        {
                            $query2 = "select * from loggeduser";
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveUsers] - $message - [#003]";
                            }
                        
                            return $result;

                        }
                        else //restituisce solo l'ordine richiesto
                        {
                            $query2 = "select * from loggeduser WHERE userID='".$userID."' ";
                            
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveUsers] - $message - [#004]";
                            }
                        
                            return $result;
                        }
                        
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::retrieveUsers] - $message - [#005]";
                    }
                }
                
                	
                
            }
                

        }
        
        public static function updateUserData($adminObj)
        {
            //-si connette al database
            //--controlla che non ci siano errori di connessione
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //---- se non ci sono errori esegue una query in scrittura: modifica i dati ottenuti tramite form dove userid = $inputID
            $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
            $mysqli = new mysqli();

            //tentativo di connessione col database
            $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

            // -- Controllo errori nella connessione
            if($mysqli->connect_errno != 0) 
            {
                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                $mysqli -> close();
                return "Funzione [AdminHelper::updateUserData] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //verifica le credenziali dell'admin    
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                                
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                
                // -- Controllo errori nella query appena eseguita
                if($mysqli->connect_errno != 0) 
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::updateUserData] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                    
                    //se l'admin è autenticato...
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) 
                    {
                        $userID = $_POST["userid"];
                        $newUserID = $_POST["newUserID"];
                        $passwd = $_POST["password"]; 
                        $email = $_POST["email"]; 
                        $nome = $_POST["nome"]; 
                        $cognome = $_POST["cognome"]; 
                        $dataDiNascita = $_POST["dataNascita"];
                        $città = $_POST["citta"];
                        $cap = $_POST["CAP"];
                        $indirizzo = $_POST["indirizzo"];
                        $cellulare = $_POST["cellulare"];
                        $CC  = $_POST["CC"];
                        $IBAN  = $_POST["IBAN"];

                        $DML = ("UPDATE loggeduser SET userID='".$newUserID."', passwd='".$passwd."', email='".$email."', nome='".$nome."', cognome='".$cognome."', `dataDiNascita`=".date('Ymd', strtotime($dataDiNascita)).", città='".$città."',"
                                . "cap='".$cap."', indirizzo='".$indirizzo."', cellulare='".$cellulare."',cartaDiCredito='".$CC."',IBAN=$IBAN  WHERE userID='".$userID."' ");

                        $result = $mysqli->query($DML);

                        // -- Controllo errori nella query appena eseguita
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::updateUserData] - $message - [#003]";
                        }
                        else
                        {
                            //query modifica eseguita con successo
                            return true;
                        }
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::updateUserData] - $message - [#004]";
                    }

                }
            }
        }
        
        //La funzione è speculare alla funzione retrieveUsers:
        //prende un oggetto di tipo WebAdmin, verifica che l'oggetto rappresenti un amministratore autorizzato
        //quindi esegue una query per ottenere l'elenco di tutti gli ordini presenti del DB, sotto forma di array.
        //Se orderid non è null, viene restituito solo ed esclusivamente l'ordine con quell'orderID
        public static function retrieveOrders($adminObj, $orderID)
        {
            
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
                return "Funzione [AdminHelper::retrieveOrders] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                
                //verifica le credenziali dell'admin
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::retrieveOrders] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        //se non è stato richiesto un determinato ordine (col suo orderID) restituisce tutti gli ordini del db
                        if(is_null($orderID))
                        {
                            $query2 = "select * from ordine";
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveOrders] - $message - [#003]";
                            }
                        
                            return $result;

                        }
                        else //restituisce solo l'ordine richiesto
                        {
                            $query2 = "select * from ordine WHERE IDordine='".$orderID."' ";
                            
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveOrders] - $message - [#004]";
                            }
                        
                            return $result;
                        }
                        
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::retrieveOrders] - $message - [#005]";
                    }
                }
                
                	
                
            }
        }
        
        public static function updateOderData($adminObj)
        {
            //Prende un oggetto di tipo WebAdmin e verifica che l'oggetto rappresenti un amministratore autorizzato
            //--controlla che non ci siano errori di connessione
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //---- se non ci sono errori esegue una query in scrittura: modifica i dati ottenuti tramite form dove orderID = $input-orderID


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
                return "Funzione [AdminHelper::updateOderData] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //verifica le credenziali dell'admin    
                
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                                
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::updateOderData] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        $orderID = $_POST["orderID"];
                        $newOrderID = $_POST["newOrderID"];
                        $userID = $_POST["userID"];
                        $articleID = $_POST["articleID"];
                        $CC  = $_POST["CC"];
                        $IBAN  = $_POST["IBAN"];
                        $import = $_POST["import"];
                        $paymentDate = $_POST["paymentDate"];
                        $orderStatus = $_POST["orderStatus"]; 
                        $fOnline = $_POST["fOnline"]; 
                        $fGalleria1 = $_POST["fGalleria1"];
                        $fGalleria2 = $_POST["fGalleria2"];


                        $DML = ("UPDATE ordine SET IDordine='".$newOrderID."', IDarticolo='".$articleID."', IDutente='".$userID."', numeroCarta='".$CC."', IBAN='".$IBAN."', `dataPagamento`=".date('Ymd', strtotime($paymentDate)).", importo='".(float)$import."',"
                                . "statoOrdine='".$orderStatus."', fOnline='".$fOnline."', fGalleria1='".$fGalleria1."',fGalleria2='".$fGalleria2."' WHERE IDordine='".$orderID."' ");

                        $result = $mysqli->query($DML);

                        //Controllo errori nell'esecuzione della query
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::updateOderData] - $message - [#003]";
                        }
                        else
                        {
                            return true;
                        }
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::updateOderData] - $message - [#004]";
                    }

                }
            }
        }
        
        
        //Prende un oggetto di tipo WebAdmin, verifica che l'oggetto rappresenti un amministratore autorizzato;
        //se $CCnumber o $IBAN sono settati a null, esegue una query per ottenere l'elenco di TUTTI i metodi di pagamento presenti del DB, associandoli a nomi, cognomi e userid
        //altrimenti restituisce i dettagli del metodo di pagamento richiesto, che si distingue fra IBAN e carta di credito. 
        public static function retrievePayments($adminObj, $CCnumber, $IBAN)
        {

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
                return "Funzione [AdminHelper::retrievePayments] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();

                //verifica le credenziali dell'admin
                $query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);

                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::retrievePayments] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();

                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        //se non è stato richiesto uno specifico metodo di pagamento (in base all'id) restituisce TUTTI i metodi di pagamento del DB
                        //associandoli a nome cognome e userid dell'utente che li ha registrati
                        if(is_null($CCnumber) AND is_null($IBAN))
                        {
                            $allMethods = "SELECT userID, nome, cognome, numeroCarta, CVV2, dataScadenza, nomeIntestatario, cognomeIntestatario, IBAN_Ordinante, nomeOrdinante, cognomeOrdinante
                                                    FROM loggeduser, creditcard, bonifico
                                                            WHERE ( (cartaDiCredito = numeroCarta) OR (IBAN = IBAN_Ordinante) )";
                            
                            $result = $mysqli->query($allMethods);

                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrievePayments] - $message - [#003]";
                            }

                            return $result;

                        }
                        else //restituisce solo i metodi di pagamento richiesti
                        {
                            if(!is_null($CCnumber))
                            {
                                $creditCard = "SELECT userID, nome, cognome, numeroCarta, CVV2, dataScadenza, nomeIntestatario, cognomeIntestatario
                                                    FROM loggeduser, creditcard
                                                            WHERE (cartaDiCredito = numeroCarta) and (numeroCarta='".$CCnumber."') ";

                                
                                $result = $mysqli->query($creditCard);

                                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                                {
                                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                    $message = $mysqli->error;
                                    $mysqli -> close();
                                    return "Funzione [AdminHelper::retrievePayments] - $message - [#004]";
                                }
                                
                                return $result;
                                

                            }
                            
                            if(!is_null($IBAN))
                            {
                                $IBAN_query = "SELECT userID, nome, cognome, IBAN_Ordinante, nomeOrdinante, cognomeOrdinante, IBAN_Beneficiario, nomeBeneficiario, causale
                                                    FROM loggeduser, bonifico
                                                             WHERE (IBAN = IBAN_Ordinante) AND (IBAN_Ordinante='$IBAN' ) ";

                                $result = $mysqli->query($IBAN_query);

                                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                                {
                                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                    $message = $mysqli->error;
                                    $mysqli -> close();
                                    return "Funzione [AdminHelper::retrievePayments] - $message - [#005]";
                                }
                                
                                return $result;
                                
                            }
                            
                        }

                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::retrievePayments] - $message - [#006]";
                    }
                }
            }
        }
        
        public static function updatePaymentData($adminObj)
        {
            //Prende un oggetto di tipo WebAdmin e verifica che l'oggetto rappresenti un amministratore autorizzato
            //--controlla che non ci siano errori di connessione
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //---- se non ci sono errori esegue una query in scrittura: modifica i dati ottenuti tramite form dove orderID = $input-orderID


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
                return "Funzione [AdminHelper::updatePaymentData] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //verifica le credenziali dell'admin    
                
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                                
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::updatePaymentData] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        //vengono modificate entrambe le modalità di pagamento
                        
                        // Update carta di credito
                        $CC = $_POST["CC"];
                        $newCC = $_POST["newCC"];
                        $CVV2 = $_POST["CVV2"];
                        $dataScadenza = $_POST["dataScadenza"];
                        $nomeIntestatarioCC = $_POST["nomeIntestatarioCC"];
                        $cognomeIntestatarioCC = $_POST["cognomeIntestatarioCC"];
                        
                        $DML = "UPDATE creditcard SET numeroCarta='".$newCC."', CVV2='".$CVV2."', dataScadenza='".$dataScadenza."', nomeIntestatario='".$nomeIntestatarioCC."', cognomeIntestatario='".$cognomeIntestatarioCC."' "
                                . "WHERE `numeroCarta`='".$CC."' ";

                        $result = $mysqli->query($DML);

                        //Controllo errori nell'esecuzione della query
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::updatePaymentData] - $message - [#003]";
                        }
                        
                        $IBAN = $_POST["IBAN"];
                        $newIBAN = $_POST["newIBAN"];
                        $nomeIntestatarioIBAN = $_POST["nomeIntestatarioIBAN"];
                        $cognomeIntestatarioIBAN = $_POST["cognomeIntestatarioIBAN"];
                        
                        $DML = "UPDATE bonifico SET IBAN_Ordinante='".$newIBAN."', nomeOrdinante='".$nomeIntestatarioIBAN."', cognomeOrdinante='".$cognomeIntestatarioIBAN."' "
                                . "WHERE `IBAN_Ordinante`='".$IBAN."' ";

                        $result = $mysqli->query($DML);

                        //Controllo errori nell'esecuzione della query
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::updatePaymentData] - $message - [#004]";
                        }
                        
                        return true;
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::updatePaymentData] - $message - [#005]";
                    }

                }
            }
        }

        
        public static function retrieveArticles($adminObj, $articleID)
        {
            //La funzione è speculare alla funzione retrieveUsers:
            //prende un oggetto di tipo WebAdmin, verifica che l'oggetto rappresenti un amministratore autorizzato
            //quindi esegue una query per ottenere l'elenco di tutti gli ordini presenti del DB, sotto forma di array.
            //Se $articleID non è null, viene restituito solo ed esclusivamente l'articolo con quel determinato ID
            
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
                return "Funzione [AdminHelper::retrieveArticles] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                
                //verifica le credenziali dell'admin
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::retrieveArticles] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        //se non è stato richiesto un determinato ordine (col suo orderID) restituisce tutti gli ordini del db
                        if(is_null($articleID))
                        {
                            $query2 = "select * from immagine";
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveArticles] - $message - [#003]";
                            }
                        
                            return $result;

                        }
                        else //restituisce solo l'ordine richiesto
                        {
                            $query2 = "select * from immagine WHERE IDimg = '".$articleID."' ";
                            
                            $result = $mysqli->query($query2);
                        
                            if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                            {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [AdminHelper::retrieveArticles] - $message - [#004]";
                            }
                        
                            return $result;
                        }
                        
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::retrieveArticles] - $message - [#005]";
                    }
                }
                
                	
                
            }
        }
        
        public static function updateArticles($adminObj)
        {
            //Prende un oggetto di tipo WebAdmin e verifica che l'oggetto rappresenti un amministratore autorizzato
            //--controlla che non ci siano errori di connessione
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //---- se non ci sono errori esegue una query in scrittura: modifica i dati ottenuti tramite form dove articleID = $input-articleID


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
                return "Funzione [AdminHelper::updateArticles] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //verifica le credenziali dell'admin    
                
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                                
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::updateArticles] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        $articleID = $_POST["articleID"];
                        $newArticleID = $_POST["newArticleID"];
                        $author = $_POST["author"];
                        $title = $_POST["title"];
                        $price = $_POST["price"];
                        $descr  = $_POST["descr"];
                        $fOnline = $_POST["fOnline"];
                        $fGalleria1 = $_POST["fGalleria1"];
                        $fGalleria2 = $_POST["fGalleria1"];
                        $lastMod = $_POST["lastMod"]; 
                        $isVisible = $_POST["isVisible"];
                        
                        if($isVisible == "YES")
                        {
                            $isVisible = 1;
                        }
                        else
                        {
                            $isVisible = 0;
                        }    
                        
                        $preview250 = $_POST["preview250"];
                        $preview850 = $_POST["preview850"];

                        $DML = ("UPDATE immagine SET IDimg='".$newArticleID."', autore='".$author."', titolo='".$title."', descrizione='".$descr."', fOnline='".$fOnline."', fGalleria1='".$fGalleria1."', fGalleria2='".$fGalleria2."', "
                                . " `ultimaModifica`='".date('Ymd', strtotime($lastMod))."', visibile='".$isVisible."', preview250='".$preview250."', preview850='".$preview850."',prezzo='".$price."' WHERE IDimg='".$articleID."' ");

                        $result = $mysqli->query($DML);

                        //Controllo errori nell'esecuzione della query
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::updateArticles] - $message - [#003]";
                        }
                        else
                        {
                            return true;
                        }
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::updateArticles] - $message - [#004]";
                    }

                }
            }
        }
        
        
        public static function delete($model_entity, $adminObj)
        {
            //Prende un oggetto di tipo WebAdmin e verifica che l'oggetto rappresenti un amministratore autorizzato
            //Cancella l'elemento selezionato fra le entità a cui ha accesso l'amministratore (utenti, metodi di pagamenti, ordini in corso, articoli in vendita)
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            

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
                return "Funzione [AdminHelper::delete] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //verifica le credenziali dell'admin    
                
                $userid = $adminObj -> getID();
                $password = $adminObj -> getPassword();
                                
               	$query = "SELECT userID, passwd FROM loggeduser WHERE (userID = '$userid') AND (passwd = '$password')";
                $result = $mysqli->query($query);
		
                if($mysqli->connect_errno != 0) //errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    $mysqli -> close();
                    return "Funzione [AdminHelper::delete] - $message - [#002]";
                }
                else
                {
                    $AuthData = $result->fetch_object();
                
                    if (($AuthData -> userID == $userid) and ($AuthData -> passwd == $password) ) //se l'admin è autenticato...
                    {
                        $DML = null;
                        
                        switch($model_entity)
                        {
                            case "user": $userID = $_POST["userid"];
                                         $DML =  "DELETE FROM loggeduser WHERE `userID`='".$userID."' ";
                                         break;
                                     
                            case "order": $orderID = $_POST["orderID"];
                                         $DML =  "DELETE FROM ordine WHERE `IDordine`='".$orderID."' ";
                                         break;
                            
                            case "article": $articleID = $_POST["articleID"];
                                         $DML =  "DELETE FROM immagine WHERE `IDimg`='".$articleID."' ";
                                         break;
                                     
                            default: $message = "Parametro d'esecuzione errato, impossibile selezionare l'entità corretta";
                                    return "Funzione [AdminHelper::delete] - $message - [#003]";
                                    
                                     
                        }
                        
                        $result = $mysqli->query($DML);

                        //Controllo errori nell'esecuzione della query
                        if($mysqli->errno > 0) 
                        {
                                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                                $message = $mysqli->error;
                                $mysqli -> close();
                                return "Funzione [UserConstructor::delete] - $message - [#004]";
                        }
                        else
                        {
                            return true;
                        }
                    }
                    else //amministratore non autorizzato
                    {
                        $message = "Impossibile autenticare l'amministratore.";
                        return "Funzione [AdminHelper::delete] - $message - [#005]";
                    }

                }
            }
        }
        
    }
 ?>