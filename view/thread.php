<?php


$tc = new ThreadController();

foreach ($tc->getAllCategorys() as $category)
{
    echo "
    <div class=\"thpost thpost1\">
        <p>{$category}</p>
        <img class=\"thbilder\" src=\"/images/{$category}.jpg\" alt=\"Bild Fehler\" >
    </div>";
}



