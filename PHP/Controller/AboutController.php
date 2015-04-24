<?php
	class AboutController
	{
		public function __construct(&$request, &$session)
		{
			$this -> handle_input($request, $session);
		}
		
		
		private function handle_input(&$request, &$session)
		{
			if($request["subpage"] == "about")
			{
				$style = "PHP/view/About/AboutStyle.php";
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
				$about = "PHP/view/About/about.php";
                                $registration = "PHP/view/RegistrationContent.php";
				$services = null;
				$userProfile = null;
				$payments = null;
				$orders = null;
				$footer="PHP/view/footer.php"; 
				include("master.php");
			}
			else if($request["subpage"] == "services")
			{
				$style = "PHP/view/About/AboutStyle.php";
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
				$about = null;
                                $registration = "PHP/view/RegistrationContent.php";
				$services ="PHP/view/About/Services.php";
				$userProfile = null;
				$payments = null;
				$orders = null;
				
				
				$footer="PHP/view/footer.php"; 
				include("master.php");
			}
			else 
			{
				include("PHP/view/content-not-found.php");
			}
			
		}
		
	}

?>