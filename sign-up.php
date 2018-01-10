<?php
session_start();
require_once('include/DB_Functions.php');
$user = new DB_Functions();

$server = "http://".$_SERVER['HTTP_HOST'];
$url = $server."/wsrmt/Service/server.php?tag=register";
$API = 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sign up</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

	<div class="signin-form">

		<div class="container">

			<form method="post" class="form-signin" action="<?php echo htmlspecialchars($url); ?>">
				<h2 class="form-signin-heading">Sign up</h2><hr />
				<?php
				if(isset($_GET['joined']))
				{
					?>
					<div class="alert alert-info">
						<i class="glyphicon glyphicon-log-in"></i> &nbsp; Berhasail mendaftar <a href='index.php'>login</a> disini
					</div>
					<?php
				}
				?>

				<div class="form-group">
					<input type="hidden" name="API" value="<?php echo $API; ?>" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username" required/>
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="email@email.com" required />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="******" required />
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="nama" placeholder="Nama" required />
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required />
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="telpon" placeholder="+62xxxxx" required />
				</div>

				<div class="clearfix"></div><hr />				
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Register" /> 
				</div>
				<br />
				<label>have an account ! <a href="index.php">Log In</a></label>
			</form>
		</div>
	</div>

</div>

</body>
</html>