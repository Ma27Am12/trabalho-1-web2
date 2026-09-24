<?php 
$pesquisa = isset($_GET['pesquisar']) ? trim($_GET['pesquisar']) : "";
$produtos = [];


if(file_exists($arquivo)) {
    $linhas = file($arquivo);

    foreach($linhas as $linha) {
        $partes = explode("|", $linha);
        $produto = [];

        foreach($partes as $parte) {
            list($chave, $valor) = explode(":", $parte);
            $produto[trim($chave)] = trim($valor);
        }

        if($pesquisa === "" || stripos($produto['nome'], $pesquisa) !== FALSE|| stripos($produto['Categoria'], $pesquisa) !== false) {
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
            <input type="text" name="pesquisar" required placeholder="Pesquisar produto...">
        </section>
        <section>
            <div class="container">
                <?php 
                $arquivo = "dados/produtos.txt";

                if(file_exists($arquivo)) {
                    $linhas = file($arquivo);

                    foreach($linhas as $linha) {
                        $partes = explode("|", $linha);
                        
                        $produto = [];

                        foreach($partes as $parte) {
                            list($chave, $valor) = explode(":", $parte);
                            $produto[trim($chave)] = trim($valor);
                        }

                        echo "<div class='card'>";
                        echo "<img src='{$produto['Imagem']}' alt='Imagem do produto'>";
                        echo "<h2>{$produto['Nome']}</h2>";
                        echo "<p><strong>Descrição:</strong> {$produto['Descrição']}</p>";
                        echo "<p><strong>Preço:</strong> R$ {$produto['Preço']}</p>";
                        echo "<p><strong>Categoria:</strong> {$produto['Categoria']}</p>";
                        echo "<p><strong>Quantidade disponível:</strong> {$produto['Quantidade']}</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Nenhum produto cadastrado ainda. <\p>";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>