<?php
include_once("PHP/Model/helperFunctions/PicturesCollectionConstructor.php");
include_once("PHP/Controller/helperFunction/TransactionHandler.php");


class WorksController
{
    public static $counter = 0;

    public function __construct(&$request, &$session)
    {
            self::$counter++;
            $this -> handle_input($request, $session);
    }

    private function handle_input(&$request, &$session)
    {
        $raccoltaImmagini;
        $riepilogoOrdine;
        $userOBJ;

        if(!isset($raccoltaImmagini))
        {
            //crea una nuova raccolta con tutte le immmagini presenti nel DB
            $raccoltaImmagini = PicturesCollectionConstructor::buildNewCollection("AllPictures"); 

        }

        if(!isset($riepilogoOrdine))
        {
            //tramite un oggetto di tipo Ordine, memorizza tutte le informazioni che saranno necessarie, poi, alla finalizzazione della transazione
            $riepilogoOrdine = new Ordine(null, null, null, null, null, null, null, null, null); 
        }

        if(!isset($userOBJ))
        {
            $userOBJ = new AuthenticatedUser(null, null, null, null, null, null,null, null, null, null, null, null, null, null);
        }


            switch($request["subpage"])
            {
                default: include("PHP/view/content-not-found.php");
                                 break;

                case "preview250":  //crea la vista per la galleria d'immagini
                                    $style = "PHP/view/Works/WorksStyle.php";
                                    $header = "PHP/view/Header.php";
                                    if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                    { 
                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                    }
                                    else 
                                    {
                                            $loginFormContent = "PHP/view/loginFormContent.php"; 
                                    }
                                    $works = "PHP/view/Works/Works.php";
                                    $preview250= "PHP/view/Works/preview250.php";
                                    $preview850= null;
                                    $slideshow=null;
                                    
                                    $footer="PHP/view/footer.php"; 
                                    include("master.php");
                                    break;

                case "preview850":  //correlata all'immagine selezionata, questa vista fornisce sia un ingrandimento dell'immagine
                                    //che una serie di opzioni e informazioni relative alla stessa e alla sua vendita
                                    if (isset($request["imageID"]))
                                    {
                                        $style = "PHP/view/Works/WorksStyle.php";
                                        $header = "PHP/view/Header.php";
                                        if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                        { 
                                                $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                        }
                                        else 
                                        {
                                                $loginFormContent = "PHP/view/loginFormContent.php"; 
                                        }
                                        $slideshow=null;
                                        $registration = "PHP/view/RegistrationContent.php";
                                        $works = "PHP/view/Works/Works.php";
                                        $preview250="PHP/view/Works/preview250.php";
                                        $preview850="PHP/view/Works/preview850.php";
                                        $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);

                                        $footer="PHP/view/footer.php"; 
                                        include("master.php");
                                    }
                                    else
                                    {
                                            include("PHP/view/content-not-found.php");
                                    }

                                    break;

                case "payment": //Procedura di pagamento:
                
                                //- Questa parte del controller gestisce la vista di selezione del metodo di pagamento

                                //- - se l'utente non è loggato gli mostra una schermata apposita per il loginFormContent
                                //- - altrimenti gli mostra il riepilogo dei metodi di pagamento registrati e gliene fa selezionare uno

                                //Step 2 di 6 - L'utente Autenticato deve selezionare il metodo di pagamento
                                if(isset($request["imageID"]))	
                                {
                                        if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"]) 
                                        {
                                                if( isset($session["username"]) && isset($session["password"]))//utente loggato e autenticato
                                                {	
                                                        
                                                        $formati = null; //Tiene traccia dei formati selezionati dall'utente
                                                        
                                                        //Controlla se l'utente ha già selezionato i formati relativi all'immagine (If)
                                                        //e popola l'array formati di conseguenza, caricando i dati già ottenuti o reinizializzandolo
                                                        if(isset($_SESSION["otherData"])) 
                                                        {
                                                            $riepilogoOrdine = $_SESSION["otherData"];
                                                            $formati = $riepilogoOrdine -> getAllReservedFormats(); //si ricavano i formati selezionati
                                                        }
                                                        else //se l'utente deve ancora selezionare i formati relativi all'immagine
                                                        {
                                                            if(isset($_REQUEST["formats"]))
                                                            {
                                                                    $formats = array();
                                                                    $formats = $_REQUEST["formats"];


                                                                    if(isset($formats[0])) //formato online
                                                                    {
                                                                            $riepilogoOrdine -> setOnlineFormat(True); 
                                                                    }

                                                                    if(isset($formats[1])) //formato galleria 
                                                                    {
                                                                            $riepilogoOrdine -> setGallery1Format(True); 
                                                                    }

                                                                    if(isset($formats[2])) //formato galleria  
                                                                    {
                                                                            $riepilogoOrdine -> setGallery2Format(True);
                                                                    }

                                                            }
                                                            $formati = $riepilogoOrdine -> getAllReservedFormats();
                                                        }
                                                       


                                                        //carico l'oggetto relativo all'utente corrente
                                                        $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]); 
                                                        
                                                        $creditCard = $userOBJ ->getCarta();
                                                        $ibanOBJ = $userOBJ ->getIBAN();
                                                        
                                                        //carico l'oggetto relativo all'immagine che verrà acquistata
                                                        $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);

                                                        //- aggiorno nuovamente le informazioni sull'ordine:

                                                        //-- associo all'ordine l'id dell'utente corrente
                                                        $riepilogoOrdine -> setUserID($userOBJ -> getID()); 
                                                        
                                                        //-- associo all'ordine l'id dell'immagine selezionata
                                                        $riepilogoOrdine -> setArticleID($describedOBJ -> getID());

                                                        //-- associo all'ordine l'importo parziale totale (Senza spedizione, iva esclusa)
                                                        $riepilogoOrdine -> setTotalImport($describedOBJ -> getPrice());

                                                        //memorizzo i dati nel server, in attesa di scriverli su database, tramite la variabile di sessione correlata all'utente
                                                        $_SESSION["otherData"] = $riepilogoOrdine;

                                                        $style = "PHP/view/Works/TransactionsStyle.php";
                                                        $header = "PHP/view/Header.php";
                                                        $loginFormContent = "PHP/view/loggedUserMenu.php";
                                                        $slideshow=null;
                                                        $registration = "PHP/view/RegistrationContent.php";
                                                        $works = "PHP/view/Works/Works.php";
                                                        $preview250="PHP/view/Works/preview250.php";
                                                        $SecondaryLoginForm = null;
                                                        $summaryPayments = "PHP/view/Works/summaryPayments.php";
                                                        $creditCardContent = "PHP/view/Works/CreditCard-Content.php";
                                                        $ibanContent = "PHP/view/Works/Iban-content.php";
                                                        $ToPay = "PHP/view/Works/ToPay.php";
                                                        $footer="PHP/view/footer.php"; 


                                                        include("master.php");
                                                }
                                        }
                                        else //Step 1 di 6 - L'utente non si è ancora autenticato (per iniziare la procedura di pagamento)
                                        {

                                                //carico l'immagine specifica che verrà acquistata
                                                $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);


                                                //- aggiorno le informazioni sull'ordine:

                                                //-- associo all'ordine l'importo parziale totale (Senza spedizione, iva esclusa)
                                                $riepilogoOrdine -> setTotalImport($describedOBJ -> getPrice());

                                                //-- associo all'ordine uno dei formati selezionati e ripeto la procedura per tutti 
                                                if(isset($_REQUEST["formats"]))
                                                {
                                                        $formats = array();
                                                        $formats = $_REQUEST["formats"];


                                                        if(isset($formats[0])) //formato online
                                                        {
                                                                $riepilogoOrdine -> setOnlineFormat(True); 
                                                        }

                                                        if(isset($formats[1])) //formato galleria 
                                                        {
                                                                $riepilogoOrdine -> setGallery1Format(True); 
                                                        }

                                                        if(isset($formats[2])) //formato galleria  
                                                        {
                                                                $riepilogoOrdine -> setGallery2Format(True);
                                                        }

                                                }
                                                
                                                //memorizzo i dati nel server, in attesa di scriverli su database, tramite la variabile di sessione correlata all'utente
                                                $_SESSION["otherData"] = $riepilogoOrdine;
                                                

                                                //mostra (nell view) quali formati sono stati selezionati per l'ordine corrente (memorizza un array di booleani, dove il formato è true se il formato è stato prenotato)
                                                $formati = $riepilogoOrdine -> getAllReservedFormats();

                                                $style = "PHP/view/Works/TransactionsStyle.php";
                                                $header = "PHP/view/Header.php";
                                                $loginFormContent = "PHP/view/loginFormContent.php";
                                                $registration = "PHP/view/RegistrationContent.php";
                                                $works = "PHP/view/Works/Works.php";
                                                $preview250="PHP/view/Works/preview250.php";

                                                $SecondaryLoginForm="PHP/view/Works/SecondaryLoginFormContent.php";
                                                $ToPay = "PHP/view/Works/ToPay.php";



                                                $footer="PHP/view/footer.php"; 
                                                include("master.php");
                                        }
                                }
                                else
                                {
                                        include("PHP/view/content-not-found.php");
                                }

                                break;

                case "shipments":   //- Questa parte del controller gestisce la vista di selezione del metodo di SPEDIZIONE:
                                
                                    //- - se l'utente non è loggato lo riporta allo step iniziale (case "payment")
                                    //- - altrimenti gli mostra il riepilogo dei dati di spedizione registrati e gli offre alcune possibilità di scelta per il metodo di spedizione

                                //Step 3 di 6 - L'utente Autenticato ha già selezionato il metodo di pagamento, deve ora selezionare indirizzo e metodo di spedizione
                                if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"]) 
                                {
                                        $riepilogoOrdine = $_SESSION["otherData"];
                                        
                                        if( isset($session["username"]) && isset($session["password"]))//utente loggato e autenticato
                                        {
                                                //carico l'oggetto relativo all'utente corrente
                                                $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]); 
                                        }
                                        
                                        
                                        //mostra (nell view) quali formati sono stati selezionati per l'ordine (memorizza un array di booleani, dove il formato è true se è stato prenotato)
                                        $formati = $riepilogoOrdine -> getAllReservedFormats();

                                        if( isset($_REQUEST["creditCard"]))
                                        {   
                                            $CC = $userOBJ ->getCarta();
                                            $numeroCarta = $CC -> getNumero();
                                            
                                            $riepilogoOrdine -> setCreditCard($numeroCarta);
                                            $riepilogoOrdine ->setIBAN(null);
                                        }
                                        else if(isset($_REQUEST["IBAN"]))
                                        {
                                            $IBAN = $userOBJ -> getIBAN();
                                            $codIban = $IBAN -> getIBANutente();
                                            
                                            $riepilogoOrdine -> setIBAN($codIban);
                                            $riepilogoOrdine ->setCreditCard(null);
                                        }
                                        
                                        //memorizzo i dati nel server, in attesa di scriverli su database, tramite la variabile di sessione correlata all'utente
                                        $_SESSION["otherData"] = $riepilogoOrdine;

                                        $style = "PHP/view/Works/TransactionsStyle.php";
                                        $header = "PHP/view/Header.php";

                                        $loginFormContent = "PHP/view/loggedUserMenu.php";
                                        $slideshow=null;
                                        $registration = "PHP/view/RegistrationContent.php";

                                        $works = "PHP/view/Works/Works.php";
                                        $preview250="PHP/view/Works/preview250.php";

                                        $SecondaryLoginForm = null;
                                        $summaryPayments = null;
                                        $shipments = "PHP/view/Works/shipments.php";
                                        $ToPay = "PHP/view/Works/ToPay.php";

                                        //carico l'immagine specifica che verrà acquistata
                                        $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);

                                        $footer="PHP/view/footer.php"; 
                                        include("master.php");

                                }
                                else
                                {

                                        header("Location: http://127.0.0.1/projects/ProgettoAMM-Main/index.php?page=works&subpage=payment&imageID=$imgID");
                                }

                                break;
                
                case "summary":   //- Qui viene mostrato il riepilogo di tutti i dati inerenti la transazione:

                                  //- - se l'utente non è (più) loggato lo riporta allo step iniziale (case "payment" ramo else - step 1)
                                  //- - altrimenti gli mostra il riepilogo di tutti i dati collezionati fin'ora, per una conferma definitiva
                                
                                //Step 4 di 6 - L'utente Autenticato vede una schermata di riepilogo con tutti i dati connessi a vendita e spedizione; deve confermare
                                if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"]) 
                                {
                                    $riepilogoOrdine = $_SESSION["otherData"];
                                    
                                    //carico l'immagine specifica che verrà acquistata
                                    $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);
                                        
                                    if( isset($session["username"]) && isset($session["password"]))//utente loggato e autenticato
                                    {
                                            //carico l'oggetto relativo all'utente corrente
                                            $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]); 
                                    }
                                    
                                    //mostra (nell view) quali formati sono stati selezionati per l'ordine (memorizza un array di booleani, dove il formato è true se è stato prenotato)
                                    $formati = $riepilogoOrdine -> getAllReservedFormats();
                                    
                                    
                                    if( isset($_REQUEST["EspressoSTD"]))
                                    {    
                                        $riepilogoOrdine ->setTotalImport($describedOBJ -> getPrice()+ espressoSTD); //costante che traccia il prezzo della spedizione tramite corriere standard
                                    }
                                    else if(isset($_REQUEST["EspressoRapid"]))
                                    {
                                        $riepilogoOrdine ->setTotalImport($describedOBJ -> getPrice()+ espressoURG); //costante che traccia il prezzo della spedizione tramite corriere Urgente
                                    }
                                    
                                    
                                    if(null !==($riepilogoOrdine -> getCreditCard()))
                                    {
                                        $creditCard =  $userOBJ ->getCarta();
                                    }
                                    else if(null !==($riepilogoOrdine ->getIBAN()))
                                    {
                                        $IBAN =  $userOBJ ->getCarta();
                                    }

                                    //memorizzo i dati nel server, in attesa di scriverli su database, tramite la variabile di sessione correlata all'utente
                                    $_SESSION["otherData"] = $riepilogoOrdine;
                                    
                                    $style = "PHP/view/Works/TransactionsStyle.php";
                                    $header = "PHP/view/Header.php";

                                    $loginFormContent = "PHP/view/loggedUserMenu.php";
                                    $slideshow=null;
                                    $registration = "PHP/view/RegistrationContent.php";

                                    $works = "PHP/view/Works/Works.php";
                                    $preview250="PHP/view/Works/preview250.php";

                                    $SecondaryLoginForm = null;
                                    $summaryPayments = null;
                                    $shipments = null;
                                    $transactionSummary = "PHP/view/Works/transactionSummary.php";
                                    
                                    $creditCardContent = "PHP/view/Works/CreditCard-Content.php";
                                    $ibanContent = "PHP/view/Works/Iban-content.php";
                                    
                                    $success = null;
                                    $esito = null;
                                    $ToPay = "PHP/view/Works/ToPay.php";

                                    
                                    $footer="PHP/view/footer.php"; 
                                    include("master.php");
                                    
                                }
                                else
                                {
                                   header("Location: index.php?page=works&subpage=payment&imageID=$imgID");
                                }
                                break;
                                
                case "transaction":  //- L'insieme di tutti i dati ottenuti dal processo di conferma viene usato per generare la transazione d'acquisto

                                //controllo validità delle credenziali
                                if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"]) 
                                {
                                    //controlla se son presenti i dati d'acquisto
                                    if(isset($_SESSION["otherData"]))
                                    {
                                        //riepilogoOrdine contiene tutte le informazioni fornite dall'utente in merito alla selezione dell'ordine
                                        $riepilogoOrdine = $_SESSION["otherData"];
                                        
                                        //carico l'immagine specifica che verrà acquistata
                                        $describedOBJ = $raccoltaImmagini -> getImagesByID($request["imageID"]);
                                        
                                        if( isset($session["username"]) && isset($session["password"]))//utente loggato e autenticato
                                        {
                                                //carico l'oggetto relativo all'utente corrente
                                                $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]); 
                                        }
                                    
                                        //mostra (nell view) quali formati sono stati selezionati per l'ordine (memorizza un array di booleani, dove il formato è true se è stato prenotato)
                                        $formati = $riepilogoOrdine -> getAllReservedFormats();
                                    
                                        
                                        //avvia la transaction col DataBase:
                                        $esito = TransactionHandler::starNewTransaction($riepilogoOrdine);
                                        
                                        
                                        if($esito == "Success") //se la transazione ha avuto esito positivo
                                        {
                                            $style = "PHP/view/Works/TransactionsStyle.php";
                                            $header = "PHP/view/Header.php";

                                            $loginFormContent = "PHP/view/loggedUserMenu.php";
                                            $slideshow=null;
                                            $registration = "PHP/view/RegistrationContent.php";

                                            $works = "PHP/view/Works/Works.php";
                                            $preview250="PHP/view/Works/preview250.php";

                                            $SecondaryLoginForm = null;
                                            $summaryPayments = null;
                                            $shipments = null;
                                            $transactionSummary = "PHP/view/Works/transactionSummary.php";
                                            $creditCardContent = null;
                                            $ibanContent = null;
                                            $ToPay = "PHP/view/Works/ToPay.php";
                                            $success = true;

                                            $footer="PHP/view/footer.php"; 
                                            include("master.php");
                                        }
                                        else
                                        {
                                            $style = "PHP/view/Works/TransactionsStyle.php";
                                            $header = "PHP/view/Header.php";

                                            $loginFormContent = "PHP/view/loggedUserMenu.php";
                                            $slideshow=null;
                                            $registration = "PHP/view/RegistrationContent.php";

                                            $works = "PHP/view/Works/Works.php";
                                            $preview250="PHP/view/Works/preview250.php";

                                            $SecondaryLoginForm = null;
                                            $summaryPayments = null;
                                            $shipments = null;
                                            $transactionSummary = "PHP/view/Works/transactionSummary.php";
                                            $creditCardContent = null;
                                            $ibanContent = null;
                                            $ToPay = "PHP/view/Works/ToPay.php";
                                            $success = false;

                                            $footer="PHP/view/footer.php"; 
                                            include("master.php");
                                        }
                                    } 
                                    
                                }
                                break;
        }			
    }

}

?>