<?php
require('config.php');
?>
<form action="complete.php" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishable_key?>"
		data-amount="<?= $total_price ?>00"
		data-name="Executive Education Programmes"
		data-description="Short Courses"
		data-image="image/logo.png"
		data-currency="myr"
	>
	</script>

</form>