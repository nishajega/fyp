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
        <h1>How many students for cert? <span class="badge badge-secondary"></span></h1>
    </div>
    <div class="container">

        <form action="certificate_gen.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="value" placeholder="">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

</html>