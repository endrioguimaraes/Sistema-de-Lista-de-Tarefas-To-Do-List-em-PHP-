<?php
$arquivo = 'tarefas.txt';

// Criar arquivo se não existir
if (!file_exists($arquivo)) {
    touch($arquivo);
}

// Adicionar tarefa
if (isset($_POST['adicionar']) && !empty($_POST['titulo'])) {
    $titulo = htmlspecialchars($_POST['titulo']);
    $nova_tarefa = $titulo . "|pendente\n";
    file_put_contents($arquivo, $nova_tarefa, FILE_APPEND);
    header('Location: index.php');
    exit;
}

// Deletar tarefa
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $tarefas = file($arquivo);
    if (isset($tarefas[$id])) {
        unset($tarefas[$id]);
        file_put_contents($arquivo, implode('', $tarefas));
    }
    header('Location: index.php');
    exit;
}

// Alternar status
if (isset($_GET['alternar'])) {
    $id = $_GET['alternar'];
    $tarefas = file($arquivo);
    if (isset($tarefas[$id])) {
        list($titulo, $status) = explode('|', trim($tarefas[$id]));
        $novo_status = ($status == 'pendente') ? 'concluida' : 'pendente';
        $tarefas[$id] = "$titulo|$novo_status\n";
        file_put_contents($arquivo, implode('', $tarefas));
    }
    header('Location: index.php');
    exit;
}

$tarefas = file($arquivo);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas - Fase 1 (TXT)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .concluida { text-decoration: line-through; color: gray; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Minhas Tarefas (TXT)</h3>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="titulo" class="form-control" placeholder="Nova tarefa..." required>
                                <button type="submit" name="adicionar" class="btn btn-success">Adicionar</button>
                            </div>
                        </form>

                        <ul class="list-group">
                            <?php if (empty($tarefas)): ?>
                                <li class="list-group-item text-center">Nenhuma tarefa cadastrada.</li>
                            <?php else: ?>
                                <?php foreach ($tarefas as $index => $linha): 
                                    $dados = explode('|', trim($linha));
                                    if (count($dados) < 2) continue;
                                    list($titulo, $status) = $dados;
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="<?php echo ($status == 'concluida') ? 'concluida' : ''; ?>">
                                            <?php echo $titulo; ?>
                                        </span>
                                        <div>
                                            <a href="index.php?alternar=<?php echo $index; ?>" class="btn btn-sm <?php echo ($status == 'concluida') ? 'btn-warning' : 'btn-info'; ?>">
                                                <?php echo ($status == 'concluida') ? 'Desmarcar' : 'Concluir'; ?>
                                            </a>
                                            <a href="index.php?deletar=<?php echo $index; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
