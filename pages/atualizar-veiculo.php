<?php
    include_once("../config.php");

    if(isset($_POST['veiculo'])){
        echo "Você selecionou a cidade com o id " . $_POST['veiculo'];
        die("<a href=\"../index.php\">Voltar ao início</a>");
    }

    $sql = "SELECT DISTINCT placa_veiculo, modelo_veiculo FROM veiculo ORDER BY placa_veiculo ASC";
    $sql_query_states = mysqli_query($conexao, $sql);

    //$sql = "SELECT DISTINCT placa_veiculo, * FROM veiculo";
    //$result = mysqli_query($conexao, $sql);
    //$row = mysqli_fetch_assoc($result);
    //print_r($row);


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
        <form action="atualizar-veiculo.php" method="GET">
            <header><b>ATUALIZAR VEÍCULO</b></header>
            <select <?php if(isset($_POST['veiculo'])) echo "disabled"; ?> required name="veiculo">
                <option value="">Selecione um veiculo</option>
                <?php while($veiculo = mysqli_fetch_assoc($sql_query_states)) { ?> 
                <option <?php if(isset($_POST['veiculo']) && $_POST['veiculo'] == $veiculo['placa_veiculo']) echo "selected"; ?> value="<?php echo $veiculo['placa_veiculo']; ?>"><?php echo $veiculo['placa_veiculo'], " - ", $veiculo['modelo_veiculo']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <p>Campos que deseja alterar</p>
            <button for="locatario" id="desmarcar-km">Desmarcar</button>
            <input type="radio" id="km" name="km" value="km">
            <label for="km">KM Rodados</label>
            <br>
            <button for="locatario" id="desmarcar-loc">Desmarcar</button>
            <input type="radio" id="locatario" name="locatario" value="locatario">
            <label for="locatario">Locatário</label>
            <br>
            <button for="locatario" id="desmarcar-valor">Desmarcar</button>
            <input type="radio" id="valor" name="valor" value="valor">
            <label for="valor">Valor de locação</label>
            
            <br><br>

            <input type="submit" name="submit" id="submit" value="Realizar locação">
    </form>
    </div>
    <script>
        document.getElementById('desmarcar-km').onclick = function() {
            var radio = document.querySelector('input[type=radio][name=km]:checked');
            radio.checked = false;
        }
        document.getElementById('desmarcar-loc').onclick = function() {
            var radio = document.querySelector('input[type=radio][name=locatario]:checked');
            radio.checked = false;
        }
        document.getElementById('desmarcar-valor').onclick = function() {
            var radio = document.querySelector('input[type=radio][name=valor]:checked');
            radio.checked = false;
        }
    </script>
</body>
</html>