<!-- src/views/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EcoHabitatSystem - Iniciar sesión</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/logo/favicon.png">

    <!-- Core css -->
    <link href="/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">
                <div class="col-lg-4 d-none d-lg-flex bg" style="background-image:url('/images/others/login-1.jpg')">
                    <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <img src="/images/logo/logo-white.png" alt="">
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Sistema Cedral</h1>
                            <p class="text-white font-size-16 lh-2 w-80 opacity-08">Plataforma para la gestión eficiente de lotes, desarrollos y pagos. Organiza inventarios y controla transacciones fácilmente, diseñado para El Cedral Eco Hábitat.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">© <?= date('Y'); ?> EcoHabitatSystem</span>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Legal</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Privacy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <h2>Iniciar Sesión</h2>
                                <p class="m-b-30">Ingrese sus credenciales para obtener acceso</p>
                                
                                <!-- Mostrar error si existe -->
                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-danger">
                                        <?= $error ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="/login">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Usuario:</label>
                                        <div class="input-affix">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="text" class="form-control" id="userName" name="user" placeholder="Usuario" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Contraseña:</label>
                                        <a class="float-right font-size-13 text-muted" href="">Olvidaste la Contraseña?</a>
                                        <div class="input-affix m-b-10">
                                            <i class="prefix-icon anticon anticon-lock"></i>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Core Vendors JS -->
    <script src="/js/vendors.min.js"></script>

    <!-- Core JS -->
    <script src="/js/app.min.js"></script>

</body>

</html>
