<?php
session_start();
require_once '..\functions.php';

/********************************************************************************
 *    Quiz structure rules: 3 tries to answer each question.                     *
 *    There's a 20 minute time limit to answer them all.                         *
 *    If 3 question are answered correctly, winner gets a 25% off coupon code.   *
 ********************************************************************************/
// define variables
$artistName = $errorName = $errorAnswer = NULL;

if (isset($_COOKIE['coupon'])) {
    // check to see if a cookie called coupon exists
    // check if quiz has already been done
    // if either is true display a message and redirect to coupon
    echo "<h3>You've already done the quiz!</h3>";
    echo "<h3><p><a href= 'part4Coupon.php'>Click here for your coupon</a></p></h3>";
}

// connect to the database************************************************************************************
$conn = mysqli_connect("localhost", "root", "","chinook");

//create a query to request data by selecting the ArtistId randomly from 1 to 300
$getAlbum = rand(1, 300);
$query = "SELECT `Title`, `Name` FROM `album`, `artist` WHERE `album`.`ArtistId` = `artist`.`ArtistId` AND `AlbumId` = $getAlbum";

//run query
$result = mysqli_query($conn, $query);
//check for errors
if (!$result) {
    die("Database access failed: " .mysqli_error($conn));
}

/****************************************************************************************
*  COMMENTING OUT LINES 46-51 PREVENTS THE PAGE FROM RELOADING NEW QUESTIONS            *
*  BUT THEN HOW DO YOU STORE THE CURRENT DATABASE VALUES IN THE SESSION VARIABLES??     *
*  AND HOW DO YOU MOVE ON TO THE NEXT QUESTION IF IT'S ANSWERED CORRECTLY?              *
*****************************************************************************************/
//check for results
if (mysqli_num_rows($result) == 1) {
    // loop through results and save in 2 session variables
    $row = mysqli_fetch_assoc($result);
    $_SESSION['Title'] = $row['Title'];
    $_SESSION['Name'] = $row['Name'];
}
//************************************************************************************************************
 

if(!isset($_SESSION['questNo'])){
    /* define session variables: 'questNo', 'tries', and 'artistName' with appropriate start values*/
    $_SESSION['questNo'] = 1;
    $_SESSION['tries'] = 0;
    $_SESSION['artistName'] = $artistName;
}

// if 'submit' is clicked
if(isset($_POST['submit'])){
    $valid = TRUE;

    // check if artist name field is blank and change valid flag if so
    if (empty($_POST['artistName'])) {
        $errorName = "<p class='error'>Please enter an Artist Name</p>";
        $valid = FALSE;
    } 

    if($valid == TRUE){
        if ($_SESSION['questNo'] <= 2) {
            
            // compare the user input to the real artist name. if right add 1 to 'questNo' & reset 'tries'
            // for testing, change $_SESSION['Title'] to $_SESSION['artistName']
            if ($_SESSION['Title'] == $_SESSION['artistName']){
                $_SESSION['questNo'] += 1;
                $_SESSION['tries'] = 0;
            } else {
                // add 1 to the tries session variable & give error for wrong answer
                $_SESSION['tries'] += 1;

                if ($_SESSION['tries'] <= 2) {
                    $chances = 3 - $_SESSION['tries'];
                    $errorAnswer = "<p class='error'>Incorrect! You have " .$chances. " chance(s) left.</p>";
                    
                } else {
                    echo "<h3><p>Sorry, you've tried too many times.  Game Over.</p></h3>";
                    exit;
                } //end of game over else
            } // end of 'tries' else
        } elseif ($_SESSION['questNo'] >= 3){
            echo "<h3><p><a href= 'part4Coupon.php'>You Win! Click here for your coupon</a></p></h3>";
        }
    } // end of valid for blank field
} //end of submit POST


//debugging session
echo "Session: <pre>";
print_r($_SESSION);
echo "</pre>";

//debugging post
echo "Post: <pre>";
print_r($_POST);
echo "</pre>";

echo "<p><a href= 'part4.php?reset'>Reset Game</a></p>";


// HTML header is in functions.php file
$pageTitle = "Part 4, Section II: Trivia Questions Form";
writeHead($pageTitle);
?> <!-- end form submittal check and data processing -->


<div id="contentDiv">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<p>
			<?php echo "Who is the artist of the album: ".$_SESSION['Title']; ?>
        </p>
        <p>
            <?php echo $errorName; ?>
            <?php echo $errorAnswer; ?>
            <label for="artistName"> The Artist is: </label>
            <input type="text" name="artistName" id="artistName" value="<?php echo trim(htmlspecialchars($artistName)); ?>">
        </p>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
</div>
<!-- footer and html closing tags embedded -->

<?php
// HTML footer is in functions.php file
$pageFoot = "Part 4, Section II: Trivia Questions Form";
writeFoot($pageFoot);
?>