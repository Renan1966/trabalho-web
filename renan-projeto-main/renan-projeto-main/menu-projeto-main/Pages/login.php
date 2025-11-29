<?php
    require '../Classes/usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../JS/menu.js"></script>
</head>
<body>
    <header>
        <nav id="navbar">
            <div class="header-logo">
                <a href="home.php"> 
                    <img src="../imagem/unnamed.jpg" alt="Logo da Marca - Clique para ir para a página inicial" class="logo-site">
                </a>
            </div>
            <ul id="nav_list">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="home.php#cardapio" class="nav-link">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="home.php#depoimentos" class="nav-link">Avaliações</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
            </ul>
        </nav>
        <button class="mobile-btn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="mobile-menu">
            <ul class="mobile-nav-list">
                <li class="nav-item"><a href="home.php">Home</a></li>
                <li class="nav-item"><a href="home.php#cardapio">Cardápio</a></li>
                <li class="nav-item"><a href="home.php#depoimentos">Avaliações</a></li>
                <li class="nav-item"><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <div class="container-login">
        <h2>LOGIN</h2>
        <form method="post">
            <input type="email" name="email" placeholder="Digite seu email" required>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
            <input type="submit" value="ENTRAR">
            <p>Não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
        </form>
    <?php
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if(!empty($email) && !empty($senha))
            {
                $usuario->conectar("estacio2025","localhost", "root", "");
                if($usuario->msgErro == "")
                {
                    $resultado = $usuario->logar($email, $senha);
                    if($resultado === "admin")
                    {
                        ?>
                            <div class="msg-sucesso">
                                <p>Bem-vindo Administrador! Redirecionando...</p>
                            </div>
                            <script>
                                setTimeout(function(){
                                    window.location.href = 'areaAdmin.php';
                                }, 2000);
                            </script>
                        <?php
                    }
                    else if($resultado === true)
                    {
                        ?>
                            <div class="msg-sucesso">
                                <p>Login realizado com sucesso! Redirecionando...</p>
                            </div>
                            <script>
                                setTimeout(function(){
                                    window.location.href = 'areaRestrita.php';
                                }, 2000);
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <div class="msg-erro">
                                <p>Email ou senha incorretos!</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$usuario->msgErro; ?>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <p>Preencha todos os campos!</p>
                    </div>
                <?php
            }
        }

    ?>
    </div>
</body>
</html>
