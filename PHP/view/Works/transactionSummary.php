<section class="elenchi">			
	<header>
		<h1 class="titles">Riepilogo</h1>
	</header>
	
	
	<div id="elenco">
		<section class="payments, shipments">
			<h2>Dati per la spedizione</h2>
			<ul class="Virtual-ID">
				<li><?php echo("Nome destinatario: "); echo($userOBJ->getNome()) ?> </li>
				<li><?php echo("Cognome destinatario: "); echo($userOBJ->getCognome()) ?></li>
				<li><?php echo("Città: "); echo($userOBJ->getCittà()) ?></li>
				<li><?php echo("CAP: "); echo($userOBJ->getCAP()) ?></li>
				<li><?php echo("Indirizzo: "); echo($userOBJ->getIndirizzo()) ?></li>
				<li><?php echo("Cellulare: "); echo($userOBJ->getCellulare()) ?></li>
			</ul>
		</section>
		
            
                <?php
                    if(isset($creditCard))
                    {
                        if(isset($creditCardContent))
                        {
                            include($creditCardContent);
                        }
                    }
                    else if(isset($ibanOBJ))
                    {
                        if(isset($ibanContent))
                        {
                            include($ibanContent);
                        }
                    }

                    if(isset($success) && isset($esito))
                    {
                        if($success)
                        {
                            echo("Congratulazioni transazione eseguita correttamente");
                        }
                        else 
                        {
                            echo("Errore: "); echo($esito);
                        }
                    }
                ?>
		
                <a href="index.php?page=index">
                   <button class="confirm, endTransiction" type="button" name="login">Conferma</button>
                </a>
	</div>
</section>
		
