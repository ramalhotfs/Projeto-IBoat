<?php
    if(!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['cod']))
        echo 
        "<script>
            location.href = 'consulRe.php'; 
        </script>";
    include 'conexaobd.php';
        
    if(isset($_POST['Editar'])){
        if (isset($_POST['check'])){
            if (!isset($_SESSION))
                session_start();
            $qt = count($_POST['check']);       
            if($qt > 1){
                echo 
                "<script>
                    alert('Você só pode editar um registro por vez.');
                    location.href = 'areareserva.php'; 
                </script>";
            }
            else{
                $array = array_filter($_POST['check']);
                $_SESSION['valor'] = implode($array);
                $sql="SELECT id_passageiro FROM passageiro WHERE id_passageiro='$_SESSION[valor]'";
                $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
                $dado1 = $sql_query -> fetch_assoc();
                if(isset($dado1['id_passageiro']) == $_SESSION['valor']){
                    header('location:editarReserva.php');
                }else{
                    unset(
                        $_SESSION['valor']
                   );
                   echo "
                       <script>
                           alert('Houve um erro ao tentar excluir algum dado. Por favor, contatar a FIPAC.');
                           location.href = 'areareserva.php'; 
                       </script>";
                }
            }
        }else{
            echo 
                "<script>
                    alert('Você não selecionou nenhum registro.');
                    location.href = 'areareserva.php'; 
                </script>";
        }

    }else if(isset($_POST['Excluir'])){
        if (isset($_POST['check'])){
            if (!isset($_SESSION))
                session_start();         
        
            $array = $_POST['check'];
            $text = implode(" ", $array);
            $_SESSION['valor'] = explode(" ", $text);
            foreach($_SESSION['valor'] as $valor){
                $sql="SELECT * FROM passageiro WHERE id_passageiro='$valor'";
                $sql_query = $mysqli -> query($sql) or die($mysqli -> error);
                $dado1 = $sql_query -> fetch_assoc();
                if(isset($dado1['id_passageiro']) == $valor){
                    $sql = "DELETE FROM reserva WHERE id_reserva = '$valor'";
                    $sql1 = "DELETE FROM passageiro WHERE id_passageiro = '$valor'";
                    $mysqli -> query($sql) or die($mysqli -> error);
                    $mysqli -> query($sql1) or die($mysqli -> error);
                    if($mysqli->insert_id==true){
                        $idcheck[] = $valor;
                        $tbcheck[] = 2;
                    }
                }else{
                    $iderro[] = $valor; 
                    
                }
            }
            if(!isset($iderro)){
                  if(!isset($tbcheck)){
                    if (count($_SESSION['valor'])>1){
                        unset(
                            $_SESSION['valor']
                        );
                        echo "
                        <script>
                            alert('Reservas excluidas com sucesso.');
                            location.href = 'areareserva.php'; 
                        </script>";
                    }else{
                        unset(
                            $_SESSION['valor']
                        );
                        echo "
                        <script>
                            alert('Reserva excluida com sucesso.');
                            location.href = 'areareserva.php'; 
                        </script>";
                    }
                }else{
                    unset(
                         $_SESSION['valor']
                    );
                    echo "
                        <script>
                            alert('Houve um erro ao tentar excluir algum dado. Por favor, contatar a FIPAC.');
                            location.href = 'areareserva.php'; 
                        </script>";
                }
            }else{
                unset(
                    $_SESSION['valor']
                );
                echo "
                    <script>
                        alert('Houve um erro ao tentar excluir algum dado. Por favor, contatar a FIPAC.');
                        location.href = 'areareserva.php'; 
                    </script>";
            }
        }else{
            echo 
            "<script>
                alert('Você não selecionou nenhuma reserva.');
                location.href = 'areareserva.php'; 
            </script>";
        }
    }

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reserva</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="../css/centralFIPAC.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!--Font-->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
         
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <script>
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function () {
                history.pushState(null, null, document.URL);
            });
        </script>
    </head>
    <body>
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="mt-3">
                    <a href="consulRe.php?cod=10" class='btn btn-danger sair'>Sair</a>
                </div>
            </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="main-title">Reservas Cadastradas</h3>
                            <h5 id="alerta" class="text-center"></h5>
                        </div>
                        <div class="col-12 box mb-3">
                            <table id="table_id" class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Menor de idade</th>
                                        <th>Cabista</th>
                                        <th>Data da Reserva</th>
                                        <th>Horario da Reserva</th>
                                        <th>QRCode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            if(!isset($_SESSION))
                                                session_start();

                                            $sql = "SELECT 
                                                        *
                                                    FROM
                                                        passageiro
                                                    INNER JOIN
                                                        reserva
                                                    ON passageiro.id_passageiro = reserva.id_reserva
                                                    WHERE
                                                        reserva.cpf='$_SESSION[cod]'
                                                    ";
                                    
                                            $con = $mysqli -> query($sql) or die($mysqli -> error);
                                            $dado = $con -> fetch_assoc();
                                            $total = $con -> num_rows;

                                            if($total==0){
                                                echo 
                                                    "<script>
                                                        time=5,r=document.getElementById('alerta'),tmp=time;
                                                        setInterval(function(){
                                                        var c=tmp--,m=(c/60)>>0,s=(c-m*60)+'';
                                                        r.textContent='Saindo da página em: '+(s.length>0?'':'0')+  s;
                                                        tmp!=0||(tmp=time);
                                                        if(s==1){
                                                            location.href='consulRe.php?cod=10';
                                                        }
                                                        },1000);
                                                    </script>";
                                            }

                                            $cont=0;
                                            if($total > 0) {
                                                // inicia o loop que vai mostrar todos os dados
                                                do {
                                                    $cont++;
                                        ?>
                                        
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" value="<?php echo $dado['id_reserva']; ?>" name="check[]"> </td>
                                            <td><?php echo $cont;?></td>
                                            <td><?php echo $dado["nome"];?></td>
                                            <td><?php echo $dado["cpf"];?></td>
                                            <td><?php echo $dado["celular"];?></td>
                                            <td><?php echo $dado["email"];?></td>
                                            <td><?php echo $dado["IsMenor"];?></td>
                                            <td><?php echo $dado["IsMorador"];?></td>
                                            <td><?php echo date("d/m/y",strtotime($dado["data"]));?></td>
                                            <td><?php echo $dado["horario"];?></td>
                                            <td><button type="button" class="btn btn-primary" value="<?php echo $dado['id_reserva']; ?>" >Abrir</button></td>       
                                        </tr>
                                        <?php 

                                            }while($dado = $con -> fetch_array());
                                            // fim do if
                                            }       
                                        

                                        ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit" name="Editar">Editar</button>
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja mesmo excluir o(s) cadastro(s) selecionado(s)?')" name="Excluir">Excluir</button>
                        </div>            
                    </div>
                </form>
        </div>
    </body>
    <script>

        

        $('.btn').on("click", function() {
            var valor = $(this).val();
            var url = 'qrcode.php?cod='+valor;
            location.href= url;
        });                            

        $(document).ready(function() {
            $('#table_id').DataTable
            ( {
                "language": 
                {
                            "sEmptyTable":   	"Não há reservas cadastradas",
                            "sInfo":         	"Mostrando página _PAGE_ de _PAGES_",
                            "sInfoEmpty":    	"Nenhum cadastro disponivel",
                            "sInfoFiltered": 	"(filtrando de _MAX_ reservas no total)",
                            "sInfoPostFix":  	"",
                            "sInfoThousands":  	".",
                            "sLengthMenu":   	"Mostrando _MENU_ cadastros por página",
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


            
    </script>                                
</html>