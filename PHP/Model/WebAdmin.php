<?php

    include_once("PHP/Model/User.php");

    class WebAdmin extends User
    {

        public function __construct($idUtente, $password, $email, $nome, $cognome, $ruolo)
        {
                parent:: __construct($idUtente, $password, $email, $nome, $cognome, $ruolo);	

        }

    } 
    
?>
