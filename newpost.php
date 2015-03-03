<?php

require 'init.php';

if(!$app->isLoggedin()) redirect();

$user = $app->getUserById($_SESSION['user']);


if (
	!isset($_POST['title'])			||
	!isset($_POST['description'])	||
	empty($_POST['title'])			||
	empty($_POST['description'])
	)

	redirect('add-post.php');

$title			= trim($_POST['title']);
$description	= trim($_POST['description']);


if($postId = $app->createPost($title,$description,$_SESSION['user'])) redirect("post.php?p={$postId}");

redirect('add-post.php');


?>