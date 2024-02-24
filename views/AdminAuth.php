<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/public/css/admin/admin.css">

</head>

<body>

    <div class="login-container">
        <h2>Administração</h2>
        <div class="text-center">
            <img src="<?= SITE ?>/public/images/image-placeholder.png" style="width: 128px;" class="rounded" alt="...">
        </div>
        <form class="login-form">
            <div class="form-group">
                <input type="text" class="form-control mt-5" id="user" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control mt-2" id="password" placeholder="Password">
            </div>
            <button type="submit" class="mt-3">Login</button>
        </form>
        <div class="text-center mt-3" id="loading" style="display:none;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <p id="error-message" class="error-message"></p>
        <div id="success-message" style="display: none;" class="alert alert-success" role="alert">
            Autenticado com Sucesso!
        </div>
        <div id="error-message" class="alert alert-danger" style="display: none;" role="alert">
            Login ou senha incorretos!
        </div>


    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/admin/index.js?id=<?= uniqid() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>