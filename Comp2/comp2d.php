<?php
require_once '..\functions.php';

// Initialize the variables for the sticky form fields
$albumId = NULL;
$artistName = NULL;       
$albumName = NULL;        

// Initialize variables for errors in form fields		
$errorAlbumId = NULL;
$errorAlbumIdreq = NULL;
$errorArtistName = NULL;
$errorAlbumName = NULL;
$err_UploadError = NULL;
$err_UploadDouble = NULL;
$err_UploadInvalid = NULL;
    
// Define the title variable
$pageTitle = "Comp2d";
// Call writeHead passing the title variable in
writeHead($pageTitle);
		
// check to see if the form has been submitted if so write out the data.
if (isset($_POST['submit'])) {
// set the validation flag
$valid = true;
		
    // retrieve the values from the form. 		
        // remove whitespace and htmlspecialchars to avoid security issues
        $albumId =trim($_POST['albumId']);
        if (empty($albumId)) {
            $errorAlbumId = "<p class='error'>Please enter an Album ID</p>";
            $valid = false;
        }
        // required to have 2 uppercase letters and 3 numbers using regex
		if(!preg_match('/^[A-Z]{2}[0-9]{3}$/', $albumId)) {
            $errorAlbumIdreq = "<p class='error'>Please enter at least 2 uppercase letters and 3 numbers.</p>";
            $valid = false;
		}

        // remove whitespace and htmlspecialchars to avoid security issues
		// convert artist name to lower case and capitalize the first letter of each word
        $artistName = htmlspecialchars(ucwords(strtolower(trim($_POST['artistName']))));
        if (empty($artistName)) {
            $errorArtistName = "<p class='error'>Please enter an Artist Name</p>";
            $valid = false;
        }

        // remove whitespace and htmlspecialchars to avoid security issues
        $albumName = htmlspecialchars(trim($_POST['albumName']));
        if (empty($albumName)) {
            $errorAlbumName = "<p class='error'>Please enter an Album Name</p>";
            $valid = false;
        }

    $filetype = pathinfo($_FILES['Upload']['name'],PATHINFO_EXTENSION);   

    if ( (($filetype == "gif") || ($filetype == "jpg") || ($filetype == "png")) && $_FILES['Upload']['size'] < 20000 ) {
        if ($_FILES["Upload"]["error"] > 0) {
            $err_UploadError = $_FILES["Upload"]["error"];
            $valid = false;
        } else if (file_exists("uploads/" . $_FILES["Upload"]["name"])) {
            $err_UploadDouble = '<div class="error">File already exists</div>';
            $valid = false; 
        } 
    } else {
        $err_UploadInvalid = '<div class="error">Invalid file</div>';
        $valid = false;
    }

        // if the data is valid, transfer to another page and send data via the querystring
        if ($valid) {
            header("Location: comp2b.php?albumId=$albumId&artistName=$artistName&albumName=$albumName");
            exit();
        }
    }  // end form submittal check and data processing
?>


<div id="contentDiv">
    <form method="post" action="comp2d.php">
        <p>
            <?php echo $errorAlbumId;?>
			<?php echo $errorAlbumIdreq;?>
            <label for="albumId">Album ID: </label>
            <input type="text" name="albumId" id="albumId" value="<?php echo $albumId; ?>">
        </p>
        <p>
            <?php echo $errorArtistName;?>
            <label for="artistName">Artist Name: </label>
            <input type="text" name="artistName" id="artistName" value="<?php echo $artistName; ?>">
        </p>
        <p>
            <?php echo $errorAlbumName;?>
            <label for="albumName">Album Name: </label>
            <input type="text" name="albumName" id="albumName" value="<?php echo $albumName; ?>">
        </p>
        <p>
            <?php echo $err_UploadError;?>
            <?php echo $err_UploadDouble;?>
            <?php echo $err_UploadInvalid;?>
            <label for="Upload">Upload album image</label>          
            <input type="file" name="Upload" id="Upload">
        </p>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
</div>
<!-- footer and html closing tags embedded -->
<?php
// Define the foot variable
$pageFoot = "Competency 2 Desired";
//call the writeFoot function to write out the footer information
writeFoot($pageFoot); 
?>