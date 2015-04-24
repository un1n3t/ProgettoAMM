<?php

    class SendMail
    {
        
        public static function checkAuthorization($userid, $nome, $cognome, $DDN, $email, $cellulare)
        {
            //--controlla che non ci siano errori diconnessione col DB
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //---- se non ci sono errori esegue una query per verificare che l'utente possa effettivamente recuperare la password.
                
            $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
            $mysqli = new mysqli();

            //tentativo di connessione col database
            $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

            //Controllo errori
            if($mysqli->connect_errno != 0) //errori nella connessione
            {
                error_log("Errore di connessione #$mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                return "Funzione [SendMail::checkAuthorization] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                $query ="SELECT userID, nome, cognome, dataDiNascita, email, cellulare 
                            FROM loggeduser
                                WHERE userID = '$userid' AND nome = '$nome' AND cognome = '$cognome' AND dataDiNascita = '$DDN' and email = '$email' and cellulare = '$cellulare'";
                
                $result = $mysqli->query($query);
                
                //Controllo errori nell'esecuzione della query
                if($mysqli->errno > 0) 
                {
                        error_log("Errore nell'esecuzione della query $mysqli->errno: $mysqli->error", 0);
                        $message = "Controllo non superato: ".$mysqli->error;
                        return "Funzione [SendMail::checkAuthorization] - $message - [#002]";
                }
                else //Query eseguita correttamente
                {
                    return true;
                }
            }
                
        }
        
        public static function forgotPassword($userid)
        {
            //--controlla che non ci siano errori diconnessione
            //---- se ci sono errori ritorna il messaggio d'errore relativo all'errore
            //--se non ci sono errori esegue una query per recuperare l'email di registrazione; quindi, invia l'email.
                
            $DBcoordinates = new DB(); //DB memorizzate le coordinate per la connessione col database
            $mysqli = new mysqli();

            //tentativo di connessione col database
            $mysqli-> connect($DBcoordinates->getAddress(), $DBcoordinates->getUserId(), $DBcoordinates->getPass(), $DBcoordinates->getDBName()); //connessione al database

            //Controllo errori
            if($mysqli->connect_errno != 0) //errori nella connessione
            {
                error_log("Errore di connessione #$mysqli->errno: $mysqli->error", 0);
                $message = $mysqli->error;
                return "Funzione [SendMail::forgotPassword] - $message - [#001]";
            }
            else //Controllo errori (connessione) superato
            {
                //esegue la query col DB 
                $query ="SELECT email FROM loggeduser WHERE userID = '$userid'";
                
                $result = $mysqli->query($query);
                
                //Controllo errori nell'esecuzione della query
                if($mysqli->errno > 0) 
                {
                        error_log("Errore nell'esecuzione della query $mysqli->errno: $mysqli->error", 0);
                        $message = $mysqli->error;
                        return "Funzione [SendMail::forgotPassword] - $message - [#002]";
                }
                else //Query eseguita correttamente
                {
                    $email_dest = $result->fetch_row();
                    
                    
                    $mittente = 'From: "IkStudios-Photography" <IkStudios@mioserver.it> \r\n';
                    $destinatario = $email_dest[0];
                    $oggetto = "Ho dimenticato la password";
                    $messaggio = "Questa email ti è stata inviata perchè hai attivato la procedura per il recupero della password. Per procedere clicca sul link qui sotto. Se non sei stato"
                            . "tu a richiedere il recupero della password d'accesso alla piattaforma web, clicca qui:"; 
                    
                    
                    if (mail($destinatario, $oggetto, $messaggio, $mittente))//se l'invio dell'email avviene con successo
                    {
                        return TRUE;
                    }
                    else
                    {
                        return "Si è verificato un errore nell'invio dell'email. Può dipendere dai nostri server, o dal tuo computer; per ulteriori informazioni, contatta l'assistenza.";
                    }
                }
                
                
            }
 
        }
    }

?>

