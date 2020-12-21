<?php
require('top.php');

error_reporting(0);
$id = $_GET['id'];
$stmt = "SELECT a.name as username, a.email as useremail, a.phonenum as phonenum, b.idinvoice as invoiceid, b.item as itemname,";
$stmt .= "b.totalprice as totalprice, b.quantity as quantity, b.dates FROM users_front a INNER JOIN invoice b ON a.id=b.userID order by idinvoice desc";

$qry = mysqli_query($con, $stmt);


while ($row = mysqli_fetch_assoc($qry)) :
    $inv_arr[] = $row;
endwhile;

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status="update categories set status='$status' where id='$id'";
		mysqli_query($con,$update_status);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from categories where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}
		
$sql="select * from invoice";
$res=mysqli_query($con,$sql);
?>

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">INVOICE ISSUED</h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
			  <a href="add_categories.php" style= "float: right;" class="btn btn-success">               	
                <span class="text">+ Add Categories</span>
			  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th scope="col">Invoice ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inv_arr as $invoices) : ?>
                        <tr>
                            <th scope="row"><?= $invoices['invoiceid'] ?></th>
                            <td><?= $invoices['username'] ?></td>
                            <td><?= $invoices['itemname'] ?></td>
                            <td><?= $invoices['quantity'] ?></td>
                            <td><?= $invoices['totalprice'] ?></td>
                            <td><?= $invoices['dates'] ?></td>
                            <td><a class="btn btn-danger" href="../gen_invoice.php?id=<?= $invoices['invoiceid'] ?>" role="button">Show</a></td>
                        </tr>
                    <?php endforeach; ?>
		
                      
					
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
	  

<?php
	require('footer.php');
?>