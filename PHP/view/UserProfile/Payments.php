<section id="SezioniUtente">
    <div id="Data-Container">
        <article>

            <header>
                    <h1>Metodi di Pagamento</h1>
            </header>

            <div id="elenco">
                <section class="payments">
                    <h2>Carta di Credito Registrata</h2>
                    <ul class="Virtual-ID">
                        <li>Nome Intestatario: <?php if(isset ($creditCard)) echo($creditCard->getNomeI()); ?>  </li>
                        <li>Cognome Intestatario:  <?php if(isset ($creditCard)) echo($creditCard->getCognomeI()); ?></li>
                        <li>Codice: <?php if(isset ($creditCard)) echo($creditCard->getNumero()); ?></li>
                        <li>CVV2: <?php if(isset ($creditCard)) echo($creditCard->getCVV()); ?></li>
                        <li>Data di scadenza: <?php if(isset ($creditCard)) echo($creditCard->getScadenzaCC()); ?></li>
                    </ul>
                </section>

                <section class="payments">
                <h2>Coordinate Bancarie per bonifico</h2>
                        <ul class="Virtual-ID">
                                <li>Nome Intestatario: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getNomeI()); ?></li>
                                <li>Cognome Intestatario: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getCognomeI()); ?></li>
                                <li>Codice IBAN intestatario: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getIBANutente()); ?></li>
                                <li>Nome Beneficiario: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getNomeBeneficiario()); ?></li>
                                <li>Codice IBAN Beneficiario: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getIBANBeneficiario()); ?></li>
                                <li>Causale Pagamento: <?php if(isset ($ibanOBJ)) echo($ibanOBJ->getCausale()); ?></li>
                        </ul>
                </section>

            </div>


            <?php include($footerMenu) ?>

        </article>
    </div>
</section>