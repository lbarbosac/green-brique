<?php
// O caminho é relativo a este arquivo (search-autocomplete.php em src/act/)
// Precisa sair de 'act' (..) e entrar em 'include'
include_once '../include/conn.php'; 

// Define o cabeçalho para retornar JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
    
    // Sanitização e Preparação
    $search_query = mysqli_real_escape_string($conn, trim($_GET['query']));

    if (!empty($search_query) && strlen($search_query) >= 2) {
        
        // Query funcional: busca por Nome que contenha o termo
        $sql = "SELECT ProdutoID, Nome FROM produtos 
                WHERE Nome LIKE '%$search_query%' 
                ORDER BY Nome ASC
                LIMIT 10";

        $retorno = mysqli_query($conn, $sql);
        $produtos = [];

        if ($retorno) {
            while ($linha = mysqli_fetch_assoc($retorno)) {
                $produtos[] = [
                    'ProdutoID' => $linha['ProdutoID'],
                    'Nome' => htmlspecialchars($linha['Nome']) 
                ];
            }
        }
        
        // Retorna o resultado em formato JSON
        echo json_encode($produtos);
        exit;
    }
}

// Retorna um array vazio por padrão
echo json_encode([]);
?>