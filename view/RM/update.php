<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");

//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];
$rm_num = $server."/wsrmt/Service/server.php?tag=RmByNum";
$url	= $server."/wsrmt/Service/server.php?tag=updateRM";
$API	= 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';

if (!$db->is_loggedin()=="") {
	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$id_rm = $_GET['id'];
	// merubah spasi menjadi karakter
	// $rm = str_replace(" ", "%20", $rm);

	$json = file_get_contents($rm_num."&rm=".$id_rm);	
	$obj = json_decode($json);		
}

if (isset($_POST['btn-update'])) {
	$id 				= $_POST['id'];
	$id_rm				= $_POST['id_rm'];
	$no_RM				= $_POST['no_RM'];
	$nama 				= $_POST['nama'];
	$jen_kelamin 		= $_POST['jen_kelamin'];
	$alamat 			= $_POST['alamat'];
	$ruang 				= $_POST['ruang'];				
	$nama_rs 			= $_POST['nama_rs'];
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
	$API  				= $_POST['API'];


	$value = array('API'=>$API,'id'=>$id, 'id_rm'=>$id_rm,'nama'=>$nama, 'jen_kelamin'=>$jen_kelamin,'alamat'=>$alamat, 'ruang'=>$ruang,'nama_rs'=>$nama_rs,'mrs'=>$mrs,'jam'=>$jam,'anamnesa'=>$anamnesa,'riwayat_penyakit'=>$riwayat_penyakit, 'riwayat_pekerjaan'=>$riwayat_pekerjaan,'riwayat_alergi'=>$riwayat_alergi,'keadaan_umum'=>$keadaan_umum,'kesadaran'=>$kesadaran,'E'=>$E,'V'=>$V, 'M'=>$M,'suhu'=>$suhu, 'nadi'=>$nadi,'respirasi'=>$respirasi,'TD'=>$TD,'pemeriksan'=>$pemeriksan,'penunjang'=>$penunjang, 'diagnosa_kerja'=>$diagnosa_kerja,'diagnosa_banding'=>$diagnosa_banding, 'pelayanan'=>$pelayanan, 'nama_dr'=>$nama_dr);

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $value);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );	
	
	if($response!=NULL)
	{
		$db->redirect('readAllRm.php');     
	} else {
		$error = "terjadi kesalahan pada updaate!";
	}
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

	<title>rekam medis <?php print($rm['nama']); ?></title>	

	<link rel="stylesheet" type="text/css" href="../../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../asset/css/plugins/animate.min.css"/>
	<link href="../../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

	<link rel="shortcut icon" href="../../asset/img/logomi.png">
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

						<li class="active ripple"><a class="tree-toggle nav-header"><span class="fa-home fa"></span> Dashboard <span class="fa-angle-right fa right-arrow text-right"></span> </a>
							<ul class="nav nav-list tree">
								<li><a href="../home.php">Pendaftaran</a></li>
								<li><a href="readAllRm.php">Rekam Medis</a></li>
								<li><a href="../Diagnosis/diagnosis.php">Daftar Diagnosis</a></li>
							</ul>
						</li>

						<li class="ripple">
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

				<div class="col-md-12 panel">
					<div class="col-md-12 panel-heading">
						<h4>Update Rekam Medis</h4>
					</div>
					<div class="col-md-12 panel-body" style="padding-bottom:30px;">
						<div class="col-md-12">
							<form class="cmxform" method="post">
								<div class="form-group form-animate-text" style="margin-top:40px !important;">
									<input type="text" class="form-text" name="no_RM" value="<?php echo $obj->data->no_RM; ?>" readonly>
									<span class="bar"></span>
								</div>							

								<div class="col-md-6">
									<div >
										<input type="hidden" name="id_rm" value="<?php echo $obj->data->id_rm;?>"> 
									</div>

									<div >
										<input type="hidden" name="id" value="<?php echo $obj->data->id_pendaftaran;?>"> 
									</div>

									<div >
										<input type="hidden" name="no_RM" value="<?php echo $obj->data->no_RM; ?>"> 
									</div>

									<div class="form-group">
										<input type="hidden" name="API" value="<?php echo $API; ?>" />
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nama" value="<?php echo $obj->data->nama;?>" >
										<span class="bar"></span>
										<label>Nama Pasien</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text text-right" class="form-text" name="NIK" value="NIK : <?php echo $obj->data->NIK; ?>" readonly>
										<span class="bar"></span>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="jen_kelamin" value="<?php echo $obj->data->jen_kelamin;?>" >
										<span class="bar"></span>	
										<label>Jenis Kelamin</label>										
									</div> 

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="umur" value="<?php echo $obj->data->umur;?>" >
										<span class="bar"></span>
										<label>Umur</label>
									</div> 

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                                     
										<input type="text" class="form-text" name="alamat" value="<?php echo $obj->data->alamat;?>" >
										<span class="bar"></span>
										<label>Alamat</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="ruang" value="<?php echo $obj->data->ruang;?>" >
										<span class="bar"></span>
										<label>Ruang</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="nama_rs" value="<?php echo $obj->data->nama_rs;?>" >
										<span class="bar"></span>
										<label>Nama Fasilitas Kesehatan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="date" class="form-text" name="mrs" value="<?php echo $obj->data->mrs;?>" >
										<span class="bar"></span>
										<label>MRS</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="time" class="form-text" name="jam" value="<?php echo $obj->data->jam;?>" >
										<span class="bar"></span>
										<label>Jam</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nama_dr" value="<?php echo $obj->data->nama_dr;?>" >
										<span class="bar"></span>
										<label>Nama Dokter</label>
									</div>						

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text " name="E" value="<?php echo $obj->data->E;?>">
										<span class="bar"></span>
										<label>GCS (Eye)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="V" value="<?php echo $obj->data->V;?>">
										<span class="bar"></span>
										<label>GCS (Verbal)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="M" value="<?php echo $obj->data->M;?>">
										<span class="bar"></span>
										<label>GCS (Motor)</label>
									</div>									

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="suhu" value="<?php echo $obj->data->suhu;?>" >
										<span class="bar"></span>
										<label>Suhu (Celcius)</label>
									</div>

								</div>

								<div class="col-md-6">										

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="anamnesa" value="<?php echo $obj->data->anamnesa;?>">
										<span class="bar"></span>
										<label>Anamnesa</label>
									</div>
									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_penyakit" value="<?php echo $obj->data->riwayat_penyakit;?>">
										<span class="bar"></span>
										<label>Riwayat Penyakit</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_pekerjaan" value="<?php echo $obj->data->riwayat_pekerjaan;?>" >
										<span class="bar"></span>
										<label>Riwayat Pekerjaan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="riwayat_alergi" value="<?php echo $obj->data->riwayat_alergi;?>" >
										<span class="bar"></span>
										<label>Riwayat Alergi</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="keadaan_umum" value="<?php echo $obj->data->keadaan_umum;?>">
										<span class="bar"></span>
										<label>Keadaan umum</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="kesadaran" value="<?php echo $obj->data->kesadaran;?>">
										<span class="bar"></span>
										<label>Kesadaran</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nadi" value="<?php echo $obj->data->nadi;?>" >
										<span class="bar"></span>
										<label>Nadi (x/menit)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="respirasi" value="<?php echo $obj->data->respirasi;?>" >
										<span class="bar"></span>
										<label>Respirasi (x/menit)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="TD" value="<?php echo $obj->data->TD;?>" >
										<span class="bar"></span>
										<label>Tekanan Darah (mmHg)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="pemeriksaan" value="<?php echo $obj->data->pemeriksaan;?>" >
										<span class="bar"></span>
										<label>Pemeriksaan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="penunjang" value="<?php echo $obj->data->penunjang;?>" >
										<span class="bar"></span>
										<label>Penunjang</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="diagnosa_kerja" value="<?php echo $obj->data->diagnosa_kerja;?>" >
										<span class="bar"></span>
										<label>Diagnosis Kerja</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="diagnosa_banding" value="<?php echo $obj->data->diagnosa_banding;?>" >
										<span class="bar"></span>
										<label>Diagnosis Banding</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="pelayanan" value="<?php echo $obj->data->pelayanan;?>" >
										<span class="bar"></span>
										<label>Pelayanan</label>
									</div>							
								</div>
								<div class="col-md-12">                              
									<input class="submit btn btn-success" type="submit" value="Update" name="btn-update">
									<a href="readById.php?id=<?php echo $obj->data->id_pendaftaran; ?>" class="btn btn-danger">Kembali</a>                              
								</div>
							</form>
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

