<?php

declare (strict_types=1);

function set_kontakt(object $pdo, string $betreff,  string $fullname, string $nachricht, string $email) {
    $query = "INSERT INTO kontakt (betreff, fullname, nachricht, email) VALUES (:betreff, :fullname, :nachricht, :email);";
    $stmt = $pdo->prepare($query); // -> point to a prepare statement. Verhindert SQL Injection

    $options = [
        'cost' => 12
    ];


    $stmt->bindParam(':betreff', $betreff);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':nachricht', $nachricht);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}