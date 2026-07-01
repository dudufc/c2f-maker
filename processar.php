<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $cuia_id = $_POST['cuia_id'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    // Simulação de upload de arquivo
    $sucesso = false;
    if (isset($_FILES['imagem_referencia']) && $_FILES['imagem_referencia']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $file_name = time() . '_' . basename($_FILES['imagem_referencia']['name']);
        $target_path = $upload_dir . $file_name;
        
        // No Laragon/Ambiente Real: move_uploaded_file($_FILES['imagem_referencia']['tmp_name'], $target_path);
        // Para este protótipo, apenas confirmamos que o arquivo foi "recebido"
        $sucesso = true;
    } else {
        // Se não enviou imagem mas preencheu o resto, ainda podemos considerar sucesso no protótipo
        $sucesso = true; 
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Recebido - C2F Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container my-5 text-center">
    <div class="card shadow p-5">
        <div class="mb-4">
            <img src="assets/img/logo.png" alt="C2F Logo" height="80">
        </div>
        
        <?php if ($sucesso): ?>
            <h1 class="text-success mb-4">Pedido Enviado com Sucesso!</h1>
            <p class="lead">Obrigado, <strong><?php echo htmlspecialchars($nome); ?></strong>!</p>
            <p>Recebemos sua solicitação para a cuia: <strong><?php echo htmlspecialchars($cuia_id); ?></strong>.</p>
            <p>Em breve entraremos em contato pelo WhatsApp <strong><?php echo htmlspecialchars($whatsapp); ?></strong> para confirmar os detalhes e enviar o orçamento.</p>
            
            <div class="mt-4">
                <a href="index.php" class="btn btn-primary">Voltar ao Início</a>
            </div>
        <?php else: ?>
            <h1 class="text-danger mb-4">Erro ao processar pedido</h1>
            <p>Ocorreu um problema ao enviar sua solicitação. Por favor, tente novamente.</p>
            <div class="mt-4">
                <a href="index.php" class="btn btn-secondary">Tentar Novamente</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
