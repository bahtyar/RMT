<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");

//instansiasi class objek
$db = new DB_Functions();



$server = "http://".$_SERVER['HTTP_HOST'];
$url	= $server."/wsrmt/Service/server.php?tag=insertRM";
$daftar = $server."/wsrmt/Service/server.php?tag=PendaftaranById";
$API	= 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';

if (!$db->is_loggedin()=="") {
	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$id = $_GET['id'];

	$json = file_get_contents($daftar."&id=".$id);	
	$obj = json_decode($json);
}

if (isset($_POST['btn-insert'])) {
	$API  				= $_POST['API'];
	$id 				= $_POST['id'];			
	$ruang 				= $_POST['ruang'];
	$nama_rs			= $_POST['nama_rs'];
	$mrs 				= $_POST['mrs'];
	$jam				= $_POST['jam'];
	$anamnesa 			= $_POST['anamnesa'];
	$riwayat_penyakit	= $_POST['riwayat_penyakit'];
	$riwayat_pekerjaan	= $_POST['riwayat_pekerjaan'];
	$riwayat_alergi		= $_POST['riwayat_alergi'];
	$keadaan_umum 		= $_POST['keadaan_umum'];
	$kesadaran			= $_POST['kesadaran'];
	$E 					= $_POST['E'];
	$V 					= $_POST['V'];
	$M 					= $_POST['M'];	
	$suhu 				= $_POST['suhu'];
	$nadi				= $_POST['nadi'];
	$respirasi			= $_POST['respirasi'];
	$TD					= $_POST['TD'];
	$pemeriksaan 		= $_POST['pemeriksaan'];
	$penunjang 			= $_POST['penunjang'];
	$diagnosa_kerja 	= $_POST['diagnosa_kerja'];
	$diagnosa_banding 	= $_POST['diagnosa_banding'];
	$pelayanan 			= $_POST['pelayanan'];
	$nama_dr 			= $_POST['nama_dr'];
	$poli 				= $_POST['poli'];


	$value = array('API'=>$API,'id'=>$id,'ruang'=>$ruang, 'nama_rs'=>$nama_rs, 'mrs'=>$mrs,'jam'=>$jam,'anamnesa'=>$anamnesa,'riwayat_penyakit'=>$riwayat_penyakit, 'riwayat_pekerjaan'=>$riwayat_pekerjaan,'riwayat_alergi'=>$riwayat_alergi,'keadaan_umum'=>$keadaan_umum,'kesadaran'=>$kesadaran,'E'=>$E,'V'=>$V, 'M'=>$M,'suhu'=>$suhu, 'nadi'=>$nadi,'respirasi'=>$respirasi,'TD'=>$TD,'pemeriksaan'=>$pemeriksaan,'penunjang'=>$penunjang, 'diagnosa_kerja'=>$diagnosa_kerja,'diagnosa_banding'=>$diagnosa_banding, 'pelayanan'=>$pelayanan, 'nama_dr'=>$nama_dr, 'poli'=>$poli);

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $value);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );

	if($response!=NULL)
	{
		$db->redirect('readById.php?id='.$id);     
	} else {
		$error = "terjadi kesalahan pada tambah RM!";
	}
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

	<title>Buat RM pasien : <?php echo $obj->data->nama;?></title>	

	<link rel="stylesheet" type="text/css" href="../../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/animate.min.css"/>
	<link href="../../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

</head>
<!-- end: Head -->

<body id="insertRM" class="dashboard">

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

			<!--Start Content-->
			<div id="content">

				<div class="col-md-12 top-20 padding-0">
					<div class="col-md-12">	
						<div class="panel">					
							<div class="panel-heading"><h3>Detail Rekam Medis</h3>
								<p class="animated fadeInDown">
									Rekam Medis <span class="fa-angle-right fa"></span> Info <span class="fa-angle-right fa"></span> Tambah RM
								</p>
							</div>

							<form class="cmxform" method="post">
								<div class="panel-body">
									<center><b><span style="font-size:18px">Rekam Medis <?php echo $obj->data->nama; ?></span></b></center><br>
									<div class="col-md-6">
										<div class="form-group">
											<input type="hidden" name="API" value="<?php echo $API; ?>" />
										</div>
										<div class="form-group">
											<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
										</div>
										<table style="font-size:14px" width="100%">									
											<tbody>
												<tr valign="top" height="21px">
													<td width="25%">Nama Pasien</td>
													<td width="1%">:</td>
													<td><div class="form-group"><input type="text" name="nama" class="form-control border-bottom" value="<?php echo $obj->data->nama; ?>" readonly></div></td>
												</tr>	
												<tr valign="top" height="21px">
													<td>Jenis Kelamin</td>
													<td>:</td>
													<td><div class="form-group"><input type="text" name="jen_kelamin" class="form-control border-bottom" value="<?php echo $obj->data->jen_kelamin; ?>" readonly></div></td>
												</tr>	
												<tr valign="top" height="21px">
													<td >Umur</td>
													<td >:</td>
													<td ><div class="form-group"><input type="text" name="umur" class="form-control border-bottom" value="<?php $today 	= date("Y-m-d");
													$diff 		= date_diff(date_create($obj->data->tgl_lahir), date_create($today));
													echo $umur 	= $diff->format('%y');?>" readonly></div></td>
												</tr>	
												<tr valign="top" height="21px">
													<td >Alamat</td>
													<td >:</td>
													<td><div class="form-group"><input type="text" name="alamat" class="form-control border-bottom" value="<?php echo $obj->data->alamat;?>" readonly></div></td>
												</tr>	
												<tr valign="top" height="21px">
													<td>Nama Dokter</td>
													<td>:</td>														
													<td><div class="form-group"><input type="text" name="nama_dr" class="form-control border-bottom" required></div></td>
												</tr>
											</tbody>
										</table> 
									</div>
									<div class="col-md-6">
										<table style="font-size:14px" width="100%">
											<tbody>
												
												<tr valign="top" height="21px">
													<td width="25%">Nomor RM.</td>
													<td width="1%">:</td>
													<td><div class="form-group"><b>
														<input type="text" name="no_RM" class="form-control border-bottom" value="<?php echo $obj->data->NIK;?>" readonly></b></div>
													</td>
												</tr>
												<tr valign="top" height="21px">
													<td>MRS</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="date" name="mrs" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Jam</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="time" name="jam" class="form-control border-bottom" required>
													</div></td>
												</tr>												
												<tr valign="top" height="21px">
													<td>Nama Fasilitas</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="nama_rs" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Ruang</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="ruang" class="form-control border-bottom" required></div>
													</td>
												</tr>													
												<tr valign="top" height="21px">
													<td>Poli</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="poli" class="form-control border-bottom" required></div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="panel-body">
									<div class="col-md-12">
										<table class="table table-condensed">
											<thead>	
												<br /><center><b><span style="font-size:16px">Anamnesa</span></b></center><br />
											</thead>
											<tbody>
												<tr valign="top" height="20px">
													<td width="20%">Keluhan</td>
													<td width="1%">:</td>
													<td><div class="form-group">
														<input type="text" name="anamnesa" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr>
													<td>Riwayat Penyakit</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="riwayat_penyakit" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr >
													<td>Riwayat Pekerjaan</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="riwayat_pekerjaan" class="form-control border-bottom" value="<?php echo $obj->data->pekerjaan;?>" required>
													</div></td>
												</tr>
												<tr>
													<td>Riwayat Alergi</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="riwayat_alergi" class="form-control border-bottom" required>
													</div></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="panel-body">
									<div class="col-md-12">
										<table class="table table-condensed">
											<thead>	
												<center><b><span style="font-size:16px">Hasil Pemeriksaan Umum/Fisik</span></b></center><br />
											</thead>
											<tbody>
												<tr valign="top" height="21px">
													<td width="20%">Keadaan Umum</td>
													<td width="1%">:</td>
													<td><div class="form-group">
														<input type="text" name="keadaan_umum" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Kesadaran</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="kesadaran" class="form-control border-bottom" required>
													</div></td>
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
													<td><div class="form-group">
														<input type="text" name="E" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Verbal</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="V" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Motor</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="M" class="form-control border-bottom" required>
													</div></td>
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
													<td><div class="form-group">
														<input type="text" name="suhu" class="form-control border-bottom" required>
													</div></td>
													<td> &#176; C</td>
												</tr>
												<tr valign="top" height="21px">
													<td>Respirasi</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="respirasi" class="form-control border-bottom" required>
													</div></td>
													<td> &#215;/menit</td>
												</tr>
												<tr valign="top" height="21px">
													<td>Nadi</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="nadi" class="form-control border-bottom" required>
													</div></td>
													<td > &#215;/menit</td>
												</tr>
												<tr valign="top" height="21px">
													<td>Tekanan Darah</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="TD" class="form-control border-bottom" required>
													</div></td>
													<td > mmHg</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<div class="panel-body">
									<div class="col-md-12">
										<table class="table table-condensed">
											<tbody>
												<tr valign="top" height="21px">
													<td width="20%">Pemeriksaan</td>
													<td width="1%">:</td>
													<td><div class="form-group">
														<input type="text" name="pemeriksaan" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Penunjang</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="penunjang" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td width="20%">Diagnosis Kerja</td>
													<td width="1%">:</td>
													<td><div class="form-group">
														<input type="text" name="diagnosa_kerja" class="form-control border-bottom" required>
													</div></td>
												</tr>
												<tr valign="top" height="21px">
													<td>Diagnosis Banding</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="diagnosa_banding" class="form-control border-bottom" required>
													</div></td>
												</tr>	
												<tr valign="top" height="21px">
													<td>Pelayanan</td>
													<td>:</td>
													<td><div class="form-group">
														<input type="text" name="pelayanan" class="form-control border-bottom" required>
													</div></td>
												</tr>										
											</tbody>
										</table>
									</div>


									<div class="col-md-12">                              
										<input class="submit btn btn-success" type="submit" value="Buat" name="btn-insert">
										<a href="readById.php?id=<?php echo $id; ?>" class="btn btn-danger">Kembali</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!--End Content-->
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

