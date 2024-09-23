<?php

// hier Kontrolle der Eingaben ohne Zugriff auf DB
// mit string / object sagen wir welchen TYP wir erwarten

declare(strict_types=1); //true

function is_input_empty(string $betreff, string $fullname, string $nachricht, string $email) {
    if (empty($betreff) || empty($fullname) || empty($nachricht) || empty($email)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function create_kontakt (object $pdo, string $betreff, string $fullname, string $nachricht, string $email) {

    set_kontakt($pdo, $betreff, $fullname, $nachricht, $email); // weiter in model.inc
}