<?php
// Configurações básicas
$page_title = "C2F Maker - Gravação a Laser e Cuias";

// Catálogo de cuias
$cuias = [
    [
        'id' => 'bago_touro',
        'nome' => 'Bago de Touro',
        'descricao' => 'Cuia tradicional com formato arredondado e base natural.',
        'preco' => 'R$ 45,00',
        'imagem' => 'assets/img/bago_touro.jpg'
    ],
    [
        'id' => 'porongo_pe',
        'nome' => 'Porongo com Pé',
        'descricao' => 'Cuia clássica com suporte (pé) para maior estabilidade.',
        'preco' => 'R$ 55,00',
        'imagem' => 'assets/img/porongo_pe.jpg'
    ],
    [
        'id' => 'coquinho',
        'nome' => 'Coquinho',
        'descricao' => 'Cuia pequena, ideal para um mate rápido ou individual.',
        'preco' => 'R$ 35,00',
        'imagem' => 'assets/img/coquinho.jpg'
    ],
    [
        'id' => 'propria_cuia',
        'nome' => 'Trazer minha própria cuia',
        'descricao' => 'Solicite apenas o serviço de gravação a laser na sua cuia.',
        'preco' => 'Sob consulta',
        'imagem' => 'assets/img/propria_cuia.png'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="C2F Maker - Serviços de gravação a laser personalizada em cuias. Escolha seu modelo e personalize!">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <img src="assets/img/logo.png" alt="C2F Logo" height="45" class="logo-navbar">
            <span class="fw-bold">C2F MAKER</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#catalogo">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="#como-funciona">Como Funciona</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="hero-section text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-white mb-3">Personalize sua Cuia</h1>
        <p class="lead text-white-50 mb-4">Gravação a laser exclusiva em cuias artesanais. Escolha seu modelo, envie sua arte e receba em casa.</p>
        <a href="#catalogo" class="btn btn-light btn-lg px-4">
            <i class="bi bi-grid-fill me-2"></i>Ver Catálogo
        </a>
    </div>
</header>

<!-- Como Funciona -->
<section id="como-funciona" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Como Funciona</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm py-4">
                    <div class="card-body">
                        <i class="bi bi-1-circle-fill display-4 text-primary mb-3 d-block"></i>
                        <h5 class="fw-bold">Escolha sua Cuia</h5>
                        <p class="text-muted">Navegue pelo catálogo e selecione o modelo ideal para você.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm py-4">
                    <div class="card-body">
                        <i class="bi bi-2-circle-fill display-4 text-primary mb-3 d-block"></i>
                        <h5 class="fw-bold">Envie sua Arte</h5>
                        <p class="text-muted">Faça upload da imagem, logo ou desenho que deseja gravar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm py-4">
                    <div class="card-body">
                        <i class="bi bi-3-circle-fill display-4 text-primary mb-3 d-block"></i>
                        <h5 class="fw-bold">Receba em Casa</h5>
                        <p class="text-muted">Enviaremos seu orçamento e entregaremos diretamente na sua casa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catálogo -->
<main class="container my-5">
    <section id="catalogo" class="mb-5">
        <h2 class="text-center mb-4 fw-bold">Nosso Catálogo</h2>
        <div class="row g-4 justify-content-center">
            <?php foreach ($cuias as $cuia): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 cuia-card">
                    <div class="cuia-img-container">
                        <img src="<?php echo htmlspecialchars($cuia['imagem']); ?>" alt="<?php echo htmlspecialchars($cuia['nome']); ?>" loading="lazy">
                    </div>
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($cuia['nome']); ?></h5>
                        <p class="card-text flex-grow-1 text-muted small"><?php echo htmlspecialchars($cuia['descricao']); ?></p>
                        <p class="fw-bold text-primary mb-3 fs-5"><?php echo htmlspecialchars($cuia['preco']); ?></p>
                        <button class="btn btn-dark w-100 select-cuia" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalPedido"
                                data-id="<?php echo htmlspecialchars($cuia['id']); ?>" 
                                data-nome="<?php echo htmlspecialchars($cuia['nome']); ?>"
                                data-preco="<?php echo htmlspecialchars($cuia['preco']); ?>">
                            <i class="bi bi-plus-circle me-1"></i> Selecionar e Personalizar
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<!-- Modal de Pedido -->
<div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedidoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalPedidoLabel">
                    <i class="bi bi-pencil-square me-2"></i>Solicitar Gravação
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="processar.php" method="POST" enctype="multipart/form-data" id="formPedido">
                <div class="modal-body">
                    <!-- Alerta de erro -->
                    <div class="alert alert-danger d-none" id="formError"></div>

                    <!-- Item escolhido -->
                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="bi bi-box me-1"></i> Item Escolhido:</label>
                        <input type="text" class="form-control bg-light fw-bold" id="cuia_selecionada_nome" readonly>
                        <input type="hidden" name="cuia_id" id="cuia_id" required>
                    </div>

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="nome" class="form-label"><i class="bi bi-person me-1"></i> Seu Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" 
                               placeholder="Como podemos te chamar?" required maxlength="100">
                    </div>

                    <!-- WhatsApp -->
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label"><i class="bi bi-whatsapp me-1"></i> WhatsApp</label>
                        <input type="tel" class="form-control" name="whatsapp" id="whatsapp" 
                               placeholder="(00) 00000-0000" required maxlength="15" pattern="[0-9\s\(\)\-]+">
                        <div class="form-text">Usaremos este número para enviar seu orçamento.</div>
                    </div>

                    <!-- Upload de imagem -->
                    <div class="mb-3">
                        <label for="imagem_referencia" class="form-label"><i class="bi bi-image me-1"></i> Imagem da Arte (Logo, Nome, Desenho)</label>
                        <input type="file" class="form-control" name="imagem_referencia" id="imagem_referencia" accept="image/png,image/jpeg,image/webp,image/gif">
                        <div class="form-text">Formatos aceitos: JPG, PNG, GIF, WEBP. Tamanho máximo: 5MB.</div>
                        <div id="previewContainer" class="mt-2 d-none">
                            <img id="imagePreview" class="img-fluid rounded shadow-sm" style="max-height: 150px;" alt="Preview da imagem">
                        </div>
                    </div>

                    <!-- Observações -->
                    <div class="mb-3">
                        <label for="observacoes" class="form-label"><i class="bi bi-chat-left-text me-1"></i> Observações</label>
                        <textarea class="form-control" name="observacoes" id="observacoes" rows="3" 
                                  placeholder="Detalhes sobre posição, tamanho, nomes extras, etc."></textarea>
                    </div>

                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" id="csrf_token" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnEnviar">
                        <span class="btn-text"><i class="bi bi-send me-1"></i> Enviar Pedido</span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Enviando...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <img src="assets/img/logo.png" alt="C2F Logo" height="40" class="mb-3 logo-footer">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> C2F Maker - Todos os direitos reservados.</p>
        <small class="text-muted">Engenharia Elétrica & Personalização 3D/Laser</small>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ============ Geração de CSRF Token ============
function generateCSRFToken() {
    const array = new Uint8Array(32);
    crypto.getRandomValues(array);
    return Array.from(array).map(b => b.toString(16).padStart(2, '0')).join('');
}

// ============ Máscara de Telefone ============
const whatsappInput = document.getElementById('whatsapp');
whatsappInput.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 11) value = value.slice(0, 11);
    
    if (value.length > 0) {
        value = '(' + value;
        if (value.length > 3) value = value.slice(0, 3) + ') ' + value.slice(3);
        if (value.length > 9) value = value.slice(0, 9) + ' ' + value.slice(9);
        if (value.length > 14) value = value.slice(0, 14) + '-' + value.slice(14);
    }
    e.target.value = value;
});

// ============ Preview de Imagem ============
const imagemInput = document.getElementById('imagem_referencia');
const previewContainer = document.getElementById('previewContainer');
const imagePreview = document.getElementById('imagePreview');

imagemInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validar tamanho (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('A imagem é muito grande. O tamanho máximo permitido é 5MB.');
            this.value = '';
            previewContainer.classList.add('d-none');
            return;
        }
        
        // Validar tipo MIME
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Formato de imagem não suportado. Use JPG, PNG, GIF ou WEBP.');
            this.value = '';
            previewContainer.classList.add('d-none');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(ev) {
            imagePreview.src = ev.target.result;
            previewContainer.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('d-none');
    }
});

// ============ Modal de Pedido ============
const modalPedido = document.getElementById('modalPedido');
const formPedido = document.getElementById('formPedido');
const btnEnviar = document.getElementById('btnEnviar');
const formError = document.getElementById('formError');

// Gerar token CSRF ao carregar
document.getElementById('csrf_token').value = generateCSRFToken();

modalPedido.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const nome = button.getAttribute('data-nome');
    
    document.getElementById('cuia_id').value = id;
    document.getElementById('cuia_selecionada_nome').value = nome;
    
    // Limpar erro anterior
    formError.classList.add('d-none');
    // Limpar campos exceto cuia selecionada
    document.getElementById('nome').value = '';
    document.getElementById('whatsapp').value = '';
    document.getElementById('observacoes').value = '';
    document.getElementById('imagem_referencia').value = '';
    previewContainer.classList.add('d-none');
});

// ============ Validação do Formulário ============
formPedido.addEventListener('submit', function(e) {
    formError.classList.add('d-none');
    
    const nome = document.getElementById('nome').value.trim();
    const whatsapp = document.getElementById('whatsapp').value.trim();
    const imagem = document.getElementById('imagem_referencia').files[0];
    
    let errors = [];
    
    if (nome.length < 2) {
        errors.push('O nome deve ter pelo menos 2 caracteres.');
    }
    if (whatsapp.replace(/\D/g, '').length < 10) {
        errors.push('Informe um número de WhatsApp válido.');
    }
    if (!imagem) {
        errors.push('Envie a imagem da arte que deseja gravar.');
    }
    
    if (errors.length > 0) {
        e.preventDefault();
        formError.innerHTML = '<strong>Corrija os seguintes erros:</strong><ul class="mb-0 mt-1">';
        errors.forEach(err => formError.innerHTML += '<li>' + err + '</li>');
        formError.innerHTML += '</ul>';
        formError.classList.remove('d-none');
    } else {
        // Mostrar loading no botão
        btnEnviar.disabled = true;
        btnEnviar.querySelector('.btn-text').classList.add('d-none');
        btnEnviar.querySelector('.btn-loading').classList.remove('d-none');
    }
});

// ============ Smooth Scroll ============
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
</body>
</html>
