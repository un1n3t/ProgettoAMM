
<section id="MainView">
    <div id="Data-Container">
        <header>
            <?php include($adminMenu); //include il menù di navigazione della sezione per l'admin?>
            <h1 class="presentationTitle1">Tabella Utenti</h1>
            <h2 class="presentationTitle2">La tabella mostra tutti gli utenti attualmente registrati nella piattaforma.
                I dati possono essere modificati ridefinendo il valore del singolo campo e premendo il tasto Modifica(<img src="images/Icons/configuration_edit.png" alt="Modifica" width="24" height="24">) per la conferma.
                Premendo il tasto Elimina(<img src="images/Icons/120px-Icon-trash.png" alt="Modifica" width="24" height="24">) si eliminerà l'intera colonna.
                Tramite il tasto [+] di fronte alle singole voci si accederà ad una schermata relativa al campo selezionato.
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
            
            <!-- i dati contenuti nella tabella HTML, che rappresenta l'esatta tabella del DB, possono essere modificati -->
                    <table id = "usersTable">
                        <tr>
                            <th>
                                #Row
                            </th>
                            <th>
                                userid
                            </th>
                            <th>
                                password
                            </th>
                            <th>
                                email
                            </th>
                            <th>
                                nome
                            </th>
                            <th>
                                cognome
                            </th>
                            <th>
                                dataDiNascita
                            </th>
                            <th>
                                città
                            </th>
                            <th>
                                cap
                            </th>
                            <th>
                                indirizzo
                            </th>
                            <th>
                                cellulare
                            </th>
                            <th>
                                cartaDIcredito
                            </th>
                            <th>
                                IBAN
                            </th>
                            <th>
                                Modifica
                            </th>
                        </tr>

                        <?php
                            $j=0;
                            while($row = $usersList->fetch_row())
                            {
                                $userID = $row[0];
                                echo('<form  action="index.php?page=loggedUsers&amp;subpage=null&amp;administration=users" method="post">');
                                    echo('<fieldset  id="usersData">');    
                                        echo('<tr>');
                                            echo('<td><input class="rowNumber" name="rowNumber" type="text" value="'.$j.'" readonly></td>');
                                            echo('<input name="userid" type="hidden" value="'.$userID.'" readonly>');
                                            echo('<td><input class="singleInfo" name="newUserID" type="text" value ="'.$row[0].'"></td>');
                                            echo('<td><input class="singleInfo" name="password" type="password" value ="'.$row[1].'"></td>');
                                            echo('<td><input class="singleInfo" name="email" type="text" value ="'.$row[2].'"></td>');
                                            echo('<td><input class="singleInfo" name="nome" type="text" value ="'.$row[3].'"></td>');
                                            echo('<td><input class="singleInfo" name="cognome" type="text" value ="'.$row[4].'"></td>');
                                            echo('<td><input class="singleInfo" name="dataNascita" type="text" value ="'.$row[5].'"></td>');
                                            echo('<td><input class="singleInfo" name="citta" type="text" value ="'.$row[6].'"></td>');
                                            echo('<td><input class="singleInfo" name="CAP" type="text" value ="'.$row[7].'"></td>');
                                            echo('<td><input class="singleInfo" name="indirizzo" type="text" value ="'.$row[8].'"></td>');
                                            echo('<td><input class="singleInfo" name="cellulare" type="text" value ="'.$row[9].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Payments&amp;CCnumber='.$row[11].'&amp;IBAN=nulll">[+]</a><input class="singleInfo" name="CC" type="text" value ="'.$row[11].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Payments&amp;IBAN='.$row[12].'&amp;CCnumber=null">[+]</a><input class="singleInfo" name="IBAN" type="text" value ="'.$row[12].'"></td>');
                                            echo('<input name="action" type="hidden" value="updateData" readonly>');
                                             echo('<td><button class="modify"  type="submit" name="action" value="updateData"><img src="images/Icons/configuration_edit.png" alt="Modifica"></button>'
                                                    .'<button class="delete" type="submit" name="action" value="delete"><img src="images/Icons/120px-Icon-trash.png" alt="Elimina"></button></td>');
                                        echo("</tr>");
                                    echo('</fieldset>');
                                echo('</form>');
            
                                $j++;
                            }
                        ?>
                    </table>
             
        </section>
    </div>
</section>
		
			