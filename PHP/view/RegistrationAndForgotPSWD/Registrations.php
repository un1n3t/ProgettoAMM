<section id="Contacts">
    <div id="About-Container">
        <header>
            <h1>Registrazione</h1>
        </header>

        <!-- Form di login -->
        <form id="insertionForm"  action="index.php?page=registration" method="post">
            <fieldset id="Anagrafica">
                
                <h2>Anagrafica</h2>
                <ul class="colonna1">
                    <li><label id="nome">Nome: </label><input type="text" name="nome" MAXLENGTH="24"/><label class="error"></label></li>
                    <li><label id="cognome">Cognome: </label><input type="text" name="cognome" MAXLENGTH="24"/><label class="error"></label></li>
                    <li><label>Data di nascita: </label><input type="text" name="dataNascita" placeholder="gg/mm/aaaa" MAXLENGTH="10"/><label class="error" ></label></li>
                    <li><label id="città">Città: </label><input  type="text" name="città" MAXLENGTH="24"/><label class="error" ></label></li> 
                </ul>

                <ul class="colonna2">
                    <li><label>Indirizzo: </label><input type="text" name="indirizzo" MAXLENGTH="120"/><label class="error" ></label></li>
                    <li><label id="cap">CAP: </label><input type="text" name="CAP" MAXLENGTH="5"/><label class="error" ></label></li>
                    <li><label>Cellulare: </label><input type="text" name="cellulare" MAXLENGTH="16"/><label class="error"></label></li>
                </ul>
            </fieldset>


            <fieldset class="Virtual-ID">
                <h2>ID virtuale</h2>
                <ul  class="colonna1">
                    <li><label id="user">User-ID: </label><input type="text" name="userID" MAXLENGTH="8"/><label class="error" ></label></li>
                    <li><label>Password: </label><input id="pswd1" type="password" name="pswd1" MAXLENGTH="16"/><label class="error" ></label></li>
                </ul>

                <ul class="colonna2">
                    <li><label id="email">Email: </label><input  type="text" name="email" MAXLENGTH="120"/><label class="error" ></label></li>
                    <li><label>Conferma password: </label><input id="pswd2" type="password" name="pswd2" MAXLENGTH="16"/><label class="error" ></label></li>
                </ul>
            </fieldset>
            
            
            <fieldset id="creditCardReg">
                <h2>Carta di credito</h2>
                <ul class="colonna1">
                    <li><label>Nome (Intestatario): </label><input type="text" name="nomeCC" MAXLENGTH="24"/><label class="error" ></label></li>
                    <li><label class="cognomeCC">Cognome: </label><input type="text" name="cognomeCC" MAXLENGTH="24"/><label class="error"  ></label></li>
                    <li><label id="numeroCC">Numero carta: </label><input type="text" name="numeroCC" MAXLENGTH="19"/><label class="error"  ></label></li>
                </ul>

                <ul class="colonna2">
                    <li><label>Data di scadenza: </label><input type="text" name="dataScadenza" placeholder="01/mm/aaaa" /><label class="error"  ></label></li>
                    <li><label id="CVV2">CVV2: </label><input type="text" name="CVV2" MAXLENGTH="3"/><label class="error"  ></label></li>
                    <li><label>Indirizzo fatt.: </label><input type="text" name="indirizzoCC" MAXLENGTH="120"/><label class="error"  ></label></li>
                </ul>
            </fieldset>
            

            <fieldset class="Virtual-ID">
                <h2>Coordinate bancarie (iban) <em>[opzionale]</em></h2>
                <ul  class="colonna1">
                    <li><label>Nome (Intestatario): </label><input type="text" name="nomeIban" MAXLENGTH="24"/><label class="error"  ></label></li>
                    <li><label class="cognomeCC">Cognome: </label><input type="text" name="cognomeIban" MAXLENGTH="24" /><label class="error" ></label></li>
                    
                </ul>

                <ul class="colonna2">
                    <li><label id="IBAN">Codice IBAN: </label><input type="text" name="IBAN" MAXLENGTH="27"/><label class="error" ></label></li>
                    <li><label>Indirizzo fatt.: </label><input type="text" name="indirizzoIban" MAXLENGTH="120"/><label class="error" ></label></li>
                </ul>
            </fieldset>
            <input type="hidden" name="confirmFlag" value="true"> <!-- avverte il server che questo specifico form è stato compilato ed inviato -->
            <button class="confirm" type="submit" name="login">Conferma</button>
        </form>
    </div>
</section>

   
