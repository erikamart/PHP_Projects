<?php
// Include the functions page in this page
include_once '..\functions.php';

// Define the title variable for the writeHead Function
$pageTitle = "Working Arrays";
// Call writeHead function passing the title variable in
writeHead($pageTitle);

//Create a multidimensional array of artists, albums and release dates using the following information:
$artists = array(
    "The Beatles"=> array("A Hard Day's Night"=> "1964", "Help!"=> "1965", "Rubber Soul"=> "1965", "Abbey Road"=> "1969"),
    "Led Zepplin"=>array("Led Zepplin IV"=> "1971"), 
    "Rolling Stones"=>array("Let It Bleed"=> "1969", "Sticky Fingers"=> "1971"), 
    "The Who"=>array("Tommy"=> "1969", "Quadrophenia"=> "1973", "The Who by Numbers"=> "1975")
    );
?>
<div id="contentDiv"> 
<?php
//Loop through the array and write out each artist and album title
echo "<ul>";
    foreach($artists as $artist => $album){
    echo "<li> $artist <ul>";
        foreach($album as $record => $release){
        echo "<li> $record </li>";
    }
        echo "</ul>";
}
echo "</ul><hr>";


//Write out the release date for Tommy by The Who
echo "<p> The Album Tommy was released by The Who in " .$artists['The Who']['Tommy']. ".</p>";
echo "</ul><hr>";

//Loop through the array and write out each album and release date for The Who
echo "Albums and release dates for The Who:";
echo "<ul>";
    foreach($artists['The Who'] as $artist => $album){
    echo "<li> $artist &nbsp; &#8225; &nbsp; $album</li><ul>";
        echo "</ul>";
}
echo "</ul><hr>";

//Write the php code to loop through the array and list all of the artists and albums that were released after 1970
echo "Artist and albums released after 1970:";
echo "<ul>";
    foreach($artists as $artist => $album){
    
        foreach($album as $record => $release){
            if ((int)$release > 1970){
                echo "<li> $artist &nbsp; &#8225; &nbsp; $record &nbsp; &#8225; &nbsp; $release</li>";
               }
	}
}
echo "</ul>";
?>
</div>
<?php
    // define the foot variable
    $pageFoot = "Working Arrays";
    //call the writeFoot function to write out the footer information
    writeFoot($pageFoot);
?>