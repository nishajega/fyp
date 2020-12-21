<?php
error_reporting(0);
require('connection.php');
$value = $_POST['value'];
if (isset($_POST['submit'])) {
    $names = $_POST['name'];
    $emails = $_POST['email'];
    $course = $_POST['coursename'];
    $instruct = $_POST['instructorname'];

    foreach ($names as $key => $name) {
        echo $names[$key] . "<br /> " . $names[$key] . "<br />";
        $qry = "INSERT INTO cert(name, email, course, instructor) VALUES('$names[$key]', '$names[$key]', '$course', '$instruct')";
        $go = mysqli_query($con, $qry);

        echo $qry;
        // insert into mysql query here
    }
}

$sql="select invoice.item, courses.* where invoice.item=courses.name";
$res=mysqli_query($con, $sql)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="d-flex p-2 justify-content-center">
        <h1>Certificate form <span class="badge badge-secondary">New</span></h1>
    </div>
    <div class="container">

        <form action="" method="POST">
            <?php for ($i = 0; $i <= $value; $i++) : ?>
                <div class="form-group">
                    <label >Name On Cert<?= $i ?></label>
                    <input type="text" class="form-control" name="name[]" placeholder="">
                </div>
                <div class="form-group">
                    <label >Email <?= $i ?></label>
                    <input type="text" class="form-control" name="email[]" placeholder="">
                </div>
            <?php endfor; ?>
            <div class="form-group">
                    <label >Course Name</label>
                    <input type="text" class="form-control" name="coursename" value="<?php echo $item; ?>">
                </div> <div class="form-group">
                    <label >Instructor Name</label>
                    <input type="text" class="form-control" name="instructorname" value="<?php echo $instructor_name; ?>">
                </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

</html>