<?php
    require '../Classes/produto.php';
    $produto = new Produto();
    $produto->conectar("estacio2025", "localhost", "root", "");
    $listaProdutos = $produto->listarProdutos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanchonete Git</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="../CSS/carrossel.css">
    <link rel="stylesheet" href="../CSS/rodape.css">
    <link rel="stylesheet" href="../CSS">    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../JS/menu.js"></script>

</head>
<body>
    <header>
        <nav id="navbar">
                 <div class="header-logo">
  <a href="index.html">
    <img src="../imagem/unnamed.jpg" alt="Logo da Marca - Clique para ir para a página inicial" class="logo-site">
  </a>
</div>
                    <a href="#home" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#cardapio" class="nav-link">Produtos</i>
                </li>
                <li class="nav-item">
                    <a href="#depoimentos" class="nav-link">Avaliaçoes</i>
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
                <li class="nav-item"><a href="#home">Home</a></li>
                <li class="nav-item"><a href="#cardapio">Produtos</a></li>
                <li class="nav-item"><a href="#depoimentos">Avaliacoes</a></li>
                <li class="nav-item"><a href="login.php">Login</a></li>
            </ul>
        </div>
    </header>

    <div class="carrossel"><br><br>
        <div class="sc-track">
            <img src="../imagem/2.webp" class="sc-slide" alt="Slide 1">
            <img src="../imagem/3.webp" class="sc-slide" alt="Slide 2">
            <img src="../imagem/4.webp" class="sc-slide" alt="Slide 3">
            <img src="../imagem/6.jpg" class="sc-slide" alt="Slide 4">
             <img src="../imagem/7.jpeg" class="sc-slide" alt="Slide 5">
              <img src="../imagem/9cf54082-8db4-4817-b869-5ad35deeb61e-65aeae7b0b4df.webp" class="sc-slide" alt="Slide 6">
               <img src="../imagem/234329232b036626abd.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/1000894414-668c9597659bc.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/1.jpg" class="sc-slide" alt="Slide 7">
               <img src="../imagem/2.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/3.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/4.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/5.webp" class="sc-slide" alt="Slide 7">
               <img src="../imagem/6.jpg" class="sc-slide" alt="Slide 7">
               <img src="../imagem/7.jpeg" class="sc-slide" alt="Slide 7">
               <img src="../imagem/8.jpeg" class="sc-slide" alt="Slide 7">
               
            
        </div>
        <button class="sc-btn left">&#10094;</button>
        <button class="sc-btn right">&#10095;</button>
        <div class="sc-dots"></div>
    </div>

    <script src="../JS/carrossel.js"></script>

    <section class="cardapio" id="cardapio">
        <h2 class="section-title">Bem Vindo</h2>
        <h3 class="section-subtitle">Conheça Nossos Produtos</h3>
        <div class="area-cards">
            <?php if(count($listaProdutos) > 0): ?>
                <?php foreach($listaProdutos as $prod): ?>
                    <div class="card" data-id="<?php echo $prod['id_produto']; ?>">
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
                            <button class="btn-default">
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
    <footer>
        <footer class="site-footer">
    <div class="footer-container">
        
        <div class="footer-section brand-info">
            <div class="footer-logo">
                <img src="../imagem/unnamed.jpg" alt="RN Nunes Logo">
            </div>
            <p class="footer-slogan">Time, Style, Signature.</p>
            <p class="brand-description">Descubra a elegância atemporal e a curadoria exclusiva em relógios, colares e moda masculina.</p>
        </div>

        <div class="footer-section nav-links">
            <h3>Navegação</h3>
            <ul>
                <li><a href="/colecoes">Coleções</a></li>
                <li><a href="/masculino">Masculino</a></li>
                <li><a href="/feminino">Feminino</a></li>
                <li><a href="/acessorios">Acessórios</a></li>
                <li><a href="/novidades">Novidades</a></li>
            </ul>
        </div>
        <div class="footer-section help-links">
            <h3>Ajuda & Suporte</h3>
            <ul>
                <li><a href="/contato">Fale Conosco</a></li>
                <li><a href="/faq">FAQ - Perguntas Frequentes</a></li>
                <li><a href="/trocas-devolucoes">Trocas e Devoluções</a></li>
                <li><a href="/politica-privacidade">Política de Privacidade</a></li>
                <li><a href="/termos-servico">Termos de Serviço</a></li>
            </ul>
        </div>

        <div class="footer-section social-newsletter">
            <h3>Siga-nos</h3>
            <div class="social-icons">
                <a href="https://www.instagram.com/renan_nunes067/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/r_n_nunes" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/r_n_nunes" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://pinterest.com/r_n_nunes" target="_blank" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 RN Nunes. Todos os direitos reservados.</p>
        <div class="payment-icons">
            <i class="fab fa-cc-visa" title="Visa"></i>
            <i class="fab fa-cc-mastercard" title="Mastercard"></i>
            <i class="fab fa-cc-paypal" title="PayPal"></i>
            <i class="fas fa-barcode" title="Boleto Bancário"></i>
            </div>
    </div>
</footer>
    </footer>

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

            const whatsappSalvo = localStorage.getItem('whatsapp_loja');
            const numeroPadrao = '97981952020';
            const numero = whatsappSalvo || numeroPadrao;

            const ddd = numero.substring(2, 4);
            const parte1 = numero.substring(4, 9);
            const parte2 = numero.substring(9);
            const numeroFormatado = '(' + ddd + ') ' + parte1 + '-' + parte2;

            const phoneButton = document.getElementById('phoneButton');
            const phoneNumber = document.getElementById('phoneNumber');
            if (phoneButton && phoneNumber) {
                phoneButton.href = 'tel:+' + numero;
                phoneNumber.textContent = numeroFormatado;
            }

            const whatsappFooter = document.getElementById('whatsappFooter');
            if (whatsappFooter) {
                whatsappFooter.href = 'https://wa.me/' + numero;
            }
        });
    </script>
</body>
</html>
