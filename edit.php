<?php

    $conn = mysqli_connect('localhost', 'root', '', 'clients');

    $id = $_GET['id'];

    $query = "SELECT fname, lname, dob, phone, leftSph, rightSph, rightCyl, leftCyl, rightAxis, leftAxis, PD FROM client c, diopter d WHERE c.cid = d.Client AND c.cid =" . $id;

    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

if ($_POST){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];

    if (empty($name) && empty($surname) && empty($date) && empty($phone)){
        echo 'Form is invalid';
    }

    $conn = mysqli_connect('localhost', 'root', '', 'clients');

    // Left eye

    $lsphere = $_POST['lsphere'];
    $lcylinder = $_POST['lcylinder'];
    $laxis = $_POST['laxis'];

    // Right eye

    $rsphere = $_POST['rsphere'];
    $rcylinder = $_POST['rcylinder'];
    $raxis = $_POST['raxis'];

    $pd = $_POST['pd'];

    mysqli_query($conn, "UPDATE client SET fname='$name', lname='$surname', dob='$date', phone='$phone' WHERE cid=$id");
    mysqli_query($conn, "UPDATE diopter SET leftSph='$lsphere', rightSph='$rsphere', leftCyl='$lcylinder', rightCyl='$rcylinder', rightAxis='$raxis', leftAxis='$laxis', pd='$pd' WHERE client=$id");

    header("Location: index.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>

    <a href="index.php" class="logo"><img src="img/logo.png" alt="optikabegic" width="150px"></a>

    <form action="" method="POST">

        <div class="form-row flex">

            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="<?=$row['fname']?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="surname">Surname</label>
                <input name="surname" type="text" class="form-control" id="surname" placeholder="Surname" value="<?=$row['lname']?>" required>
            </div>

        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input name="date" type="date" class="form-control" id="date" value=<?=strftime('%Y-%m-%d', strtotime($row['dob']))?> required>
        </div>

        <div class="form-group">
            <label for="text">Phone</label>
            <input name="phone" type="text" class="form-control" id="text" placeholder="Phone" value="<?=$row['phone']?>" required>
        </div>

        <div class="form-row flex">

            <div class="form-group col-md-4">
                <label for="lsphere">Left Sphere</label>
                <input name="lsphere" type="number" step="0.25" class="form-control" id="lsphere" placeholder="Left Sphere" value=<?=(float)['leftSph']?>>
            </div>

            <div class="form-group col-md-4">
                <label for="lcylinder">Left Cylinder</label>
                <input name="lcylinder" type="number" step="0.25" class="form-control" id="lcylinder" placeholder="Left Cylinder" value=<?= (float)$row['leftCyl']?>>
            </div>

            <div class="form-group col-md-4">
                <label for="laxis">Left Axis</label>
                <input name="laxis" type="number" min="0" class="form-control" id="laxis" placeholder="Left Axis" value=<?=(float)$row['leftAxis']?>>
            </div>

        </div>

        <div class="form-row flex">

            <div class="form-group col-md-4">
                <label for="rsphere">Right Sphere</label>
                <input name="rsphere" type="number" step="0.25" class="form-control" id="rsphere" placeholder="Right Sphere" value=<?=(float)$row['rightSph']?>>
            </div>

            <div class="form-group col-md-4">
                <label for="rcylinder">Right Cylinder</label>
                <input name="rcylinder" type="number" step="0.25" class="form-control" id="rcylinder" placeholder="Right Cylinder" value=<?= (float)$row['rightCyl']?>>
            </div>

            <div class="form-group col-md-4">
                <label for="raxis">Right Axis</label>
                <input name="raxis" type="number" min="0" class="form-control" id="raxis" placeholder="Right Axis" value=<?=(float)$row['rightAxis']?>>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label for="pd">PD</label>
            <input name="pd" type="number" min="0" class="form-control" id="pd" placeholder="PD" value=<?=(float)$row['PD']?>>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</main>
</body>
</html>