<?php
                    echo "<p>Today is ";
                    // write out a formatted date
                    echo date('l, F d, Y');
                    echo "</p>";echo "<p>Today is ";
                    // get the current date array
                    $today = getDate();
                    // write out the formatted date
                    echo $today['weekday'].", ".$today['month']." ".$today['mday'].", ".$today['year'];
                    echo "</p>";
                    // get the current hour
                    $hour = $today['hours'];
                    // determine the time of day and write out a greeting.
                    if ($hour >= 6 and $hour < 12) {
                        echo "<p>Good Morning!</p>";
                    } elseif ($hour >=12 and $hour < 18) {
                        echo "<p>Good Afternoon!</p>";
                    } elseif ($hour >= 18 and $hour <22) {
                        echo "<p>Good Evening!</p>";
                    } else {
                        echo "<p>Sweet Dreams!</p>";
                    }
                    // get the Unix timestamp for new year's day and for today
                    $newyear = mktime(0,0,0,1,1,2016);
                    $thisday = mktime();
                    // calculate the difference in milliseconds
                    $diff = $newyear - $thisday;
                    // convert to days by dividing by 60 sec * 60 min * 24 hours and round
                    $days = round($diff/(60*60*24));
                    // display days left in the year
                    echo "<p>There are $days days left in this year.</p>"
                ?>