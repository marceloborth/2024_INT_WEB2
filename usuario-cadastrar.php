<?php require_once("verificaAutenticacao.php") ?>
<?php
//1. Conectar no BD (IP, usuário, senha, nome do banco)
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'ifpr');

//O usuário clicou no botão salvar? Se sim, entra no if
if (isset($_POST['salvar'])) {
    //2. Pegar os dados pra inserir no BD
    $nome  = $_POST['nome'];  // 'nome' variável do formulário
    $email = $_POST['email']; // 'email' variável do formulário
    $senha = $_POST['senha']; // 'senha' variável do formulário
    $grupousuario_id = $_POST['grupousuario_id'];

    //3. Preparar a SQL
    $sql = "insert into usuario (nome, email, senha, grupousuario_id) 
            values ('$nome', '$email', '$senha', $grupousuario_id)";
    
    //4. Executar a SQL
    mysqli_query($conexao, $sql);

    //5. Mostrar mensagem ao usuário
    $mensagem = "<i class='bi bi-check-circle'></i> Usuário cadastrado com sucesso";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap.min.css" />
</head>
<body>

    <?php require_once("menu.php"); ?>

    <div class="container">
        <!-- 
            SE foi clicado no botão cadastrar e agora tem
            a variável $mensagem criada, mostra o alerta.
         -->
        <?php if (isset($mensagem)) { ?>
            <div class="alert alert-success" role="alert">
                <?= $mensagem ?>
            </div>
        <?php } ?>

        <h1 class="mt-2">Usuário Cadastrar</h1>

        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control" id="nome" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input name="senha" type="password" class="form-control" id="senha" required>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlSelect1">Grupo de Usuário</label>
                <select class="form-select" name="grupousuario_id">
                    <option selected>-- Selecione --</option>
                    <?php
                    $sql = "select * from grupousuario order by nome";
                    $resultado = mysqli_query($conexao, $sql);

                    while ($linha = mysqli_fetch_array($resultado)){
                        $id = $linha['id'];
                        $nome = $linha['nome'];

                        echo "<option value='$id'>$nome</option>";
                    }
                    ?>
                </select>
            </div>

            <button name="salvar" type="submit" class="btn btn-primary">
                <i class="fa-solid fa-check"></i> Salvar
            </button>
            
            <a class="btn btn-warning" href="usuario-listar.php">
                Voltar</a>

        </form>
    </div>

</body>
</html>