<?php
     require_once 'functions.php';
    // connect to the database
    $conn = mysqli_connect("localhost", "root", "",'chinook');
    writeHead("Desired Comp3.4-3.5: Update Employee");
        // check to see if the form has been submitted if so write out the data.
    if (isset($_POST['delete'])) {
        $eid = $_POST['eid'];
        $query = "delete from employee where EmployeeId=$eid";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn)>0) {
                header("Location: labComp3-3.php?action=deleted&id=$eid");
                exit();
            }
            echo "<p class='error'>Unable to update record</p>";
    } else {
        // if the form was not submitted, get the id from the querystring and retrieve the data from the database
        if (!isset($_GET['id'])) {
            echo "<p class='error'>No Employee ID provided. <a href='labComp3-3.php'>Return to display page.</a>";
        }
        $eid=$_GET['id'];
        $query = "Select * from employee where EmployeeId = $eid";
        $result = mysqli_query($conn,$query);
        if (!$result) {
            die(mysqli_error($conn));
        }
        // check for results
        if (mysqli_num_rows($result)> 0) {
            // retrieve result row
            $row = mysqli_fetch_assoc($result);
            $firstname=$row['FirstName'];
            $lastname=$row['LastName'];
            $email=$row['Email'];
            $title=$row['Title'];
        } else {
            echo "<p class='error'>Unable to retrieve employee $eid. <a href='labComp3-3.php'>Return to display page.</a>";
        }
    }
?>
        <p>Employee Information</p>
        <p><?php echo "$firstname $lastname <br>$title<br>$email"; ?></p>
        <form method="post" action="labComp3-6d.php">
            <p>
                <input type="hidden" name="eid" value="<?php echo $eid; ?>">
                <input type="submit" name="delete" value="Confirm Delete">
            </p>
        </form>
        <p>Return to <a href="labComp3-3.php">Employee Display</a></p>
        <?php writeFoot(); ?>