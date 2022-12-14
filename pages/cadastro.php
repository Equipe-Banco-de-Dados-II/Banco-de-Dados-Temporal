<?php
    if(isset($_POST['submit']))
    {
        include_once("../config.php");

        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $dt_nascimento = $_POST['data_nascimento'];
        $sexo = $_POST['sexo'];
        $senha = $_POST['senha'];
        $nivel_acesso = $_POST['nivel_acesso'];
        
        $sql = "INSERT INTO usuario(cpf, p_nome, u_nome, data_nascimento, sexo, senha, nivel_acesso) VALUES ('$cpf', '$nome', '$sobrenome', '$dt_nascimento', '$sexo', '$senha', '$nivel_acesso')";
        
        //$result = mysqli_query($conexao, $sql);
        if(mysqli_query($conexao, $sql)){       //se a inserção der certo, isto é, se não houver conflito de cpf
            echo "<script type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='../index.php';</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('Cadastro inválido');window.location.href='cadastro.php';</script>";
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
        <form action="cadastro.php" method="POST">
            <header><b>CADASTRO</b></header>
            <div class="inputBox">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <label for="nome" class="labelInput">Nome</label>
            </div>

            <div class="inputBox">
                <input type="text" name="sobrenome" id="sobrenome" class="inputUser" required>
                <label for="sobrenome" class="labelInput">Sobrenome</label>
            </div>

            <div class="inputBox">
                <input type="text" name="cpf" id="cpf" class="inputUser" required>
                <label for="cpf" class="labelInput">CPF</label>
            </div>
            <br>

            <p>Sexo:</p>
            <input type="radio" id="feminino" name="sexo" value="F" required>
            <label for="feminino">Feminino</label>
            <br>
            <input type="radio" id="masculino" name="sexo" value="M" required>
            <label for="masculino">Masculino</label>
            <br>
            <input type="radio" id="outro" name="sexo" value="O" required>
            <label for="outro">Outro</label>
            <br><br>

            <label for="data_nascimento"><b>Data de Nascimento:</b></label>
            <input type="date" name="data_nascimento" id="data" required>
            <br><br>

            <div class="inputBox">
                <input type="text" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelInput">Senha</label>
            </div>
            <br><br>
            
            <p>Nível de acesso:</p>
            <input type="radio" id="admin" name="nivel_acesso" value="A" required>
            <label for="admin">Administrador</label>
            <br>
            <input type="radio" id="cliente" name="nivel_acesso" value="C" required>
            <label for="cliente">Cliente</label>
            <br><br>

            <input type="submit" name="submit" id="submit" value="Criar cadastro">
    </form>
    </div>
</body>
</html>