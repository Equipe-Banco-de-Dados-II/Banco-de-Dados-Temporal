<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto BD II</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="main">
        <form action="busca-veiculos.php" method="POST">
            <header><b>CONSULTA TEMPORAL</b></header>
            <div class="inputBox">
                <input type="text" name="marca" id="marca" class="inputUser">
                <label for="marca" class="labelInput">Marca do veículo</label>
            </div>
            <br>
            <input type="submit" name="submit" id="submit" value="Buscar">
        </form>
        <br>
        <div id="resultado-busca">
            <?php
                if(isset($_POST['submit']))
                {
                    include_once("../config.php");
            
                    $marca = ($_POST['marca']);
                    $sql = "SELECT * FROM veiculo WHERE marca_veiculo LIKE '%$marca%'";
                    $result = mysqli_query($conexao, $sql);
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    echo "Veículos disponíveis: <br>";
                    foreach($rows as $row){
                        if($row['tempo_final_valido']==NULL){
                            echo "Modelo: {$row['modelo_veiculo']} | Placa: {$row['placa_veiculo']} <br>";
                        }
                    }
                }
            ?>
        </div>

    </div>
</body>
</html>