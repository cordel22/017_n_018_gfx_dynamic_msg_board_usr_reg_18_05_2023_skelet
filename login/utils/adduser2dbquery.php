


<?php


$sql = "INSERT INTO users (lang_id, time_zone, email, pass, username/*, active,
      registration_date*/) VALUES (:lang_id,:time_zone, :email, :pass, :username/*, :active, NOW() */)";
      //  $r = mysqli_query($dbc, $q);
      $stmt = $pdo->prepare($sql);
      $r = $stmt->execute(array(
        ':lang_id' => 1,
        ':time_zone' => 'America/New_York',
        ':email' => $e,
        //  ':pass' => SHA1('$p'),  //  todo, u sure bout the string quotes''?
        ':pass' => SHA1($p),
        ':username' => $n,
        /*  ':active' => $a,  */
        //  ':registration_date' => $subject
      ));