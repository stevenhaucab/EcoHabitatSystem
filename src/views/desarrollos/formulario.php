<!-- src/views/desarrollos/create.php -->
<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<!-- Contenido del formulario para agregar nuevo desarrollo -->
<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <form action="store.php" method="POST">
            <div class="mb-3">
                <label for="nombreDesarrollo" class="form-label">Nombre del Desarrollo</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreDesarrollo" name="nombreDesarrollo" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Desarrollo</button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>