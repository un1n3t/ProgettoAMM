<div id="Presentation">
    <div id="miniatures">
        <ul>
            <?php
            foreach($allPictures as $immagine)
            {
                $id = $immagine->getID();
                if( ($immagine->getVisibility() == true) or ($immagine->getVisibility() == 1) )
                {
                    
                    echo ('<li><a href="index.php?page=works&amp;subpage=preview850&amp;imageID='.$id.'">'
                                .'<strong>'.$immagine->getTitolo().'</strong>'
                                .'<img src="'.$immagine->getPreview250().'" alt="'.htmlspecialchars($immagine->getDescrizione()).'">'
                           . ' </a>'
                      . ' </li>');
                }    
            }  
            
            if(count($allPictures) < 15)
            { 
                for($i = count($allPictures); $i <= 20; $i++)
                {
                  echo('<li> <a href="#"> <strong>Preview250</strong><img src="images/preview250/250.jpg" alt="Stiamo lavorando per voi"> </a> </li>');
                }
            }
            ?>
            
        </ul>
        <br class="clear">
    </div>
</div>