
<section id="SezioniUtente">
	<div id="Data-Container">
		<article>
			
			<header>
                            <?php 
                            if (isset($success) && $success)
                                echo("<h1>Operazione avvenuta con successo</h1>");
                            else if (!$success)
                                echo("<h1>Errore nell'operazione</h1>");
                            ?>
			</header>
			
			<section id="warnings">
                            <p>
                              <?php 
                                if (isset($success) && $success)
                                {
                                    echo("Il tuo profilo è stato rimosso con successo. Tutte le informazioni memorizzate, eccetto quelle relative agli ordini effettuati, sono state eliminate");
                                }
                                else if (!$success)
                                {
                                    echo("Si è verificato un errore durante la procedura di cancellazione. Per ulteriore assistenza ");
                                    echo('<a href="index.php?page=contacts"> contattatci </a>');
                                    echo("riportando nel modulo apposito, il codice d'errore.\n");
                                    
                                    echo("COD ERRORE: \n");
                                    echo($esito);
                                    
                                }    
                              ?>    
                            </p>    
				
			</section>
			
			
			<footer>
				<nav class="innermenùs">
					<ul>
                                            <?php 
                                                if (isset($success) && $success)
                                                {
                                                    echo('<li><a href="index.php?page=index"><button class="confirm">Prosegui</button></a></li>');
                                                }
                                                else if (!$success)
                                                {
                                                    echo('<li><a href="index.php?page=contacts"><button class="confirm">Prosegui</button></a></li>');
                                                }
                                            ?>
					</ul>
				</nav>
			</footer>
			
		</article>
	</div>
</section>
		
			