<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();


$sql = "SELECT * FROM category";

$res = $db->query($sql);
$categories = [];
while($row = $res->fetch_object()){
    $categories[] = $row;
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if($_POST['category'] == 'none'){
        $error = "please select category ";
    }else if (strlen($_POST['name']) < 1) {
        $error = "please enter subcategory ";
    } else if (strlen($_POST['name']) > 150) {

        $error = "subcategory name must be less than 150 character";
    } else {

        $category = $db->real_escape_string($_POST['category']);
        $name = $db->real_escape_string($_POST['name']);


        $sql = "INSERT INTO sub_category
                (name,category)
                values ('$name', '$category')";
        if ($db->query($sql) === true) {
            $msg = "subcategory added successfully";
        } else {
            $error = "Failed to add subcategory Please check your details and try again";
        }
    }
}

?>


<div class="container-fluid mt-5 align-items-center">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error) && strlen($error) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($msg) && strlen($msg) > 1) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']) ?>
                        </div>
                    <?php endif ?>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">category</label>
                            <select class="form-control" name="category">
                                <option value="none">--SELECT--</option>
                                <?php foreach($categories as $c): ?>
                                <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputEmail1" style="color:black">subcategory Name</label>
                               <input type="text" name="name" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                   
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href=""><button type="button" class="btn btn-primary">Cancel</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include './footer.php';
?>