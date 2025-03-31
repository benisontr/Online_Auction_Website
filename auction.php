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
# Getting category
$category = [];
$sql = "SELECT * FROM category";
$res = $db->query($sql);
while ($row = $res->fetch_object()) {
    $category[] = $row;
}
$msg = '';
$err = '';
if (isset($_POST['submit'])) {
   
    $title = $_POST['title'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $title = $_POST['title'];
    $desc = $db->real_escape_string($_POST['desc']);
    $location = $_POST['location'];
    $category = $_POST['category'];
    $subCategory = $_POST['subCategory'];
    $price = $_POST['price'];

    $allowedExts = ['png', 'jpg', 'jpeg'];

    $fileNames = [];

    try {
        
        if (count($_FILES['images']['name']) < 3 || count($_FILES['images']['name']) > 5) {
            throw new Exception('Image count mismatch');
        }
        $i = 0;
        foreach ($_FILES['images']['name'] as $image) {

            if ($_FILES['images']['error'][$i] != 4) {

                $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                if (!in_array($ext, $allowedExts)) {
                    $err = "Invalid file format, Please choose jpg, jpeg and png";
                } else {
                    $randomString = md5(time() + rand(1111, 9999));
                    $fileName = $randomString . '.' . $ext;
                    array_push($fileNames, $fileName);
                    if (!move_uploaded_file($_FILES['images']['tmp_name'][$i], './upload/' . $fileName)) {
                        throw new Exception('Failed to upload file');
                    }
                }
            }
            $i++;
        }
       
        $image_1 = $fileNames[0];
        $image_2 = $fileNames[1];
        $image_3 = $fileNames[2];
        $image_4 = $fileNames[3];
        $image_5 = $fileNames[4];

        $sql = "INSERT INTO location (name) VALUES ('$location')";
        $res = $db->query($sql);

        $locationId = $db->insert_id;
      
        $sql = "INSERT INTO auction( title, description, start_time, end_time, location, category, sub_category, price, email, image_1, image_2, image_3, image_4, image_5)
             VALUES ('$title', '$desc', '$startTime', '$endTime', '$locationId', '$category', '$subCategory', '$price', '$user->email',
                     '$image_1', '$image_2', '$image_3', '$image_4', '$image_5')";
             


        if ($db->query($sql) === false) {
            throw new Exception($db->error);
        }

        $msg = "Your auction posted successfully";
    } catch (Exception $e) {
        $err = 'Faild to post, please try later';
    }
}

?>
<div class="container py-5">
    <div class="col-lg-12">
        <div id="msg" class="mt-3">
            <?php if (strlen($msg) > 1): ?>
            <div class="alert alert-success text-center"><strong>Success! </strong><?php echo $msg ?></div>
            <?php endif?>
            <?php if (strlen($err) > 1): ?>
            <div class="alert alert-danger text-center"><strong>Failed! </strong><?php echo $err ?></div>
            <?php endif?>
        </div>
        <h1 class="text-center font-weight-bold mb-4">Start Auction</h1>
        <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" onsubmit="return validateAuctionFrom()">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter title">
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Start Time</label>
                    <input type="text" id="startTime" name="startTime" class="form-control" placeholder="Enter start time">
                    <span class="help">Format: 00:00 24hrs</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">End Time</label>
                    <input type="text" id="endTime" name="endTime" class="form-control" placeholder="Enter end time">
                    <span class="help">Format: 00:00 24hrs</span>
                </div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Description</label>
                <textarea class="form-control" id="desc" name="desc" placeholder="Enter description"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Location</label>
                    <input type="text" id="location" name="location" class="form-control" placeholder="Enter location">
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Category</label>
                    <select name="category" id="category" id="category" class="form-control">
                        <option value="none" selected>Choose...</option>
                        <?php foreach ($category as $c): ?>
                        <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Sub-category</label>
                    <select name="subCategory" id="subCategory" id="subCategory" class="form-control">
                        <option value="none" selected>Choose...</option>

                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="font-weight-bold">Price</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="Enter price">
                </div>
                <div class="form-group col-md-8">
                    <label class="font-weight-bold">Select Images</label>
                    <input type="file" multiple name="images[]" class="form-control" placeholder="Select images">
                    <span class="help">Select 3 to 5 images of your product</span>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary float-right">Post</button>
        </form>

    </div>
    <div class="clearfix mb-5"></div>
</div>

<?php
include './footer.php';
?>

<Script>
    var categoryDropDown = $('#category');
    var subCategoryDropDown = $('#subCategory');
    categoryDropDown.change(function () {
        var category = categoryDropDown.val();

        $.ajax({
            url: './src/getSubCategory.php',
            type: 'text',
            dataType: 'text',
            method: 'POST',
            data: {
                'id': category
            },
            success: function (res) {
                var result = JSON.parse(res);
                var options = [];
                var option = '<option value="none">Choose...</option>';
                options.push(option);

                for (var i = 0; i < result.length; i++) {
                    var option = '<option value="' + result[i].id + '">' + result[i].name +
                        '</option>';
                    options.push(option);
                }

                subCategoryDropDown.html(options.join(''));

            }
        })
    })
</Script>