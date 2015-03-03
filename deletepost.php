<?php

require 'init.php';

$post = $app->getPostById((int)$_GET['p']);

if(!$post) redirect();

if($post->user_id !== $_SESSION['user']) redirect("post.php?p={$post->id}");

if($app->deletePostById($post->id)) redirect();

redirect("post.php?p={$post->id}");


?>