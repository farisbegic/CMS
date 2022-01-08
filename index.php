<?php

    require("dbase.php");

    $query = mysqli_query($conn, "SELECT c.cid,c.fname, c.lname, c.dob, c.phone, d.leftSph, d.leftCyl, d.leftAxis, d.rightSph, d.rightCyl, d.rightAxis, d.pd FROM client c, diopter d WHERE c.cid = d.Client");

    if ($_POST){

        $input = $_POST["input"];

        $query = mysqli_query($conn, "SELECT DISTINCT c.cid,c.fname, c.lname, c.dob, c.phone, d.leftSph, d.leftCyl, d.leftAxis, d.rightSph, d.rightCyl, d.rightAxis, d.pd FROM client c, diopter d WHERE c.cid = d.Client AND c.fname LIKE '%$input%'");

    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>

        <a href="index.php" class="logo"><img src="img/logo.png" alt="optikabegic" width="150px"></a>

        <div class="form-group">
            <form action="" method="POST">
                <input name="input" type="text" class="form-control" placeholder="Search..">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <table class="table table-striped table-responsive-sm">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Date of birth</th>
                <th>Phone</th>
                <th>Left Sphere</th>
                <th>Left Cylinder</th>
                <th>Left Axis</th>
                <th>Right Sphere</th>
                <th>Right Cylinder</th>
                <th>Right Axis</th>
                <th>PD</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($query)){ ?>
                <tr>
                    <td><?= $row['cid'] ?></td>
                    <td><?= $row['fname'] ?></td>
                    <td><?= $row['lname'] ?></td>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['leftSph'] ?></td>
                    <td><?= $row['leftCyl'] ?></td>
                    <td><?= $row['leftAxis'] ?></td>
                    <td><?= $row['rightSph'] ?></td>
                    <td><?= $row['rightCyl'] ?></td>
                    <td><?= $row['rightAxis'] ?></td>
                    <td><?= $row['pd'] ?></td>
                    <td><a href="edit.php?id=<?= $row['cid'] ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="register.php">Add a Client</a>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>
</html>