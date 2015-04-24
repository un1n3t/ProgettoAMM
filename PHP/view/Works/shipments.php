<section class="elenchi">			
	<header>
		<h1 class="titles">Dati spedizione</h1>
	</header>
	
	
	<div id="elenco">
		<section class="payments, shipments">
			<h2>Indirizzo di spedizione</h2>
			<ul class="Virtual-ID">
				<li><?php echo("Nome: "); echo($userOBJ->getNome()) ?> </li>
				<li><?php echo("Cognome: "); echo($userOBJ->getCognome()) ?></li>
				<li><?php echo("Città: "); echo($userOBJ->getCittà()) ?></li>
				<li><?php echo("CAP: "); echo($userOBJ->getCAP()) ?></li>
				<li><?php echo("Indirizzo: "); echo($userOBJ->getIndirizzo()) ?></li>
				<li><?php echo("Cellulare: "); echo($userOBJ->getCellulare()) ?></li>
			</ul>
		</section>
		
		<section class="payments, shipments">
			<h2>Metodi di spedizione</h2>
			<form  action="index.php?page=works&subpage=summary&imageID=<?php echo($IMGid)?>" method="post">
				<input	 type="radio"	 name="EspressoSTD"	 value="EspressoSTD" />Corriere Espresso(Standard) - Consegna da 3 a 6 gg lavorativi (35€) <br/>		
				<input	 type="radio"	 name="EspressoRapid"	 value="EspressoRapid"	 />Corriere Espresso(Rapida) - Consegna da 1 a 3 gg lavorativi (70€)<br/>		
				
				<button class="confirmButton" name="Acquista"  type="submit"	 value="Submit" onclick="submit">Conferma</button>
			</form>

		</section>
                
                <section class="shipments">
                    <ul id="opzioni">
                        <li><a href="#">Vedi il contratto per le spedizioni</a> | </li>
                        <li><a href="#">Vedi le politiche di reso</a></li>
                    </ul>
                </section>
	</div>
</section>
		
