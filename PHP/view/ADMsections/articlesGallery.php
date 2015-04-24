
<section id="MainView">
    <div id="Data-Container">
        <header>
            <?php include($adminMenu); //include il menù di navigazione della sezione per l'admin?>
            <h1 class="presentationTitle1">Tabella Articoli</h1>
            <h2 class="presentationTitle2">La tabella un riepilogo di tutte le immagini registrate all'interno del database.
                I dati possono essere modificati ridefinendo il valore del singolo campo e premendo il tasto Modifica(<img src="images/Icons/configuration_edit.png" alt="Modifica" width="24" height="24">) per la conferma.
                Premendo il tasto Elimina(<img src="images/Icons/120px-Icon-trash.png" alt="Modifica" width="24" height="24">) si eliminerà l'intera colonna. Tramite il tasto [+] di fronte alle singole voci, infine,
                si accederà ad una schermata relativa al campo selezionato.
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

        <section id="dataTable">
            <div id="brief"> <!-- include i risultati delle query riservate all'amministratore -->
            <!-- i dati contenuti nella tabella HTML, che rappresenta l'esatta tabella del DB, possono essere modificati -->
                    <table id = "usersTable">
                        <tr>
                            <th>
                                #Row
                            </th>
                            <th>
                                ID articolo
                            </th>
                            <th>
                                Autore
                            </th>
                            <th>
                                Titolo
                            </th>
                            <th>
                                Prezzo
                            </th>
                            <th>
                                Descrizione
                            </th>
                            <th>
                                F. Online
                            </th>
                            <th>
                                F. Galleria (piccolo)
                            </th>
                            <th>
                                F. Galleria (grande)
                            </th>
                            <th>
                                Ultima Modifica
                            </th>
                            <th>
                                Visibilità
                            </th>
                            <th>
                                Preview 250px (URL)
                            </th>
                            <th>
                                Preview 850px (URL)
                            </th>
                            <th>
                                Opzioni
                            </th>
                        </tr>

                        <?php
                            $j=1;
                            while($row = $ordersList->fetch_row())
                            {
                                $articleID = $row[0];
                                if($row[8] == 1)
                                {
                                    $visibile = "YES";
                                }
                                else 
                                {
                                    $visibile = "NO";
                                }
                                echo('<form  action="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Articles" method="post">');
                                    echo('<fieldset  id="usersData">');    
                                        echo('<tr>');
                                            echo('<td><input class="rowNumber" name="rowNumber" type="text" value="'.$j.'" readonly></td>');
                                            echo('<input name="articleID" type="hidden" value="'.$articleID.'" readonly>');
                                            echo('<td><input class="singleInfo" name="newArticleID" type="text" value ="'.$row[0].'"></td>');
                                            echo('<td><input class="singleInfo" name="author" type="text" value ="'.$row[1].'"></td>');
                                            echo('<td><input class="singleInfo" name="title" type="text" value ="'.$row[2].'"></td>');
                                            echo('<td><input class="singleInfo" name="price" type="number" value ="'.$row[11].'"></td>');
                                            echo('<td><input class="singleInfo" name="descr" type="text" value ="'.$row[3].'"></td>');
                                            echo('<td><input class="singleInfo" name="fOnline" type="number" value ="'.$row[4].'"></td>');
                                            echo('<td><input class="singleInfo" name="fGalleria1" type="number" value ="'.$row[5].'"></td>');
                                            echo('<td><input class="singleInfo" name="fGalleria2" type="number" value ="'.$row[6].'"></td>');
                                            echo('<td><input class="singleInfo" name="lastMod" type="date" value ="'.$row[7].'"></td>');
                                            echo('<td><input class="singleInfo" name="isVisible" type="text" value ="'.$visibile.'"></td>');
                                            echo('<td><input class="singleInfo" name="preview250" type="text" value ="'.$row[9].'"></td>');
                                            echo('<td><input class="singleInfo" name="preview850" type="text" value ="'.$row[10].'"></td>');
                                            
                                            echo('<td><button class="modify"  type="submit" name="action" value="updateData"><img src="images/Icons/configuration_edit.png" alt="Modifica"></button>'
                                                    .'<button class="delete" type="submit" name="action" value="delete"><img src="images/Icons/120px-Icon-trash.png" alt="Elimina"></button></td>');
                                        echo("</tr>");
                                    echo('</fieldset>');
                                echo('</form>');
                            $j++;
                            }
                        ?>
                    </table>
            </div>
        </section>
        
    </div>
</section>
		
			