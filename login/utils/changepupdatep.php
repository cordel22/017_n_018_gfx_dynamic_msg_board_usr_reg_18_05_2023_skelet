


<?php


$sql = "UPDATE users SET pass = :pass WHERE user_id = :user_id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':pass' => $p,
      ':user_id' => $uid
    )); //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));


