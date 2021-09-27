<?php

	include '../conexaobd.php';

    //Verificando se o botão Cadastrar foi chamado
	if(isset($_POST['Cadastrar'])){

		//Verificando se extiste uma SESSION
        if(isset($_SESSION))
            session_start();
		
		//Criando um loop para pegar os valores dos inputs
        foreach ($_POST as $chave => $valor)
            $_SESSION[$chave] = $mysqli -> real_escape_string($valor);
        
		//Criptografia da senha
		$senha = md5(md5($_SESSION['password']));
		
        $sql = "INSERT INTO barqueiro (
            nome,
            cpf,
            senha
        )VALUES(
            '$_SESSION[name]',
            '$_SESSION[cpf]',
            '$senha'

        )";

        $sql_query = $mysqli -> query($sql) or die ("<script>
                    alert('Desculpa algo deu errado nessa operacão.\\nVocê será redirecionado à pagina de login.');
                    location.href = 'loginBar.php';
                    </script>");

        if($sql_query){
            unset(
                $_SESSION['nome'],
                $_SESSION['cpf'],
                $_SESSION['password']
            );
            echo "<script>
                    alert('Os dados da embarcação foram cadastrados com sucesso.\\nVocê será redirecionado à pagina de login.');
                    location.href = 'loginBar.php';
                </script>";
        }else{
            echo "<script>
			alert('Desculpa algo deu errado nessa operacão.\\nVocê será redirecionado à pagina de login.');
			location.href = 'loginBar.php';
			</script>";
        }

	}

?>

<html lang="en">
<head>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Cadastro</title>
	<link rel="stylesheet" href="../../css/register.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mask.min.js"></script>
	<script src="../../js/registerBar.js"></script>
</head>

<body>
	<section>
		<div class="container mb-5">
			<div class="row justify-content-sm-center">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Cadastro</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Nome completo</label>
									<input id="name" type="text" class="form-control" name="name" value="" required autofocus>
									<div class="invalid-feedback">
										Nome inválido
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">CPF</label>
									<input id="cpf" type="text" class="form-control" name="cpf" value="" required>
									<div class="invalid-feedback">
										CPF inválido
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Senha</label>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Senha inválida
							    	</div>
								</div>

								<div class="align-items-center d-flex">
									<button type="submit" name="Cadastrar" class="btn btn-primary ms-auto">
										Cadastrar	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Já é cadastrado? <a href="index.html" class="text-dark">Entrar</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
        <div id="rodape">
            <div class="container">
                <div class="row">
                    <p>Desenvolvido por <a href="" target="_blank">IBoat</a>&copy;2021</p>
                </div>
            </div>
        </div>
    </footer>
	<script>




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