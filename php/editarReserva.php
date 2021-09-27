<?php
    if(!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['cod']))
        echo 
        "<script>
            location.href = 'consulRe.php'; 
        </script>";
    include 'conexaobd.php';

    if(isset($_POST['Salvar'])){

        
        $morador=$_POST['Morador'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $cpf=$_POST['cpf']; 
        $menor=$_POST['Menor'];

        $dataR = $_POST['data'];    
        $hr=$_POST['time'];
        if(!isset($_SESSION))
            session_start();

        $sql = "UPDATE reserva SET 
            data = '$dataR',
            horario = '$hr',
            IsMorador = '$morador'
            WHERE id_reserva = '$_SESSION[valor]'
        ";

        $sql1 = "UPDATE passageiro SET 
        nome = '$nome',
        email = '$email',
        celular = '$celular',
        IsMenor = '$menor',
        cpf = '$cpf'
        WHERE id_passageiro = '$_SESSION[valor]'
        ";

        $mysqli -> query($sql) or die($mysqli -> error);
        $mysqli -> query($sql1) or die($mysqli -> error);

        if($mysqli->insert_id==false){
            unset(
                $_SESSION['nome'],
                $_SESSION['email'],
                $_SESSION['cel'],
                $_SESSION['menor'],
                $_SESSION['cpf'],
                $_SESSION['data'],
                $_SESSION['horario'],
                $_SESSION['morador'],
                $_SESSION['valor']
            );
            echo "
                <script>
                    alert('Os dados foram editados com sucesso.');
                    location.href='areareserva.php';
                </script>
            ";
        }
    }else{

        if(!isset($_SESSION))
            session_start();

        $sql = "SELECT * FROM reserva WHERE id_reserva='$_SESSION[valor]'";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado = $sql_query -> fetch_assoc();

        $sql = "SELECT * FROM passageiro WHERE id_passageiro='$_SESSION[valor]'";
        $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
        $dado1 = $sql_query -> fetch_assoc();
        
        $_SESSION['nome'] = $dado1['nome'];
        $_SESSION['email'] = $dado1['email'];
        $_SESSION['cel'] = $dado1['celular'];
        $_SESSION['menor'] = $dado1['IsMenor'];
        $_SESSION['cpf'] = $dado['cpf'];
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
        <link rel="stylesheet" href="../css/editar.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="../js/reservaJS.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3 class="main-title">Editar Reserva</h3>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <form action="" method="POST">
                        <!--Morador-->
                        <div class="campos">
                            <label>Você é morador de arraial?<div class="aviso">(Se sim, você deve apresentar um comprovante no dia da reserva!)</div></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Morador" value="Sim" <?php if($_SESSION['morador'] == 'Sim'){echo "checked";} ?> required>
                            <label class="form-check-label">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Morador" value="Não" <?php if($_SESSION['morador'] == 'Não'){echo "checked";} ?> required>
                                <label class="form-check-label" >Não</label>
                        </div>
                        <div class="campos">
                            <input type="text" class="form-control" name="nome" placeholder="Digite aqui seu nome" value="<?php if(isset($_SESSION['nome'])){echo $_SESSION['nome'];} ?>" required>
                        </div>
                        <div class="campos">
                            <input type="email" class="form-control" name="email" placeholder="Digite aqui seu email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>">                        
                        </div>
                        <div class="campos">
                            <input type="text" class="form-control" name="celular" id="cel" placeholder="Digite aqui seu numero de celular" value="<?php if(isset($_SESSION['cel'])){echo $_SESSION['cel'];} ?>" required>
                        </div>
                        <div class="campos">
                            <label for="radio_btn">
                                Menor de 15 anos?
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Menor" value="Sim" <?php if($_SESSION['menor'] == 'Sim'){echo "checked";} ?> required>
                            <label class="form-check-label">Sim</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Menor" value="Não" <?php if($_SESSION['menor'] == 'Não'){echo "checked";} ?> required>
                            <label class="form-check-label" >Não</label>
                          </div>
                        <div class="campos">
                            <input type="text" class="form-control" name='cpf' id="cpf" placeholder="Digite aqui seu CPF" value="<?php if(isset($_SESSION['cpf'])){echo $_SESSION['cpf'];} ?>" required>                          
                        </div>
                        <div class="campos">
                            <label for="data">
                                Data da reserva:
                            </label>
                        </div>
                        <div class="campos">
                            <input type="date" class="form-control" name="data" value="<?php echo $_SESSION['data']; ?>" required>
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
                            <input type="time" class="form-control" name="time" min='06:00' max='16:00' id='tmp'  value="<?php echo $_SESSION['horario']; ?>" required>
                        </div>
                        <div class="d-grid gap-2 d-md-flex mt-4 justify-content-md-end">
                            <a class="btn btn-secondary me-md-2" href="areareserva.php">Cancelar</a>
                            <button class="btn btn-primary" type="submit" value="Salvar" name="Salvar">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>