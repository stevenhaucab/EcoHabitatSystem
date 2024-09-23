<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <!-- Si existe el ID del desarrollo, el formulario es para edición -->
        <form action="<?= isset($desarrollo) ? '/editar-desarrollo/' . $desarrollo['id'] : '/nuevo-desarrollo' ?>" method="POST">
            <div class="mb-3">
                <label for="nombreDesarrollo" class="form-label">Nombre del Desarrollo</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreDesarrollo" name="nombreDesarrollo" 
                               value="<?= isset($desarrollo) ? $desarrollo['name'] : '' ?>" required>
                    </div>
                </div>
            </div>

            <?php if (isset($desarrollo)): ?>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?= $desarrollo['status'] == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $desarrollo['status'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
                <?= isset($desarrollo) ? 'Actualizar Desarrollo' : 'Guardar Desarrollo' ?>
            </button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
