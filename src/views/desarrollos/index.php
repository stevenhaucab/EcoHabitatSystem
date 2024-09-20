<!-- src/views/dashboard.php -->
<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<!-- Aquí puedes poner el contenido específico de la página -->
<div class="main-content">
    <div class="row">
        <h1>Desarrollos</h1>
        <!-- Otros elementos de contenido... -->
        
        <div class="container mt-5">
            <div class="d-flex justify-content-between mb-3">
                <h3>Lista de Desarrollos</h3>
                <a href="/nuevo-desarrollo" class="btn btn-primary">Agregar Nuevo Desarrollo</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre Desarrollo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Desarrollo Ejemplo 1</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Editar</button>
                                <button class="btn btn-info btn-sm">Ver Etapas</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Desarrollo Ejemplo 2</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Editar</button>
                                <button class="btn btn-info btn-sm">Ver Etapas</button>
                            </td>
                        </tr>
                        <!-- Puedes agregar más filas aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
