<!doctype html>
<html lang="it">
	<head>
		<title>IkStudios Photography</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		
		<?php include($style); ?>
		

		
		
	</head>
	
	<body>
	
		<!-- Div container: include le pagine del sito in un'unica struttura coerente (utilizzato per ridimensionare la pagina automaticamente, con dimensioni espresse in percentuale) -->
		<div id="wrapper">

		<!-- Header -->
		<header>
			
			<!-- Barra di navigazione, parte superiore -->
			<?php include($header); ?>
			
		</header>
			
		<!-- Corpo della pagina -->
		
		<!-- Intro con foto-gallery -->
                    <?php if(isset ($userData)) echo(var_dump($userData)); ?>
                    <?php if(isset ($slideshow)) include($slideshow); ?>
		
		<!-- Sezione Registrazioni -->
                    <?php if(isset ($registrations)) {include($registrations);} ?>
                
		<!-- Sezioni Chi Siamo -->
                    <!-- Sezione di presentazione -->
                    <?php if(isset ($about)) {include($about);} ?>

                    <!-- Sezione descrittiva -->
                    <?php if(isset ($services)) {include($services);} ?>

                    <!-- I nostri collaboratori -->
			
		
		<!-- Sezione comunicazioni -->
                    <?php if(isset ($contacts)) {include($contacts);} ?>
		
		<!-- Sezione espositiva -->
                    <?php if(isset ($works)) {include($works);} ?>
		
		
		<!-- Sezioni per l'utente loggato -->
			
                    <!-- Profilo Utente -->
                    <?php if(isset ($userProfile)) { include($userProfile);} ?>

                    <!-- Sezione Pagamenti -->
                    <?php if(isset ($payments)) {include($payments);} ?>

                    <!-- Sezione Ordini effettuati -->
                    <?php if(isset ($orders)) {include($orders);} ?>

		
                <!-- Sezioni per l'Amministratore -->
			
                    <!-- Main -->
                    <?php if(isset($main)) { include($main);} ?>
                    
                    <!-- usersControl -->
                    <?php if(isset($userSummary)) { include($userSummary);} ?>
                    
                    <!-- ordersControl -->
                    <?php if(isset($ordersSummary)) { include($ordersSummary);} ?>
                    
                    <!-- Payments view -->
                    <?php if(isset($paymentsSummary)) { include($paymentsSummary);} ?>
                    
                    <!-- Articles view -->
                    <?php if(isset($articlesGallery)) {include($articlesGallery);}?>
                    
                    
		<!-- Footer -->
		<?php include($footer); ?>
		
		<!-- Chiusura div id="Wrapper" -->
		</div> 
	</body>
</html>