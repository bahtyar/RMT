<?php

require_once("include/DB_Functions.php");
$login = new DB_Functions();

$server     = "http://".$_SERVER['HTTP_HOST'];
$url        = $server."/wsrmt/Service/server.php?tag=login";
$API        = 'AIzaSyAY1lULinTPFhCaqQ01s-ZkjuokhLrhqVI';


if(isset($_SESSION['user_session']))
{
  $login->redirect('view/home.php');
}

if (isset($_POST['btn-login'])) {

  $uname = strip_tags($_POST['uname']);
  $umail = strip_tags($_POST['uname']);
  $upass = strip_tags($_POST['password']);
    
  if($login->doLogin($uname,$umail,$upass))
  {
    $login->redirect('view/home.php');
  }
  else
  {
    $error = "Wrong Details !";
  }  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login RMT</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

  <div class="signin-form">

    <div class="container">


      <form class="form-signin" method="POST" >

        <h2 class="form-signin-heading">Masuk ke RMT </h2><hr />

        <div class="form-group">
          <input type="hidden" name="API" value="<?php echo $API; ?>" />
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="uname" placeholder="Username" required />
          <span id="check-e"></span>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Your Password" />
        </div>

        <hr />

        <div class="form-group">
          <input type="submit" class="btn btn-default" value="Login" name="btn-login" /> 
        </div>  
        <br />
        <!-- <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label> -->
      </form>

    </div>

  </div>

</body>
</html>