<?php
include "php/conexaobd.php";

$sql = "SELECT * FROM reserva";
$sql_query = $mysqli->query($sql);
$totalR = $sql_query->num_rows;


$sql = "SELECT * from reserva where locate('Sim',IsMorador)>0";
$sql_query = $mysqli->query($sql);
$totalM = $sql_query->num_rows;


$sql = "SELECT * from reserva where locate('Não',IsMorador)>0";
$sql_query = $mysqli->query($sql);
$totalT = $sql_query->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIPAC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- CSS only -->
    <link rel="stylesheet" href="css/fipaccss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Icons-->
    <script src="https://kit.fontawesome.com/4e2a9c03bf.js" crossorigin="anonymous"></script>
    <!--Font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!--Jquery-->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!--Progress Bar-->
    <script type="text/javascript" src="js/progressbar.min.js"></script>
    <!-- Parallax -->
    <script src="https://cdn.jsdelivr.net/parallax.js/1.4.2/parallax.min.js"></script>
    <!--Script-->
    <script type="text/javascript" src="js/fipac.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="Index.html">
                    <img src="img/logo.png" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end " id="navbar-links">
                    <ul class="navbar nav">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="Index.html">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="fipac.php">Portal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Marinha</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="reservaCentral.html">Reserva</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="http://localhost/projeto/reserva.php" class="main-btn">
                            <img src="img/imgcarro1.jpeg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="http://localhost/projeto/reserva.php" class="main-btn">
                            <img src="img/imgcarro2.jpeg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="http://localhost/projeto/reserva.php" class="main-btn">
                            <img src="img/parallax1.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div id="fipac">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">Serviços da FIPAC</h3>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 col-sm-4">
                        <div class="card">
                            <a href="php/Login/loginBar.php">
                                <img src="img/portal.png" class="card-img" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="card">
                            <a href="https://www.windguru.cz/291325">
                                <img src="img/clima.jpeg" class="card-img" alt="...">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 espaco">
                        <div class="card ">
                            <a href="php/Login/loginFIPAC.php">
                                <img src="img/portalfi.jpeg" class="card-img" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="so-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">Transparência</h3>
                    </div>
                </div>
            </div>
        </div>
        <div id="transp">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 circle-box">
                        <div id="circleA">
                            <p>Total de Reservas</p>
                        </div>
                    </div>
                    <div class="col-md-3 circle-box">
                        <div id="circleB" style="position: relative;">
                            <p>Feitas por Cabistas</p>
                        </div>
                    </div>
                    <div class="col-md-3 circle-box">
                        <div id="circleC">
                            <p>Feitas por Turistas</p>
                        </div>
                    </div>
                    <div class="col-md-3 circle-box">
                        <div id="circleD">
                            <p>Total Arrecadado</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="about-fipac">
            <div class="container">
                <div class="row">
                    <div class="co-12">
                        <h3 class="main-title" id="unic">Sobre a FIPAC</h3>
                    </div>
                    <div class="col-12">
                        <h4 id="sub-title">A FIPAC atua na cidade seriamente e com responsabilidade.</h4>
                        <p id="sub">Conheça nossos trabalhos:</p>
                    </div>
                    <div class="card-group mb-5">
                        <div class="card">
                            <a href="https://www.fipac.rj.gov.br/site/noticia/almoco-de-confraternizacao-do-dia-do-trabalhador">
                                <img src="img/Noticias/noticia1.jpeg" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Almoço de Confraternização do Dia do Trabalhador</h5>
                                <p class="card-text">Neném da cabocla, presidente da FIPAC realizou almoço de confraternização em sua sede com sorteio de muitos brindes para seus funcionários. O evento evento é mais uma demostração do compromisso da Fipac com seus colaboradores</p>
                                <p class="card-text"><small class="text-muted">Publicado em 01/05/2019 19:05:47</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <a href="https://www.fipac.rj.gov.br/site/noticia/fipac-inaugura-posto-de-emergencia-na-marina-dos-pescadores">
                                <img src="img/Noticias/noticia2.jpeg" class="card-img-top" style="height: 247.02px;" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">Fipac Inaugura Posto de Emergência na Marina dos Pescadores</h5>
                                <p class="card-text">A Fipac em Parceria com a Secretaria de Saúde, inaugurou o Posto de Saúde de Emergência na Marina do Pescadores em Arraial do Cabo, o posto conta com uma equipe técnica de emergência com enfermeiros e auxiliares e uma ambulância UTI Movél.</p>
                                <p class="card-text"><small class="text-muted">Publicado em 12/04/2018 14:18:27</small></p>
                            </div>
                        </div>
                        <div class="card">
                            <a href="https://www.fipac.rj.gov.br/site/noticia/a-fipac-realiza-limpeza-das-praias-atraves-do-projeto-fipac-sustentavel">
                                <img src="img/Noticias/noticia3.jpeg" class="card-img-top" style="height: 247.02px;" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">A FIPAC realiza limpeza das praias, através do projeto FIPAC Sustentável</h5>
                                <p class="card-text">Uma das atividades importantes realizada pela Fipac, através do projeto FIPAC SUSTENTÁVEL, é a ação de limpeza das praias, com o recolhimento do lixo da Praia do Forno e das Prainhas do Pontal do Atalaia, que compõe o roteiro turístico do passeio de barco da cidade.</p>
                                <p class="card-text"><small class="text-muted">Publicado em 12/04/2018 13:42:07</small></p>
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
                    <p>Desenvolvido por <a href="" target="_blank">IBoat</a>&copy;2021</p>
                </div>
            </div>
        </div>
    </footer>
    <input type="hidden" id="totalR" value="<?php echo $totalR ?>" />
    <input type="hidden" id="totalM" value="<?php echo $totalM ?>" />
    <input type="hidden" id="totalT" value="<?php echo $totalT ?>" />
</body>

</html>