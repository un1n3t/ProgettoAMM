<?php

class OrderIDGenerator
{
    
    //Genera una stringa in esadecimale, partendo da una stringa ASCII
    public static function strToHex($string)
    {
        $hex = '';
        for ($i=0; $i< strlen($string); $i++)
        {
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }
    
    
    //Genera una stringa in ASCII, partendo da una stringa in esadecimale
    public static function hexToStr($hex)
    {
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
    
    
    //Funzione di testing per le funzioni di conversione
    //Esempi d'uso:
    
    /*
     * $success = true;
     * $success = OrderIDGenerator::test('00', OrderIDGenerator::strToHex(OrderIDGenerator::hexToStr('00')), $success);
     * $success = OrderIDGenerator::test('FF', OrderIDGenerator::strToHex(OrderIDGenerator::hexToStr('FF')), $success);
     * $success = OrderIDGenerator::test('000102FF', OrderIDGenerator::strToHex(OrderIDGenerator::hexToStr('000102FF')), $success);
     * $success = OrderIDGenerator::test('↕↑↔§P↔§P ♫§T↕§↕', OrderIDGenerator::hexToStr(OrderIDGenerator::strToHex('↕↑↔§P↔§P ♫§T↕§↕')), $success);
     *
     * echo $success ? "Success" : "\nFailed";
     */
    public static function test($expected, $actual, $success) 
    {
        if($expected !== $actual) 
        {
            echo "Expected: '$expected'\n";
            echo "Actual:   '$actual'\n";
            echo "\n";
            $success = false;
        }
        return $success;
    }
    
    //Genera una stringa esadecimale casuale, fra 0 e 0xfffff, di 4 cifre
    public static function random()
    {
        $num = mt_rand ( 0, 0xffff ); // trust the library, love the library...
        $output = sprintf ( "%4x" , $num ); // muchas smoochas to you, PHP!
        return $output;
    }
    
    //elabora un nuovo id per l'ordine da effettuare, in maniera tale che, dall'orderID, si possa risalire, manualmente, all'idutente e all'articolo ordinato
    public static function newOrderID($userID, $articleID, $totalImport)
    {
        $encodedUserID = self::strToHex($userID);
        $encodedArticleID = dechex($articleID);
        $encodedImport = dechex($totalImport);
        $randomPadd = self::random();
        $fixedPadd = "AA";
        
        if (strlen($encodedUserID) > 16)
        {
            return "errore #001 - Errore nella generazione del codice ordine - Non è stato possibile codificare l'idUtente";
        }
        else if (strlen($encodedUserID) < 16)
        {
            while(strlen($encodedUserID) < 16)
            {
                $encodedUserID = "0".$encodedUserID; 
            }
        }
        
        if (strlen($encodedArticleID) > 6)
        {
            
            return "errore #002 - Errore nella generazione del codice ordine - Non è stato possibile codificare l'id dell'articolo - HEX: $lenght";
        }
        else if (strlen($encodedArticleID) < 6)
        {
            while(strlen($encodedArticleID) < 6)
            {
                $encodedArticleID = "0".$encodedArticleID; 
            }
        }
        
        if (strlen($encodedImport) > 4)
        {
            //l'importo massimo non può eccedere i 65.535€ per poter essere rappresentato con 4 cifre
            return "errore #003 - Errore nella generazione del codice ordine - $lenght - $encodedImport ";
        }
        else if (strlen($encodedImport) < 4)
        {
            while(strlen($encodedImport) < 4)
            {
                $encodedImport = "0".$encodedImport; 
            }
        }
        
        
        if (strlen($randomPadd) > 4)
        {
            return "errore #004 - Errore nella generazione del codice ordine - Eccesso nel random padd: $randomPadd";
        }
        else if (strlen($randomPadd) < 4)
        {
            while(strlen($randomPadd) < 4)
            {
                $randomPadd = "0".$randomPadd; 
            }
        }
        
        
        
        //ritorna una stringa di 32 cifre HEX (1024bit, teorici, per codice ordine)
        return $encodedUserID.$encodedArticleID.$encodedImport.$randomPadd.$fixedPadd;
    }
        
    
    
}
    
?>