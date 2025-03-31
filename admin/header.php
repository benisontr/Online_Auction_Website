<?php
session_start();
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - Bidify</title>
    <link rel="stylesheet" type="text/css" href="./resources/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="./resources/css/datatable.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="./dashboard.php">
            <strong>Bidify</strong>
        </a>
        <ul class="nav">
            <li class="nav-item mx-3">
                <a href="./categories.php" class="text-white font-weight-bold ">Categories</a>
            </li>
            <li class="nav-item mx-3">
                <a href="./subcategories.php" class="text-white font-weight-bold">Subcategories</a>
            </li>
            <li class="nav-item mx-3">
                <a href="./users.php" class="text-white font-weight-bold">Users</a>
            </li>
            <li class="nav-item mx-3">
                <a href="./locations.php" class="text-white font-weight-bold">Locations</a>
            </li>
            <li class="nav-item mx-3">
                <?php if (isset($_SESSION['adminLogged']) && $_SESSION['adminLogged'] == true) : ?>
                    <a href="./logout.php" class="text-white font-weight-bold">Logout</a>
                <?php endif ?>
            </li>

        </ul>
    </nav>