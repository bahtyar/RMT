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


	$value = array('API'=>$API,'id'=>$id,'ruang'=>$ruang, 'nama_rs'=>$nama_rs, 'mrs'=>$mrs,'jam'=>$jam,'anamnesa'=>$anamnesa,'riwayat_penyakit'=>$riwayat_penyakit, 'riwayat_pekerjaan'=>$riwayat_pekerjaan,'riwayat_alergi'=>$riwayat_alergi,'keadaan_umum'=>$keadaan_umum,'kesadaran'=>$kesadaran,'E'=>$E,'V'=>$V, 'M'=>$M,'suhu'=>$suhu, 'nadi'=>$nadi,'respirasi'=>$respirasi,'TD'=>$TD,'pemeriksaan'=>$pemeriksaan,'penunjang'=>$penunjang, 'diagnosa_kerja'=>$diagnosa_kerja,'diagnosa_banding'=>$diagnosa_banding, 'pelayanan'=>$pelayanan, 'nama_dr'=>$nama_dr);

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

	<link rel="shortcut icon" href="../asset/img/logomi.png">
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

						<li class="ripple"><a class="tree-toggle nav-header"><span class="fa-home fa"></span> Dashboard <span class="fa-angle-right fa right-arrow text-right"></span> </a>
							<ul class="nav nav-list tree">
								<li><a href="../home.php">Pendaftaran</a></li>
								<li><a href="/RM/readAllRm.php">Rekam Medis</a></li>
								<li><a href="../Diagnosis/diagnosis.php">Daftar Diagnosis</a></li>
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

			<!--Start Content-->
			<div id="content">

				<div class="col-md-12 panel">
					<div class="col-md-12 panel-heading">
						<h4><?php echo "Nomor Rekam Medis Pasien : ".$obj->data->NIK; ?></h4>
					</div>
					<div class="col-md-12 panel-body" style="padding-bottom:30px;">
						<div class="col-md-12">
							<form class="cmxform" method="post">
								<!--menampilkan pesan eror/sukses-->
								<?php
								if(isset($_GET['registered']))
								{
									?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicons-ok"></i> &nbsp; Berhasil membuat RM 
									</div>
									<?php
								}
								?>

								<div class="col-md-6">

									<div class="form-group">
										<input type="hidden" name="API" value="<?php echo $API; ?>" />
									</div>

									<div >
										<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
									</div>											

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nama" value="<?php echo $obj->data->nama;?>" >
										<span class="bar"></span>
										<label>Nama Pasien</label>
									</div>												

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="jen_kelamin" value="<?php echo $obj->data->jen_kelamin;?>" >
										<span class="bar"></span>	
										<label>Jenis Kelamin</label>									
									</div> 

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                                     
										<input type="text" class="form-text" name="alamat" value="<?php echo $obj->data->alamat;?>" >
										<span class="bar"></span>
										<label>Alamat</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="ruang" required>
										<span class="bar"></span>
										<label>Ruang</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="nama_rs" value="<?php echo $obj->data->nama_rs;?>" >
										<span class="bar"></span>
										<label>Nama Fasilitas Kesehatan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="date" class="form-text" name="mrs" required>
										<span class="bar"></span>
										<label>MRS</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="time" class="form-text" name="jam" required>
										<span class="bar"></span>
										<label>Jam</label>
									</div>	

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nama_dr" required>
										<span class="bar"></span>
										<label>Nama Dokter</label>
									</div>							

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text " name="E" required>
										<span class="bar"></span>
										<label>GCS (Eye)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="V" required>
										<span class="bar"></span>
										<label>GCS (Verbal)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="M" required>
										<span class="bar"></span>
										<label>GCS (Motor)</label>
									</div>	

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="keadaan_umum" required>
										<span class="bar"></span>
										<label>Keadaan umum</label>
									</div>								

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="kesadaran" required>
										<span class="bar"></span>
										<label>Kesadaran</label>
									</div>										

								</div>

								<div class="col-md-6">										

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="anamnesa" required>
										<span class="bar"></span>
										<label>Anamnesa</label>
									</div>
									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_penyakit" required>
										<span class="bar"></span>
										<label>Riwayat Penyakit</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_pekerjaan" required>
										<span class="bar"></span>
										<label>Riwayat Pekerjaan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_alergi" required>
										<span class="bar"></span>
										<label>Riwayat Alergi</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="suhu" required >
										<span class="bar"></span>
										<label>Suhu (Celcius)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nadi" required >
										<span class="bar"></span>
										<label>Nadi (x/menit)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="respirasi" required>
										<span class="bar"></span>
										<label>Respirasi (x/menit)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" id="TD" name="TD" required >
										<span class="bar"></span>
										<label>Tekanan Darah (mmHg)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="pemeriksaan" required>
										<span class="bar"></span>
										<label>Pemeriksaan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="penunjang" required>
										<span class="bar"></span>
										<label>Penunjang</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="diagnosa_kerja" required>
										<span class="bar"></span>
										<label>Diagnosis Kerja</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="diagnosa_banding" required >
										<span class="bar"></span>
										<label>Diagnosis Banding</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="pelayanan" required>
										<span class="bar"></span>
										<label>Pelayanan</label>
									</div>												
								</div>
								<div class="col-md-12">                              
									<input class="submit btn btn-success" type="submit" value="Buat" name="btn-insert">
									<a href="readById.php?id=<?php echo $id; ?>" class="btn btn-danger">Kembali</a>
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

