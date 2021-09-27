<?php
    include '../conexaobd.php';
    if(isset($_POST['alterar'])){
        if(!isset($_SESSION)){
            session_start();
        }
            $_SESSION['senhaA']= md5(md5($_POST['senhaA']));
            $_SESSION['pass'] = md5(md5($_POST['pass']));
            $_SESSION['pass2'] = md5(md5($_POST['pass2']));

        if(isset($_SESSION['usuario']))
            $sql = "SELECT pass FROM fipac WHERE user = '$_SESSION[usuario]' ";
            $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
            $dado = $sql_query -> fetch_assoc();
            

            if($_SESSION['senhaA'] == $dado['pass'] ){
                if( $_SESSION['pass'] == $_SESSION['pass2']){
                    $sql1 = "UPDATE fipac SET pass = '$_SESSION[pass]' WHERE user = '$_SESSION[usuario]' ";
                    $sql_query = $mysqli -> query($sql1) or die($mysqli -> error);
                }else{
                    $erro2[] = "As novas senhas não conferem.";
                }
            }else{
                $erro[] = "Senha atual incorreta.";
            }

            if(!isset($erro) && !isset($erro2)){
                unset(
                    $_SESSION['senhaA'],
                    $_SESSION['pass'],
                    $_SESSION['pass2']
                );
                echo "<script>
                        alert('Senha alterada com sucesso.');
                        location.href='centralFiPAC.php';
                    </script>";
                
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
    <link rel="stylesheet" href="../../css/loginFIPAC.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-4">
                <img src="../../img/logo_fipac.png" alt="Logo FIPAC">
            </div>
        </div>
        <div class="card mt-5" id="box">
            <div class="card-body">
                <form action="" method="POST" class="needs-validation" novalidate>
                    <h3 class="text-center mb-3">Alterar Senha</h3>
                    <div>
                      <label class="form-label">Senha atual:</label>
                      <input type="password" class="form-control" name="senhaA" placeholder="Entre com sua senha atual" required>
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
                    <div>
                      <label class="form-label">Nova senha:</label>
                      <input type="password" class="form-control" name="pass" placeholder="Entre com sua nova senha" required>
                    </div>
                    <div class="mb-3 erro">
                        <?php
                            if(isset($erro2)){
                                if(count($erro2)>0){
                                    foreach($erro2 as $msg){
                                        echo "<p>$msg</p>";
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div>
                      <label class="form-label">Repita a senha:</label>
                      <input type="password" class="form-control" name="pass2" placeholder="Entre com sua nova senha, novamente" required>
                    </div>
                    <div class="mb-3 erro">
                        <?php
                            if(isset($erro2)){
                                if(count($erro2)>0){
                                    foreach($erro2 as $msg){
                                        echo "<p>$msg</p>";
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-secondary me-md-2" href="javascript:history.back()">Cancelar</a>
                        <button type="submit" name="alterar" class="btn btn-primary">Alterar</button>
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