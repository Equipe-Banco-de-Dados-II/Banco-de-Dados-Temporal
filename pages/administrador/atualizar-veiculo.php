<?php
    include_once("../../config.php");

    if(isset($_POST['submit']))
    {
        include_once("../../config.php");

    
        $veiculo = $_POST['veiculo'];

        $sql = "SELECT * FROM veiculo WHERE placa_veiculo='$veiculo' AND tempo_final_valido IS NULL";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);             //pega as colunas do resultado obtido
    
        if(isset($_POST['km'])){ 
            $new_km = $_POST['km'] + $row['km_rodados'];
            //echo "<script type='text/javascript'>alert('IF 1!')</script>";
        }else{
            $new_km = $row['km_rodados'];
            //echo "<script type='text/javascript'>alert('IF 2!')</script>";
        }

        if(isset($_POST['data_remocao'])){       //se usuário seleciona uma data especifica de remoção, utiliza essa data
            $data_remocao = $_POST['data_remocao'];
        }else{                      //senão, utiliza data do dia atual
            $data_remocao = date('Y-m-d'); //data de hoje
        }

        $sql = "UPDATE veiculo SET tempo_final_valido = '{$data_remocao}' WHERE (placa_veiculo = '{$row['placa_veiculo']}') AND (tempo_inicial_valido = '{$row['tempo_inicial_valido']}')";
        $result = mysqli_query($conexao, $sql);

        $operation = "SELECT DATE_ADD('$data_remocao', INTERVAL 1 DAY)";   //pega data posterior a da remoção para a nova tupla temporal
        $result = mysqli_query($conexao, $operation);
        $row_data_remocao_add_1 = mysqli_fetch_row($result);
        
        $remover_loc = $_POST['locatario'];
        if($remover_loc=='S'){
            $sql = "INSERT INTO veiculo (placa_veiculo, tipo_veiculo, marca_veiculo, modelo_veiculo, km_rodados, valor_locacao_diaria, cpf_locatario, tempo_inicial_valido, tempo_final_valido) VALUES ('{$row['placa_veiculo']}', '{$row['tipo_veiculo']}', '{$row['marca_veiculo']}', '{$row['modelo_veiculo']}', '$new_km', '{$row['valor_locacao_diaria']}', NULL, '{$row_data_remocao_add_1[0]}', NULL)";
            $result = mysqli_query($conexao, $sql);
        }else{
            $sql = "INSERT INTO veiculo (placa_veiculo, tipo_veiculo, marca_veiculo, modelo_veiculo, km_rodados, valor_locacao_diaria, cpf_locatario, tempo_inicial_valido, tempo_final_valido) VALUES ('{$row['placa_veiculo']}', '{$row['tipo_veiculo']}', '{$row['marca_veiculo']}', '{$row['modelo_veiculo']}', '$new_km', '{$row['valor_locacao_diaria']}', '{$row['cpf_locatario']}', '{$row_data_remocao_add_1[0]}', NULL)";
            $result = mysqli_query($conexao, $sql);
        }
        
        echo "<script type='text/javascript'>alert('Atualização realizada com sucesso!')</script>";//;window.location.href='../index.html';</script>";

    }

    $sql = "SELECT * FROM veiculo WHERE (tempo_final_valido IS NULL)";
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
        <form action="atualizar-veiculo.php" method="POST">
            <header><b>ATUALIZAR VEÍCULO</b></header>

            <select required name="veiculo">
                <option value="">Selecione um veiculo</option>
                <?php while($veiculo = mysqli_fetch_assoc($result)) { ?> 
                <option <?php if(isset($_POST['veiculo']) && $_POST['veiculo'] == $veiculo['placa_veiculo']) echo "selected"; ?> value="<?php echo $veiculo['placa_veiculo'];?>"><?php echo $veiculo['marca_veiculo'], " - ", $veiculo['modelo_veiculo']; ?></option>
                <?php } ?>
            </select>
            <br><br>               

            <p>Remover locatário:</p>
            <input type="radio" id="sim" name="locatario" value="S" required>
            <label for="sim">Sim</label>
            <br>
            <input type="radio" id="nao" name="locatario" value="N" required>
            <label for="nao">Não</label>
            <br><br>
            <label for="data_remocao"><b>Data da remoção</b></label>
            <input type="date" name="data_remocao" id="data_remocao">
            <br><br>
            <div class="inputBox">
                <input type="text" name="km" id="km" class="inputUser">
                <label for="km" class="labelInput">Kilometragem</label>
            </div>
            <br><br>

            <input type="submit" name="submit" id="submit" value="Atualizar dados de veículo">
    </form>
    </div>
</body>
</html>