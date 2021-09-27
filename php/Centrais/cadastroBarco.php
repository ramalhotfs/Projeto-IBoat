<?php

    include '../conexaobd.php';


    //Verificando se o botão Cadastrar foi chamado
    if(isset($_POST['Cadastrar'])){


        //Verificando se extiste uma SESSION
        if(!isset($_SESSION))
            session_start();
        
        //Criando um loop para pegar os valores dos inputs
        foreach ($_POST as $chave => $valor)
            $_SESSION[$chave] = $mysqli -> real_escape_string($valor);
        
        $sql = "INSERT INTO barco (
            tipo_emb,
            cor,
            cap_trip,
            cap_pass,
            data_insc,
            validade,
            id_motor,
            atividade,
            data_const,
            cpf,
            validado
        )VALUES(
            '$_SESSION[kind]',
            '$_SESSION[cor]',
            '$_SESSION[cap_trip]',
            '$_SESSION[cap_pass]',
            '$_SESSION[data_insc]',
            '$_SESSION[validade]',
            '$_SESSION[id_motor]',
            '$_SESSION[atividade]',
            '$_SESSION[data_const]',
            '$_SESSION[cpf]',
            'Não'

        )";

        $sql_query = $mysqli -> query($sql) or die ("<script>
                    alert('Desculpa algo deu errado nessa operacão.\\nVocê será redirecionado à pagina principal.');
                    location.href = 'centralBar.php';
                    </script>");

        if($sql_query){
            unset(
                $_SESSION['kind'],
                $_SESSION['cor'],
                $_SESSION['cap_trip'],
                $_SESSION['cap_pass'],
                $_SESSION['data_insc'],
                $_SESSION['validade'],
                $_SESSION['id_motor'],
                $_SESSION['atividade'],
                $_SESSION['data_const']
            );
            echo "<script>
                    alert('Os dados da embarcação foram cadastrados com sucesso.\\nVocê será redirecionado à pagina principal.');
                    location.href = 'centralBar.php';
                </script>";
        }else{
            echo "<script>
            alert('Desculpa algo deu errado nessa operacão.\\nVocê será redirecionado à pagina principal.');
            location.href = 'centralBar.php';
            </script>";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- CSS only -->
    <link rel="stylesheet" href="../../css/cadastroBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-8 col-sm-11 mb-5">
                        <div class="text-center mt-5 mb-5">
                            <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                        </div>
                        <div class="card shadow-lg box mb-5">
                            <div class="card-body p-5 pb-2">
                                <h1 class="fs-4 card-title fw-bold mb-4">Cadastro de embarcação</h1>
                                <form action="" method="POST" class="needs-validation" novalidate="">
                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="kind">Tipo de embarcação</label>
                                        <input id="kind" type="text" class="form-control" name="kind" value="<?php if(isset($_SESSION['kind'])){echo $_SESSION['kind'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="cor">Cor da embarcação</label>
                                        <input id="cor" type="text" class="form-control" name="cor" value="<?php if(isset($_SESSION['cor'])){echo $_SESSION['cor'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Cor invalida
                                        </div>
                                    </div>
                                    <div class="mb-3 erro">
                                        <?php
                                            if(isset($erro1)){
                                                if(count($erro1)>0){
                                                    foreach($erro1 as $msg){
                                                        echo "<p>$msg</p>";
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>


                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="cap_trip">Capacidade da tripulação</label>
                                        <input id="cap_trip" type="number" class="form-control" name="cap_trip" min='0' value="<?php if(isset($_SESSION['cap_trip'])){echo $_SESSION['cap_trip'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="cap_pass">Capacidade de passageiros</label>
                                        <input id="cap_pass" type="number" class="form-control" name="cap_pass" min='0' value="<?php if(isset($_SESSION['cap_pass'])){echo $_SESSION['cap_pass'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="data_insc">Data inscrição</label>
                                        <input id="data_insc" type="date" class="form-control" name="data_insc" value="<?php if(isset($_SESSION['data_insc'])){echo $_SESSION['data_insc'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="validade">Validade</label>
                                        <input id="validade" type="date" class="form-control" name="validade" value="<?php if(isset($_SESSION['validade'])){echo $_SESSION['validade'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="id_motor">Número do motor</label>
                                        <input id="id_motor" type="text" class="form-control" name="id_motor" value="<?php if(isset($_SESSION['id_motor'])){echo $_SESSION['id_motor'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="data_const">Data da construção</label>
                                        <input id="data_const" type="date" class="form-control" name="data_const" value="<?php if(isset($_SESSION['data_const'])){echo $_SESSION['data_const'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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
                                        <label class="mb-2 text-muted" for="atividade">Atividade</label>
                                        <input id="atividade" type="text" class="form-control" name="atividade" value="<?php if(isset($_SESSION['atividade'])){echo $_SESSION['atividade'];} ?>" required>
                                        <div class="invalid-feedback">
                                            Dado invalido
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

                                    <div class="d-flex align-items-center">
                                        <button type="submit" name='Cadastrar' class="btn btn-primary ms-auto">
                                            Cadastrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-3 border-0">
                                <div class="text-center">
                                    Não deseja cadastrar sua embarcação? <a href="centralBar.php" class="text-dark">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
   
    <footer>
        <div id="rodape">
            <div class="container">
                <div class="row">
                    <p>Desenvolvido por <a href="../../Index.html">IBoat</a>&copy;2021</p>
                </div>
            </div>
        </div>
    </footer>

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