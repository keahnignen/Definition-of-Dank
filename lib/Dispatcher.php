<?php

/**
 * Der Dispatcher ist dafür zuständig, alle Requests an den entsprechenden
 * Controller weiterzuleiten.
 *
 * Der Dispatcher schaut die URI des Requests an und leitet aufgrund davon die
 * Anfrage an die gewünschte Funktion im entsprechenden Controller weiter. Die
 * URI wird wie im folgenden Beispiel verarbeitet:
 *
 *   /user/delete?id=7&foo=bar
 *    |    |      └────┴─ GET Parameter stehen im Array $_GET zur Verfügung
 *    |    |
 *    |    └─ Der Wert nach dem zweiten Slash heisst so wie die Funktion, welche
 *    |         auf dem Contoller aufgeruft werden soll.
 *    |
 *    └─ Dem Wert nach dem ersten Slash wird noch "Controller" angehängt um
 *         herauszufinden, wie der gewünschte Controller heisst.
 *
 *   Sollte ein Teil in der URI nicht vorhanden sein, wird als Controllername
 *     "DefaultController" bzw. "index" als Funktionsname verwendet.
 */
class Dispatcher
{
    /**
     * Diese Methode wertet die Request URI aus leitet die Anfrage entsprechend
     * weiter.
     */
    public static function dispatch()
    {
        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre
        //   Einzelteile zerlegt.
        // /user/index/foo --> ['user', 'index', 'foo']
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?'); // Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/'); // Alle / am anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); // In einzelteile zerlegen

        // Den Namen des gewünschten Controllers ermitteln

        if (!empty($uriFragments[0])) {
            $controllerName = $uriFragments[0];
            $controllerName = ucfirst($controllerName); // Erstes Zeichen grossschreiben
            $controllerName .= 'Controller'; // "Controller" anhängen
        }


        if (!isset($controllerName) || !file_exists(self::getFilePath($controllerName))) $controllerName = 'DefaultController';
        require_once self::getFilePath($controllerName);

        // Den Namen der auszuführenden Methode ermitteln
        $method = 'index';
        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }

        if (!class_exists($controllerName)) $controllerName = 'DefaultController';


        //$args = array_slice($uriFragments, 2); //Probaly a later Use


        // Den gewünschten Controller laden
        //   Achtung! Hier stützt PHP ab, sollte der Controller nicht existieren

        $controller = new $controllerName();

        // Eine neue Instanz des Controllers wird erstellt und die gewünschte
        //   Methode darauf aufgerufen.

        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }

        if (!isset($method) || !method_exists($controller, $method)) $method = 'index';
        $controller->$method();



    }

    private static function getFilePath($path) { return "../controller/$path.php"; }
}
