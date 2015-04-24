
<?php 
	$creditCard = $userOBJ -> getCarta();
	$ibanOBJ = $userOBJ -> getIBAN();
?>


<section class="elenchi">
	<header>
		<h1 class="titles">Metodi di Pagamento</h1>
	</header>
		
	<div id="elenco">
            <?php if(!is_null($creditCard))
            {
                include($creditCardContent);
            }
            ?>

            <form  action="index.php?page=works&amp;subpage=shipments&amp;imageID=<?php echo($IMGid)?>" method="post">
                    <input	 type="hidden"	 name="creditCard"	 value="creditCard"/>		
                    <button name="creditCard" type="submit" class="confirmButton">Seleziona</button>
            </form>

            <?php if(isset($ibanOBJ))
            {
                include($ibanContent);
            }
            ?>

            <form  action="index.php?page=works&amp;subpage=shipments&amp;imageID=<?php echo($IMGid)?>" method="post">
                    <input	 type="hidden"	 name="IBAN"	 value="IBAN"/>		
                    <button name="IBAN" type="submit" class="confirmButton">Seleziona</button>
            </form>

        </div>
</section>


