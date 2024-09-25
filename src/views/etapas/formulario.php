<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <!-- Si existe el ID de la etapa, el formulario es para edición -->
        <form action="<?= isset($etapa) ? '/editar-etapa/' . $etapa['id'] : '/nuevo-etapa' ?>" method="POST">
            <div class="mb-3">
                <label for="nombreEtapa" class="form-label">Nombre de la Etapa</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreEtapa" name="nombreEtapa" 
                               value="<?= isset($etapa) ? $etapa['name'] : '' ?>" required>
                    </div>
                </div>
            </div>

            <!-- Select para desarrollos -->
            <div class="mb-3">
                <label for="idDesarrollo" class="form-label">Desarrollo Asociado</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <select name="idDesarrollo" id="idDesarrollo" class="form-control" required>
                            <option value="">Selecciona un desarrollo</option>
                            <?php foreach ($desarrollos as $desarrollo): ?>
                                <option value="<?= $desarrollo['id']; ?>"
                                    <?= isset($etapa) && $etapa['idDesarrollo'] == $desarrollo['id'] ? 'selected' : ''; ?>>
                                    <?= strtoupper($desarrollo['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <?php if (isset($etapa)): ?>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?= $etapa['status'] == 1 ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $etapa['status'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">
                <?= isset($etapa) ? 'Actualizar Etapa' : 'Guardar Etapa' ?>
            </button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>
