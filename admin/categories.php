<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();


if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM category WHERE id = '$id'";
    $db->query($sql);
}
$categories = [];

$sql = "SELECT * FROM category ORDER BY id DESC";
$res = $db->query($sql);

while ($row = $res->fetch_object()) {

    $categories[] = $row;
}

?>

<div class="container mt-5">
       <div class="row mb-5">
        <div class="col">
               <a href="./add-category.php" class="btn btn-primary float-right">Add category</a>
        </div>
        
    </div>
    <table class="table table-hover table-bordered text-center" id="example">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($categories as $c) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $c->name ?></td>
                    <td><a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $c->id ?>" class="btn btn-danger">Delete</a>
                        <!--<a href="#" class="text-danger"><i class="fa fa-ban"></i>Block</a>-->
                    </td>
                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>

<?php
include './footer.php';
?>