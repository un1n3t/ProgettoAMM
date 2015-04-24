
<section id="MainView">
    <div id="Data-Container">
        <header>
            <?php include($adminMenu); //include il menù di navigazione della sezione per l'admin?>
            <h1 class="presentationTitle1">Tabella Metodi di Pagamento</h1>
            <h2 class="presentationTitle2">La tabella mostra un riepilogo di tutti i metodi di pagamento registrati all'interno del database,
                associando i dati a nome, cognome e userid, dell'utente che li ha registrati.
                I dati possono essere modificati ridefinendo il valore del singolo campo e premendo il tasto Modifica(<img src="images/Icons/configuration_edit.png" alt="Modifica" width="24" height="24">) per la conferma.                Tramite il tasto [+] di fronte alle singole voci si accederà ad una schermata relativa al campo selezionato.
            </h2>
                       
            <?php
         
            if(isset($esit) && is_bool($esit) && $esit)
            {
                $COLUMN_ID = $_POST["rowNumber"];
                echo('<h3 class="presentationTitle3">');
                    echo("Colonna #$COLUMN_ID modificata con successo");
                echo("</h3>");
            }
            else if(isset($esit) && is_string($esit))
            {
                echo('<h3 class="presentationTitle3">');
                    echo($esit);
                echo("</h3>");
            }
            
            ?>
                                         
            
        </header>

        <section id="brief"> <!-- include i risultati delle query riservate all'amministratore -->
            
            <?php 
                $row = $PayMethodsList->fetch_row();
                
                $intestatarioCC = false;
                $intestatarioIBAN = false;
                
                
                //se l'intestatario non è l'utente che ha registrato il metodo di pagamento..
                if( ( strtolower($row[6]) != strtolower($row[1])) OR (strtolower($row[7]) != strtolower($row[2]) ))
                {
                    $intestatarioCC = true;
                }
                
                
                if( (strtolower($row[9]) != strtolower($row[1])) OR ( strtolower($row[10]) != strtolower($row[2])) )
                {
                    $intestatarioIBAN = true;
                }    
                
                
            ?>
                
                
          
            <!-- i dati contenuti nella tabella HTML, che rappresenta l'esatta tabella del DB, possono essere modificati -->
                    <table id="paymentsTable">
                        <tr>
                            <th>
                                #Row
                            </th>
                            <th>
                                userID
                            </th>
                            <th>
                                Nome
                            </th>
                            <th>
                                Cognome
                            </th>
                            <th>
                                Carta di credito
                            </th>
                            <th>
                                CVV2
                            </th>
                            <th>
                                dataScadenza
                            </th>
                            
                            <?php 
                            if($intestatarioCC)
                            {
                                echo("<th>Nome Intestatario</th>");
                                echo("<th>Cognome Intestatario</th>");
                            }
                            ?>
                            <th>
                                IBAN
                            </th>
                            <?php 
                            if($intestatarioIBAN)
                            {
                                echo("<th>Nome Ordinante</th>");
                                echo("<th>cognome Ordinante</th>");
                            }
                            ?>
                            <th>
                                Modifica
                            </th>
                        </tr>
                        

                        <?php
                        
                            $i=0;
                            $j=0;
                            while($i <= count($row)%$PayMethodsList->field_count)
                            {
                                $CC = $row[3];
                                $IBAN = $row[8];
                                
                                echo('<form  action="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Payments&amp;CCnumber=null&amp;IBAN=null" method="post">');
                                    echo('<fieldset  id="usersData">');    
                                        echo('<tr>');
                                            echo('<td><input class="rowNumber" name="rowNumber" type="text" value="'.$i.'" readonly></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&subpage=null&administration=users&user_ID='.$row[0].'">[+]</a><input class="singleInfo" name="userID" type="text" value ="'.$row[0].'" readonly></td>');
                                            echo('<td><input class="singleInfo" name="nome" type="text" value ="'.$row[1].'" readonly></td>');
                                            echo('<td><input class="singleInfo" name="cognome" type="text" value ="'.$row[2].'" readonly></td>');
                                            echo('<input name="CC" type="hidden" value="'.$CC.'" readonly>');
                                            echo('<td><input class="singleInfo" name="newCC" type="text" value ="'.$row[3].'"></td>');
                                            echo('<td><input class="singleInfo" name="CVV2" type="text" value ="'.$row[4].'"></td>');
                                            echo('<td><input class="singleInfo" name="dataScadenza" type="date" value ="'.$row[5].'"></td>');
                                            
                                            if ($intestatarioCC) //se l'intestatario è diverso dall'utente registrato..
                                            {
                                                echo('<td><input class="singleInfo" name="nomeIntestatarioCC" type="text" value ="'.$row[6].'"></td>');
                                                echo('<td><input class="singleInfo" name="cognomeIntestatarioCC" type="text" value ="'.$row[7].'"></td>');
                                            }
                                            else
                                            {
                                                echo('<input class="singleInfo" name="nomeIntestatarioCC" type="hidden" value ="'.$row[1].'">');
                                                echo('<input class="singleInfo" name="cognomeIntestatarioCC" type="hidden" value ="'.$row[2].'">');
                                            }
                                            
                                            echo('<input name="IBAN" type="hidden" value="'.$IBAN.'" readonly>');
                                            echo('<td><input class="singleInfo" name="newIBAN" type="text" value ="'.$row[8].'"></td>');
                                            
                                            if ($intestatarioIBAN)//se l'intestatario è diverso dall'utente registrato..
                                            {
                                                echo('<td><input class="singleInfo" name="nomeIntestatarioIBAN" type="text" value ="'.$row[9].'"></td>');
                                                echo('<td><input class="singleInfo" name="cognomeIntestatarioIBAN" type="text" value ="'.$row[10].'"></td>');
                                                
                                            }
                                            else
                                            {
                                                echo('<input class="singleInfo" name="nomeIntestatarioIBAN" type="hidden" value ="'.$row[1].'">');
                                                echo('<input class="singleInfo" name="cognomeIntestatarioIBAN" type="hidden" value ="'.$row[2].'">');
                                            }
                                            
                                            echo('<td><button class="modify"  type="submit" name="action" value="updateData"><img src="images/Icons/configuration_edit.png" alt="Modifica"></button>');
                                        echo("</tr>");
                                    echo('</fieldset>');
                                echo('</form>');
                           
                            $i++;
                            }
                        ?>
                    </table>
            
                           
        </section>
    </div>
</section>
		
			