<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#337ab7">
        <link rel="icon" href="assets/imagens/bola.ico">

        <title>Nutri Vida - Login</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/css/login.css" rel="stylesheet">

    </head>

    <body>

        <?php
        unset(
            $_SESSION['nome_usuario'],
            $_SESSION['id_usuario'],
            $_SESSION['login_usuario']
            );
        ?>
        <div class="container">

            <form class="form-signin" method="POST" action="config/valida_login.php">

                <h2 class="form-signin-heading text-center">Login</h2>

                <label for="usuario" class="sr-only">Usuário</label>
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuário" required autofocus>

                <label for="senha" class="sr-only">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>

                <br>

                <button id="enter_button" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button><br>
                
                <?php
                    //Se a variável não estiver vazia executa
                    if (isset($_SESSION["login_erro"]))
                    {
                        echo'<span class="label label-danger">';
                        
                        //Imprime o que estiver na variável
                        echo $_SESSION["login_erro"];

                        //Destrói os dados da variável
                        unset($_SESSION["login_erro"]);

                        echo '</span>';
                    }
                ?>
                    
            </form>

        </div> <!-- /container -->
    </body>
</html>
