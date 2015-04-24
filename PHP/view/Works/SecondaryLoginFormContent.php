
<!-- Form di login -->
<section id="SecondaryLoginModule">
	<h1 class="titles"> Non risulti loggato </h1>
	<form  id ="secondaryLogin" action="?" method="post">
		<fieldset id="login-field">
			<ul>
				<li class="user">Inserisci il tuo user-id </li>
				<li><input id="02userid" name="userid" type="text" placeholder="Insert your username" required autofocus> </li>
				
				<li class="passwd">Inserisci la password </li>
				<li><input id="02password" name="password" type="password" placeholder="Your password.." required></li>
				
				<li><button class="confirm" type="submit" name="login">Conferma</button></li>
                                <input type="hidden" id="IMGid" value="<?php echo($IMGid)?>">
			</ul>
		</fieldset>
	</form>
	
	<ul id="opzioni">
		<li><a href="#">Non ricordo più la password</a> | </li>
		<li><a href="#">Registrati</a></li>
	</ul>
        
        <div id="verifica">
        </div>
       
</section> 
