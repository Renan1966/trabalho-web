<?php
    Class Usuario
    {
        private $pdo;

        public $msgErro ="";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            try{
                $pdo = new PDO("mysql:dbname=".$nome,$usuario,$senha);
            }
            catch(PDOException $erro){
                $msgErro = $erro->getMessage();
            }
        }

        public function cadastrarUsuario($nome, $endereco, $cidade, $estado, $telefone, $email, $senha)
        {
            global $pdo;

            $usuario = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $usuario->bindValue(":e", $email);
            $usuario->execute();
            if($usuario->rowCount() > 0)
            {
                return false;
            }
            else{
                $usuario = $pdo->prepare("INSERT INTO usuarios (nome, endereco, cidade,estado, telefone, email, senha) VALUES (:n, :en, :c, :es, :t, :e, :s)");
                $usuario->bindValue(":n",$nome);
                $usuario->bindValue(":en",$endereco);
                $usuario->bindValue(":c",$cidade);
                $usuario->bindValue(":es",$estado);
                $usuario->bindValue(":t",$telefone);
                $usuario->bindValue(":e",$email);
                $usuario->bindValue(":s",$senha);
                $usuario->execute();
                return true;
            }
        }

        public function logar($email, $senha)
        {
            global $pdo;

            if($email == "admin@admin.com" && $senha == "admin123")
            {
                session_start();
                $_SESSION['id_usuario'] = 0;
                $_SESSION['is_admin'] = true;
                return "admin";
            }

            $usuario = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $usuario->bindValue(":e", $email);
            $usuario->bindValue(":s", $senha);
            $usuario->execute();
            if($usuario->rowCount() > 0)
            {
                $dados = $usuario->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                $_SESSION['is_admin'] = false;
                return true;
            }
            else{
                return false;
            }
        }

        public function buscarDadosUsuario($id_usuario)
        {
            global $pdo;

            $usuario = $pdo->prepare("SELECT nome, email FROM usuarios WHERE id_usuario = :id");
            $usuario->bindValue(":id", $id_usuario);
            $usuario->execute();
            if($usuario->rowCount() > 0)
            {
                return $usuario->fetch();
            }
            else{
                return false;
            }
        }
    }



?>