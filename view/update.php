<?php

require_once("../session.php");
require_once("../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];
$url = $server."/wsrmt/Service/server.php?tag=updatePendaftaran";
$API = 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';
$id_daftar =  $server."/wsrmt/Service/server.php?tag=PendaftaranById";

if (!$db->is_loggedin()=="") {
	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

	$id = $_GET['id'];

	$json = file_get_contents($id_daftar."&id=".$id);	
	$obj = json_decode($json);	
}

if (isset($_POST['btn-update'])) {
	$API   			= $_POST['API'];
	$id 			= $_POST['id'];				
	$nama 			= $_POST['nama'];
	$NIK 			= $_POST['NIK'];
	$jen_kelamin 	= $_POST['jen_kelamin'];
	$temp_lahir 	= $_POST['temp_lahir'];
	$tgl_lahir 		= $_POST['tgl_lahir'];
	$alamat 		= $_POST['alamat'];
	$status 		= $_POST['status'];
	$pekerjaan		= $_POST['pekerjaan'];
	$jabatan 		= $_POST['jabatan'];
	$lama_kerja 	= $_POST['lama_kerja'];
	$agama 			= $_POST['agama'];
	$suku 			= $_POST['suku'];
	$telp 			= $_POST['telp'];
	$jenis_pasien 	= $_POST['jenis_pasien'];
	$nama_rs 		= $_POST['nama_rs'];
	$poli 			= $_POST['poli'];

	$value = array('API'=>$API,'id'=>$id,'nama'=>$nama,'NIK'=>$NIK, 'jen_kelamin'=>$jen_kelamin,'temp_lahir'=>$temp_lahir,'tgl_lahir'=>$tgl_lahir,'alamat'=>$alamat,'status'=>$status,'pekerjaan'=>$pekerjaan, 'jabatan'=>$jabatan,'lama_kerja'=>$lama_kerja,'agama'=>$agama,'suku'=>$suku,'telp'=>$telp,'jenis_pasien'=>$jenis_pasien, 'nama_rs'=>$nama_rs,'poli'=>$poli);

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $value);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );

	if($response!=NULL)
	{
		$db->redirect('home.php');     
	} else {
		$error = "terjadi kesalahan pada updaate!";
	}
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>

	<title>Update Pendaftaran</title>	

	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
	<link href="../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

	<link rel="shortcut icon" href="../asset/img/logomi.png">
</head>
<!-- end: Head -->

<body id="update" class="dashboard">

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

						<li class="active ripple"><a class="tree-toggle nav-header"><span class="fa-home fa"></span> Dashboard <span class="fa-angle-right fa right-arrow text-right"></span> </a>
							<ul class="nav nav-list tree">
								<li><a href="home.php">Pendaftaran</a></li>
								<li><a href="RM/readAllRm.php">Rekam Medis</a></li>
								<li><a href="Diagnosis/diagnosis.php">Daftar Diagnosis</a></li>
							</ul>
						</li>

						<li class="ripple">
							<a class="tree-toggle nav-header"><span class="fa fa-table"></span> Form 
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
			<!-- Start Content -->
			<div id="content">

				<div class="col-md-12 panel">
					<div class="col-md-12 panel-heading">
						<h4>Update Pendaftaran </h4>
					</div>
					<div class="col-md-12 panel-body" style="padding-bottom:30px;">
						<div class="col-md-12">
							<form class="cmxform" method="post">
								
								<!--menampilkan pesan eror/sukses-->
								<?php
								if(isset($_GET['updated']))
								{
									?>
									<div class="alert alert-success">
										<i class="glyphicon glyphicons-ok"></i> &nbsp; Berhasil update data
									</div>
									<?php
								}
								?>

								<div class="col-md-6">
									<div class="form-group">
										<input type="hidden" name="API" value="<?php echo $API; ?>" />
									</div>

									<div >
										<input type="hidden" id="id" name="id" value="<?php echo $obj->data->id_pendaftaran;?>"> 
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                          
										<input type="text" class="form-text" name="nama" value="<?php echo $obj->data->nama; ?>">
										<span class="bar"></span>
										<label>Nama Lengkap</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="NIK" value="<?php echo $obj->data->NIK; ?>">
										<span class="bar"></span>
										<label>NIK</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="jen_kelamin" value="<?php echo $obj->data->jen_kelamin; ?>">
										<span class="bar"></span>
										<label>Jenis Kelamin (L/P)</label>
									</div> 

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="status" value="<?php echo $obj->data->status; ?>">
										<span class="bar"></span>
										<label>Status</label>
									</div> 

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                                     
										<input type="text" class="form-text" name="agama" value="<?php echo $obj->data->agama;?>">
										<span class="bar"></span>
										<label>Agama</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="suku" value="<?php echo $obj->data->suku;?>">
										<span class="bar"></span>
										<label>Suku</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="telp" value="<?php echo $obj->data->telp;?>">
										<span class="bar"></span>
										<label>Telepon</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">                                
										<input type="text" class="form-text" name="jenis_pasien" value="<?php echo $obj->data->jenis_pasien;?>">
										<span class="bar"></span>
										<label>Jenis Pasien</label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="temp_lahir" value="<?php echo $obj->data->temp_lahir;?>">
										<span class="bar"></span>
										<label>Tempat Lahir</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="date" class="form-text" name="tgl_lahir" value="<?php echo $obj->data->tgl_lahir;?>">
										<span class="bar"></span>
										<label>Tanggal Lahir</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text"  name="alamat" value="<?php echo $obj->data->alamat;?>">
										<span class="bar"></span>
										<label>Alamat</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="pekerjaan" value="<?php echo $obj->data->pekerjaan;?>">
										<span class="bar"></span>
										<label>Pekerjaan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="jabatan" value="<?php echo $obj->data->jabatan;?>">
										<span class="bar"></span>
										<label>Jabatan</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="lama_kerja" value="<?php echo $obj->data->lama_kerja;?>">
										<span class="bar"></span>
										<label>Lama Kerja (Tahun)</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="nama_rs" value="<?php echo $obj->data->nama_rs;?>">
										<span class="bar"></span>
										<label>Nama RS</label>
									</div>

									<div class="form-group form-animate-text" style="margin-top:40px !important;">
										<input type="text" class="form-text" name="poli" value="<?php echo $obj->data->poli;?>">
										<span class="bar"></span>
										<label>Poli</label>
									</div>
								</div>
								<div class="col-md-12">                              
									<input class="submit btn btn-success" type="submit" value="Update" name="btn-update" >
									<a href="home.php" class="btn btn-danger">Kembali</a>                              
								</div>
							</form>
						</div>
					</div>
				</div>
				<!--End Content-->
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



