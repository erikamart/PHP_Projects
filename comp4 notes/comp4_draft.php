<?php
// buffer the output
     ob_start();
	 $errorEmail = NULL;
	 
    require_once 'functions.php';
	//debugging
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
     // check to see if the form has been submitted
    if (isset($_POST['submit'])) {
		
		$valid = true;

        // Get the values from the form. 
		
		// check for email
        if (empty($email)) {
            $errorEmail =  "<p class='error'>Please enter your email</p>";
            $valid = false;
        }
	    // validate email using a regular expression
        if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/',$email)) {
            $errorEmail = "<p class='error'>Invalid email address</p>";
			$valid = false;
        }
if($valid){
        if (isset($_COOKIE['coupon'])) {
            // if coupon cookie is found, notify
            echo "<h1>You already won!</h1>";
			break;
        } else {
            setCookie('email', $email, time()+(60*60*24*14));
			header ('Location: triviaQuestions.php');
			break;
        }
}
	}
	
	
	
// the below is a copy of old file not altered yet

    writeHead("Desired Comp4: Cookie Coupon Check & Email");
   ?>

        <div>
            <form method='post' action=''>
            <p>
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            </p>
            <p>
            <p><a href="labcomp4-1cart.php">View Shopping Cart</a></p>
        </div>
        <?php writeFoot(); ?>






<?php
// random notes from displayed class files
if(filer_has_var(INPUT_POST, 'submit')) {
$email = filter_input(INPUT_POST, 'email');

if (email){

}
}


if($loadform == FALSE){
setCookie('emailCookie', $email, time() + (60*60*24*14))
}
?>