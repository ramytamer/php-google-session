<?php
require_once 'init.php';

$_SESSION['errors'] = [];


if(
	isset(	$_POST['email'],
			$_POST['password']
		) 						&&
	!empty($_POST['email'])		&&
	!empty($_POST['password'])
){
	$email					= trim($_POST['email']);
	$password 				= trim($_POST['password']);


	if($user = $app->login($email,$password)){
		$_SESSION['user'] = $user->id;
	}else{
		array_push($_SESSION['errors'], 'Incorrect email or password.');
	}

	redirect('signin.php');

}else{
	array_push($_SESSION['errors'], 'Not Valid Inputs');
	redirect('signin.php');
}


?>