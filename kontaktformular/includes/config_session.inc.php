<?php

// Einsatz von Sessions


ini_set('session.use_only_cookies', 1); // 1 is true
ini_set('session.use_strict_mode', 1); // macht session id komplexer

session_set_cookie_params([
    'lifetime' => 1800, // Cookie lebt 30 Minuten
    'domain' => 'localhost', // lebt nur in der Domain example.com
    'path' => '/', // in jeder SubSeite unsere Website
    'secure' => true, // nur in https connection
    'httponly' => true // dient alles der Sicherheit
]);

session_start();

 // alle 30 Minuten eine neue Session id

if(!isset($_SESSION['last_regeneration'])) { // wenn noch keine id generiert wurde
    regenerate_session_id();

} else {

    $interval = 60 * 30; // in s -> also nach 30 Minuten

    if(time() - $_SESSION['last_regeneration'] >= $interval) { // also wenn es länger als 30 Minuten her ist
        regenerate_session_id();
    }
}


function regenerate_session_id() {
    session_regenerate_id(true); // kreiert eine komplexere id
    $_SESSION['last_regeneration'] = time(); // wird auf die aktuelle Zeit gesetzt
}