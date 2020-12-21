<?php
require('top.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from categories where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['categories'];
	}else{
		?>
		<script type="text/javascript">
			window.location.href = 'categories.php';
		</script>
<?php
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['categories']);
	
	$res=mysqli_query($con,"select * from categories where categories='$categories'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id-$getData['id']){
			
			}else{
				$msg="Category already exists";
			}
		}else{
			$msg="Category already exists";
		}
	}
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update categories set categories='$categories' where id='$id'");
		}else{
			mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
		}
		?>
		<script type="text/javascript">
			window.location.href = 'categories.php';
		</script>
<?php
	
	}
}


?>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Categories</h1>
		  <form method="post">
	      <hr>
	      <div class="instr">	
    	    
    		<label for="name"><b>Category</b></label>
    		<input type="text" placeholder="Enter Category" name="categories" id="name" required value="<?php echo $categories ?>">
			<button type="submit" name="submit" style="text-align: center;"class="btn btn-success btn-icon-split">               	
				<span class="text">Submit</span> 
			</button>
			<div style="color:red; margin: 5px;"><?php echo $msg ?></div>
		</div>
		</form>
		<br><br><br><br><br><br>
       
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<?php
	require('footer.php');
?>