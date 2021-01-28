<?php
    require_once '..\functions.php';
	$pageTitle = "Part 3, Section I: Display Page";
    writeHead($pageTitle);
?>
        <!-- Include a link to the Insert Page --> 
		<p class="pad"><a href="part3Insert.php">Add New Track</a></p>
        <hr>
    <div id="contentDiv">
	<?php
		// check to see if an action has been passed from another script
		if (isset($_GET['action'])){
			 echo "<p class='error'>Track ".$_GET['id']." ".$_GET['action']."</p>";
		}
	?>
            <table>
                <tr><th>Track ID</th><th>Name</th><th>Unit Price</th></tr>
            <?php
                // connect to the database
                $conn = mysqli_connect("localhost", "root", "",'chinook');
                // check to see if the connection worked and display error if not
                if (!$conn) {
                    echo "Failed to connect to MySQL: ".mysqli_connect_error();
                }
                // create the query to retrieve records from the track table that have a genreId=1 and mediaTypeId=2
                $query = "SELECT `TrackId`,`Name`,`UnitPrice` FROM `track` WHERE `GenreId`=1 AND `MediaTypeId`=2";
                // run the query or kill it if there's a connection error OR error in the result set
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
                // check for results
                if (mysqli_num_rows($result)> 0) {
                    // loop through results and display the trackId, name and unitPrice for each record in a table along with a link to update and a link to delete
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row['TrackId']."</td>";
                        echo "<td>".$row['Name']."</td>";
                        echo "<td>".$row['UnitPrice']."</td>";
                        echo "<td><a href='part3Update.php?id=".$row['TrackId']."'>Update</a></td>";
                        echo "<td><a href='part3Delete.php?id=".$row['TrackId']."'>Delete</a></td></tr>\n";
                    }
                }
            ?>
            </table>
<?php 
	$pageFoot = "Part 3, Section I: Display Page";
	writeFoot($pageFoot); 
?>