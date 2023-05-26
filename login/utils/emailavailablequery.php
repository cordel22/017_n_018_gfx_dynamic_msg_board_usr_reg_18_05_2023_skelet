



<?php

$q = "SELECT user_id FROM users WHERE email='$e'";
    $stmt = $pdo->query($q); //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));;
    $row_count = $stmt->rowCount();
