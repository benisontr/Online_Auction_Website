<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();

if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM sub_category WHERE id = '$id'";
    $db->query($sql);
}

$subcategories = [];

$sql = "SELECT * FROM sub_category ORDER BY id DESC";
$res = $db->query($sql);

while ($row = $res->fetch_object()) {

    $subcategories[] = $row;
}

?>

<div class="container mt-5">
<div class="row mb-5">
        <div class="col">
        <a href="./add-subcategory.php" class="btn btn-primary mt-2 ml-5">Add subcategory</a>
        </div>
        
    </div>
    <table class="table table-hover table-bordered text-center" id="example">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($subcategories as $s) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $s->name ?></td>
                    <?php
                    $sql = "SELECT * FROM category WHERE id = '$s->category'";
                    $res = $db->query($sql);
                    $name = $res->fetch_object()->name;
                    ?>
                    <td><?php echo $name ?></td>
                    <td><a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $s->id ?>" class="btn btn-danger">Delete</a>
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