<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();

$auctions = [];

$sql = "SELECT * FROM auction ORDER BY id DESC";
$res = $db->query($sql);

while ($row = $res->fetch_object()) {
    $sql = "SELECT name FROM personal_details WHERE email = '$row->email'";
    $res_name = $db->query($sql);
    $row->name = $res_name->fetch_object()->name;
    $auctions[] = $row;
}
?>
<div class="container mt-5">
    <table class="table table-hover table-bordered text-center" id="example">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
                <th scope="col">User</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach($auctions as $a):?>
            <tr>
                <th scope="row"><?php echo $i + 1;?></th>
                <td><?php echo $a->title?></td>
                <td><?php echo $a->price?></td>
                <td><?php echo $a->date?></td>
                <td><?php echo $a->name?></td>
                <td><a href="./details.php?id=<?php echo $a->id?>" class="text-info"><i class="fa fa-eye"></i>View</a>&nbsp&nbsp
                    <!--<a href="#" class="text-danger"><i class="fa fa-ban"></i>Block</a>-->
                </td>
            </tr>
            <?php $i++;  endforeach?>
        </tbody>
    </table>
</div>

<?php
include './footer.php';
?>