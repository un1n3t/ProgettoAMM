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