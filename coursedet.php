<?php
require('top.php');
require('functions.php');
	$id=mysqli_real_escape_string($con, $_GET['id']);
	$get_product=get_product($con,'','',$id);

?>
<style>
	.card a{
	  display: block;
	  background: #6E2630;
	  color: #fff;
	  padding: 10px;
	  text-align: center;
	  text-decoration: none;
	  width: 180px;
	  margin-top: 20px;
	  margin-bottom: 50px;
	  margin-left: 20px;
	  margin-right: 20px;
	}
	
	.card a:hover {
	   box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
	} 
	.card select
	{
		width: 150px;
		margin-left:35px;
	}
	.card input
	{
		width: 110px;
	}
</style>
<body id="page-top">
  <!-- Navigation-->


  <div class="title">
    <h1 class="text-uppercase text-white font-weight-bold"> <?php echo $get_product[0]['name'] ?> </h1>
    <p>
      <?php echo $get_product[0]['description'] ?>
    </p>
    
    <br /><br />
  </div>
  <div class="details">
    <br />
    <h4>COURSE OVERVIEW</h4>
    <p>
      <?php echo $get_product[0]['overview'] ?><br /><br />
    </p>
	
	<h4>TARGET AUDIENCE</h4>
    <p>
      <?php echo $get_product[0]['audience_target'] ?><br /><br />
    </p>
	<?php if($get_product[0]['filename']!=='') {?>
	<a href="readpdf.php?name=<?= $get_product[0]['filename'] ?>">OPEN PDF FILE </a>
  </div>
	<?php } ?>

  <div class="card">
    <form method="post" action="">
      <h3 style="color: black">
        <?php echo $get_product[0]['name'] ?><br /><br /> RM <?php echo $get_product[0]['price'] ?><br /><br />DURATION:
        <?php echo $get_product[0]['duration'] ?> DAYS
      </h3>
	 
      <p>Quantity:</p>
      <select class="form-control" style="width: 80px; align:center;" id="quantity" name="quantity" required>
		<option>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
	  </select><br/>
	  <span class="field_error" id="quantity-error"></span>
	  
	  <p>Choose a date:</p>
      <select class="form-control" id="date" name="date">
        <option><?= $get_product[0]['dates'] ?></option>
        <option><?= $get_product[0]['dates2'] ?></option>
        <option><?= $get_product[0]['dates3'] ?></option>
        <option><?= $get_product[0]['dates4'] ?></option>
      </select>
	  
	  <a style="text-align: center;" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product[0]['id'] ?>','add')">ADD TO CART</a>
		
  </div>
  
  </form>

  
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
  <script src="js/cart.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</body>

</html>

