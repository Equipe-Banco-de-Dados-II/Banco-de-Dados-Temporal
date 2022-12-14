<?php
    include_once("../../config.php");

    if(isset($_POST['submit']))
    {
        include_once("../../config.php");

        $veiculo = $_POST['veiculo'];
        $data_retirada = $_POST['data_retirada'];           //data de retirada especificada pelo usuário
        //$data_devolucao = $_POST['data_devolucao'];     //data prevista de devolução (PÓR HORA NAO PRECISA)
        $cpf = $_POST['cpf'];

        $sql = "SELECT * FROM veiculo WHERE placa_veiculo='$veiculo' AND tempo_final_valido IS NULL";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);             //pega as colunas do resultado obtido
    
        $operation = "SELECT DATE_SUB('$data_retirada', INTERVAL 1 DAY)";   //pega data anterior
        $result = mysqli_query($conexao, $operation);
        $row_data_retirada_sub_1 = mysqli_fetch_row($result);

        $sql = "UPDATE veiculo SET tempo_final_valido = '{$row_data_retirada_sub_1[0]}' WHERE (placa_veiculo = '{$row['placa_veiculo']}') AND (tempo_inicial_valido = '{$row['tempo_inicial_valido']}')";
        $result = mysqli_query($conexao, $sql);
        
        $sql = "INSERT INTO veiculo (placa_veiculo, tipo_veiculo, marca_veiculo, modelo_veiculo, km_rodados, valor_locacao_diaria, cpf_locatario, tempo_inicial_valido, tempo_final_valido) VALUES ('{$row['placa_veiculo']}', '{$row['tipo_veiculo']}', '{$row['marca_veiculo']}', '{$row['modelo_veiculo']}', '{$row['km_rodados']}', '{$row['valor_locacao_diaria']}', '{$cpf}', '{$data_retirada}', NULL)";
        $result = mysqli_query($conexao, $sql);
        
        echo "<script type='text/javascript'>alert('Locação realizada com sucesso!')</script>";//;window.location.href='../index.html';</script>";

    }

    $sql = "SELECT * FROM veiculo WHERE (tempo_final_valido IS NULL) AND (cpf_locatario IS NULL)";
    $result = mysqli_query($conexao, $sql);
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
        <form action="locacao-veiculo.php" method="POST">
            <header><b>LOCAÇÃO DE VEÍCULO</b></header>

            <select required name="veiculo">
                <option value="">Selecione um veiculo</option>
                <?php while($veiculo = mysqli_fetch_assoc($result)) { ?> 
                <option <?php if(isset($_POST['veiculo']) && $_POST['veiculo'] == $veiculo['placa_veiculo']) echo "selected"; ?> value="<?php echo $veiculo['placa_veiculo'];?>"><?php echo $veiculo['marca_veiculo'], " - ", $veiculo['modelo_veiculo']; ?></option>
                <?php } ?>
            </select>
            <br><br>                 
            <label for="data_retirada"><b>Data de Retirada</b></label>
            <input type="date" name="data_retirada" id="data_retirada" required>
            <br><br>
            <div class="inputBox">
                <input type="text" name="cpf" id="cpf" class="inputUser" required>
                <label for="cpf" class="labelInput">CPF</label>
            </div>
            <br><br>

            <input type="submit" name="submit" id="submit" value="Realizar locação">
    </form>
    </div>
</body>
</html>