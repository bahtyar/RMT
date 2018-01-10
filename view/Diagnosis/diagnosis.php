<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");
require_once("../../include/DB_diagnosis.php");


$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];

if (!$db->is_loggedin()=="") {

	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$url = $server."/wsrmt/Service/server.php?tag=allDiag";	
	$json = file_get_contents($url);
	$obj = json_decode($json);	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

	<title>Daftar Diagnosis</title>	

	<link rel="stylesheet" type="text/css" href="../../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/animate.min.css"/>
	<link href="../../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

	<link rel="shortcut icon" href="../asset/img/logomi.png">
</head>
<!-- end: Head -->


<body id="allDiagnosis" class="dashboard">

	<!-- start: Header -->
	<nav class="navbar navbar-default header navbar-fixed-top">
		<div class="col-md-12 nav-wrapper">
			<div class="navbar-header" style="width:100%;">
				<div class="opener-left-menu is-open">
					<span class="top"></span>
					<span class="middle"></span>
					<span class="bottom"></span>
				</div>
				<a href="../home.php" class="navbar-brand"> 
					<b>RMT</b>
				</a>
				<ul class="nav navbar-nav navbar-right user-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu">                
								<li><a href="../../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!--start left menu-->
		<div class="container-fluid mimin-wrapper">

			<div id="left-menu">
				<div class="sub-left-menu scroll">
					<ul class="nav nav-list">
						<li><div class="left-bg"></div></li>
						<li class="time">
							<h1 class="animated fadeInLeft">21:00</h1>
							<p class="animated fadeInRight">Sat,October 1st 2029</p>
						</li>

						<li class="ripple"><a class="tree-toggle nav-header"><span class="fa-home fa"></span> Dashboard <span class="fa-angle-right fa right-arrow text-right"></span> </a>
							<ul class="nav nav-list tree">
								<li><a href="../home.php">Pendaftaran</a></li>
								<li><a href="../RM/readAllRm.php">Rekam Medis</a></li>
								<li><a href="diagnosis.php">Daftar Diagnosis</a></li>
							</ul>
						</li>

						<li class="active ripple">
							<a class="tree-toggle nav-header"><span class="fa fa-table"></span> Form 
								<span class="fa-angle-right fa right-arrow text-right"></span>
							</a>
							<ul class="nav nav-list tree">
								<li><a href="../insert.php">Tambah Pendaftaran</a></li>
							</ul>
						</li> 
					</ul>
				</div>
			</div>
			<!-- end: Left Menu -->
			<div class="clearfix"></div>

			<div id="content">
				<div class="col-md-12 top-20 padding-0">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><h3>Daftar Code Diagnosis</h3></div>
							<div class="panel-body">
								<div class="responsive-table">
									<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
										<thead>
											<tr>
												<td>Kategori</td>
												<td>Sub Kategori</td>
												<td>English Name</td>
												<td>Indo Name</td>
												<tbody>
													<?php if (count($obj->data)) {
														foreach($obj->data as $idx => $data) {?>

														<tr>
															<td><?php echo $data->category;?></td>
															<td><?php echo $data->subcategory;?></td>
															<td><?php echo $data->eng_name;?></td>
															<td><?php echo $data->ind_name;?></td>
													<!-- <td>
														<a href="#?id=<?php echo $row['id_diag'];?>">Details</a> | <a href="delete.php?id=<?php echo $row['id_diag'];?>" onclick="return confirm('Anda yakin menghapus <?php echo $row['id_diag'];?>?');">Delete</a>
													</td> -->
												</tr>

												<?php } 
											}?>
										</tbody>

									</table>
								</div>
							</div>
						</div>
					</div>  
				</div> 


				<!--Footer-->
				<!-- start: Javascript -->
				<script src="../../asset/js/jquery.min.js"></script>
				<script src="../../asset/js/jquery.ui.min.js"></script>
				<script src="../../asset/js/bootstrap.min.js"></script>



				<!-- plugins -->
				<script src="../../asset/js/plugins/moment.min.js"></script>
				<script src="../../asset/js/plugins/jquery.datatables.min.js"></script>
				<script src="../../asset/js/plugins/datatables.bootstrap.min.js"></script>
				<script src="../../asset/js/plugins/jquery.nicescroll.js"></script>


				<!-- custom -->
				<script src="../../asset/js/main.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#datatables-example').DataTable();
					});
				</script>
				<!-- end: Javascript -->			

			</body>
			</html>

