<?php
    if(!isset($_GET['id']) || strlen($_GET['id']) < 1 || !ctype_digit($_GET['id'])){
        header('Location: ./index.php');
        exit();
    }
    include './header.php';

    $id = $_GET['id'];

    require_once '../src/Database.php';
    $db = Database::getInstance();

    # Getting auction details
    $sql = "SELECT * FROM auction WHERE id = '$id'";
    $res = $db->query($sql);

    $auction = $res->fetch_object();

    //print_r($auction->image_1);die;

    # Getting location
    $sql = "SELECT name FROM location WHERE id = '$auction->location'";
    $res = $db->query($sql);
    $location = $res->fetch_object()->name;

    # Getting category
    $sql = "SELECT name FROM category WHERE id = '$auction->category'";
    $res = $db->query($sql);
    $category = $res->fetch_object()->name;

    # Getting subcategory
    $sql = "SELECT name FROM sub_category WHERE id = '$auction->sub_category'";
    $res = $db->query($sql);
    $sub_category = $res->fetch_object()->name;

    # Getting bids
    $bids = [];
    $sql = "SELECT * FROM bids WHERE auction = '$id'";
    
    $res = $db->query($sql);
    while($row = $res->fetch_object()){
        
        # Getting the name of the bidder
        $sql = "SELECT name FROM personal_details WHERE email = '$row->bidder'";
        $res_name = $db->query($sql);
        $row->bidder_name = $res_name->fetch_object()->name;

        $bids[] = $row;
    }
?>

<div class="container">
    <div class="row my-5">
        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../upload/<?php echo $auction->image_1?>" height="400px" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item ">
                        <img src="../upload/<?php echo $auction->image_2?>" height="400px" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item ">
                        <img src="../upload/<?php echo $auction->image_3?>" height="400px" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item ">
                        <img src="../upload/<?php echo $auction->image_4?>" height="400px" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item ">
                        <img src="../upload/<?php echo $auction->image_5?>" height="400px" class="d-block w-100"
                            alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>



            
            <div class="col-lg-12 my-2">
                <h4><?php echo $auction->title?></h4>
                <?php $date = new DateTime($auction->date)?>
                <small>Posted on - <?php echo $date->format('d-m-Y')?> </small>
            </div>

            <div class="card my-3">
                <div class="card-body">
                    <div class="row  ">
                        <div class="col-lg-12 mb-1">
                            <p class="card-text text-justify"><?php echo $auction->description?></p>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo $location?></p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <p><i class="fas fa-info-circle"></i> <?php echo $category?></p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <p><i class="fas fa-rupee-sign"></i> <?php echo $auction->price?></p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="./auctioner-details.php?auctioner=<?php echo base64_encode($auction->email) ?>"
                class="btn btn-info float-right">Contact auctioner</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 my-2 my-lg-0 my-md-0">
            <table class="w-100" id="bidsHolder">
                <?php foreach($bids as $bid):?>
                <tr class="border">
                    <td class="text-center">
                        <img src="./resources/images/avatar.png" alt=""
                            style="height:50px; width:50px; border-radius:50%"></img>
                    </td>
                    <td class="text-left padding-para">
                        <p class="table-para font-weight-bold"><?php echo $bid->bidder_name?></p>
                        <p class="table-para">Rs - <?php echo $bid->amount?>/-</p>
                    </td>
                </tr>
                <?php endforeach?>
            </table>
        </div>

    </div>



</div>

<?php
    include './footer.php';
?>
