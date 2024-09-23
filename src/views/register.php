<!-- src/views/register.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="/css/app.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Registrar nuevo usuario</h2>

        <?php if (!empty($error) || !empty($success)): ?>
            <div class="alert <?= !empty($error) ? 'alert-danger' : 'alert-success' ?>">
                <?= !empty($error) ? $error : $success ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/register">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="user">Usuario:</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="idRol">Rol:</label>
                <select class="form-control" id="idRol" name="idRol" required>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Estado:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>