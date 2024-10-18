<?php
if (isset($_POST['entrar'])) {
    //1. Pegar os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //2.Criar a SQL
    $sql = "select *
              from usuario
             where email = '$email'
               and senha = '$senha'";

    //3. Realiza a consulta no BD
    $conexao = mysqli_connect('127.0.0.1', 'root', '', 'ifpr');
    $resultado = mysqli_query($conexao, $sql);
    /*Retorna o número de linha da consulta, ou seja, quantos usuários temos 
     * para esse email e senha (mysqli_num_rows)
     */
    $num_linhas = mysqli_num_rows($resultado);
    
    //4. Verifica se o usuário existe no BD
    if ($num_linhas > 0) {
        //Realiza a autenticação
        
        $linha = mysqli_fetch_array($resultado); //Pega usuário do login
        session_start(); //Inicio a sessão no PHP
        
        //Seta as variáveis de sessão
        $_SESSION['id']    = $linha['id'];
        $_SESSION['nome']  = $linha['nome'];
        $_SESSION['email'] = $linha['email'];

        header("location: menu.php");
    } else {
        //Volta para o login
        header("location: index.php");
    }

}
