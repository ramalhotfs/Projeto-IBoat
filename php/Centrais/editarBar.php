<?php

    include '../conexaobd.php';

    if(isset($_POST['Salvar'])){
        if(!isset($_SESSION))
            session_start();

        foreach ($_POST as $chave => $valor)
            $_SESSION[$chave] = $mysqli -> real_escape_string($valor);

        $sql = "UPDATE barco SET 
            tipo_emb = '$_SESSION[kind]',
            cor = '$_SESSION[cor]',
            cap_trip = '$_SESSION[cap_trip]',
            cap_pass = '$_SESSION[cap_pass]',
            data_insc = '$_SESSION[data_insc]',
            validade = '$_SESSION[validade]',
            id_motor = '$_SESSION[id_motor]',
            atividade = '$_SESSION[atividade]',
            data_const = '$_SESSION[data_const]'
            WHERE id_barco = '$_SESSION[valor]' 
        ";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);

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
                $_SESSION['data_const'],
                $_SESSION['valor'],
                
            );
            
            echo "
                <script>
                    alert('Os dados foram editados com sucesso.');
                    location.href='cadastradosBar.php';
                </script>
            ";
        }
    }else{

        if(!isset($_SESSION))
            session_start();    

        $sql = "SELECT * FROM barco WHERE id_barco = '$_SESSION[valor]'";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado = $sql_query -> fetch_assoc();
        
        
        $_SESSION['id'] = $dado["id_barco"];
        $_SESSION['cor'] = $dado["cor"];
        $_SESSION['kind'] = $dado["tipo_emb"];
        $_SESSION['cap_trip'] = $dado["cap_trip"];
        $_SESSION['cap_pass'] = $dado["cap_pass"];
        $_SESSION['data_insc'] = $dado["data_insc"];
        $_SESSION['validade'] = $dado["validade"];
        $_SESSION['id_motor'] = $dado["id_motor"];
        $_SESSION['atividade'] = $dado["atividade"];
        $_SESSION['data_const'] = $dado["data_const"];


        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/editar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <img src="../../img/logo_fipac.png" id='logo' alt="Logo FIPAC">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="main-title">Editar Cadastro</h3>
            </div>
            <div class="col-6 offset-md-3 mb-5">
                <form action="" method="POST" class="needs-validation" novalidate="">

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="kind">Tipo de embarcação</label>
                        <input id="kind" type="text" class="form-control" name="kind" value="<?php if(isset($_SESSION['kind'])){echo $_SESSION['kind'];} ?>" required>  
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="cor">Cor da embarcação</label>
                        <input id="cor" type="text" class="form-control" name="cor" value="<?php if(isset($_SESSION['cor'])){echo $_SESSION['cor'];} ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="cap_trip">Capacidade da tripulação</label>
                        <input id="cap_trip" type="number" class="form-control" name="cap_trip" min='0' value="<?php if(isset($_SESSION['cap_trip'])){echo $_SESSION['cap_trip'];} ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="cap_pass">Capacidade de passageiros</label>
                        <input id="cap_pass" type="number" class="form-control" name="cap_pass" min='0' value="<?php if(isset($_SESSION['cap_pass'])){echo $_SESSION['cap_pass'];} ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="data_insc">Data inscrição</label>
                        <input id="data_insc" type="date" class="form-control" name="data_insc" value="<?php if(isset($_SESSION['data_insc'])){echo $_SESSION['data_insc'];} ?>" required>           
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="validade">Validade</label>
                        <input id="validade" type="date" class="form-control" name="validade" value="<?php if(isset($_SESSION['validade'])){echo $_SESSION['validade'];} ?>" required>                       
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="id_motor">Número do motor</label>
                        <input id="id_motor" type="text" class="form-control" name="id_motor" value="<?php if(isset($_SESSION['id_motor'])){echo $_SESSION['id_motor'];} ?>" required>                       
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="data_const">Data da construção</label>
                        <input id="data_const" type="date" class="form-control" name="data_const" value="<?php if(isset($_SESSION['data_const'])){echo $_SESSION['data_const'];} ?>" required>                        
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 text-muted" for="atividade">Atividade</label>
                        <input id="atividade" type="text" class="form-control" name="atividade" value="<?php if(isset($_SESSION['atividade'])){echo $_SESSION['atividade'];} ?>" required>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-secondary me-md-2" href="javascript:history.back()">Cancelar</a>
                        <button class="btn btn-primary me-md-2" type="submit" value="Salvar" name="Salvar">Salvar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>