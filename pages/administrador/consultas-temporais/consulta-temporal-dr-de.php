<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto BD II</title>
    <link rel="stylesheet" href="../../../styles/style.css">
</head>
<body>
    <div class="main">
        <form action="consulta-temporal-dr-de.php" method="POST">
            <header><b>CONSULTA TEMPORAL</b></header>
            <br>
            <label for="data_retirada"><b>Data de retirada do veículo: </b></label>
            <input type="date" name="data_retirada" id="data_retirada" required>
            <br><br><br>
            <label for="data_entrega"><b>Data de entrega do veículo: </b></label>
            <input type="date" name="data_entrega" id="data_entrega" required>
            <br><br>
            <p>Apenas veículos locados?</p>
            <input type="radio" id="sim" name="locado" value="S" required>
            <label for="sim">Sim</label>
            <br>
            <input type="radio" id="nao" name="locado" value="N" required>
            <label for="nao">Não</label>
            <br><br>
            <input type="submit" name="submit" id="submit" value="Buscar">
        </form>
        <br>
        <div id="resultado-busca">
            <?php
                if(isset($_POST['submit']))
                {
                    include_once("../../../config.php");
            
                    $data_retirada = ($_POST['data_retirada']);
                    $data_entrega = ($_POST['data_entrega']);
                    $locado = $_POST['locado'];

                    if($locado=="S"){
                        //se o usuário quer apresente apenas os veículos que estão locados e determinada data, faz uma busca com cpf_locatario not null

                        $sql = "SELECT * FROM veiculo WHERE ((tempo_inicial_valido<='$data_entrega') AND ((tempo_inicial_valido>='$data_retirada' AND tempo_final_valido<='$data_entrega') OR (tempo_inicial_valido>='$data_retirada' AND tempo_final_valido IS NULL))) AND cpf_locatario IS NOT NULL;";
                        $result = mysqli_query($conexao, $sql);
                        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        echo "Resultado da pesquisa: <br><br>";
                        
                        foreach($rows as $row){
                            $sql = "SELECT * FROM usuario WHERE cpf='{$row['cpf_locatario']}'";
                            $result = mysqli_query($conexao, $sql);
                            $row_1 = mysqli_fetch_assoc($result);
                            
                            if($row['tempo_final_valido']==NULL){
                                echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: NOW <br>Locatário: {$row_1['p_nome']} {$row_1['u_nome']} CPF: {$row_1['cpf']} <br><br>";
                            }else{
                                echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: {$row['tempo_final_valido']} <br>Locatário: {$row_1['p_nome']} {$row_1['u_nome']} CPF: {$row_1['cpf']} <br><br>";
                            }
                            $sql = "SELECT * FROM veiculo WHERE ((tempo_inicial_valido<='$data_entrega') AND ((tempo_inicial_valido>='$data_retirada' AND tempo_final_valido<='$data_entrega') OR (tempo_inicial_valido>='$data_retirada' AND tempo_final_valido IS NULL)))";
                        }
                    }else{
                        $result = mysqli_query($conexao, $sql);
                        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        echo "Resultado da pesquisa: <br><br>";

                        foreach($rows as $row){
                            if($row['cpf_locatario']!=NULL){
                                $sql = "SELECT * FROM usuario WHERE cpf='{$row['cpf_locatario']}'";
                                $result = mysqli_query($conexao, $sql);
                                $row_1 = mysqli_fetch_assoc($result);
                                
                                if($row['tempo_final_valido']==NULL){
                                    echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: NOW <br>Locatário: {$row_1['p_nome']} {$row_1['u_nome']} CPF: {$row_1['cpf']} <br><br>";
                                }else{
                                    echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: {$row['tempo_final_valido']} <br>Locatário: {$row_1['p_nome']} {$row_1['u_nome']} CPF: {$row_1['cpf']} <br><br>";
                                }
                            }else{
                                if($row['tempo_final_valido']==NULL){
                                    echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: NOW <br>Locatário: NULL<br><br>";
                                }else{
                                    echo "Placa: {$row['placa_veiculo']} | Modelo: {$row['modelo_veiculo']} <br> Tempo inicial válido: {$row['tempo_inicial_valido']} <br>Tempo final válido: {$row['tempo_final_valido']} <br>Locatário: NULL<br><br>";
                                }
                            }
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>