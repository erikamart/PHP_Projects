<?php
	//include functions page
	include_once 'functions.php';
	
	//create an associative array of artists and albums
	$artists = array("Smashing Pumpkins" => "1979", 
                     "Dido" => "Dido", 
                     "U2" => "The Joshua Tree",
                     "Nirvana" => "Nevermind", 
                     "Moby" => "Natural Blues",
                     "Fiona Apple" => "Tidal", 
                     "Bjork" => "Homogenic",
                     "Everclear" => "Songs from an American Movie", 
                     "Hotrod Hillbillies" => "You Wanna Race",
                     "Green Day" => "Dookie",
                    );

    print_r($artists);

	//create variables
	$download = TRUE;
	$shipping = 2.99;
	
	//set title
	$title = "Competency 1";
	
	//Call the writeHead passing title in
	writeHead($title);
?>
<body>
			<div>
				<header>
					<h1>$title</h1>
				</header>
				
				<nav>
                    <p><a href="comp1.php">comp1.php</a> | <a href="comp2.php">comp2.php</a> | <a href="comp3.php">comp3.php</a> | <a href="comp4.php">comp4.php</a></p>
                </nav>
				
			</div>
<?php	
	//Add the beatles
	$artists["The Beatles"] = "The White Album";
	
	//Create level 2 heading
	echo "<h2> Artists and Albums</h2>";
	
	//Foreach loop
	foreach($artists as $artist => $album) {
		echo "<p> $artist :: $album </p>";
	}
	
	//download WHILE loop
	echo "<h2>Cost by Album - Downloads</h2>";
	$qty = 1;
	while($qty < 7) {
		$itemPrice = 9.99;
		$total = round(priceCalc($itemPrice, $qty), 2);
		echo "<p> Total cost for $qty is \$$total.</p>";
		$qty++;
	}
	
	//download false
	$download = FALSE;
		
	//cds FOR loop
	echo "<h2>Cost by Album - CDs</h2>";
	for($qty = 1; $qty < 6; $qty++) {
		$itemPrice = 12.99;
		$total = round(priceCalc($itemPrice, $qty), 2) + $shipping;
		echo "<p> Total cost for $qty is \$$total.</p>";
	}
	
	//call the writeFoot function to write out the footer information
	writeFoot();
	?>