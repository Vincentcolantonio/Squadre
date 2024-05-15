<?php
require "connect.php";
$query = "INSERT INTO squadra (nome, cittaId, annofondazione, colorisociali) VALUES (:nome, :citta, :annofondazione, :colorisociali);";
$params = ["nome" => $_GET["nome"], "citta" => $_GET["citta"], "annofondazione" => $_GET["anno"], "colorisociali" => $_GET["colori"]];
$st = $pdo->prepare($query);
$result = $st->execute($params);
if ($result) {
    header("Location: index.php");
} else {
    echo "<p>Errore: non è stato possibbile immettere i dati nel database</p>";
    echo "<a href=\"form.php\">Riprova</a>";
}