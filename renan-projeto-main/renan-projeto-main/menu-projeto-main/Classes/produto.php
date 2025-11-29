<?php
    Class Produto
    {
        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            try{
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            }
            catch(PDOException $erro){
                $this->msgErro = $erro->getMessage();
            }
        }

        public function cadastrarProduto($nome, $qtd, $descricao, $valor)
        {
            global $pdo;

            $produto = $pdo->prepare("INSERT INTO produtos (nome, qtd, descricao, valor) VALUES (:n, :q, :d, :v)");
            $produto->bindValue(":n", $nome);
            $produto->bindValue(":q", $qtd);
            $produto->bindValue(":d", $descricao);
            $produto->bindValue(":v", $valor);

            if($produto->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function listarProdutos()
        {
            global $pdo;

            $produtos = $pdo->prepare("SELECT * FROM produtos ORDER BY id_produto DESC");
            $produtos->execute();
            return $produtos->fetchAll();
        }

        public function excluirProduto($id_produto)
        {
            global $pdo;

            $produto = $pdo->prepare("DELETE FROM produtos WHERE id_produto = :id");
            $produto->bindValue(":id", $id_produto);

            if($produto->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function editarProduto($id_produto, $nome, $qtd, $descricao, $valor)
        {
            global $pdo;

            $produto = $pdo->prepare("UPDATE produtos SET nome = :n, qtd = :q, descricao = :d, valor = :v WHERE id_produto = :id");
            $produto->bindValue(":n", $nome);
            $produto->bindValue(":q", $qtd);
            $produto->bindValue(":d", $descricao);
            $produto->bindValue(":v", $valor);
            $produto->bindValue(":id", $id_produto);

            if($produto->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>
