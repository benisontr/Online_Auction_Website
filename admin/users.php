<?php
include './header.php';
require_once '../src/Database.php';

$db = Database::getInstance();

$users = [];

$sql = "SELECT * FROM personal_details ORDER BY id DESC";
$res = $db->query($sql);

while ($row = $res->fetch_object()) {

    $users[] = $row;
}

?>

<div class="container mt-5">


    <table class="table table-hover table-bordered text-center" id="example">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                 <th scope="col">Zip code</th>
                <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?php echo $i + 1; ?></th>
                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->phone ?></td>
                    <td><?php echo $user->email ?></td>
                    <td><?php echo $user->zip_code ?></td>
                    <td><?php echo $user->street ?></td>
                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>

<?php
include './footer.php';
?>