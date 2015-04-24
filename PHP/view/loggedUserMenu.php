<section>
	<div id="forLoggedUser">
            <p id="welcome">Benvenuto<?php echo(" ".$_SESSION["nome"]." "); echo($_SESSION["cognome"]);?> </p>
            <nav id="Logged-Menù">
                    <ul>
                            <li><a href="index.php?page=loggedUsers&amp;subpage=profile">Profilo</a></li>
                            <li> | </li>
                            <li><a href="index.php?page=loggedUsers&amp;subpage=orders">I miei ordini</a></li>
                            <li> | </li>
                            <li><a href="index.php?page=log-in&amp;logout=true"> Esci</a></li>
                    </ul>
            </nav>	
	</div>
</section>