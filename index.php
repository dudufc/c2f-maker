<?php
// Configurações básicas
$page_title = "C2F Maker - Gravação a Laser e Cuias";

// Catálogo de cuias
$cuias = [
    [
        'id' => 'bago_touro',
        'nome' => 'Bago de Touro',
        'descricao' => 'Cuia tradicional com formato arredondado e base natural.',
        'preco' => 'R$ 45,00'
    ],
    [
        'id' => 'porongo_pe',
        'nome' => 'Porongo com Pé',
        'descricao' => 'Cuia clássica com suporte (pé) para maior estabilidade.',
        'preco' => 'R$ 55,00'
    ],
    [
        'id' => 'coquinho',
        'nome' => 'Coquinho',
        'descricao' => 'Cuia pequena, ideal para um mate rápido ou individual.',
        'preco' => 'R$ 35,00'
    ],
    [
        'id' => 'propria_cuia',
        'nome' => 'Trazer minha própria cuia',
        'descricao' => 'Solicite apenas o serviço de gravação a laser na sua cuia.',
        'preco' => 'Sob consulta'
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
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $cuia['nome']; ?></h5>
                        <p class="card-text flex-grow-1"><?php echo $cuia['descricao']; ?></p>
                        <p class="fw-bold text-primary"><?php echo $cuia['preco']; ?></p>
                        <button class="btn btn-outline-dark mt-auto select-cuia" data-id="<?php echo $cuia['id']; ?>" data-nome="<?php echo $cuia['nome']; ?>">Selecionar</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <hr class="my-5">

    <section id="solicitacao" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0 h5">Solicitar Gravação</h3>
                </div>
                <div class="card-body">
                    <form action="processar.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="cuia_selecionada" class="form-label">Item Selecionado</label>
                            <input type="text" class="form-control" id="cuia_selecionada_nome" readonly value="Nenhum item selecionado">
                            <input type="hidden" name="cuia_id" id="cuia_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Seu Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input type="tel" class="form-control" name="whatsapp" id="whatsapp" placeholder="(00) 00000-0000" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagem_referencia" class="form-label">Imagem da Arte (Logo, Nome, Desenho)</label>
                            <input type="file" class="form-control" name="imagem_referencia" id="imagem_referencia" accept="image/*" required>
                            <div class="form-text">Envie a imagem que você deseja gravar na cuia.</div>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações / Detalhes da Gravação</label>
                            <textarea class="form-control" name="observacoes" id="observacoes" rows="3" placeholder="Ex: Gravar o nome 'João' abaixo do logo."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enviar Pedido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> C2F Maker - Todos os direitos reservados.</p>
        <small>Desenvolvido para facilitar sua personalização.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.select-cuia').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nome = this.getAttribute('data-nome');
            
            document.getElementById('cuia_id').value = id;
            document.getElementById('cuia_selecionada_nome').value = nome;
            
            // Scroll suave até o formulário
            document.getElementById('solicitacao').scrollIntoView({ behavior: 'smooth' });
            
            // Destacar o campo
            const inputNome = document.getElementById('cuia_selecionada_nome');
            inputNome.classList.add('is-valid');
            setTimeout(() => inputNome.classList.remove('is-valid'), 2000);
        });
    });
</script>
</body>
</html>
