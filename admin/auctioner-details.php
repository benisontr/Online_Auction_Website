<?php
    include './header.php';
    if (!isset($_SESSION['adminLogged']) && $_SESSION['adminLogged'] == false) {
        header('Location: ./login.php');
        exit();
    }
    
    require_once '../src/Database.php';
    require_once '../src/Session.php';
    $email = base64_decode($_GET['auctioner']);
    
    $db = Database::getInstance();

    $auctions = [];

    
    $sql = "SELECT * FROM auction WHERE email = '$email' ORDER BY id DESC";
    $res = $db->query($sql);

    while($row = $res->fetch_object()){
        $auctions[] = $row;
    }
   
    $sql = "SELECT * FROM personal_details WHERE email = '$email'";
    $res = $db->query($sql);
    $personal_details = $res->fetch_object();

?>
<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col col-lg-12">
                            <h3><?php echo $personal_details->name?></h3>
                        </div>
                        <div class="col col-lg-4">Email: <?php echo $email?></div>
                        <div class="col col-lg-4">Phone: <?php echo $personal_details->phone?></div>
                        <div class="col col-lg-4">Alt. Phone: <?php echo $personal_details->alt_phone?></div>
                        <div class="col col-lg-4">Address: <?php echo $personal_details->street?></div>
                        <div class="col col-lg-4">Pin: <?php echo $personal_details->zip_code?></div>
                        <div class="col col-lg-12 btn-sm mt-3 "></div>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="row">
                        <div class="col col-lg-3">
                            <img src="./resources/images/avatar.png" style="border-radius:50%" height="150px"
                                width="150px" class="img-circle" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    include './footer.php';
?>