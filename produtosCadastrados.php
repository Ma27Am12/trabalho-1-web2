<?php 
session_start();

// Caminho do arquivo
$arquivo = "dados/produtos.txt";

// Captura pesquisa (se houver)
$pesquisa = isset($_GET['pesquisar']) ? trim($_GET['pesquisar']) : "";
$produtos = [];

if (file_exists($arquivo)) {
    $linhas = file($arquivo);

    foreach ($linhas as $linha) {
        $partes = explode("|", $linha);
        $produto = [];

        foreach ($partes as $parte) {
            list($chave, $valor) = explode(":", $parte);
            $produto[trim($chave)] = trim($valor);
        }

        if ($pesquisa !== "" && (stripos($produto['Nome'], $pesquisa) !== false ||stripos($produto['Categoria'], $pesquisa) !== false)) {
            $produtos[] = $produto;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Produtos Cadastrados</title>
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
            <h1>Produtos Cadastrados</h1>
            <p>Confira todos os produtos cadastrados</p>
        </section>
        <section id="pesquisa">
            <form method="get" action="produtosCadastrados.php">
                <input type="text" name="pesquisar" placeholder="Pesquisar produto..." value="<?php echo htmlspecialchars($pesquisa); ?>">
                <button type="submit">Pesquisar</button>
        </section>
        <section>
            <div class="container">
                <?php 
                if (count($produtos) > 0) {
                    foreach ($produtos as $produto) {
                        echo "<div class='card'>";
                        echo "<img src='{$produto['Imagem']}' alt='Imagem do produto'>";
                        echo "<h2>{$produto['Nome']}</h2>";
                        echo "<p><strong>Descrição:</strong> {$produto['Descrição']}</p>";
                        echo "<p><strong>Preço:</strong> R$ {$produto['Preço']}</p>";
                        echo "<p><strong>Categoria:</strong> {$produto['Categoria']}</p>";
                        echo "<p><strong>Quantidade disponível:</strong> {$produto['Quantidade']}</p>";
                        echo "</div>";
                    }
                } 
                ?>
            </div>
        </section>
    </main>
</body>
</html>