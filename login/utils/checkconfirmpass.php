





<?php


if (preg_match('/^\w{4,20}$/', $trimmed['password1'])) {
    if ($trimmed['password1'] == $trimmed['password2']) {
      //  $p = mysqli_real_escape_string($dbc,  $trimmed['password1']);   //  //  not necessary when using PDO  https://stackoverflow.com/questions/15648228/how-to-use-write-mysql-real-escape-string-in-pdo
      $p = $trimmed['password1'];
    } else {
      //  echo '<p class="error">Your password did not match the confirmed password!</p>';
    }
  } else {
    echo '<p class="error">Please enter a valid password!</p>';
    //  echo 'lets see, you put in : ' . $trimmed['password1'];
  }





