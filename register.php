<?php
include './header.php';
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == true) {
    header('Location: ./index.php');
    exit();
}
require_once './src/Database.php';

$db = Database::getInstance();
$err = '';
$msg = '';
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $pin = $_POST['pin'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $altPhone = $_POST['alt_phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (strlen($firstName) < 1) {
        $err = "Please enter first name";
    } else if (strlen($lastName) < 1) {
        $err = "Please enter last name";
    } else if (strlen($address) < 1) {
        $err = "Please enter address";
    } else if (strlen($pin) < 1) {
        $err = "Please enter pin";
    } else if (strlen($pin) != 6) {
        $err = "Please enter valid pin";
    } else if (!ctype_digit($pin)) {
        $err = "Please enter valid pin";
    } else if (strlen($email) < 1) {
        $err = "Please enter email";
    } else if (strlen($phone) < 1) {
        $err = "Please enter phone";
    } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $err = "Phone number must be 10 digit";
    } else if (!ctype_digit($phone)) {
        $err = "Please enter valid phone";
    } else if (strlen($password) < 1) {
        $err = "Please choose password";
    } else {
        $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
        if ($password != $confirmPassword) {
            $err = "Password doesnot match";
        } else {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password, last_password) VALUES ('$email', '$hash_pass', '$hash_pass');";

            $sql .= "INSERT INTO personal_details (name, street, phone, alt_phone, zip_code, email)
                    VALUES ('$fullName', '$address', '$phone', '$altPhone', '$pin', '$email')";
            if ($db->multi_query($sql) === true) {

                $msg = 'Registration has been successfull, Please login';
            } else {
                $err = 'Registration failed please try later';
            }
        }
    }
}
?>
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
        </div>
        <div class="col-md-8 col-lg-6" style="background:whitesmoke">
            <div class="login align-items-center">
                <div class="col-md-12 col-lg-12 mx-auto">
                    <div id="msg" class="mt-3">
                        <?php if(strlen($msg) > 1):?>
                        <div class="alert alert-success text-center"><strong>Success! </strong><?php echo $msg?></div>
                        <?php endif?>
                        <?php if(strlen($err) > 1):?>
                        <div class="alert alert-danger text-center"><strong>Failed! </strong><?php echo $err?></div>
                        <?php endif?></div>
                    <h3 class="pt-5 text-center font-weight-bold">Sign Up</h3>
                    <form class="mt-4" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validateRegisterFrom()">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">First Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">Middle Name</label>
                                <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Enter middle name">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">Last Name</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">Address</label>
                                <textarea name="address" id="address" class="form-control" id="inputEmail4" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Pincode</label>
                                <input type="text" id="pin" name="pin" class="form-control" placeholder="Enter pincode">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone no.">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Alt. Phone</label>
                                <input type="text" name="alt_phone" class="form-control" placeholder="Enter alternative no.">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password.">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold">Confirm password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-login my-2" type="submit" name="submit">Sign up</button>
                    </form>
                    <div class="text-center">
                        <a href="./login.php">Already registered?</a></div>
                        <div class="clearfix" style="height:65px"></div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php
	include './footer.php';
?>
