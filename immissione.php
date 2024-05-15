<?php
require "connect.php";
$query = "SELECT * FROM citta";
$st = $pdo->prepare($query);
$result = $st->execute();
$cittas = $st->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Immissione</title>
</head>
<body>
    <div class="container w-25">
        <div class="row">
            <div class="col gy-5">
                <form action="inserimento.php" method="get">
                    <div class="row">
                        <div class="col">
                            <label for="nome" class="form-label">Nome Squadra</label>
                            <input class="form-control" type="text" name="nome" id="nome" maxlength="20" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="citta" class="form-label">Città</label>
                            <select class="form-select" name="citta" id="citta">
                                <?php
                                foreach ($cittas as $citta) 
                                    echo "<option value=\"$citta->codCitta\">$citta->nome</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="anno" class="form-label">Anno di Fondazione</label>
                            <input class="form-control" type="number" name="anno" id="anno" min="1900" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="colori" class="form-label">Colori Sociali</label>
                            <input class="form-control" type="text" name="colori" id="colori" required>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col gy-3">
                            <button class="w-50 btn btn-primary">INVIO</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const anno = document.getElementById("anno");
        anno.max = new Date().getFullYear();
    </script>
</body>
</html>