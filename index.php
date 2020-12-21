<?php 
require('header2.php');
?>
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
		<form method="post" action="testmailer.php">
		<div class="enquiry">
		<label for="name"><b>Name</b></label><br>
    		<input type="text" placeholder="Enter Name" name="name" id="name" required><br>

    		<label for="email"><b>Email</b></label><br>
    		<input type="text" placeholder="Enter Email" name="email" id="email" required><br>

    		<label for="phone"><b>Phone No.</b></label><br>
    		<input type="integer" placeholder="Enter Phone Number" name="phone" id="phone" required><br>

		<label for="ic"><b>Enquiry Subject</b></label><br>
    		<textarea placeholder="Type in your enquiry subject..." cols="30" rows="7" name="enquiry" id="enquiry" required></textarea><br>
		<button type="submit" name="submit">Submit</button>
		</div>
	   </div>

        </section>
		
<?php 
	require('footer.php')
?>