<?php include dirname(__DIR__, 1) . '/layouts/header.php'; ?>

<div class="main-content">
    <div class="container mt-5">
        <h1><?php echo $title; ?></h1>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <!-- Si existe el ID de la lote, el formulario es para edición -->
        <form action="<?= isset($lote) ? '/editar-lote/' . $lote['id'] : '/nuevo-lote' ?>" method="POST">
            <div class="mb-3">
                <label for="nombreLote" class="form-label">Nombre de la Lote</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="nombreLote" name="nombreLote" value="<?= isset($lote) ? $lote['name'] : '' ?>" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="medidaLote" class="form-label">Medida del Lote</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="medidaLote" name="medidaLote" value="<?= isset($lote) ? $lote['medida'] : '' ?>" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="precioBaseLote" class="form-label">Precio Lista</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="precioBaseLote" name="precioBaseLote" value="<?= isset($lote) ? $lote['precioBase'] : '' ?>" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="engancheLote" class="form-label">Enganche</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="engancheLote" name="engancheLote" value="<?= isset($lote) ? $lote['enganche'] : '' ?>" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="precioFinalLote" class="form-label">Precio Final</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text" class="form-control" id="precioFinalLote" name="precioFinalLote" value="<?= isset($lote) ? $lote['precioFinal'] : '' ?>" required>
                    </div>
                </div>
            </div>
            <!-- Select para desarrollos -->
            <div class="mb-3">
                <label for="tipoPropiedad" class="form-label">Tipo de Propiedad</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <select name="tipoPropiedad" id="tipoPropiedad" class="form-control" required>
                            <option value="">Selecciona un desarrollo</option>
                            <!-- <?php foreach ($desarrollos as $desarrollo): ?>
                                <option value="<?= $desarrollo['id']; ?>"
                                    <?= isset($lote) && $lote['tipoPropiedad'] == $desarrollo['id'] ? 'selected' : ''; ?>>
                                    <?= strtoupper($desarrollo['name']); ?>
                                </option>
                            <?php endforeach; ?> -->
                        </select>
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
                                    <?= isset($lote) && $lote['idDesarrollo'] == $desarrollo['id'] ? 'selected' : ''; ?>>
                                    <?= strtoupper($desarrollo['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Disponible</option>
                            <option value="2">Vendido</option>
                            <option value="3">Apartado</option>
                            <option value="4">No Vendible</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <?= isset($lote) ? 'Actualizar Lote' : 'Guardar Lote' ?>
            </button>
        </form>
    </div>
</div>

<?php include dirname(__DIR__, 1) . '/layouts/footer.php'; ?>