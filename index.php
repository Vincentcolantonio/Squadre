<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Visualizzazione</title>
</head>
<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col gy-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Città</th>
                            <th>Anno di Fondazione</th>
                            <th>Colori</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = "SELECT * FROM squadra, citta WHERE cittaId=codCitta;";
                        $st = $pdo->prepare($query);
                        $risultato = $st->execute();
                        if ($risultato) {
                            $valori = $st->fetchAll(PDO::FETCH_OBJ);
                            foreach ($valori as $valore) {
                                echo "<tr>";
                                echo "<td>$valore->nome</td>";
                                echo "<td>$valore->nomeCitta</td>";
                                echo "<td>$valore->annofondazione</td>";
                                echo "<td>$valore->colorisociali</td>";
                                echo "<td><button onclick=\"modifica($valore->codSquadra)\">MODIFICA</button><button onclick=\"elimina($valore->codSquadra)\">ELIMINA</button></td></tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="immissione.php"><button class="btn btn-primary">Crea squadra</button></a>
            </div>
        </div>
    </div>
    <script>
        function elimina(codice) {
            if(confirm("Sei sicuro di voler eliminare la squadra?")) {
                let destinazione = "inserimento.php?type=elimina&id=" + codice;
                window.location.href = destinazione;
            }
        }
        function modifica(codice) {
            if (confirm("Sei sicuro di voler modificare questa squadra?")) {
                let destinazione = "modifica.php?id=" + codice;
                window.location.href = destinazione;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>