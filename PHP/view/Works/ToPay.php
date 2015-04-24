

<!-- Quasi come una master.php, questa vista è popolata dinamicamente in base allo step successivo della transazione per il pagamento -->
<?php $IMGid = $describedOBJ -> getID(); ?>
		

<!-- Contiene un quadro di riepilogo per ogni gli step della transazione -->
<div id="Descriptions">  

	<!-- Contiene un quadro riassuntivo delle informazioni sulla transazione -->
	<div id="Transazione">
		<?php if(isset ($SecondaryLoginForm)) include($SecondaryLoginForm); ?> <!-- Step 0: utente non loggato -->
		
		<?php if(isset ($summaryPayments)) include($summaryPayments); ?> <!-- Step 1: utente autenticato e selezione del metodo di pagamento -->
		
		<?php if(isset ($shipments)) include($shipments); ?> <!-- Step 2: selezione del metodo di spedizione -->
                
                <?php if(isset ($transactionSummary)) include($transactionSummary); ?> <!-- Step 3: riepilogo e conferma dei dati -->
		
	</div>
	
	<!-- contiene informazioni riassuntive sull'immagine da acquistare -->
	<div id="RiepilogoVisuale">

		<!-- chiude la finestra -->
		<button name="chiudi" type="button" class="closingButton" onclick="javascript:chiudi();">Chiudi</button>
                <button name="chiudi" type="button" class="closingButton" onclick="javascript:fullScreenView();">FullScreen</button>
		<button name="chiudi" type="button" id="restore" class="closingButton" onclick="javascript:restore();">Ripristina</button>
		
		<!-- contiene i dettagli descrittivi dell'immagine -->
		<article id="descrizioneImmagine">
			<header id="presentation">
				<h1><?php echo($describedOBJ -> getTitolo());?>   by  </h1>
				<h2><?php echo($describedOBJ -> getAutore());?></h2>
			</header>
			
			<section id="previewImmagine">
				<img src="<?php echo($describedOBJ -> getPreview850());?>" alt="<?php echo($describedOBJ->getDescrizione());?>"> 
			</section>
			
			<section id="riepilogoAcquisto">
				<h1>Riepilogo acquisto:</h1>
				
				<div id="formatiIMG">
					<h2>Formati Selezionati</h2>
					<ul>
				
						<?php 
							if(isset($formati["online"]) && $formati["online"]) 
							{?>
								<li><?php  echo("Formato online (High Res.)")?></li>
						<?php }
							if(isset($formati["gallery1"]) && $formati["gallery1"]) 
							{?>
								<li><?php echo("Formato galleria piccolo(90x160 cm)")?></li>
						<?php }
							if(isset($formati["gallery2"]) && $formati["gallery2"]) 
							{?>
								<li><?php echo("Formato galleria grande (100x200 cm)")?></li>
						<?php }?>
					</ul>
				</div>
				
				<div id="AdditionalInfo">
					<section id="prezzo">
						<h2>Prezzo:</h2>
						<ul>
							<li><?php echo($riepilogoOrdine -> getTotalImport())?>€</li>
						</ul>
					</section>
					
					<section id="spedizione">
						<h2>Metodo di spedizione:</h2>
						<ul>
							<li>Corriere Espresso</li>
						</ul>
					</section>
					
				</div>
			
			</section>
		</article>
	</div>
</div>
