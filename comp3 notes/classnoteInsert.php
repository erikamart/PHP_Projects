
<?php
//side note: use tinymce or xena to strip microsoft word docs of all their formats and allow you to format as HTML.


//insert the following code in the process area of your form.
//be sure to add "echo $albumList;" in php tags within your form label area at the bottom
$sqlAlbumId = "SELECT `AlbumId`, `Title` FROM `album` WHERE 1";

				// connect to the database
                $conn = mysqli_connect("localhost", "phpstudent", "Itse1406",'chinook');

                // run the query or kill it if there's a connection error OR error in the result set
                $resultAlbumId = mysqli_query($conn,$sqlAlbumId) or die(mysqli_error($conn));
$albumList = <<<HERE
<select name = "AlbumId">\n
HERE;
		// loop through results and display the data
		while ($row = mysqli_fetch_assoc($resultAlbumId)) {
			$albumIdList =  $row['AlbumId'];
			$Title =  $row['Title'];
			if($albumIdList == $albumList){
				$selectedID = " selected";
			} else {
				$selectedID = NULL;
			}
$albumList .= <<<HERE
<option value = "$albumIdList"$selectedID>$Title</option>\n
HERE;
	}
$albumList .= <<<HERE
</select>\n
HERE;

?>