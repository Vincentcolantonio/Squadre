<?php
    require "connect.php";
    $id = $_GET["id"];
    if (isset($_GET["nomeSquadra"], $_GET["citta"], $_GET["anno"], $_GET["colori"])) {
        $nome = $_GET["nomeSquadra"];
        $citta = $_GET["citta"];
        $anno = $_GET["anno"];
        $colori = $_GET["colori"];
        $query = "UPDATE squadra SET nome=\"$nome\", cittaId=$citta, annofondazione=$anno, colorisociali=\"$colori\" WHERE codSquadra=$id;";
        print_r($query);
        $pdo->exec($query);
        header("Location: index.php");
    } else {
        $cittaQuery = "SELECT * FROM citta";
        $squadQuery = "SELECT * FROM squadra WHERE codSquadra=$id";
        $st = $pdo->prepare($cittaQuery);
        $st2 = $pdo->prepare($squadQuery);
        $result = $st->execute();
        $result2 = $st2->execute();
        $cittas = $st->fetchAll(PDO::FETCH_OBJ);
        $squadra = $st2->fetch(PDO::FETCH_OBJ);
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container w-25">
        <div class="row">
            <div class="col gy-5">
                <form action="#">
                    <input type="text" name="id" value="<?php echo $_GET["id"]?>" hidden readonly>
                    <div class="row">
                        <div class="col gy-3">
                            <label class="form-label" for="nomeSquadra">Nome Squadra</label>
                            <input class="form-control" type="text" name="nomeSquadra" id="nomeSquadra" value="<?php echo $squadra->nome?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3">
                            <label class="form-label" for="citta">Città</label>
                            <select class="form-select" name="citta" id="citta">
                                <?php
                                    foreach ($cittas as $citta) {
                                        if ($citta->codCitta === $squadra->cittaId) {
                                            echo "<option value=\"$citta->codCitta\" selected=\"selected\">$citta->nomeCitta</option>";
                                        } else {
                                            echo "<option value=\"$citta->codCitta\">$citta->nomeCitta</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3">
                            <label class="form-label" for="anno">Anno di Fondazione</label>
                            <input class="form-control" type="number" name="anno" id="anno" value="<?php echo $squadra->annofondazione?>" min="1900" max="2024" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gy-3">
                            <label class="form-label" for="colori">Colori Sociali</label>
                            <input class="form-control" type="text" name="colori" id="colori" value="<?php echo $squadra->colorisociali?>" required>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col gy-5">
                            <input class="w-50 btn btn-primary" type="submit" value="INVIA">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>