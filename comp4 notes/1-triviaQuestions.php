<?php
session_start();
require_once 'functions.php';
$pageTitle = "Comp 4: Trivia Questions";
writeHead($pageTitle);


$Name = NULL;
$errorName = NULL;
$msg = NULL;


if (isset($_COOKIE['coupon'])) {
        // check to see if a cookie called coupon exists and if so, display an error
        echo "<h3>You've already completed the quiz!</h3>";
		exit();
}

// create the questNo variable with a value of 1 and another session variable called tries and set it to 0
if(!isset($_SESSION['questNo'])){
	$_SESSION['questNo'] = 1;
	$_SESSION['tries'] = 0;
	
} else {  // if questNo is > 5, display an error that quiz is complete and end the script
	if($_SESSION['questNo'] > 4){
		// create coupon cookie
		echo "<h3>You've already completed the quiz!</h3>";
		echo '<p><a href= "comp4Coupon.php?reset">Get my coupon</a></p>';
		exit();
	} else{  // otherwise add 1 to the tries session variable
		$_SESSION['tries'] += 1;
	}
}


//debugging session
echo "Session: <pre>";
print_r($_SESSION);
echo "</pre>";
//debugging post
echo "Post: <pre>";
print_r($_POST);
echo "</pre>";

if(isset($_POST['submit'])){
	if($_POST['Name'] == $_SESSION['Name']){
		//generate a new question
		$_SESSION['tries'] = 0;
		$_SESSION['questNo'] += 1;
		$msg = "<h3>That's correct! Here's another question...</h3>";
	} elseif ($_SESSION['tries'] > 2){
		$msg = "<h3>Sorry you lose. Try again...</h3>";
		echo '<p><a href= "comp4.php?reset">Reset Game</a></p>';
		exit();
	} else {
		$msg = "<h3>That's not correct! Try again...</h3>";
	}
}

if($_SESSION['tries'] == 0){
	//get album name from database
	// connect to the database
    $conn = mysqli_connect("localhost", "phpstudent", "Itse1406",'chinook');

    //create query
	$getAlbum = rand(1, 347);
	$query = "SELECT `Title`, `Name` FROM `album`, `artist` WHERE `album`.`ArtistId` = `artist`.`ArtistId` AND `AlbumId` = $getAlbum";
	
	//run query
	$result = mysqli_query($conn, $query);
	//check for errors
	if (!$result) {
		die(mysqli_error($conn));
	}

	//check for results
	if (mysqli_num_rows($result) == 1) {
        // loop through results and save in 2 session variables
        $row = mysqli_fetch_assoc($result);
		$_SESSION['Title'] = $row['Title'];
		$_SESSION['Name'] = $row['Name'];
	}
}

echo "Album title: ".$_SESSION['Title'];
echo "<p>Artist name: ".$_SESSION['Name']."</p>";

echo '<p><a href= "comp4.php?reset">Reset Game</a></p>';

?> <!-- end form submittal check and data processing -->



<hr>
<div id="contentDiv">
        <form method="post" action="triviaQuestions.php">

            <p>
				<?php echo $msg; ?>
			</p>
			<p>
				<?php echo "The Album is: <strong>".$_SESSION['Title']."</strong>"; ?>
	        </p>
            <p>
                <?php echo $errorName; ?>
                <label for="Name">The Artist is: </label>
                <input type="text" name="Name" id="Name" value="" size="100">
            </p>
			<p>
				<input type="submit" name="submit" value="Submit">
			</p>
        </form>
</div>
<!-- footer and html closing tags embedded -->

<?php
$pageFoot = "Competency 4 Part II: Trivia Questions";
writeFoot($pageFoot);
?>