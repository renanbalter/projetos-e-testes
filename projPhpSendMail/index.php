<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

	<body>

		<div class="container">  

			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="img/logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

      		<div class="row">
      			<div class="col-md-12">
  				
					<div class="card-body font-weight-bold">
						<form action="process.php" method="POST">
							<div class="form-group">
								<label for="to">Para</label>
								<input type="text" class="form-control" id="to" name="to" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="subject">Assunto</label>
								<input type="text" class="form-control" id="subject" name="subject" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="message">Mensagem</label>
								<textarea class="form-control" name="message"id="mensagem"></textarea>
							</div>

							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>