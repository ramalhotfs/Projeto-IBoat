<?php
    include '../Login/protect.php'; 
    protect();
    if(!isset($_SESSION))
        session_start();
    $_SESSION['user'] = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barqueiros</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="../../css/centralFIPAC.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script>
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5 offset-xl-1">
            <img src="../../img/logo_fipac.png" id='logo' alt="Logo FIPAC">
        </div>
        <div class="col-xl-2 mt-3 offset-xl-4">
            <div class="btn-group">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Alterar Endereco</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="btn-group">
                <a href='../Login/logout.php?codigo=2' class='btn btn-danger'>Sair</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="main-title">Serviços</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <div class="col">
                <div class="card">
                    <a href="cadastroBarco.php">
                        <img src="../../img/Selfe.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-center">Adicionar barco</h5>
                    </div>
                </div>
            </div>
                <div class="col">
                    <div class="card">
                        <a href="cadastradosBar.php">
                            <img src="../../img/Selfe.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-center">Mostrar barcos cadastrados</h5>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>