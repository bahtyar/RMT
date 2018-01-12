<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];

if ($db->is_loggedin()!="") {

	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$rm = $_GET['id'];        

	$url = $server."/wsrmt/Service/server.php?tag=RmByNum";	
	$json = file_get_contents($url."&rm=".$rm);
	$obj = json_decode($json);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

	<title>rekam medis <?php print($obj->data->nama); ?></title>	

	<link rel="stylesheet" type="text/css" href="../../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/animate.min.css"/>
	<link href="../../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

</head>
<!-- end: Head -->

<body id="updateRM" class="dashboard">

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
						<li class="ripple"><a href="../home.php"><span class="fa-home fa"></span>Beranda</a></li>
						<li class="active ripple"><a href="readAllRm.php"><span class="fa fa-plus-square"></span>Rekam Medis</a></li>
						<li class="ripple"><a href="../Diagnosis/diagnosis.php"><span class="fa fa-list-alt"></span> Daftar Diagnosis</a></li>
						<li class="ripple">
							<a class="tree-toggle nav-header"><span class="fa fa-pencil-square-o"></span> Form 
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
							<div class="panel-heading"><h3>Detail Rekam Medis</h3>
								<p class="animated fadeInDown">
									Rekam Medis <span class="fa-angle-right fa"></span> Info
								</p>
							</div>
							<div class="panel-body">
								<center><b><span style="font-size:18px">Rekam Medis <?php echo $obj->data->nama; ?></span></b></center><br>
								<div class="col-md-6">
									<table style="font-size:14px" width="100%">									
										<tbody>
											<tr valign="top" height="21px">
												<td width="25%">Nama Pasien</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->nama;?></td>
											</tr>										
											<tr valign="top" height="21px">
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><?php echo $obj->data->jen_kelamin;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Umur</td>
												<td>:</td>
												<td><?php echo $obj->data->umur;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Alamat</td>
												<td>:</td>
												<td><?php echo $obj->data->alamat;?></td>
											</tr>										
											<tr valign="top" height="21px">
												<td>Nama Dokter</td>
												<td>:</td>
												<td><?php echo $obj->data->nama_dr;?></td>
											</tr>
										</tbody>
									</table> 
								</div>
								<div class="col-md-6">
									<table style="font-size:14px" width="100%">
										<tbody>
											<tr valign="top" height="21px">
												<td width="25%">No. RM.</td>
												<td width="1%">:</td>
												<td><b><?php echo $obj->data->no_RM;?></b></td>
											</tr>
											<tr valign="top" height="21px">
												<td>MRS</td>
												<td>:</td>
												<td><?php 
												$row['join_date'] = $obj->data->mrs;
												echo date("d-m-Y",strtotime($row['join_date']));?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Jam</td>
												<td>:</td>
												<td><?php 											
												echo date("h:i A", strtotime($obj->data->jam));?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Nama Fasilitas</td>
												<td>:</td>
												<td><?php echo $obj->data->nama_rs; ?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Ruang</td>
												<td>:</td>
												<td><?php echo $obj->data->ruang;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Poli</td>
												<td>:</td>
												<td><?php echo $obj->data->poli;?></td>
											</tr>
										</tbody>
									</table>
								</div><br />

								<div class="col-md-12">
									<table class="table table-condensed">
										<thead>	
											<br /><center><b><span style="font-size:16px">Anamnesa</span></b></center><br />
										</thead>
										<tbody>
											<tr valign="top" height="21px">
												<td width="20%">Keluhan</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->anamnesa;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Riwayat Penyakit</td>
												<td>:</td>
												<td><?php echo $obj->data->riwayat_penyakit;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Riwayat Pekerjaan</td>
												<td>:</td>
												<td ><?php echo $obj->data->riwayat_pekerjaan;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Riwayat Alergi</td>
												<td>:</td>
												<td ><?php echo $obj->data->riwayat_alergi;?></td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-md-12">
									<table class="table table-condensed">
										<thead>	
											<center><b><span style="font-size:16px">Hasil Pemeriksaan Umum/Fisik</span></b></center><br />
										</thead>
										<tbody>
											<tr valign="top" height="21px">
												<td width="20%">Keadaan Umum</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->keadaan_umum;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Kesadaran</td>
												<td>:</td>
												<td><?php echo $obj->data->kesadaran;?></td>
											</tr>											
										</tbody>
									</table>
								</div>

								<div class="col-md-6">
									<table class="table table-condensed">
										<thead>	
											<tr><th width="1%">GCS</th>
											</tr>
										</thead>
										<tbody>
											<tr valign="top" height="21px">
												<td width="25%">Eye</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->E; ?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Verbal</td>
												<td>:</td>
												<td><?php echo $obj->data->V; ?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Motor</td>
												<td>:</td>
												<td ><?php echo $obj->data->M; ?></td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-md-6">
									<table class="table table-condensed">
										<thead>	
											<tr><th width="1%">TTV</th>
											</tr>
										</thead>
										<tbody>
											<tr valign="top" height="21px">
												<td width="25%">Suhu</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->suhu; ?>&#176; Celcius</td>
											</tr>
											<tr valign="top" height="21px">
												<td>Respirasi</td>
												<td>:</td>
												<td><?php echo $obj->data->respirasi; ?> &#215;/menit</td>
											</tr>
											<tr valign="top" height="21px">
												<td>Nadi</td>
												<td>:</td>
												<td ><?php echo $obj->data->nadi; ?> &#215;/menit</td>
											</tr>
											<tr valign="top" height="21px">
												<td>Tekanan Darah</td>
												<td>:</td>
												<td ><?php echo $obj->data->nadi; ?> mmHg</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="col-md-12">
									<table class="table table-condensed">
										<tbody>
											<tr valign="top" height="21px">
												<td width="20%">Pemeriksaan</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->pemeriksaan;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Penunjang</td>
												<td>:</td>
												<td><?php echo $obj->data->penunjang;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td width="20%">Diagnosis Kerja</td>
												<td width="1%">:</td>
												<td><?php echo $obj->data->diagnosa_kerja;?></td>
											</tr>
											<tr valign="top" height="21px">
												<td>Diagnosis Banding</td>
												<td>:</td>
												<td><?php echo $obj->data->diagnosa_banding;?></td>
											</tr>	
											<tr valign="top" height="21px">
												<td>Pelayanan</td>
												<td>:</td>
												<td><?php echo $obj->data->pelayanan;?></td>
											</tr>										
										</tbody>
									</table>
								</div>
								<div class="col-md-12">                              
									<a href="update.php?id=<?php echo $obj->data->id_rm;?>" class="btn btn-success">Edit</a>
									<!-- <button class="btn btn-danger" onclick="goBack(-1)">Kembali</button> -->
									<!-- <a href="readAllRm.php" class="btn btn-danger">Kembali</a>	 -->
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
				<script>
					function goBack() {
						history.back();
					}
				</script>
				<script src="../../asset/js/main.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#datatables-example').DataTable();
					});
				</script>
				<!-- end: Javascript -->			

			</body>
			</html>

