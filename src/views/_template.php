<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= CONF_URL_FULL . "/src/views/assets/css/app.css" ?>">

    <title>Minha Loja</title>
</head>
<script>
    const urlBase = '<?= CONF_URL_FULL ?>';
</script>

<body class="d-flex flex-column ">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand mx-5 text-warning" href="<?= url(CONF_URL_BASE) ?>">LOGO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Alterar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-5" id="navContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-warning active fw-bold" aria-current="page" href="<?= url(CONF_URL_BASE) ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= url(CONF_URL_BASE . "/caixinha") ?>">Caixinha de joias</a>
                        </li>
                    </ul>
                    <form class="d-flex mx-5">
                        <input id="inputSearch" class="form-control me-2" type="search" placeholder="Buscar produtos" aria-label="Buscar produtos">
                        <button id="btnSearch" class="btn btn-outline-warning" type="submit">Buscar</button>
                    </form>
                    <a class="btn text-warning fs-5" href="<?= url(CONF_URL_BASE . "/caixinha") ?>" id="optionsMenu">
                        <i class="bi bi-bag-fill"></i>
                        <div class='badge badge-warning bg-warning cart-item-count' id='cartItemCount'>0</div>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid my-4">
        <?= $this->section('content') ?>
    </div>

    <footer class="mt-5">
        <nav class="navbar fixed-bottom navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-center align-items-stretch p-1">
                <span class="text-warning" href="#">
                    Desenvolvido por Marcus Graciano. Fevereiro, 2023.
                </span>
            </div>
        </nav>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= CONF_URL_FULL . "/src/views/assets/js/shop.js" ?>"></script>
</body>

</html>