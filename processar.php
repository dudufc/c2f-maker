<?php
// ============================================
// processar.php - Recebimento e validação de pedidos
// C2F Maker - Gravação a Laser e Cuias
// ============================================

// Iniciar sessão para CSRF
session_start();

// Verificar método HTTP
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// ============================================
// 1. VALIDAÇÃO CSRF
// ============================================
if (!isset($_POST['csrf_token']) || empty($_POST['csrf_token'])) {
    die('<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Erro - C2F Maker</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light"><div class="container my-5 text-center"><div class="card shadow p-5"><h1 class="text-danger mb-4">Erro de Segurança</h1><p>Sessão expirada. Por favor, volte e tente novamente.</p><a href="index.php" class="btn btn-primary mt-3">Voltar ao Início</a></div></div></body></html>');
}

// ============================================
// 2. SANITIZAÇÃO E VALIDAÇÃO DE DADOS
// ============================================
$nome = trim($_POST['nome'] ?? '');
$whatsapp = trim($_POST['whatsapp'] ?? '');
$cuia_id = trim($_POST['cuia_id'] ?? '');
$observacoes = trim($_POST['observacoes'] ?? '');

// Sanitizar strings
$nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
$whatsapp = htmlspecialchars($whatsapp, ENT_QUOTES, 'UTF-8');
$observacoes = htmlspecialchars($observacoes, ENT_QUOTES, 'UTF-8');
$cuia_id = preg_replace('/[^a-z0-9_]/', '', $cuia_id);

// Validar campos obrigatórios
$erros = [];

if (mb_strlen($nome) < 2 || mb_strlen($nome) > 100) {
    $erros[] = 'Nome inválido (mínimo 2, máximo 100 caracteres).';
}

$digits_whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
if (strlen($digits_whatsapp) < 10 || strlen($digits_whatsapp) > 11) {
    $erros[] = 'Número de WhatsApp inválido.';
}

// Catálogo válido
$cuias_validas = ['bago_touro', 'porongo_pe', 'coquinho', 'propria_cuia'];
$cuias_nomes = [
    'bago_touro' => 'Bago de Touro',
    'porongo_pe' => 'Porongo com Pé',
    'coquinho' => 'Coquinho',
    'propria_cuia' => 'Trazer minha própria cuia'
];

if (!in_array($cuia_id, $cuias_validas)) {
    $erros[] = 'Item selecionado inválido.';
}

if (mb_strlen($observacoes) > 500) {
    $erros[] = 'Observações muito longas (máximo 500 caracteres).';
}

// ============================================
// 3. VALIDAÇÃO E UPLOAD DE ARQUIVO
// ============================================
$upload_dir = __DIR__ . '/uploads/';
$nome_arquivo_enviado = '';

// Garantir que o diretório existe
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        $erros[] = 'Erro ao criar diretório de uploads.';
    }
}

// Validar upload se arquivo foi enviado
if (isset($_FILES['imagem_referencia']) && $_FILES['imagem_referencia']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['imagem_referencia'];
    
    // Verificar tamanho (5MB)
    $tamanho_maximo = 5 * 1024 * 1024; // 5MB
    if ($arquivo['size'] > $tamanho_maximo) {
        $erros[] = 'A imagem excede o tamanho máximo de 5MB.';
    }
    
    // Verificar tipo MIME real (finfo)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($arquivo['tmp_name']);
    
    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime_type, $tipos_permitidos)) {
        $erros[] = 'Formato de imagem não permitido. Use JPG, PNG, GIF ou WEBP.';
    }
    
    // Verificar extensão do arquivo
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($extensao, $extensoes_permitidas)) {
        $erros[] = 'Extensão de arquivo não permitida.';
    }
    
    // Verificar se é uma imagem real
    $dimensoes = getimagesize($arquivo['tmp_name']);
    if ($dimensoes === false) {
        $erros[] = 'O arquivo enviado não é uma imagem válida.';
    }
    
    // Gerar nome seguro para o arquivo
    if (empty($erros)) {
        $hash = substr(sha1($arquivo['name'] . microtime()), 0, 8);
        $nome_arquivo = $hash . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($arquivo['name']));
        $target_path = $upload_dir . $nome_arquivo;
        
        // Renomear extensão para ser consistente com MIME
        $ext_mapeamento = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];
        $ext_correta = $ext_mapeamento[$mime_type] ?? $extensao;
        $nome_arquivo = pathinfo($nome_arquivo, PATHINFO_FILENAME) . '.' . $ext_correta;
        $target_path = $upload_dir . $nome_arquivo;
        
        if (move_uploaded_file($arquivo['tmp_name'], $target_path)) {
            $nome_arquivo_enviado = $nome_arquivo;
        } else {
            $erros[] = 'Erro ao salvar o arquivo no servidor.';
        }
    }
} else {
    // Erro no upload
    $erro_upload = $_FILES['imagem_referencia']['error'] ?? UPLOAD_ERR_NO_FILE;
    if ($erro_upload !== UPLOAD_ERR_NO_FILE) {
        $erros[] = 'Erro ao receber o arquivo de imagem.';
    }
}

// ============================================
// 4. RESULTADO
// ============================================
if (!empty($erros)) {
    // Houve erros de validação
    $mensagens_erro = implode('<br>', array_map('htmlspecialchars', $erros));
    echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro no Pedido - C2F Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card shadow p-5 mx-auto" style="max-width: 600px;">
        <div class="text-center mb-4">
            <img src="assets/img/logo.png" alt="C2F Logo" height="80">
        </div>
        <h1 class="text-danger mb-4 text-center"><i class="bi bi-exclamation-triangle me-2"></i>Erro no Pedido</h1>
        <div class="alert alert-danger">
            <strong>Por favor, corrija os seguintes erros:</strong><br>
            ' . $mensagens_erro . '
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left me-1"></i> Voltar e Corrigir</a>
        </div>
    </div>
</div>
</body>
</html>';
    exit();
}

// Pedido válido - exibir confirmação
$nome_cuia = $cuias_nomes[$cuia_id];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Recebido - C2F Maker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="card shadow p-4 p-md-5 mx-auto" style="max-width: 600px;">
        <div class="text-center mb-4">
            <img src="assets/img/logo.png" alt="C2F Logo" height="80">
        </div>
        
        <div class="text-center mb-4">
            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 40px;"></i>
            </div>
        </div>
        
        <h1 class="text-success mb-3 text-center fw-bold">Pedido Enviado com Sucesso!</h1>
        
        <div class="card bg-light border-0 mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="bi bi-receipt me-2"></i>Resumo do Pedido</h5>
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted fw-bold">Nome:</td>
                        <td class="text-end"><?php echo htmlspecialchars($nome); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">WhatsApp:</td>
                        <td class="text-end"><?php echo htmlspecialchars($whatsapp); ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">Item:</td>
                        <td class="text-end"><?php echo htmlspecialchars($nome_cuia); ?></td>
                    </tr>
                    <?php if ($nome_arquivo_enviado): ?>
                    <tr>
                        <td class="text-muted fw-bold">Imagem:</td>
                        <td class="text-end text-success"><i class="bi bi-check-circle me-1"></i> Recebida</td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($observacoes)): ?>
                    <tr>
                        <td class="text-muted fw-bold">Observações:</td>
                        <td class="text-end"><?php echo htmlspecialchars(mb_substr($observacoes, 0, 80)); ?><?php echo mb_strlen($observacoes) > 80 ? '...' : ''; ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        
        <div class="text-center mb-4">
            <p class="text-muted">Em breve entraremos em contato pelo WhatsApp para confirmar os detalhes e enviar seu orçamento.</p>
        </div>
        
        <!-- Botão WhatsApp (deixado sem número para ser configurado depois) -->
        <!-- 
            Para ativar, descomente o bloco abaixo e substitua NÚMERO por seu número:
            Exemplo: https://wa.me/5547999999999?text=Ol%C3%A1%2C%20fiz%20um%20pedido%20no%20site%20da%20C2F%20Maker!
        -->
        <div class="text-center mb-4 d-none" id="whatsappSection">
            <a href="#" id="btnWhatsApp" class="btn btn-success btn-lg w-100" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-whatsapp me-2"></i>
                Falar no WhatsApp
            </a>
        </div>
        
        <div class="text-center">
            <a href="index.php" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-house me-2"></i>Voltar ao Início
            </a>
        </div>
    </div>
</div>

<script>
// Descomente e configure o número do WhatsApp quando quiser ativar:
// document.getElementById('whatsappSection').classList.remove('d-none');
// document.getElementById('btnWhatsApp').href = 'https://wa.me/NÚMERO_AQUI?text=' + encodeURIComponent('Olá, fiz um pedido no site da C2F Maker!');
</script>

</body>
</html>
