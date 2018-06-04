<?php
    require_once 'functions.php';
    writeHead("Desired Comp2.1-2.3: User Form");
    ?>
                <p>
                    <?php
                        // display the first and last name passed in the querystring
                        echo $_GET['firstname']." ".$_GET['lastname']." data received."
                    ?>
                </p>
            </div>

            <?php writeFoot(); ?>
        </div>
    </body>
</html>