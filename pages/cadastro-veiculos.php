<?php
    if(isset($_POST['submit']))
    {
        include_once("../config.php");

        $tipo = $_POST['tipo'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $placa = $_POST['placa'];
        $valor = $_POST['valor'];
        
        $today = date('Y-m-d');

        $insert = "INSERT INTO veiculo (placa_veiculo, tipo_veiculo, marca_veiculo, modelo_veiculo, km_rodados, valor_locacao_diaria, cpf_locatario, tempo_inicial_valido, tempo_final_valido) VALUES ('{$placa}', '{$tipo}', '{$marca}', '{$modelo}', '0', '{$valor}', NULL, '{$today}', NULL)";
        $result = mysqli_query($conexao, $insert);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto BD II</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <div class="main">
        <form action="cadastro-veiculos.php" method="POST">
            <header><b>CADASTRO VEÍCULOS</b></header>
            
            <p>Tipo de veículo:</p>
            <input type="radio" id="carro" name="tipo" value="Carro" required>
            <label for="carro">Carro</label>
            <br>
            <input type="radio" id="moto" name="tipo" value="Moto" required>
            <label for="moto">Moto</label>
            <br>

            <div class="inputBox">
                <input type="text" name="marca" id="marca" class="inputUser" required>
                <label for="marca" class="labelInput">Marca</label>
            </div>

            <div class="inputBox">
                <input type="text" name="modelo" id="modelo" class="inputUser" required>
                <label for="modelo" class="labelInput">Modelo</label>
            </div>

            <div class="inputBox">
                <input type="text" name="placa" id="placa" class="inputUser" required>
                <label for="placa" class="labelInput">Placa do veículo</label>
            </div>

            <div class="inputBox">
                <input type="text" name="valor" id="valor" class="inputUser" required>
                <label for="valor" class="labelInput">Valor de locação</label>
            </div>

            <br><br>
            <input type="submit" name="submit" id="submit" value="Cadastrar Veículo">
    </form>
    </div>
</body>
</html>