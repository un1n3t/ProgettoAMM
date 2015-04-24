<?php
        
        
	class OtherSectionsController
	{
		public function __construct(&$request, &$session)
		{
			$this -> handle_input($request, $session);
		}
		
		
		private function handle_input(&$request, &$session)
		{
			if(isset($request["page"]))
			{
				switch($request["page"]) 
				{
					case "index":
						$style = "PHP/view/Intro/MainStyle.php";
						$header = "PHP/view/Header.php";
						if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
						{ 
							$loginFormContent = "PHP/view/loggedUserMenu.php"; 
						}
						else 
						{
							$loginFormContent = "PHP/view/loginFormContent.php"; 
						}
						$slideshow = "PHP/view/Intro/SlideshowV2.php";
                                                  
						$notFoundContent = null;
						$footer="PHP/view/footer.php"; 
						include("master.php");
						break;
						
					case "contacts":
						$style = "PHP/view/Contacts/ContactsStyle.php";
						$header = "PHP/view/Header.php";
				
						if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
						{ 
							$loginFormContent = "PHP/view/loggedUserMenu.php"; 
						}
						else 
						{
							$loginFormContent = "PHP/view/loginFormContent.php"; 
						}
				
						$slideshow = null;
						$userProfile = null;
						$payments = null;
						$orders = null;
                                                $contacts = "PHP/view/Contacts/Contacts.php";
						$notFoundContent ="PHP/view/content-not-found.php";
						$footer="PHP/view/footer.php"; 
						include("master.php");
						break;
                                                
                                        case "registration": 
                                                
                                                //modulo di registrazione già inviato
                                                if(isset($_REQUEST["confirmFlag"]) && $_REQUEST["confirmFlag"])
                                                {
                                                    $esit = UserConstructor::makeNewUser();
                                                    $success = null;
                                                    
                                                    if(is_string($esit))
                                                    {
                                                        $success = false;
                                                    }
                                                    else 
                                                    {
                                                        $success = true;
                                                    }
                                                    

                                                    $style = "PHP/view/Contacts/ContactsStyle.php";
                                                    $header = "PHP/view/Header.php";
                                                    
                                                    if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                                    { 
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                                    }
                                                    else 
                                                    {
                                                            $loginFormContent = "PHP/view/loginFormContent.php"; 
                                                    }
                                                    
                                                    $slideshow = null;
                                                    $userProfile = null;
                                                    $payments = null;
                                                    $orders = null;
                                                    $registrations = "PHP/view/RegistrationAndForgotPSWD/registrationEnding.php"; //comprende la pagina dell'esito
                                                    $contacts = null;
                                                    $notFoundContent ="PHP/view/content-not-found.php";
                                                    $footer="PHP/view/footer.php"; 
                                                    include("master.php");
                                                    break;
                                                    
                                                }//modulo di registrazione da compilare
                                                else
                                                {
                                                    $style = "PHP/view/Contacts/ContactsStyle.php";
                                                    $header = "PHP/view/Header.php";

                                                    if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                                    { 
                                                            $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                                    }
                                                    else 
                                                    {
                                                            $loginFormContent = "PHP/view/loginFormContent.php"; 
                                                    }
                                                    $slideshow = null;
                                                    $userProfile = null;
                                                    $payments = null;
                                                    $orders = null;
                                                    $registrations = "PHP/view/RegistrationAndForgotPSWD/Registrations.php";
                                                    $contacts = null;
                                                    $notFoundContent ="PHP/view/content-not-found.php";
                                                    $footer="PHP/view/footer.php"; 
                                                    include("master.php");
                                                }
                                                                                                
                                            break;
                                            
                                    case "forgotPassword":
                                            
                                            if(isset($_REQUEST["confirmFlag"]) && $_REQUEST["confirmFlag"])
                                            {
                                                $userid = $_REQUEST['userID'];
                                                $nome = $_REQUEST['nome'];
                                                $cognome = $_REQUEST['cognome'];
                                                $DDN = $_REQUEST["dataNascita"];
                                                $email = $_REQUEST["email"];
                                                $cellulare = $_REQUEST["cellulare"];

                                                $success = null;
                
                                                if( !is_string(@SendMail::checkAuthorization($userid, $nome, $cognome, $DDN, $email, $cellulare))) //NB: viene usato l'operatore di silence per
                                                {                                                                                                  //nascondere il fatto che il server smtp
                                                    if(!is_string(@SendMail::forgotPassword($userid)))                                             //non è configurato
                                                    {
                                                        //se entrambe le funzioni non restituiscono un messaggio d'errore
                                                        $success = true;
                                                    }
                                                }
                                                else
                                                {
                                                    $success = false;
                                                    //elimina i warnings nel caso il server smtp ad'esempio, non sia stato configurato
                                                }
                                                
                                                //carico la schermata d'esito dell'operazione
                                                $style = "PHP/view/Contacts/ContactsStyle.php";
                                                $header = "PHP/view/Header.php";

                                                if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                                { 
                                                        $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                                }
                                                else 
                                                {
                                                        $loginFormContent = "PHP/view/loginFormContent.php"; 
                                                }
                                                $slideshow = null;
                                                $userProfile = null;
                                                $payments = null;
                                                $orders = null;
                                                $registrations = "PHP/view/RegistrationAndForgotPSWD/forgotPasswordEnding.php";
                                                $contacts = null;
                                                $notFoundContent ="PHP/view/content-not-found.php";
                                                $footer="PHP/view/footer.php"; 
                                                include("master.php");
                                                break;
                                            }
                                        
                                            $style = "PHP/view/Contacts/ContactsStyle.php";
                                            $header = "PHP/view/Header.php";

                                            if(isset($_SESSION["loggedIn"]) && $_SESSION[ "loggedIn"])
                                            { 
                                                    $loginFormContent = "PHP/view/loggedUserMenu.php"; 
                                            }
                                            else 
                                            {
                                                    $loginFormContent = "PHP/view/loginFormContent.php"; 
                                            }
                                            $slideshow = null;
                                            $userProfile = null;
                                            $payments = null;
                                            $orders = null;
                                            $registrations = "PHP/view/RegistrationAndForgotPSWD/forgotPassword.php";
                                            $contacts = null;
                                            $notFoundContent ="PHP/view/content-not-found.php";
                                            $footer="PHP/view/footer.php"; 
                                            include("master.php");
                                            break;
                                                
				}
			}
			else 
			{
				include("PHP/view/content-not-found.php");
			}
			
		}
		
	}

?>