<?php
require_once '..\functions.php';
// Define the title variable
$pageTitle = "Comp2b: User Form";   
// Call writeHead passing the title variable in
writeHead($pageTitle);
?>
<p>
    <?php
    // display the information passed in the query string
    echo $_GET['albumId']." ".$_GET['albumName']." by ".$_GET['artistName']." added on ".date("l, F d, Y h:ia");
    ?>
</p>
<?php
// Define the foot variable
$pageFoot = "Competency 2b";
//call the writeFoot function to write out the footer information
writeFoot($pageFoot);
?>