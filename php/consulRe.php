<?php
    if(isset($_GET['cod'])){
        if(!isset($_SESSION)){
            session_start();}
        unset(
            $_SESSION['cod']
        );
    }
    include 'conexaobd.php';
    if(isset($_POST['cpf'])){
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['cod'] = $_POST['cpf'];

        $sql = "SELECT * FROM reserva WHERE cpf = '$_SESSION[cod]' ";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado = $sql_query -> fetch_assoc();
        $total = $sql_query -> num_rows;

        if($total == 0){
            $erro[] = "Não reserva(s) cadastrada(s) neste CPF.";
        }else{

            header("location:areareserva.php");
        }
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="../css/consulRe.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!--Font-->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
        <!--Scripts-->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="../js/reservaJS.js"></script>
    </head>
    <body>
        <header >
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="../Index.html">
                        <img id="logo" src="../img/logo.png" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse justify-content-end " id="navbar-links">
                            <ul class="navbar nav ">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="../Index.html">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="../fipac.php">Portal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Marinha</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="../reservaCentral.html">Reserva</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header> 
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <h3 class="main-title">Consultar Reserva</h3>
                </div>
            </div>
            <div class="card mt-5" id="box">
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div>
                            <label class="form-label text-muted">CPF:</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Entre com seu CPF" required>
                        </div>
                        <div class="mb-3 erro">
                            <?php
                                if(isset($erro)){
                                    if(count($erro)>0){
                                        foreach($erro as $msg){
                                            echo "<p>$msg</p>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-secondary me-md-2" href="../reservaCentral.html">Cancelar</a>
                            <button class="btn btn-primary" type="submit">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>// Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
                })
            })()
        </script>
    </body>
</html>