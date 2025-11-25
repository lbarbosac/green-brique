<?php
include_once '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'salvar') {
    $cnpj = $_POST['cnpj-empresa'];
    $nome = $_POST['nome-empresa'];
    $email = $_POST['email-empresa'];
    $endereco = $_POST['endereco-empresa'];
    $cep = $_POST['cep-empresa'];
    $telefone = $_POST['telefone-empresa'];
    $senha = password_hash($_POST['senha-empresa'], PASSWORD_DEFAULT);

    $uploadDir = '../uploads/';
    $defaultImgPerfil = 'default-profile.png';
    $defaultImgLocal = 'default-local.png';
    $imgPerfilPath = $defaultImgPerfil;
    $imgLocalPath = $defaultImgLocal;

    // Processar imagem de perfil
    if (isset($_FILES['img-perfil-empresa']) && $_FILES['img-perfil-empresa']['error'] === UPLOAD_ERR_OK) {
        $imgPerfilName = uniqid('perfil_') . '.' . pathinfo($_FILES['img-perfil-empresa']['name'], PATHINFO_EXTENSION);
        $imgPerfilPath = $uploadDir . $imgPerfilName;
        move_uploaded_file($_FILES['img-perfil-empresa']['tmp_name'], $imgPerfilPath);
    }

    // Processar imagem do local
    if (isset($_FILES['img-local-empresa']) && $_FILES['img-local-empresa']['error'] === UPLOAD_ERR_OK) {
        $imgLocalName = uniqid('local_') . '.' . pathinfo($_FILES['img-local-empresa']['name'], PATHINFO_EXTENSION);
        $imgLocalPath = $uploadDir . $imgLocalName;
        move_uploaded_file($_FILES['img-local-empresa']['tmp_name'], $imgLocalPath);
    }

    // Inserir dados no banco de dados
    $sql = "INSERT INTO cnpj (CNPJ, Nome, Email, Endereco, CEP, Telefone, Senha, ImagemPerfil, ImagemLocal)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssss', $cnpj, $nome, $email, $endereco, $cep, $telefone, $senha, $imgPerfilPath, $imgLocalPath);

    if ($stmt->execute()) {
        header('Location: ../cadastro-empresa.php?success=1');
    } else {
        die('Erro ao salvar os dados: ' . $stmt->error);
    }
}
?>
