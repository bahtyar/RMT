<?php

require_once("../session.php");
require_once("../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];

if ($db->is_loggedin()!="") {

	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$id = $_GET['id'];        

	$url = $server."/wsrmt/Service/server.php?tag=PendaftaranById";	
	$json = file_get_contents($url."&id=".$id);
	$obj = json_decode($json);	

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>

	<title>welcome - <?php print($userRow['username']); ?></title>	

	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
	<link href="../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

</head>
<!-- end: Head -->

<body id="mimin" class="dashboard">

	<!-- start: Header -->
	<nav class="navbar navbar-default header navbar-fixed-top">
		<div class="col-md-12 nav-wrapper">
			<div class="navbar-header" style="width:100%;">
				<div class="opener-left-menu is-open">
					<span class="top"></span>
					<span class="middle"></span>
					<span class="bottom"></span>
				</div>
				<a href="home.php" class="navbar-brand"> 
					<b>RMT</b>
				</a>
				<ul class="nav navbar-nav navbar-right user-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu">                
								<li><a href="../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
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

						<li class="active ripple"><a href="home.php"><span class="fa-home fa"></span>Beranda</a></li>

						<li class="ripple"><a href="RM/readAllRm.php"><span class="fa fa-plus-square"></span>Rekam Medis</a></li>

						<li class="ripple"><a href="Diagnosis/diagnosis.php"><span class="fa fa-list-alt"></span> Daftar Diagnosis</a></li>

						<li class="ripple">
							<a class="tree-toggle nav-header"><span class="fa fa-pencil-square-o"></span> Form 
								<span class="fa-angle-right fa right-arrow text-right"></span>
							</a>
							<ul class="nav nav-list tree">
								<li><a href="insert.php">Tambah Pendaftaran</a></li>
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

							<div class="panel-heading"><h3>Pendaftaran Pasien</h3>
								<p class="animated fadeInDown">
									Home <span class="fa-angle-right fa"></span> Info
								</p>
							</div>

							<div class="panel-body">
								<center><u><b><span style="font-size:18px">Detail Pendaftaran Pasien</span></b></u></center> <br />

								<table style="font-size:14px" width="100%">
									<tbody>
										<tr valign="top" height="21px">
											<td width="25%">Nama</td>
											<td width="1%">:</td>
											<td><?php echo $obj->data->nama;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>NIK</td>
											<td>:</td>
											<td><?php echo $obj->data->NIK;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Jenis Kelamin</td>
											<td>:</td>
											<td><?php echo $obj->data->jen_kelamin;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Tempat Lahir</td>
											<td>:</td>
											<td><?php echo $obj->data->temp_lahir;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Tanggal Lahir</td>
											<td>:</td>
											<td><?php 
											$row['join_date'] = $obj->data->tgl_lahir;
											echo date("d-m-Y",strtotime($row['join_date']));?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Alamat</td>
											<td>:</td>
											<td><?php echo $obj->data->alamat; ?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Status</td>
											<td>:</td>
											<td><?php echo $obj->data->status;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Pekerjaan</td>
											<td>:</td>
											<td><?php echo $obj->data->pekerjaan;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td width="25%">Jabatan</td>
											<td width="1%">:</td>
											<td><?php echo $obj->data->jabatan;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Lama Kerja</td>
											<td>:</td>
											<td><?php echo $obj->data->lama_kerja;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Agama</td>
											<td>:</td>
											<td><?php echo $obj->data->agama;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Suku</td>
											<td>:</td>
											<td><?php echo $obj->data->suku;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Telpon</td>
											<td>:</td>
											<td><?php echo $obj->data->telp;?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Jenis Pasien</td>
											<td>:</td>
											<td><?php echo $obj->data->jenis_pasien; ?></td>
										</tr>
										<tr valign="top" height="21px">
											<td>Nama Fasilitas</td>
											<td>:</td>
											<td><?php echo $obj->data->nama_rs;?></td>
										</tr>										
									</tbody>
								</table> <br>
								<div class="col-md-12">                              
									<a href="update.php?id=<?php echo $obj->data->id_pendaftaran;?>" class="btn btn-success">Edit</a>
									<a href="home.php" class="btn btn-danger">Kembali</a>
									<a href="RM/readById.php?id=<?php echo $obj->data->id_pendaftaran;?>" class="btn btn-primary" >Lihat RM</a>
								</div>
							</div>
						</div>
					</div>  
				</div>
			</div>

			<!--Footer-->
			<!-- start: Javascript -->
			<script src="../asset/js/jquery.min.js"></script>
			<script src="../asset/js/jquery.ui.min.js"></script>
			<script src="../asset/js/bootstrap.min.js"></script>



			<!-- plugins -->
			<script src="../asset/js/plugins/moment.min.js"></script>
			<script src="../asset/js/plugins/jquery.datatables.min.js"></script>
			<script src="../asset/js/plugins/datatables.bootstrap.min.js"></script>
			<script src="../asset/js/plugins/jquery.nicescroll.js"></script>


			<!-- custom -->
			<script src="../asset/js/main.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#datatables-example').DataTable();
				});
			</script>
			<!-- end: Javascript -->			

		</body>
		</html>



