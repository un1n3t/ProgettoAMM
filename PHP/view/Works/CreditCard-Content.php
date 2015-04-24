<section class="payments">
    <h2>Carta di credito registrata</h2>
    <ul class="Virtual-ID">
            <li><?php echo("Nome Intestatario: "); echo($creditCard->getNomeI()); ?>  </li>
            <li><?php echo("Cognome Intestatario: ");  echo($creditCard->getCognomeI()); ?></li>
            <li><?php echo("Codice: "); echo($creditCard->getNumero());?></li>
            <li><?php echo("CVV2: "); echo($creditCard->getCVV()); ?></li>
            <li><?php echo("Data di scadenza: "); echo($creditCard->getScadenzaCC()); ?></li>
    </ul>
</section>