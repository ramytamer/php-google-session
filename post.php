<?php
require_once 'init.php';

if(!$app->isLoggedin()) redirect('signin.php');

$user = $app->getUserById($_SESSION['user']);

$users = $app->getAllUsers($_SESSION['user']);

$post = $app->getPostById((int)$_GET['p']);

if(!$post) redirect();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$post->title?></title>
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
				<div class="col-xs-12 col-md-8">
					<h5 class="text-primary">
						<?=$post->title?>
						<?php if($post->user_id === $user->id): ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="edit-post.php?p=<?=$post->id?>">
								<button
								style="//float:right"
								class="btn btn-info btn-xs"
								title="Edit Post">
									<span class="fui-new"></span>
								</button>
							</a>
							<a href="deletepost.php?p=<?=$post->id?>">
								<button
								style="//float:right"
								class="btn btn-danger btn-xs"
								title="Delete Post">
									<span class="fui-cross"></span>
								</button>
							</a>
						<?php endif; ?>
					</h5>

					<small>By: <a href="profile.php?user=<?=$post->user_id?>"><?=$post->owner?></a></small>

					<hr>
					<p><?=nl2br($post->description)?></p>
						

				</div>
				
				<div class="visible-xs-block visible-sm-block">
					<div class="col-xs-12">
						<hr>
					</div>
				</div>

				<!-- Right Side bar -->
				<div class="col-xs-12 col-md-4">
					<div class="todo">
						<h4 class="text-center">All Users</h4>
						<ul>
							<?php foreach($users as $u): ?>
								<li>
									<div class="todo-icon fui-user"></div>
									<div class="todo-content">
										<a href="profile.php?user=<?=$u->id?>">
											<h4 class="todo-name">
												<?=$u->name?>
											</h4>
										</a>
									</div>
								</li>
							<?php endforeach; ?>		          
						</ul>
			         </div>
				</div>

			</div>
		</div>
		
		<script src="bower_components/jquery/dist/jquery.js"></script>
		<script src="bower_components/flat-ui/dist/js/flat-ui.js"></script>
	</body>
</html>