<!-- src/views/dashboard.php -->
<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<!-- Aquí puedes poner el contenido específico de la página -->
<div class="main-content">
    <div class="row">
        <!-- Otros elementos de contenido... -->
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <h3>Lista de Desarrollos</h3>
                <a href="/nuevo-desarrollo" class="btn btn-primary">Agregar Nuevo Desarrollo</a>
            </div>

            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); // Eliminar el mensaje de error después de mostrarlo 
                ?>
            <?php endif; ?>

            <!-- Mostrar mensaje de éxito si existe -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); // Eliminar el mensaje de éxito después de mostrarlo 
                ?>
            <?php endif; ?>

            <div class="table-responsive">
                <!-- Mostrar la lista de desarrollos -->
                <?php if (!empty($desarrollos)): ?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($desarrollos as $desarrollo): ?>
                                <tr>
                                    <td><?= strtoupper($desarrollo['name']); ?></td>
                                    <td>
                                        <a href="/editar-desarrollo/<?= $desarrollo['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <button class="btn btn-info btn-sm">Ver Etapas</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No hay desarrollos disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>