<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title><?= $title ?> | Bbc MVC</title>
	
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
   
	    
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
		
          </button>
		  <img class="Logo" src="/images/dankLogo.png" alt="Bild Fehler!">
        </div>
        <div id="navbar" class="navibBar">
          <ul class="nav navbar-nav" id="naviBar">
			<!--CSS Fehlt noch, konnte leider nicht eingebunden werden ausser mit Style -->
            <li class="navBar"><a style="" class="navBar" href="/feed">Feed</a></li>
            <li><a class="blackCockDown" href="/Threads">Threads</a></li>
			<!--Suchfeld -->
			<input id="searchBar"type="text" name="search" placeholder="Search..">
			<!--Upload und Anmelden/Benutzer-Seite -->
			<a href="/user"><i class="glyphicon glyphicon-user"></i></a>
			
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    

    <h1><?= $heading ?></h1>
