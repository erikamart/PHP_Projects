<?php
	// Include the functions page in this page
	include_once 'functions.php';
	
	// Associative array of artists and albums
	$artists = array(
                     "Smashing Pumpkins" => "Siamese Dream", 
                     "Dido" => "No Angel", 
                     "U2" => "The Joshua Tree",
                     "Nirvana" => "Nevermind", 
                     "Moby" => "Natural Blues",
                     "Fiona Apple" => "Tidal", 
                     "Bjork" => "Homogenic",
                     "Everclear" => "Songs from an American Movie", 
                     "Hotrod Hillbillies" => "You Wanna Race",
                     "Green Day" => "Dookie",
                    );
	// Define needed variables
	$download = true;
	$shipping = 2.99;
    $price1 = 9.99;
    $price2 = 12.99;
	
	// Define the title variable
	$pageTitle = "Competency 1";
	
	// Call writeHead passing the title variable in
	writeHead($pageTitle);
	
	// Add the beatles data to 
	$artists["The Beatles"] = "The White Album";
?>
<div id="contentDiv">
<?php
	//Create level 2 heading
    echo "<br><br>";
	echo "<h2> Artists &nbsp; &#8225; &nbsp; Albums</h2>";
	
	//Foreach loop
	foreach($artists as $artist => $album) {
		echo "$artist &nbsp; &#8225; &nbsp; $album <br>";
	}
	
	//download WHILE loop
	echo "<h2>Cost for Album Downloads</h2>";
	$qty = 1;
	while($qty < 7) {
		$total = round(priceCalc($price1, $qty), 2);
		echo "Total for $qty is \$$total.<br>";
		$qty++;
	}
	
	//download false
	$download = false;
		
	//cds FOR loop
	echo "<h2>Cost for Album CDs</h2>";
	for($qty = 1; $qty < 6; $qty++) {
		$total = round(priceCalc($price2, $qty), 2) + $shipping;
		echo "Total for $qty is \$$total.<br>";
	}
	echo "<br><br>";
?>    
    </div>
<?php
	//call the writeFoot function to write out the footer information
	writeFoot();
?>