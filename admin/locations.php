<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();


if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM location WHERE id = '$id'";
    $db->query($sql);
}
$locations = [];

$sql = "SELECT * FROM location ORDER BY id DESC";
$res = $db->query($sql);

while ($row = $res->fetch_object()) {

    $locations[] = $row;
}

?>

<div class="container mt-5">
       <div class="row mb-5">
        <div class="col">
               <a href="./add-location.php" class="btn btn-primary float-right">Add location</a>
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
            foreach ($locations as $l) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $l->name ?></td>
                    <td><a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $l->id ?>" class="btn btn-danger">Delete</a>
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