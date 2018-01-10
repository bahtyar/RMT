<?php
	require_once('session.php');
	require_once('include/DB_Functions.php');
	$user_logout = new DB_Functions();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('view/home.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->logout();
		$user_logout->redirect('index.php');
	}
