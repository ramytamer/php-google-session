<?php
require_once 'init.php';

$_SESSION['errors'] = [];


if(
	isset(	$_POST['fullName'],
			$_POST['email'],
			$_POST['password'],
			$_POST['passwordConfirmation']
		) 						&&
	!empty($_POST['fullName'])	&&
	!empty($_POST['email'])		&&
	!empty($_POST['password'])	&&
	!empty($_POST['passwordConfirmation'])
){
	$fullName 				= trim($_POST['fullName']);
	$email					= trim($_POST['email']);
	$password 				= trim($_POST['password']);
	$passwordConfirmation	= trim($_POST['passwordConfirmation']);

	$_SESSION['errors'] = $app->validateUserInputs($fullName,$email,$password,$passwordConfirmation);

	if(count($_SESSION['errors'])) redirect('signup.php');

	if($userId = $app->createUser($fullName,$email,$password)){
		$_SESSION['user'] = $userId;
	}

	redirect('index.php');

}else{
	array_push($_SESSION['errors'], 'Not Valid Inputs');
	redirect('signup.php');
}


?>