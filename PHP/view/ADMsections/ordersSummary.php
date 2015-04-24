
<section id="MainView">
    <div id="Data-Container">
        <header>
            <?php include($adminMenu); //include il menù di navigazione della sezione per l'admin?>
            <h1 class="presentationTitle1">Tabella Ordini</h1>
            <h2 class="presentationTitle2">La tabella un riepilogo degli ordini registrati all'interno del database.
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
                                IDordine
                            </th>
                            <th>
                                userID
                            </th>
                            <th>
                                IDarticolo
                            </th>
                            
                            <th>
                                numeroCarta
                            </th>
                            <th>
                                IBAN
                            </th>
                            <th>
                                Importo
                            </th>
                            <th>
                                Data di Pagamento
                            </th>
                            <th>
                                Stato dell'ordine
                            </th>
                            <th>
                                F:Online(high. res)
                            </th>
                            <th>
                                F:Galleria(piccolo)
                            </th>
                            <th>
                                F:Galleria(grande)
                            </th>
                            <th>
                                Modifica
                            </th>
                        </tr>

                        <?php
                            $j=0;
                            while($row = $ordersList->fetch_row())
                            {
                                $orderID = $row[0];
                                
                                //FOnline è true se è stato richiesto il formato online high. res
                                if ($row[8] == 1)
                                {
                                    $fonline = "SI";
                                }
                                else 
                                {
                                    $fonline = "NO";
                                }
                                
                                //FGalleria1 è true se è stato richiesto il formato galleria piccolo
                                 if ($row[9] == 1)
                                {
                                    $fGalleria1 = "SI";
                                }
                                else 
                                {
                                    $fGalleria1 = "NO";
                                }
                                //FGalleria2 è true se è stato richiesto il formato galleria grande
                                 if ($row[10] == 1)
                                {
                                    $fGalleria2 = "SI";
                                }
                                else 
                                {
                                    $fGalleria2 = "NO";
                                }
                                
                                echo('<form  action="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Orders" method="post">');
                                    echo('<fieldset  id="usersData">');    
                                        echo('<tr>');
                                            echo('<td><input class="rowNumber" name="rowNumber" type="text" value="'.$j.'" readonly></td>');
                                            echo('<input name="orderID" type="hidden" value="'.$orderID.'" readonly>');
                                            echo('<td><input class="singleInfo" name="newOrderID" type="text" value ="'.$row[0].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&subpage=null&administration=users&user_ID='.$row[2].'">[+]</a><input class="singleInfo" name="userID" type="text" value ="'.$row[2].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&subpage=null&administration=Articles&article_ID='.$row[1].'">[+]</a><input class="singleInfo" name="articleID" type="text" value ="'.$row[1].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&subpage=null&administration=Payments&CCnumber='.$row[3].'&IBAN=nulll">[+]</a><input class="singleInfo" name="CC" type="text" value ="'.$row[3].'"></td>');
                                            echo('<td><a href="index.php?page=loggedUsers&subpage=null&administration=Payments&IBAN='.$row[4].'&CCnumber=null">[+]</a><input class="singleInfo" name="IBAN" type="text" value ="'.$row[4].'"></td>');
                                            echo('<td><input class="singleInfo" name="import" type="text" value ="'.$row[6].'"></td>');
                                            echo('<td><input class="singleInfo" name="paymentDate" type="date" value ="'.$row[5].'"></td>');
                                            echo('<td><input class="singleInfo" name="orderStatus" type="text" value ="'.$row[7].'"></td>');
                                            echo("<td>".$fonline.'<input class="singleInfo" name="fOnline" type="hidden" value ="'.$row[8].'"></td>');
                                            echo("<td>".$fGalleria1.'<input class="singleInfo" name="fGalleria1" type="hidden" value ="'.$row[9].'"></td>');
                                            echo("<td>".$fGalleria2.'<input class="singleInfo" name="fGalleria2" type="hidden" value ="'.$row[10].'"></td>');
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
		
			