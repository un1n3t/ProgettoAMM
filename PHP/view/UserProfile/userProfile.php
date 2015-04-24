
<section id="SezioniUtente">
	<div id="Data-Container">
		<article>
			
			<header>
				<h1>Profilo Utente</h1>
			</header>
			
                        <?php 
                        if ( $userOBJ instanceof AuthenticatedUser)
                        {
                            echo('<a href="index.php?page=loggedUsers&amp;subpage=deleteProfile">'
                                    . '<img id="DeleteProfile" src="images/DeleteProfile.png" alt="Cancella il profilo">'
                                .'</a>');
                        }
                        ?>
			
                            
                        
							
			<section id="User-data">
				<ul class="Virtual-ID">
					<li><?php echo("User-ID: "); echo($userOBJ->getID()); ?> </li>
					<li><?php echo("Password: "); echo($userOBJ->getPassword())?></li>
					<li><?php echo("Email: "); echo($userOBJ->getEmail()); ?> </li>
				</ul>
				<ul class="Anagrafica">
					<li><?php echo("Nome: "); echo($userOBJ->getNome()) ?> </li>
					<li><?php echo("Cognome: "); echo($userOBJ->getCognome()) ?></li>
                                        <li><?php echo("Città: "); if ( $userOBJ instanceof AuthenticatedUser) { echo($userOBJ->getCittà()); } ?></li>
                                        <li><?php echo("CAP: "); if ( $userOBJ instanceof AuthenticatedUser) { echo($userOBJ->getCAP()); }?></li>
                                        <li><?php echo("Indirizzo: "); if ( $userOBJ instanceof AuthenticatedUser) { echo($userOBJ->getIndirizzo()) ;} ?></li>
                                        <li><?php echo("Cellulare: "); if ( $userOBJ instanceof AuthenticatedUser) { echo($userOBJ->getCellulare()); } ?></li>
				</ul>
			</section>
			
			<section id="AcquistiRecenti">
				<h2> Acquisti recenti </h2>
				<ul>
					<li><img src="images/preview250/after.jpg" alt=""></li>
					<li><img src="images/preview250/beach2.jpg" alt=""></li>
					<li><img src="images/preview250/boy.jpg" alt=""></li>
					<li><img src="images/preview250/glass.jpg" alt=""></li>
					<li><img src="images/preview250/room.jpg" alt=""></li>
				</ul>
			</section>

			
			
			<?php include($footerMenu) ?>
			
		</article>
	</div>
</section>
		
			