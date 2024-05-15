<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "", [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $err) {
    die("ERRORE: Impossibile stabilire connessione");
}