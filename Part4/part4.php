<?php
session_start();
require_once '..\functions.php';

// initialize variables
$email = $errorEmail = $valid = "";

if (isset($_POST['startQuiz'])){
	
	$valid = TRUE;

	// email validation
	if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
		$errorEmail = "<p class='error'>Email is not valid.</p>";
		$valid = FALSE;
	} // end email validation

	// if email passes validation
	if($valid == TRUE){
        if (isset($_COOKIE['coupon'])) {
            // check to see if a cookie called 'coupon' exists and if so, display an error
            echo "<h1>You have already completed the quiz!</h1>";
            exit();
        } else { // create a cookie called 'coupon' and store the email address in it. 
        		 // the cookie should expire in 14 days. 
        	$email = $_POST['email'];
            setcookie('coupon', $email, time() + 60 * 60 * 24 * 14);
            // transfer to the triviaQuestions page.
			header ('Location: triviaQuestions.php');
        }
	} // end cookie validation
} // end startQuiz validation

$pageTitle = "Part 4, Section I: Trivia Registration Form";
writeHead($pageTitle);
?> <!-- end form submittal check and data processing -->


<div id="contentDiv">

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

		<p>
			<h3>Ready for a trivia quiz!? You will have 3 tries to answer each question.
			There's a 20 minute time limit. If you successfully answer 3 questions, you 
			will receive a coupon code good for 25% off your next order. 
			Enter your email below to start.</h3>
		</p>
		<p> 
			<?php echo $errorEmail;?>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" value="<?php echo $email; ?>">
		</p>
        <p>
            <input type="submit" name="startQuiz" value="Start Quiz">
        </p>
    </form>
</div>

<!-- footer and html closing tags embedded -->
<?php
$pageFoot = "Part 4, Section I: Trivia Registration Form";
writeFoot($pageFoot);
?>