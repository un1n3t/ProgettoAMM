<section id="Contacts">
    <div id="About-Container">
        <header>
            <?php
                
                if(isset($success) && $success) { echo ("<h1>Registrazione completata</h1>"); }
                else { echo ("<h1>Errore nella registrazione</h1>"); } ?>
        </header>

        <section id="warnings">
            <p>
              <?php 
                if(isset($success) && $success)
                {
                    echo("Congratulazioni! Hai completato la registrazione del tuo profilo."
                            . "D'ora in poi il tuo profilo sarà attivo e utilizzabile per effettuare ordini all'interno del sito. Ti ricordiamo che è necessario aver impostato almeno un metodo"
                            . " di pagamento per poter effettuare un ordine e che qualora avessi bisogno di assistenza puoi utilizzare l'apposito form nella pagina <contacts>. E' importante "
                            . " ,inoltre, sapere che la procedura di recupero della password, in caso di smarrimento, fa utilizzo dell'email indicata in fase di registrazione; <em> tutela"
                            . " entrambe le credenziali correlate al sito, con la massima prudenza </em>.");
                               
                }
                else
                {
                    echo("Si è verificato un errore durante la procedura di registrazione. Prova a ricompilare il form avendo cura d'immettere i dati con gli spazi strettamente necessari."
                            . "Se il problema persiste, ");
                    echo('<a href="index.php?page=contacts">'); echo("contatta l'assistenza: </a> riportando nel modulo apposito, il codice d'errore.");
                    echo("\nCOD ERRORE:"); echo($esit);

                }    
              ?>    
            </p>    
				
        </section>
			
			
        <footer>
            <nav class="innermenùs">
                    <ul>
                        <?php 
                            if(isset($success) && $success)
                            {
                                echo('<li><button class="confirm" onclick="javascript:location.href="index.php?page=index"">Prosegui</button></li>');
                            }
                            else
                            {
                                echo('<li><button class="confirm" onclick="javascript:location.href="index.php?page=contacts"">'."Contatta l'"."assistenza</button></li>");
                                echo('<li><button class="confirm" onclick="javascript:location.href="index.php?page=index"">'."Torna indietro"."</button></li>");
                            }
                        ?>
                    </ul>
            </nav>
        </footer>
			
		
    </div>
</section>
   
