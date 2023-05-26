


<?php

//  If no first_name session variable exists, redirect the user:


if (!isset($_SESSION['user_id'])) {
    $url = BASE_URL . 'index.php';
    //  Define the URL.
    ob_end_clean(); //  Delete the buffer.
    header("Location: $url");
    exit();    //  Quit the script.
  }





