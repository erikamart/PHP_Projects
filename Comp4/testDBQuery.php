<?php
session_start();
require_once '..\functions.php';

/****************************************************************
This file is just testing the raw form and database connection. 
No Processing other than storing session variables is done.
******************************************************************/

$artistName = $errorName = $errorAnswer = NULL;

// Connect to the database************************************************************************************
$conn = mysqli_connect("localhost", "root", "","chinook");

//create query to request data by selecting the ArtistId randomly from 1 to 300
$getAlbum = rand(1, 300);
$query = "SELECT `Title`, `Name` FROM `album`, `artist` WHERE `album`.`ArtistId` = `artist`.`ArtistId` AND `AlbumId` = $getAlbum";

//run query
$result = mysqli_query($conn, $query);
//check for errors
if (!$result) {
    die("Database access failed: " .mysqli_error($conn));
}
// //check for results
while ($row = mysqli_fetch_assoc($result)) {
    // loop through results and save in 2 session variables
    $_SESSION['Title'] = $row['Title'];
    $_SESSION['Name'] = $row['Name'];
 }
 mysqli_close($conn);
//***************************************************************************************************************


//debugging session
echo "Session: <pre>";
print_r($_SESSION);
echo "</pre>";

//debugging post
echo "Post: <pre>";
print_r($_POST);
echo "</pre>";


$pageTitle = "Part II: Trivia Questions";
writeHead($pageTitle);
?> <!-- end of php block  -->

<!-- HTML FORM BODY. Header & footer is in functions.php file************-->
<div id="contentDiv">
    <form method="post" action="">
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
<!-- HTML FORM BODY -->

<?php
$pageFoot = "Part II: Trivia Questions";
writeFoot($pageFoot);
?>