<?php
    if(isset($_POST['submit']))
    {
        include_once("../config.php");

        $tipo = $_POST['tipo'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];

        $sql = "SELECT * FROM veiculo WHERE tipo_veiculo='$tipo' AND marca_veiculo='$marca' AND modelo_veiculo='$modelo' AND cpf_locatario IS NULL AND tempo_final_valido IS NULL";
        $result = mysqli_query($conexao, $sql);
        $n_rows = mysqli_num_rows($result);     //numero de linhas

        if ($n_rows=="0" || $n_rows==0){        //se não for selecionado nenhuma linha, significa que o cpf ou a senha não estão no BD
            echo "<script type='text/javascript'>alert('Veículo já está locado ou veículo inexistente!');window.location.href='locacao-veiculo.php';</script>";
        }else{
            $row = mysqli_fetch_assoc($result);             //pega as colunas do resultado obtido
            $data_retirada = $_POST['data_retirada'];       //data de retirada especificada pelo usuário
            //$data_devolucao = $_POST['data_devolucao'];     //data prevista de devolução (PÓR HORA NAO PRECISA)
            $cpf = $_POST('cpf');
            
            $sql = "UPDATE veiculo SET tempo_final_valido = '{$data_retirada}' WHERE (placa_veiculo = '{$row['placa_veiculo']}') AND (tempo_inicial_valido = '{$row['tempo_inicial_valido']}')";
            $result = mysqli_query($conexao, $sql);
            
            $sql = "INSERT INTO veiculo (placa_veiculo, tipo_veiculo, marca_veiculo, modelo_veiculo, km_rodados, valor_locacao_diaria, cpf_locatario, tempo_inicial_valido, tempo_final_valido) VALUES ('{$row['placa_veiculo']}', '{$row['tipo_veiculo']}', '{$row['marca_veiculo']}', '{$row['modelo_veiculo']}', '{$row['km_rodados']}', '{$row['valor_locacao_diaria']}', '{$cpf}', '{$data_retirada}', NULL)";
            $result = mysqli_query($conexao, $sql);
            
            echo "<script type='text/javascript'>alert('Locação realizada com sucesso!')</script>";//;window.location.href='../index.html';</script>";
        }
    }
?>

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
        <form action="locacao-veiculo.php" method="POST">
            <header><b>LOCAÇÃO DE VEÍCULO</b></header>
            <p>Tipo de veículo:</p>
            <input type="radio" id="carro" name="tipo" value="Carro" required>
            <label for="carro">Carro</label>
            <br>
            <input type="radio" id="moto" name="tipo" value="Moto" required>
            <label for="moto">Moto</label>
            <br>
            
            <div class="inputBox">
                <input type="text" name="marca" id="marca" class="inputUser" required>
                <label for="marca" class="labelInput">Marca do veículo</label>
            </div>
            
            <br>
            <div class="inputBox">
                <input type="text" name="modelo" id="modelo" class="inputUser" required>
                <label for="modelo" class="labelInput">Modelo do veículo</label>
            </div>
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