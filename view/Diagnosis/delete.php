<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");
require_once("../../include/DB_diagnosis.php");


$auth_user = new DB_Functions();
$diag = new Diagnosis();

//membuat session
$user_id = $_SESSION['user_session'];

$id = $_GET['id'];
try{
	$result=$diag->delete($id);	
	$diag->redirect('diagnosis.php');
}
catch(PDOException $e){
	echo $e->getMessage();
}

?>