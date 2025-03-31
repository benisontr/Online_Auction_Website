<?php
    include './header.php';
    require_once './src/Database.php';

    $db = Database::getInstance();

    $auctions = [];

    if(isset($_POST['search'])){
        $categorie = $_POST['category'];
        $subCategorie = $_POST['subCategory'];
        $location = $_POST['location'];
        $keywords = $_POST['keywords'];

        $sql = "SELECT * FROM auction WHERE category = '$categorie' or sub_category = '$subCategorie' or location = '$location' or title LIKE '%$keywords%'";

        $res = $db->query($sql);

        while($row = $res->fetch_object()){
            $auctions[] = $row;
        }
    } else {
        $sql = "SELECT * FROM auction ORDER BY id DESC";
        $res = $db->query($sql);

        while($row = $res->fetch_object()){
            $auctions[] = $row;
        }
    }

    $categories = [];
    $sql = "SELECT * FROM category";
    $res = $db->query($sql);

    while($row = $res->fetch_object()){
        $categories[] = $row;
    }

    $sub_category = [];
    $sql = "SELECT * FROM sub_category";
    $res = $db->query($sql);

    while($row = $res->fetch_object()){
        $sub_categories[] = $row;
    }

    $locations = [];
    $sql = "SELECT * FROM location";
    $res = $db->query($sql);

    while($row = $res->fetch_object()){
        $locations[] = $row;
    }

    
?>
    <div class="container">
        <div class="card my-3">
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <select id="inputState" name="category" class="form-control form-control-sm">
                                <option value="none" selected>Choose category...</option>
                                <?php foreach($categories as $c):?>
                                <option value="<?php echo $c->id?>"><?php echo $c->name?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <select id="inputState" name="subCategory" class="form-control form-control-sm">
                                <option value="none" selected>Choose sub category...</option>
                                <?php foreach($sub_categories as $sc):?>
                                <option value="<?php echo $sc->id?>"><?php echo $sc->name?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 my-2">
                            <select id="inputState" name="location" class="form-control form-control-sm">
                                <option value="none" selected>Choose location...</option>
                                <?php foreach($locations as $l):?>
                                <option value="<?php echo $l->id?>"><?php echo $l->name?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 my-2">
                            <input type="text" name="keywords" class="form-control form-control-sm" placeholder="Keywords...">
                        </div>
                       
                        <div class="col-lg-2 col-md-2 col-sm-2 my-2">
                            <button type="submit" name="search" class="btn btn-primary btn-block btn-sm">Search</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row mb-5">
            <?php foreach($auctions as $auction):?>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="card my-2">
                    <img src="./upload/<?php echo $auction->image_1?>" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><a href="./details.php?id=<?php echo $auction->id?>"><?php echo $auction->title?></a></h5>
                        <p class="card-text">Rs- <?php echo $auction->price?>/-</p>
                        <?php $date = new DateTime($auction->date)?>
                        <p class="card-text float-right"><small class="text-muted">Posted on - <?php echo $date->format('d-m-Y')?></small></p>
                    </div>
                </div>
            </div>
            <?php endforeach?>
            
        </div>
    </div>

   <?php
        include './footer.php';
   ?>