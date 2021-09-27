<?php
    include '../conexaobd.php';
    if (isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }
    if(isset($_POST['user']) && strlen($_POST['user']) > 0){
        if(!isset($_SESSION)){
            session_start();
            
            $_SESSION['usuario']=$mysqli -> escape_string( $_POST['user']);
            $_SESSION['senha'] = md5(md5($_POST['pass']));

            $sql = "SELECT pass FROM fipac WHERE user = '$_SESSION[usuario]' ";
            $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
            $dado = $sql_query -> fetch_assoc();
            $total = $sql_query -> num_rows;

            if($total == 0){
                $erro[] = "Esse usuario não existe.";
            }else{

                if( $dado['pass'] == $_SESSION['senha']){

                    $_SESSION['user'] = true;
                    unset(
                        $_SESSION['senha']
                    );

                }
                else{
                    $erro2[]="Senha incorreta.";
                }

            }

            if(!isset($erro) && !isset($erro2)){
                header("location:../Centrais/centralFIPAC.php");
                
            }
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
                    <h3 class="text-center mb-3">Login</h3>
                    <div>
                      <label class="form-label text-muted">Usuario:</label>
                      <input type="text" class="form-control" name="user" placeholder="Entre com seu usuario" value='<?php if(isset($_SESSION['usuario']) && !isset($erro)){echo $_SESSION['usuario'];}?>' required>
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
                      <label class="form-label text-muted">Senha:</label>
                      <input type="password" class="form-control" name="pass" placeholder="Entre com sua senha" required>
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
                    <div class="d-grid gap-2 mx-auto">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    <script>
        
    
    // Example starter JavaScript for disabling form submissions if there are invalid fields
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