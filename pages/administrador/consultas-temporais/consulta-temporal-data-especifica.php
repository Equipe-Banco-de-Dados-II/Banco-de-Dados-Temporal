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
        <form action="consulta-temporal-data-especifica.php" method="POST">
            <header><b>CONSULTA TEMPORAL 2</b></header>
            <br>
            <label for="data"><b>Data de uso do veículo: </b></label>
            <input type="date" name="data" id="data" required>
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
            
                    $data = $_POST['data'];
                    $locado = $_POST['locado'];

                    if($locado=="S"){
                        //se o usuário quer apresente apenas os veículos que estão locados e determinada data, faz uma busca com cpf_locatario not null
                        $sql = "SELECT * FROM veiculo WHERE (('$data' BETWEEN tempo_inicial_valido AND tempo_final_valido) OR (tempo_inicial_valido<='2022-12-02' AND tempo_final_valido IS NULL)) AND cpf_locatario IS NOT NULL";
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
                        }
                    }
                    else{
                        //senão busca por todos
                        $sql = "SELECT * FROM veiculo WHERE ('$data' BETWEEN tempo_inicial_valido AND tempo_final_valido) OR (tempo_inicial_valido<='2022-12-02' AND tempo_final_valido IS NULL)";
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