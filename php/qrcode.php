<?php

    include 'conexaobd.php';

    $cod = $_GET['cod'];

    $sql = "SELECT chave FROM reserva WHERE id_reserva='$cod'";
    $sql_query = $mysqli->query($sql) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();

    echo "
        <script> 
            var chave ='" . $dado['chave'] . "';
        </script>";

    ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QRCode</title>

    <link rel="stylesheet" href="../css/qrcode.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/qrcode.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="main-title">Seu QRCode</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card" id="box">
                    <div class="card-body">
                        <div id="qrcode">

                        </div>
                    </div>
                </div>
                <div id="down" class="text-center mt-2"></div>
            </div>
        </div>
    </div>

    <script>
        new QRCode(document.getElementById("qrcode"), chave);
        $(document).ready(function() {
            var src = $('#qrcode>img').attr('src');
            console.log(src);
            var div = document.querySelector('#down');
            var btn = document.createElement('a');
            btn.appendChild(document.createTextNode('Baixar QRCode'));
            div.appendChild(btn);
            btn.setAttribute('href', src);
            btn.setAttribute('download', '');
            btn.setAttribute('class', 'btn btn-success');
        });
    </script>
</body>
</html>