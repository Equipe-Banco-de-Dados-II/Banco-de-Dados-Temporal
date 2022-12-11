<?php
    if(isset($_POST['submit']))
    {
        include_once("config.php");

        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];
        
        $sql = "SELECT * FROM usuario WHERE cpf='$cpf' AND senha='$senha'";
        $result = mysqli_query($conexao, $sql);
        $n_rows = mysqli_num_rows($result);     //numero de linhas

        if ($n_rows=="0" || $n_rows==0){        //se não for selecionado nenhuma linha, significa que o cpf ou a senha não estão no BD
            echo "<script type='text/javascript'>alert('Usuário ou senha inválida!');window.location.href='index.php';</script>";
        }else{
            $row = mysqli_fetch_assoc($result);
            if($row['nivel_acesso']=='A'){      //se usuário for administrador, acessa menu de administrador
                echo "<script type='text/javascript'>alert('Login feito com sucesso!');window.location.href='pages/menu-locacao-administrador.php';</script>";
            }
            elseif($row['nivel_acesso']=='C'){  //se usuário for cliente, acessa menu de cliente
                echo "<script type='text/javascript'>alert('Login feito com sucesso!');window.location.href='pages/menu-locacao-cliente.php';</script>";
            }
        }

        /*while($row = mysqli_fetch_assoc($result))
        {
            if($row[''])
            echo "{$row['p_nome']} <br>";
        }*/
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
        <form action="index.php" method="POST">
            <header><b>LOGIN</b></header>
            <div class="inputBox">
                <input type="text" name="cpf" id="cpf" class="inputUser" required>
                <label for="cpf" class="labelInput">Usuário (CPF)</label>
            </div>
            
            <br>
            <div class="inputBox">
                <input type="text" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelInput">Senha</label>
            </div>
            <br><br>

            <input type="submit" name="submit" id="submit" value="Acessar">
            <br><br>

            <input class="botao-cadastrar" type="button" value="Cadastrar conta" onclick="location.href='pages/cadastro.php'">
    </form>
    </div>
</body>
</html>