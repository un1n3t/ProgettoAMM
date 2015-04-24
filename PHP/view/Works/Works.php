<!-- Corpo della pagina -->
<section id="Works">
    
    
	<?php $allPictures = $raccoltaImmagini -> getAllImages(); //istanzia un array con tutti gli oggetti Immagine contenuti nella raccolta ?>
	
	<!-- Quadro espositivo relativo alle singole immagini -->
	<?php if(isset ($preview850)) include($preview850); ?>
	
	
	<!-- Quadro espositivo con le anteprime 250x250 px -->
	<?php if(isset ($preview250)) include($preview250); ?>
	
	
	<!-- Riquadro acquisti, se l'utente è loggato -->
	<?php if(isset ($ToPay)) include($ToPay); ?>
</section>
