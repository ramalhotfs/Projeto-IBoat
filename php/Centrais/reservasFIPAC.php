
<?php
    include '../conexaobd.php';
    
    
    if(isset($_POST['Editar'])){
        if (isset($_POST['check'])){
            if (!isset($_SESSION))
                session_start();
            $qt = count($_POST['check']);       
            if($qt > 1){
                echo 
                "<script>
                    alert('Você só pode editar uma reserva por vez.');
                    windows.load();
                </script>";
            }
            else{
                $array = array_filter($_POST['check']);
                $_SESSION['ids'] = implode($array);
                header('location:editarReservaFIPAC.php');
            }
        }else{
            echo 
                "<script>
                    alert('Você não selecionou nenhum registro.');
                    windows.load();
                </script>";
        }

    }else if(isset($_POST['Excluir'])){
        if (isset($_POST['check'])){
            if (!isset($_SESSION))
                session_start();         
            $qt = count($_POST['check']);
            $array = array_filter($_POST['check']);
            $frase = implode(" ", $array);
            $_SESSION['ids'] = explode(" ",$frase);
            $check = 0;
            foreach($_SESSION['ids'] as $valor){
                $sql[$valor] = "DELETE FROM reserva WHERE id_reserva = '$valor'";
                $sql_query[$valor] = $mysqli -> query($sql[$valor]) or die($mysqli -> error);
                if ($sql_query[$valor]){
                    $check = $check + 1;
                }
            }
            if($check == $qt){
                if($qt>1){
                    unset(
                        $_SESSION['ids']
                    );
                    echo "
                    <script>
                        alert('Reservas excluidas com sucesso.');
                        windows.load();
                    </script>";
                }
                else{
                    echo "
                    <script>
                        alert('Reservas excluidas com sucesso.');
                        windows.load();
                    </script>";
                }
            }else{
                echo "
                <script>
                    alert('Não foi possivel excluir a reserva.');
                    windows.load();
                </script>";
            }
        }
        else{
            echo 
            "<script>
                alert('Você não selecionou nenhuma reserva.');
                windows.load();
            </script>";
        }
    }

    $consulta="SELECT * FROM reserva";
    
    $con = $mysqli -> query($consulta) or die($mysqli -> error);

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="../../css/centralFIPAC.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!--Font-->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    </head>
    <body>  
        <div class="container-fluid mb-5">
            <div class="mt-3">
                <a href='centralFIPAC.php' class='btn btn-primary sair'>Voltar</a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-5">
                        <img src="../../img/logo_fipac.png" id='logo' alt="Logo FIPAC">
                        
                    </div>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">Reservas</h3>
                        </div>
                        <div class="col-12  mb-4 box">
                            <table id="table_id" class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="check[]" class="form-check-input" onclick="marcarTodos(this.checked);"></th>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Validado</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Chave</th>
                                        <th>Morador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($dado = $con -> fetch_array()){
                                        $codigo = $dado['id_reserva'];
                                        $consul = "SELECT * FROM passageiro WHERE id_passageiro = $codigo";
                                        $sql_query = $mysqli -> query($consul) or die($mysqli -> error);
                                        $dado1 = $sql_query -> fetch_assoc();
                                    ?>
                                    
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo $dado['id_reserva']; ?>" name="check[]"> 
                                            </div>
                                        </td>
                                        <td><?php echo $dado["id_reserva"];?></td>
                                        <td><?php echo $dado1["nome"];?></td>
                                        <td><?php echo $dado1["cpf"];?></td>
                                        <td><?php echo $dado["BeValidated"];?></td>
                                        <td><?php echo date("d/m/y",strtotime($dado["data"]));?></td>
                                        <td><?php echo $dado["horario"];?></td>
                                        <td><?php echo $dado["chave"];?></td>
                                        <td><?php echo $dado["IsMorador"];?></td>
                                    </tr>

                                    <?php 
                                        }                           
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="submit" name="Editar">Editar</button>
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja mesmo excluir a(s) reserva(s) selecionada(s)?')" name="Excluir">Excluir</button>
                        </div>            
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script>
            $(document).ready(function() {
                $('#table_id').DataTable
                ( {
                    "language": 
                    {
                                "sEmptyTable":   	"Não há reservas cadastradas",
                                "sInfo":         	"Mostrando página _PAGE_ de _PAGES_",
                                "sInfoEmpty":    	"Nenhuma reserva disponivel",
                                "sInfoFiltered": 	"(filtrando de _MAX_ reservas no total)",
                                "sInfoPostFix":  	"",
                                "sInfoThousands":  	".",
                                "sLengthMenu":   	"Mostrando _MENU_ reservas por página",
                                "sLoadingRecords": 	"Wird geladen...",
                                "sProcessing":   	"Bitte warten...",
                                "sSearch":       	"Procurar",
                                "sZeroRecords":  	"Nada encontrado",
                                "oPaginate": {
                                    "sFirst":    	"Primeiro",
                                    "sPrevious": 	"Anterior",
                                    "sNext":     	"Proximo",
                                    "sLast":     	"Ultima"
                                },
                                "oAria": {
                                    "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
                                    "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
                                }
                    }
                } );
            } );


            function marcarTodos(marcar){
            var itens = document.getElementsByName('check[]');

            var i = 0;
            for(i=0; i<itens.length;i++){
                itens[i].checked = marcar;
            }

        }
    </script>
</html>