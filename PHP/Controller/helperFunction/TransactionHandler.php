<?php
include_once("PHP/Model/DB.php");
include_once("PHP/Model/Ordine.php");
include_once("PHP/Model/helperFunctions/OrderIDGenerator.php");

class TransactionHandler
{
    public static function decreaseAvaibleQuantity($mysqli, $riepilogoOrdine)
    {
        $articleID = $riepilogoOrdine -> getArticleID();
        
        $results = 0;
        
        if($riepilogoOrdine -> getGallery1Format()) //se risulta prenotato il relativo formato..
        {
            $query = "select fGalleria1 from immagine WHERE IDimg = $articleID";
            
            $result = $mysqli->query($query);
            $esito = $result->fetch_object();
            
            //Controllo errori nell'esecuzione della query (NB: la connessione è già stata effettuata e il commit è disabilitato)
            if($mysqli->errno > 0) 
            {
                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                return "Funzione [TransactionHandler::decreaseAvaibleQuantity] - $message - [#001]";
            }
            else
            {
                
                $quantity = ($esito -> fGalleria1) - 1;
                
                if($quantity < 0)
                {
                    //uso un formato diverso in quanto non è un codice errore basato sullo stato dell'applicazione, ma solamente sui dati
                    return "[#002] - Prodotto non disponibile per il formato <galleria Grande>";
                }
                
                $DML = "UPDATE immagine SET `fGalleria1`= $quantity WHERE `IDimg`= $articleID";
                $result = $mysqli->query($DML);
                if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    return "Funzione [TransactionHandler::decreaseAvaibleQuantity] - $message - [#003]";
                }
                else 
                {
                    $results += $mysqli->affected_rows;
                }
            }
        }
        
        if($riepilogoOrdine -> getGallery2Format()) //se risulta prenotato il relativo formato..
        {
            $query = "select fGalleria2 from immagine WHERE IDimg = $articleID";
            $result = $mysqli->query($query);
            
            if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
            {
                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                return "Funzione [TransactionHandler::decreaseAvaibleQuantity] - $message - [#004]";
            }
            else
            {
                $esito = $result->fetch_object();
                
                $quantity = ($esito -> fGalleria2) - 1;
                
                if($quantity < 0)
                {
                    //uso un formato diverso in quanto non è un codice errore basato sullo stato dell'applicazione, ma solamente sui dati
                    return "[#005] - Prodotto non disponibile per il formato <galleria Grande>";
                }
                
                $DML = "UPDATE immagine SET `fGalleria2`= $quantity WHERE `IDimg`= $articleID";
                $result = $mysqli->query($DML);
                
                if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
                {
                    error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                    $message = $mysqli->error;
                    return "Funzione [TransactionHandler::decreaseAvaibleQuantity] - $message - [#006]";
                }
                else 
                {
                    $results += $mysqli->affected_rows;
                }
            }
        }
        $mysqli->commit();
        return $results;
        
    }
    
    
    public static function starNewTransaction($orderData)
    {
        //-si connette al database
        //--controlla che non ci siano errori nella connessione
        
        //---se ci sono errori ritorna il messaggio d'errore relativo all'errore di connessione
        //---se non ci sono errori avvia la procedura di finalizzazione della transazione (scrivendo i dati su DB)

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
                return "Funzione [TransactionHandler::starNewTransaction] - $message - [#001]";
        }
        else //Controllo errori connessione superato
        {
            //- Rimosso il controllo sui duplicati dello stesso ordine:
            //- - l'utente può ordinare qualsiasi quantità dell'oggetto scelto, fino ad esaurimento scorte. 

            //Inizia la transaction
            //
            //0) disabilitato l'autocommit: le operazioni eseguite saranno rese permanenti, in maniera esplicita, solo in mancanza di errori
            $mysqli->autocommit(false);

            $userID = $orderData -> getUserID();
            $articleID = $orderData -> getArticleID();
            $totalImport = $orderData -> getTotalImport();


            //1) si crea un nuovo ID per l'oggetto 
            $newOderID = OrderIDGenerator::newOrderID($userID, $articleID, $totalImport);


            //2) Transazione di pagamento con la banca
            //Non implementata

            //3) Inserimento dell'ordine nella lista ordini e aggiornamento delle disponibilità
            //3.1) Preparazione dei dati per la query in scrittura

            //pagamento
            $numeroCC = null;
            $IBANcode = null;


            $creditCard = $orderData -> getCreditCard();
            if( isset($creditCard))
            {
                (string)$numeroCC = $creditCard;
            }
            else
            {
                $numeroCC = "0000 0000 0000 0000";
            }


            $IBAN = $orderData -> getIBAN();
            if(isset($IBAN))
            {
                (string)$IBANcode = $IBAN;
            }
            else
            {
                (string)$IBANcode = "000000000000000000000000000";
            }

            $data = date("Y-m-d"); //aaaa-mm-gg

            $prezzo = $orderData -> getTotalImport();

            $statoOrdine = "Pagamento ricevuto";

            if($orderData -> getOnlineFormat()) //se risulta prenotato il relativo formato..
            {
                $fOnline = 1;
            }
            else 
            {
                $fOnline = 0;
            }

            if($orderData -> getGallery1Format()) //se risulta prenotato il relativo formato..
            {
                $fGalleria1 = 1;
            }
            else 
            {
                $fGalleria1 = 0;
            }

            if($orderData -> getGallery2Format()) //se risulta prenotato il relativo formato..
            {
                $fGalleria2 = 1;
            }
            else 
            {
                $fGalleria2 = 0;
            }

            //3.2) Composizione della query e del prepared statement
            
            //inizializzazione del prepared statement
            $stmt = $mysqli->stmt_init();
            
            //creazione del pattern per la query
            $DML = "INSERT INTO ordine (IDordine, IDarticolo, IDutente, numeroCarta, IBAN, dataPagamento, importo, statoOrdine, fOnline, fGalleria1, fGalleria2) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            //preparazione dello statement per l'inoltro
            $stmt->prepare($DML);
            
            // collego i parametri della query con il loro tipo
            $stmt->bind_param("ssssssdsiii", $newOderID, $articleID, $userID, $numeroCC, $IBANcode, $data, $prezzo, $statoOrdine, $fOnline, $fGalleria1, $fGalleria2);
            
            // esecuzione della query
            $stmt->execute();
            
            //deallocazione dello statement
            $stmt->close();


            //3.3) Controllo errori nell'esecuzione della query
            if($mysqli->errno > 0) 
            {
                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                $mysqli->rollback();
                return "Funzione [TransactionHandler::starNewTransaction] - $message - [#007]";
            }
            else
            {
                //3.4) Commit e aggiornamento delle quantità disponibili
                $errors = self::decreaseAvaibleQuantity($mysqli, $orderData);

                //in caso di errore nelle quantità prenotate
                if (strpos($errors, "[#")=== TRUE)
                {
                    return $errors; //si mostra un messaggio d'errore e la transazione viene abortita
                }

                $mysqli->commit();
                $mysqli->autocommit(true);

                return "Success";
            }
                
            
        }
            
        
    }
   
    public static function retrieveMoreOrdersInfo($orderID)
    {
        //-si connette al database
        //--controlla che non ci siano errori nella connessione
        
        //---se ci sono errori ritorna il messaggio d'errore relativo all'errore di connessione
        //---se non ci sono errori recupera tutte le informazioni sull'ordine con quel determinato id e le restituisce sotto forma di oggetto
        
        //-NB: nessun prepared statement: le stringhe immesse sono generate unicamente dal server.
        
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
                return "Funzione [TransactionHandler::retrieveMoreOrdersInfo] - $message - [#001]";
        }
        else //Controllo errori connessione superato
        {
            $query = "select nome, cognome, indirizzo from loggeduser, ordine WHERE userID = IDutente AND IDordine ="."'".$orderID."'";
            
            $result = $mysqli->query($query);
            
            if($mysqli->errno > 0) //Controllo errori nell'esecuzione della query
            {
                error_log("Errore nella esecuzione della query $mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                return "Funzione [TransactionHandler::retrieveMoreOrdersInfo] - $message - [#002]";
            }
            else
            {
                $orderInfo = $result->fetch_object();
                
                return $orderInfo;
            }
        }
        
    }
}
   
?>			
	