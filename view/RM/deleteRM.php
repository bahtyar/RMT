<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];
//membuat session
$user_id = $_SESSION['user_session'];

$id_rm = $_GET['id'];
try{

	$url = $server."/wsrmt/Service/server.php?tag=deleteRM";
	// merubah spasi menjadi karakter
	// $num = str_replace(" ", "%20", $num);
	$json = file_get_contents($url."&id=".$id_rm);	
	$db->redirect('readAllRm.php');
}
catch(PDOException $e){
	echo $e->getMessage();
}

?>