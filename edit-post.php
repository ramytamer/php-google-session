<?php
require_once 'init.php';

if(!$app->isLoggedin()) redirect('signin.php');

$post = $app->getPostById((int)$_GET['p']);

if(!$post) redirect();

if($post->user_id !== $_SESSION['user']) redirect("post.php?p={$post->id}");

$user = $app->getUserById($_SESSION['user']);


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Edit "<?=$post->title?>"</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
		<link href="bower_components/flat-ui/dist/css/flat-ui.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<br>
				<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
						<span class="sr-only">Toggle navigation</span>
						</button>
						<a class="navbar-brand" href="/demo">Demo Website</a>
					</div>
					<div class="collapse navbar-collapse" id="navbar-collapse-01">
						<ul class="nav navbar-nav navbar-left">
							<li>
								<a href="add-post.php">Add Post</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="profile.php"><i><?=ucwords($user->name)?>'s</i> profile</a>
							</li>
							<li>
								<a href="logout.php">Logout</a>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>
			</div>

			<!-- Main Content -->
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form action="updatepost.php" method="POST" role="form">
						<input type="hidden" name="postId" value="<?=$post->id?>">

						<div class="row">
							<div class="form-group">
								<label for="inputTitle" class="col-xs-2 control-label">Title:</label>
								<div class="col-xs-10">
									<input
									type="text"
									name="title"
									class="form-control"
									id="inputTitle"
									value="<?=$post->title?>"
									required>
								</div>
							</div>
						</div>
	
						<br>

						<div class="row">
							<div class="form-group">
								<label for="inputDescription" class="col-xs-2 control-label">Description:</label>
								<div class="col-xs-10">
									<textarea
									class="form-control"
									name="description"
									id="inputDescription"
									cols="30"
									rows="10"
									required><?=$post->description?></textarea>
								</div>
							</div>
						</div>
						
						<br>

						<div class="row">
							<div class="form-group">
								<div class="col-xs-10 col-xs-offset-2">
									<button type="submit" class="btn btn-info btn-block">Edit Post</button>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				
			</div>
		</div>
		
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/flat-ui/dist/js/flat-ui.js"></script>
	</body>
</html>