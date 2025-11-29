<?php
    session_start();

    if(!isset($_SESSION['id_usuario']))
    {
        header("Location: login.php");
        exit;
    }

    require '../Classes/usuario.php';
    require '../Classes/produto.php';

    $usuario = new Usuario();
    $usuario->conectar("estacio2025","localhost", "root", "");

    $produto = new Produto();
    $produto->conectar("estacio2025", "localhost", "root", "");
    $listaProdutos = $produto->listarProdutos();

    $dados = $usuario->buscarDadosUsuario($_SESSION['id_usuario']);
    $nomeUsuario = $dados['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Restrita - Cardapio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/cardapio.css">
    <link rel="stylesheet" href="../CSS/areaRestrita.css">
    <link rel="stylesheet" href="../CSS/carrinho.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../JS/menu.js"></script>
</head>
<body>
    <header>
        <nav id="navbar">
            <i class="fa-solid fa-burger">food</i>
            <ul id="nav_list">
                <li class="nav-item">
                    <a href="areaRestrita.php" class="nav-link">Cardapio</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Meus Pedidos</a>
                </li>
                <li class="nav-item usuario-logado">
                    <i class="fa-solid fa-user"></i>
                    <span>Ola, <?php echo $nomeUsuario; ?></span>
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
                <li class="nav-item"><a href="areaRestrita.php">Cardapio</a></li>
                <li class="nav-item"><a href="#">Meus Pedidos</a></li>
                <li class="nav-item usuario-mobile">
                    <i class="fa-solid fa-user"></i> Ola, <?php echo $nomeUsuario; ?>
                </li>
                <li class="nav-item"><a href="logout.php">Sair</a></li>
            </ul>
        </div>
    </header>

    <div class="carrinho-flutuante" id="btnCarrinho">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="carrinho-contador" id="carrinhoContador">0</span>
    </div>

    <div class="carrinho-overlay" id="carrinhoOverlay"></div>
    <div class="carrinho-lateral" id="carrinhoLateral">
        <div class="carrinho-header">
            <h3><i class="fa-solid fa-cart-shopping"></i> Meu Carrinho</h3>
            <button class="btn-fechar-carrinho" id="btnFecharCarrinho">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="carrinho-itens" id="carrinhoItens">
        </div>
        <div class="carrinho-vazio" id="carrinhoVazio">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Seu carrinho esta vazio</p>
        </div>
        <div class="carrinho-footer" id="carrinhoFooter">
            <div class="carrinho-total">
                <span>Total:</span>
                <span id="carrinhoTotal">R$ 0,00</span>
            </div>
            <button class="btn-finalizar" id="btnFinalizar">
                <i class="fa-brands fa-whatsapp"></i> Enviar Pedido
            </button>
        </div>
    </div>

    <main class="area-restrita">
        <section class="cardapio-section">
            <h2 class="section-title">Bem vindo </h2>
            <h3 class="section-subtitle">Conheça nossos Produtos</h3>

            <div class="area-cards">
                <?php if(count($listaProdutos) > 0): ?>
                    <?php foreach($listaProdutos as $prod): ?>
                        <div class="card" data-id="<?php echo $prod['id_produto']; ?>" data-nome="<?php echo $prod['nome']; ?>" data-valor="<?php echo $prod['valor']; ?>">
                            <img src="../imagem/pngwing.com (1).png" alt="Imagem do Lanche" class="card-imagem" id="img-<?php echo $prod['id_produto']; ?>">
                            <h3 class="card-title"><?php echo $prod['nome']; ?></h3>
                            <span class="card-descricao">
                                <?php echo $prod['descricao']; ?>
                            </span>
                            <div class="card-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <span>(<?php echo rand(100, 900); ?>+)</span>
                            </div>
                            <div class="card-price">
                                <h4>R$ <?php echo number_format($prod['valor'], 2, ',', '.'); ?></h4>
                                <button class="btn-default btn-adicionar-carrinho">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="sem-produtos">Nenhum produto disponivel no momento.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                const id = card.getAttribute('data-id');
                const imagem = localStorage.getItem('produto_img_' + id);
                if (imagem) {
                    const imgElement = document.getElementById('img-' + id);
                    if (imgElement) {
                        imgElement.src = imagem;
                    }
                }
            });
            carregarCarrinho();
        });

        let carrinho = [];

        const btnCarrinho = document.getElementById('btnCarrinho');
        const carrinhoLateral = document.getElementById('carrinhoLateral');
        const carrinhoOverlay = document.getElementById('carrinhoOverlay');
        const btnFecharCarrinho = document.getElementById('btnFecharCarrinho');
        const carrinhoItens = document.getElementById('carrinhoItens');
        const carrinhoVazio = document.getElementById('carrinhoVazio');
        const carrinhoFooter = document.getElementById('carrinhoFooter');
        const carrinhoContador = document.getElementById('carrinhoContador');
        const carrinhoTotal = document.getElementById('carrinhoTotal');

        btnCarrinho.addEventListener('click', function() {
            carrinhoLateral.classList.add('aberto');
            carrinhoOverlay.classList.add('aberto');
        });

        btnFecharCarrinho.addEventListener('click', fecharCarrinho);
        carrinhoOverlay.addEventListener('click', fecharCarrinho);

        function fecharCarrinho() {
            carrinhoLateral.classList.remove('aberto');
            carrinhoOverlay.classList.remove('aberto');
        }

        document.querySelectorAll('.btn-adicionar-carrinho').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const card = this.closest('.card');
                const id = card.getAttribute('data-id');
                const nome = card.getAttribute('data-nome');
                const valor = parseFloat(card.getAttribute('data-valor'));
                const imagem = document.getElementById('img-' + id).src;
                adicionarAoCarrinho(id, nome, valor, imagem);
            });
        });

        function adicionarAoCarrinho(id, nome, valor, imagem) {
            const itemExistente = carrinho.find(item => item.id === id);
            if (itemExistente) {
                itemExistente.quantidade++;
            } else {
                carrinho.push({
                    id: id,
                    nome: nome,
                    valor: valor,
                    imagem: imagem,
                    quantidade: 1
                });
            }
            salvarCarrinho();
            atualizarCarrinho();
            carrinhoLateral.classList.add('aberto');
            carrinhoOverlay.classList.add('aberto');
        }

        function removerDoCarrinho(id) {
            carrinho = carrinho.filter(item => item.id !== id);
            salvarCarrinho();
            atualizarCarrinho();
        }

        function alterarQuantidade(id, acao) {
            const item = carrinho.find(item => item.id === id);
            if (item) {
                if (acao === 'aumentar') {
                    item.quantidade++;
                } else if (acao === 'diminuir') {
                    item.quantidade--;
                    if (item.quantidade <= 0) {
                        removerDoCarrinho(id);
                        return;
                    }
                }
                salvarCarrinho();
                atualizarCarrinho();
            }
        }

        function atualizarCarrinho() {
            const totalItens = carrinho.reduce((acc, item) => acc + item.quantidade, 0);
            carrinhoContador.textContent = totalItens;

            if (carrinho.length === 0) {
                carrinhoVazio.style.display = 'flex';
                carrinhoItens.style.display = 'none';
                carrinhoFooter.style.display = 'none';
            } else {
                carrinhoVazio.style.display = 'none';
                carrinhoItens.style.display = 'block';
                carrinhoFooter.style.display = 'block';

                carrinhoItens.innerHTML = '';
                carrinho.forEach(function(item) {
                    const itemHTML = `
                        <div class="carrinho-item">
                            <img src="${item.imagem}" alt="${item.nome}" class="carrinho-item-img">
                            <div class="carrinho-item-info">
                                <h4>${item.nome}</h4>
                                <p>R$ ${item.valor.toFixed(2).replace('.', ',')}</p>
                            </div>
                            <div class="carrinho-item-qtd">
                                <button class="btn-qtd" onclick="alterarQuantidade('${item.id}', 'diminuir')">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span>${item.quantidade}</span>
                                <button class="btn-qtd" onclick="alterarQuantidade('${item.id}', 'aumentar')">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            <button class="btn-remover" onclick="removerDoCarrinho('${item.id}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    `;
                    carrinhoItens.innerHTML += itemHTML;
                });

                const total = carrinho.reduce((acc, item) => acc + (item.valor * item.quantidade), 0);
                carrinhoTotal.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            }
        }

        function salvarCarrinho() {
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
        }

        function carregarCarrinho() {
            const carrinhoSalvo = localStorage.getItem('carrinho');
            if (carrinhoSalvo) {
                carrinho = JSON.parse(carrinhoSalvo);
                atualizarCarrinho();
            }
        }

        document.getElementById('btnFinalizar').addEventListener('click', function() {
            if (carrinho.length === 0) {
                alert('Seu carrinho esta vazio!');
                return;
            }

            const numeroLoja = localStorage.getItem('whatsapp_loja') || '5567966666666';
            const nomeCliente = '<?php echo $nomeUsuario; ?>';

            let mensagem = '*NOVO PEDIDO - Lanchonete*\n\n';
            mensagem += '👤 *Cliente:* ' + nomeCliente + '\n\n';
            mensagem += '🛒 *Itens do Pedido:*\n';
            mensagem += '─────────────────\n';

            carrinho.forEach(function(item, index) {
                mensagem += (index + 1) + '. ' + item.nome + '\n';
                mensagem += '   Qtd: ' + item.quantidade + ' x R$ ' + item.valor.toFixed(2).replace('.', ',') + '\n';
                mensagem += '   Subtotal: R$ ' + (item.valor * item.quantidade).toFixed(2).replace('.', ',') + '\n\n';
            });

            mensagem += '─────────────────\n';
            const total = carrinho.reduce((acc, item) => acc + (item.valor * item.quantidade), 0);
            mensagem += '💰 *TOTAL: R$ ' + total.toFixed(2).replace('.', ',') + '*\n\n';
            mensagem += '📍 *Aguardando confirmacao do endereco de entrega*';

            const mensagemCodificada = encodeURIComponent(mensagem);
            const urlWhatsApp = 'https://wa.me/' + numeroLoja + '?text=' + mensagemCodificada;
            window.open(urlWhatsApp, '_blank');

            carrinho = [];
            salvarCarrinho();
            atualizarCarrinho();
            fecharCarrinho();
        });
    </script>
</body>
</html>
