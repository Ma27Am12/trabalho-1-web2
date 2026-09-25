<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = floatval($_POST['preco']);
    $quantidade = intval($_POST['quantidade']); 
    $categoria = trim($_POST['categoria']);

    $dirImagens = "imagens/";

    $imagemNome = basename($_FILES['imagem']['name']);
    $caminhoImagem = $dirImagens.uniqid(). "_" . $imagemNome;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {

       $linha = "Nome: $nome | Descrição: $descricao | Preço: $preco | Categoria: $categoria | Quantidade: $quantidade | Imagem: $caminhoImagem\n";

       $arquivo = "dados/produtos.txt";
       if (file_put_contents($arquivo, $linha,  FILE_APPEND)) {
            echo "<p> Produto cadastrado com sucesso! </p>";
       } else {
            echo "<p> Erro ao salvar os dados no arquivo TXT.</p>";
       }
    } else {
        echo "<p> Erro ao salvar a imagem do produto.</p>";
    }
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro De Produto</title>
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
            <h1>Cadastrar Produto</h1>
            <p>Preencha os dados abaixo para adicionar um novo produto</p>
        </section>
        <section id="formulário">
            <form action="cadastroDeProduto.php" method="post" enctype="multipart/form-data">
                <label for="nome">Nome do produto:</label>
                <br>
                <input type="text" id="nome" name="nome" required>
                <br>
                <label for="categoria">Categoria:</label>
                <br>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecione</option>
                    <option value="Goiaba">Goiaba</option>
                    <option value="Pera">Pêra</option>
                    <option value="Banana">Banana</option>
                </select>
                <br>
                <label for="preco">Preço:</label>
                <br>
                <input type="number" id="preco" name="preco" step="0.01" required>
                <br>
                <label for="quantidade">Quantidade:</label>
                <br>
                <input type="number" id="quantidade" name="quantidade" required>
                <br>
                <label for="descricao">Descrição:</label>
                <br>
                <textarea name="descricao" id="descricao" rows="4"></textarea>
                <br>
                <label for="imagem">Imagem do Produto:</label>
                <br>
                <input type="file" id="imagem" name="imagem" accept="image/*">
                <br>
                <button type="submit">Cadastrar Produto</button>
            </form>
        </section>
    </main>
</body>
</html>