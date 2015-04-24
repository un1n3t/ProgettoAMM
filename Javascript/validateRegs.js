jQuery(document).ready(function($)
{
    //Regole di validazione
    $("#insertionForm").validate
    ({
        rules: 
            {
                nome: {
                required:true,
                minlength: 3,
                maxlength: 24
                },
                
                cognome: {
                required: true,
                minlength: 3,
                maxlength: 24
                },
                
                dataNascita: {
                required: true,
                date: true
                },
                
                città: {
                required: true,
                minlength: 4,
                maxlength: 24
                },
                
                indirizzo: {
                required: true,
                minlength: 15,
                maxlength: 120
                },
                
                CAP: {
                required: true,
                minlength: 5,
                maxlength: 5
                },
                
                Cellulare: {
                required: true,
                minlength: 16,
                maxlength: 16
                },
                
                 userID: {
                required: true,
                minlength:2,
                maxlength: 8
                },
                
                 email: {
                required: true,
                email: true
                },
                
                 pswd1: {
                required: true,
                minlength: 8,
                maxlength: 64
                },
                
                 pswd2: {
                required: true,
                minlength: 8,
                maxlength: 64,
                equalTo: "#pswd1"
                },
                
                 nomeCC: {
                minlength: 3,
                maxlength: 24
                },
                
                 cognomeCC: {
                minlength: 3,
                maxlength: 24
                },
                
                numeroCC: {
                minlength: 19,
                maxlength: 19
                },
                
                dataScadenza: {
                date: true
                },
                
                CVV2: {
                minlength: 3,
                maxlength: 3,
                number: true
                },
                
                indirizzoCC: {
                minlength: 15,
                maxlength: 120
                },
                
                nomeIban: {
                required: false,
                minlength: 3,
                maxlength: 24
                },
                
                cognomeIban: {
                required: false,
                minlength: 3,
                maxlength: 24
                },
                
                IBAN: {
                required: false,
                minlength: 27,
                maxlength: 27
                },
                
                indirizzoIban: {
                required: false,
                minlength: 15,
                maxlength: 120
                }
            },//rules
	    submitHandler: function(form) 
            {
                form.submit();
            }
    });//validate
});

