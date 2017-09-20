<!--Ausgabe-->
<?php

$tc = new FeedController();

foreach ($tc->getAllMemes() as $meme)
{
echo "
    <div class=\"post\">
        <p class=\"ueberschrift\">{$meme[0]}</p>
        <img class=\"bilder\" src=\"/images/{$meme[1]}\" alt=\"Bild Fehler\" >
    
    </div>
";
}


