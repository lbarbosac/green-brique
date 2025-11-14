<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Empresarial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../src/assets/css/style-crud.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRzD5v+g9vJq4u/9x67S3S6FzL8s3y5M9E=" 
            crossorigin="anonymous"></script>

    <style>
        /* CSS ESSENCIAL PARA POSICIONAMENTO E FUNCIONALIDADE DO AUTOCOMPLETE */
        
        /* Contêiner de pesquisa: ponto de referência */
        #search-container {
            position: relative; 
            flex-grow: 1; 
            max-width: 500px;
            margin: 0 20px;
        }

        /* Lista de Sugestões: flutua por cima */
        #suggestions-list {
            position: absolute; 
            top: 100%; 
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 8px 8px;
            z-index: 2000; 
            list-style: none;
            padding: 0;
            margin: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-height: 300px; 
            overflow-y: auto; 
            display: none; 
        }

        /* Item da Sugestão */
        .suggestion-item {
            padding: 10px 15px;
            cursor: pointer;
            display: block; 
            text-decoration: none;
            color: #333;
            border-bottom: 1px solid #eee;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
        .suggestion-item strong {
             color: #C76F16;
             font-weight: 700;
        }
    </style>
</head>
<body>
    <header>
        <img src="./img/logo-branco.png" alt="" id="logo">
        <nav id="menu" >
            <a href="./page-produtos.php">Home</a>
            <a href="./perfil.php">Perfil</a>
            <a href="./logoff.php">Blog</a>
            <a href="../src/sobreNos.php">Quem somos</a>
            <i class="fa-solid fa-cart-shopping fa-xl"></i>
        </nav>
    </header>