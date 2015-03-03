<?php

require 'init.php';

if (
	!isset($_POST['title'])			||
	!isset($_POST['description'])	||
	!isset($_POST['postId'])		||
	empty($_POST['title'])			||
	empty($_POST['description'])	||
	empty($_POST['postId'])
	)

	redirect();


$post = $app->getPostById((int)$_POST['postId']);

if(!$post) redirect();

if($post->user_id !== $_SESSION['user']) redirect("post.php?p={$post->id}");


$title			= trim($_POST['title']);
$description	= trim($_POST['description']);


$app->updatePostById($post->id,$title,$description);

redirect("post.php?p={$post->id}");


?>