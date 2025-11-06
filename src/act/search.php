<?php
include_once '../src/include/conn.php';

if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
    header("Location: ../src/page-produtos.php");
    exit;
}

$nome = "%" . trim($_GET['query']) . "%";

// Prepare and execute the query
$sql = "SELECT * FROM produtos WHERE Nome LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);
$stmt->execute();
$result = $stmt->get_result();

// Fetch results
$buscados = $result->fetch_all(MYSQLI_ASSOC);

// Display results
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="../assets/css/style-crud.css">
</head>
<body>
    <header>
        <h1>Resultados da Pesquisa</h1>
    </header>
    <main>
        <div class="container">
            <h2>Resultados para: "<?php echo htmlspecialchars($_GET['query']); ?>"</h2>
            <?php if (!empty($buscados)): ?>
                <ul>
                    <?php foreach ($buscados as $produto): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($produto['Nome']); ?></strong><br>
                            <?php echo htmlspecialchars($produto['Descricao']); ?><br>
                            <span>R$ <?php echo number_format($produto['Preco'], 2, ',', '.'); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum resultado encontrado.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>