<?php

//  writeHead function to read in a title and write out the beginning html for a page
 function writeHead($title) {
        // Use Heredoc to create a variable that holds all the html information.
        // I put more than you need for the lab practice just to show the practical use of this type of code.
        $headData = <<<EOF

		<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="utf-8">
					<title>$title</title>
					<meta name="viewport" content="width=device-width; initial-scale=1.0">
				</head>
EOF;
     
// Print writeHead data to site
echo $headData;
}
		
// priceCalc function to read in a price and return a tax value
  function priceCalc($price, $quantity) {
    $discounts = array(0, 0, .05, .1, .2, .25);
    if ($quantity > 5) {
        $discountedPrice = $quantity * ($price * (1 - $discounts[5]));
    } else {
        $discountedPrice = $quantity * ($price * (1 - $discounts[$quantity]));
    }
      return $discountedPrice;
}
		
function writeFoot(){
    $footData = <<<EOF
           </div>
            <footer>
                <p>
                    ITSE 1406 - Competency 1
                </p>
            </footer>
        </div>
    </body> 
    </html>
EOF;
// Write footer data
    echo $footData;
}  
?>
