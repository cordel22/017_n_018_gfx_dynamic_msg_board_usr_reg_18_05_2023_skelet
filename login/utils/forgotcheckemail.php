


<?php

$stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = :xyz");
$stmt->execute(array(":xyz" =>  $_POST['email']));  //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)
