<?php require_once("verificaAutenticacao.php") ?>
<?php
//1. Conectar no BD (IP, usuário, senha, nome do banco)
$conexao = mysqli_connect('127.0.0.1', 'root', '', 'ifpr');

//Verifica se foi clicado no botão 'excluir'
if (isset($_GET['id'])) {
    $sql = "delete from usuario where id = ". $_GET['id'];
    mysqli_query($conexao, $sql);
    $mensagem = "<i class='bi bi-check-circle'></i> Usuário excluído com sucesso.";
}

//2. Prepara a SQL
$sql = "select * from usuario";

//3. Executa a SQL
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário Listar</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
</head>
<body>

    <?php require_once("menu.php"); ?>

    <div class="container">

        <?php if (isset($mensagem)) { ?>
            <div class="alert alert-success" role="alert">
                <?= $mensagem ?>
            </div>
        <?php } ?>
        
        
        <div class="card mt-3">
            <div class="card-header">
                Listagem de Usuários
                <a href="usuario-cadastrar.php" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </div>
            <div class="card-body">
                
        
<!--
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <h2 class="card-title">Listagem de Usuários
                    <a href="usuario-cadastrar.php" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i></a>
                </h2>
            </div>
        </div>
            -->
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col"><i class="bi bi-envelope-at"></i> Email</th>
                    <th scope="col">Grupo de Usuário</th>
                    <th scope="col"><i class="bi bi-calendar3"></i> Data de Cadastro</th>
                    <th scope="col"><i class="bi bi-list-task"></i> Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php //$resultado é a consulta de todos os usuários da tabela ?>
                <?php while ($linha = mysqli_fetch_array($resultado)): ?>
                    <tr>
                        <td><?= $linha['id'] ?></td>
                        <td><?= $linha['nome'] ?></td>
                        <td><?= $linha['email'] ?></td>
                        <td>
                            <?php 
                            if ($linha['grupousuario_id'] != '') {
                                $sqlGrupo = "select nome from grupousuario 
                                        where id = " . $linha['grupousuario_id'];

                                $resultadoGrupo = mysqli_query($conexao, $sqlGrupo);
                                $linhaGrupo = mysqli_fetch_array($resultadoGrupo);
                                echo $linhaGrupo['nome'];
                            }
                            ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($linha['datacadastro'])) ?></td>
                        <td>
                            <a class="btn btn-warning" 
                                href="usuario-alterar.php?id=<?= $linha['id'] ?>">
                                <i class="bi bi-pen"></i> Alterar
                            </a>

                            <a href="usuario-listar.php?id=<?= $linha['id'] ?>" class="btn btn-danger" 
                                    onclick="return confirm('Confirma exclusão?')">
                                    <i class="bi bi-trash3"></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>

        </table>
            </div>
        </div>
    </div>
</body>
</html>