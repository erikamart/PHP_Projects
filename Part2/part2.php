<?php
require_once '..\functions.php';

// Initialize the variables for the sticky form fields
$albumId = NULL;
$artistName = NULL;       
$albumName = NULL;        
$price = NULL;       
$type = NULL;        
$playlists[0] = NULL;       
$genre = NULL;       
$tracks = NULL;

// Initialize variables for errors in form fields		
$errorAlbumId = NULL;
$errorAlbumIdreq = NULL;
$errorArtistName = NULL;
$errorAlbumName = NULL;
$errorPrice = NULL;
$errorPricereq = NULL;
$errorFiletype = NULL;
$errorPlaylists = NULL;
$errorGenre = NULL;
$errorTracks = NULL;
    
// Define the title variable
$pageTitle = "Part2 User Form";
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
        // remove whitespace and htmlspecialchars to avoid security issues
        $price = htmlspecialchars(trim($_POST['price']));
		// test price to make sure it is numeric
        if (!is_numeric($price)) {
            $errorPrice = "<p class='error'>Please enter a Price</p>";
            $valid = false;
        }
        // force input to be 1-3 digits to left of decimal and 2 to right
        if((preg_match('/^[0-9]{1,3}\.[0-9]{0,2}$/', $price))  ||  (preg_match('/^[0-9]{1,3}$/', $price))) {
            $price = number_format($price, 2);
            $valid = true;
        } else {
            $errorPricereq = "<p class='error'>Please enter a price in the following format: ###.## (ex: 9.99).</p>";
            $valid = false;
        }

        // Use isset to test if the user selected one of the available options.
        if (isset($_POST['filetype'])) {
            // if set, get the type.
            $type = $_POST['filetype'];
        } else {
            $errorFiletype = "<p class='error'>Please select a File Type</p>";
            $type = "";
            $valid = false;
        }
        // for the playlists checkboxes, use isset to test if the user selected at least one.
        if (isset($_POST['playlists'])) {
            // if set, get the playlists. They could select more than one, so an array is used.
            $playlists = $_POST['playlists'];
        } else {
            $errorPlaylists = "<p class='error'>Please select at least one Playlist</p>";
            $playlists[0] = "";
            $valid = false;
        }

        $genre = $_POST['genre'];
        if ($genre == "") {
            $errorGenre = "<p class='error'>Please select a Genre</p>";
            $valid = false;
        }            
        $tracks = $_POST['tracks'];
        if (empty($tracks)) {
            $errorTracks = "<p class='error'>Please enter a track number 1 thru 50</p>";
            $valid = false;
        }
        // if the data is valid, transfer to another page and send data via the querystring
        if ($valid) {
            header("Location: part2b.php?albumId=$albumId&artistName=$artistName&albumName=$albumName");
            exit();
        } // end of valid if
    }  // end form submittal check and data processing
?>


<div id="contentDiv">
    <form method="post" action="part2.php">
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
            <?php echo $errorPrice;?>
            <?php echo $errorPricereq;?>
            <label for="price">Price: </label>
            <input type="text" name="price" id="price"  value="<?php echo $price; ?>">
        </p>

        <!-- radio button menu -->
        <p class="tab">
            <?php echo $errorFiletype;?>
            <input type="radio" name="filetype" id="MPEG" value="MPEG"
             <?php
             // test the value of the form input to see if the radio button should be checked
             if ($type == "MPEG") {echo "checked";} ?>>
            <label for="MPEG">MPEG audio file</label>
            
            <input type="radio" name="filetype" id="protectedAAC" value="protectedAAC" 
            <?php if ($type == "protectedAAC") {echo "checked";} ?>>
            <label for="protectedAAC">Protected AAC audio file</label>
            
            <input type="radio" name="filetype" id="MPEG4" value="MPEG4" 
            <?php if ($type == "MPEG4") {echo "checked";} ?>>
            <label for="MPEG4">Protected MPEG-4 video file</label>
                            
            <input type="radio" name="filetype" id="purchasedAAC" value="purchasedAAC" 
            <?php if ($type == "purchasedAAC") {echo "checked";} ?>>
            <label for="purchasedAAC">Purchased AAC audio file</label>
            
            <input type="radio" name="filetype" id="AAC" value="AAC" 
            <?php if ($type == "AAC") {echo "checked";} ?>>
            <label for="AAC">AAC audio file</label>
        </p>

        <!-- check box menu -->
        <p class="tab">
            <?php echo $errorPlaylists;?>
            <input type="checkbox" name="playlists[]" id="dancing" value="dancing"
             <?php
             // loop through the array for found checkbox value and if checkbox should be checked
             foreach ($playlists as $playlist) {
             if ($playlist == "dancing") {echo "checked";}} ?>>
            <label for="dancing">Dancing</label>
            
            <input type="checkbox" name="playlists[]" id="beachBar" value="beachBar"
             <?php
              foreach ($playlists as $playlist) {
             if ($playlist == "beachBar") {echo "checked";}} ?>>
            <label for="beachBar">Beach Bar</label>

            <input type="checkbox" name="playlists[]" id="workout" value="workout"
             <?php
             foreach ($playlists as $playlist) {
             if ($playlist == "workout") {echo "checked";}} ?>>
            <label for="workout">Workout</label>
            
            <input type="checkbox" name="playlists[]" id="studying" value="studying"
             <?php
             foreach ($playlists as $playlist) {
             if ($playlist == "studying") {echo "checked";}} ?>>
            <label for="studying">Studying</label>
            
            <input type="checkbox" name="playlists[]" id="party" value="party"
             <?php
             foreach ($playlists as $playlist) {
             if ($playlist == "party") {echo "checked";}} ?>>
            <label for="party">Party</label>    
        </p>

        <!-- drop down menu-->
        <p>
            <?php echo $errorGenre;?>
            <label for="genre">Genre: </label>
            <select name="genre" id="genre">
                <option value="">Select a Genre</option>

                <option value="rock" <?php if ($genre == "rock") { echo "selected";} ?> >Rock</option>
                
                <option value="jazzA" <?php if ($genre == "jazzA") { echo "selected";} ?> >Jazz A</option>

                <option value="metal" <?php if ($genre == "metal") { echo "selected";} ?> >Metal</option>

                <option value="alternativeP" <?php if ($genre == "alternativeP") { echo "selected";} ?> >Alternative Punk</option>
                
                <option value="jazzB" <?php if ($genre == "jazzB") { echo "selected";} ?> >Jazz B</option>
                
                <option value="blues" <?php if ($genre == "blues") { echo "selected";} ?> >Blues</option>

                <option value="latin" <?php if ($genre == "latin") { echo "selected";} ?> >Latin</option>

                <option value="reggae" <?php if ($genre == "reggae") { echo "selected";} ?> >Reggae</option>
                
                <option value="pop" <?php if ($genre == "pop") { echo "selected";} ?> >Pop</option>
                
                <option value="soundtrack" <?php if ($genre=="soundtrack") { echo "selected";} ?> >Soundtrack</option>
            </select>
        </p>

        <p>
            <?php echo $errorTracks;?>
            <label for="tracks">Tracks: </label>
            <input type="number" min="1" max="50" name="tracks" id="tracks" value="<?php echo $tracks; ?>">
        </p>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
</div>

<!-- footer and html closing tags embedded -->
<?php
// Define the foot variable
$pageFoot = "Part 2";
//call the writeFoot function to write out the footer information
writeFoot($pageFoot); 
?>