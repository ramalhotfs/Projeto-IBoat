<?php
    include '../conexaobd.php';
    if(isset($_POST['Login'])){
        if(!isset($_SESSION)){
            session_start();}
            
        $_SESSION['cpf']=$mysqli -> escape_string( $_POST['cpf']);
        $_SESSION['senha'] = md5(md5($_POST['password']));

        $sql = "SELECT senha FROM barqueiro WHERE cpf='$_SESSION[cpf]'";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado = $sql_query -> fetch_assoc();
        $total = $sql_query -> num_rows;
        if($total == 0 ){
            $erro[] = "Esse CPF não existe.";
        }else{

            if( $dado['senha'] == $_SESSION['senha']){

                $_SESSION['user'] = true;
                

            }
            else{
                $erro2[]="Senha incorreta.";
            }
            if(!isset($erro) && !isset($erro2))
                header('Location:../Centrais/centralBar.php');

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
    <link rel="stylesheet" href="../../css/loginBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
    <body>

        <div class="container mb-5">
            <section class="h-100">
                <div class="container h-100">
                    <div class="row justify-content-sm-center h-100">
                        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-8 col-sm-11">
                            <div class="text-center my-5">
                                <img src="../../img/Design_sem_nome_12.png" alt="logo" width="100">
                            </div>
                            <div class="card shadow-lg box">
                                <div class="card-body p-5">
                                    <h1 class="fs-4 card-title fw-bold mb-3">Login</h1>
                                    <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                        <div class="mb-3">
                                            <label class="mb-2 text-muted" for="email">CPF</label>
                                            <input id="cpf" type="text" class="form-control" name="cpf" value='<?php if(isset($_SESSION['cpf']) && !isset($erro)){echo $_SESSION['cpf'];}?>' required>
                                            <div class="invalid-feedback">
                                                CPF invalido
                                            </div>
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

                                        <div class="mb-3">
                                            <div class="mb-2 w-100">
                                                <label class="text-muted" for="password">Senha</label>
                                            </div>
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            <div class="invalid-feedback">
                                                Senha invalida
                                            </div>
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
                                        <div class="d-flex align-items-center">
                                            <button type="submit" name="Login" class="btn btn-primary ms-auto">
                                                Entrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer py-3 border-0">
                                    <div class="text-center">
                                        Ainda não cadastrou seu barco? <a href="register.php" class="text-dark">Cadastrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.mask.min.js"></script>
        <script src="../../js/loginBar.js"></script>
        
    </body>
</html>