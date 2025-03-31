<?php
	

	require_once '../src/Database.php';
	require_once '../src/Session.php';
	$db = Database::getInstance();

	$err = '';
	$msg = '';


	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(strlen($username) < 1){
			$err = "Please enter username";
		} else if(strlen($password) < 1){
			$err = "Please enter password";
		} else {
			$sql = "SELECT * FROM admin WHERE username = '$username'";
			$res = $db->query($sql);

			if($res->num_rows > 0){
				$user = $res->fetch_object();
				if(password_verify($password, $user->password)){
					Session::set('adminLogged', true);
					Session::set('admin', $user);
					header('Location: ./dashboard.php');
					exit();
				} else {
					$err = "Wrong username or password";
				}
			} else{
				$err = "User not found";
			}
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Panel - Bidify</title>
        <link rel="stylesheet" type="text/css" href="./resources/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="./resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="./resources/css/datatable.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
            integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        </head>
        <body>
            <nav class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="./dashboard.php">
                    <img src="./resources/images/logo.png" width="150" height="30" class="d-inline-block align-top" alt="">
                </a>
          
            </nav>
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="col-md-4 col-lg-4 offset-lg-4 mt-5">
			<div class="card">
				<div class="card-body">
					<div id="msg">
						<?php if(strlen($err) > 1):?>
						<div class="alert alert-danger mt-3 text-center"><strong>Failed! </strong><?php echo $err?>
						</div>
						<?php endif?>
					</div>
					<h3 class="card-title text-center my-3">Admin Login</h3>
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
						<div class="form-group">
							<label class="font-weight-bold">Username</label>
							<input type="text" name="username" class="form-control" placeholder="Enter username">
						</div>
						<div class="form-group">
							<label class="font-weight-bold">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<button class="btn btn-lg btn-primary btn-block btn-login my-2" name="login"
							type="submit">Sign In</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include './footer.php';
?>