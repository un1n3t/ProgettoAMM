
<!-- Compare solo se richiamato, contiene informazioni generiche su ogni immagine -->
<div id="Descriptions"> 

	<!--contiene le immagini di anteprima-->
	<div id="Preview850">
		<img src="<?php echo($describedOBJ -> getPreview850());?>" alt="<?php echo($describedOBJ->getDescrizione());?>"> 
	</div>
	
	<!--contiene la descrizione dell'immagine -->
	<div id="DescrIMG">

		<!-- chiude la finestra -->
		<button name="chiudi" type="button" class="closingButton" onclick="javascript:chiudi();">Chiudi</button>
                <button name="chiudi" type="button" class="closingButton" onclick="javascript:fullScreenView();">FullScreen</button>
		<button name="chiudi" type="button" id="restore" class="closingButton" onclick="javascript:restore();">Ripristina</button>
                
		<!-- contiene i dettagli descrittivi dell'immagine -->
		<article id="descrizioneImmagine">
                    <header id="presentation">
                            <h1>'<?php echo($describedOBJ -> getTitolo());?>'   by  </h1>
                            <h2><?php echo($describedOBJ -> getAutore());?></h2>
                    </header>
                    <section id="descrizioneTestuale">
                        <h3>Descrizione:</h3>
                        <p>
                                 <?php echo($describedOBJ -> getDescrizione())?>
                        </p>

                        <ul id="otherData">
                                <li><h3>Data di scatto:</h3> </li>
                                <li><h3>Attrezzatura fotografica:</h3> </li>
                                <li><h3>Dimensioni in pixel:</h3></li>
                                <li><h3>Informazioni extra:</h3> </li>
                                <li><h3>Prezzo:</h3> </li>
                        </ul>
                    </section>
		</article>
	</div>
	
	<!-- Elenca i formati disponibili per ogni immagine -->
	<div id="formati">
              <?php
                    //$formatiImmagine adsso è un array associativo con le informazioni necessarie sui formati prenotabili
                    $formatiImmagine = $describedOBJ -> getFormati();
                    
                    $quantity = Array(); //tiene traccia delleq auntità disponibili per ogni formato
                    
                    $quantity[] = $formatiImmagine -> getOnlineFormat();
                    $quantity[] = $formatiImmagine -> getGalleryFormat1();
                    $quantity[] = $formatiImmagine -> getGalleryFormat2();
		?>
		
		<form	 action="index.php?page=works&amp;subpage=payment&amp;imageID=<?php echo($describedOBJ->getID())?>"	 method="post">	
			<input	 type="checkbox"	 name="formats[]"	 value="online"	 />Formato Online ad alta risoluzione( >= 1920x1080): <?php echo(" ".$formatiImmagine -> getOnlineFormat()."  disponibili"); echo("<br />");?> 		
			<?php 
                        if($quantity[1]<= 0)
                        {?>
                            <input type="checkbox" name="formats[]" value="<?php echo("null");?>"/> <?php echo("Formato Galleria Piccolo(90x160 cm) non disponibile");  echo("<br />");}
                        else 
                        {?>
                            <input type="checkbox" name="formats[]" value="gallery1"/>  <?php echo("Formato Galleria Piccolo(90x160 cm):"); echo(" ".$formatiImmagine -> getGalleryFormat1()."  disponibili"); echo("<br />"); }?>    		
			
                        <?php if($quantity[2]<= 0)
                        {?>
                            <input type="checkbox" name="formats[]" value="<?php echo("null");?>"/> <?php echo("Formato Galleria Esteso(100x200 cm) non disponibile"); echo("<br />");}
                        else 
                        {?> 
                            <input type="checkbox" name="formats[]" value="gallery2"/> <?php echo("Formato Galleria Esteso(100x200 cm):"); echo(" ".$formatiImmagine -> getGalleryFormat2()." disponibili"); echo("<br />"); }?> 	
		
			<nav id="BuyingBar">
                            <ul>
                                <li><button class="navButton"  type="submit" value="Submit" onclick="submit">Acquista Subito!</button></li>
                                <li><button class="navButton"  type="button" onclick="javascript:chiudi();">Informazioni per l'acquisto</button></li>
                                <li><button class="navButton"  type="button" onclick="javascript:chiudi();">Informazioni sull'autore</button></li>
                                 <?php
                                    if(isset($_SESSION["admin"]) && $_SESSION["admin"])
                                    {
                                        echo('<li><a href="index.php?page=loggedUsers&amp;subpage=null&amp;administration=Articles&article_ID='.$describedOBJ->getID().'"> <button type="button">Modifica</button></a></li>');
                                    }
                                ?>

                            </ul>
                        </nav>
                </form>            
		
	</div>
	
		
	</div>