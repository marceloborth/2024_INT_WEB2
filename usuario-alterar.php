<?php require_once("verificaAutenticacao.php") ?>
<?php
//1. Conectar no BD (IP, usuário, senha, nome do banco)
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'ifpr');

//Criar a SQL
$sql = "select * from usuario where id = " . $_GET['id'];
//Executa a SQL
$resultado = mysqli_query($conexao, $sql);
//Pega o usuário do BD
$usuario = mysqli_fetch_array($resultado);


//O usuário clicou no botão salvar? Se sim, entra no if
if (isset($_POST['salvar'])) {
    //2. Pegar os dados pra inserir no BD
    $id    = $_POST['id']; // 'id' variável do formulário
    $nome  = $_POST['nome']; // 'nome' variável do formulário
    $email = $_POST['email']; // 'email' variável do formulário

    //3. Preparar a SQL
    $sql = "update usuario
               set nome  = '$nome', 
                   email = '$email'
             where id    = '$id'";
    
    //4. Executar a SQL
    mysqli_query($conexao, $sql);

    //5. Mostrar mensagem ao usuário
    $mensagem = "<i class='bi bi-check-circle'></i> Registro alterado com sucesso";
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

        <h1 class="mt-2">Usuário Alterar</h1>

        <form method="post">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input name="nome" type="text" class="form-control"
                    id="nome" required
                    value="<?php echo $usuario['nome'] ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" 
                    id="email" required
                    value="<?php echo $usuario['email'] ?>">
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