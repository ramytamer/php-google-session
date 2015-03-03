<?php

require_once 'init.php';

if($app->isLoggedin()){ redirect(); }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Join Us</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
		<link href="bower_components/flat-ui/dist/css/flat-ui.css" rel="stylesheet">

	</head>
	<body>
		<div class="container">

			<?php if(!empty($_SESSION['errors'])): ?>
				<div class="row">
					<ul class="col-xs-12 col-md-6 col-md-offset-3">
						<?php foreach($_SESSION['errors'] as $error): ?>
							<li class="text-danger">
								<?=$error?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php $_SESSION['errors']=[]; endif; ?>


			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<legend>Join Us</legend>

					<form action="register.php" method="POST" role="form">

						<div class="form-group">
							<label for="inputFullName" class="col-xs-12 control-label">Full Name:</label>
							<div class="col-xs-12">
								<input type="text" name="fullName" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail" class="col-xs-12 control-label">Email:</label>
							<div class="col-xs-12">
								<input type="email" name="email" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword" class="col-xs-12 control-label">Password:</label>
							<div class="col-xs-12">
								<input type="password" name="password" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPasswordConfirmation" class="col-xs-12 control-label">
								Password Again:
							</label>
							<div class="col-xs-12">
								<input type="password" name="passwordConfirmation" class="form-control" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<br>
								<button type="submit" class="btn btn-primary btn-block">Register</button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<div class="row"><hr></div>

			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<p>Already have an account, Login <a href="signin.php">here</a></p>
				</div>
			</div>
		</div>
	</body>
</html>