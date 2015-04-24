<section id="Contacts">
    <div id="About-Container">
        <header>
            <?php
                
                if(isset($success) && $success) { echo ('<h1 class="forgotTitlesBIG">Procedura completata con successo</h1>'); }
                else { echo ('<h1 class="forgotTitlesBIG">Errore nella procedura</h1>'); } ?>
        </header>

        <section id="warnings">
            <p>
              <?php 
                if(isset($success) && $success)
                {
                    echo("Riceverai a breve un'email contenten un link per il reset della password. In caso di problemi controlla nella cartella SPAM.");
                               
                }
                else
                {
                    echo("Si è verificato un errore durante la procedura di registrazione. Prova a ricompilare il form avendo cura di verificare i dati immessi. Se il problema persiste");
                    echo('<a href="index.php?page=contacts">'); echo(" contatta l'assistenza. </a>");
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
                                echo('<li><a href="index.php?page=index"><button class="confirm">Continua</button></a></li>');
                            }
                            else
                            {
                                echo('<li><a href="index.php?page=index"><button>'."Torna indietro"."</button></a></li>");
                            }
                        ?>
                    </ul>
            </nav>
        </footer>
			
		
    </div>
</section>
   
