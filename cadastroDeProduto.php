<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = floatval($_POST['preco']);
    $quantidade = intval($_POST['quantidade']); 

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
} else {
    echo "<p> Método inválido. Use POST.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <form action="produtosCadastrados.php" method="post" enctype="multipart/form-data">
                <label for="nome">Nome do produto:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecione</option>
                    <option value="Goiaba">Goiaba</option>
                    <option value="Maça">Maça</option>
                    <option value="Pera">Pera</option>
                    <option value="Banana">Banana</option>
                </select>

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>

                <label for="descricao">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4"></textarea>

                <label for="imagem">Imagem do Produto:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">

                <button type="submit">Cadastrar Produto</button>
            </form>
        </section>
    </main>
</body>
</html>