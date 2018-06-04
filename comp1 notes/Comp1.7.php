<!DOCTYPE html>
<html lang="en">
  <head>
           <meta charset="utf-8">
           <title>Lab Practice 1.7</title>
           <meta name="viewport" content="width=device-width; initial-scale=1.0">
      </head>
      <body>
           <div>
                 <header>
                       <h1>Lab Practice Example 1.7</h1>
                 </header>
	<div>
<?php

//Create variables
$favColor = "teal";
$favNum = 17;
$pet = "dog";

// Write favorite color
echo "<p>Your favorite color is $favColor</p>";

// Test to see if favorite color is a hot color: red, orange or yellow 

if ($favColor == "red" or $favColor == "orange" or $favColor == "yellow") 
{
echo "<p>You like it hot!</p>";
}

// Write out favorite number
echo "<p>Your favorite number is $favNum</p>";

// Test to see if favorite number is greater than 10

if ($favNum > 10) {
echo "<p>Whoa! That's a big number.</p>";
} 

else {
echo "<p>A good simple number</p>";
}

// Write out pet variable
echo "<p>Your pet is $pet</p>";

// Test to see what kind of pet

if ($pet == "none") {
echo "<p>I'm sorry you don't have a pet.</p>";
} 

elseif ($pet == "dog") {
echo "<p>A dog can be your best friend.</p>";
} 

elseif ($pet == "cat") {
echo "<p>Cats are cool</p>";
}

else {
echo "<p>That's an interesting pet</p>";
}

// Same code using a switch statement

switch ($pet) {

    case "none":
    echo "<p>I'm sorry you don't have a pet.</p>";
    break;

    case "dog":
    echo "<p>A dog can be your best friend.</p>";
    break;

    case "cat":
    echo "<p>Cats are cool</p>";
    break;

    default:
    echo "<p>That's an interesting pet</p>";
}
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