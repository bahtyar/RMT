<?php

require_once("../session.php");
require_once("../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];
$url = $server."/wsrmt/Service/server.php?tag=insertPendaftaran";
$API = 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';

if (!$db->is_loggedin()=="") {
	$user_id = $_SESSION['user_session'];
	$stmt = $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['btn-insert'])) {
	$API 			= $_POST['API'];
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

	$value = array('API'=>$API,'nama'=>$nama,'NIK'=>$NIK, 'jen_kelamin'=>$jen_kelamin,'temp_lahir'=>$temp_lahir,'tgl_lahir'=>$tgl_lahir,'alamat'=>$alamat,'status'=>$status,'pekerjaan'=>$pekerjaan, 'jabatan'=>$jabatan,'lama_kerja'=>$lama_kerja,'agama'=>$agama,'suku'=>$suku,'telp'=>$telp,'jenis_pasien'=>$jenis_pasien, 'nama_rs'=>$nama_rs);

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
		$error = "Silahkan masukkan data dengan benar!";
	}
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>

	<title>Tambah Pendaftaran</title>	

	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.min.css">

	<!-- plugins -->
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/datatables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../asset/css/plugins/animate.min.css"/>
	<link href="../asset/css/style.css" rel="stylesheet">
	<!-- end: Css -->

</head>
<!-- end: Head -->

<body id="insert" class="dashboard">

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

						<li class="ripple"><a href="home.php"><span class="fa-home fa"></span>Beranda</a></li>

						<li class="ripple"><a href="RM/readAllRm.php"><span class="fa fa-plus-square"></span>Rekam Medis</a></li>

						<li class="ripple"><a href="Diagnosis/diagnosis.php"><span class="fa fa-list-alt"></span> Daftar Diagnosis</a></li>

						<li class="active ripple">
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
			<!--Start Content-->

			<div id="content">

				<div class="col-md-12 top-20 padding-0">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading"><h3>Form</h3>
								<p class="animated fadeInDown"> Tambah Pendaftaran </p>
							</div>							

							<div class="panel-body">
								<div class="col-md-12">
									<form class="cmxform" method="POST" >									
										<center><b><span style="font-size:18px">Tambah Pendaftaran</span></b></center><br>
										<div class="col-md-6">

											<div class="form-group">
												<input type="hidden" name="API" value="<?php echo $API; ?>" />
											</div>
											<table style="font-size:14px" width="100%">									
												<tbody>
													<tr valign="top" height="21px">
														<td width="25%">Nama Lengkap</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="nama" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td width="25%">NIK</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="NIK" class="form-control android" required></div></td>
													</tr>
													<tr valign="top" height="21px">
														<td>Jenis Kelamin</td>
														<td>:</td>
														<td><div class="form-group"><input type="text" name="jen_kelamin" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td >Tempat Lahir</td>
														<td >:</td>
														<td ><div class="form-group"><input type="text" name="temp_lahir" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td >Tgl. Lahir</td>
														<td >:</td>
														<td><div class="form-group"><input type="date" name="tgl_lahir" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td>Alamat</td>
														<td>:</td>														
														<td><div class="form-group"><input type="text" name="alamat" class="form-control android" required></div></td>
													</tr>
													<tr valign="top" height="21px">
														<td>No. Telepon</td>
														<td>:</td>														
														<td><div class="form-group"><input type="text" name="telp" class="form-control android" required></div></td>
													</tr>
													<tr valign="top" height="21px">
														<td width="25%">Nama Fasilitas</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="nama_rs" class="form-control android" required></div></td>
													</tr>
												</tbody>
											</table> 
										</div>

										<div class="col-md-6">										
											<table style="font-size:14px" width="100%">									
												<tbody>
													<tr valign="top" height="21px">
														<td width="25%">Status</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="status" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td width="25%">Pekerjaan</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="pekerjaan" class="form-control android" required></div></td>
													</tr>
													<tr valign="top" height="21px">
														<td>Jabatan</td>
														<td>:</td>
														<td><div class="form-group"><input type="text" name="jabatan" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td >Lama Kerja</td>
														<td >:</td>
														<td ><div class="form-group"><input type="text" name="lama_kerja" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td >Agama</td>
														<td >:</td>
														<td><div class="form-group"><input type="text" name="agama" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td>Suku Bangsa</td>
														<td>:</td>														
														<td><div class="form-group"><input type="text" name="suku" class="form-control android" required></div></td>
													</tr>	
													<tr valign="top" height="21px">
														<td width="25%">Jenis Pasien</td>
														<td width="1%">:</td>
														<td><div class="form-group"><input type="text" name="jenis_pasien" class="form-control android" required></div></td>
													</tr>											
												</tbody>
											</table> 
										</div>

										<div class="col-md-12">                              
											<input class="submit btn btn-success" type="submit" value="Buat" name="btn-insert">
											<a href="home.php" class="btn btn-danger">Kembali</a>                              
										</div>
									</form>
								</div>
							</div>
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

