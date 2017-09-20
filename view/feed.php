<!--Ausgabe-->
<?php

$tc = new FeedController();

foreach ($tc->getAllMemes() as $category)
{
echo "
    <div class=\"post\">
        <p class=\"ueberschrift\">Hallo</p>
        <img class=\"bilder\" src=\"/images/{path}\" alt=\"Bild Fehler\" >
    
    </div>
";
}


