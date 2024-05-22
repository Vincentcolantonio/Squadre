<?php
    require "connect.php";
    $id = $_GET["id"];
    if (isset($_GET["nome"], $_GET["citta"], $_GET["anno"], $_GET["colori"])) {
        $nome = $_GET["nome"];
        $citta = $_GET["citta"];
        $anno = $_GET["anno"];
        $colori = $_GET["colori"];
        $query = "UPDATE squadra SET nome=$nome, cittaId=$citta, annofondazione=$anno, colorisociali=$colori WHERE codSquadra=$id";
    }
    $cittaQuery = "SELECT * FROM citta";
    $squadQuery = "SELECT * FROM squadra WHERE codSquadra=$id";
    $st = $pdo->prepare($cittaQuery);
    $st2 = $pdo->prepare($squadQuery);
    $result = $st->execute();
    $result2 = $st2->execute();
    $cittas = $st->fetchAll(PDO::FETCH_OBJ);
    $squadra = $st2->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="index.php">
                    <input type="text" name="codice" value="<?php $_GET["id"]?>" hidden readonly>
                    <div class="row">
                        <div class="col">
                            <label for="nomeSquadra">Nome Squadra</label>
                            <input type="text" name="nomeSquadra" id="nomeSquadra" value="<?php $squadra->nome?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="citta">Città</label>
                            <select name="citta" id="citta">
                                <?php
                                    foreach ($cittas as $citta) 
                                    if ($citta->codCitta === $squadra->cittaId) {
                                        echo "<option value=\"$citta->codCitta\" selecte=\"selected\">$citta->nome</option>";
                                    } else {
                                        echo "<option value=\"$citta->codCitta\">$citta->nome</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="anno">Anno di Fondazione</label>
                            <input type="number" name="anno" id="anno" value="<?php $squadra->annofondazione?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="colori">Colori Sociali</label>
                            <input type="text" name="colori" id="colori" value="<?php $squadra->colorisociali?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Invia">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>