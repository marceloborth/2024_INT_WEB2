<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <div class="container">

        <!-- Bloco de mensagem -->
        <?php if (isset($_GET['mensagem'])) { ?>
            <div class="alert alert-warning mt-3" role="alert">
                <?= $_GET['mensagem'] ?>
            </div>
        <?php } ?>


        <div class="card mb-3 mt-3">
            <div class="card-body">
                <h5 class="card-title">Acesso ao sistema</h5>
            </div>
        </div>
        <form method="post" action="autenticacao.php">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" value="marcelo.borth@ifpr.edu.br">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input name="senha" type="password" class="form-control" id="senha" value="123">
            </div>
            <button name="entrar" type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

</body>
</html>