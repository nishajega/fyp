<?php 
require('header2.php');
?>
<style>
.error{
	color: red;
	font-style:italic;
}
</style>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">UNITEN EXECUTIVE EDUCATION PROGRAMMES</h1>
                        <hr class="divider my-4" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Build your skills with courses from one of Malaysia's top universities, UNITEN!</p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="course.html">Find Out More</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider light my-4" />
                        <p class="text-white-50 mb-4">UNITEN is a training provider registered with HRDF and MoF, and we are committed towards the development of the nation through knowledge and skills enhancement programmes. All courses are available for Public and In-house Training.
			We offer and manage professional services to create longterm value for the university from its customers, markets, and
			relationships with the local and global community.</p>
                        
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider my-4" />
                        <p class="text-muted mb-5">Ready to start your next project with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div>03-8928 7583<br>03-8928 7584</div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i
                        ><!-- Make sure to change the email address in BOTH the anchor text and the link target below!--><a class="d-block" href="mailto:harizatul@uniten.edu.my">harizatul@uniten.edu.my</a>
                    </div>
		    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-map-marker fa-3x mb-3 text-muted"></i>
                        <div>Executive, Business Development Department,
			Universiti Tenaga Nasional,
			Jalan IKRAM-UNITEN, 43000,
			Kajang, Selangor</div>	
                    </div>
                </div>
		<div class="container text-center">
				<a class="btn btn-light btn-xl" href="#enquiry">Enquire Now!</a>
            	</div>
            </div>
	</section>
	<!----Enquiry---->
	<section class="page-section bg-dark text-white" id="enquiry">
            <div class="container text-center">
		<h2 class="mb-4">Enquire Now!</h2>
		<hr class="divider my-4" />
		<form method="post" action="testmailer.php" name="myForm" id="myForm">
		<div class="enquiry">
		<div>
			<label for="name"><b>Name</b></label><br>
    		<input type="text" placeholder="Enter Name" name="name" id="name" required><br>
		</div>
		<div>
    		<label for="email"><b>Email</b></label><br>
    		<input type="text" placeholder="Enter Email" name="email" id="email" required><br>
		</div>
		<div>
    		<label for="phone"><b>Phone No.</b></label><br>
    		<input type="integer" placeholder="Enter Phone Number" name="phone" id="phone" required><br>
		</div>
		<div>
		<label for="ic"><b>Enquiry Subject</b></label><br>
    		<textarea placeholder="Type in your enquiry subject..." cols="30" rows="7" name="enquiry" id="enquiry" required></textarea><br>
			</div>
		<button type="submit" name="submit">Submit</button>
		</div>
	   </div>

        </section>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script type="text/javascript">
	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Space are not allowed");
	$.validator.addMethod("noNumeric", function(value, element){
		return this.optional(element) || value.match(/.*[a-zA-Z].*/);
	}, "Only alphabetic characters allowed");
	$.validator.addMethod("noEmail", function(value, element){
		return this.optional(element) || value.match(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	}, "Please enter a valid email address");
	// Wait for the DOM to be ready
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("#myForm").validate({
		onclick: true, 
		onkeyup: true,
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            name: {
                required: true,
				noNumeric: true,
				minlength:3,
				noSpace: true
            },
            email: {
				required:true,
				noSpace: true,
				noEmail: true
            },
			phone: {
                required: true,
                number: true,
				minlength:10,
				maxlength:11,
				noSpace: true
            },
            enquiry: {
                required: true,
				minlength:10,
				noSpace: true
            }
			
			},
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter name",
				noNumeric: "No numeric is allowed"
            },
            email: {
				required:"Please enter your email address",
                noEmail: "Provide valid email address"
            },
			phone: {
                required: "Please enter your phone num",
                number: "Enter numeric value only",
				minlength: "Enter valid phone number",
				maxlength: "Enter valid phone number"
            },
            enquiry: {
                required: "Enquiry content is required",
				enquiry: "Your enquiry must be at least 10 characters long"
            }
            
		},
		errorPlacement: function (error, element) {
            alert(error.html());
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function (form) {
            form.submit();
        }
	});
	</script>
<?php 
	require('footer.php')
?>