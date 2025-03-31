<?php
    include './header.php';
    if (!isset($_SESSION['isLogged']) && $_SESSION['isLogged'] == false) {
        header('Location: ./login.php');
        exit();
    }
    
    require_once './src/Database.php';
    require_once './src/Session.php';
    $user = Session::get('user');
    
    $db = Database::getInstance();

    $auctions = [];

    
    $sql = "SELECT * FROM auction WHERE email = '$user->email' ORDER BY id DESC";
    $res = $db->query($sql);

    while($row = $res->fetch_object()){
        $auctions[] = $row;
    }
   
    $sql = "SELECT * FROM personal_details WHERE email = '$user->email'";
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
                        <div class="col col-lg-4">Email: <?php echo $user->email?></div>
                        <div class="col col-lg-4">Phone: <?php echo $personal_details->phone?></div>
                        <div class="col col-lg-4">Alt. Phone: <?php echo $personal_details->alt_phone?></div>
                        <div class="col col-lg-4">Address: <?php echo $personal_details->street?></div>
                        <div class="col col-lg-4">Pin: <?php echo $personal_details->zip_code?></div>
                        <div class="col col-lg-12 btn-sm mt-3 "><a href="./change-password.php" class=""><i class=""></i></a>
                        </div>
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
    <h3>My Posts </h3>
    <div class="row mb-5">
        <?php foreach($auctions as $auction):?>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card my-2">
                <img src="./upload/<?php echo $auction->image_1?>" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="./details.php?id=<?php echo $auction->id?>"><?php echo $auction->title?></a></h5>
                    <p class="card-text">Rs- <?php echo $auction->price?>/-</p>
                    <?php $date = new DateTime($auction->date)?>
                    <p class="card-text float-right"><small class="text-muted">Posted on -
                            <?php echo $date->format('d-m-Y')?></small></p>
                </div>
            </div>
        </div>
        <?php endforeach?>

    </div>
</div>

<?php
    include './footer.php';
?>
