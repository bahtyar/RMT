<?php

require_once("../../session.php");
require_once("../../include/DB_Functions.php");
//instansiasi class objek
$db = new DB_Functions();


$server 	= "http://".$_SERVER['HTTP_HOST'];
$API 		= 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';
$id_rm 		= $server."/wsrmt/Service/server.php?tag=RmById";
$id_daftar 	= $server."/wsrmt/Service/server.php?tag=PendaftaranById";
$rm 		= $server."/wsrmt/Service/server.php?tag=RmByNum";


if (!$db->is_loggedin()=="") {
	$user_id 	= $_SESSION['user_session'];
	$stmt 		= $db->runQuery("SELECT * FROM user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow	=$stmt->fetch(PDO::FETCH_ASSOC);

	$id 		= $_GET['id'];

	$json 		= file_get_contents($id_rm."&id=".$id);
	$obj 		= json_decode($json);

	$daftar 	= file_get_contents($id_daftar."&id=".$id);	
	$odaftar 	= json_decode($daftar);	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

	<title>rekam medis <?php print($odaftar->data->nama); ?></title>	

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
							<div class="col-md-12 panel-heading">
								<h4><?php if ($obj==null){echo $error[] = "Pasien ".$odaftar->data->nama." tidak memiliki rekam medis";}else{echo "Rekam medis pasien : ".$odaftar->data->nama;} ?></h4>
								<p class="animated fadeInDown">
									Home <span class="fa-angle-right fa"></span> Info <span class="fa-angle-right fa"></span> Lihat RM
								</p>
							</div>


							<?php					
							if($obj==null)
							{						
								?>
								<div class="panel-body">
									<div class="col-md-12">
										<form class="cmxform" id="insertRM">
											<div class="col-md-12"><br /> 
												<a href="insertRM.php?id=<?php echo $id;?>" class="btn btn-success">Buat</a>
												<a href="../home.php" class="btn btn-danger">Kembali</a>                           
											</div>
										</form>
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

				<?php	
			}else{ ?>


			<div class="panel-body">
				<div class="col-md-6"> <br />
					<table style="font-size:14px" width="100%">									
						<tbody>
							<tr valign="top" height="21px">
								<td width="25%">Nama Pasien</td>
								<td width="1%">:</td>
								<td><?php echo $odaftar->data->nama;?></td>
							</tr>										
							<tr valign="top" height="21px">
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?php echo $odaftar->data->jen_kelamin;?></td>
							</tr>
							<tr valign="top" height="21px">
								<td>Umur</td>
								<td>:</td>
								<td><?php 
								$today 		= date("Y-m-d");
								$diff 		= date_diff(date_create($odaftar->data->tgl_lahir), date_create($today));
								echo $umur 	= $diff->format('%y');?></td>
							</tr>
							<tr valign="top" height="21px">
								<td>Alamat</td>
								<td>:</td>
								<td><?php echo $odaftar->data->alamat;?></td>
							</tr>
						</tbody>
					</table> 
				</div>
				<div class="col-md-6"> <br />
					<table style="font-size:14px" width="100%">
						<tbody>
							<tr valign="top" height="21px">
								<td width="25%">No. RM.</td>
								<td width="1%">:</td>
								<td><b><?php echo $odaftar->data->NIK;?></b></td>
							</tr>
							<tr valign="top" height="21px">
								<td>Pekerjaan</td>
								<td>:</td>
								<td><?php echo $odaftar->data->pekerjaan;?></td>
							</tr>
							<tr valign="top" height="21px">
								<td>Status</td>
								<td>:</td>
								<td><?php echo $odaftar->data->status;?></td>
							</tr>
							<tr valign="top" height="21px">
								<td>Telepon</td>
								<td>:</td>
								<td><?php echo $odaftar->data->telp;?></td>
							</tr>
						</tbody>
					</table>
				</div><br />
			</div>

			<div class="panel-body">
				<div class="responsive-table">
					<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>	
								<td>Nama Fasilitas</td>										
								<td>MRS</td>											
								<td>Riwayat Penyakit</td>
								<td>Diagnosis Kerja</td>
								<td>Nama Dokter</td>
								<td>Terapi/Pelayanan</td>
								<td>Waktu Buat</td>											
								<td><a href="insertRM.php?id=<?php echo $id;?>" class="btn btn-raised btn-default"><span class="fa fa-pencil-square-o"></span> Tambah</a></td>
							</tr>
							<tbody>
								<?php if (count($obj->data)) {

									foreach ($obj->data as $idx => $data) { ?>

									<tr>
										<td><?php echo $data->nama_rs;?></td>
										<td><?php $row['join_date'] = $data->mrs;
										echo date("d-m-Y",strtotime($row['join_date']));?></td>	
										<td><?php echo $data->riwayat_penyakit;?></td>
										<td><?php echo $data->diagnosa_kerja;?></td>
										<td><?php echo $data->nama_dr;?></td>
										<td><?php echo $data->pelayanan;?></td>
										<td><?php $row['date_create'] = $data->created_at;
										echo date("l d/m/Y h:i:s A",strtotime($row['date_create']));?></td>	
										<td>
											<a href="detailRM.php?id=<?php echo $data->id_rm;?>">Info</a> |

											<a href="deleteRM.php?id=<?php echo $data->id_rm;?>" onclick="return confirm('Anda yakin menghapus RM <?php echo $data->nama;?>?');">Delete</a>
										</td>

									</tr>

									<?php } 
								}?>
							</tbody>

						</table>
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

			<?php }

			?>