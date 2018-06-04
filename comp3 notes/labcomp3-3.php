<?php
    require_once 'functions.php';
    writeHead("Desired Comp3.1-3.3: Employee Table Display");
    ?>
        <div>
            <table>
                <tr><th>ID</th><th>LastName</th><th>FirstName</th><th>Title</th><th>Email</th></tr>
            <?php
                // connect to the database
                $conn = mysqli_connect("localhost", "phpstudent", "Itse1406",'chinook');
				$title = 'Sales Support Agent';
                // create the query
                $query = "Select EmployeeId, LastName, FirstName, Title, Email from Employee Where Title = '$title';";
                // run the query
                $result = mysqli_query($conn,$query);
                // check for errors
                if (!$result) {
                    die(mysqli_error($conn));
                }
                // check for results
                if (mysqli_num_rows($result)> 0) {
                    // loop through results and display
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row['EmployeeId']."</td>";
                        echo "<td>".$row['LastName']."</td>";
                        echo "<td>".$row['FirstName']."</td>";
                        echo "<td>".$row['Title']."</td>";
                        echo "<td>".$row['Email']."</td></tr>";
                    }
                }
            ?>
            </table>
        </div>
        <?php writeFoot(); ?>