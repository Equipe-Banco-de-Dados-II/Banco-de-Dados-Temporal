<?php
    if(isset($_POST['submit']))
    {
        include_once("../../config.php");

        
        $data_retirada = $_POST['data_retirada'];       //data de retirada especificada pelo usuário
        
        $operation = "SELECT DATE_SUB('$data_retirada', INTERVAL 1 DAY)";
        $data_retirada_sub_1 = mysqli_query($conexao, $operation);
        $coluna = mysqli_fetch_row($data_retirada_sub_1);
        print_r($coluna[0]);
        
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto BD II</title>
    <link rel="stylesheet" href="../../styles/style.css">
</head>
<body>
    <div class="main">
        <form action="resultado-busca.php" method="POST">
            <header><b>TESTE</b></header>

            <label for="data_retirada"><b>Data de Retirada</b></label>
            <input type="date" name="data_retirada" id="data_retirada" required>
            <br><br>
            
            <input type="submit" name="submit" id="submit" value="Realizar locação">
    </form>
    </div>
</body>
</html>