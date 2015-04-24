<?php 

define("espressoSTD",35.00);
define("espressoURG",70.00);

include("PHP/Controller/LoginController.php"); //gestisce l'autenticazione
include("PHP/Controller/UserController.php"); //gestisce le pagine dedicate al profilo utente
include("PHP/Controller/OtherSectionsController.php"); //gestisce la index e la pagina contatti
include("PHP/Controller/AboutController.php"); //gestisce le pagine dedicate alla descrizione
include("PHP/Controller/WorksController.php"); //gestisce la sezione di mostra e acquisto merce

include("PHP/Model/AuthenticatedUser.php");



Dispatcher::dispatch($_REQUEST, $msg);

class Dispatcher
{
    public static $counter = 0;
    
	public static function dispatch(&$REQUEST, &$message)
	{
            Dispatcher::$counter++;
		session_start();
		
		if(isset($REQUEST["page"]))
		{
			switch($REQUEST["page"]) 
			{
				
				default: 
						include("PHP/view/content-not-found.php");
						break;
						
				case "index":
						new OtherSectionsController($REQUEST, $_SESSION);
						break;
				
				case "log-in":
						new LoginController($REQUEST, $_SESSION);
						break;
				
				case "loggedUsers":
						new UserController($REQUEST, $_SESSION);
						break;
						
				case "about":
						new AboutController($REQUEST, $_SESSION);
						break;
				
				case "works": 
						new WorksController($REQUEST, $_SESSION);
						break;
				
                                case "registration":  new OtherSectionsController($REQUEST, $_SESSION);
                                                      break;
                                
                                case "forgotPassword": new OtherSectionsController($REQUEST, $_SESSION);
                                                      break;
                                            
				case "contacts":
						new OtherSectionsController($REQUEST, $_SESSION);
						break;
			}
			
		}
		
	}
	
	
	
}

 ?>