<?php

// writeHead function to insert a title and write out the beginning html for a page
function writeHead($pageTitle) {

// Use Heredoc to create a variable that holds all html information.
$headData = <<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>$pageTitle</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link href="..\styles.css" type="text/css" rel="stylesheet">
</head>

    <body>
			<div>
				<header>
					<h1 class="topBottom">Welcome to the right place for PHP Examples!</h1>
				</header>
				<nav class="topBottom">
                    <p> <a href="..\index.php">Main Directory</a> | 
                        <a href="..\Part1/part1.php">Simple Data Lists</a> | 
                        <a href="..\Part1/part1d.php">Do Things with Simple Data List</a> | 
                        <a href="..\Part2/part2.php">Forms for a Database</a> | 
                        <a href="..\Part3/part3.php">Playing with a Database</a> | 
                        <a href="..\Part4/part4.php">A Trivia Game</a></p>
                    
                    <hr>
                </nav>
            </div>
    <!-- html closing tags at end of this page after footer -->
EOF;
     
// Print writeHead data
echo $headData;
}
		
// priceCalc function to read in a price and return a tax value
function priceCalc($price, $quantity) {
    
    $discounts = array(0, 0, .05, .1, .2, .25);
    if ($quantity > 5) {
        $discountPrice = $quantity * ($price * (1 - $discounts[5]));
    } else {
        $discountPrice = $quantity * ($price * (1 - $discounts[$quantity]));
    }
      return $discountPrice;
}
		
function writeFoot($pageFoot){
$footData = <<<EOF
           </div>
            <footer class="topBottom"> <hr>
                <p>
                    PHP - $pageFoot
                </p>
            </footer>
        </div>
    </body> 
    </html>
EOF;
// Print footer data
    echo $footData;
}  
?>
