<?php 
    session_start();
    
    if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true)
    {
        header("Location: login.php");
        exit;
    }

    require '../Classes/produto.php';
    $produto = new Produto();
    $produto->conectar("estacio2025", "localhost", "root", "");

    if(isset($_GET['excluir']))
    {
        $id = $_GET['excluir'];
        if($produto->excluirProduto($id))
        {
            $msgSucesso = "Produto excluido com sucesso!";
        }
        else
        {
            $msgErro = "Erro ao excluir produto!";
        }
    }

    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $qtd = $_POST['qtd'];
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];

        if(!empty($nome) && !empty($qtd) && !empty($descricao) && !empty($valor))
        {
            if($produto->cadastrarProduto($nome, $qtd, $descricao, $valor))
            {
                $msgSucesso = "Produto cadastrado com sucesso!";
            }
            else
            {
                $msgErro = "Erro ao cadastrar produto!";
            }
        }
        else
        {
            $msgErro = "Preencha todos os campos!";
        }
    }
    
    $listaProdutos = $produto->listarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Administrativa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/areaAdmin.css">
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
                    <a href="areaAdmin.php" class="nav-link">Produtos</a>
                </li>
                <li class="nav-item usuario-logado">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Administrador</span>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link btn-logout">Sair</a>
                </li>
            </ul>
        </nav>
        <button class="mobile-btn">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="mobile-menu">
            <ul class="mobile-nav-list">
                <li class="nav-item"><a href="areaAdmin.php">Produtos</a></li>
                <li class="nav-item"><i class="fa-solid fa-user-shield"></i> Administrador</li>
                <li class="nav-item"><a href="logout.php">Sair</a></li>
            </ul>
        </div>
    </header>

    <main class="area-admin">
        <div class="container-admin">
            <h2><i class="fa-brands fa-whatsapp"></i> Configurar WhatsApp</h2>
            <div class="config-whatsapp">
                <div class="form-group">
                    <label for="whatsapp">Numero do WhatsApp (com DDD)</label>
                    <div class="input-whatsapp">
                        <span class="prefixo">+55</span>
                        <input type="text" id="whatsapp" placeholder="Ex: 67966666666" maxlength="11">
                        <button type="button" class="btn-salvar-whatsapp" id="btnSalvarWhatsapp">
                            <i class="fa-solid fa-save"></i> Salvar
                        </button>
                    </div>
                    <small class="hint">Este numero recebera os pedidos dos clientes</small>
                </div>
                <div id="msgWhatsapp"></div>
            </div>
        </div>

        <div class="container-admin">
            <h2>Cadastrar Novo Produto</h2>

            <?php if(isset($msgSucesso)): ?>
                <div class="msg-sucesso">
                    <p><?php echo $msgSucesso; ?></p>
                </div>
            <?php endif; ?>

            <?php if(isset($msgErro)): ?>
                <div class="msg-erro">
                    <p><?php echo $msgErro; ?></p>
                </div>
            <?php endif; ?>

            <form method="post" class="form-produto">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nome">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" placeholder="Ex: X-Burguer" required>
                    </div>
                    <div class="form-group">
                        <label for="qtd">Quantidade</label>
                        <input type="number" name="qtd" id="qtd" placeholder="Ex: 50" required>
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor (R$)</label>
                        <input type="text" name="valor" id="valor" placeholder="Ex: 25.00" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="descricao">Descricao</label>
                        <textarea name="descricao" id="descricao" rows="3" placeholder="Descreva o produto..." required></textarea>
                    </div>
                    <div class="form-group full-width">
                        <label for="imagem">Imagem do Produto</label>
                        <input type="file" name="imagem" id="imagem" accept="image/*">
                        <div id="preview-imagem"></div>
                    </div>
                </div>
                <input type="hidden" name="id_produto_img" id="id_produto_img">
                <button type="submit" class="btn-cadastrar">
                    <i class="fa-solid fa-plus"></i> Cadastrar Produto
                </button>
            </form>
        </div>

        <div class="container-admin">
            <h2>Produtos Cadastrados</h2>

            <?php if(count($listaProdutos) > 0): ?>
                <table class="tabela-produtos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Qtd</th>
                            <th>Descricao</th>
                            <th>Valor</th>
                            <th>Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaProdutos as $prod): ?>
                            <tr>
                                <td><?php echo $prod['id_produto']; ?></td>
                                <td><?php echo $prod['nome']; ?></td>
                                <td><?php echo $prod['qtd']; ?></td>
                                <td class="descricao-cell"><?php echo $prod['descricao']; ?></td>
                                <td>R$ <?php echo number_format($prod['valor'], 2, ',', '.'); ?></td>
                                <td class="acoes">
                                    <a href="areaAdmin.php?excluir=<?php echo $prod['id_produto']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="sem-produtos">Nenhum produto cadastrado ainda.</p>
            <?php endif; ?>
        </div>
    </main>

    <script>
        document.getElementById('imagem').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const base64 = event.target.result;
                    document.getElementById('preview-imagem').innerHTML = '<img src="' + base64 + '" style="max-width: 150px; margin-top: 10px; border-radius: 8px;">';
                    sessionStorage.setItem('tempImagem', base64);
                };
                reader.readAsDataURL(file);
            }
        });

        document.querySelector('.form-produto').addEventListener('submit', function(e) {
            const tempImagem = sessionStorage.getItem('tempImagem');
            if (tempImagem) {
                const ultimoId = <?php echo count($listaProdutos) > 0 ? $listaProdutos[0]['id_produto'] : 0; ?>;
                const novoId = ultimoId + 1;
                localStorage.setItem('produto_img_' + novoId, tempImagem);
                sessionStorage.removeItem('tempImagem');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const linhas = document.querySelectorAll('.tabela-produtos tbody tr');
            linhas.forEach(function(linha) {
                const id = linha.querySelector('td:first-child').textContent;
                const imagem = localStorage.getItem('produto_img_' + id);
                if (imagem) {
                    const celulaNome = linha.querySelector('td:nth-child(2)');
                    celulaNome.innerHTML = '<img src="' + imagem + '" class="img-produto-tabela"> ' + celulaNome.textContent;
                }
            });

            const numeroSalvo = localStorage.getItem('whatsapp_loja');
            if (numeroSalvo) {
                const numero = numeroSalvo.startsWith('55') ? numeroSalvo.substring(2) : numeroSalvo;
                inputWhatsapp.value = numero;
            }
        });

        document.querySelectorAll('.btn-excluir').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const id = href.split('=')[1];
                if (confirm('Tem certeza que deseja excluir este produto?')) {
                    localStorage.removeItem('produto_img_' + id);
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });

        const inputWhatsapp = document.getElementById('whatsapp');
        const btnSalvarWhatsapp = document.getElementById('btnSalvarWhatsapp');
        const msgWhatsapp = document.getElementById('msgWhatsapp');

        btnSalvarWhatsapp.addEventListener('click', function() {
            const numero = inputWhatsapp.value.replace(/\D/g, '');

            if (numero.length < 10 || numero.length > 11) {
                msgWhatsapp.innerHTML = '<div class="msg-erro"><p>Numero invalido! Use DDD + numero (10 ou 11 digitos)</p></div>';
                return;
            }

            localStorage.setItem('whatsapp_loja', '55' + numero);
            msgWhatsapp.innerHTML = '<div class="msg-sucesso"><p>Numero salvo com sucesso!</p></div>';

            setTimeout(function() {
                msgWhatsapp.innerHTML = '';
            }, 3000);
        });

        inputWhatsapp.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
