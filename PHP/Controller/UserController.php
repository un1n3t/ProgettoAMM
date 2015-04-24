<?php
	include_once("PHP/Model/helperFunctions/UserConstructor.php");
        include_once("PHP/Model/helperFunctions/AdminHelper.php");
	include_once("PHP/Model/WebAdmin.php");
        
        class UserController
	{
		public function __construct(&$request, &$session)
		{
			$this -> handle_input($request, $session);
		}
                
                private function handle_input(&$request, &$session)
		{
			if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"]) //Ricontrollo per verificare che la sessione non sia già scaduta
			{
				$userOBJ = null;
                                //Istanzio un oggetto utente 
				if( isset($session["username"]) && isset($session["password"]))
				{
                                    //N.B se l'utente non è un amministratore viene istanziato un oggetto di tipo AuthenticatedUser;
                                    //diversamente, viene istanziato un oggetto di tipo WebAdmin. Entrambi hanno caratteristiche specifiche.
                                    $userOBJ = UserConstructor::buildUser($session["username"], $session["password"]); 
                                    
				}
				
                                // -- sezioni addizionali per l'admin -- //
                                if($userOBJ instanceof WebAdmin ) //n.b l'admin è aggiunto direttamente da database per motivi di sicurezza
                                {
                                    $_SESSION["admin"] = true; //utilizzato nelle view per mostrare i bottoni con le funzionalità riservate all'admin
                                    
                                    if(isset($request["administration"]))
                                    {
                                        switch($request["administration"])
                                        {
                                            //vista principale, riassume le funzioni dell'admin
                                            case "mainMenu": 
                                                            $style = "PHP/view/ADMsections/AdminSectionsStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = null;
                                                            $adminMenu = "PHP/view/ADMsections/AdministrationMenu.php";
                                                            $main = "PHP/view/ADMsections/AdminMainView.php";
                                                            
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $notFoundContent = null;
                                                            $footer="PHP/view/footer.php"; 
                                                            include("master.php");
                                                            break;
                                                        
                                            //quadro riassuntivo degli utenti
                                            case "users":   
                                                            // --- Modifica delle voci in tabella utenti --- //
                                                            if(isset($_POST["action"]) && $_POST["action"] == "updateData" )
                                                            {
                                                                $esit = AdminHelper::updateUserData($userOBJ); //modifica la colonna
                                                            }
                                                            // --- Eliminazione delle voci --- //
                                                            else if(isset($_POST["action"]) && $_POST["action"] == "delete")
                                                            {
                                                                $esit = AdminHelper::delete("user", $userOBJ); //elimina la conna
                                                            }
                                                                                                           
                                                            
                                                            //se viene impostato un ID nella richiesta, vuol dire che deve essere visualizzato solo l'utente con quell'ID
                                                            if(isset($_REQUEST["user_ID"]))
                                                            {
                                                                $usersList = AdminHelper::retrieveUsers($userOBJ, $_REQUEST["user_ID"]);
                                                            }
                                                            else
                                                            {
                                                                $usersList = AdminHelper::retrieveUsers($userOBJ, null);
                                                            }
                                                            
                                                            $style = "PHP/view/ADMsections/AdminSectionsStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = null;
                                                            
                                                            $adminMenu = "PHP/view/ADMsections/AdministrationMenu.php";
                                                            $userSummary = "PHP/view/ADMsections/userSummary.php";
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $notFoundContent = null;
                                                            $footer="PHP/view/footer.php"; 
                                                            include("master.php");
                                                            break;
                                                        
                                            case "Orders":  
                                                            // --- Modifica delle voci in tabella ordini --- //
                                                            if(isset($_POST["action"]) && $_POST["action"] == "updateData" )
                                                            {
                                                                $esit = AdminHelper::updateOderData($userOBJ); //modifica la colonna
                                                            }
                                                            // --- Eliminazione delle voci in tabella ordini --- //
                                                            else if(isset($_POST["action"]) && $_POST["action"] == "delete")
                                                            {
                                                                $esit = AdminHelper::delete("order", $userOBJ); //elimina la conna
                                                            }
                                                            
                                                            
                                                            if(isset($_REQUEST["order_ID"]))
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $ordersList = AdminHelper::retrieveOrders($userOBJ, $_REQUEST["order_ID"]); 
                                                            }
                                                            else
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $ordersList = AdminHelper::retrieveOrders($userOBJ, null); 
                                                            }
                                                            
                                                            $style = "PHP/view/ADMsections/AdminSectionsStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = null;
                                                            
                                                            $adminMenu = "PHP/view/ADMsections/AdministrationMenu.php";
                                                            $ordersSummary = "PHP/view/ADMsections/ordersSummary.php";
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $notFoundContent = null;
                                                            $footer="PHP/view/footer.php"; 
                                                            include("master.php");
                                                            break;
                                                
                                                case "Payments":
                                                    
                                                            //se è stata richiesta la modifica delle informazioni ottenute dalla tabella..
                                                            if(isset($_POST["action"]) && $_POST["action"] == "updateData" )
                                                            {
                                                                $esit = AdminHelper::updatePaymentData($userOBJ);//modifica la colonna selezionata
                                                            }
                                                            
                                                            
                                                            if(isset($_REQUEST["CCnumber"]))
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $PayMethodsList = AdminHelper::retrievePayments($userOBJ, $_REQUEST["CCnumber"], null); 
                                                            }
                                                            else if(isset($_REQUEST["IBAN"]))
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $PayMethodsList = AdminHelper::retrievePayments($userOBJ, null, $_REQUEST["IBAN"]); 
                                                            }
                                                            
                                                            //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                            $PayMethodsList = AdminHelper::retrievePayments($userOBJ, null, null); 
                                                            
                                                            
                                                            $style = "PHP/view/ADMsections/AdminSectionsStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = null;
                                                            
                                                            $adminMenu = "PHP/view/ADMsections/AdministrationMenu.php";
                                                            $paymentsSummary = "PHP/view/ADMsections/paymentsSummary.php";
                                                            
                                                            
                                                            
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $notFoundContent = null;
                                                            $footer="PHP/view/footer.php"; 
                                                            include("master.php");
                                                            break;
                                                            
                                                case "Articles":  
                                                    
                                                            //se è stata richiesta la modifica delle informazioni ottenute dalla tabella..
                                                            if(isset($_POST["action"]) && $_POST["action"] == "updateData" )
                                                            {
                                                                $esit = AdminHelper::updateArticles($userOBJ);//modifica la colonna selezionata
                                                            }
                                                            else if(isset($_POST["action"]) && $_POST["action"] == "delete")
                                                            {
                                                                $esit = AdminHelper::delete("article", $userOBJ);
                                                            }
                                                            
                                                            if(isset($_REQUEST["article_ID"]))
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $ordersList = AdminHelper::retrieveArticles($userOBJ, $_REQUEST["article_ID"]); 
                                                            }
                                                            else
                                                            {
                                                                //verifica se l'admin è autorizzato a richiedere la lista ordini, quindi restituisce o uno o tutti gli ordini presenti nel db
                                                                $ordersList = AdminHelper::retrieveArticles($userOBJ, null); 
                                                            }
                                                            
                                                            //$esit = UserConstructor::updateUserData();//modifica la colonna selezionata
                                                            
                                                            
                                                
                                                            $style = "PHP/view/ADMsections/AdminSectionsStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = null;
                                                            
                                                            $adminMenu = "PHP/view/ADMsections/AdministrationMenu.php";
                                                            $articlesGallery = "PHP/view/ADMsections/articlesGallery.php";
                                                            
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $notFoundContent = null;
                                                            $footer="PHP/view/footer.php"; 
                                                            include("master.php");
                                                            break;
                                                            
                                            default: header("Location: index.php?page=index");
                                                    break;                                       
                                                    
                                        }
                                    }
                                    else
                                    {
                                        include("PHP/view/content-not-found.php");
                                    }
                                    
                                }
                                
                                
                                
                                
                                //sezioni dedicate all'utente
				switch($request["subpage"])
				{
                                    case "profile": 
                                                    $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                    $header = "PHP/view/Header.php";
                                                    $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                    $slideshow = null;
                                                    $userProfile = "PHP/view/UserProfile/userProfile.php";
                                                    $payments = null;
                                                    $orders = null;
                                                    $registration = null;
                                                    $notFoundContent = null;
                                                    $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                    $footer="PHP/view/footer.php"; 
                                                    include("master.php");
                                                    break;
                                    
                                    case "payments":
                                                    if( $userOBJ instanceof AuthenticatedUser )//se l'utente ha anche una carta di credito
                                                    {
                                                        if( !is_null($userOBJ -> getCarta()))
                                                        {
                                                            $creditCard = $userOBJ -> getCarta(); //istanzia la carta di credito a parte in modo tale da poterne ricavare i dati
                                                        }
                                                    
                                                        if( !is_null($userOBJ -> getIBAN()) )
                                                        {
                                                                $ibanOBJ = $userOBJ -> getIBAN();
                                                        }
                                                    }

                                                    $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                    $header = "PHP/view/Header.php";
                                                    $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                    $slideshow = null;
                                                    $userProfile = null;
                                                    $payments = "PHP/view/UserProfile/Payments.php";
                                                    $orders = null;
                                                    $registration = null;
                                                    $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                    $notFoundContent ="PHP/view/content-not-found.php";
                                                    $footer="PHP/view/footer.php"; 
                                                    include("master.php");
                                                    break;
				
                                    case "orders":  if( $userOBJ instanceof AuthenticatedUser )
                                                    {
                                                        if( !is_null($userOBJ -> getOrders()) )
                                                        {
                                                            
                                                            $ordini = $userOBJ -> getOrders(); //recupera la lista ordini correlata all'utente
                                                            
                                                            
                                                        }
                                                    }
                                        
                                                    
                                                    $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                    $header = "PHP/view/Header.php";
                                                    $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                    $slideshow = null;
                                                    $userProfile = null;
                                                    $payments = null;
                                                    $registration = null;
                                                    $orders = "PHP/view/UserProfile/StatoOrdini.php";
                                                    $notFoundContent ="PHP/view/content-not-found.php";
                                                    $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                    $footer="PHP/view/footer.php"; 
                                                    include("master.php");
                                                    break;
                                    
                                    case "deleteProfile":
                                                    if(isset($request["action"]) && $request["action"] == "confirm")
                                                    {
                                                        $esito = UserConstructor::deleteUser($userOBJ ->getID());
                                                        
                                                        if($esito == "success") //se la funzione restituisce true
                                                        {
                                                            LoginController::logout();
                                                            $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = "PHP/view/UserProfile/afterDelete.php"; //cambia la vista, adesso userProfile punta alla schermata d'esito dell'operazione
                                                            $success = true; //esito positivo
                                                            $payments = null;
                                                            $orders = null;
                                                            $registration = null;
                                                            $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                            $footer="PHP/view/footer.php";
                                                            include("master.php");
                                                        }
                                                        else
                                                        {
                                                            LoginController::logout();
                                                            $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                            $header = "PHP/view/Header.php";
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                            $slideshow = null;
                                                            $userProfile = "PHP/view/UserProfile/afterDelete.php"; //cambia la vista, adesso userProfile punta alla schermata d'esito dell'operazione
                                                            $success = false; //esito positivo
                                                            $payments = null;
                                                            $orders = null;
                                                            $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                            $registration = "PHP/view/RegistrationContent.php";
                                                            $footer="PHP/view/footer.php";
                                                            include("master.php");
                                                            
                                                        }
                                                        
                                                    }
                                                    else
                                                    {
                                                        $style = "PHP/view/UserProfile/LoggedUserStyle.php";
                                                        $header = "PHP/view/Header.php";
                                                        $loginFormContent = "PHP/view/loggedUserMenu.php"; //modificato col menù per utenti autenticati
                                                        $slideshow = null;
                                                        $userProfile = "PHP/view/UserProfile/deleteProfile.php"; //cambia la vista, adesso userProfile punta alla schermata per conferma l'eliminazione del profilo
                                                        $payments = null;
                                                        $orders = null;
                                                        $footerMenu = "PHP/view/UserProfile/footerMenu.php";
                                                        $registration = "PHP/view/RegistrationContent.php";
                                                        $footer="PHP/view/footer.php";
                                                        include("master.php");
                                                    }
                                                    
                                                   
                                                    
                                                    break;
                                    
                                    case "null": break;                
                                                    
                                    default: include("PHP/view/content-not-found.php");
                                             break;
                                }
                                
			}
			else //se la sessione è scaduta o l'utente non è comunque autenticato..
			{
                            header("Location: index.php?page=index");
			}
			
		}
		
	}

?>