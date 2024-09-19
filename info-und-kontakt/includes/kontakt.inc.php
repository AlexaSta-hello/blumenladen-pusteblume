<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $betreff = $_POST["betreff"];
    $fullname = $_POST["fullname"];
    $nachricht = $_POST["nachricht"];
    $email = $_POST["email"];

    try {

        //Wir schnappen uns die Files  -> Reihenfolge wichtig. View wäre zwischen m und c
        require_once 'dbh.inc.php';
        require_once 'kontakt_model.inc.php';
        require_once 'kontakt_contr.inc.php';

        //Error Handlers im contr. file
        $errors = [];

        if (is_input_empty($betreff, $fullname, $nachricht, $email)) {
            $errors["empty_input"] = "Bitte füllen Sie alle Felder aus!";
        }

        if (is_email_invalid($email)) {
            $errors["wrong_email"] = "Bitte korrekte Email-Adresse eingeben!";
        }
      

        /* hier sollte zunächst eine session gestartet werden. Daher noch mal
            require ...php weil da eine session gestartet wird. 
            Wir könnten aus session_start() eingeben, aber es ist sicherer wenn
            wir die session über config_session starten. */
        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_kontakt"] = $errors;

            /* last : usibility feature! wenn ich das falsche pwd eingebe, aber name 
            und email richtig, soll er username und email drin lassen in der anzeige,
            damit ich sie nicht noch mal eingeben muss! */
            $kontaktData = [     // nach dem user ihr daten geschickt haben schicken wir sie an die signup form
                "fullname" => $fullname,
                "betreff" => $betreff, // "nachname" ist random gewählter string
                "nachricht" => $nachricht
            ];

            $_SESSION["kontakt_data"] = $kontaktData; // wir schicken die daten wieder in die signup form

            header("Location: ../info-und-kontakt.html");
            die();
            /* jetzt weiter in index.php da wir mit header dahin zurück geführt werden
            bei error und die Messages da ausgegeben werden sollen */
        }

        // Jetzt kreieren wir die User -> weiter in signup_contr.inc
        create_kontakt($pdo, $betreff, $fullname, $nachricht, $email);

        header("Location: ../info-und-kontakt.html?kontakt=success");

        unset($_SESSION["kontakt_data"]);
        unset($_SESSION["errors_kontakt"]);

        $pdo = null; 
        $stmt = null;

        
        die();


    } catch (PDOException $e) {
        die("Abfrage fehlgeschlagen: " . $e->getMessage());    
    }

} else {
    header("Location: ../info-und-kontakt.html");
    die();
}