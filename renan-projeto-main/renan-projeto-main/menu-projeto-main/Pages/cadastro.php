<?php 
    require '../Classes/usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/cadastro.css">
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

    <div class="container-cadastro">
        <h2>CADASTRO DE USUÁRIO</h2>
        <form method="post">
            <div class="form-grid">
                <div class="form-column">
                    <input type="text" name="nome" placeholder="Digite seu nome." required>
                    <input type="email" name="email" placeholder="Digite seu email" required>
                    <input type="text" name="endereco" placeholder="Digite seu endereço." required>
                    <input type="text" name="cidade" placeholder="Digite a cidade onde você mora." required>
                </div>
                <div class="form-column">
                    <input type="text" name="estado" placeholder="Digite o estado onde você mora." required>
                    <input type="tel" name="telefone" placeholder="Digite o número do seu telefone." required>
                    <input type="password" name="senha" placeholder="Digite sua senha." required>
                    <input type="password" name="Confsenha" placeholder="Confirme sua senha." required>
                </div>
            </div>
            <input type="submit" value="CADASTRAR">
            <p>Já é cadastrado? Clique <a href="login.php">Aqui</a> para acessar.</p>
        </form>
    <?php 
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confsenha = addslashes($_POST['Confsenha']);
            
            if(!empty($nome) && !empty($endereco) && !empty($cidade) && !empty($estado) && !empty($telefone) && !empty($email) && !empty($senha))
            {
                $usuario->conectar("estacio2025","localhost", "root", "");
                if($usuario->msgErro == "")
                {
                    if($senha == $confsenha)
                    {
                        if($usuario->cadastrarUsuario($nome,$endereco,$cidade,$estado,$telefone,$email, $senha)){

                            ?>
                                <div class="msg-sucesso">
                                    <p>Usuário Cadastrado com Sucesso.</p>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class="msg-erro">
                                    <p>Usuário Já cadastrado.</p>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                                <div class="msg-erro">
                                    <p>Senha e confirmar senha não conferem</p>
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
        }

    ?>
    </div>
</body>
</html>