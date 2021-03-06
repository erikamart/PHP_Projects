<?php
    require_once '..\functions.php';

    // connect to the database
    $conn = mysqli_connect("localhost", "root", "",'chinook');
        // check to see if the connection worked and display error if not
        if (!$conn) {
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
        }

    // Define the title variable
    $pageTitle = "Part 3, Section III: Update Form";
    // Call writeHead passing the title variable in
    writeHead($pageTitle);

    // Initialize the variables for the sticky form fields
    $Name = NULL;             
    $albumList = NULL;
    $composer = NULL;        
    $milliseconds = NULL;       
    $bytes = NULL;       
    $unitPrice = NULL;

    // Initialize variables for errors in form fields       
    $errorName = NULL;
    $errorNameReq = NULL;
    $errorComposerReq = NULL;
    $errorMilliseconds = NULL;
    $errorMillisecondsReq = NULL;
    $errorBytesReq = NULL;
    $errorUnitPrice = NULL;
    $errorUnitPriceReq = NULL;

    // check to see if the form has been submitted and if so write out the data
    if (isset($_POST['update'])){
        // set the validation flag
         $valid = true;

    // retrieve values from the form.
    
    $trackI = $_POST['trackI'];

    // check if Name field is blank and require an entry
    $Name = mysqli_real_escape_string($conn, trim($_POST['Name']));
    if (empty($Name)) {
        $errorName = "<p class='error'>Please enter a Name</p>";
        $valid = false;
    }
    // check the Name field entry for up to a maximum of 200 characters
    if (!preg_match('/^.{1,200}$/', $Name)) {
        $errorNameReq = "<p class='error'>Please enter a maximum of 200 characters.</p>";
        $valid = false;
    }
    // show the album data in the drop down list
    $albumList = $_POST['albumList'];

    // check if Composer field is blank but leave optional
    $composer = mysqli_real_escape_string($conn, trim($_POST['composer']));
    // check the Composer field entry for up to a maximum of 220 characters
    if (!preg_match('/^.{1,220}$/', $composer)) {
        $errorComposerReq = "<p class='error'>Please enter a maximum of 220 characters.</p>";
        $valid = false;
    }
    // check if Milliseconds field is blank and make required
    $milliseconds = mysqli_real_escape_string($conn, floor (trim ($_POST['milliseconds']) ) );
    if (empty($milliseconds)) {
        $errorMilliseconds = "<p class='error'>Please enter Milliseconds</p>";
        $valid = false;
    }
    // check if Bytes field is blank but leave optional
    $bytes = mysqli_real_escape_string($conn, floor (trim ($_POST['bytes']) ) );
    // check if Bytes field is an integer
    if (empty($bytes)) {
        $errorBytes = "<p class='error'>Enter a whole number</p>";
        $valid = false;
    }
    // check if UnitPrice field is blank and require an entry
    $unitPrice = mysqli_real_escape_string($conn, trim($_POST['unitPrice']));
    if (empty($unitPrice)) {
        $errorUnitPrice = "<p class='error'>Please enter a Unit Price</p>";
        $valid = false;
    }
    // check if UnitPrice field is a decimal
    if (!is_float($unitPrice)) {
        $valid = false;
    }
    // check the UnitPrice field entry for 2 decimal places and a maximum 99,999,999.99
    if ( (preg_match('/^[0-9]{1,8}\.[0-9]{0,2}$/', $unitPrice))  ||  (preg_match('/^[0-9]{1,8}$/', $unitPrice)) ) {
        $unitPrice = number_format($unitPrice, 2);
        $valid = true;
    } else {
        $errorUnitPriceReq = "<p class='error'>Please enter a price in the following format: ###.## (ex: 9.99).</p>";
        $valid = false;
    }

    //if the data is valid, transfer to display page and send data via the querystring
    if ($valid) {
        $query = "update track set Name='$Name', AlbumId='$albumList', MediaTypeId='2', GenreId='1', Composer='$composer', Milliseconds='$milliseconds', Bytes='$bytes', UnitPrice='$unitPrice' where TrackId=$trackI";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn)>0) {
//              debugging tools below.  be sure to comment out the page re-directs (104 & 105) to view results
//				print_r($_POST);
//				echo "<br>Track I is $trackI<br>";
                header("Location: part3.php?action=updated&id=$trackI");
                exit();
            }
    }
}  // end form submittal check and data processing
    else {
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
            echo "<p class='error'>Unable to retrieve Track ID $trackI. <a href='part3.php'>Return to diplay page.</a>";
        }
    }
?>

<div id="contentDiv">
    <form method="post" action="part3Update.php">
        <p>
            <input type="hidden" name="trackI" id="trackI" value="<?php echo $trackI; ?>">

            <?php echo $errorName;?>
            <?php echo $errorNameReq;?>
            <label for="Name">Name: </label>
            <input type="text" name="Name" id="Name" value="<?php echo $Name; ?>">
        </p>
        <p>
            <label for="albumList">Album: </label>
            <select name="albumList" id="albumList">
                <?php
                // create query to populate dropdown list with the AlbumId and Title from the album table
                $queryAlbum = "Select AlbumId, Title from album";
                // run the query or kill it if there's a connection error OR error in the result set
                $resultAlbum = mysqli_query($conn,$queryAlbum) or die(mysqli_error($conn));
                    // check for results
                    if (mysqli_num_rows($resultAlbum)> 0) {
                        // loop through results and display the data
                        while ($row = mysqli_fetch_assoc($resultAlbum)) {
                            echo "<option value=".$row['AlbumId']."";
                            // check to see if the Track Id matches the Track Id for this selection.
                            if ($albumList == $row['AlbumId']) {
                                echo " selected";
                            }
                            echo ">".$row['Title']."</option>\n";
                        } // end of while
                    } // end of if
                ?>
            </select>
        </p>
        <p>
            <?php echo $errorComposerReq;?>
            <label for="composer">Composer: </label>
            <input type="text" name="composer" id="composer" value="<?php echo $composer; ?>">
        </p>
        <p>
            <?php echo $errorMilliseconds;?>
            <?php echo $errorMillisecondsReq;?>
            <label for="milliseconds">Milliseconds: </label>
            <input type="number" min="1" name="milliseconds" id="milliseconds"  value="<?php echo $milliseconds; ?>">
        </p>
        <p>
            <?php echo $errorBytesReq;?>
            <label for="bytes">Bytes: </label>
            <input type="number" min="1" name="bytes" id="bytes" value="<?php echo $bytes; ?>">
        </p>
        <p>
            <?php echo $errorUnitPrice;?>
            <?php echo $errorUnitPriceReq;?>
            <label for="unitPrice">Unit Price: $</label>
            <input type="text" name="unitPrice" id="unitPrice" value="<?php echo $unitPrice; ?>">
        </p>

        <p>
            <input type="submit" name="update" value="Update Track">
        </p>

    </form>

<!-- footer and html closing tags embedded -->
<?php
// Define the foot variable
$pageFoot = "Part 3, Section III: Update Form";
//call the writeFoot function to write out the footer information
writeFoot($pageFoot); 
?>