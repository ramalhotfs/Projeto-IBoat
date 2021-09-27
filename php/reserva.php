<?php
include 'conexaobd.php';
if (isset($_POST['reser'])) {
    $morador = $_POST['Morador'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $cpf = $_POST['cpf'];
    $menor = $_POST['Menor'];

    $dataR = $_POST['data'];
    $hr = $_POST['time'];
    $validado = 'Não';
    $key = md5(uniqid());
    echo '<script>var chave = "' . $key . '";</script>';

    $sql = "INSERT INTO passageiro (nome,email,celular,cpf,IsMenor)" . "value('$nome','$email','$celular','$cpf','$menor')";
    $sql1 = "INSERT INTO reserva(BeValidated,data,horario,chave,IsMorador,cpf)" . "VALUE('$validado','$dataR','$hr','$key','$morador','$cpf')";
    $mysqli->query($sql);
    $mysqli->query($sql1);
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>IBoat</title>
    <link rel="stylesheet" href="../css/CssReserva.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../js/qrcode.min.js"></script>
</head>

<body>
    <div id="cont1" style="display: block;">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="#">
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
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8 mt-5 mb-5 pb-3 teste">
                        <div class="main-title text-center mt-4">
                            <h3>Faça sua Reserva!</h3>
                        </div>
                        <form method="POST" action="" class="needs-validation mt-5" novalidate>
                            <div class="campos">
                                <label for="radio_btn">
                                    Você é morador de arraial?<br>
                                    <div class="aviso">(Se sim, você deve apresentar um comprovante no dia da reserva!)</div>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Morador" value="Sim" required>
                                <label class="form-check-label">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Morador" value="Não" required>
                                <label class="form-check-label">Não</label>
                            </div>
                            <div class="campos">
                                <input type="text" class="form-control" name="nome" placeholder="Digite aqui seu nome" required>
                            </div>
                            <div class="campos">
                                <input type="email" class="form-control" name="email" placeholder="Digite aqui seu email">
                            </div>
                            <div class="campos">
                                <input type="text" class="form-control" name="celular" id="cel" placeholder="Digite aqui seu numero de celular" required>
                            </div>
                            <div class="campos">
                                <label for="radio_btn">
                                    Menor de 15 anos?
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Menor" value="Sim" required>
                                <label class="form-check-label">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Menor" value="Não" required>
                                <label class="form-check-label">Não</label>
                            </div>
                            <div class="campos">
                                <input type="text" class="form-control" name='cpf' id="cpf" placeholder="Digite aqui seu CPF" required>
                            </div>
                            <div class="campos">
                                <label for="data">
                                    Data da reserva:
                                </label>
                            </div>
                            <div class="campos">
                                <input type="date" class="form-control" name="data" required>
                            </div>
                            <div class="campos">
                                <label for="time">
                                    Horario da reserva:<br>
                                    <div class="aviso">
                                        *Horario entre 06:00 e 16:00
                                    </div>
                                </label>
                            </div>
                            <div class="campos">
                                <input type="time" class="form-control" name="time" min='06:00' max='16:00' id='tmp' required>
                            </div>
                            <div class="campos">
                                <button type="submit" name="reser" class="btn btn-primary">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="cont2" style="display: none;">
        <header>
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
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-md-8 teste p-4">
                    <div class="main-title text-center">
                        <h3>Sua reserva foi feita com sucesso!</h3>
                    </div>                    
                    <div id="qrcode1" class="text-center mt-5">

                    </div>
                    <div id="sub-titulo" class="text-center">
                        <p id='titulo-qrcode'>Guarde o QRCode abaixo, e apresente no dia da sua reserva!</p>
                    </div>
                    <div class="mt-3 text-center">
                        <div id="down">
                        
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-secondary" onclick="javascript:location.href='reserva.php';" type="button">Fazer outra reserva</button>
                        <button class="btn btn-primary" name='inicio' onclick="javascript:location.href='../Index.html';" type="button">Voltar a pagina inicial</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            new QRCode(document.getElementById("qrcode1"), chave);
            $(document).ready(function() {
                var src = $('#qrcode1>img').attr('src');
                var div = document.querySelector('#down');
                var btn = document.createElement('a');
                btn.appendChild(document.createTextNode('Baixar QRCode'));
                div.appendChild(btn);
                btn.setAttribute('href',src);
                btn.setAttribute('download','');
                btn.setAttribute('class','btn btn-success')
            });
        </script>
    </div>
    </div>
    <script>

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
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
<?php
if (isset($_POST['reser'])) {
    echo "
        <script>
            document.getElementById('cont1').style.display='none';
            document.getElementById('cont2').style.display='block';   
            if (document.getElementById('cont2').style.display == 'block') {
                history.pushState(null, null, document.URL);
                window.addEventListener('popstate', function () {
                    history.pushState(null, null, document.URL);
                });
            }
        </script>";
}
?>