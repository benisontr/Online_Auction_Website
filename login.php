<?php
	include './header.php';
	if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true){
		header('Location: ./index.php');
		exit();
	}
	require_once './src/Database.php';
	require_once './src/Session.php';
	$db = Database::getInstance();

	$err = '';
	$msg = '';
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(strlen($email) < 1){
			$err = "Please enter email";
		} else if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
			$err = "Please enter a valid email";
		} else if(strlen($password) < 1){
			$err = "Please enter password";
		} else {
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$res = $db->query($sql);

			if($res->num_rows > 0){
				$user = $res->fetch_object();
				if(password_verify($password, $user->password)){
					Session::set('isLogged', true);
					Session::set('user', $user);
					header('Location: ./index.php');
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
<div class="container-fluid">
	<div class="row no-gutter">
		<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
		</div>
		<div class="col-md-8 col-lg-6" style="background:whitesmoke">
			<div class="login align-items-center d-flex">
				<div class="col-md-9 col-lg-8 mx-auto">
					<div id="msg">
						<?php if(strlen($err) > 1):?>
						<div class="alert alert-danger mt-3 text-center"><strong>Failed! </strong><?php echo $err?></div>
						<?php endif?>
					</div>
					<h3 class="mb-4 text-center font-weight-bold">Sign In</h3>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validateLoginForm()">
						<div class="form-group">
							<label class="font-weight-bold">Email address</label>
							<input type="email" id="email" name="email" class="form-control" placeholder="Enter email">

						</div>
						<div class="form-group">
							<label class="font-weight-bold">Password</label>
							<input type="password" id="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div>
							<div class="text-center float-right">
								<a class="small" href="./forgotPass.php"></a></div>
						</div>

						<button class="btn btn-lg btn-primary btn-block btn-login my-2" name="submit" type="submit">Sign
							In</button>

					</form>
					<div class="text-center">
						<a href="./register.php">Not registered yet?</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include './footer.php';
?>