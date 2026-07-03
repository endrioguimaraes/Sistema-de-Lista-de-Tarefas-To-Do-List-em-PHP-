<?php
require_once 'db.php';

// Adicionar tarefa
if (isset($_POST['adicionar']) && !empty($_POST['titulo'])) {
    $titulo = htmlspecialchars($_POST['titulo']);
    $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, status) VALUES (?, 'pendente')");
    $stmt->execute([$titulo]);
    header('Location: index.php');
    exit;
}

// Deletar tarefa
if (isset($_GET['deletar'])) {
    $id = (int)$_GET['deletar'];
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}

// Alternar status
if (isset($_GET['alternar'])) {
    $id = (int)$_GET['alternar'];
    
    // Primeiro busca o status atual
    $stmt = $pdo->prepare("SELECT status FROM tarefas WHERE id = ?");
    $stmt->execute([$id]);
    $tarefa = $stmt->fetch();
    
    if ($tarefa) {
        $novo_status = ($tarefa['status'] == 'pendente') ? 'concluida' : 'pendente';
        $stmt = $pdo->prepare("UPDATE tarefas SET status = ? WHERE id = ?");
        $stmt->execute([$novo_status, $id]);
    }
    header('Location: index.php');
    exit;
}

// Listar tarefas
$stmt = $pdo->query("SELECT * FROM tarefas ORDER BY id DESC");
$tarefas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas - Fase 2 (MySQL)</title>
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
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0">Minhas Tarefas (MySQL)</h3>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="titulo" class="form-control" placeholder="Nova tarefa..." required>
                                <button type="submit" name="adicionar" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>

                        <ul class="list-group">
                            <?php if (empty($tarefas)): ?>
                                <li class="list-group-item text-center">Nenhuma tarefa cadastrada.</li>
                            <?php else: ?>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="<?php echo ($tarefa['status'] == 'concluida') ? 'concluida' : ''; ?>">
                                            <?php echo htmlspecialchars($tarefa['titulo']); ?>
                                        </span>
                                        <div>
                                            <a href="index.php?alternar=<?php echo $tarefa['id']; ?>" class="btn btn-sm <?php echo ($tarefa['status'] == 'concluida') ? 'btn-warning' : 'btn-info'; ?>">
                                                <?php echo ($tarefa['status'] == 'concluida') ? 'Desmarcar' : 'Concluir'; ?>
                                            </a>
                                            <a href="index.php?deletar=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
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
