<!DOCTYPE html>
<html lang="en">
  <head>
           <meta charset="utf-8">
           <title>Lab Practice 1.8</title>
           <meta name="viewport" content="width=device-width; initial-scale=1.0">
      </head>
      <body>
           <div>
                 <header>
                       <h1>Lab Practice Example 1.8</h1>
                 </header>
	<div>
 <?php
                    //Create variables
                    $price = 100;
                   
                    // For loop
                    // Write title
                    echo "<p>For Loop: Discount price by Week - 8 Weeks:";
                    // for loop using $x as a counter. Initialize to 0, continue until x reaches 8, add 1 to x each iteration
                    for ($x=0;$x<8;$x++) {
                        // calculate new price based on the week by multiplying the price times the week times the .10 discount and subtracting from the price.
                        $discPrice = $price - ($price * $x *.10 );
                        // write out the week and the discounted price - rounded to 2 digits for currency.
                        echo "<br>Week ".($x+1).": \$".round($discPrice, 2). "\n";
                    }
                    echo "</p>";
                   
				   
                    // While loop
                    // Write title
                    echo "<p>While Loop: Discount price by Week, $20 Minimum";
					
                    // initialize $x to 0 before loop.
                    $x = 0;
					
                    //Set $discPrice to $price the first time so the loop will run
                    $discPrice = $price;
					
                    // while loop runs as long as $discPrice is greater than 20
                    while ($discPrice >20) {
						
                        // calculate discount price and write out to page (same as for loop)
                      
						$discPrice = $price - ($price * $x*.10 );
                        echo "<br>Week ".($x+1).": \$".round($discPrice, 2). "\n";
                        // increment counter
                        $x=$x+1;
                    }
                    echo "</p>";
                    // Do While Loop
                    // Write title
                    echo "<p>Do While Loop: Quantity Discount:";
                        // initialize $x to 0 before loop.
                    $x=0;
                    do {
                        // calculate discount price and write out based on quantity (using .01 instead of .10 since we are adding 10 to $x each time)
                        $discPrice = $price - ($price * $x*.01);
                        echo "<br>Minimum quantity: ".$x.": \$".round($discPrice, 2). "\n";
                        //increment counter
                        $x=$x+10;
                    } while ($x <= 70);
                    echo "</p>";
                ?>
				               </div>
              <footer>
                   <p>
                         ITSE 1406 - Competency 1
                   </p>
                 </footer>
           </div>
      </body>
</html>