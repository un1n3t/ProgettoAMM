<?php
	
	/** E' una classe di supporto al meccanismo di gestione dei pagamenti, fa da tramite fra i dati dell'utente, dell'ordine e i dati necessari alla transazione di pagamento
		In particolare, memorizza gli oggetti di tutte le entità coinvolte, per registrare sul DB (e per fornire alla banca) tutti i dati relativi al pagamento e all'ordine effettuato **/
	
	class Pagamenti
	{	
		private $orderID; //L'id dell'ordine coincide con l'id della transazione; la classe TransactionConstructor si occupa di assegnare l'id dell'ordine coerentemente 
		private $ordine;  //comprende anche un oggetto di tipo CreditCard o di tipo Bonifico (oltre che informazioni sommarie sull'ordine da effettuare)
		private $articolo;//memorizza l'oggetto Immmagine associato alla transazione 
		private $utente;  //memorizza l'oggetto utente
		
		

		
		//costruttore
		public function __construct($IDordine, $IDarticolo, $IDutente, $creditCard, $IBAN, $dataPagamento, $importo, $status)
		{	
			$this -> IDordine = $IDordine;	
			$this -> IDarticolo = $IDarticolo;
			$this -> IDutente = $IDutente;
			$this -> creditCard = $creditCard;
			$this -> IBAN = $IBAN;
			$this -> dataPagamento = $dataPagamento;
			$this -> importo = floatval($importo);
			$this -> status = $status;
		}
		
		//metodi getter
		public function	getOrderID()	
		{	
			return $this-> IDordine;	
		}
	}
?>