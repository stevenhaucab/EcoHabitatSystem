<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="row">
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <h3><?= $title ?></h3>
                <a href="/nuevo-etapa" class="btn btn-primary">Agregar Nueva Etapa</a>
            </div>

            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Mostrar mensaje de éxito si existe -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="table-responsive">
                <!-- Mostrar la lista de etapas -->
                <?php if (!empty($etapas)): ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Desarrollo</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etapas as $etapa): ?>
                                <tr>
                                    <td><?= strtoupper($etapa['etapa_name']); ?></td>
                                    <td><?= strtoupper($etapa['desarrollo_name']); ?></td>
                                    <td>
                                        <a href="/editar-etapa/<?= $etapa['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <button class="btn btn-info btn-sm">Ver Lotes</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay etapas disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
