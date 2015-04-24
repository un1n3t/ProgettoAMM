<section id="Contacts">
    <div id="About-Container">
        <header>
            <h1 class="forgotTitlesBIG">Procedura di recupero Password</h1>
        </header>

        <!-- Form di login -->
        <form id="insertionForm"  action="index.php?page=forgotPassword" method="post">
            <fieldset id="Anagrafica">
                <h2 class="forgotTitlesLittle">Compila questi dati per recuperare la password</h2>
                <ul class="colonna1">
                    <li><label >User-ID: </label><input type="text" name="userID" MAXLENGTH="8"/></li>
                    <li><label >Nome: </label><input type="text" name="nome" MAXLENGTH="24"/></li> 
                    <li><label >Cognome: </label><input type="text" name="cognome" MAXLENGTH="24"/></li>
                    <li><label>Data di nascita: </label><input type="text" name="dataNascita" placeholder="gg/mm/aaaa"/></li>
                    <li><label>Email: </label><input type="text" name="email" MAXLENGTH="120"/></li>
                    <li><label>Cellulare: </label><input type="text" name="cellulare" MAXLENGTH="16"/></li>
                </ul>
            </fieldset>

            <input type="hidden" name="confirmFlag" value="true"> <!-- avverte il server che questo specifico form è stato compilato ed inviato -->
            <button class="confirm" type="submit" name="login">Conferma</button>
            <button class="confirm" onclick="javascript:location.href='index.php?page=index'">Annulla</button>
        </form>
    </div>
</section>


   
