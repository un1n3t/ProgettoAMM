
$(document).ready(function() 
    {
        $("#primaryLogin").submit(function()
        {
            param = "log-in";
            var userid = $("#userid").prop('value');
            var password = $("#password").prop('value');
            
            
            $.ajax
            ({
                url: 'index.php',
                type: "POST",
                data: "page="+param+"&userid="+userid+"&password="+password,
                success: function()
                {
                    $("#login-bar").remove();
                    $("#UpperHeader").append('<div id="forLoggedUser"></div>');
                    $("#forLoggedUser").append('<p id="welcome"></p>');
                    $("#welcome").html('Benvenuto Nome Cognome'); //non sono riuscito a trovare un metodo per interfacciarmi col server php e ottenere i dati
                    $("#forLoggedUser").append('<nav id="Logged-Menù"></nav>');
                    $("#Logged-Menù").append('<ul id="loggedMenùList"></ul>');
                    $("#loggedMenùList").append('<li><a href="index.php?page=loggedUsers&subpage=profile">Profilo</a></li>');
                    $("#loggedMenùList").append('<li> | </li>');
                    $("#loggedMenùList").append('<li><a href="index.php?page=loggedUsers&subpage=orders">I miei ordini</a></li>');
                    $("#loggedMenùList").append('<li> | </li>');
                    $("#loggedMenùList").append('<li><a href="index.php?page=log-in&logout=true">Esci</a</li>');
                },
                error: function(jqXHR) 
                {
                    /* Errore di autenticazione, gestito tramite l'oggetto jQuery XMLHttpRequest generat con la chiamata AJAX */
                    if (jqXHR.status === 401) 
                    {
                        alert("Username o Password errati");
                        location.reload();
                    }
                }  
            });
            return false;
            
        }); 
        
        
        $("#secondaryLogin").submit(function()
        {
            param = "log-in";
            var userid = $("#02userid").prop('value');
            var password = $("#02password").prop('value');
            
            
            $.ajax
            ({
                url: 'index.php',
                type: "POST",
                data: "page="+param+"&userid="+userid+"&password="+password,
                success: function()
                {
                    location.reload();
                    
                },
                error: function(jqXHR) 
                {
                    /* Errore di autenticazione, gestito tramite l'oggetto jQuery XMLHttpRequest generato con la chiamata AJAX */
                    if (jqXHR.status === 401) 
                    {
                        alert("Username o Password errati");
                        location.reload();
                    }
                }  
            });
            return false;
            
        }); 

    });