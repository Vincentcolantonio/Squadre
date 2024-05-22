<?php
require "connect.php";
switch ($_GET["type"]) {
    case "immissione":
        $query = "INSERT INTO squadra (nome, cittaId, annofondazione, colorisociali) VALUES (:nome, :citta, :annofondazione, :colorisociali);";
        $params = ["nome" => $_GET["nome"], "citta" => $_GET["citta"], "annofondazione" => $_GET["anno"], "colorisociali" => $_GET["colori"]];
        $st = $pdo->prepare($query);
        $result = $st->execute($params);
        break;
    case "elimina":
        $id = $_GET["id"];
        $query = "DELETE FROM squadra WHERE codSquadra=$id";
        $st = $pdo->prepare($query);
        $result = $st->execute();
}
if ($result) {
    header("Location: index.php");
} else {
    echo "<p>Errore: non è stato possibile immettere i dati nel database</p>";
    echo "<a href=\"form.php\">Riprova</a>";
}