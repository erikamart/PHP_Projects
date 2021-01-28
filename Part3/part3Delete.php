<?php
    require_once '..\functions.php';

    // connect to the database
    $conn = mysqli_connect("localhost", "root", "",'chinook');
        // check to see if the connection worked and display error if not
        if (!$conn) {
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
        }

    // Define the title variable
    $pageTitle = "Part 3, Section IV: Delete Form";
    // Call writeHead passing the title variable in
    writeHead($pageTitle);

    // check to see if the form has been submitted and if so write out the data
    if (isset($_POST['deleted'])){  
		$trackI = $_POST['trackI'];
        $query = "delete from track where TrackId=$trackI";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn)>0) {
//              debugging tools below.  be sure to comment out the page re-directs (104 & 105) to view results
//				print_r($_POST);
//				echo "<br>Track I is $trackI<br>";
                header("Location: part3.php?action=deleted&id=$trackI");
                exit();
            }
			echo "<p class='error'>Unable to delete record</p>";
    } else {
        // if the form was not submitted, get the id from the querystring and retrieve the data from the database
        if (!isset($_GET['id'])) {
            echo "<p class='error'>No Track ID provided. <a href='part3.php'>Return to display page.</a>";
        }
        $trackI = $_GET['id'];
        $query = "Select * from track where TrackId= $trackI";
        $result = mysqli_query($conn,$query);
        if (!$result) {
            die(mysqli_error($conn));
        }
        // check for results
        if (mysqli_num_rows($result)>0){
            // retrieve result row
            $row = mysqli_fetch_assoc($result);
            $Name = $row['Name'];          
            $albumList = $row['AlbumId'];
            $composer = $row['Composer'];      
            $milliseconds = $row['Milliseconds'];  
            $bytes = $row['Bytes'];     
            $unitPrice = $row['UnitPrice'];
        } else {
            echo "<p class='error'>Unable to retrieve Track ID $trackI. <a href='part3.php'>Return to diplay page</a>";
        }
    }
?>

<div id="contentDiv">
    <form method="post" action="part3Delete.php">
        <p>
            <input type="hidden" name="trackI" id="trackI" value="<?php echo $trackI; ?>">
			<input type="submit" name="deleted" value="Confirm Delete">
		</p>
	</form>
    <p><a href='part3.php'>Return to diplay page</a></p>

<!-- footer and html closing tags embedded -->
<?php
// Define the foot variable
$pageFoot = "Part 3, Section IV: Delete Form";
//call the writeFoot function to write out the footer information
writeFoot($pageFoot); 
?>