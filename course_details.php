<?php
require("top.php");
require("admin/functions.php");
$categories_id = '';
$name = '';
$description = '';
$overview = '';
$audience_limit = '';
$duration = '';
$price = '';
$dates = '';
$instructor_name = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = get_safe_value($con, $_GET['id']);
  $query = mysqli_query($con, "select * from courses where id='$id'");
  $check = mysqli_num_rows($query);
  if ($check > 0) {
    $row = mysqli_fetch_assoc($query);
    $categories_id = $row['categories_id'];
    $name = $row['name'];
    $description = $row['description'];
    $overview = $row['overview'];
    $audience_limit = $row['audience_limit'];
    $duration = $row['duration'];
    $price = $row['price'];
    $dates = $row['dates'];
    $dates2 = $row['dates2'];
    $dates3 = $row['dates3'];
    $dates4 = $row['dates4'];
    $instructor_name = $row['instructor_name'];
    $status = $row['status'];
    $filename = $row['filename'];
  } else {
?>
    <script type="text/javascript">
      window.location.href = 'course.php';
    </script>
<?php
  }
}
?>

<body id="page-top">
  <!-- Navigation-->


  <div class="title">
    <h1 class="text-uppercase text-white font-weight-bold"> <?php echo $name ?> </h1>
    <p>
      <?php echo $description ?>
    </p>
    
    <br /><br />
  </div>
  <div class="details">
    <br />
    <h4>COURSE OVERVIEW</h4>
    <p>
      <?php echo $overview ?><br /><br />
    </p>
	
	<button><a href="readpdf.php?name=<?= $filename ?>">OPEN PDF FILE </a></button>
  </div>

  <div class="card">
    <form method="post" action="cart.php?action=add&pid=<?php echo $row["id"]; ?>">
      <h3 style="color: black">
        <?php echo $name ?><br /><br /> RM <?php echo $price ?><br /><br />DURATION:
        <?php echo $duration ?> DAYS
      </h3>
      <p>Choose a date:</p>
      <select class="form-control" style= id="dates" name="dates">
        <option value="<?= $dates ?>"><?= $dates ?></option>
        <option value="<?= $dates2 ?>"><?= $dates2 ?></option>
        <option value="<?= $dates3 ?>"><?= $dates3 ?></option>
        <option value="<?= $dates4 ?>"><?= $dates4 ?></option>
      </select>
      <p>Choose quantity:</p>
      <input class="form-control" type="text" class="product-quantity" name="quantity" id="quantity" value="1" size="2"/>
      <button type='submit' name='add' class='btn btn-success' style="text-align: center;">ADD TO CART</button>
  </div>
  </form>
  </div>
  <!-- Footer-->
  <footer class="">
    <div class="container">

    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>

