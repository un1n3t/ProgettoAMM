<div id="headerContainer">

    <!-- Barra di navigazione, parte superiore -->
    <div id="UpperHeader">
        <!-- Barra di Login -->
        <?php include($loginFormContent) ?>
    </div>
    
    <!-- Spazio riservato al Logo -->
    <div id="Logo-Container">
        <a href="index.php?page=index" title="IKStudio.com" id="logo">
            <img src="images/Logo.png" alt="IkStudio Photography">
        </a>
    </div>
    
    <!-- Barra di navigazione inferiore -->
    <div id="LowerHeader">

            <!-- Menù di navigazione -->
            <nav id="navigation-bar">
                    <ul class="menù">

                            <!-- La classe anchorM è da rivedere -->
                            <li><a class="anchorM" href="index.php?page=index">Intro</a></li>
                            <li><a class="anchorM" href="index.php?page=about&amp;subpage=about">Who We Are</a></li>
                            <li><a class="anchorM" href="index.php?page=works&amp;subpage=preview250">Works</a></li>
                            <li><a class="anchorM" href="index.php?page=contacts">Contacts</a></li>
                            <?php if(isset($_SESSION["admin"]) && $_SESSION["admin"])
                            {
                                echo('<li><a class="anchorM" href="index.php?page=loggedUsers&amp;subpage=null&amp;administration=mainMenu">Administration</a></li>');

                            }?>
                    </ul>
            </nav>
    </div>	

    <hr/>
</div>    
       
