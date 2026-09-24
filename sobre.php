<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <h1>Catálogo de Produtos</h1>
            <a href="cadastroDeProduto.php">Cadastrar</a>
            <a href="produtosCadastrados.php">Produtos</a>
            <a href="sobre.php">Sobre o Aluno</a>
        </nav>
    </header>
    <main>
        <section id="mensagem">
            <h1>Sobre o Aluno</h1>
            <p>informações sobre o desenvolvedor do projeto</p>
        </section>
        <section id="aluno">
            <h2>Nome do Aluno</h2>
            <p>Matricula: 00000</p>
            <p>Curso: Ciência da Computação</p>
            <p>Turma: 4° Período</p>
            <p>Este site foi desenvolvido como atividade prática da disciplina de programação web II.</p>
        </section>
        <section id="sessão">
            <h2>Informações da Sessão</h2>
            <p>
                <?php 
                session_start();

                if(!isset($_SESSION['acessos'])) {
                    $_SESSION['acessos'] = 0;
                }

                $_SESSION['acessos']++;

                $metodo = $_SERVER['REQUEST_METHOD'];

                $servidor = $_SERVER['SERVER_NAME'];

                echo "Número de acessos nesta sessão: " . $_SESSION['acessos'] . "<br>";
                echo "Método de requisição: " . $metodo . "<br>";
                echo "Servidor: " . $servidor;
                ?>
            </p>
        </section>
    </main>
</body>
</html>