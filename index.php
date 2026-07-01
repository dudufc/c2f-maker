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
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .cuia-img-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .cuia-img-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/img/logo.png" alt="C2F Logo" height="50" class="d-inline-block align-text-top">
        </a>
        <span class="navbar-text text-white fw-bold">
            C2F MAKER - GRAVAÇÃO A LASER
        </span>
    </div>
</nav>

<header class="bg-light py-5 text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Personalize sua Cuia</h1>
        <p class="lead">Escolha um de nossos modelos ou traga a sua para uma gravação exclusiva a laser.</p>
    </div>
</header>

<main class="container my-5">
    <section id="catalogo" class="mb-5">
        <h2 class="text-center mb-4">Nosso Catálogo</h2>
        <div class="row g-4">
            <?php foreach ($cuias as $cuia): ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column text-center">
                        <div class="cuia-img-container mb-3">
                             <img src="<?php echo $cuia['imagem']; ?>" alt="<?php echo $cuia['nome']; ?>">
                        </div>
                        <h5 class="card-title fw-bold"><?php echo $cuia['nome']; ?></h5>
                        <p class="card-text flex-grow-1 text-muted small"><?php echo $cuia['descricao']; ?></p>
                        <p class="fw-bold text-primary mb-3"><?php echo $cuia['preco']; ?></p>
                        <button class="btn btn-dark w-100 select-cuia" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalPedido"
                                data-id="<?php echo $cuia['id']; ?>" 
                                data-nome="<?php echo $cuia['nome']; ?>">
                            Selecionar e Personalizar
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
                <h5 class="modal-title" id="modalPedidoLabel">Solicitar Gravação</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="processar.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Item Escolhido:</label>
                        <input type="text" class="form-control bg-light" id="cuia_selecionada_nome" readonly>
                        <input type="hidden" name="cuia_id" id="cuia_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="nome" class="form-label">Seu Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Como podemos te chamar?" required>
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp</label>
                        <input type="tel" class="form-control" name="whatsapp" id="whatsapp" placeholder="(00) 00000-0000" required>
                    </div>

                    <div class="mb-3">
                        <label for="imagem_referencia" class="form-label">Imagem da Arte (Logo, Nome, Desenho)</label>
                        <input type="file" class="form-control" name="imagem_referencia" id="imagem_referencia" accept="image/*" required>
                        <div class="form-text">Envie a imagem que deseja gravar.</div>
                    </div>

                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" name="observacoes" id="observacoes" rows="3" placeholder="Detalhes sobre a posição, nomes extras, etc."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <img src="assets/img/logo.png" alt="C2F Logo" height="40" class="mb-3 bg-white rounded-circle p-1">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> C2F Maker - Todos os direitos reservados.</p>
        <small class="text-muted">Engenharia Elétrica & Personalização 3D/Laser</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const modalPedido = document.getElementById('modalPedido');
    modalPedido.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const nome = button.getAttribute('data-nome');
        
        const inputId = modalPedido.querySelector('#cuia_id');
        const inputNome = modalPedido.querySelector('#cuia_selecionada_nome');
        
        inputId.value = id;
        inputNome.value = nome;
    });
</script>
</body>
</html>
