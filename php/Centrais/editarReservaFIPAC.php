<?php
    include '../conexaobd.php';

    if(isset($_POST['Salvar'])){

        
        $morador=$_POST['Morador'];
        $dataR = $_POST['data'];    
        $hr=$_POST['time'];
        $validado=$_POST['Validado'];

        if(!isset($_SESSION))
            session_start();

        $sql = "UPDATE reserva SET 
            BeValidated = '$validado',
            data = '$dataR',
            horario = '$hr',
            IsMorador = '$morador'
            WHERE id_reserva = '$_SESSION[ids]'
        ";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);

        if($sql_query){
            unset(
                $_SESSION['ids'],
                $_SESSION['valido'],
                $_SESSION['data'],
                $_SESSION['horario'],
                $_SESSION['morador']
            );
            echo "
                <script>
                    alert('Os dados foram editados com sucesso.');
                    location.href='centralFIPAC.php';
                </script>
            ";
        }
    }else{

        if(!isset($_SESSION))
            session_start();

        $sql = "SELECT * FROM reserva WHERE id_reserva='$_SESSION[ids]'";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado = $sql_query -> fetch_assoc();
        
        
        $_SESSION['valido'] = $dado['BeValidated'];
        $_SESSION['data'] = $dado['data'];
        $_SESSION['horario'] = $dado['horario'];
        $_SESSION['morador'] = $dado['IsMorador'];


        
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
                    <form action="" method="POST">
                        <!--VALIDADO-->
                        <div class="campos">
                            <label>Validado:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Validado" value="Sim" <?php if($_SESSION['valido'] == 'true'){echo "checked";} ?> required>
                            <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Validado" value="Não" <?php if($_SESSION['valido'] == 'false'){echo "checked";} ?> required>
                                <label class="form-check-label" >Não</label>
                        </div>
                        <div class="campos"> 
                            <label>Data da reserva:</label>
                        </div>
                        <div class="campos">
                            <input type="date" class="form-control" name="data" value="<?php echo $_SESSION['data']; ?>" required>
                        </div>   
                        <div class="campos">
                            <label>Horario da reserva:</label>
                        </div>
                        <div class="campos">
                            <input type="time" class="form-control" name="time" min='06:00' max='16:00' value="<?php echo $_SESSION['horario']; ?>" required>
                        </div>

                            <!--MORADOR-->
                        <div class="campos">
                            <label>Morador da cidade:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Morador" value="Sim" <?php if($_SESSION['morador'] == 'Sim'){echo "checked";} ?> required>
                            <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Morador" value="Não" <?php if($_SESSION['morador'] == 'Não'){echo "checked";} ?> required>
                                <label class="form-check-label" >Não</label>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-secondary me-md-2" href="centralFIPAC.php">Cancelar</a>
                            <button class="btn btn-primary" type="submit" value="Salvar" name="Salvar">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>