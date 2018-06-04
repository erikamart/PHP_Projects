<?php
    require_once 'functions.php';
    writeHead("Desired Comp2.1-2.3: User Form");
	
        // check to see if the form has been submitted if so write out the data.
    if (isset($_POST['submit'])) {
        // set the validation flag
        $valid = true;
        // retrieve the values from the form. use htmlspecialchars to avoid security issues
        $firstname = htmlspecialchars($_POST['firstname']);
        if (empty($firstname)) {
            $errorFirstname= "<p class='error'>Please enter your first name</p>";
            $valid = false;
        }
        $lastname = htmlspecialchars($_POST['lastname']);
        if (empty($lastname)) {
            $errorLastname= "<p class='error'>Please enter your last name</p>";
            $valid = false;
        }
        $email = htmlspecialchars($_POST['email']);
        if (empty($email)) {
            echo "<p class='error'>Please enter your email</p>";
            $valid = false;
        }
        $username = htmlspecialchars($_POST['username']);
        if (empty($username)) {
            echo "<p class='error'>Please enter a username</p>";
            $valid = false;
        }
        $password = htmlspecialchars($_POST['password']);
        if (empty($password)) {
            echo "<p class='error'>Please enter a password</p>";
            $valid = false;
        }
        $zip = htmlspecialchars($_POST['zipcode']);
        // test zip codeto make sure it is numeric
        if (!is_numeric($zip)) {
            echo "<p class='error'>Zip code must be numeric</p>";
            $valid = false;
        }
        // since usertype is a radio button, we will use isset to test if the user selected one of the options.
        if (isset($_POST['usertype'])) {
            // if set, get the type. No need for htmlspecialchars here, since the user can only select a value we provided.
            $type = $_POST['usertype'];
        } else {
            echo "<p class='error'>Please select a user type</p>";
            $valid = false;
            $type="";
        }
        // for the interest checkboxes, use isset to test if the user selected at least one.
        if (isset($_POST['interests'])) {
            // if set, get the interests. No need for htmlspecialchars here, since the user can only select a value we provided. Since they could select more than one, use an array
            $interests = $_POST['interests'];
        } else {
            echo "<p class='error'>Please select at least one interest</p>";
            $valid = false;
            $interests[0]="";
        }
        // by default the first item in a selection list is selected, so this tests to make sure they selected a different option.
        $county = $_POST['county'];
        if ($county=="") {
            echo "<p class='error'>Please select a county</p>";
            $valid = false;
        }
        // if the data is valid, transfer to another page and send the album name via the querystring
        if ($valid) {
            header("Location: labComp2-3b.php?firstname=$firstname&lastname=$lastname");
            exit();
        }
    } else {
        // if the form was not submitted, initialize the variables for the sticky form fields
        $firstname="";
		$errorFirstname= NULL;
        $lastname="";
		$errorLastname= NULL; //you can also use the same "" as in line 74.  Null or "" is the same.
        $email="";
        $username="";
        $password="";
        $type ="";
        $interests[0]="";
        $county="";
        $zip="";
		
		
    }
?>
        <form method="post" action="labComp2-3.php">
            <p>
                <label for="firsname">First name</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
                <?php echo $errorFirstname;?>
				</br>
				<label for="lastname">Last name</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
				<?php echo $errorLastname;?>
            </p>
            <p>
                <label for="email">Email address:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            </p>
            <p>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username"  value="<?php echo $username; ?>">
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="pssword"  value="<?php echo $password; ?>">
            </p>
            <p>
                <input type="radio" name="usertype" id="student" value="student"
                 <?php
                 // test the value of the form input to see if the radio button should be checked
                 if ($type == "student") {echo "checked";}
                 ?>
                >
                <label for="student">Student</label>
                <input type="radio" name="usertype" id="instructor" value="instructor" <?php
                 if ($type == "instructor") {echo "checked";}
                 ?>>
                <label for="instructor">Instructor</label>
                <input type="radio" name="usertype" id="tutor" value="tutor" <?php
                 if ($type == "tutor") {echo "checked";}
                 ?>>
                <label for="tutor">Tutor</label>
            </p>
            <p>
                <input type="checkbox" name="interests[]" id="html" value="html"
                 <?php
                 // loop through the array to see if the checkbox value is found and the checkbox should be checked
                 foreach ($interests as $interest) {
                 if ($interest == "html") {echo "checked";}
                 }
                 ?>
                >
                <label for="html">HTML</label>
                <input type="checkbox" name="interests[]" id="css" value="css"
                 <?php
                  foreach ($interests as $interest) {
                 if ($interest == "css") {echo "checked";}
                 }
                 ?>
                >
                <label for="css">CSS</label>
                <input type="checkbox" name="interests[]" id="php" value="php"
                 <?php
                 foreach ($interests as $interest) {
                 if ($interest == "php") {echo "checked";}
                 }
                 ?>
                >
                <label for="php">PHP</label>
                <input type="checkbox" name="interests[]" id="mysql" value="mysql"
                 <?php
                 foreach ($interests as $interest) {
                 if ($interest == "mysql") {echo "checked";}
                 }
                 ?>
                >
                <label for="mysql">MySQL</label>
                <input type="checkbox" name="interests[]" id="js" value="js"
                 <?php
                 foreach ($interests as $interest) {
                 if ($interest == "js") {echo "checked";}
                 }
                 ?>
                >
                <label for="js">JavaScript</label>
            </p>
            <p><label for="county">County: </label>
                <select name="county" id="county">
                    <option value="">Select a county</option>
                    <option value="Dallas"
                    <?php
                    // check to see if the county is selected
                        if ($county=="Dallas") { echo "selected";}
                    ?>
                    >Dallas</option>
                    <option value="Collin"
                    <?php
                        if ($county=="Collin") { echo "selected";}
                    ?>
                    >Collin</option>
                    <option value="Tarrant"
                    <?php
                        if ($county=="Tarrant") { echo "selected";}
                    ?>
                    >Tarrant</option>
                    <option value="Denton"
                    <?php
                        if ($county=="Denton") { echo "selected";}
                    ?>
                    >Denton</option>
                    <option value="other"
                    <?php
                        if ($county=="other") { echo "selected";}
                    ?>
                    >Other</option>
                </select>
            </p>
            <p>
                <label for="zip">Zip Code</label>
                <input type="text" name="zipcode" id="zip" value="<?php echo $zip; ?>">
            </p>
            <p>
                <input type="submit" name="submit" value="Add User">
            </p>
        </form>
        <?php writeFoot(); ?>
    </body>
</html>