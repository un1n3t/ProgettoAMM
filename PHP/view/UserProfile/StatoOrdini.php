<section id="SezioniUtente">
    <div id="Data-Container">
        <header>
            <h1>Stato Ordini</h1>
        </header>

        <div id="elenco">
            <!-- La pagina si popola dinamicamente in relazione al contenuto del Database Ordini -->
            <?php

                if($userOBJ instanceof WebAdmin)
                {
                    echo("<p> Per visualizzare gli ordini effettuati dall'utente esegui l'accesso all'interno della sezione apposita nel pannello di controllo </p>");
                    echo('<a href="index.php?page=loggedUsers&subpage=null&administration=Orders"> <button type="button" class="Next">Continua</button></a>');
                }


                if(isset($ordini) && (count($ordini)-1) >0)
                {

                    echo('<section class="orders">');
                    for($i=1; $i <= count($ordini)-1; $i++)
                    {
                        $additionalInfo = TransactionHandler::retrieveMoreOrdersInfo($ordini[$i]->getOrderID());
                        echo('<h2>Ordine <a>#'.$ordini[$i]->getOrderID().'</a></h2>');
                        echo('<ul class="Virtual-ID">');
                            echo('<li>Ordine effettuato il: '.$ordini[$i]->getDataPagamento().'</li>');
                            echo('<li>Totale: '.$ordini[$i]->getTotalImport().'</li>');
                            echo("<li>Inviato a: ".$additionalInfo -> nome." ".$additionalInfo -> cognome."</li>");
                            echo('<li>Indirizzo completo: '.$additionalInfo -> indirizzo.'</li>');
                            echo('<li>Stato ordine: '.$ordini[$i]->getStatus().'</li>');
                        echo("</ul>");
                    }
                    echo('</section>');
                }
                else
                {
                    echo("Non è ancora stato effettuato un ordine\n"); 
                    echo("Se non sai come effettuare un ordine ");
                    echo('<a href="index.php?page=contacts">Richiedi Assistenza </a>');
                }
            ?>    

            <div id="ordersInfo">
                <?php

                    if($userOBJ instanceof AuthenticatedUser)
                    {
                        echo("<h1> Attenzione: </h1>"
                           . "<p>Per richiedere informazioni sull'ordine invii una mail tramite form di contatto, specificando il codice ordine. Otterrà risposta entro 24h.</p>");
                    }   
                ?>  
            </div>
        </div>

        <?php include($footerMenu) ?>
    </div>
    
</section>