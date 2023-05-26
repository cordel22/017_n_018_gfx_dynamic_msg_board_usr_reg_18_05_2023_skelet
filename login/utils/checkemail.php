



<?php

if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
    //  $e = mysqli_real_escape_string($dbc, $trimmed['email']);    //  not necessary when using PDO  https://stackoverflow.com/questions/15648228/how-to-use-write-mysql-real-escape-string-in-pdo
    $e = $trimmed['email'];
  } else {
    echo '<p class="error">Please enter a valid email address!</p>';
    //  echo 'lets see, you put in : ' . $trimmed['email'];
  }

